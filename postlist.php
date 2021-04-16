<?php
include "bootstrap/init.php";













//active or dont active groupProduct by send id from admin panel
if(isset($_POST['btnActive'])){
    $id = $_POST['btnActive'];
    $result = updateActiveListPriceProducts($id);
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







//show list of price
$isUniques =  isUniqueProduct();






include "tpl/admin/postlist.php";