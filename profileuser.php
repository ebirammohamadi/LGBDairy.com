<?php 

include "bootstrap/init.php";








if(isset($_SESSION['login']) && !empty($_SESSION["login"])){
    $user = $_SESSION["login"];
}













include "tpl/user/profile.php";