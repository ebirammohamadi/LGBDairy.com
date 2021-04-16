<?php


include "bootstrap/init.php";


//select product for how in discount
$selectProducts = selectProducts();

//select user by id to show in profile page
if(isset($_GET['num']) && is_numeric($_GET['num'])){
    $id = $_GET['num'];
    $selectUser = selectOneUser($id);
}
//submit discount for user
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST;
    if (isset($params['productid']) && isset($params['discount'])) {
        $product = $params['productid'];
        $user = $_GET['num'];
        if (!empty($params)) {
            if (!TakeUniqueDiscounts($product,$user)) {
                $result =doDiscountProduct($params);
                if (!$result) {
                    echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    مشگلی در ثبت تخفیف ایجاد شده است
                 </div>
                 ";
                } else {
                    echo " 
                 <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    درج با موفقیت انجام شد
                 </div>
                 ";
                }
            } else {
                echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    این محصول دارای تخفیف است
                 </div>
                 ";
            }
        } else {
            echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    لطفا درصد تخفیف را وارد نمایید
                 </div>
                 ";
        }
    }
}


//active or dont active discount by send id from admin panel
if(isset($_POST['btnActive'])){
    $id = $_POST['btnActive'];
    $result = updateActiveDiscount($id);
    if(!$result){
        echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                            مشگلی در بروزرسانی ایجاد شده است
                 </div>
                 ";
    }else{
        echo " 
        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                   بروزرسانی انجام شد
        </div>
        ";
    }
}

//delete groupProduct by send id from admin panel
if(isset($_GET['deletediscount']) && is_numeric($_GET['deletediscount'])){
    $num = $_GET['num'];
    $id = $_GET['deletediscount'];
    $result = deleteDiscount($id);
    if(!$result){
        echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                            مشگلی در حذف ایجاد شده است
                 </div>
                 ";
                 
    }else{
        echo " 
        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                   حذف انجام شد
        </div>
        ";
    }
}

// seelct discount product for each user
if(isset($_GET['num']) && is_numeric($_GET['num'])){
$userid = $_GET['num'];
$discounts = takeCurentPrice($userid);
} 






include "tpl/admin/profile.php";