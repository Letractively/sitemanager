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
    public $sourcename;
    public $destName;
    private $con;

    function __construct($mysqlDatabaseName, $mysqlUserName, $mysqlPassword, $mysqlHostName, $mysqlDatabaseNameNew, $source, $dest) {
        $this->mysqlDatabaseName = $mysqlDatabaseName;
        $this->mysqlUserName = $mysqlUserName;
        $this->mysqlPassword = $mysqlPassword;
        $this->mysqlHostName = $mysqlHostName;
        $this->mysqlDatabaseNameNew = $mysqlDatabaseNameNew;
        $this->sourcename = $source;
        $this->destName = $dest;
        $this->con = mysql_connect($this->mysqlHostName, $this->mysqlUserName, $this->mysqlPassword);

    }

    function migrate() {
        $mysqlImportFilename = tempnam(__DIR__, "");
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysqldump\" --opt --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseName . " --single-transaction > \"" . $mysqlImportFilename . "\" 2>&1";
        exec($command, $output, $worked);
        if ($worked == 1) {
            $this->errormsg .= "Impossibile esportare il file " . $mysqlImportFilename . " sul DB ". mysql_error();
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }

        $sql = "CREATE DATABASE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not create db " . $this->mysqlDatabaseNameNew." ". mysql_error();
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }

        $sql = "USE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not select db " . $this->mysqlDatabaseNameNew." ". mysql_error();
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }
        $content = file_get_contents($mysqlImportFilename);
        $replaced = str_replace($this->mysqlDatabaseName, $this->mysqlDatabaseNameNew, $content);
        $replaced = str_replace($this->sourcename, $this->destName, $replaced);
        file_put_contents($mysqlImportFilename, $replaced);
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysql\" --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseNameNew . " < \"" . $mysqlImportFilename . "\"";
        @exec($command, $output = array(), $worked);
        if (!unlink($mysqlImportFilename)) {
            $this->errormsg .= "Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            return false;
        }
        if ($worked == 1) {
            $this->errormsg .= "Impossibile importare il file " . $mysqlImportFilename . " sul DB";
            if (!unlink($mysqlImportFilename)) {
                $this->errormsg .= "</br>Impossibile cancellare il file temporaneo " . $mysqlImportFilename;
            }
            return false;
        }
        return true;
    }

    private function cancellDB() {
        $sql = "DROP DATABASE IF EXISTS " . $this->mysqlDatabaseNameNew ;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not delete existent db " . $this->mysqlDatabaseNameNew." ". mysql_error();
            return false;
        }
    }

}

?>