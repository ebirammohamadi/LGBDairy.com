<?php
include "bootstrap/init.php";







//delete user by send query delete from adminpanel by admin
if(isset($_GET['deleteuser']) && is_numeric($_GET['deleteuser'])){
    $id = $_GET['deleteuser'];
    if(deleteUserById($id)){
       echo " <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-check'></i> توجه!</h5>
           کاربر از دیتابیس حذف شد
        </div>
        ";
    }else{
        echo " <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-check'></i> توجه!</h5>
        مشگلی در حذف کاربر ایجاد شده
        </div>
        ";
    }
}




if(isset($_GET['updateuser']) && $_GET['updateuser'] == "true"){
       echo " <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-check'></i> توجه!</h5>
           کاربر بروزرسانی شد شد
        </div>
        ";
    }elseif(isset($_GET['updateuser']) && $_GET['updateuser'] == "false"){
        echo " <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-check'></i> توجه!</h5>
            مشکلی در بروزرسانی ایجاد شده است
        </div>
        ";

    }else{

    }


// update active user by send numActive
if(isset($_GET['action']) && $_GET['action'] == 'numActive'){
    $post = $_POST['numActive'];
    $result = updateActiveUser($post);
}



    $selectusers = selectUser();

  




















include "tpl/admin/users.php";