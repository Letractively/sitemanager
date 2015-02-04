<?php

include_once("SiteManager.php");
include_once("ProcessManager.php");

$siteMng = new SiteManager();
$dbProcRun = $siteMng->getAllDbProcessRunning();
$data = array();
define("SVN_PROC", "svn.exe");
define("FTP_PROC", "WinSCP.com");

function commitSite($idSite) {
    $useragent = "Mozilla Firefox";
    $fields = array(
        'id' => $idSite,
        'f' => "c"
    );

    foreach ($fields as $key => $value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');
    $ch = curl_init();
    $url = 'http://' . DOMAIN_URL_BASE . '/sitemanager/svnwrp.php';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

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
                    $installResult = $siteInAnalysis->install();
                    if ($installResult == 0) {
                        $siteInAnalysis->setStatus(STATUS_INSTALLED);
                        $siteMng->udpateForSite($siteInAnalysis);
                        commitSite($proc['id_site']);
                    } else {
                        $data['error']['sites'][] = $siteData;
                        $data['error']['msg'] = "Error installing site: " . $installResult;
                    }
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
