<?php
session_start();
include "config.php";
include "constant.php";
// include "vendor/autoload.php";




//db config lgbdairy
$dns = "mysql:dbname=$database_config->db;$database_config->host";

try{
    $db  = new PDO($dns,$database_config->user,$database_config->password);
    $db->exec("set names utf8");
}catch(Exception $e){
    die("could not connect" . $e->getMessage());
}




include BASE_PATH . "lib/libs.php";
// include BASE_PATH . "lib/helpers.php";





















