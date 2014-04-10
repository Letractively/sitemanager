<?php
if (isset($_GET['id'])&& $_GET['id'] !=""){ 
    include_once("config.php");
    $siteData = getSiteById($_GET['id']);
    
    //TODO committa svn i file
    
    //TODO prendi il db dal file
    
    //TODO spostalo sul host remoto
    
    //TODO fai la post verso l'endpoint remoto
}
?>
