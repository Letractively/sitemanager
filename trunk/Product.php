<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Miro
 */
class Product {
    
    private $id;
    private $name;
    private $client_id;
    private $model_id;
    private $bought_data;
    private $mail;
    private $ftp_host;
    private $ftp_username;
    private $ftp_pwd;
    private $db_host;
    private $db_username;
    private $db_pwd;
    private $domain_name;
    private $domain;
    private $status;
    
    function __construct() {
        
    }

    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getClient_id() {
        return $this->client_id;
    }

    public function setClient_id($client_id) {
        $this->client_id = $client_id;
    }

    public function getModel_id() {
        return $this->model_id;
    }

    public function setModel_id($model_id) {
        $this->model_id = $model_id;
    }

    public function getBought_data() {
        return $this->bought_data;
    }

    public function setBought_data($bought_data) {
        $this->bought_data = $bought_data;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getFtp_host() {
        return $this->ftp_host;
    }

    public function setFtp_host($ftp_host) {
        $this->ftp_host = $ftp_host;
    }

    public function getFtp_username() {
        return $this->ftp_username;
    }

    public function setFtp_username($ftp_username) {
        $this->ftp_username = $ftp_username;
    }

    public function getFtp_pwd() {
        return $this->ftp_pwd;
    }

    public function setFtp_pwd($ftp_pwd) {
        $this->ftp_pwd = $ftp_pwd;
    }

    public function getDb_host() {
        return $this->db_host;
    }

    public function setDb_host($db_host) {
        $this->db_host = $db_host;
    }

    public function getDb_username() {
        return $this->db_username;
    }

    public function setDb_username($db_username) {
        $this->db_username = $db_username;
    }

    public function getDb_pwd() {
        return $this->db_pwd;
    }

    public function setDb_pwd($db_pwd) {
        $this->db_pwd = $db_pwd;
    }

    public function getDomain_name() {
        return $this->domain_name;
    }

    public function setDomain_name($domain_name) {
        $this->domain_name = $domain_name;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function setDomain($domain) {
        $this->domain = $domain;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


    
}

?>
