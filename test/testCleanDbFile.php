<?php
include_once("../config.php");
include_once("../DBCloner.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$nomeSitoLocale = "mybpa";
$nomesitoRemoto = "myvubi";
$nomeFile ="D:\wamp\www\myvubi\db_myvubi.sql";

$db = new DBCloner("db_" . $nomeSitoLocale, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $nomeSitoLocale, $nomesitoRemoto);
$db->migrateDbFiles($nomeFile);
$db->setMysqlImportFilename($nomeFile);
$db->importFile();

?>
