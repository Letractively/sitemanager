<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="application/javascript" src="js/check.js"></script>
        <script type="application/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    </head>
    <body>
    Siti disponibili</br>
<?php
include_once("config.php");
if (isset ($_POST['nome']) && validateInput($_POST['nome'])) {
        migrate(MASTER_SITE, mysql_real_escape_string($_POST['nome']),MASTER_DB);
}
echo createLinks() ;
?>
</br>
Inserisci il nome del nuovo sito da creare
</br></br>
<form method="post" name="newsite"  onsubmit="return validateForm()" >
<input type="text" name="nome" value=""></br>
<input type="submit" value="crea">
</form>
</body>
</html>