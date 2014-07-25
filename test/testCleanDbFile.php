<?php
include_once("../config.php");
include_once("../DBCloner.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$nomeSitoLocale = "lucianamaglio";
$nomesitoRemoto = "http://www.lucianamaglio.it";
$nomeFile ="C:\Users\mbarsocchi\Desktop\lucianamaglio\db_lucianamaglio.sql";

$db = new DBCloner("db_" . $nomeSitoLocale, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $nomeSitoLocale, $nomesitoRemoto);
$db->migrateDbFiles($nomeFile,false);

?>
