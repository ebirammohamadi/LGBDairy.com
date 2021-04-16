<?php
include "bootstrap/init.php";






//active or dont active groupProduct by send id from admin panel
if(isset($_POST['btnActive'])){
    $id = $_POST['btnActive'];
    $result = updateActiveGroupProduct($id);
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
if(isset($_GET['deletegroup']) && is_numeric($_GET['deletegroup'])){
    $id = $_GET['deletegroup'];
    $result = deleteGroupProduct($id);
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
//update groupproduct 
if(isset($_GET['updategroup']) && is_numeric($_GET['updategroup'])){
    $id = $_GET['updategroup'];
    $selectUpdate = updateGroupProduct($id);
}







if(isset($_POST['submit'])){
    $group = $_POST['groupProduct'];
    if(empty($_POST['groupProduct'])){
        echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        برای ثبت دسته بندی را وارد نمایید
                 </div>
                 ";
    }else{
        $result = groupProduct($group);
        if(!$result){
            echo " 
                     <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                     <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                                مشگلی در ثبت ایجاد شده است  
                     </div>
                     ";
        }else{
            echo " 
                     <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                     <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        ثبت با موفقیت انجام شد
                     </div>
                     ";

        }
        
    }
    }












//select from group product
$selects = selectGroupProduct();










include "tpl/admin/groupProduct.php";