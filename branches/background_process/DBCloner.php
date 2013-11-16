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
    private $con = null;
    private $importFilename;

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

    public function cleanAndClose() {
        if (!unlink($this->mysqlImportFilename)) {
            $this->errormsg .= "<br/>Impossibile cancellare il file temporaneo " . $this->mysqlImportFilename;
        }
        if ($this->con != null) {
            mysql_close($this->con);
        }
    }

    public function mysqldumpOfDb($directory, $destFileName = null) {
        if ($destFileName != null) {
            $returnedFilename = $directory .$destFileName;
        } else {
            $returnedFilename = tempnam($directory, "");
        }
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysqldump\" --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseName . " --single-transaction --opt > \"" . $returnedFilename . "\" 2>&1";
        if (DEBUG){
            echo "<br/>".$command;
        }
        exec($command, $output, $worked);
        if ($worked == 1) {
            $this->errormsg .= "<br/>Impossibile esportare il file " . $this->mysqlImportFilename . " sul DB " . mysql_error();
            return false;
        }
        return $returnedFilename;
    }

    function migrate() {
        $this->mysqlImportFilename = $this->mysqldumpOfDb("tmp");
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysqldump\" --opt --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseName . " --single-transaction > \"" . $this->mysqlImportFilename . "\" 2>&1";
        exec($command, $output, $worked);
        if(DEBUG){
            echo "<br/>".$command;
            print_r($output);
            
        }
        if ($worked == 1) {
            $this->errormsg .= "<br/>Impossibile esportare il file " . $this->mysqlImportFilename . " sul DB " . mysql_error();
            return false;
        }

        $sql = "CREATE DATABASE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not create db " . $this->mysqlDatabaseNameNew . " " . mysql_error();
            return false;
        }

        $sql = "USE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not select db " . $this->mysqlDatabaseNameNew . " " . mysql_error();
            return false;
        }
        $this->migrateDbFiles($this->mysqlImportFilename);
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysql\" --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseNameNew . " < \"" . $this->mysqlImportFilename . "\"";
        if (DEBUG){
            echo $command."</br>";
            @exec($command, $output = array(), $worked);
            print_r($output);
        }else {
            exec($command, $output = array(), $worked);
        }
        if ($worked == 1) {
            $this->errormsg .= "Impossibile importare il file " . $this->mysqlImportFilename . " sul DB";
            return false;
        }
        return true;
    }

    public function exportDbToPath($sqlPath,$source,$newConfig) {
        $dumpFileOfDb = $this->mysqldumpOfDb(BASE_PATH.$source.DIRECTORY_SEPARATOR, $sqlPath);
        $content = file_get_contents($dumpFileOfDb);

        //to replace domain ref
        $replaced = str_replace("http://localhost/" . $source, "http://www." . $newConfig['domainName'] . "." . $newConfig['domain'], $content);
        
        //to replace db ref
        $replaced = str_replace("db_" . $source, $newConfig['newDb'], $replaced);
        
        //to replace something like C:/wamp/www/sitename with relative path
        $replaced = str_replace(BASE_PATH."/" . $source,"", $replaced);
        
         //to replace last localhost ref
        $replaced = str_replace("localhost", "www." . $newConfig['domainName'] . "." . $newConfig['domain'], $replaced);
        file_put_contents($dumpFileOfDb, $replaced);
        return $dumpFileOfDb;
    }

    public function migrateDbFiles($fileName) {
        $content = file_get_contents($fileName);
        $replaced = str_replace($this->sourcename, $this->destName, $content);
        $replaced = str_replace($this->mysqlDatabaseName, $this->mysqlDatabaseNameNew, $replaced);
        file_put_contents($fileName, $replaced);
    }

    private function cancellDB() {
        $sql = "DROP DATABASE IF EXISTS " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not delete existent db " . $this->mysqlDatabaseNameNew . " " . mysql_error();
            return false;
        }
    }

}

?>