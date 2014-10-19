<?php
if (isset($_POST['proc']) && $_POST['proc']!="") {
    include_once("ProcessManager.php");
    $data = "";
    $processes = "";
    $processRunning = new ProcessManager();
    $proces = $processRunning->getAllFtpProcessRunning($_POST['proc']);
    $pids = array();
    if (!empty($proces)) {
        foreach ($proces as $task) {
            $parts = preg_split('/\s+/', $task);
            $pids[] = $parts[1];
            $processes .=$task . "</br>";
        }
    }
    $data['sites'] = $processRunning->updateStateAndFile($pids);
    $data['num_trasfering'] = count($pids);
    if ($processes != "") {
        $data['msg'] = "Traferimento in corso...";
    }
    echo json_encode($data);
}
?>
