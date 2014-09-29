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
        include_once("SiteManager.php");
        set_time_limit(120000);
        if (isset($_POST['sites'])) {
            $sm = new SiteManager();
            $sm->setId($_POST['sites']);
            $siteData = $sm->getSiteById();
            $today = date('d/m/Y');
            echo "Inserisci i dati per la pubblicazione di: " . $siteData['nome'] . "<br><br>
      ";
            $subdomainExploded = explode("/", $siteData['domain'], 2);
            if (count($subdomainExploded) == 1) {
                $subdomainExploded[0];
                $siteData['subdomain'] = "";
            } else {
                $subdomainExploded[0];
                $siteData['subdomain'] = $subdomainExploded[1];
            }
            echo "<form method=\"post\" name=\"datasubcription\" onsubmit=\"return validateSubscription()\">
Data acquisto dominio
<div><input type=\"text\" name=\"dataacqui\"  class=\"tcal\"  value=\"" . $today . "\"></div><br>
Email di riferimento<input type=\"text\" name=\"email\" value=\"" . $siteData['ref_mail'] . "\"><br>
Ftp host<input type=\"text\" name=\"ftphost\" value=\"" . $siteData['ftp_host'] . "\"><br>
Username ftp<input type=\"text\" name=\"ftpusername\" value=\"" . $siteData['ftp_username'] . "\"><br>
Password ftp<input type=\"text\" name=\"ftppwd\" value=\"" . $siteData['ftp_pwd'] . "\"><br>
Host Db (Example: 64.220.150.22)<input type=\"text\" name=\"hostdb\" value=\"" . $siteData['hostdb'] . "\"><br>
User Name Db<input type=\"text\" name=\"username\" value=\"" . $siteData['dbusername'] . "\"><br>
Password Db<input type=\"text\" name=\"pwd\" value=\"" . $siteData['dbpwd'] . "\"><br>
Db wordpress<input type=\"text\" name=\"db\" value=\"" . $siteData['db'] . "\"><br>
Dominio sito: http://www.<input type=\"text\" name=\"domainname\" value=\"" . $siteData['domainName'] . "\">
<select name=\"domain\">
<option value=\"com\">.com</option>
<option selected value=\"it\">.it</option>
<option value=\"eu\">.eu</option>
<option value=\"net\">.net</option>
<option value=\"org\">.org</option>
<option value=\"biz\">.biz</option>
<option value=\"info\">.info</option>
<option value=\"cc\">.cc</option>
<option value=\"us\">.us</option>
</select>/<input type=\"text\" name=\"secondsubdomain\" value=\"" . $siteData['subdomain'] . "\"> <br>    
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
            $input['email'] = trim($_POST['email']);
            $input['ftphost'] = trim($_POST['ftphost']);
            $input['ftpusername'] = trim($_POST['ftpusername']);
            $input['ftppwd'] = trim($_POST['ftppwd']);
            $input['newDb'] = trim($_POST['db']);
            $input['userName'] = trim($_POST['username']);
            $input['password'] = trim($_POST['pwd']);
            $input['hostdb'] = trim($_POST['hostdb']);
            if (isset($_POST['secondsubdomain']) && $_POST['secondsubdomain'] != "") {
                $input['domain'] = trim($_POST['domain'] . '/' . $_POST['secondsubdomain']);
            } else {
                $input['domain'] = trim($_POST['domain']);
            }
            $input['domainName'] = trim($_POST['domainname']);
            $sm = new SiteManager();
            if ($sm->moveToRelease($_POST['sourceid'], $_POST['source'], $input)) {
                header("Location: index.php");
            } else {
                echo "Correggi gli errori</br>"
                . "<a href=\"index.php\">Ritorna alla home</a>";
            }
        } else {
            echo "Dati mancanti o non corretti</br>"
            . "<a href=\"index.php\">Ritorna alla home</a>";
        }
        ?>

    </body>
</html>

