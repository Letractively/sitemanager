<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../SiteManager.php");
include_once("../config.php");

$sm = new SiteManager();
$sm->setNome("questoeditest");
$sm->insertNewCreatedSiteInDb(null, "");
echo "[".$sm->getId()."]";