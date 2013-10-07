<?php


define("BASE_PATH","D:\\wamp\\www\\");
define("BASE_PATH_RELEASE","D:\\wamp\\www\\release\\");
define("MYSQL_BIN_BASE_PATH","D:\\wamp\\bin\\mysql\\mysql5.1.36\\bin\\");
define("RELASE_BASE_PATH","D:\\wamp\\www\\release\\");
define("MYSQL_USER_NAME","root");
define("MYSQL_PASSWORD","");
define("MYSQL_HOST","localhost");
define("MASTER_SITE","master");
define("MASTER_DB","dbmaster");
define("MASTER_SITE_EASY","master_easy");
define("MASTER_DB_EASY","dbmastereasy");
define("DEBUG",true);
define("DB_SITEMANAGER_NAME","site_manager");

include_once("WPMigrateFile.php");
include_once("DBCloner.php");
include_once("WPMigrateFile.php");
include_once("FEfunction.php");
include_once("FtpUploader.php");
include_once("ProcessManager.php");

?>