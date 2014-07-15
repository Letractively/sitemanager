<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Executer
 *
 * @author Miro
 */
class Executer {

    public $pid;
    private $stdOut = null;
    private $stdErr = null;
    private $retCode;

    function execute($command, $background = false) {
        if (DEBUG) {
            echo $command . "</br>";
        }
        $output = array();
        if ($background) {
            if (substr(php_uname(), 0, 7) == "Windows") {
                $WshShell = new COM("WScript.Shell");
                $oExec = $WshShell->exec($command);
                $this->pid = ( $oExec->ProcessID );
                $this->stdOut = $oExec->StdOut->ReadAll;
                $this->stdErr = $oExec->StdErr->ReadAll;
            } else {
                $this->retCode = exec($command . " > /dev/null &", $output, $return_var);
//                $this->stdOut = $output;
//                $this->stdErr = $return_var;
            }
        } else {
            set_time_limit(PHP_INT_MAX);
            $this->retCode = exec($command, $output, $return_var);
            $this->stdOut = $output;
            $this->stdErr = $return_var;
        }
    }

    public function getPid() {
        return $this->pid;
    }

    public function getStdOut() {
        return $this->stdOut;
    }

    public function getRetCode() {
        return $this->retCode;
    }

    public function getOutput() {
        $result = "";
        if ($this->stdOut != null && $this->stdOut != "") {
            $result .= $this->stdOut;
        }
        if ($this->stdErr != null && $this->stdErr != "") {
            $result .= $this->stdErr;
        }
        return $result;
    }

    public function getStdErr() {
        return $this->stdErr;
    }

}

?>
