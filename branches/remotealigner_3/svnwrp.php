<?php

include_once("config.php");
include_once("Site.php");
include_once("SiteManager.php");
$sm = new SiteManager();


if (isset($_GET['id']) && $_GET['id'] != "") {
    $sm->setId($_GET['id']);
    $siteData = $sm->getSiteById();
    $site = new Site($siteData);
    $svnCli = new SubversionWrapper($site->getNome(), SVN_USER, SVN_PASSWORD);
    $db = new DBCloner("db_" . $site->getNome(), MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $site->getNome(), $siteData['nome'], null);
    if (isset($_GET['f']) && $_GET['f'] == "c") {
        $site->save(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . $site->getNome() . "st.obj");
        $db->mysqldumpOfDb(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR, "db_" . $site->getNome() . ".sql");
        $svnCli->committAll("[" . date("j-m-Y G:i") . "] update");
    } else if (isset($_GET['f']) && $_GET['f'] == "u") {
        $svnCli->updateAll();
        $db->setMysqlImportFilename(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . "db_" . $siteData['nome'] . ".sql");
        $db->importFile(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . $site->getNome() . "st.obj");
        $site->load(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . $site->getNome() . "st.obj");
        $site->updateSite();
    }
} else if (isset($_GET['n']) && $_GET['n'] != "") {
    $name = $_GET['n'];
    $site = new Site(null);
    $sm->setNome($name);
    mkdir(BASE_PATH . $name);
    $svnCli = new SubversionWrapper($name, SVN_USER, SVN_PASSWORD);
    $svnCli->checkout();
    $db = new DBCloner("db_" . $name, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $name, $name, null);
    $db->createDb();
    $db->setMysqlImportFilename(BASE_PATH . $name . DIRECTORY_SEPARATOR . "db_" . $name . ".sql");
    $db->importFile();
    $site->load(BASE_PATH . $name . DIRECTORY_SEPARATOR . $name . "st.obj");
    $sm->insertNewCreatedSiteInDb(0, "");
    $site->updateSite();
}
if (!DEBUG) {
    header('Location: index.php');
}
?>
