<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('SubversionWrapper.php');
include_once('config.php');

$svnSiteManager = new SubversionWrapper("https://sitemanager.googlecode.com/svn/trunk", "", "");
$svnSiteManager->setRepos(basename(__DIR__));
$svnSiteManager->updateAll();
$sql = "DESCRIBE site_manager.sm_prodotti;";
$db = new DBConfig(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
$con = $db->connect();
$castresult = mysql_query($sql, $con) or die(mysql_error());
while ($row = mysql_fetch_assoc($castresult)) {
    if ($row['Field'] == 'nome') {
        if ($row['Key'] != 'MUL') {
            $sql = "ALTER TABLE `sm_prodotti` ADD INDEX ( `nome` ) ;
ALTER TABLE `sm_prodotti` ADD UNIQUE (
`nome`
);";
            mysql_query($sql, $con);            
            break;
        }
    }
}
if (!$svnSiteManager->getHasError()) {
    header("Location: index.php");
}    