<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$svnSiteManager = new SubversionWrapper("https://sitemanager.googlecode.com/svn/trunk", "", "");
$svnSiteManager->setRepos(__DIR__);
$svnSiteManager->updateAll();
