<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WPMigrateFile {

    public $sourcePath;
    public $destPath;
    public $errorMsg;

    function __construct($sourcePath, $destPath) {
        $this->sourcePath = $sourcePath;
        $this->destPath = $destPath;
    }

    function cloneSite() {
        $this->recurseCopy($this->sourcePath, $this->destPath);
    }

    function recurseCopy($src, $dst) {
        if (file_exists($dst) && is_dir($dst)) {
            $this->removeDir($dst);
        }
        if (!is_dir($src)) {
            $this->errorMsg = $src . " is not a dir";
            return false;
        }
        $dir = opendir($src);
        if (!mkdir($dst)) {
            $this->errorMsg = "Could not create dir " . $dst;
            return false;
        }
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    if (!copy($src . '/' . $file, $dst . '/' . $file)) {
                        $this->errorMsg = "Could not copy " . $src . '/' . $file;
                        return false;
                    }
                }
            }
        }
        closedir($dir);
        return true;
    }

    function changeWpconfig($searchFor, $replaceWith) {
        $wpConfigFile = $this->destPath . "\wp-config.php";
        $file = file_get_contents($wpConfigFile);
        if ($file) {
            $file = str_replace($searchFor, $replaceWith, $file);
        } else {
            echo "File " . $wpConfigFile . " not found</br>";
            return;
        }
        $fh = fopen($wpConfigFile, 'w');
        if($fh) {
            fwrite($fh, $file);
            fclose($fh);
        } else {
            echo "Could not open new " . $wpConfigFile . " file</br>";
        }
    }

    function removeDir($dir) {
        if (DEBUG) {
            echo "Removing: " . $dir . "</br>";
        }
        if (!file_exists($dir))
            return true;
        if (!is_dir($dir) || is_link($dir)) {
            if (DEBUG) {
                echo "Removing: " . $dir . "</br>";
            }
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..')
                continue;
            if (!$this->removeDir($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!$this->removeDir($dir . "/" . $item))
                    return false;
            };
        }
        if (DEBUG) {
            echo "Removing: " . $dir . "</br>";
        }
        return rmdir($dir);
    }

}

?>
