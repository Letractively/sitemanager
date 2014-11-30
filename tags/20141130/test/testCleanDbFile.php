<?php
include_once("../config.php");
include_once("../DBCloner.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$nomeSitoLocale = "www.esteticaclv.com/";
$nomesitoRemoto = "localhost/cestlavie/";
$nomeFile ="C:\Users\Miro\Documents\Desktop\Sql663568_1.sql";

$db = new DBCloner("db_" . $nomeSitoLocale, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $nomeSitoLocale, $nomesitoRemoto);
$db->migrateDbFiles($nomeFile,true);

?>
