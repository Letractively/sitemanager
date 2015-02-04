<?php

include_once("config.php");
include_once("FtpUploader.php");
include_once("SubversionWrapper.php");
include_once("SiteManager.php");


ini_set("memory_limit", "256M");

function createLinks($allSitesInDb) {
    $svnCli = new SubversionWrapper(null, SVN_USER, SVN_PASSWORD);
    $reposAtServer = $svnCli->listAllRepo();
    foreach ((array) $allSitesInDb as $siteInDb) {
        $mapOfSite[$siteInDb['nome']] = $siteInDb['id'];
        if ($siteInDb['script_name'] != "") {
            $working[$siteInDb['nome']] = $siteInDb['script_name'];
        }
    }
    $files = glob(BASE_PATH . "*");
    $masterWork = array();
    $result = "<form method=\"post\" name=\"newsite\"  onsubmit=\"return validateForm()\" >
        Inserisci il nome del nuovo sito da creare 
        <input type=\"text\" name=\"nome\" value=\"\"></br>
        <input type=\"submit\" value=\"crea\"></br>
	<table border =1>";
    $result.= "<tr>
<td colspan=\"3\">Siti in locale</td>
</tr>
";

    foreach ($files as $file) {
        if (is_dir($file)) {
            $basename = basename($file);
            $dbConfigFile = BASE_PATH . $basename . DIRECTORY_SEPARATOR . "wp-config.php";
            if (file_exists($dbConfigFile)) {
                $subject = file_get_contents($dbConfigFile);
                preg_match("/define\('DB_NAME', '(.+?)'\);/", $subject, $matches);
                $masterWork[$basename] = $matches[1];

                if ($reposAtServer != null && ($key = array_search($basename, $reposAtServer)) !== false) {
                    $result.="<tr>"
                            . " <td><input type=\"radio\" name=\"tipo\" value=\"" . $basename . "\">
	<a href=\"http://" . DOMAIN_URL_BASE . "/" . $basename . "\" target=\"_blank\">" . $basename . "</a></td>";
                    if (!isset($working[$basename])) {
                        $result.= " <td><a id=\"c" . $mapOfSite[$basename] . "\" href=\"svnwrp.php?id=" . $mapOfSite[$basename] . "&f=c\"  onclick=\"removeCommit('" . $mapOfSite[$basename] . "');\">commit</a></td>"
                                . " <td><a id=\"u" . $mapOfSite[$basename] . "\" href=\"svnwrp.php?id=" . $mapOfSite[$basename] . "&f=u\"  onclick=\"loadOverlay();\">update</a></td>";
                    } else {
                        $result.= " <td><a id=\"c" . $mapOfSite[$basename] . "\" href=\"svnwrp.php?id=" . $mapOfSite[$basename] . "&f=c\"  onclick=\"removeCommit('" . $mapOfSite[$basename] . "');\" style=\"display:none\">commit</a></td>"
                                . " <td><a id=\"u" . $mapOfSite[$basename] . "\" href=\"svnwrp.php?id=" . $mapOfSite[$basename] . "&f=u\"  onclick=\"loadOverlay();\" style=\"display:none\">update</a></td>";
                    }
                    $result.=" <tr>";
                    unset($reposAtServer[$key]);
                } else {
                    $result.= "<tr>
<td colspan=\"3\"><input type=\"radio\" name=\"tipo\" value=\"" . $basename . "\">
	<a href=\"http://" . DOMAIN_URL_BASE . "/" . $basename . "\" target=\"_blank\">" . $basename . "</a></td></tr>";
                }
            }
        }
    }
    if ($reposAtServer != null) {
        foreach ($reposAtServer as $repo) {
            $result.= "<tr><td colspan=\"3\">E' stato creato un nuovo sito (" . $repo . ") <a id=\"co" . $repo . "\" href=\"svnwrp.php?n=" . $repo . "\" onclick=\"removeLink('" . $repo . "');\">Prendilo!</a></td></tr>";
        }
    }
    $result.="</table>        
    </form>";
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

function siteWorkInProgress($files) {
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
<td><input type=\"radio\" name=\"sites\" value=\"" . $file['id'] . "\"><a href=\"http://" . DOMAIN_URL_BASE . "/" . $file['nome'] . "\" target=\"_blank\">" . $file['nome'] . "</a></td></tr>
";
        }
        $result.="</table>
<input type=\"submit\" value=\"Prepara per la publicazione\">
</form>";
    }
    return $result;
}

