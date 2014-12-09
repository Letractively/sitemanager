<?php

include_once("SiteManager.php");
include_once("ProcessManager.php");

$siteMng = new SiteManager();
$dbProcRun = $siteMng->getAllDbProcessRunning();
$data = array();
define("SVN_PROC", "svn.exe");
define("FTP_PROC", "WinSCP.com");

if ($dbProcRun != null && count($dbProcRun) > 0) {
    $data['svn']['num_trasfering'] = 0;
    $data['WinSCP']['num_trasfering'] = 0;
    $processRunning = new ProcessManager();
    $proces = array();
    foreach ($dbProcRun as $proc) {
        if (strpos($proc['script_name'], 'svn') !== false) {
            $procName = SVN_PROC;
        } else {
            $procName = FTP_PROC;
        }
        $siteMng->setId($proc['id_site']);
        $siteData = $siteMng->getSiteById();
        if (count($processRunning->getPrcRun($proc['pid'], $procName)) === 0) {
            switch ($procName) {
                case "WinSCP.com":
                    $siteInAnalysis = new Site($siteData);
                    $siteInAnalysis->setStatus(STATUS_TO_INSTALL);
                    $siteMng->udpateForSite($siteInAnalysis);
                    break;
            }
            $siteMng->deleteEntry($proc['id']);
        } else {
            switch ($procName) {
                case SVN_PROC:
                    $data['svn']['sites'][] = $siteData;
                    $data['svn']['num_trasfering'] +=1;
                    break;
                case FTP_PROC:
                    $data['WinSCP']['sites'][] = $siteData;
                    $data['WinSCP']['num_trasfering'] +=1;
                    break;
            }
        }
    }
}
echo json_encode($data);
?>
