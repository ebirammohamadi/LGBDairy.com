<?php
include "bootstrap/init.php";











// show order user 
$userid = $_SESSION['login']->id;
$orders = selectOrdersUser($userid);















include "tpl/admin/showorderuser.php";