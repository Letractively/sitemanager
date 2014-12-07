<?php

include_once("config.php");
include_once("Site.php");
include_once("SiteManager.php");
$sm = new SiteManager();

$svnCli = new SubversionWrapper(null, SVN_USER, SVN_PASSWORD);

if (isset($_GET['id']) && $_GET['id'] != "") {
    $sm->setId($_GET['id']);
    $siteData = $sm->getSiteById();
    $site = new Site($siteData);
    $svnCli->setRepos($site->getNome());
    $db = new DBCloner("db_" . $site->getNome(), MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $site->getNome(), $siteData['nome'], null);
    if (isset($_GET['f']) && $_GET['f'] == "c") {
        $site->save(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . $site->getNome() . "st.obj");
        $db->mysqldumpOfDb(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR, "db_" . $site->getNome() . ".sql");
        $svnCli->committAll("[" . date("j-m-Y G:i") . "] update", $site->getId(), $sm);
    } else if (isset($_GET['f']) && $_GET['f'] == "u") {
        $svnCli->updateAll();
        $db->setMysqlImportFilename(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . "db_" . $siteData['nome'] . ".sql");
        $db->importFile();
        $site->load(BASE_PATH . $site->getNome() . DIRECTORY_SEPARATOR . $site->getNome() . "st.obj");
        $sm->updateSite($site);
    }
} else if (isset($_GET['n']) && $_GET['n'] != "") {
    $name = $_GET['n'];
    $site = new Site(null);
    $sm->setNome($name);
    if(!file_exists(BASE_PATH . $name) || !is_dir(BASE_PATH . $name)) {
        mkdir(BASE_PATH . $name);
    }
    $svnCli->setRepos($name);
    $svnCli->checkout();
    $db = new DBCloner("db_" . $name, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $name, $name, null);
    $db->createDb();
    $db->setMysqlImportFilename(BASE_PATH . $name . DIRECTORY_SEPARATOR . "db_" . $name . ".sql");
    $db->importFile();
    $site->load(BASE_PATH . $name . DIRECTORY_SEPARATOR . $name . "st.obj");
    $sm->insertNewCreatedSiteInDb(null, "");
    $sm->updateSite($site);
}
if (!$svnCli->getHasError() && !DEBUG) {
    header('Location: index.php');
}
?>
