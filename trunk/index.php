<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="application/javascript" src="js/check.js"></script>
    </head>
    <body>
        <?php
        include_once("config.php");
        if (isset($_POST['nome']) && isset($_POST['tipo']) && validateInput($_POST['nome'])) {
            if ($_POST['tipo'] == "pro") {
                echo migrate(MASTER_SITE, $_POST['nome'], MASTER_DB);
            } else if ($_POST['tipo'] == "easy") {
                echo migrate(MASTER_SITE_EASY, $_POST['nome'], MASTER_DB_EASY);
            }
        }
        echo createLinks();
        ?>
        </br>
        Inserisci il nome del nuovo sito da creare
        </br></br>
        <table
            <tr>
                <td>
                    <form method="post" name="newsite"  onsubmit="return validateForm()" >
                        <input type="text" name="nome" value=""></br>
                        <input type="radio" name="tipo" value="easy">Easy<br>
                        <input type="radio" name="tipo" value="pro" checked>Pro<br>
                        <input type="submit" value="crea">
                    </form>
                    </body>
                    </html>
