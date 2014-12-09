<?php


include_once("../config.php");
include_once("../SubversionWrapper.php");
include_once("../SiteManager.php");


$newSite = "toptest";
$sm = new SiteManager();
$svnCli = new SubversionWrapper($newSite, SVN_USER, SVN_PASSWORD);
$svnCli->committAll("first import",666,$sm);
?>
