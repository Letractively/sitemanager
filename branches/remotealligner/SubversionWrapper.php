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
        $command = "svn add --force " . BASE_PATH . $this->repos . "\* --auto-props --parents --depth infinity -q";
        $this->exec->execute($command);
        $command = "svn commit " . BASE_PATH . $this->repos . " -m \"" . $message . "\"";
        $this->exec->execute($command);
    }

    function updateAll() {
        $command = "svn update";
        $this->exec->execute($command);
    }

    function checkout() {
        $command = "svn co http://" . SVN_SERVER . "/svn/" . $this->repos . " " . BASE_PATH . $this->repos;
        $this->exec->execute($command);
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
        curl_setopt($ch, CURLOPT_USERPWD, SVN_USER . ":" . SVN_PASSWORD);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        $this->checkout();
        $this->committAll("first import " . $this->repos);
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
            curl_setopt($ch, CURLOPT_USERPWD, SVN_USER . ":" . SVN_PASSWORD);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            $result = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
    }

}

?>
