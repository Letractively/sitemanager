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

    function uploadUsingScript() {
        $winScpPath = __DIR__ . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "WinSCP.com";
        $command = $winScpPath . " /script=\"" . $this->scriptFile . "\"";
        if (DEBUG) {
            echo $command . "</br>";
        }
        $ex = new Executer();
        $ex->execute($command,true);
        if (count($ex->getOutput())>0) {
            print_r($ex->getOutput());
        }
        if ($ex->insertProcessRunning($this->id_site, $this->scriptFile)) {
            header('Location: index.php');
        }
    }

    
    function createScriptFile($localdir, $sqlFile, $remoteDir = "") {
        $this->scriptFile = tempnam("tmp", "");
        $scriptFileHandle = fopen($this->scriptFile, "w");
        $script = "open \"ftp://" . $this->ftpUsername . ":" . $this->ftpPassword . "@" . $this->ftpHost . "/" . $remoteDir . "/\"
option exclude \"*.svn/\" 
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
