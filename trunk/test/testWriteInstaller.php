<?php
include_once("../FEfunction.php");
include_once("../config.php");


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$config['domainName']="meloshpub";
$config['domain']="it/testme";
$config['hostdb'] = "62.149.150.187";
$config['userName'] = "Sql656671";
$config['password'] = "c5f0f8d1";
$config['newDb'] = "Sql656671_2";
$source = "ideagiardinosrlroma2";

writeInstaller($config, $source);
?>
