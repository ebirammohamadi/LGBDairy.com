<?php 
include "bootstrap/init.php";






//login from login-register.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parames = $_POST;
    $action = $_GET['action'];
    // if ($action == 'register') {
    //     $checkPhone = checkPhone($parames['phone']);
    //     if (!$checkPhone) {
    //         $_SESSION['loginfailed'] = "<span style='background-color:lightgray;margin:auto;color:red;font-size: 28'> شماره همراه را درست وارد نمایید</span>" ;
    //         header("Location:login-register.php");
    //     } else {
    //         if (empty($parames['password'])) {
    //             $_SESSION['loginfailed'] = "<span style='background-color:lightgray;margin:auto;color:red;font-size: 28'>لطفا رمز عبور را وارد نمایید</span>" ;
    //             header("Location:login-register.php");
    //         } elseif (empty($parames['email'])) {
    //             $_SESSION['loginfailed'] = "<span style='background-color:lightgray;margin:auto;color:red;font-size: 28'>لطفا  ایمیل را وارد نمایید</span>" ;
    //             header("Location:login-register.php");
    //         } else {
    //             $result = register($parames);
    //             $_SESSION['loginfailed'] = "<span style='background-color:lightgray;margin:auto;color:green;font-size: 28'>ثبت نام با موفقیت انجام شد</span>" ;
    //             header("Location:login-register.php");
    //         }
    //     }
    // } elseif ($action == 'login') {
        $result = login($parames['phone'], $parames['password']);
        if (!$result) {
            $_SESSION['loginfailed'] = "<h3>شماره همراه  یا پسورد اشتباه است</h3>" ;
        } else {
            checkUser();
            // footPrintUser();
            if (isset($_SESSION['superadmin'])) {
                header("Location: admin.php");
            } elseif (isset($_SESSION['admin'])) {
                header("Location: admin.php");
            } elseif (isset($_SESSION['login'])) {
                // signupcomlpleted($_SESSION['login']);
                header("Location: userpanel.php");
            }
        }
    }



















include "tpl/login12.php";