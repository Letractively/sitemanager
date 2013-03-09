<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Backuper {

    private $tempFolder;

    function __construct($tempFolder = "tempzip") {
        $directory = __DIR__ . "/" . $tempFolder;
        if (!file_exists($directory) || !is_dir($directory)) {
            mkdir($directory);
        }
        $this->tempFolder = $tempFolder;
    }

    private function copyInTempFolder() {
        $dbcloner = new DBCloner($mysqlDatabaseName, MYSQL_USER_NAME, MYSQL_PASSWORD, MYSQL_HOST, null, $source, $newSite);
        $fileOfDb = $dbcloner->mysqldumpOfDb($this->tempFolder);
        rename($fileOfDb, $this->tempFolder . basename($fileOfDb));
        $migratater = new WPMigrateFile($sourcePath, $this->tempFolder);
        $migrater->cloneSite();
    }

    public function createZipOfFolder($album, $overwrite = false) {
        $files = glob($this->tempFolder);
        $zip = new ZipArchive();
        $fileName = date('Ymd') . '_backup.zip';
        $zipFileName = $this->tempFolder . $fileName;
        if (!file_exists($zipFileName) || $overwrite) {
            @unlink($zipFileName);
            if ($zip->open($zipFileName, ZIPARCHIVE::CREATE) !== TRUE) {
                die("Could not open archive");
            }
            foreach ($files as $f) {
                $zip->addFile($f, $f) or die("ERROR: Could not add file: $f");
            }
            $zip->close();
        }
        return $zipFileName;
    }

}

?>
