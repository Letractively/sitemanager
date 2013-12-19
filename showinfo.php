<?php
if (isset($_POST['id'])) {
    include_once("config.php");
    $siteData = getSiteById($_POST['id']);
    echo json_encode($siteData);
}
?>
