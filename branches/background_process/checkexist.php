<?php

include_once("config.php");
if (isset($_POST['nome'])) {
    $nameToBeCheked = $_POST['nome'];
    if (file_exists(BASE_PATH . $nameToBeCheked) && is_dir(BASE_PATH . $nameToBeCheked)) {
        echo "Esiste la directory ". $nameToBeCheked;
    }
    $link = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    if (!$link) {
        echo ('Not connected : ' . mysql_error());
    }
    $nomeDb = 'db_' . $nameToBeCheked;
    $db_selected = mysql_select_db($nomeDb, $link);
    if ($db_selected) {
        echo "Il DB ".$nomeDb. " esiste";
    }
    mysql_close($link);
}
?>
