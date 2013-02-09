<?php

include_once("config.php");

function createLinks() {
    global $source;
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
    if (($input == "")||(preg_match('/[A-Z]/', $input))) {
        echo "input non valido";
        return false;
    }
    return true;
}

function migrate($source, $newSite, $mysqlDatabaseName) {
    $start = mktime();
    $fileCloner = new WPMigrateFile(BASE_PATH . $source, BASE_PATH . $newSite);
    $errorMsg = "";
    if (!$fileCloner->cloneSite()) {
        $errorMsg .= $fileCloner->errorMsg . "</br>";
    }

    $dbCloner = new DBCloner($mysqlDatabaseName, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, "db_" . $newSite,$source,$newSite);
    if (!$dbCloner->migrate()) {
        $errorMsg .= $dbCloner->errormsg . "</br>";
    }
    $fileCloner->changeWpconfig($mysqlDatabaseName, "db_" . $newSite);
    $elapsed = mktime() - $start;
    $errorMsg .= "Completed in " . $elapsed . " seconds</br>";
    return $errorMsg;
}

?>
