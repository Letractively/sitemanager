<?php

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

    private function deleteFolder($dir) {
        echo "cancella la cartella non l'ho fatta";
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
    
    public function deleteRepo(){
        if ($this->nome === null) {
            $site = $this->getSiteById();
            $this->nome = $site['nome'];
        }
         $svnCli = new SubversionWrapper($this->nome, SVN_USER, SVN_PASSWORD);
         echo "commentato il codice, sei sicuro?! cambia e vai!";
//         $svnCli->deleteRepo();
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
        if (!mysql_query($sql, $con)) {
            echo "Could not update in db ";
            mysql_close($con);
            return false;
        }
        mysql_close($con);
        return true;
    }

    public function deleteDbOfSite() {
        if ($this->nome === null) {
            $site = $this->getSiteById();
            $this->nome = $site['nome'];
        }
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysqladmin\" --host=" . MYSQL_HOST . " --user=" . MYSQL_USER_NAME . " --password=" . MYSQL_PASSWORD . "DROP db_" . $this->nome;
        if (DEBUG) {
            echo "<br/>" . $command . "<br/>";
        }
        exec($command, $output, $worked);
        if ($worked == 1) {
            $this->errormsg .= "<br/>Impossibile eliminare il DB db_" . $this->nome . " " . mysql_error();
            return false;
        }
    }

}
