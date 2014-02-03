<?php
include_once("../config.php");
include_once("../DBCloner.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$nomeSitoLocale = "ideagiardinosrlroma2";
$nomesitoRemoto = "http://www.meloshpub.it/testme";
$nomeFile ="C:\Users\Miro\Documents\Desktop\db_ideagiardinosrlroma2.sql";

$db = new DBCloner("db_" . $nomeSitoLocale, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $nomeSitoLocale, $nomesitoRemoto);
$db->migrateDbFiles($nomeFile,false);


?>