function siteInTrasfering($files) {
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

function siteToBeTransfered($files) {
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

function siteToBePublished($files) {
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

function changeState($allSite) {
    if (count($allSite)) {
        $result = "<form method=\"post\" name=\"changestate\">"
                . "<select name=\"id\" >";
        foreach ($allSite as $site) {
            $result .= "<option value=\"" . $site['id'] . "\"\>" . $site['nome'] . "</option>";
        }
        $result .= "</select>";
        $result .= "<select name=\"status\" >";
        $result .= "<option value=\"" . STATUS_WORKING . "\"\>In Lavorazione</option>";
        $result .= "<option value=\"" . STATUS_TO_TRANSFER . "\"\>Da Trasferire</option>";
        $result .= "<option value=\"" . STATUS_TRASFERING . "\"\>In Trasferimento</option>";
        $result .= "<option value=\"" . STATUS_TO_INSTALL . "\"\>Da installare</option>";
        $result .= "<option value=\"" . STATUS_INSTALLED . "\"\>Installato</option>";
        $result .= "<option value=\"-1\"\>Elimina</option>";
        $result .= "</select>";
        if (DEBUG) {
            $result .= "<input type =\"checkbox\" name=\"dr\">Cancella anche la repository";
        }
        $result .= "<input type=\"submit\" value=\"cambia stato\">
    </form>";
        echo $result;
    }
}

function siteCompleted($files) {
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td colspan=\"2\">Siti completati</td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><a href=\"http://www." . $file['domainName'] . "." . $file['domain'] . "\" target=\"_blank\">" . $file['nome'] . "</a></td>
<td><img src=\"img/info.png\" id=\"" . $file['id'] . "\" class=\"info\"></td>
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
    \$old = array(\"http://" . DOMAIN_URL_BASE . "/" . $source . "\", \"http://" . DOMAIN_URL_BASE . "/master_easy\", \"http://" . DOMAIN_URL_BASE . "/mybpa\");
    \$new = \"http://www." . $config['domainName'] . "." . $config['domain'] . "\";
    \$mysqli = new mysqli(\"" . $config['hostdb'] . "\", \"" . $config['userName'] . "\", \"" . $config['password'] . "\", \"" . $config['newDb'] . "\");
    \$result = \$mysqli->query(\"SELECT ID, post_content FROM wp_posts WHERE post_type='lightbox_library'\");
    if (\$result != false) {
		while (\$row = mysqli_fetch_array(\$result)) {
			\$newString = str_replace('\/', '/', base64_decode(\$row['post_content']));
			\$newString = str_replace(\$old, \$new, \$newString);
		\$newString = str_replace('/', '\/',\$newString);
			\$cleaned = base64_encode(\$newString);
			\$updQuery = \"UPDATE wp_posts SET post_content='\" . \$cleaned . \"',post_content_filtered='\" . \$cleaned . \"' WHERE ID=\" . \$row['ID'];
			if (!(\$mysqli->query(\$updQuery)=== TRUE)){
				return false;
			}
		}
		\$mysqli->close();
		return true;
	}else {
		echo mysql_error();
		return false;
	}
}

function importDb() {
    \$result = false;
    if(file_exists(\"" . $sqlDumpFileName . ".sql\")){
            \$mysqli = new mysqli(\"" . $config['hostdb'] . "\", \"" . $config['userName'] . "\", \"" . $config['password'] . "\", \"" . $config['newDb'] . "\");
            if (\$mysqli->connect_errno) {
                printf(\"Connessione fallita: %s\", \$mysqli->connect_error);
                \$result = false;
            } else {
                \$sql = file_get_contents(\"" . $sqlDumpFileName . ".sql\");
                if (!mysqli_multi_query(\$mysqli,\$sql)) {
                    echo \"Impossibile importare il file " . $sqlDumpFileName . ".sql sul DB\";
                    \$result = false;
                } else {
                    \$result = true;
                }
          }
        } else {
            echo \"Il file " . $sqlDumpFileName . ".sql non esiste <br>\";
            \$result = false;
        }
    return \$result;
}

if (importDb()){
	sleep(1);
    if (changeNextGenOption()){
        \$isOk =true;
    }else{
        \$isOk =false; 
    }
}else{
    \$isOk =false; 
}


if (\$isOk){
    rename(\"wp-config.php\", \"wp-config-locale.php\");
    rename(\"wp-config-remote.php\", \"wp-config.php\");
    unlink(\".htaccess\");
    rename(\".htaccess-remote\", \".htaccess\");
    unlink(\"" . $sqlDumpFileName . ".sql\");
    unlink(\"db_" . $source . ".sql\");
    unlink(\"" . $source . "st.obj\");
    unlink(__FILE__);
    echo \"0\";
}else {
    echo \"Errore\";
}
?>";

    fwrite($fh, $stringData);
    fclose($fh);
    return $installerName;
}

?>
