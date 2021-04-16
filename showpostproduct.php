<?php 

include "bootstrap/init.php";












if (isset($_GET['deleteproduct']) && is_numeric($_GET['deleteproduct'])){
        $id=$_GET['deleteproduct'];
       if(deleteProduct($id)){
           echo " 
            <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fa fa-ban'></i> توجه!</h5>
               محصول موردنظر از دیتابیس حذف شد
            </div>
            ";
       }
    }

//update active for show in panel admin 
    if (isset($_POST['numActive']) && is_numeric($_POST['numActive'])) {
        $id = $_POST['numActive'];
        if (updateActive($id)) {
            echo " 
            <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fa fa-ban'></i> توجه!</h5>
               محصول موردنظر بروزرسانی شد
            </div>
            ";
        }
    }



    if(isset($_GET['page']) && is_numeric($_GET['page']) && !empty($_GET['page'])){
        $selectPostProductAlls= selectPostProductAll($_GET['page']);
        $total_pages = countProduct();
    }





include "tpl/admin/showpostproduct.php";