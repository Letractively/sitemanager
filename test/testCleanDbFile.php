<?php
include_once("../config.php");
include_once("../DBCloner.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$nomeSitoLocale = "latuaformafisica";
$nomesitoRemoto = "http://www.latuaformafisica.it";
$nomeFile ="D:\wamp\www\latuaformafisica\db_latuaformafisica.sql";

$db = new DBCloner("db_" . $nomeSitoLocale, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $nomeSitoLocale, $nomesitoRemoto);
$db->migrateDbFiles($nomeFile,false);


?>
