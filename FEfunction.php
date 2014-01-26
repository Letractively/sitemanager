<?php

include_once("config.php");
include_once("HtAccessMigrate.php");
include_once("WPMigrateFile.php");
include_once("DBCloner.php");
include_once("FtpUploader.php");

ini_set("memory_limit", "256M");

function createLinks() {
    $files = glob(BASE_PATH . "*");
    $result = "";
    $result.="<table border =1>";
    $result.= "<tr>
<td>Siti in locale</td>
</tr>
";
    $masterWork = array();
    foreach ($files as $file) {
        if (is_dir($file)) {
            $basename = basename($file);
            $dbConfigFile = BASE_PATH . $basename . DIRECTORY_SEPARATOR . "wp-config.php";
            $result.= "<tr>
<td><a href=\"http://localhost/" . $basename . "\" target=\"_blank\">" . $basename . "</a></td>
</tr>
";
            if (file_exists($dbConfigFile)) {
                $subject = file_get_contents($dbConfigFile);
                preg_match("/define\('DB_NAME', '(.+?)'\);/", $subject, $matches);
                $masterWork[$basename] = $matches[1];
            }
        }
    }
    $result.="</table>";
    $totalResult['form'] = $masterWork;
    $totalResult['all'] = $result;
    return $totalResult;
}

function createFormForNewSite($arrayOfDbSite) {
    $result = "<form method=\"post\" name=\"newsite\"  onsubmit=\"return validateForm()\" >
            <input type=\"text\" name=\"nome\" value=\"\"></br>";
    foreach ($arrayOfDbSite as $key => $value) {
        $result.= "<input type=\"radio\" name=\"tipo\" value=\"" . $key . "\">" . $key . "<br>";
    }
    $result.="<input type=\"submit\" value=\"crea\">
        </form>
        ";
    return $result;
}

function siteWorkInProgress() {
    $files = getSitesByState(STATUS_WORKING);
    $result = "";

    if ($files != null && count($files) > 0) {
        $result.="<form  method=\"post\" name=\"newsite\" action=\"publish.php\">
<table border =1>";
        $result.= "<tr>
<td>Siti da pubblicare<br/>(selezionare una volta comprato il dominio)</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><input type=\"radio\" name=\"sites\" value=\"" . $file['id'] . "\"><a href=\"http://localhost/" . $file['nome'] . "\" target=\"_blank\">" . $file['nome'] . "</a></td>
</tr>
";
        }
        $result.="</table>
<input type=\"submit\" value=\"Prepara per la publicazione\">
</form>";
    }
    return $result;
}

function siteInTrasfering() {
    $files = getSitesByState(STATUS_TRASFERING);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td>Siti in trasferimento</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td>In trasferimento " . $file['nome'] . "</td>
</tr>
";
        }
        $result.="</table>";
    }
    return $result;
}

function siteToBeTransfered() {
    $files = getSitesByState(STATUS_TO_TRANSFER);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td>Siti da trasferire</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><a href=\"index.php?f=t&id=" . $file['id'] . "\">Trasferisci " . $file['nome'] . "</a></td>
</tr>
";
        }
        $result.="</table>";
    }
    return $result;
}

function siteToBePublished() {
    $files = getSitesByState(STATUS_TO_INSTALL);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td>Siti da attivare<br/>(cliccare dopo aver trasferito i file sul sito remoto)</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><a href=\"index.php?nome=" . $file['domainName'] . "&domain=" . $file['domain'] . "\">Installa " . $file['nome'] . "</a></td>
</tr>
";
        }
        $result.="</table>";
    }

    return $result;
}

function trasferFtpFile($id) {
    $infoOnSite = getSiteById($id);
    $ftpMy = new FtpUploader($infoOnSite['ftp_username'], $infoOnSite['ftp_pwd'], $infoOnSite['ftp_host']);
    $remoteDir = "www." . $infoOnSite['domainName'] . "." . $infoOnSite['domain'];
    $sqlFile = str_replace("/", ".", $infoOnSite['domainName'] . "." . $infoOnSite['domain'] . ".sql");
    $ftpMy->setId_site($infoOnSite['id']);
    $scriptFile = $ftpMy->createScriptFile($infoOnSite['nome'], $sqlFile, $remoteDir);
    if (DEBUG) {
        echo "Created file " . $scriptFile . "</br>";
    }
    $ftpMy->uploadUsingScript($scriptFile, true);
    updateStatusForDomain($infoOnSite['domainName'], $infoOnSite['domain'], $infoOnSite['status'] + 1);
}

