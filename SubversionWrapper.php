<?php

include_once("Executer.php");

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

    function __construct($repos, $username, $password) {
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

    public function forceDelete() {
        $command = "svn st " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if ($this->exec->getRetCode() == 0) {
            foreach ($this->exec->getStdOut() as $line) {
                if (strpos($line, "!") === 0) {
                    $command = "svn delete " . substr($line, 1);
                    $this->exec->execute($command, false);
                    if (($this->exec->getRetCode() != "" || $this->exec->getRetCode() != "0") || DEBUG) {
                        echo "RETURN FROM DELETE</br>";
                        echo $this->exec->getOutput() . "</br>";
                    }
                }
            }
        } else {
            var_dump($this->exec->getStdErr());
        }
    }

    function committAll($message,$id_site) {
        $command = "svn cleanup " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if (($this->exec->getRetCode() != "" || $this->exec->getRetCode() != "0") || DEBUG) {
            echo "RETURN FROM CLEANUP</br>";
            echo $this->exec->getOutput() . "</br>";
        }
        $this->forceDelete();
        $command = "svn add --force " . BASE_PATH . $this->repos . "\* --auto-props --parents --depth infinity -q";
        $this->exec->execute($command, false);
        if (($this->exec->getRetCode() != "" || $this->exec->getRetCode() != "0") || DEBUG) {
            echo "RETURN FROM ADD</br>";
            echo $this->exec->getOutput() . "</br>";
        }
        $command = "svn commit " . BASE_PATH . $this->repos . " -m \"" . $message . "\" --username " . SVN_USER . " --password " . SVN_PASSWORD;
        $this->exec->execute($command, true);
        $this->exec->insertProcessRunning($id_site, $command);
        if (($this->exec->getRetCode() != "" || $this->exec->getRetCode() != "0") || DEBUG) {
            echo "RETURN FROM COMMIT</br>";
            echo $this->exec->getOutput() ."</br>";
        }
    }

    function updateAll() {
        $command = "svn cleanup " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if (DEBUG) {
            echo "RETURN FROM CLEANUP</br>";
            echo $this->exec->getOutput() . "</br>";
        }
        $command = "svn update " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if (DEBUG) {
            echo "RETURN FROM UPDATE</br>";
            echo $this->exec->getOutput() . "</br>";
        }
    }

    function checkout() {
        $command = "svn co http://" . SVN_SERVER . "/svn/" . $this->repos . " " . BASE_PATH . $this->repos . " --username " . SVN_USER . " --password " . SVN_PASSWORD;
        $this->exec->execute($command, false);
        if (($this->exec->getRetCode() != "" || $this->exec->getRetCode() != "0") || DEBUG) {
            echo "RETURN FROM CHECKOUT</br>";
            echo $this->exec->getOutput() . "</br>";
        }
    }

    function createRepo() {
        $useragent = "Mozilla Firefox";
        $ch = curl_init();
        $url = 'http://' . SVN_SERVER . '/create.php?r=' . $this->repos;
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
        if (DEBUG) {
            echo $url . "<br/>";
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, SVN_USER_ADMIN . ":" . SVN_PASSWORD_ADMIN);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($ch);
        if (DEBUG) {
            echo $result . "\n</br>";
        }
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
