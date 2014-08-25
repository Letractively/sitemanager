<?php

include("Site.php");
include_once("WPMigrateFile.php");
include_once("DBCloner.php");
include_once("TestConfiguration.php");
include_once("HtAccessMigrate.php");


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteManager
 *
 * @author Miro
 */
class SiteManager {

    public $id;
    public $nome = null;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    private function deleteFolder($path) {
        if (file_exists($path) && is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $file) {
                $this->deleteFolder(realpath($path) . '/' . $file);
            }
            return rmdir($path);
        } else if (file_exists($path) && is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }

    public function deleteSite() {
        set_time_limit(PHP_INT_MAX);
        if ($this->nome === null) {
            $site = $this->getSiteById();
            $this->nome = $site['nome'];
        }
        $this->deleteFolder(BASE_PATH . $this->nome);
        $this->deleteSiteFromDb();
        $this->deleteDbOfSite();
    }

    public function deleteRepo() {
        if ($this->nome === null) {
            $site = $this->getSiteById();
            $this->nome = $site['nome'];
        }
        $svnCli = new SubversionWrapper($this->nome, SVN_USER, SVN_PASSWORD);
        $svnCli->deleteRepo();
    }

    public function getSiteById() {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` WHERE id = " . $this->id;
        $castresult = mysql_query($sql) or die(mysql_error());
        mysql_close($con);
        return mysql_fetch_array($castresult, MYSQL_ASSOC);
    }

    public function deleteSiteFromDb() {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "DELETE FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` WHERE id = " . $this->id;
        mysql_query($sql) or die(mysql_error());
        mysql_close($con);
    }

    public function updateStatusForDomainForId($status) {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        status = " . $status . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id ='" . $this->id . "';";
        if (DEBUG) {
            echo $sql . "</br>";
        }
        if (!mysql_query($sql, $con)) {
            echo "Could not update in db " . mysql_error();
            mysql_close($con);
            return false;
        }
        mysql_close($con);
        return true;
    }

    public function udpateForSite($site) {
        if ($site != null && is_a($site, "Site")) {
            $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
            $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        nome = " . $site->getNome() . ",
        cliente_id = " . $site->getCliente_id() . ",
        modello_id = " . $site->getModello_id() . ",
        data_acquisto = " . $site->getData_acquisto() . ",
        ref_mail = " . $site->getRef_mail() . ",
        ftp_host = " . $site->getFtp_host() . ",
        ftp_pwd = " . $site->getFtp_pwd() . ",
        ftp_username = " . $site->getFtp_usrname() . ",
        db = " . $site->getDb() . ",
        dbusername = " . $site->getDbusername() . ",
        dbpwd = " . $site->getDbpwd() . ",
        db = " . $site->getDb() . ",
        hostdb = " . $site->getHostb() . ",
        domainName = " . $site->getDomainName() . ",
        domain = " . $site->getDomain() . ",
        status = " . $site->getStatus() . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.nome ='" . $site->getNome() . "';";
            if (!mysql_query($sql, $con)) {
                echo "Could not update in db ";
                mysql_close($con);
                return false;
            }
            mysql_close($con);
            return true;
        }
    }

