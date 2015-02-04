<?php

include_once("../TestConfiguration.php");
include_once("../config.php");


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config['domainName'] = "vubi";
$config['domain'] = "it";
$config['hostdb'] = "62.149.150.185";
$config['userName'] = "Sql647423";
$config['password'] = "7f348c4d";
$config['newDb'] = "Sql647423_1";
$config['ftpUsername'] = "3416921@aruba.it";
$config['ftpPassword'] = "q8gztwmw";
$config['ftpHost'] = "ftp." . $config['domainName'] . "." . $config['domain'];
$source = "vubiweb";

$testConfiguration = new TestConfiguration($source, $config);
if (!$testConfiguration->isConfigOk()) {
    echo $testConfiguration->getErrorDescription();
}else {
    echo "test Ok";
}
?>

