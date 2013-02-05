<?php
include_once("config.php");
$result="";
$dst = $_POST['source'];
$con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
$sql = "USE db_" . $dst;
$result = mysql_query($sql, $con);
if ($result!=null){
    $result="Il DB ".$dst." esiste ".$dst."\r\n";
}
if (file_exists(BASE_PATH .$dst) && is_dir(BASE_PATH .$dst)) {
   $result.="La cartella ".$dst." esiste\r\n";
}
echo $result;
?>
