<?php
include_once("../config.php");
include_once("../SubversionWrapper.php");

$newSite = "vubiweb";
$svnCli = new SubversionWrapper($newSite, SVN_USER, SVN_PASSWORD);
$svnCli->status();
?>

