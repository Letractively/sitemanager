<?php
include_once("../config.php");
include_once("../DBCloner.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$nomeSitoLocale = "lucianamaglio";
$nomesitoRemoto = "http://www.lucianamaglio.it";
$mysqlDatabaseName = "db_".$nomeSitoLocale;
$mysqlDatabaseNameNew ="168.32.42.32";
$nomeFile ="buttami".$nomeSitoLocale.".sql";

$db = new DBCloner("db_" . $nomeSitoLocale, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $nomeSitoLocale, $nomesitoRemoto);

$db->setDestName($nomesitoRemoto);
$db->setSourcename($nomeSitoLocale);
$db->setMysqlDatabaseName($mysqlDatabaseName);
$db->setMysqlDatabaseNameNew($mysqlDatabaseNameNew);

$db->migrateDbFiles($nomeFile, false);
if (filesize(BASE_PATH.$nomeSitoLocale.DIRECTORY_SEPARATOR.$nomeFile)>100){
    echo "TEST ok";
}else {
    echo "Sembra non essere stato scritto il file del DB.Ecco quello che c'è nel contenuto</br></br>";
    $fileCont = file_get_contents(BASE_PATH.$nomeSitoLocale.DIRECTORY_SEPARATOR.$nomeFile);
    echo "[".$fileCont."]";
}
unlink(BASE_PATH.$nomeSitoLocale.DIRECTORY_SEPARATOR.$nomeFile);
?>