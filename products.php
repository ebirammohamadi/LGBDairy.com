<?php
include "bootstrap/init.php";








//select product
if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $getpage = $_GET['page'];
    $selectproducts = selectPostProductAll($getpage);
}




//select product for products page limit for 4 products
$selectProductsLimit = selectProductLimit();












include "tpl/products.php";