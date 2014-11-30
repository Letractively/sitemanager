<?php

include_once("../config.php");
include_once("../Site.php");
include_once("../SiteManager.php");

$nome = "ilcampanile";
$site = new Site(null);
$site->load(BASE_PATH . $nome . DIRECTORY_SEPARATOR . $nome . "st.obj");
$sm = new SiteManager();
$sm->setNome($nome);
$sm->insertNewCreatedSiteInDb(0, "");
$site->updateSite();

