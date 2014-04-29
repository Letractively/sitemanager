<?php

include_once("../config.php");
include_once("../SubversionWrapper.php");

$newSite = "paperino4";
//
//$useragent = "Mozilla Firefox";
//$ch = curl_init();
//$url = 'http://' . SVN_SERVER . '/create.php?r=' . $newSite;
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, SVN_USER . ":" . SVN_PASSWORD);
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//echo curl_exec($ch);
//curl_close($ch);

function esegui($command) {
    echo $command."<br>";
    echo shell_exec($command);
//    
//    if (substr(php_uname(), 0, 7) == "Windows") {
//        $WshShell = new COM("WScript.Shell");
//        $oExec = $WshShell->exec($command);
//    } else {
//        exec($command . " > /dev/null &", $output, $return_var);
//    }
}

$command = "svn co http://" . SVN_SERVER . "/svn/" . $newSite . " " . BASE_PATH . $newSite;
esegui($command);
$command = "svn add --force " . BASE_PATH . $newSite . "\* --auto-props --parents --depth infinity -q";
esegui($command);
$command = "svn commit " . BASE_PATH . $newSite . " -m \"ciao\"";
esegui($command);
?>
