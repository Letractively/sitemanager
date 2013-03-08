<?php

include_once("config.php");

function createLinks() {
    $files = glob(BASE_PATH . "*");
    $result = "";
    $result.="<table border =1>";
    $result.= "<tr>
<td>Siti presenti</td>
</tr>
";
    foreach ($files as $file) {
        if (is_dir($file)) {
            $basename = basename($file);
            $result.= "<tr>
<td><a href=\"http://localhost/" . $basename . "\" target=\"_blank\">" . $basename . "</a></td>
</tr>
";
        }
    }
    $result.="</table>";
    return $result;
}

function siteWorkInProgress() {
    $files = getSitesByState(0);
    $result = "";

    if ($files != null && count($files) > 0) {
        $result.="<form  method=\"post\" name=\"newsite\" action=\"publish.php\">
<table border =1>";
        $result.= "<tr>
<td>Siti da publicare</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><input type=\"radio\" name=\"sites\" value=\"" . $file['id'] . "\"><a href=\"http://localhost/" . $file['nome']. "\" target=\"_blank\">" . $file['nome']. "</a></td>
</tr>
";
        }
        $result.="</table>
<input type=\"submit\" value=\"Prepara per la publicazione\">
</form>";
    }
    return $result;
}

function siteToBePublished() {
    $files = getSitesByState(1);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td>Siti da installare</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><a href=\"index.php?nome=".$file['domainName'] ."&domain=".$file['domain'] ."\">Installa " . $file['nome'] . "</a></td>
</tr>
";
        }
        $result.="</table>";
    }
    return $result;
}
function manageInstallation($domainName,$dom){
    $nameToBeCheked = "http://www." . $domainName . "." . $dom;
    $resultOfACall = @file_get_contents($nameToBeCheked . "/publish.php");
    if(isset($http_response_header)) {
        $responseHeader = $http_response_header[0];
        if ($responseHeader == "HTTP/1.1 404 Not Found") {
            $resultOfACall = @file_get_contents($nameToBeCheked);
            $responseHeader = $http_response_header[0];
            if ($responseHeader != "HTTP/1.1 404 Not Found") {
                updateStatusForDomain($domainName, $dom,2) ;
                header('Location: index.php');
            } else {
                echo "carica i file sull'host";
            }
        } else {
            $resultOfACall = @file_get_contents($nameToBeCheked);
            $responseHeader = $http_response_header[0];
            if ($responseHeader != "HTTP/1.1 404 Not Found") {
                updateStatusForDomain($domainName, $dom,2) ;
                header('Location: index.php');
            } else {
                echo "errore nell'installazione";
            }
        }
    }else{
        echo $nameToBeCheked." non trovato";
    }
}


function siteCompleted() {
    $files = getSitesByState(2);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td>Siti completati</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><a href=\"http://www.".$file['domainName'] .".".$file['domain'] ."\" target=\"_blank\">" . $file['nome'] . "</a></td>
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
 * inserti in DB the entry for the new created site
 *
 * @param type $newSite: the name of the new site
 * @param type $clientId: this is the id of a client
 * @param type $source : this is the name of the master that are used for this entry
 * @return boolean
 */
function insertNewCreatedSiteInDb($newSite, $clientId, $source) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "INSERT INTO `site_manager`.`sm_prodotti` (`id`, `nome`, `cliente_id`, `modello_id`, `ins`, `upd`) VALUES ('', '" . $newSite . "', ' " . $clientId . "', '" . $source . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "');";
    if (!mysql_query($sql, $con)) {
        $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function updateStatusForDomain($domainName, $domain,$status) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "UPDATE site_manager.sm_prodotti SET
        status = ".$status.",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.domainName ='".$domainName."'
    AND sm_prodotti.domain='".$domain."';";
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
    $sql = "UPDATE site_manager.sm_prodotti SET
        data_acquisto = '" . $data['dataacqui']. "',
        ref_mail = '" . $data['email'] . "',
        ftp_host = '" . $data['ftphost']  . "',
        ftp_username = '" . $data['ftpusername']  . "',
        ftp_pwd = '" . $data['ftppwd']  . "',
        db = '" . $data['newDb'] . "',
        dbusername = '" . $data['userName']  . "',
        dbpwd = '" . $data['password']  . "',
        hostdb = '" . $data['hostdb']  . "',
        domain = '" . $data['domain']  . "',
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
    $sql = "SELECT * FROM `site_manager`.`sm_prodotti` WHERE id = " . $id;
    $castresult = mysql_query($sql) or die(mysql_error());
    mysql_close($con);
    return mysql_fetch_array($castresult);
}

function getSitesByState($state) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "SELECT * FROM `site_manager`.`sm_prodotti` WHERE STATUS = " . $state . " ORDER BY upd DESC";
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
    $dbCloner->exportDbToPath($newConfig['domainName'] . ".sql", $source, $newConfig);
    writeInstaller($newConfig,$source);
    return updateStatusSiteInDb($id, $newConfig);
}

