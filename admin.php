<?php 

include "bootstrap/init.php";





//check loged in or not
if(isLoggedIn()){$_SESSION['login'];}




















include "tpl/admin/index.php";