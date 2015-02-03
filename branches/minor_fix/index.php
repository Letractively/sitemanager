<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="js/check.js"></script>
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/ajaxCall.js"></script>
        <script type="text/javascript">
            if (document.images) {
                img1 = new Image();
                img1.src = "img/loading.gif";
            }
        </script>
        <link rel="stylesheet" type="text/css" href="css/tcal.css" />
    </head>
    <body>
        <div id="overlay" style="display:none"><img id="loading" src="img/loading.gif"></div>
        <p><a href="test/testAll.php">Test system</a></p>
        <p><a href="updatesm.php">Update Site Manager</a></p>
        <p><a href="SiteManagerLog.txt">Log</a></p>
        <?php
        include_once("config.php");
        include_once("ProcessManager.php");
        $pm = new ProcessManager();
        $pm->showProcessRunning();
        $sm = new SiteManager();
        $allSiteInDb = $sm->getAllSite();
        $workInProgress = $sm->filterByState($allSiteInDb, STATUS_WORKING);
        $toTransfer = $sm->filterByState($allSiteInDb, STATUS_TO_TRANSFER);
        $trasfering = $sm->filterByState($allSiteInDb, STATUS_TRASFERING);
        $toInstall = $sm->filterByState($allSiteInDb, STATUS_TO_INSTALL);
        $installed = $sm->filterByState($allSiteInDb, STATUS_INSTALLED);

        $siteLocal = createLinks($allSiteInDb);
        $masterWork = $siteLocal['form'];
        if (isset($_POST['nome']) && isset($_POST['tipo']) && validateInput($_POST['nome'])) {
            $result = $sm->migrate($_POST['tipo'], $_POST['nome'], $masterWork[$_POST['tipo']]);
            if (!$result) {
                echo "un qualche errore di migrazione c'e' stato....<br>";
            } else {
                header('Location: index.php');
            }
        } else if (isset($_GET['nome']) && isset($_GET['domain'])) {
            $sm->manageInstallation($_GET['nome'], $_GET['domain']);
        } else if (isset($_GET['f']) && $_GET['f'] == "t" && isset($_GET['id']) && $_GET['id'] != "") {
            $sm->setId($_GET['id']);
            $site = new Site($sm->getSiteById());
            $ftpCli = new FtpUploader($site->getFtp_username(), $site->getFtp_pwd(), $site->getFtp_host());
            $ftpCli->trasferFtpFile($site, $sm);
        } else if (isset($_POST['status']) && $_POST['status'] != "" && isset($_POST['id']) && $_POST['id'] != "") {
            $sm = new SiteManager();
            $sm->setId($_POST['id']);
            if ($_POST['status'] === "-1") {
                $sm->deleteSite();
                if (isset($_POST['dr']) && $_POST['dr'] != "") {
                    $sm->deleteRepo();
                }
            } else {
                $sm->updateStatusForDomainForId($_POST['status']);
            }
            header('Location: index.php');
        }
        ?>
        <div class="procmsg" id="procmsgid" style="display:none"><img src="img/loading.gif"></div>
        <table>
            <tr>
                <td style="vertical-align:top"><?php echo $siteLocal['all']; ?></td>
                <td style="vertical-align:top"><?php echo siteWorkInProgress($workInProgress); ?></td>
                <td style="vertical-align:top"><?php echo siteToBeTransfered($toTransfer); ?></td>
                <td style="vertical-align:top"><?php echo siteInTrasfering($trasfering); ?></td>
                <td style="vertical-align:top"><?php echo siteToBePublished($toInstall); ?></td>
                <td style="vertical-align:top"><?php echo siteCompleted($installed); ?></td>
                <td style="vertical-align:top">
                    <div class="infotable" id="infotableid"></div>
                </td>
            </tr>
        </table>
        <?php echo changeState($allSiteInDb); ?>
    </body>
</html>
