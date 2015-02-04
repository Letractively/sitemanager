<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class WPMigrateFile {

    public $sourcePath;
    public $destPath;
    public $errorMsg;
    public $excludefile = array();

    function __construct($sourcePath, $destPath) {
        $this->sourcePath = $sourcePath;
        $this->destPath = $destPath;
    }

    function cloneSite() {
        $sourceName = str_replace(BASE_PATH, "", $this->sourcePath);
        foreach (glob($this->sourcePath . DIRECTORY_SEPARATOR . "*" . $sourceName . "*") as $filename) {
            $excludefile[] = $filename;
        }
        if (file_exists($this->sourcePath . DIRECTORY_SEPARATOR . "wp-config-remote.php")) {
            $excludefile[] = $this->destPath . DIRECTORY_SEPARATOR . "wp-config-remote.php";
        }
        if (file_exists($this->sourcePath . DIRECTORY_SEPARATOR . ".htaccess-remote")) {
            $excludefile[] = $this->destPath . DIRECTORY_SEPARATOR . ".htaccess-remote";
        }
        $this->excludefile = $excludefile;
        $result = $this->recurseCopy($this->sourcePath, $this->destPath);
        return $result;
    }

    function recurseCopy($src, $dst) {
        if (file_exists($dst) && is_dir($dst)) {
            $this->removeDir($dst);
            return false;
        }
        if (!is_dir($src)) {
            $this->errorMsg .= $src . " is not a dir";
            return false;
        }
        $dir = opendir($src);
        if (strpos($dst, '.svn') === false) {
            if (!mkdir($dst)) {
                $this->errorMsg .= "Could not create dir " . $dst;
                return false;
            }
        }
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' ) && ( $file != '.svn' )&& !in_array($src .'\\'.$file, $this->excludefile)) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    if (!copy($src . '/' . $file, $dst . '/' . $file)) {
                        $this->errorMsg .= "Could not copy " . $src . '/' . $file;
                        return false;
                    }
                }
            }
        }
        closedir($dir);
        return true;
    }

    function changeWpconfig($searchFor, $replaceWith) {
        $wpConfigFile = $this->destPath . DIRECTORY_SEPARATOR . "wp-config.php";
        $file = file_get_contents($wpConfigFile);
        if ($file) {
            $file = str_replace($searchFor, $replaceWith, $file);
        } else {
            $this->errorMsg .= $wpConfigFile . " non aperto<br>";
        }
        $fh = fopen($wpConfigFile, 'w');
        if (fwrite($fh, $file) === false) {
            $this->errorMsg .= "Cannot write to file ($wpConfigFile)<br>";
        }
        fclose($fh);
    }

    function switchConfigFile($fileToSwitchup, $backName = null) {
        if (file_exists($this->destPath . DIRECTORY_SEPARATOR . $fileToSwitchup) && is_file($this->destPath . DIRECTORY_SEPARATOR . $fileToSwitchup)) {
            if ($backName != null && $backName != "") {
                $file = file_get_contents($this->destPath . DIRECTORY_SEPARATOR . "wp-config.php");
                $fh = fopen($this->destPath . DIRECTORY_SEPARATOR . $backName, 'w');
                if (fwrite($fh, $file) === false) {
                    echo "Cannot write to file ($backName)<br>";
                }
                fclose($fh);
            }
            if (!rename($this->destPath . DIRECTORY_SEPARATOR . $fileToSwitchup, $this->destPath . DIRECTORY_SEPARATOR . "wp-config.php")) {
                echo "Cannot switch to file (" . $fileToSwitchup . ")<br>";
            }
        }
    }

    function createReleaseConfigAndBckpLocal($newConfig) {
        $sitenameOld = basename($this->sourcePath);
        $wpConfigFile = $this->destPath . DIRECTORY_SEPARATOR . "wp-config.php";
        $wpConfigFileLocale = $this->destPath . DIRECTORY_SEPARATOR . "wp-config-locale.php";
        $file = file_get_contents($wpConfigFile);
        $fh = fopen($wpConfigFileLocale, 'w');
        if (fwrite($fh, $file) === false) {
            $echo.= "Cannot write to file ($wpConfigFileLocale)<br>";
        }
        fclose($fh);
        if ($file) {
            $file = str_replace("define('DB_NAME', 'db_" . $sitenameOld . "');", "define('DB_NAME', '" . $newConfig['newDb'] . "');", $file);
            $file = str_replace("define('DB_USER', '" . MYSQL_USER_NAME . "');", "define('DB_USER', '" . $newConfig['userName'] . "');", $file);
            $file = str_replace("define('DB_PASSWORD', '" . MYSQL_PASSWORD . "');", "define('DB_PASSWORD', '" . $newConfig['password'] . "');", $file);
            $file = str_replace("define('DB_HOST', '" . MYSQL_HOST . "');", "define('DB_HOST', '" . $newConfig['hostdb'] . "');", $file);
        } else {
            $echo = $wpConfigFile . " non aperto<br>";
        }

        $fh = fopen($wpConfigFile, 'w');
        if (fwrite($fh, $file) === false) {
            $echo.= "Cannot write to file ($wpConfigFile)<br>";
        }
        fclose($fh);
    }

    function removeDir($dir) {
        $this->errorMsg .= "La pagina esiste già";
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
