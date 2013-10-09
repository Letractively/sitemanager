<?php

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

    function __construct($ftpUsername, $ftpPassword, $ftpHost) {
        $this->ftpUsername = $ftpUsername;
        $this->ftpPassword = $ftpPassword;
        $this->ftpHost = $ftpHost;
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

        
    function uploadUsingScript($scriptFile, $background = false) {
        $winScpPath = __DIR__.DIRECTORY_SEPARATOR."bin".DIRECTORY_SEPARATOR."WinSCP.com";
        $command = $winScpPath . " /script=\"" . $scriptFile . "\"";
        if (DEBUG){
            echo $command."</br>";
        }
        if ($background) {
            if (substr(php_uname(), 0, 7) == "Windows") {
                pclose(popen("start  /B cmd /S /C \"" . $command . "\"", "r"));
            } else {
                exec($command . " > /dev/null &", $output, $return_var);
            }
        } else {
            set_time_limit(PHP_INT_MAX);
            exec($command, $output, $return_var);
            unlink ($scriptFile);
        }
        if (isset($output)) {
            foreach ($output as $line) {
                echo $line . "\n</br>";
            }
        }
        header('Location: index.php');
    }

    function createScriptFile($localdir,$sqlFile,$remoteDir="") {
        $filename = tempnam("tmp", "");
        $scriptFile = fopen($filename, "w");
        
        $script = "open \"ftp://" . $this->ftpUsername . ":" . $this->ftpPassword . "@" . $this->ftpHost. "/" . $remoteDir . "/\"
option batch on 
option confirm off
synchronize remote \"".BASE_PATH.$localdir."\\\"
exit";
        fwrite($scriptFile, $script);
        fclose($scriptFile);
        return $filename;
    }

}

?>
