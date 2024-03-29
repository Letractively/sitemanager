<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        $configFileName = 'config.php';
        if (!file_exists($configFileName)) {
            if (isset($_POST['basePath']) &&
                    isset($_POST['domain']) &&
                    isset($_POST['mysqlPath']) &&
                    isset($_POST['mysqlUsername']) &&
                    isset($_POST['mysqlPwd']) &&
                    isset($_POST['mysqlHost']) &&
                    isset($_POST['svnHost']) &&
                    isset($_POST['svnUser']) &&
                    isset($_POST['svnPwd'])) {
                $fp = fopen($configFileName, 'w');
                $configString = "<?php
define(\"BASE_PATH\",\"" . str_replace("\\", "\\\\", $_POST['basePath']) . "\");
define(\"DOMAIN_URL_BASE\",\"" . $_POST['domain'] . "\");
define(\"MYSQL_BIN_BASE_PATH\",\"" . str_replace("\\", "\\\\", $_POST['mysqlPath']) . "\");
define(\"MYSQL_USER_NAME\",\"" . $_POST['mysqlUsername'] . "\");
define(\"MYSQL_PASSWORD\",\"" . $_POST['mysqlPwd'] . "\");
define(\"MYSQL_HOST\",\"" . $_POST['mysqlHost'] . "\");
define(\"DEBUG\",false);
define(\"DB_SITEMANAGER_NAME\",\"site_manager\");
define(\"STATUS_WORKING\",0);
define(\"STATUS_TO_TRANSFER\",1);
define(\"STATUS_TRASFERING\",2);
define(\"STATUS_TO_INSTALL\",3);
define(\"STATUS_INSTALLED\",4);

define(\"SVN_SERVER\",\"" . $_POST['svnHost'] . "\");
define(\"SVN_USER\",\"" . $_POST['svnUser'] . "\");
define(\"SVN_PASSWORD\",\"" . $_POST['svnPwd'] . "\");
define(\"SVN_USER_ADMIN\",\"" . $_POST['svnUser'] . "\");
define(\"SVN_PASSWORD_ADMIN\",\"" . $_POST['svnPwd'] . "\");


include_once(\"FEfunction.php\");
?>
";
                fwrite($fp, $configString);
                fclose($fp);
                $queryPR = "
CREATE TABLE IF NOT EXISTS `sm_processrunning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_site` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `date_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `script_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
                $queryPROD = "CREATE TABLE IF NOT EXISTS `sm_prodotti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(512) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `nome` (`nome`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

                $con = mysql_connect($_POST['mysqlHost'], $_POST['mysqlUsername'], $_POST['mysqlPwd']);
                if (!mysql_select_db('site_manager')) {
                    mysql_query('CREATE DATABASE site_manager');
                    mysql_select_db('site_manager');
                }
                if (!mysql_query($queryPR, $con)) {
                    echo "Could not execute creation query. ERROR [" . mysql_error() . "]";
                } else {
                    if (!mysql_query($queryPROD, $con)) {
                        echo "Could not execute creation query. ERROR [" . mysql_error() . "]";
                    } else {
                        header("Location: index.php");
                    }
                }
            } else {
                $basePath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
                $startWampName = strrpos($basePath, "wamp" . DIRECTORY_SEPARATOR);
                $mysqlsPath = substr($basePath, 0, $startWampName + 5) . "bin" . DIRECTORY_SEPARATOR . "mysql" . DIRECTORY_SEPARATOR;
                ?>
                <form method="post" name="configform" id="configform">
                    Path Base
                    <div><input type="text" name="basePath"  class="tcal"  value="<?php echo $basePath ?>"></div>
                    Domain
                    <div><input type="text" name="domain"  class="tcal"  value="localhost"></div>
                    Mysql path value
                    <div>
                        <?php
                        $mySqlVersions = glob($mysqlsPath . "mysql*");
                        $numb = count($mySqlVersions);
                        if ($numb > 0) {
                            echo "<select name=\"mysqlPath\" form=\"configform\">\n";
                            foreach ($mySqlVersions as $ver) {
                                echo "<option value=\"" . $ver . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "\">" . $ver . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "</option>\n";
                            }
                            echo "</select>";
                        } else {
                            echo "<input type=\"text\" name=\"mysqlPath\"  class=\"tcal\"  value=\"\">\n";
                        }
                        ?>
                    </div>    
                    Mysql username
                    <div><input type="text" name="mysqlUsername"  class="tcal"  value="root"></div>
                    Mysql password
                    <div><input type="text" name="mysqlPwd"  class="tcal"  value=""></div>
                    Mysql host
                    <div><input type="text" name="mysqlHost"  class="tcal"  value="localhost"></div>
                    SVN server
                    <div><input type="text" name="svnHost"  class="tcal"  value="mirobarsa.duckdns.org"></div>
                    SVN user
                    <div><input type="text" name="svnUser"  class="tcal"  value=""></div>
                    SVN password
                    <div><input type="text" name="svnPwd"  class="tcal"  value=""></div>
                    <input type="submit" value="crea">
                </form>
                <?php
            }
        }else {
            echo "<p>File di configurazione già presente</p>";
            echo "<a href=\"index.php\">Home</a>";
        }
        ?>
    </body>
</html>
