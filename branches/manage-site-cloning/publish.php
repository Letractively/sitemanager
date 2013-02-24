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
        if (isset($_POST['sites'])) {
            $siteData = getSiteById($_POST['sites']);
            echo "Inserisci i dati per la pubblicazione di: " . $siteData['nome'] . "<br><br>";
            echo "</form>
newDb<input type=\"text\" name=\"db\"><br>
userName<input type=\"text\" name=\"username\"><br>
password<input type=\"text\" name=\"pwd\"><br>
hostdb<input type=\"text\" name=\"hostdb\"><br>
domain<input type=\"text\" name=\"domain\"><br>
domainName<input type=\"text\" name=\"domainname\"><br>
<input type=\"hidden\" value=\"" . $siteData['nome'] . " name=\"source\"\">
<input type=\"submit\" value=\"crea\">
</form>";
        } elseif (isset($_POST['db']) &&
                isset($_POST['username']) &&
                isset($_POST['pwd']) &&
                isset($_POST['hostdb']) &&
                isset($_POST['domain']) &&
                isset($_POST['domainname']) &&
                isset($_POST['source'])) {
            $input['newDb'] = $_POST['db'];
            $input['userName'] = $_POST['username'];
            $input['password'] = $_POST['pwd'];
            $input['hostdb'] = $_POST['hostdb'];
            $input['domain'] = $_POST['domain'];
            $input['domainName'] = $_POST['domainname'];
            
            moveToRelease($_POST['source'], $input);
        } else {
            header("Location: index.php");
        }
        ?>

    </body>
</html>

