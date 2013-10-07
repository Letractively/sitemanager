<?php

$configFileName = 'config.php';

if (!file_exists($configFileName)) {
    $fp = fopen($configFileName, 'w');
    $configString = "<?php
define(\"BASE_PATH\",\"D:\\wamp\\www\\\");
define(\"BASE_PATH_RELEASE\",\"D:\\wamp\\www\\release\\\");
define(\"MYSQL_BIN_BASE_PATH\",\"D:\\wamp\\bin\\mysql\\mysql5.1.36\\bin\\\");
define(\"RELASE_BASE_PATH\",\"D:\\wamp\\www\\release\\\");
define(\"MYSQL_USER_NAME\",\"root\");
define(\"MYSQL_PASSWORD\",\"\");
define(\"MYSQL_HOST\",\"localhost\");
define(\"MASTER_SITE\",\"master\");
define(\"MASTER_DB\",\"dbmaster\");
define(\"MASTER_SITE_EASY\",\"master_easy\");
define(\"MASTER_DB_EASY\",\"dbmastereasy\");
define(\"DEBUG\",false);
define(\"DB_SITEMANAGER_NAME\",\"site_manager\");

include_once(\"WPMigrateFile.php\");
include_once(\"DBCloner.php\");
include_once(\"WPMigrateFile.php\");
include_once(\"FEfunction.php\");

?>";
    fwrite($fp, $configString);
    fclose($fp);
} else {
    include_once($configFileName);
    $query = "CREATE TABLE IF NOT EXISTS `sm_processrunning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` text NOT NULL,
  `pid` int(11) NOT NULL,
  `date_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sm_prodotti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `modello_id` text NOT NULL,
  `data_acquisto` date DEFAULT NULL,
  `ref_mail` text NOT NULL,
  `ftp_host` text NOT NULL,
  `ftp_username` text NOT NULL,
  `ftp_pwd` text NOT NULL,
  `db` text NOT NULL,
  `dbusername` text NOT NULL,
  `dbpwd` text NOT NULL,
  `hostdb` text NOT NULL,
  `domainName` text NOT NULL,
  `domain` text NOT NULL,
  `status` int(11) NOT NULL,
  `ins` timestamp NULL DEFAULT NULL,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
    
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD, DB_SITEMANAGER_NAME);
    mysql_query($query, $con);
}
?>
