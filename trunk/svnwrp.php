<?php

if (isset($_GET['id']) && $_GET['id'] != "") {
    include_once("config.php");
    $siteData = getSiteById($_GET['id']);
    $svnCli = new SubversionWrapper($siteData['nome'], SVN_USER, SVN_PASSWORD);
    $db = new DBCloner("db_" . $siteData['nome'], MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $siteData['nome'], $siteData['nome'], null);
    if (isset($_GET['f']) && $_GET['f'] == "c") {
        $db->mysqldumpOfDb(BASE_PATH . $siteData['nome'] . DIRECTORY_SEPARATOR, "db_" . $siteData['nome'] . ".sql");
        $svnCli->committAll("update");
    } else if (isset($_GET['f']) && $_GET['f'] == "u") {
        $svnCli->updateAll();
        $db->setMysqlImportFilename("db_" . $siteData['nome'] . ".sql");
        $db->importFile();
    }
} else if (isset($_GET['n']) && $_GET['n'] != "") {
    include_once("config.php");
    $name = $_GET['n'];
    insertNewCreatedSiteInDb($name, 0, "");
    mkdir(BASE_PATH.$name);
    $svnCli = new SubversionWrapper($name, SVN_USER, SVN_PASSWORD);
    $svnCli->checkout();
    $db = new DBCloner("db_" . $name, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $name, $name, null);
    $db->createDb();
    $db->setMysqlImportFilename(BASE_PATH.$name.DIRECTORY_SEPARATOR."db_" . $name . ".sql");
    $db->importFile();
}
header('Location: index.php');
?>
