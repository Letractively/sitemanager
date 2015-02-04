<?php

include_once("Executer.php");
include_once('Logger.php');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubversionWrapper
 *
 * @author Miro
 */
class SubversionWrapper {

    private $repos;
    private $username;
    private $password;
    private $exec;
    private $hasError = false;
    private $log;

    function __construct($repos, $username, $password) {
        $this->log = new MyLogPHP();
        $this->repos = $repos;
        $this->username = $username;
        $this->password = $password;
        $this->exec = new Executer();
    }

    public function getRepos() {
        return $this->repos;
    }

    public function setRepos($repos) {
        $this->repos = $repos;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getHasError() {
        return $this->hasError;
    }

    private function deleteFolder($path) {
        if (file_exists($path) && is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $file) {
                $this->deleteFolder(realpath($path) . '/' . $file);
            }
            return rmdir($path);
        } else if (file_exists($path) && is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }
    
    private function removeNotVersionedFile() {
        $command = "svn st " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if ($this->exec->getRetCode() == 0) {
            foreach ($this->exec->getStdOut() as $line) {
                if (strpos($line, "?") === 0 &&
                        ($this->repos === "" || strpos($line, $this->repos, strlen($line) - strlen($this->repos)) !== TRUE)
                ) {
                    $filename = trim(substr($line, 1));
                    if (is_file($filename)) {
                        unlink($filename);
                    }else if (is_dir($filename)){
                        $this->deleteFolder($filename);
                    }
                    $this->log->debug("Delete not versioned file [" . $filename . "]");
                }
            }
        } else {
            var_dump($this->exec->getOutput());
        }
    }

    public function forceDelete() {
        $command = "svn st " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if ($this->exec->getRetCode() == 0) {
            foreach ($this->exec->getStdOut() as $line) {
                if (strpos($line, "!") === 0 &&
                        ($this->repos === "" || strpos($line, $this->repos, strlen($line) - strlen($this->repos)) !== TRUE)
                ) {
                    echo $line . "<br>";

                    $command = "svn delete \"" . trim(substr($line, 1)) . "\" --force";
                    $this->exec->execute($command, false);
                    $this->log->debug("RETURN FROM DELETE. Ret code[" . $this->exec->getRetCode() . "]");
                    $this->log->debug("[" . $this->exec->getOutput() . "]");
                    if (($this->exec->getRetCode() != "0") || DEBUG) {
                        $this->hasError = true;
                        echo "RETURN FROM DELETE</br>";
                        echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
                        echo "[" . $this->exec->getOutput() . "]</br>";
                    }
                }
            }
        } else {
            var_dump($this->exec->getOutput());
        }
    }

    public function status() {
        $command = "svn st " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM STATUS. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if (($this->exec->getRetCode() != "0") || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM STATUS</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
    }

    function committAll($message, $id_site, $sm) {
        $command = "svn cleanup " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM CLEANUP. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if (($this->exec->getRetCode() != "0") || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM CLEANUP</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
        $this->forceDelete();
        $command = "svn add --force " . BASE_PATH . $this->repos . "\* --auto-props --parents --depth infinity -q";
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM ADD. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if (($this->exec->getRetCode() != "0") || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM ADD</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
        $command = "svn commit " . BASE_PATH . $this->repos . " -m \"" . $message . "\" --username " . SVN_USER . " --password " . SVN_PASSWORD;
        $this->exec->execute($command, true);
        $sm->insertProcessRunning($id_site, $command, $this->exec->getPid());
        $this->log->debug("RETURN FROM COMMIT. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if (($this->exec->getRetCode() != "0") || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM COMMIT</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
    }

    function updateAll() {
        $command = "svn cleanup " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM CLEANUP. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if ($this->exec->getRetCode() != "0" || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM CLEANUP</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
        $command = "svn revert -R " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM REVERT. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if ($this->exec->getRetCode() != "0" || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM LOCAL REVERT</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
        $this->removeNotVersionedFile();
        $command = "svn update " . BASE_PATH . $this->repos . " --accept theirs-full";
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM UPDATE. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if ($this->exec->getRetCode() != "0" || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM UPDATE</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
    }

    function checkout() {
        $command = "svn co http://" . SVN_SERVER . "/svn/" . $this->repos . " " . BASE_PATH . $this->repos . " --username " . SVN_USER . " --password " . SVN_PASSWORD;
        $this->exec->execute($command, false);
        $this->log->debug("RETURN FROM CHECKOUT. Ret code[" . $this->exec->getRetCode() . "]");
        $this->log->debug("[" . $this->exec->getOutput() . "]");
        if (($this->exec->getRetCode() != "0") || DEBUG) {
            $this->hasError = true;
            echo "RETURN FROM CHECKOUT</br>";
            echo "Ret code[" . $this->exec->getRetCode() . "]</br>";
            echo "[" . $this->exec->getOutput() . "]</br>";
        }
    }

    function createRepo() {
        $useragent = "Mozilla Firefox";
        $ch = curl_init();
        $url = 'http://' . SVN_SERVER . '/create.php?r=' . $this->repos;
        $this->log->debug("Call url [" . $url . "]");
        if (DEBUG) {
            echo $url . "<br/>";
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SVN_USER_ADMIN . ":" . SVN_PASSWORD_ADMIN);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        $this->log->debug("Result [" . $result . "]");
        $this->log->debug("Info [" . $info . "]");
        if (DEBUG) {
            echo $result . "\n</br>";
            print_r($info) . "\n</br>";
        }
        curl_close($ch);
        $this->checkout();
    }

    function listAllRepo() {
        $useragent = "Mozilla Firefox";
        $ch = curl_init();
        $url = 'http://' . SVN_SERVER . '/list.php?l=1';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SVN_USER_ADMIN . ":" . SVN_PASSWORD_ADMIN);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($ch);
        curl_close($ch);
        $resAsArray = json_decode($result, true);
        if ($resAsArray["return_var"] == 0 && isset($resAsArray["output"])) {
            return $resAsArray["output"];
        }
    }

    function deleteRepo() {
        $useragent = "Mozilla Firefox";
        $ch = curl_init();
        $url = 'http://' . SVN_SERVER . '/delete.php?r=' . $this->repos;
        $this->log->debug("Call url [" . $url . "]");
        if (DEBUG) {
            echo $url . "<br/>";
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SVN_USER_ADMIN . ":" . SVN_PASSWORD_ADMIN);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
    }

}

?>
