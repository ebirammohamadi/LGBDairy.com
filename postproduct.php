<?php 

include "bootstrap/init.php";








// update product by send id product from admin panel
if (isset($_GET['updateproduct']) && is_numeric($_GET['updateproduct'])) {
    $id = $_GET['updateproduct'];
    $selectProductOne = selectProductOne($id);
}







if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action'])) {
    $params = $_POST;
    $action = $_GET['action'];
    $id = $_GET['num'];
    $code = $params['code'];
    if ($action == 'submit') {
        $result = checkCodeProduct($code);
        if($result)
        {
            echo " 
                 <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    محصولی با این کد  موجود است
                 </div>
                 ";
        }else{
            $result = productPost($params);
        }
    
    }else
    if ($action == 'update') {
        $result = updateProduct($params,$id);
        if($result){
                 echo " 
                 <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    محصول  در دیتابیس بروزرسانی شد 
                 </div>
                 ";
        }
    }
}





$selectGroupProducts = selectGroupProductActive();









include "tpl/admin/postProduct.php";