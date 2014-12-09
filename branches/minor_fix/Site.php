<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Site
 *
 * @author Miro
 */
class Site {

    public $nome;
    public $id;
    public $cliente_id;
    public $modello_id;
    public $data_acquisto;
    public $ref_mail;
    public $ftp_host;
    public $ftp_username;
    public $ftp_pwd;
    public $db;
    public $dbusername;
    public $dbpwd;
    public $hostdb;
    public $domainName;
    public $domain;
    public $status;

    function __construct($siteData) {
        if ($siteData != null) {
            $this->nome = $siteData['nome'];
            $this->id = $siteData['id'];
            $this->cliente_id = $siteData['cliente_id'];
            $this->modello_id = $siteData['modello_id'];
            $this->data_acquisto = $siteData['data_acquisto'];
            $this->ref_mail = $siteData['ref_mail'];
            $this->ftp_host = $siteData['ftp_host'];
            $this->ftp_pwd = $siteData['ftp_pwd'];
            $this->ftp_username = $siteData['ftp_username'];
            $this->db = $siteData['db'];
            $this->dbusername = $siteData['dbusername'];
            $this->dbpwd = $siteData['dbpwd'];
            $this->db = $siteData['db'];
            $this->hostdb = $siteData['hostdb'];
            $this->domainName = $siteData['domainName'];
            $this->domain = $siteData['domain'];
            $this->status = $siteData['status'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCliente_id() {
        return $this->cliente_id;
    }

    public function getModello_id() {
        return $this->modello_id;
    }

    public function getData_acquisto() {
        return $this->data_acquisto;
    }

    public function getRef_mail() {
        return $this->ref_mail;
    }

    public function getFtp_host() {
        return $this->ftp_host;
    }

    public function getFtp_username() {
        return $this->ftp_username;
    }

    public function getFtp_pwd() {
        return $this->ftp_pwd;
    }

    public function getDb() {
        return $this->db;
    }

    public function getDbusername() {
        return $this->dbusername;
    }

    public function getDbpwd() {
        return $this->dbpwd;
    }

    public function getHostdb() {
        return $this->hostdb;
    }

    public function getDomainName() {
        return $this->domainName;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCliente_id($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function setModello_id($modello_id) {
        $this->modello_id = $modello_id;
    }

    public function setData_acquisto($data_acquisto) {
        $this->data_acquisto = $data_acquisto;
    }

    public function setRef_mail($ref_mail) {
        $this->ref_mail = $ref_mail;
    }

    public function setFtp_host($ftp_host) {
        $this->ftp_host = $ftp_host;
    }

    public function setFtp_username($ftp_username) {
        $this->ftp_username = $ftp_username;
    }

    public function setFtp_pwd($ftp_pwd) {
        $this->ftp_pwd = $ftp_pwd;
    }

    public function setDb($db) {
        $this->db = $db;
    }

    public function setDbusername($dbusername) {
        $this->dbusername = $dbusername;
    }

    public function setDbpwd($dbpwd) {
        $this->dbpwd = $dbpwd;
    }

    public function setHostdb($hostdb) {
        $this->hostdb = $hostdb;
    }

    public function setDomainName($domainName) {
        $this->domainName = $domainName;
    }

    public function setDomain($domain) {
        $this->domain = $domain;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function save($name) {
        $s = serialize($this);
        file_put_contents($name, $s);
    }

    public function load($name) {
        if (file_exists($name)) {
            $s = file_get_contents($name);
            $obj = unserialize($s);
            $this->nome = $obj->nome;
            $this->data_acquisto = $obj->data_acquisto;
            $this->db = $obj->db;
            $this->dbpwd = $obj->dbpwd;
            $this->dbusername = $obj->dbusername;
            $this->domain = $obj->domain;
            $this->domainName = $obj->domainName;
            $this->ftp_host = $obj->ftp_host;
            $this->ftp_pwd = $obj->ftp_pwd;
            $this->ftp_username = $obj->ftp_username;
            $this->hostdb = $obj->hostdb;
            $this->modello_id = $obj->modello_id;
            $this->status = $obj->status;
            $this->ref_mail = $obj->ref_mail;
        }
    }

}
