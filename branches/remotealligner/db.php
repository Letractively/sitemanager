<?php
if (isset($_POST['f']) && $_POST['f'] = 'i') {
    include_once("config.php");
    $mysqlImportFilename = "";
    $mysqlDatabaseNameNew ="";
    $dbcloner = new DBCloner(null, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, $mysqlDatabaseNameNew, null, null);
    $dbcloner->setMysqlImportFilename($mysqlImportFilename);
    $dbcloner->importFile();
    $dbcloner->changeNextGenOption();
    $dbcloner->cleanAndClose();
}
?>
