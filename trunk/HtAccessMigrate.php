<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtAccessMigrate
 *
 * @author Miro
 */
class HtAccessMigrate {

    private $newSite;
    private $source;
    private $fileName;

    function __construct($newSite, $source) {
        $this->newSite = $newSite;
        $this->source = $source;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function changeHtAccess($isLocal = true) {
        if ($isLocal) {
            $htaccess = BASE_PATH . $this->newSite . DIRECTORY_SEPARATOR . ".htaccess";
            $file = file_get_contents($htaccess);
            if ((!file_exists($file) && is_writable(BASE_PATH . $this->newSite) ) || is_writable($file)) {
                $rules = explode("\n", $file);
                foreach ($rules as $key => $line) {
                    $rules[$key] = str_replace($this->source, $this->newSite, $line);
                }
                $file = implode("\n", $rules);
            } else {
                echo $htaccess . " non aperto<br>";
            }
            $this->fileName =$htaccess;
            $fh = fopen($this->fileName, 'w');
            if (fwrite($fh, $file) === false) {
                echo "Cannot write to file ($htaccess)<br>";
            }
            fclose($fh);
        } else {
            $htaccess = BASE_PATH . $this->source . DIRECTORY_SEPARATOR . ".htaccess";
            $file = file_get_contents($htaccess);
            if ((!file_exists($file) && is_writable(BASE_PATH . $this->source) ) || is_writable($file)) {
                $rules = explode("\n", $file);
                foreach ($rules as $key => $line) {
                    $rules[$key] = str_replace($this->source . "/", "", $line);
                }
                $file = implode("\n", $rules);
            } else {
                echo $htaccess . " non aperto<br>";
            }
            $this->fileName = $htaccess . "-remote";
            $fh = fopen($this->fileName, 'w');

            if (fwrite($fh, $file) === false) {
                echo "Cannot write to file ($htaccess)<br>";
            }
            fclose($fh);
        }
    }

}

?>
