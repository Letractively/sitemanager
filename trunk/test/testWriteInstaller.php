<?php
include_once("FEfunction.php");
include_once("config.php");


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$config['domainName']="pippo";
$config['domain']="it";
$config['hostdb'] = "10.20.30.40";
$config['userName'] = "pippodb";
$config['password'] = "plutopwd";
$config['newDb'] = "database";
$source = "ideagiardinosrlroma2";

writeInstaller($config, $source);
?>
