<?php

include("Site.php");
include_once("WPMigrateFile.php");
include_once("DBCloner.php");
include_once("TestConfiguration.php");
include_once("HtAccessMigrate.php");
include_once("config.php");


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
    private $con;

    function __construct() {
        $this->con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    }

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
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` WHERE id = " . $this->id;
        $castresult = mysql_query($sql) or die(mysql_error());
        return mysql_fetch_array($castresult, MYSQL_ASSOC);
    }

    public function deleteSiteFromDb() {
        $sql = "DELETE FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` WHERE id = " . $this->id;
        mysql_query($sql) or die(mysql_error());
    }

    public function updateStatusForDomainForId($status) {
        $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        status = " . $status . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id ='" . $this->id . "';";
        if (DEBUG) {
            echo $sql . "</br>";
        }
        if (!mysql_query($sql, $con)) {
            echo "Could not update in db " . mysql_error();
            return false;
        }
        return true;
    }

    public function getAllDbProcessRunning() {
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_processrunning`";
        $castresult = mysql_query($sql) or die(mysql_error());
        while ($row = mysql_fetch_assoc($castresult)) {
            $dbProcess[] = $row;
        }
        return $dbProcess;
    }

    public function getAllSiteFromProcess($procDatas) {
        $siteToInstall = null;
        foreach ($procDatas as $entry) {
            $this->setId($entry['id_site']);
            $siteToInstall[] = $this->getSiteById();
        }
        return $siteToInstall;
    }

    public function moveSiteStateTransfered($toBeUpdated) {
        $siteToInstall = null;
        foreach ($toBeUpdated as $entry) {
            if (file_exists($entry['file'])) {
                unlink($entry['file']);
            }
            $this->setId($entry['id_site']);
            $siteDataAsArray = $this->getSiteById();
            $siteToInstall[] = $siteDataAsArray;
            $siteInAnalysis = new Site($siteDataAsArray);
            $siteInAnalysis->setStatus(STATUS_TO_INSTALL);
            $this->udpateForSite($siteInAnalysis);
        }
        return $siteToInstall;
    }

    public function udpateForSite($site) {
        if ($site != null && is_a($site, "Site")) {
            $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        nome = " . $site->getNome() . ",
        cliente_id = " . $site->getCliente_id() . ",
        modello_id = " . $site->getModello_id() . ",
        data_acquisto = " . $site->getData_acquisto() . ",
        ref_mail = " . $site->getRef_mail() . ",
        ftp_host = " . $site->getFtp_host() . ",
        ftp_pwd = " . $site->getFtp_pwd() . ",
        ftp_username = " . $site->getFtp_username() . ",
        db = " . $site->getDb() . ",
        dbusername = " . $site->getDbusername() . ",
        dbpwd = " . $site->getDbpwd() . ",
        db = " . $site->getDb() . ",
        hostdb = " . $site->getHostdb() . ",
        domainName = " . $site->getDomainName() . ",
        domain = " . $site->getDomain() . ",
        status = " . $site->getStatus() . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.nome ='" . $site->getNome() . "';";
            if (!mysql_query($sql, $con)) {
                echo "Could not update in db ";
                return false;
            }
            return true;
        }
    }

    public function getAllSite() {
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` ORDER BY upd DESC";
        $castresult = mysql_query($sql) or die(mysql_error());
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
        $sql = 'DROP DATABASE db_' . $this->nome;
        $retval = mysql_query($sql, $this->conn);
        if (!$retval) {
            die('Could not delete database: ' . mysql_error());
        }
        if (DEBUG) {
            echo "Database db_" . $this->nome . " deleted successfully\n";
        }
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
        $sql = "REPLACE INTO `" . DB_SITEMANAGER_NAME . "`.`sm_prodotti` (`id`, `nome`, `cliente_id`, `modello_id`, `ins`, `upd`) VALUES ('', '" . $this->nome . "', ' " . $clientId . "', '" . $source . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "');";
        if (!mysql_query($sql, $con)) {
            $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
            return false;
        }
        return true;
    }

    function updateStatusSiteInDb($id, $data) {
        $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        data_acquisto = '" . $data['dataacqui'] . "',
        ref_mail = '" . $data['email'] . "',
        ftp_host = '" . $data['ftphost'] . "',
        ftp_username = '" . $data['ftpusername'] . "',
        ftp_pwd = '" . $data['ftppwd'] . "',
        db = '" . $data['newDb'] . "',
        dbusername = '" . $data['userName'] . "',
        dbpwd = '" . $data['password'] . "',
        hostdb = '" . $data['hostdb'] . "',
        domain = '" . $data['domain'] . "',
        domainName = '" . $data['domainName'] . "',
        status = '1',
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id =" . $id . ";";
        if (!mysql_query($sql, $this->con)) {
            echo "Could not insert in db ";
            return false;
        }
        return true;
    }

    function deleteEntry($id) {
        $sql = "DELETE from " . DB_SITEMANAGER_NAME . ".sm_processrunning WHERE sm_processrunning.id ='" . $id . "';";
        if (!mysql_query($sql, $this->con)) {
            echo "Could not delete in db ";
            return false;
        }
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
        $svn->committAll("First import", $this->id);
        return true;
    }

}
