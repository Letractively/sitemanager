<?php

include_once("config.php");

function createLinks() {
    $files = glob(BASE_PATH . "*");
    $result = "";
    $result.="<table border =1>";
    $result.= "<tr>
<td>Siti presenti</td>
</tr>
";
    foreach ($files as $file) {
        if (is_dir($file)) {
            $basename = basename($file);
            $result.= "<tr>
<td><a href=\"http://localhost/" . $basename . "\" target=\"_blank\">" . $basename . "</a></td>
</tr>
";
        }
    }
    $result.="</table>";
    return $result;
}

function siteWorkInProgress() {
    $files = getSitesByState(0);
    $result = "";

    if ($files != null && count($files) > 0) {
        $result.="<form>
<table border =1>";
        $result.= "<tr>
<td>Siti da publicare </td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td><input type=\"radio\" name=\"sites\" value=\"" . $file['id'] . "\">" . $file['nome'] . "</td>
</tr>
";
        }
        $result.="</table>
<input type=\"submit\" value=\"Prepara per la publicazione\">
</form>";
    }
    return $result;
}

function siteToBePublished() {
    $files = getSitesByState(1);
    $result = "";
    if ($files != null && count($files) > 0) {
        $result.="<table border =1>";
        $result.= "<tr>
<td>Siti da publicare </td>
</tr>
";
        foreach ($files as $file) {
            $result.= "<tr>
<td>" . $file['nome'] . "</td>
</tr>
";
        }
        $result.="</table>";
    }
    return $result;
}

function validateInput($input) {
    if (($input == "") || (preg_match('/[A-Z]/', $input))) {
        echo "input non valido";
        return false;
    }
    return true;
}

/**
 * inserti in DB the entry for the new created site
 * 
 * @param type $newSite: the name of the new site
 * @param type $clientId: this is the id of a client
 * @param type $source : this is the name of the master that are used for this entry
 * @return boolean
 */
function insertNewCreatedSiteInDb($newSite, $clientId, $source) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "INSERT INTO `site_manager`.`sm_prodotti` (`id`, `nome`, `cliente_id`, `modello_id`, `ins`, `upd`) VALUES ('', '" . $newSite . "', '', ' " . $clientId . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "');";
    if (!mysql_query($sql, $con)) {
        $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function updateStatusSiteInDb($id) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "UPDATE `site_manager`.`sm_prodotti` SET `upd` = '" . date("Y-m-d H:i:s") . "',`status` = '1' WHERE `sm_prodotti`.`id` =". $id.";";
    if (!mysql_query($sql, $con)) {
        $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
        mysql_close($con);
        return false;
    }
    mysql_close($con);
    return true;
}

function getSitesByState($state) {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    $sql = "SELECT nome,id FROM `site_manager`.`sm_prodotti` WHERE STATUS = " . $state . " ORDER BY upd DESC";
    $castresult = mysql_query($sql) or die(mysql_error());
    mysql_close($con);
    $rows=null;
    while ($row = mysql_fetch_array($castresult)) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 * Do all the migration of files and DB entry for a Word press site
 * 
 * @param type $source
 * @param type $newSite
 * @param type $mysqlDatabaseName
 * @return boolean
 */
function migrate($source, $newSite, $mysqlDatabaseName) {
    set_time_limit(6000);
    $dbCloner = new DBCloner($mysqlDatabaseName, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $newSite, $source, $newSite);
    if (!$dbCloner->migrate()) {
        echo $dbCloner->errormsg . "</br>";
        return false;
    }
    $dbCloner->cleanAndClose();

    $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $newSite);
    $errorMsg = "";
    if (!$fileCloner->cloneSite()) {
        echo $fileCloner->errorMsg . "</br>";
        return false;
    }

    $fileCloner->changeWpconfig($mysqlDatabaseName, "db_" . $newSite);

    insertNewCreatedSiteInDb($newSite, null, $source);
    return true;
}

?>
