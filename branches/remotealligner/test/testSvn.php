<?php

//TODO: non funziona anche se sembra di si: forse per il processo in background??

include_once("../config.php");
include_once("../SubversionWrapper.php");

$newSite = "uno";

$svnCli = new SubversionWrapper($newSite, SVN_USER, SVN_PASSWORD);
$svnCli->createRepo();
?>
