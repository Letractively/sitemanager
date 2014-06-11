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
    header('Location: index.php');
}
?>
