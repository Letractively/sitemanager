<?php

include("DBConfig.php");

class DBCloner {

    public $dbConfigSource;
    public $errormsg;
    public $mysqlDatabaseName;
    public $mysqlDatabaseNameNew;
    public $sourcename;
    public $destName;
    private $con = null;

    function __construct($mysqlDatabaseName, $mysqlUserName, $mysqlPassword, $mysqlHostName, $mysqlDatabaseNameNew, $source, $dest) {
        $this->dbConfigSource = new DBConfig($mysqlHostName, $mysqlUserName, $mysqlPassword);

        $this->mysqlDatabaseName = $mysqlDatabaseName;
        $this->mysqlDatabaseNameNew = $mysqlDatabaseNameNew;
        $this->sourcename = $source;
        $this->destName = $dest;

        $this->con = $this->dbConfigSource->connect();
    }

    public function cleanAndClose() {
        if (!unlink($this->mysqlImportFilename)) {
            $this->errormsg .= "<br/>Impossibile cancellare il file temporaneo " . $this->mysqlImportFilename;
        }
        if ($this->con != null) {
            mysql_close($this->con);
        }
    }

    function fixLength($match) {
        $temp = intval(strlen($match[2]));
        $result = 's:' . $temp . ':"' . $match[2] . '";';
        return $result;
    }

    function recursive_unserialize_replace($data, $key = null) {
        if (is_string($data) && ( $unserialized = @unserialize($data) ) === false) {
            $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');
            $data = preg_replace_callback('/s:(\d+):"(.*?)";/', array(&$this, 'fixLength'), $data);
        }
        $obj = unserialize($data);
        return $data;
    }

    public function mysqldumpOfDb($directory, $destFileName = null) {
        if ($destFileName != null) {
            $returnedFilename = $directory . $destFileName;
        } else {
            $returnedFilename = tempnam($directory, "");
        }
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysqldump\" --host=" . $this->dbConfigSource->getHostDb() . " --user=" . $this->dbConfigSource->getUsernameDb() . " --password=" . $this->dbConfigSource->getPasswordDb() . " " . $this->mysqlDatabaseName . " --single-transaction --opt > \"" . $returnedFilename . "\" 2>&1";
        if (DEBUG) {
            echo "<br/>" . $command . "<br/>";
        }
        exec($command, $output, $worked);
        if ($worked == 1) {
            $this->errormsg .= "<br/>Impossibile esportare il file " . $this->mysqlImportFilename . " sul DB " . mysql_error();
            return false;
        }
        return $returnedFilename;
    }

    function migrate($isLocal = true) {
        $this->mysqlImportFilename = $this->mysqldumpOfDb("tmp");
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
        $this->migrateDbFiles($this->mysqlImportFilename, $isLocal);
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysql\" --host=" . $this->dbConfigSource->getHostDb() . " --user=" . $this->dbConfigSource->getUsernameDb() . " --password=" . $this->dbConfigSource->getPasswordDb() . " " . $this->mysqlDatabaseNameNew . " < \"" . $this->mysqlImportFilename . "\"";
        if (DEBUG) {
            echo $command . "</br>";
            @exec($command, $output = array(), $worked);
            if ($output != null) {
                print_r($output);
                echo "</br>";
            }
        } else {
            exec($command, $output = array(), $worked);
        }
        if ($worked == 1) {
            $this->errormsg .= "Impossibile importare il file " . $this->mysqlImportFilename . " sul DB";
            return false;
        }
        return true;
    }

    public function exportDbToPath($sqlPath,$isLocal=true) {
        $dumpFileOfDb = $this->mysqldumpOfDb(BASE_PATH . $this->sourcename . DIRECTORY_SEPARATOR, $sqlPath);
        $this->migrateDbFiles($dumpFileOfDb,$isLocal);
        return $dumpFileOfDb;
    }

    public function sqlFileCheckProperties($match) {
        if (strpos($match[3], ":") > 0 && strpos($match[3], "{") && strpos($match[3], $this->destName)) {
            $cleaned = str_replace('\"', '"', $match[3]);
            $cleaned = str_replace(PHP_EOL, "", $cleaned);
            $cleaned = str_replace("\\r\\n", "", $cleaned);
            $cleaned = str_replace("\r\n", "", $cleaned);
            $cleaned = $this->recursive_unserialize_replace($cleaned, $match[3]);
            $result = "(" . $match[1] . ",'" . $match[2] . "','" . mysql_real_escape_string($cleaned) . "','" . $match[4] . "')";
        } else {
            $result = $match[0];
        }
        return $result;
    }

    public function migrateDbFiles($fileName, $isLocal = true) {
        $content = file_get_contents($fileName);
        if (DEBUG) {
            echo "replace [" . $this->sourcename . "]  with [" . $this->destName . "]<br/>";
        }
        if ($isLocal) {
            $content = str_replace($this->sourcename, $this->destName, $content);
        }else {
            $content = str_replace("http://localhost/".$this->sourcename, $this->destName, $content);
        }
        $content = str_replace($this->mysqlDatabaseName, $this->mysqlDatabaseNameNew, $content);
        $pattern = "/\((\d+),'(.+?)','(.?|.+?)','(...?)'\)/";
        $content = preg_replace_callback($pattern, array($this, 'sqlFileCheckProperties'), $content);
        file_put_contents($fileName, $content);
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