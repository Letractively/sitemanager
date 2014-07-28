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
        <a href="test/testAll.php">Test system</a>
        <?php
        include_once("config.php");
        $sm = new SiteManager();
        $allSiteInDb= $sm->getAllSite();
        $siteLocal = createLinks($allSiteInDb);
        $masterWork = $siteLocal['form'];
        if (isset($_POST['nome']) && isset($_POST['tipo']) && validateInput($_POST['nome'])) {
            $result = migrate($_POST['tipo'], $_POST['nome'], $masterWork[$_POST['tipo']]);
            if (!$result) {
                echo "un qualche errore di migrazione c'e' stato....<br>";
            }
        } else if (isset($_GET['nome']) && isset($_GET['domain'])) {
            manageInstallation($_GET['nome'], $_GET['domain']);
        } else if (isset($_GET['f']) && $_GET['f'] == "t" && isset($_GET['id']) && $_GET['id'] != "") {
            trasferFtpFile($_GET['id']);
        } else if (isset($_POST['status']) && $_POST['status']!= "" && isset($_POST['id']) && $_POST['id'] != "") {
            $sm = new SiteManager();
            $sm->setId($_POST['id']);
            if ($_POST['status']==="-1"){
                $sm->deleteSite();
                if (isset($_POST['dr']) && $_POST['dr']!= ""){
                    $sm->deleteRepo();
                }
            }else{
                $sm->updateStatusForDomainForId($_POST['status']);
            }
        }
        ?>
        <div class="procmsg" id="procmsgid"></div>
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
        <?php echo changeState($allSiteInDb); ?>
    </body>
</html>
