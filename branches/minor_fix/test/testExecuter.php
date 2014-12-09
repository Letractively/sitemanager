<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once("../config.php");
include_once("../Executer.php");

$newSite = "toptest";

//$exec = new Executer();
//$exec->execute("svn delete D:\wamp\www\prova", false);

exec("svn delete D:\wamp\www\prova 2>&1", $output, $return_var);
print_r($output);
?>


