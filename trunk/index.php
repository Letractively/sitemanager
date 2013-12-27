<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="application/javascript" src="js/check.js"></script>
        <script src="js/jquery-1.4.2.min.js"></script>
        <script src="js/ajaxCall.js"></script>
    </head>
    <body>
        <?php
        include_once("config.php");
        include_once("ProcessManager.php");

        $siteLocal = createLinks();
        $masterWork = $siteLocal['form'];
        $processes = "";
        $processRunning = new ProcessManager();
        $proces = $processRunning->getAllFtpProcessRunning("WinSCP.com");
        $pids = array();
        if (!empty($proces)) {
            foreach ($proces as $task) {
                $parts = preg_split('/\s+/', $task);
                $pids[] = $parts[1];
                $processes .=$task . "</br>";
            }
        }
        $processRunning->updateStateAndFile($pids);
        if ($processes != "") {
            if (DEBUG) {
                echo $processes;
            }
            echo "</br><b>Traferimento in corso...</br><a href=\"\">Ricarica</a> (magari ha finito)</b>";
        }
        if (isset($_POST['nome']) && isset($_POST['tipo']) && validateInput($_POST['nome'])) {
            $result = migrate($_POST['tipo'], $_POST['nome'], $masterWork[$_POST['tipo']]);
            if (!$result) {
                echo "un qualche errore di migrazione c'e' stato....<br>";
            }
        } else if (isset($_GET['nome']) && isset($_GET['domain'])) {
            manageInstallation($_GET['nome'], $_GET['domain']);
        } else if (isset($_GET['f']) && $_GET['f'] == "t" && isset($_GET['id']) && $_GET['id'] != "") {
            trasferFtpFile($_GET['id']);
        } else if (isset($_GET['f']) && $_GET['f'] == "r" && isset($_GET['id']) && $_GET['id'] != "") {
            if (backToStatToTransfer($_GET['id'])) {
                header("Location: index.php");
            }
        }
        ?>
        <table>
            <tr>
                <td style="vertical-align:top"><?php echo $siteLocal['all']; ?></td>
                <td style="vertical-align:top"><?php echo siteWorkInProgress(); ?></td>
                <td style="vertical-align:top"><?php echo siteToBeTransfered(); ?></td>
                <td style="vertical-align:top"><?php echo siteInTrasfering(); ?></td>
                <td style="vertical-align:top"><?php echo siteToBePublished(); ?></td>
                <td style="vertical-align:top"><?php echo siteCompleted(); ?></td>
                <td style="vertical-align:top">
                    <div class="infotable" id="infotableid"></div>
                </td>
            </tr>
        </table>
        </br>

        </br>
        Inserisci il nome del nuovo sito da creare
        </br></br>
        <?php echo createFormForNewSite($siteLocal['form']); ?>
    </body>
</html>
