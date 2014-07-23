<?php

include("DBConfig.php");

class DBCloner {

    public $dbConfigSource;
    public $errormsg;
    public $mysqlDatabaseName;
    public $mysqlDatabaseNameNew;
    public $sourcename;
    public $mysqlImportFilename;
    public $destName;
    private $con = null;

    /**
     * 
     * 
     * 
     * @param type $mysqlDatabaseName : database source, where to connect
     * @param type $mysqlUserName : username used to connect to DB
     * @param type $mysqlPassword : password used to connect to DB
     * @param type $mysqlHostName : host of the DB
     * @param type $mysqlDatabaseNameNew : new database name
     * @param type $source : string in the DB sql file to search for
     * @param type $dest : string in the DB sql file to replace with
     */
    function __construct($mysqlDatabaseName, $mysqlUserName, $mysqlPassword, $mysqlHostName, $mysqlDatabaseNameNew, $source, $dest) {
        $this->dbConfigSource = new DBConfig($mysqlHostName, $mysqlUserName, $mysqlPassword);

        $this->mysqlDatabaseName = $mysqlDatabaseName;
        $this->mysqlDatabaseNameNew = $mysqlDatabaseNameNew;
        $this->sourcename = $source;
        $this->destName = $dest;

        $this->con = $this->dbConfigSource->connect();
    }

    public function getMysqlImportFilename() {
        return $this->mysqlImportFilename;
    }

    public function setMysqlImportFilename($mysqlImportFilename) {
        $this->mysqlImportFilename = $mysqlImportFilename;
    }

    public function cleanAndClose() {
        if ($this->con != null) {
            mysql_close($this->con);
        }
    }

    function recursive_unserialize_replace($data, $key = null) {
        $stringToFix = $data[3];
        if (DEBUG) {
            echo "Before [" . $stringToFix . "]</br>";
        }
        $stringToFix = str_replace('\"', '"', $stringToFix);
        $stringToFix = str_replace(PHP_EOL, "", $stringToFix);
        $stringToFix = str_replace("\\r\\n", "", $stringToFix);
        $stringToFix = str_replace("\r\n", "", $stringToFix);
        if (is_string($stringToFix) && ( $unserialized = @unserialize($stringToFix) ) === false) {
            $stringToFix = str_replace("'", "\'", html_entity_decode($stringToFix, ENT_QUOTES, 'UTF-8'));
            $stringToFix = preg_replace_callback('/s:(\d+):"(.*?)";/', function ($match) {
                $temp = intval(strlen($match[2]));
                $result = 's:' . $temp . ':"' . $match[2] . '";';
                return $result;
            }, $stringToFix);
        }
        if (DEBUG && ( $unserialized = @unserialize($stringToFix) ) === false) {
            echo "Still error in [".$stringToFix. "]</br>";
        }
        $stringToFix = str_replace('"', '\"', $stringToFix);
        if (DEBUG) {
            echo "After [" . $stringToFix . "]</br>";
        }
        $result = "(" . $data[1] . ",'theme_mods_arras" . $data[2] . "','" . $stringToFix . "','" . $data[4] . "')";
        return $result;
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
            $this->errormsg .= "<br/>Impossibile esportare il DB " . $this->mysqlDatabaseName . " " . mysql_error();
            return false;
        }
        return $returnedFilename;
    }

    function importFile() {
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
    }

    function createDb() {
        $sql = "CREATE DATABASE " . $this->mysqlDatabaseNameNew;
        if (!mysql_query($sql, $this->con)) {
            $this->errormsg .= "Could not create db " . $this->mysqlDatabaseNameNew . " " . mysql_error();
            return false;
        }
    }

    function migrate($isLocal = true) {
        $this->mysqlImportFilename = $this->mysqldumpOfDb(BASE_PATH . $this->destName . DIRECTORY_SEPARATOR, $this->mysqlDatabaseNameNew . ".sql");
        $this->createDb();

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

    public function exportDbToPath($sqlPath, $isLocal = true) {
        $dumpFileOfDb = $this->mysqldumpOfDb(BASE_PATH . $this->sourcename . DIRECTORY_SEPARATOR, $sqlPath);
        $this->migrateDbFiles($dumpFileOfDb, $isLocal);
        return $dumpFileOfDb;
    }

    public function changeNextGenOption() {
        $sql = "USE " . $this->mysqlDatabaseNameNew;
        mysql_query($sql, $this->con);
        $sql = "SELECT ID, post_content FROM wp_posts WHERE post_type='lightbox_library'";
        $result = mysql_query($sql, $this->con);
        if (!$result) {
            die("Database query failed: " . mysql_error());
        }
        while ($row = mysql_fetch_assoc($result)) {
            $newString = str_replace('\/', '/', base64_decode($row['post_content']));
            $newString = str_replace($this->sourcename, $this->destName, $newString);
            $newString = str_replace('/', '\/', $newString);
            $cleaned = base64_encode($newString);
            $updQuery = "UPDATE wp_posts SET post_content='" . $cleaned . "',post_content_filtered='" . $cleaned . "' WHERE ID=" . $row['ID'];
            if (!mysql_query($updQuery, $this->con)) {
                die("Database query failed: " . mysql_error());
            }
        }
    }

    public function migrateDbFiles($fileName, $isLocal = true) {
        $content = file_get_contents($fileName);
        if (DEBUG) {
            echo "replace [" . $this->sourcename . "]  with [" . $this->destName . "]<br/>";
        }
        if ($isLocal) {
            $content = str_replace($this->sourcename, $this->destName, $content);
        } else {
            $content = str_replace("http://" . DOMAIN_URL_BASE . "/" . $this->sourcename, $this->destName, $content);
        }
        $pathTobeRemoved = str_replace("\\", "/", dirname(BASE_PATH . $this->sourcename . "\\index.php") . "\\");
        $content = str_replace($pathTobeRemoved, "", $content);
        $content = str_replace($this->mysqlDatabaseName, $this->mysqlDatabaseNameNew, $content);
        $pattern = "/\((\d+)\s?,\s?'theme_mods_arras(.+?)'\s?,\s?'(.+?)'\s?,\s?'(...?)'\s?\)/";
        $content = preg_replace_callback($pattern, array($this, 'recursive_unserialize_replace'), $content);
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