    public function getAllSite() {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` ORDER BY upd DESC";
        $castresult = mysql_query($sql) or die(mysql_error());
        mysql_close($con);
        $rows = null;
        while ($row = mysql_fetch_array($castresult)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function filterByState($sites, $status) {
        $result = null;
        if ($sites != null) {
            foreach ($sites as $site) {
                if ($site['status'] == $status) {
                    $result[] = $site;
                }
            }
        }
        return $result;
    }

    public function deleteDbOfSite() {
        if ($this->nome === null) {
            $site = $this->getSiteById();
            $this->nome = $site['nome'];
        }
        $conn = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = 'DROP DATABASE db_' . $this->nome;
        $retval = mysql_query($sql, $conn);
        if (!$retval) {
            die('Could not delete database: ' . mysql_error());
        }
        if (DEBUG) {
            echo "Database db_" . $this->nome . " deleted successfully\n";
        }
        mysql_close($conn);
    }

    /**
     * insert in DB the entry for the new created site
     *
     * @param type $newSite: the name of the new site
     * @param type $clientId: this is the id of a client
     * @param type $source : this is the name of the master that are used for this entry
     * @return boolean
     */
    public function insertNewCreatedSiteInDb($clientId, $source) {
        if ($this->nome === null) {
            $site = $this->getSiteById();
            $this->nome = $site['nome'];
        }
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "REPLACE INTO `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` (`id`, `nome`, `cliente_id`, `modello_id`, `ins`, `upd`) VALUES ('', '" . $this->nome . "', ' " . $clientId . "', '" . $source . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "');";
        if (!mysql_query($sql, $con)) {
            $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
            mysql_close($con);
            return false;
        }
        mysql_close($con);
        return true;
    }

    /**
     * Create a new wp-config file
     * @param type name of the site to move
     * @param type array of config valuewhos keys are:,  newDb,userName,password,hostdb,domain,domainName
     *
     * Example:
     * $input['newDb'] = "arubadb1";
     * $input['userName'] = "sdfdfgjewroigt";
     * $input['password'] = "aruba password";
     * $input['hostdb'] = "192.34.35.354";
     * $input['domain'] = "com";
     * $input['domainName'] = "centro-estetocpbuetyansdusun";
     *
     */
    function moveToRelease($id, $source, $newConfig) {
        $testConfiguration = new TestConfiguration($source, $newConfig);
        if ($testConfiguration->isConfigOk()) {
            $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $source);
            $fileCloner->createReleaseConfigAndBckpLocal($newConfig);
            $fileCloner->switchConfigFile("wp-config-locale.php", "wp-config-remote.php");
            $dbCloner = new DBCloner("db_" . $source, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $source, "http://www." . $newConfig['domainName'] . "." . $newConfig['domain']);
            $exportFileName = str_replace("/", ".", $newConfig['domainName'] . "." . $newConfig['domain'] . ".sql");
            $fileToMove[] = $dbCloner->exportDbToPath($exportFileName, false);
            $archiveFile = BASE_PATH . $source . DIRECTORY_SEPARATOR . $source . ".zip";
            $fileToMove[] = $archiveFile;
            $htaAcces = new HtAccessMigrate("http://www." . $newConfig['domainName'] . "." . $newConfig['domain'], $source);
            $htaAcces->changeHtAccess(false);
            $fileToMove[] = $htaAcces->getFileName();
            $fileToMove[] = writeInstaller($newConfig, $source);
            return updateStatusSiteInDb($id, $newConfig);
        } else {
            echo $testConfiguration->getErrorDescription();
            return false;
        }
    }

    /**
     * Do all the migration of files and DB entry for a Word press site
     *
     * @param type $source
     * @param type $newSite
     * @param type $mysqlDatabaseName
     * @return boolean
     */
    public function migrate($source, $newSite, $mysqlDatabaseName) {
        $this->nome = $newSite;
        set_time_limit(60000);
        $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $this->nome);
        if (!$fileCloner->cloneSite()) {
            echo $fileCloner->errorMsg . "</br>";
            return false;
        }
        $fileCloner->changeWpconfig($mysqlDatabaseName, "db_" . $this->nome);
        $htaAcces = new HtAccessMigrate($this->nome, $source);
        $htaAcces->changeHtAccess(true);
        $dbCloner = new DBCloner($mysqlDatabaseName, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $newSite, $source, $newSite);
        if (!$dbCloner->migrate(true)) {
            echo $dbCloner->errormsg . "</br>";
            return false;
        }
        if (!DEBUG) {
            $dbCloner->cleanAndClose();
        }
        $this->insertNewCreatedSiteInDb(null, $source);
        $svn = new SubversionWrapper($this->nome, SVN_USER, SVN_PASSWORD);
        $svn->createRepo();
        $svn->committAll("First import");
        return true;
    }

}
