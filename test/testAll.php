<?php

include_once("../config.php");

function isSvnServerOnline() {
    $useragent = "Mozilla Firefox";
    $ch = curl_init();
    $url = 'http://' . SVN_SERVER . '/list.php?l=1';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, SVN_USER_ADMIN . ":" . SVN_PASSWORD_ADMIN);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_exec($ch);
    if (!curl_errno($ch)) {
        $info = curl_getinfo($ch);
        if ($info['http_code']) {
            $result = true;
        } else {
            echo "response code of SVN server not 200:</br>";
            print_r($info);
            $result = false;
        }
    } else {
        echo "error trying to call " . SVN_SERVER . " :</br>";
        echo curl_error($ch);
        $result = false;
    }
    curl_close($ch);
    return $result;
}

function canConnectToDb() {
    $handleDb = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    if (!$handleDb) {
        $result = false;
        echo "error trying connection to db " . MYSQL_HOST . " :</br>";
        echo mysql_error();
    } else {
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti`";
        mysql_query($sql);
        $err = mysql_error();
        if ($err != "") {
            echo "error trying connection to: " . DB_SITEMANAGER_NAME . " :</br>";
            echo $err;
            $result = false;
        } else {
            $result = true;
        }
    }
    mysql_close($handleDb);
    return $result;
}

function canTransferViaFtp() {
    $scriptFile = BASE_PATH . "sitemanager\\tmp\\testscript.txt";
    $dirTmp = BASE_PATH . "sitemanager\\tmp\\testdir";
    $fileTmp = $dirTmp . "\\tsfile.html";
    $string = "";
    for ($i = 0; $i <= (24 / 32); $i++) {
        $string .= md5(time() + rand(0, 99));
    }
    $max_start_index = (32 * $i) - 24;
    $random_string = substr($string, rand(0, $max_start_index), 24);

    if (mkdir($dirTmp, 0775)) {
        $hanOfTmp = fopen($fileTmp, "w");
        fwrite($hanOfTmp, $random_string);
        fclose($hanOfTmp);
    } else {
        $result = false;
        echo "Can not create dir</br>";
    }
    $scriptFileHandle = fopen($scriptFile, "w");
    $script = "open \"ftp://3416921@aruba.it:q8gztwmw@ftp.vubi.it/www.vubi.it/test/\"
option batch on 
option confirm off
synchronize remote \"" . $dirTmp . "\\\"
exit";
    fwrite($scriptFileHandle, $script);
    fclose($scriptFileHandle);

    $winScpPath = BASE_PATH . "sitemanager" . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "WinSCP.com";
    $command = $winScpPath . " /script=\"" . $scriptFile . "\"";

    if (substr(php_uname(), 0, 7) == "Windows") {
        $WshShell = new COM("WScript.Shell");
        $oExec = $WshShell->exec($command);
        $stdOut = $oExec->StdOut->ReadAll;
        $stdErr = $oExec->StdErr->ReadAll;
    } else {
        $result = false;
        echo "system seems not windows, don't know how to check";
    }
    if ($stdErr != "") {
        echo "error transfering file</br>";
        echo $stdErr . "</br>";
        echo $stdOut . "</br>";
        $result = false;
    } else {
        $tsFileContent = file_get_contents('http://www.vubi.it/test/tsfile.html');
        if ($tsFileContent != $random_string) {
            $result = false;
            echo "Error checking if transfer is ok</br>";
        } else {
            $result = true;
        }
    }
    if (file_exists($scriptFile)) {
        unlink($scriptFile);
        if (file_exists($fileTmp)) {
            unlink($fileTmp);
            rmdir($dirTmp);
        }
    }
    return $result;
}

if (isSvnServerOnline()) {
    echo "Subversion server is ok</br>";
}
if (canConnectToDb()) {
    echo "DB connection is ok</br>";
}
if (canTransferViaFtp()) {
    echo "FTP transfer is ok</br>";
}
