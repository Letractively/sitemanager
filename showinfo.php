<?php
if (isset($_POST['id'])) {
    include_once("config.php");
    $sm = new SiteManager();
    $sm->setId($_POST['id']);
    $siteData = $sm->getSiteById();
    echo json_encode($siteData);
}
?>
