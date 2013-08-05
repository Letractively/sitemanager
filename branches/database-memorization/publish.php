<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="application/javascript" src="js/check.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/tcal.css" />
        <script type="text/javascript" src="js/tcal.js"></script> 
    </head>
    <body>
        <?php
        include_once("config.php");
        if (isset($_POST['sites'])) {
            $siteData = getSiteById($_POST['sites']);
            echo "Inserisci i dati per la pubblicazione di: " . $siteData['nome'] . "<br><br>
      ";
            echo "<form method=\"post\" name=\"datasubcription\">
data acquisto dominio
<div><input type=\"text\" name=\"dataacqui\"  class=\"tcal\"  value=\"\"></div><br>
email di riferimento<input type=\"text\" name=\"email\"><br>
ftp host<input type=\"text\" name=\"ftphost\"><br>
username ftp<input type=\"text\" name=\"ftpusername\"><br>
password ftp<input type=\"text\" name=\"ftppwd\"><br>


newDb<input type=\"text\" name=\"db\"><br>
userName<input type=\"text\" name=\"username\"><br>
password<input type=\"text\" name=\"pwd\"><br>
hostdb<input type=\"text\" name=\"hostdb\"><br>
domainName<input type=\"text\" name=\"domainname\">
<select name=\"domain\">
<option value=\"com\">.com</option>
<option selected=\"\" value=\"it\">.it</option>
<option value=\"eu\">.eu</option>
<option value=\"net\">.net</option>
<option value=\"org\">.org</option>
<option value=\"biz\">.biz</option>
<option value=\"info\">.info</option>
<option value=\"cc\">.cc</option>
<option value=\"us\">.us</option>
</select> <br>
<input type=\"hidden\" value=\"" . $siteData['nome'] . "\" name=\"source\">
<input type=\"hidden\" value=\"" . $siteData['id'] . "\" name=\"sourceid\">
<input type=\"submit\" value=\"crea\">
</form>";
        } else if (isset($_POST['dataacqui']) &&
                isset($_POST['email']) &&
                isset($_POST['ftphost']) &&
                isset($_POST['ftpusername']) &&
                isset($_POST['ftppwd']) &&
                isset($_POST['db']) &&
                isset($_POST['username']) &&
                isset($_POST['pwd']) &&
                isset($_POST['hostdb']) &&
                isset($_POST['domain']) &&
                isset($_POST['domainname']) &&
                isset($_POST['source']) &&
                isset($_POST['sourceid'])) {
            $datenow = DateTime::createFromFormat('d/m/Y', $_POST['dataacqui']);
            $input['dataacqui'] = $datenow->format('Y-m-d');
            $input['email'] = $_POST['email'];
            $input['ftphost'] = $_POST['ftphost'];
            $input['ftpusername'] = $_POST['ftpusername'];
            $input['ftppwd'] = $_POST['ftppwd'];
            $input['newDb'] = $_POST['db'];
            $input['userName'] = $_POST['username'];
            $input['password'] = $_POST['pwd'];
            $input['hostdb'] = $_POST['hostdb'];
            $input['domain'] = $_POST['domain'];
            $input['domainName'] = $_POST['domainname'];
            if (moveToRelease($_POST['sourceid'], $_POST['source'], $input)){
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
        ?>

    </body>
</html>
