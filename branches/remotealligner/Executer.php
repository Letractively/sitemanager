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
    
    function execute($command) {
        if (DEBUG) {
            echo $command . "</br>";
        }
        if (substr(php_uname(), 0, 7) == "Windows") {
            $WshShell = new COM("WScript.Shell");
            $oExec = $WshShell->exec($command);
            $this->pid = ( $oExec->ProcessID );
        } else {
            exec($command . " > /dev/null &", $output, $return_var);
        }
    }

}

?>
