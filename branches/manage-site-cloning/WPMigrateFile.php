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
            //TODO remove return if we want to delete and recreate new folder
            return false;
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
        }
        $fh = fopen($wpConfigFile, 'w');
        fwrite($fh, $file);
        fclose($fh);
    }

    function removeDir($dir) {
        $this->errorMsg = "La pagina esiste già";
        /*
          if (!file_exists($dir))
          return true;
          if (!is_dir($dir) || is_link($dir))
          return unlink($dir);
          foreach (scandir($dir) as $item) {
          if ($item == '.' || $item == '..')
          continue;
          if (!$this->removeDir($dir . "/" . $item)) {
          chmod($dir . "/" . $item, 0777);
          if (!$this->removeDir($dir . "/" . $item))
          return false;
          };
          }
          return rmdir($dir);
         */
    }

}

?>
