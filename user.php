<?php
include "bootstrap/init.php";








    $id = $_SESSION['login']->id;
    $selectuser = selectUserByUserid($id);




















include "tpl/admin/user.php";