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

    function recursive_unserialize_replace($data) {
        if (is_string($data) && ( $unserialized = @unserialize($data) ) === false) {
            $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');
            $data = str_replace("\n", '', $data);
            $data = str_replace("\r", '', $data);
            $data = str_replace("\r\n", '', $data);
            $data = preg_replace_callback('/s:(\d+):"(.*?)";/', function($match) {
                        $temp = strlen($match[2]);
                        $result = "s:" . $temp . ":\"" . $match[2] . "\";";
                        return $result;
                    }, $data);
        }
        $obj = unserialize($data);
        return $data;
    }

    public function fixSerializedData() {
        $update_sql = array();
        $upd = false;
        $query = "SELECT option_id,option_name,option_value FROM " . "db_" .$this->destName  . ".wp_options WHERE option_name IN ('arras_options','widget_text','WPS_setting','dashboard_widget_options','aio-favicon_settings')";
        if (DEBUG) {
            echo $query."<br/>";
        }
        if (!($data = mysql_query($query, $this->con))) {
            echo mysql_error();
            return false;
        }
        while ($row = mysql_fetch_array($data)) {
            $edited_data = $data_to_fix = $row['option_value'];
            $edited_data = $this->recursive_unserialize_replace($data_to_fix);
            // Something was changed
            if ($edited_data != $data_to_fix) {
                $update_sql[] = 'UPDATE ' . "db_" .$this->destName  . '.wp_options SET option_value = "' . mysql_real_escape_string($edited_data) . '" WHERE option_id = ' . $row['option_id'];
                $upd = true;
            }
        }
        if ($upd) {
            foreach ($update_sql as $updQuery) {
                $result = mysql_query($updQuery, $this->con);
                if (!$result) {
                    print_r(mysql_error());
                }
            }
        }
    }

    public function mysqldumpOfDb($directory, $destFileName = null) {
        if ($destFileName != null) {
            $returnedFilename = $directory . $destFileName;
        } else {
            $returnedFilename = tempnam($directory, "");
        }
        $command = "\"" . MYSQL_BIN_BASE_PATH . "mysqldump\" --host=" . $this->mysqlHostName . " --user=" . $this->mysqlUserName . " --password=" . $this->mysqlPassword . " " . $this->mysqlDatabaseName . " --single-transaction --opt > \"" . $returnedFilename . "\" 2>&1";
        if (DEBUG) {
            echo "<br/>" . $command;
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
        if (DEBUG) {
            echo $command . "</br>";
            @exec($command, $output = array(), $worked);
            if ($output!=null){
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

    public function exportDbToPath($sqlPath, $source, $newConfig) {
        $dumpFileOfDb = $this->mysqldumpOfDb(BASE_PATH . $source . DIRECTORY_SEPARATOR, $sqlPath);
        $content = file_get_contents($dumpFileOfDb);

        //to replace domain ref
        $replaced = str_replace("http://localhost/" . $source, "http://www." . $newConfig['domainName'] . "." . $newConfig['domain'], $content);

        //to replace db ref
        $replaced = str_replace("db_" . $source, $newConfig['newDb'], $replaced);

        //to replace something like C:/wamp/www/sitename with relative path
        $replaced = str_replace(BASE_PATH . "/" . $source, "", $replaced);

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