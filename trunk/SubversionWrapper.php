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

    function committAll($message) {
        $command = "svn cleanup " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        $command = "svn add --force " . BASE_PATH . $this->repos . "\* --auto-props --parents --depth infinity -q";
        $this->exec->execute($command, false);
        if (DEBUG) {
            echo "RETURN FROM ADD</br>";
            echo "Stdout: </br>";
            print_r($this->exec->getStdOut());
            echo "</br>";
            echo "StdErr: </br>";
            print_r($this->exec->getStdErr());
            echo "</br>Return code: " . $this->exec->getRetCode();
        }
        $command = "svn commit " . BASE_PATH . $this->repos . " -m \"" . $message . "\" --username " . SVN_USER . " --password " . SVN_PASSWORD;
        $this->exec->execute($command, true);
        if (DEBUG) {
            echo "RETURN FROM COMMIT</br>";
            echo "Stdout: </br>";
            print_r($this->exec->getStdOut());
            echo "</br>";
            echo "StdErr: </br>";
            print_r($this->exec->getStdErr());
            echo "</br>Return code: " . $this->exec->getRetCode();
        }
    }

    function updateAll() {
        $command = "svn cleanup " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if (DEBUG) {
            echo "RETURN FROM CLEANUP</br>";
            echo "Stdout: </br>";
            var_dump($this->exec->getStdOut());
            echo "</br>";
            echo "StdErr: </br>";
            var_dump($this->exec->getStdErr());
            echo "</br>Return code: " . $this->exec->getRetCode();
        }
        $command = "svn update " . BASE_PATH . $this->repos;
        $this->exec->execute($command, false);
        if (DEBUG) {
            echo "RETURN FROM UPDATE</br>";
            echo "Stdout: </br>";
            var_dump($this->exec->getStdOut());
            echo "</br>";
            echo "StdErr: </br>";
            var_dump($this->exec->getStdErr());
            echo "</br>Return code: " . $this->exec->getRetCode();
        }
    }

    function executeQuery($fileSql) {
        if (file_exists($fileSql)) {
            $command = "\"" . MYSQL_BIN_BASE_PATH . "mysql\" --host=" . MYSQL_HOST . " --user=" . MYSQL_USER_NAME . " --password=" . MYSQL_PASSWORD . " " . DB_SITEMANAGER_NAME . " < \"" . $fileSql . "\"";
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
            }else {
                unlink($fileSql);
            }
        }
    } 

    function checkout() {
        $command = "svn co http://" . SVN_SERVER . "/svn/" . $this->repos . " " . BASE_PATH . $this->repos . " --username " . SVN_USER . " --password " . SVN_PASSWORD;
        $this->exec->execute($command, false);
        if (DEBUG) {
            echo "RETURN FROM CHECKOUT</br>";
            echo "Stdout: </br>";
            print_r($this->exec->getStdOut());
            echo "</br>";
            echo "StdErr: </br>";
            print_r($this->exec->getStdErr());
            echo "</br>Return code: " . $this->exec->getRetCode();
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
