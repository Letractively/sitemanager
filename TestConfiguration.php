<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestConfiguration
 *
 * @author Miro
 */
class TestConfiguration {

    private $errorDescription = "";
    private $source;
    private $config;
    private $dbTestFile;
    private $ftpScriptFile;
    private $ftpDeleteScriptFile;

    function __construct($source, $config) {
        $this->source = $source;
        $this->config = $config;
        $this->dbTestFile = __DIR__ . "\\tmp\\dbtest.php";
        $this->ftpScriptFile = tempnam(__DIR__ . "\\tmp", "");
        $this->ftpDeleteScriptFile = tempnam(__DIR__ . "\\tmp", "");
    }

    public function getErrorDescription() {
        return $this->errorDescription;
    }

    private function runScript($scriptFile) {
        $result = true;
        $winScpPath = __DIR__ . DIRECTORY_SEPARATOR . "bin" . DIRECTORY_SEPARATOR . "WinSCP.com";
        $command = $winScpPath . " /script=\"" . $scriptFile . "\"";
        $ex = new Executer();
        $ex->execute($command, false);
        if ($ex->getStdErr() != 0) {
            $result = false;
            $this->errorDescription .=$ex->getOutput() . "</br>";
        }
        return $result;
    }

    public function isConfigOk() {
        $result = false;
        $this->createDbTestFile();
        $this->createScriptTransferFile();
        if ($this->runScript($this->ftpScriptFile)) {
            if ($this->callDbTest()) {
                if (!DEBUG) {
                    unlink($this->ftpScriptFile);
                    unlink($this->dbTestFile);
                }
                $result = true;
            } else {
                $this->errorDescription .="DB connection error, check DB configuration</br>";
            }
        } else {
            $this->errorDescription .="Ftp Error transfering, check FTP configuration</br>";
        }
        return $result;
    }

    private function createDbTestFile() {
        $fh = fopen($this->dbTestFile, 'w');
        $stringData = "<?php
set_time_limit (PHP_INT_MAX);
\$mysqli = new mysqli(\"" . $this->config['hostdb'] . "\", \"" . $this->config['userName'] . "\", \"" . $this->config['password'] . "\", \"" . $this->config['newDb'] . "\");
if (\$mysqli->connect_errno) {
    echo \$mysqli->connect_error;
}else {
    echo \"0\"; 
}
unlink (__FILE__);
?>";

        fwrite($fh, $stringData);
        fclose($fh);
    }

    private function createScriptTransferFile() {
        $fh = fopen($this->ftpScriptFile, 'w');
        $stringData = "option batch abort
option confirm off
open \"ftp://" . $this->config['ftpusername'] . ":" . $this->config['ftppwd'] . "@" . $this->config['ftphost'] . "/www." . $this->config['domainName'] . "." . $this->config['domain'] . "/\"
put " . $this->dbTestFile . " dbtest.php
exit";
        fwrite($fh, $stringData);
        fclose($fh);
    }

    private function callDbTest() {
        $result = false;
        $nameToBeCheked = "http://www." . $this->config['domainName'] . "." . $this->config['domain'];
        $resultOfACall = @file_get_contents($nameToBeCheked . "/dbtest.php");
        if (isset($http_response_header)) {
            $responseHeader = $http_response_header[0];
            if ($responseHeader == "HTTP/1.1 404 Not Found") {
                $this->errorDescription .="not found</br>" . $responseHeader . "</br>";
            } else {
                if ($resultOfACall == "0") {
                    $result = true;
                } else {
                    $this->errorDescription .=$resultOfACall . "</br>";
                }
            }
        }
        return $result;
    }

}
