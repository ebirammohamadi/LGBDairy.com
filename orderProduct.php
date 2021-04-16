<?php
include "bootstrap/init.php";





//select discount product for user 
$userid = $_SESSION['login']->id;
$discounts = takeCurentPrice($userid);





if(isset($_GET['num']) && is_numeric($_GET['num']) && !empty($_GET['num'])){
    $get = $_GET['num'];
    $order = orderProductShow($get);
    $discount = checkDiscountUser($get,$userid);
}



    if(isset($_POST['submit'])){
        $params = $_POST;
        if(isset($params['name']) && isset($params['weight']) && isset($params['price']) && isset($params['total']) && !empty($params['total'])){
            //submit order s user
            $result = submitOrderByUser($userid,$params);
            if(!$result){
                header('Location:showpostlistuser.php?page=1&filed=faild');
            }else{
                 header('Location:showpostlistuser.php?page=1&filed=ok');
            }
        }else{
            header('Location:showpostlistuser.php?page=1&filed=empty');      
             
        }
    }











include "tpl/admin/orderProduct.php";