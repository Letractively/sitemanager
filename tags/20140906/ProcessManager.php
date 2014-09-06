<?php

include_once("config.php");

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

    function killProcessFromPid($pid) {
        $wmi = new COM("winmgmts:{impersonationLevel=impersonate}!\\\\.\\root\\cimv2");
        $procs = $wmi->ExecQuery("SELECT * FROM Win32_Process WHERE ProcessId='" . $pid . "'");
        foreach ($procs as $proc)
            $proc->Terminate();
    }

    private function matchFromTraferingInDb($allProcessRunningNow) {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "SELECT * FROM `" . DB_SITEMANAGER_NAME . "`.`sm_processrunning`";
        $castresult = mysql_query($sql) or die(mysql_error());
        mysql_close($con);
        $toBeUpdated = array();
        while ($row = mysql_fetch_assoc($castresult)) {
            $dbProcess[] = $row;
        }
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

    function updateStateAndFile($pid) {
        $toBeUpdated = $this->matchFromTraferingInDb($pid);
        $siteToInstall = null;
        foreach ($toBeUpdated as $entry) {
            if (file_exists($entry['file'])) {
                unlink($entry['file']);
            }
            $sm = new SiteManager();
            $sm->setId($entry['id_site']);
            $siteToInstall[] = $sm->getSiteById();
            updateStatusForDomainForId($entry['id_site'], STATUS_TO_INSTALL);
            $this->deleteEntry($entry['id']);
        }
        return $siteToInstall;
    }

    function deleteEntry($id) {
        $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
        $sql = "DELETE from " . DB_SITEMANAGER_NAME . ".sm_processrunning WHERE sm_processrunning.id ='" . $id . "';";
        if (!mysql_query($sql, $con)) {
            echo "Could not delete in db ";
            mysql_close($con);
            return false;
        }
        mysql_close($con);
        return true;
    }

}

?>
