<?php

include_once("config.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProcessManager {

    function getPrcRun($pid, $name) {
        exec("tasklist /FI \"PID eq " . $pid . "\" /FI \"IMAGENAME eq " . $name . "\"", $task_list, $returnVal);
        $results = array();
        foreach ($task_list as $task) {
            if (strpos($task, $name) !== false) {
                $results[] = $task;
            }
        }
        return $results;
    }

    function getAllProcessRunning($name) {
        exec("tasklist /FI \"IMAGENAME eq " . $name . "\"", $task_list, $returnVal);
        $results = array();
        foreach ($task_list as $task) {
            if (strpos($task, $name) !== false) {
                $results[] = $task;
            }
        }
        return $results;
    }

    function killProcessFromPid($pid) {
        $wmi = new COM("winmgmts:{impersonationLevel=impersonate}!\\\\.\\root\\cimv2");
        $procs = $wmi->ExecQuery("SELECT * FROM Win32_Process WHERE ProcessId='" . $pid . "'");
        foreach ($procs as $proc)
            $proc->Terminate();
    }

    public function matchFromTraferingInDb($allProcessRunningNow, $dbProcess) {
        $toBeUpdated = array();
        if (!empty($dbProcess)) {
            $index = 0;
            foreach ($dbProcess as $processEntry) {
                if (!in_array($processEntry['pid'], $allProcessRunningNow)) {
                    $toBeUpdated[$index]['id'] = $processEntry['id'];
                    $toBeUpdated[$index]['file'] = $processEntry['script_name'];
                    $toBeUpdated[$index]['id_site'] = $processEntry['id_site'];
                    $index++;
                }
            }
        }
        return $toBeUpdated;
    }

    public function showProcessRunning() {
        $useragent = "Mozilla Firefox";
        $ch = curl_init();
        $url = 'http://' . DOMAIN_URL_BASE . '/sitemanager/showprocess.php';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

?>
