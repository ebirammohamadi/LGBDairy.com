<?php
include "bootstrap/init.php";






//select discount product for user 
$userid = $_SESSION['login']->id;
$discounts = takeCurentPrice($userid);



if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
    $selectPostLists = selectPostProductAll($_GET['page']);
    $total_pages = countProduct();
}




if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
if(isset($_GET['filed']) && $_GET['filed'] == 'empty'){
    echo " 
          <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                       لطفا فیلد های ضرروری را وارد نمایید
                    </div>
                    ";          
}elseif(isset($_GET['filed']) && $_GET['filed'] == 'faild'){
    echo " 
        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                       مشگلی در ثبت ایجاد شده است
                    </div>
                    ";
}elseif(isset($_GET['filed']) && $_GET['filed'] == 'ok'){
    echo " 
        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                       سفارش شما ثبت شده است
                    </div>
                    ";
}

}





include "tpl/admin/showpostlistuser.php";