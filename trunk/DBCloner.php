<?php

class DBCloner {

    public $mysqlDatabaseName;
    public $mysqlUserName;
    public $mysqlPassword;
    public $mysqlHostName;
    public $mysqlImportFilename;
    public $filePutOutput;
    public $errormsg;
    public $mysqlDatabaseNameNew;
    public $con;

    function __construct($mysqlDatabaseName, $mysqlUserName, $mysqlPassword, $mysqlHostName, $mysqlDatabaseNameNew) {
        $this->mysqlDatabaseName = $mysqlDatabaseName;
        $this->mysqlUserName = $mysqlUserName;
        $this->mysqlPassword = $mysqlPassword;
        $this->mysqlHostName = $mysqlHostName;
        $this->mysqlDatabaseNameNew = $mysqlDatabaseNameNew;
    }

    function migrate() {
        set_time_limit(100);

        $mysqlImportFilename = tempnam(__DIR__, "");
        $command = MYSQL_BIN_BASE_PATH . "mysqldump --opt --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseName . " --single-transaction > " . $mysqlImportFilename . " 2>&1";
        exec($command, $output, $worked);
        if ($worked == 1) {
            $this->errormsg = "Impossibile esportare il file " . $mysqlImportFilename . " sul DB";
            $this->deleteFile($mysqlImportFilename);
            return false;
        }

        $this->con = mysql_connect($this->mysqlHostName, $this->mysqlUserName, $this->mysqlPassword);
        if (!$this->con) {
            $this->errormsg = "Could not connect: " . mysql_error();
            $this->deleteFile($mysqlImportFilename);
            return false;
        }
        if (!$this->ifExistDeleteDbAndSelect()) {
            deleteFile($mysqlImportFilename);
            $this->errormsg = "Could not delete or create new db " . $this->mysqlDatabaseNameNew . " error " . mysql_error();
            return false;
        }
        $content = file_get_contents($mysqlImportFilename);
        $replaced = str_replace($this->mysqlDatabaseName, $this->mysqlDatabaseNameNew, $content);
        file_put_contents($mysqlImportFilename, $replaced);
        $command = MYSQL_BIN_BASE_PATH . "mysql --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseNameNew . " < " . $mysqlImportFilename;
        exec($command, $output = array(), $worked);
        $this->deleteFile($mysqlImportFilename);
        if ($worked == 1) {
            $this->errormsg = "Impossibile importare il file " . $mysqlImportFilename . " sul DB";
            return false;
        }
        return true;
    }

    function ifExistDeleteDbAndSelect() {
        $result = true;
        $sql = "USE " . $this->mysqlDatabaseNameNew;
        if (mysql_query($sql, $this->con)) {
            $sql = "DROP DATABASE " . $this->mysqlDatabaseNameNew;
            $result = $result && mysql_query($sql, $this->con);
        }
        $sql = "CREATE DATABASE " . $this->mysqlDatabaseNameNew;
        $result = $result && mysql_query($sql, $this->con);

        $sql = "USE " . $this->mysqlDatabaseNameNew;
        $result = $result && mysql_query($sql, $this->con);
        return $result;
    }

    function deleteFile($fileToDelete) {
        if (!unlink($fileToDelete)) {
            $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            return false;
        }
        return true;
    }

}

?>