function manageInstallation($domainName, $dom) {
    $nameToBeCheked = "http://www." . $domainName . "." . $dom;
    $resultOfACall = @file_get_contents($nameToBeCheked . "/install.php");
    if (isset($http_response_header)) {
        $responseHeader = $http_response_header[0];
        if ($responseHeader == "HTTP/1.1 404 Not Found") {
            @file_get_contents($nameToBeCheked . "/wp-admin/");
            $responseHeader = $http_response_header[0];
            if ($responseHeader != "HTTP/1.1 404 Not Found") {
                updateStatusForDomain($domainName, $dom, STATUS_INSTALLED);
                header('Location: index.php');
            } else {
                echo "carica i file sull'host";
            }
        } else {
            @file_get_contents($nameToBeCheked);
            $responseHeader = $http_response_header[0];
            if ($responseHeader != "HTTP/1.1 404 Not Found") {
                if ($resultOfACall == "0") {
                    updateStatusForDomain($domainName, $dom, STATUS_INSTALLED);
                    //header('Location: index.php');
                } else {
                    echo $resultOfACall;
                }
            } else {
                echo "errore nell'installazione";
            }
        }
    }
}

function siteCompleted() {
    $files = getSitesByState(STATUS_INSTALLED);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td colspan=\"3\">Siti completati</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><a href=\"http://www." . $file['domainName'] . "." . $file['domain'] . "\" target=\"_blank\">" . $file['nome'] . "</a></td>
<td><img src=\"img/info.png\" id=\"".$file['id']."\" class=\"info\"></td>
<td><a href=\"index.php?f=r&id=" . $file['id'] . "\">ritrasferisci</a></td>
</tr>
";
        }
        $result.="</table>";
    }
    return $result;
}

function validateInput($input) {
    if (($input == "") || (preg_match('/[A-Z]/', $input))) {
        echo "input non valido";
        return false;
    }
    return true;
}

/**
 * insert in DB the entry for the new created site
 *
 * @param type $newSite: the name of the new site
 * @param type $clientId: this is the id of a client
 * @param type $source : this is the name of the master that are used for this entry
 * @return boolean
 */
