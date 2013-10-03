<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="application/javascript" src="js/check.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
         <?php
        include_once("config.php");
        exec("tasklist ", $task_list, $returnVal);
        $processes = "";
        $showLinkToTrasferingSite =true;
        foreach ($task_list as $task) {
            if (strpos($task, "WinSCP") !== false) {
                $processes .=$task . "</br>";
            }
        }
        if ($processes != "" && DEBUG) {
            echo $processes;
            $showLinkToTrasferingSite=false;
        }
        if (isset($_POST['nome']) && isset($_POST['tipo']) && validateInput($_POST['nome'])) {
            if ($_POST['tipo'] == "pro") {
                $result = migrate(MASTER_SITE, $_POST['nome'], MASTER_DB);
            } else if ($_POST['tipo'] == "easy") {
                $result = migrate(MASTER_SITE_EASY, $_POST['nome'], MASTER_DB_EASY);
            }
            if (!$result) {
                echo "un qualche errore di migrazione c'e' stato....<br>";
            }
        } else if (isset($_GET['nome']) && isset($_GET['domain'])) {
            manageInstallation($_GET['nome'], $_GET['domain']);
        } else if (isset($_GET['id']) && $_GET['id'] != "") {
            trasferFtpFile($_GET['id']);
        }
        ?>
        <table>
            <tr>
                <td style="vertical-align:top"><?php echo createLinks(); ?></td>
                <td style="vertical-align:top"><?php echo siteWorkInProgress(); ?></td>
                <td style="vertical-align:top"><?php echo siteToBeTransfered(); ?></td>
                <td style="vertical-align:top"><?php echo siteToBePublished($showLinkToTrasferingSite); ?></td>
                <td style="vertical-align:top"><?php echo siteCompleted(); ?></td>
            </tr>
        </table>
        </br>
       
        </br>
        Inserisci il nome del nuovo sito da creare
        </br></br>
        <form method="post" name="newsite"  onsubmit="return validateForm()" >
            <input type="text" name="nome" value=""></br>
            <input type="radio" name="tipo" value="easy">Easy<br>
            <input type="radio" name="tipo" value="pro" checked>Pro<br>
            <input type="submit" value="crea">
        </form>
    </body>
</html>
