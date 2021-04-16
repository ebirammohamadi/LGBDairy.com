<?php
include "bootstrap/init.php";





//check loged in or not
if(isLoggedIn()){$_SESSION['login'];}










//select group product 
$selectGroupProducts = selectGroupProduct(); 

//select all product desc and new is list 
$selectProductAlls = selectProductnew();

//select product by kind of product
// $selectProductkinds = selectProductByKind($title);












include "tpl/index.php";