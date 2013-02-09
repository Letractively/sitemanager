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

    function __construct($mysqlDatabaseName, $mysqlUserName, $mysqlPassword, $mysqlHostName, $mysqlDatabaseNameNew) {
        $this->mysqlDatabaseName = $mysqlDatabaseName;
        $this->mysqlUserName = $mysqlUserName;
        $this->mysqlPassword = $mysqlPassword;
        $this->mysqlHostName = $mysqlHostName;
        $this->mysqlDatabaseNameNew = $mysqlDatabaseNameNew;
    }

    function migrate() {
        $mysqlImportFilename = tempnam(__DIR__, "");
        $command = MYSQL_BIN_BASE_PATH . "mysqldump --opt --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseName . " --single-transaction > " . $mysqlImportFilename . " 2>&1";
        exec($command, $output, $worked);
        if ($worked == 1) {
            $this->errormsg = "Impossibile esportare il file " . $mysqlImportFilename . " sul DB";
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }

        $con = mysql_connect($this->mysqlHostName, $this->mysqlUserName, $this->mysqlPassword);
        if (!$con) {
            $this->errormsg = "Could not connect: " . mysql_error();
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }
        
        $sql = "DROP DATABASE " . $this->mysqlDatabaseNameNew. " IF EXISTS";
        if (!mysql_query($sql, $con)) {
            $this->errormsg = "Could not delete existent db " . $this->mysqlDatabaseNameNew;
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }
        
        $sql = "CREATE DATABASE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $con)) {
            $this->errormsg = "Could not create db " . $this->mysqlDatabaseNameNew;
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }

        $sql = "USE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $con)) {
            $this->errormsg = "Could not select db " . $this->mysqlDatabaseNameNew;
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }
        $content = file_get_contents($mysqlImportFilename);
        $replaced = str_replace($this->mysqlDatabaseName, $this->mysqlDatabaseNameNew, $content);
        file_put_contents($mysqlImportFilename, $replaced);
        $command = MYSQL_BIN_BASE_PATH . "mysql --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseNameNew . " < " . $mysqlImportFilename;
        exec($command, $output = array(), $worked);
        if (!unlink($mysqlImportFilename)) {
            $this->errormsg = "Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            return false;
        }
        if ($worked == 1) {
            $this->errormsg = "Impossibile importare il file " . $mysqlImportFilename . " sul DB";
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }
        return true;
    }

}

?>