function writeInstaller($config,$source){
    $fh = fopen(BASE_PATH.DIRECTORY_SEPARATOR.$source.DIRECTORY_SEPARATOR."install.php", 'w');
    $stringData ="<?php

if (importDb(\"".$config['domainName'].".sql\", \"".$config['hostdb']."\", \"".$config['userName']."\", \"".$config['password']."\", \"".$config['newDb']."\")
        && changeWpConfig(\"wp-config-remote.php\")) {
    unlink(__FILE__);
    header('Location: /');
}

function importDb(\$dbDumpFile, \$mysqlHostName, \$mysqlUserName, \$mysqlPassword, \$mydb) {
    \$result = false;
    if (file_exists(\$dbDumpFile)) {
        \$mysqli = new mysqli(\$mysqlHostName, \$mysqlUserName, \$mysqlPassword, \$mydb);
        if (\$mysqli->connect_errno) {
            printf(\"Connessione fallita: %s\n\", \$mysqli->connect_error);
            \$result = false;
        } else {
            \$command = \"mysql -h \" . \$mysqlHostName. \" -u \" . \$mysqlUserName . \" -p\" . \$mysqlPassword . \" \" . \$mydb . \" < \" . \$dbDumpFile;
            exec(\$command, \$output = array(), \$worked);
            if (\$worked == 1) {
                echo \"Impossibile importare il file \" . \$dbDumpFile . \" sul DB\";
                \$result = false;
            } else {
                unlink(\$dbDumpFile);
                \$result = true;
            }
        }
    } else {
        echo \"Il file \" . \$dbDumpFile . \"non esiste <br>\";
        \$result = false;
    }
    return \$result;
}

function changeWpConfig(\$configRemoteFile) {
    if (file_exists(\$configRemoteFile)) {
        if (!file_exists(\"wp-config.php\")) {
            rename(\$configRemoteFile, \"wp-config.php\");
        } else {
            rename(\"wp-config.php\", \"wp-config-locale.php\");
            rename(\$configRemoteFile, \"wp-config.php\");
        }
        \$result = true;
    } else {
        echo \"Il file \" . \$configRemoteFile . \" non esiste\";
        \$result = false;
    }
    return \$result;
}
?>";

    fwrite($fh, $stringData);
    fclose($fh);
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
    if (!$dbCloner->migrate()) {
        echo $dbCloner->errormsg . "</br>";
        return false;
    }
    $dbCloner->cleanAndClose();

    $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $newSite);
    if (!$fileCloner->cloneSite()) {
        echo $fileCloner->errorMsg . "</br>";
        return false;
    }

    $fileCloner->changeWpconfig($mysqlDatabaseName, "db_" . $newSite);

    insertNewCreatedSiteInDb($newSite, null, $source);
    return true;
}

?>
