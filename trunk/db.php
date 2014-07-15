<?php

if (isset($_POST['f']) && $_POST['f'] != "") {
    include_once("config.php");
    $mysqlImportFilename = "";
    $mysqlDatabaseNameNew = "";
    $repos = "";
    $username = "";
    $password = "";
    $directory = "";
    $filenameOfDump = "";
    if ($_POST['f'] === 'u') {
        $svn = new SubversionWrapper($repos, $username, $password);
        $svn->updateAll();
        $dbcloner = new DBCloner(null, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, $mysqlDatabaseNameNew, null, null);
        $dbcloner->setMysqlImportFilename($mysqlImportFilename);
        $dbcloner->importFile();
        $dbcloner->cleanAndClose();
    } else if ($_POST['f'] === 'c') {
        $dbcloner = new DBCloner(null, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, $mysqlDatabaseNameNew, null, null);
        $dbcloner->mysqldumpOfDb($directory, $filenameOfDump);
        $dbcloner->cleanAndClose();
        $svn = new SubversionWrapper($repos, $username, $password);
        $svn->committAll();
    }
}
?>
