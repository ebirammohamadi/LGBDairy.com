<?php
include "bootstrap/init.php";




//show info product in update 
if(isset($_GET['updatepost']) && isset($_GET['type'])){
    $id = $_GET['updatepost'];
    $selectPostOne =selectOnePost($id);
}
// update post by send id product from admin panel
if (isset($_POST['submit']) && $_GET['action'] == "updatepost") {
    $params = $_POST;
    $id = $_GET['num'];
    updatePostAdmin($id,$params);
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST;
    $action = $_GET['action'];
    if ($action == 'submit') {
        $result = postAdmin($params);
    }
}






//select group product from table
$selectGroupProducts = selectGroupProduct();























include "tpl/admin/post.php";