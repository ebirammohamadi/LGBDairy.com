<?php 
include "bootstrap/init.php";




if(isset($_GET['updateuser']) && is_numeric($_GET['updateuser'])){
    $userid = $_GET['updateuser'];
    $selectUser = selectUserByUserid($userid);
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $parames = $_POST;
    $action = $_GET['action'];
    if($action == 'register'){
        // $checkEmail = checkEmail($parames['email']);
        $checkPhone = checkPhone($parames['phone']);
        if(empty($parames['phone'])){
            $_SESSION['message'] = "لطفا فیلد های ضروری را پر نمایید" ;
        }
        if($checkPhone){ 
            $result = register($parames);
            if (!$result) {
                $_SESSION['message'] = "لطفا فیلد های ضروری را پر نمایید" ;
            }else{
                $_SESSION['message']  = "کاربر موردنظر ساخته شد";
        }
    }else{
        $_SESSION['message']  = "کاربر با این شماره تلفن فعال است";
    }
}else if($action == 'login'){
    $result = login($parames['email'], $parames['password']);
    if(!$result){
        $_SESSION['message'] = "ایمیل و یا رمز عبور اشتباه است";
        header("Location:index.php");
    }else{
        checkUser();
        if(isset($_SESSION['superadmin'])){
            header("Location: Panel.php");
        }
        else if(isset($_SESSION['admin'])){
            header("Location: Panel.php");
        }
        else if(isset($_SESSION['login'])){
            $_SESSION['message'] = "خوش آمدید";
            header("Location: index.php");
        }
    }
}elseif($_GET['action'] == 'updateuser'){
    $result = updateUser();
}
}





















include "tpl/admin/register.php";