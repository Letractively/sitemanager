<?php

include_once("config.php");

function createLinks() {
    $files = glob(BASE_PATH . "*");
    $result = "";
    foreach ($files as $file) {
        if (is_dir($file)) {
            $basename = basename($file);
            $result.= "<a href=\"http://localhost/" . $basename . "\" target=\"_blank\">" . $basename . "</a></br>
";
        }
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
    $sql = "INSERT INTO `site_manager`.`sm_prodotti`
        (`id`, `nome`, `cliente_id`, `modello_id`, `ins`, `upd`)
        VALUES (NULL, \'" . $newSite . "\', " . $clientId . ", \'$source\', \'" . date() . "\', CURRENT_TIMESTAMP);";
    if (!mysql_query($sql, $con)) {
        $this->errormsg = "Could not insert in db " . $this->mysqlDatabaseNameNew;
        return false;
    }
    return true;
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

    //insertNewCreatedSiteInDb($newSite, null, $source);
    return true;
}

?>
