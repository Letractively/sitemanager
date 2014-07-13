<?php
include_once("Executer.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FtpUploader
 *
 * @author Miro
 */
class FtpUploader {

    public $ftpUsername;
    public $ftpPassword;
    public $ftpHost;
    public $scriptFile;
    public $pid;
    public $id_site;

    function __construct($ftpUsername, $ftpPassword, $ftpHost) {
        $this->ftpUsername = $ftpUsername;
        $this->ftpPassword = $ftpPassword;
        $this->ftpHost = $ftpHost;
    }

    public function getScriptFile() {
        return $this->scriptFile;
    }

    public function getPid() {
        return $this->pid;
    }

    public function getFtpUsername() {
        return $this->ftpUsername;
    }

    public function setFtpUsername($ftpUsername) {
        $this->ftpUsername = $ftpUsername;
    }

    public function getFtpPassword() {
        return $this->ftpPassword;
    }

    public function setFtpPassword($ftpPassword) {
        $this->ftpPassword = $ftpPassword;
    }

    public function getFtpHost() {
        return $this->ftpHost;
    }

    public function setFtpHost($ftpHost) {
        $this->ftpHost = $ftpHost;
    }

    public function setId_site($id_site) {
        $this->id_site = $id_site;
    }

    function uploadUsingScript($background = false) {
        $winScpPath = __DIR__ . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "WinSCP.com";
        $command = $winScpPath . " /script=\"" . $this->scriptFile . "\"";
        if (DEBUG) {
            echo $command . "</br>";
        }
        $ex = new Executer();
        $ex->execute($command,$background);
        if (count($ex->getOutput())>0) {
            print_r($ex->getOutput());
        }
        if ($this->insertProcessRunning()) {
            header('Location: index.php');
        }
    }

    function insertProcessRunning() {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "INSERT INTO `" . DB_SITEMANAGER_NAME . "`.`sm_processrunning` 
(`id`,`id_site`,`pid`,`script_name`) 
VALUES
(NULL," . $this->id_site . ", '" . $this->pid . "','" . str_replace("\\", "\\\\", $this->scriptFile) . "')";

        if (DEBUG) {
            echo $sql . "</br>";
        }
        if (!mysql_query($sql, $con)) {
            echo "Could not insert in db process for id_site: " . $this->id_site . " PID [" . $this->pid . "]";
            mysql_close($con);
            return false;
        }
        $sql = "UPDATE " . DB_SITEMANAGER_NAME . ".sm_prodotti SET
        status = " . STATUS_TRASFERING . ",
        upd = '" . date("Y-m-d H:i:s") . "'
    WHERE sm_prodotti.id ='" . $this->id_site . "';";
        if (!mysql_query($sql, $con)) {
            echo "Could not update in db ";
            mysql_close($con);
            return false;
        }
        mysql_close($con);
        return true;
    }

    function createScriptFile($localdir, $sqlFile, $remoteDir = "") {
        $this->scriptFile = tempnam("tmp", "");
        $scriptFileHandle = fopen($this->scriptFile, "w");
        $script = "open \"ftp://" . $this->ftpUsername . ":" . $this->ftpPassword . "@" . $this->ftpHost . "/" . $remoteDir . "/\"
option batch on 
option confirm off
synchronize remote \"" . BASE_PATH . $localdir . "\\\"
exit";
        fwrite($scriptFileHandle, $script);
        fclose($scriptFileHandle);
        return $this->scriptFile;
    }

}

?>
