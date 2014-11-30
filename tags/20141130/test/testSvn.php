<?php


include_once("../config.php");
include_once("../SubversionWrapper.php");

$newSite = "toptest";

$svnCli = new SubversionWrapper($newSite, SVN_USER, SVN_PASSWORD);
$svnCli->committAll("first import",666);
?>
