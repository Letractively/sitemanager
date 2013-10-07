<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProcessManager {

    function getAllFtpProcessRunning($name) {
        exec("tasklist ", $task_list, $returnVal);
        $results = array();
        foreach ($task_list as $task) {
            if (strpos($task, $name) !== false) {
                $results[] = $task;
            }
        }
        return $results;
    }

}

?>