function insertNewCreatedSiteInDb($newSite, $clientId, $source) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "INSERT INTO `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` (`id`, `nome`, `cliente_id`, `modello_id`, `ins`, `upd`) VALUES ('', '" . $newSite . "', ' " . $clientId . "', '" . $source . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "');";
    if (!mysql_query($sql, $con)) {
        $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function backToStatToTransfer($id) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        status = " . STATUS_TO_TRANSFER . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id ='" . $id . "';";
    if (!mysql_query($sql, $con)) {
        echo "Could not update in db ";
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function updateStatusForDomainForId($id, $status) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        status = " . $status . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id ='" . $id . "';";
    if (!mysql_query($sql, $con)) {
        echo "Could not update in db ";
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function updateStatusForDomain($domainName, $domain, $status) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        status = " . $status . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.domainName ='" . $domainName . "'
    AND sm_prodotti.domain='" . $domain . "';";
    if (!mysql_query($sql, $con)) {
        echo "Could not update in db ";
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function updateStatusSiteInDb($id, $data) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        data_acquisto = '" . $data['dataacqui'] . "',
        ref_mail = '" . $data['email'] . "',
        ftp_host = '" . $data['ftphost'] . "',
        ftp_username = '" . $data['ftpusername'] . "',
        ftp_pwd = '" . $data['ftppwd'] . "',
        db = '" . $data['newDb'] . "',
        dbusername = '" . $data['userName'] . "',
        dbpwd = '" . $data['password'] . "',
        hostdb = '" . $data['hostdb'] . "',
        domain = '" . $data['domain'] . "',
        domainName = '" . $data['domainName'] . "',
        status = '1',
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id =" . $id . ";";
    if (!mysql_query($sql, $con)) {
        echo "Could not insert in db ";
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function getSiteById($id) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` WHERE id = " . $id;
    $castresult = mysql_query($sql) or die(mysql_error());
    mysql_close($con);
    return mysql_fetch_array($castresult,MYSQL_ASSOC);
}

function getSitesByState($state) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` WHERE STATUS = " . $state . " ORDER BY upd DESC";
    $castresult = mysql_query($sql) or die(mysql_error());
    mysql_close($con);
    $rows = null;
    while ($row = mysql_fetch_array($castresult)) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 * Create a new wp-config file
 * @param type name of the site to move
 * @param type array of config valuewhos keys are:,  newDb,userName,password,hostdb,domain,domainName
 *
 * Example:
 * $input['newDb'] = "arubadb1";
 * $input['userName'] = "sdfdfgjewroigt";
 * $input['password'] = "aruba password";
 * $input['hostdb'] = "192.34.35.354";
 * $input['domain'] = "com";
 * $input['domainName'] = "centro-estetocpbuetyansdusun";
 *
 */
function moveToRelease($id, $source, $newConfig) {
    $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $source);
    $fileCloner->createReleaseConfigAndBckpLocal($newConfig);
    $fileCloner->switchConfigFile("wp-config-locale.php", "wp-config-remote.php");
    $dbCloner = new DBCloner("db_" . $source, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $source, "http://www." . $newConfig['domainName'] . "." . $newConfig['domain']);
    $exportFileName = str_replace("/", ".", $newConfig['domainName'] . "." . $newConfig['domain'] . ".sql");
    $fileToMove[] = $dbCloner->exportDbToPath($exportFileName, false);
    $archiveFile = BASE_PATH . $source . DIRECTORY_SEPARATOR . $source . ".zip";
    $fileToMove[] = $archiveFile;
    $htaAcces = new HtAccessMigrate("http://www." . $newConfig['domainName'] . "." . $newConfig['domain'], $source);
    $htaAcces->changeHtAccess(false);
    $fileToMove[] = $htaAcces->getFileName();
//  Comment: not create zip file, is useless due to permission aruba problem
//  Zip(BASE_PATH . $source, $archiveFile);
    $fileToMove[] = writeInstaller($newConfig, $source);
//  allFileToMove(BASE_PATH_RELEASE . DIRECTORY_SEPARATOR . $source, $fileToMove);
    return updateStatusSiteInDb($id, $newConfig);
}

function allFileToMove($destPath, $fileToMove) {
    if (!file_exists(BASE_PATH_RELEASE) || (file_exists(BASE_PATH_RELEASE) && !is_dir(BASE_PATH_RELEASE))) {
        mkdir(BASE_PATH_RELEASE);
    }
    if (!file_exists($destPath) || (file_exists($destPath) && !is_dir($destPath))) {
        mkdir($destPath);
    }
    $tempBaseName = BASE_PATH_RELEASE . basename($destPath) . DIRECTORY_SEPARATOR;
    foreach ($fileToMove as $thisfile) {
        rename($thisfile, $tempBaseName . basename($thisfile));
    }
}

function Zip($source, $destination) {
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    //$source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
                continue;

            $file = realpath($file);

            if (is_dir($file) === true) {
                $zip->addEmptyDir(str_replace($source . DIRECTORY_SEPARATOR, '', $file . DIRECTORY_SEPARATOR));
            } else if (is_file($file) === true) {
                if (basename($file) == "wp-config.php") {
                    $zip->addFromString("wp-config-locale.php", file_get_contents($file));
                } else if (basename($file) == "wp-config-remote.php") {
                    $zip->addFromString("wp-config.php", file_get_contents($file));
                } else {
                    $zip->addFromString(str_replace($source . DIRECTORY_SEPARATOR, '', $file), file_get_contents($file));
                }
            }
        }
    } else if (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

function writeInstaller($config, $source) {
    $installerName = BASE_PATH . DIRECTORY_SEPARATOR . $source . DIRECTORY_SEPARATOR . "install.php";
    $fh = fopen($installerName, 'w');
    $sqlDumpFileName = str_replace("/", ".", $config['domainName'] . "." . $config['domain']);
    $stringData = "<?php
set_time_limit (PHP_INT_MAX);

function changeNextGenOption() {
    \$old = array(\"http://localhost/".$source."\", \"http://localhost/master_easy\", \"http://localhost/mybpa\");
    \$new = \"http://www." . $config['domainName'] . "." . $config['domain']."\";
    \$mysqli = new mysqli(\"".$config['hostdb']."\", \"". $config['userName'] . "\", \"" . $config['password'] . "\", \"" . $config['newDb'] . "\");
    \$result = \$mysqli->query(\"SELECT ID, post_content FROM wp_posts WHERE post_type='lightbox_library'\");
    while (\$row = mysqli_fetch_array(\$result)) {
        \$newString = str_replace('\/', '/', base64_decode(\$row['post_content']));
        \$newString = str_replace(\$old, \$new, \$newString);
	\$newString = str_replace('/', '\/',\$newString);
        \$cleaned = base64_encode(\$newString);
        \$updQuery = \"UPDATE wp_posts SET post_content='\" . \$cleaned . \"',post_content_filtered='\" . \$cleaned . \"' WHERE ID=\" . \$row['ID'];
        \$mysqli->query(\$updQuery);
    }
}

function importDb(\$dbDumpFile, \$mysqlHostName, \$mysqlUserName, \$mysqlPassword, \$mydb) {
    \$result = false;
    if(file_exists(\$dbDumpFile)){
            \$mysqli = new mysqli(\$mysqlHostName, \$mysqlUserName, \$mysqlPassword, \$mydb);
            if (\$mysqli->connect_errno) {
                printf(\"Connessione fallita: %s\", \$mysqli->connect_error);
                \$result = false;
            } else {
                \$command = \"mysql -h \" . \$mysqlHostName. \" -u \" . \$mysqlUserName . \" -p\" . \$mysqlPassword . \" \" . \$mydb . \" < \" . \$dbDumpFile;
                exec(\$command, \$output = array(), \$worked);
                if (\$worked == 1) {
                    echo \"Impossibile importare il file \" . \$dbDumpFile . \" sul DB\";
                    \$result = false;
                } else {
                    \$result = true;
                }
          }
        } else {
            echo \"Il file \" . \$dbDumpFile . \" non esiste <br>\";
            \$result = false;
        }
    return \$result;
}

importDb(\"" . $sqlDumpFileName . ".sql\", \"" . $config['hostdb'] . "\", \"" . $config['userName'] . "\", \"" . $config['password'] . "\", \"" . $config['newDb'] . "\");
changeNextGenOption();


rename(\"wp-config.php\", \"wp-config-locale.php\");
rename(\"wp-config-remote.php\", \"wp-config.php\");
unlink(\".htaccess\");
rename(\".htaccess-remote\", \".htaccess\");
//unzipFiles();
//unlink(\"" . $source . ".zip\");
unlink(\"" . $sqlDumpFileName . ".sql\");
unlink(__FILE__);
echo \"0\";
?>";

    fwrite($fh, $stringData);
    fclose($fh);
    return $installerName;
}

/**
 * Do all the migration of files and DB entry for a Word press site
 *
 * @param type $source
 * @param type $newSite
 * @param type $mysqlDatabaseName
 * @return boolean
 */
function migrate($source, $newSite, $mysqlDatabaseName) {
    set_time_limit(60000);
    $dbCloner = new DBCloner($mysqlDatabaseName, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $newSite, $source, $newSite);
    if (!$dbCloner->migrate(true)) {
        echo $dbCloner->errormsg . "</br>";
        return false;
    }
    if (!DEBUG) {
        $dbCloner->cleanAndClose();
    }
    $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $newSite);
    if (!$fileCloner->cloneSite()) {
        echo $fileCloner->errorMsg . "</br>";
        return false;
    }

    $fileCloner->changeWpconfig($mysqlDatabaseName, "db_" . $newSite);
    $htaAcces = new HtAccessMigrate($newSite, $source);
    $htaAcces->changeHtAccess(true);
    insertNewCreatedSiteInDb($newSite, null, $source);
    return true;
}

?>
