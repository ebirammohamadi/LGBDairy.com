<?php
defined('BASE_PATH') OR header('Location: 404.php');
//check is loged in
function isLoggedIn(){
    return isset($_SESSION['login']) ? true : false ;
}

//logout user
function logout(){
     unset($_SESSION['login']);
}

//check phone number is valid and set number format
function checkPhone($phone){
    global $db;
    // Allow +, - and . in phone number
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    // Remove "-" from number
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
         // Check the lenght of number
     
     if ( strlen($phone_to_check) !== 11 || !is_numeric($phone_to_check) || empty($phone_to_check)) {
        return false;
     } else {
        $sql = "SELECT * FROM users WHERE phone=:phone";
        $stmt = $db->prepare($sql);
        $stmt->execute([':phone' => $phone]);
        $ressult = $stmt->rowCount();
        return ($ressult) ? false : true;
     }
}

//check information user is completed
function signupcomlpleted($user){
    if(($user->address) == NULL  || ($user->firstname) == NULL || ($user->lastname) == NULL){
        $_SESSION['signupcomlpleted'] = "<span style='background-color:lightgray;margin:auto;color:red;font-size: 28;'>لطفا اطلاعات کاربری را کامل نمایید</span>";
        header("Location: userpanel.php");
    }else{
        header("Location: userpanel.php");
    }
}
// login user by phone number and password
function login($phone,$password){
    $user = getUserByPhone($phone);
    if(is_null($user)){
        return false;
    }

    #check password
    if(password_verify($password,$user->password)){
        if($user->usertype  == 1){
            #login is successful
        $_SESSION['superadmin'] = $user;
        return true;
        }elseif($user->usertype == 2){
            $_SESSION['admin'] = $user;
            return true;
        }elseif($user->usertype == 3){
            $_SESSION['login'] = $user;
            return true;
        }
        
    }
    return false;
}

    //check user by phone number
    function getUserByPhone($phone){
        global $db;
        $sql = "SELECT * FROM users WHERE phone=:phone";
        $stmt = $db->prepare($sql);
        $stmt->execute([':phone' => $phone]);
        $records = $stmt->fetchAll(PDO::FETCH_OBJ);
     return $records[0] ?? null;
    }

    //register user in database
    function register($userData)
{
    global $db;
    $password = $userData['password'];
    $passHash = password_hash($password , PASSWORD_BCRYPT);
    $sql = "INSERT INTO `users` (`phone`, `password`,`firstname`,`lastname`,`email`,`address`,`usertype`) VALUES (:phone,:password,:firstname,:lastname,:email,:address,:usertype)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':phone' => $userData['phone'] ,':password' => $passHash ,':firstname' => $userData['firstname'] , ':lastname' => $userData['lastname'],':email' => $userData['email'] ,':address' => $userData['address'] ,':usertype' => 3]);
    return $stmt->rowCount() ? true : false;
}

//check  email for insert into db isnot already
function checkEmail($email){
    global $db;
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $email]);
    $ressult = $stmt->rowCount();
    return ($ressult) ? true : false;
} 


function getCurrentUserId(){
    //get login user id
    if(isset($_SESSION['login'])){
        return $_SESSION['login']->id;
    }else if(isset($_SESSION['admin'])){
        return $_SESSION['admin']->id;
    }else if(isset($_SESSION['superadmin'])){
        return $_SESSION['superdmin']->id;
    }else{
        return $_SERVER['REMOTE_ADDR'];
    }
}
//check type user
function checkUser(){
    if(isset($_SESSION['superadmin']) && !empty($_SESSION['superadmin'])){
        return $_SESSION['superadmin'];
         }elseif(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
        return $_SESSION['admin'];
    }elseif(isset($_SESSION['login']) && !empty($_SESSION['login'])){
        return  $_SESSION['login'];  
    }
}

function getLoggedInUser(){
   $result = checkUser();
   return $result ?? NULL;
}
//select user from db for show in adminpanel
function selectUser(){
    global $db;
    $sql = "SELECT * FROM `users` ";
    $stmt=$db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getUserByEmail($email){
    global $db;
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}
##============================================================
//count products from database
function countProducts(){
    global $db;
    $sql = "SELECT * FROM products ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
//count user from database
function countUsers(){
    global $db;
    $sql = "SELECT * FROM users ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
//count payment  from database
function countPayment(){
    global $db;
    $sql = "SELECT * FROM payment ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

//captcha code generate

 function returnCaptcha(){
    $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
    function generate_string($input, $strength = 5) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
      
        return $random_string;
    
    }
     
    $string_length = 6;
    $captcha_string = generate_string($permitted_chars, $string_length);

    return $captcha_string;
 }

     // get post by one id
     function selectOnePost($item)
     {
         global $db;
         try {
             $sql = "SELECT * FROM post WHERE id=:id";
             $stmt = $db->prepare($sql);
             $stmt->execute([':id'=>$item]);
             $result = $stmt->fetch(PDO::FETCH_OBJ);
             return $result;
         } catch (Exception $e) {
             die(" 
         <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
         <h5><i class='icon fa fa-ban'></i> توجه!</h5>
           مشگلی در دریافت اطلاعات ایجاد شده است 
         </div>
         ;");
         }
     }

         //update all info post by adminpanel by admin
    function updatePostAdmin($id, $params)
    {
        global $db;
        $type = $params['number'];
        $fild = $params['fild'];
        $text = strip_tags($params['text']);
        //update post by pic
        if ($_FILES['pic'] !== "") {
            $namePic  = $_FILES['pic']['name'];
            $typePic  = $_FILES['pic']['type'];
            $tmpPic   = $_FILES['pic']['tmp_name'];
            $sizePic  = $_FILES['pic']['size'];
            $errorPic     = $_FILES['pic']['error'];

            if ($errorPic > 0) {
                echo " 
        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
        لطفا تمام فیلد ها را پر نماییدمشگلی در ثبت عکس ایجاد شده است
        </div>";
            } else {
                $array = array("jpeg","jpg","gif","png");
                $explode = explode('.', $namePic);
                $trueformat = end($explode);
                ///validate format by picupload
                if ($typePic=="image/jpg" || $typePic=="image/gif" || $typePic=="image/png" || $typePic=="image/jpeg") {
                    //true format pic uploaded
                    $filename = md5($namePic.microtime()).substr($namePic, -5, 5);
                    $fileurl = "assets/admin/uploads/" . $filename;
                    //pic add to database
                    $sql_post = "UPDATE `post` SET text=:text, pic=:pic WHERE id=:id";
                    $result_insert_post = $db->prepare($sql_post);
                    $result = $result_insert_post->execute([':text' => $text,':pic' =>$fileurl,':id' =>$id]);

                    //$result_insert_post->bindValue(9,$fileurl_insert);
                    if ($result) {
                        $move = move_uploaded_file($tmpPic, $fileurl);
                        if ($move) {
                            echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                        ثبت عکس با موفقیت انجام شده    
                        </div>";
                        }
                    } else {
                        echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        خطایی در ثبت عکس ایجاد شده است   
                        </div>";
                    }
                } else {
                    ///unvalidate format by upload
                    echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        پسوند فایل قابل قبول نیست
                        </div>";
                }
            }
        } else {
            //update post without pic
            if ($type == 1 || $type == 3 || $type == 4) {
                $sql_post = "UPDATE `post` SET `text`=:text WHERE id=:id";
                $result_insert_post = $db->prepare($sql_post);
                $result = $result_insert_post->execute([':text' => $text,':id' =>$id ]);
                if ($result) {
                    echo " 
                            <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h5><i class='icon fa fa-check'></i> توجه!</h5>
                            آپدیت بدون عکس با موفقیت انجام شد
                            </div>";
                } elseif ($type == 2) {
                    $sql_post = "UPDATE `post` SET `text`=:text, WHERE id=:id";
                    $result_insert_post = $db->prepare($sql_post);
                    $result = $result_insert_post->execute([':text' => $text,':id' =>$id ]);
                    if ($result) {
                        echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                        آپدیت بدون عکس با موفقیت انجام شد
                        </div>";
                    }
                }
            }
        }
    }

    //insert list price in db
    function insertList($params){
        global $db;
        $namePic  = $_FILES['pic']['name'];
        $tmpPic = $_FILES['pic']['tmp_name'];
        $fileurl = clearPicture($_FILES['pic']);
        //pic add to database
        $sql_post = "INSERT INTO `listprice`  (pic) VALUES (:pic)";
        $result_insert_post = $db->prepare($sql_post);
        $result = $result_insert_post->execute([':pic' =>$fileurl]);

        //$result_insert_post->bindValue(9,$fileurl_insert);
        if ($result) {
            $move = move_uploaded_file($tmpPic, $fileurl);
            if ($move) {
                echo " 
            <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fa fa-check'></i> توجه!</h5>
            ثبت لیست  با موفقیت انجام شده    
            </div>";
            }
        } else {
            echo " 
            <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fa fa-ban'></i> توجه!</h5>
            خطایی در ثبت لیست ایجاد شده است   
            </div>";
        }


    }

    function postAdmin($params)
    {
        global $db;
        $type = $_POST['number'];
    
         switch ($type) {
                case $type == 1:
                    $fild = strip_tags($params['fild']);
                    // $text     = strip_tags($params['text']);
                    $namePic  = $_FILES['pic']['name'];
                //     if ($params['text'] =="") {
                //          echo " 
                //                 <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                //                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                //                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                //                 لطفا متن  را پر نمایید
                //                 </div>";
                // } else {
                //     if ($namePic =="") {
                //         $sql_post =  "INSERT INTO `post` (type,fild) VALUES (:type,:fild)";
                //         $result_insert_post = $db->prepare($sql_post);
                //         $result = $result_insert_post->execute([':type' => 1,':fild' =>$fild]);
                //         if ($result) {
                //             echo " 
                //                 <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                //                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                //                 <h5><i class='icon fa fa-check'></i> توجه!</h5>
                //                 ثبت بدون عکس با موفقیت انجام شد
                //                 </div>";
                //         }
                //     } else {
                        ///pic add to database        
                        $fild = $params['fild'];
                        // $text     = strip_tags($params['text']);
                        $tmpPic = $_FILES['pic']['tmp_name'];
                        $fileurl = clearPicture($_FILES['pic']);
                        //pic add to database
                        $sql_post = "INSERT INTO `post`  (pic,fild,type) VALUES (:pic,:fild,:type)";
                        $result_insert_post = $db->prepare($sql_post);
                        $result = $result_insert_post->execute([':pic' =>$fileurl ,':fild' => $fild, ':type' => 1]);
    
                        //$result_insert_post->bindValue(9,$fileurl_insert);
                        if ($result) {
                            $move = move_uploaded_file($tmpPic, $fileurl);
                            if ($move) {
                                echo " 
                            <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h5><i class='icon fa fa-check'></i> توجه!</h5>
                            ثبت عکس با موفقیت انجام شده    
                            </div>";
                            }
                        } else {
                            echo " 
                            <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                            خطایی در ثبت عکس ایجاد شده است   
                            </div>";
                        }
            break;
        
            case $type == 2:
            $tmpPic = $_FILES['pic']['tmp_name'];
            $fileurl = clearPicture($_FILES['pic']);
            //pic add to database
            $sql_post =  "INSERT INTO `groupingpicture` (part,side,pic) VALUES (:part,:side,:pic)";
            $result_insert_post = $db->prepare($sql_post);
            $result = $result_insert_post->execute([':part' => 2,':side' => $params['side'], ':pic' => $fileurl]);
            //$result_insert_post->bindValue(9,$fileurl_insert);
            if ($result) {
                $move = move_uploaded_file($tmpPic, $fileurl);
                if ($move) {
                    echo " 
                                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                                        ثبت عکس با موفقیت انجام شده    
                                        </div>";
                }
            } else {
                echo " 
                                        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                                        خطایی در ثبت عکس ایجاد شده است   
                                        </div>";
            }
            break;

            case $type == 3 :
                $picone = clearPicture($_FILES['picright']);
                $pictwo = clearPicture($_FILES['picleft']);
                $tmpPicone = $_FILES['picright']['tmp_name'];
                $tmpPictwo = $_FILES['picleft']['tmp_name'];
                $text = htmlentities($params['text']);

                $sql = "INSERT INTO partthree (text,picone,pictwo) VALUES (:text,:picone,:pictwo)";
                $stmt = $db->prepare($sql);
                $stmt->execute([':text' => $text,':picone' => $picone,':pictwo'=>$pictwo]);
                $result = $stmt->rowCount();
                //$result_insert_post->bindValue(9,$fileurl_insert);
            if ($result) {
                $moveone = move_uploaded_file($tmpPicone, $picone);
                $movetwo = move_uploaded_file($tmpPictwo, $pictwo);
                if ($moveone && $movetwo) {
                    echo " 
                                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                                        ثبت عکس با موفقیت انجام شده    
                                        </div>";
                }
            } else {
                echo " 
                                        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                                        خطایی در ثبت عکس ایجاد شده است   
                                        </div>";
            }
            break;
            case $type == 4:
                $pic = clearPicture($_FILES['pic']);
                $tmpPic = $_FILES['pic']['tmp_name'];
                $text = addslashes(trim($params['text']));
                $subject = addslashes(trim($params['subject']));
                $fild = trim($params['fild']);

                $sql = "INSERT INTO post (subject,text,pic,fild,type) VALUES (:subject,:text,:pic,:fild,:type)";
                $stmt = $db->prepare($sql);
                $stmt->execute([':subject' => $subject, ':text' => $text, ':pic' =>$pic,':fild' => $fild, ':type' => $type]);
                $result = $stmt->rowCount();

                $move = move_uploaded_file($tmpPic, $pic);
                if ($move) {
                    echo " 
                                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                                        ثبت عکس با موفقیت انجام شده    
                                        </div>";
            } else {
                echo " 
                                        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                                        خطایی در ثبت عکس ایجاد شده است   
                                        </div>";
            }
            break;
            case $type == 5:
                $pic = clearPicture($_FILES['pic']);
                $tmpPic = $_FILES['pic']['tmp_name'];

                $sql = "INSERT INTO `profile` (productid,pic) VALUES (:productid,:pic)";
                $stmt = $db->prepare($sql);
                $stmt->execute([':productid' => $params['productid'] , ':pic' =>$pic ]);
                $result = $stmt->rowCount();

                $move = move_uploaded_file($tmpPic, $pic);
                if ($move) {
                    echo " 
                                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                                        ثبت عکس با موفقیت انجام شده    
                                        </div>";
            } else {
                echo " 
                                        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                                        خطایی در ثبت عکس ایجاد شده است   
                                        </div>";
            }
            break;


         }
    }

    //select group from groupproduct for admin panel
function selectGroupProduct(){
    global $db;
    $sql = "SELECT * FROM groupproduct";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

  //add picture to product table
  function addPictureProduct($params)
  {
      global $db;
    
      $text    = strip_tags($params['text']);
      $namePic  = $_FILES['pic']['name'];
      $typePic  = $_FILES['pic']['type'];
      $tmpPic   = $_FILES['pic']['tmp_name'];
      // $sizePic  = $_FILES['pic']['size'];
      $errorPic     = $_FILES['pic']['error'];

      if ($errorPic > 0) {
          echo " 
             <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                  مشگلی در دریافت عکس ایجاد شده است    
             </div>
             ";
          header(BASE_URL . "postProduct.php");
      } else {
          if ($params['code'] == "" || $params['title'] == "" || $params['name'] =="" || $params['price'] =="" || $params['weight'] =="") {
              echo " 
            <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fa fa-ban'></i> توجه!</h5>
            لطفا تمام فیلد ها را پر نمایید 
            </div>
                        ";
          } else {
              $array = array("jpeg","jpg","gif","png");
              $explode = explode('.', $namePic);
              $trueformat = end($explode);
              ///validate format by picupload
              if ($typePic=="image/jpg" || $typePic=="image/gif" || $typePic=="image/png" || $typePic=="image/jpeg") {
                  //true format pic uploaded
                  $filename = md5($namePic.microtime()).substr($namePic, -5, 5);
                  $fileurl ="assets/admin/uploads/product/" . $filename;

                  //pic add to database
                  $sql_post = "INSERT INTO `products` (code,title,name,price,weight,text,pic) VALUES (:code,:title,:name,:price,:weight,:text,:pic)";
                  $result_insert_post = $db->prepare($sql_post);
                  $result = $result_insert_post->execute(['code' =>$params['code'],':title' => $params['title'] , ':name' => $params['name'],':price'=>$params['price'],':weight' => $params['weight'],':text' => $text,':pic' =>$fileurl]);

                  //$result_insert_post->bindValue(9,$fileurl_insert);
                  if ($result) {
                      $move = move_uploaded_file($tmpPic, $fileurl);
                      if ($move) {
                          echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                            محصول با درج عکس ثبت شد 
                        </div>
                        ";
                        //   header(BASE_URL . "postProduct.php");
                      }
                  } else {
                      echo " 
                        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                           مشگلی در ثبت  ایجاد شده است 
                        </div>
                        ";
                      header(BASE_URL . "postProduct.php");
                  }
              } else {
                  ///unvalidate format by upload
                  echo " 
                        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                           پسوند عکس قابل قبول نیست 
                        </div>
                        ";
                  header(BASE_URL . "postProduct.php");
              }
          }
      }
  }

    //function add product to database
    function productPost($params){
        global $db;
        $text    = strip_tags($params['text']); 
        $namePic  = $_FILES['pic']['name'];
        if ($params['code'] == "" || $params['title'] == "" || $params['name'] =="" || $params['price'] =="" || $params['weight'] ==""){
            echo " 
                    <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    لطفا تمام فیلد ها را پر نمایید 
                    </div>
                                ";
        } else{
            if ($namePic ==""){
                $sql_post =  "INSERT INTO `products` (code,title,name,price,weight,text) VALUES (:code,:title,:name,:price,:weight,:text)";
                $result_insert_post = $db->prepare($sql_post);
                 $result = $result_insert_post->execute([':code' => $params['code'] , ':title' => $params['title'], ':name' => $params['name'] ,':price' => $params['price'],':weight' => $params['weight'],':text' => $text]);
                if($result){
                    header(BASE_URL . "postProduct.php");
                    echo " 
                          <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                         <h5><i class='icon fa fa-check'></i> توجه!</h5>
                         ثبت بدون عکس با موفقیت انجام شد 
                                </div>
                                ";
                   
                    return true;
                } 
            }else{
                ///pic add to database
                addPictureProduct($params);
            }
        }
       }

       //select all product from database
       function checkCodeProduct($code){
           global $db;
           $sql = "SELECT * FROM `products` WHERE code =:code";
           $stmt=$db->prepare($sql);
           $stmt->execute([':code'=> $code]);
           return $stmt->rowCount();
       }

       function selectProductOne($id){
        global $db;
        $sql = "SELECT * FROM `products` WHERE id=:id";
        $stmt=$db->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    //update product in admin panel by id
function updateProduct($params,$id){
    global $db;
    $sql = "UPDATE products SET code=:code,title=:title,name=:name,price=:price,weight=:weight,text=:text WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':code'=>$params['code'],':title'=>$params['title'],':name'=>$params['name'],':price'=>$params['price'],':weight'=>$params['weight'],':text'=>$params['text'], ':id'=> $id]);
    $result = $stmt->rowCount();
    return $result;
}

//select product is new add to database
function selectProductnew(){
    global $db;
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//select code products for check is valid or not
function checkCodeProducts($code){
    global $db;
    $sql = "SELECT code FROM products ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//select product is unique in panel
function isUniqueProduct(){
    global $db;
    $sql = "SELECT DISTINCT * FROM products ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//select product by code from db
function selectProductByCode($code){
    global $db;
    // $sql = "SELECT code FROM products WHERE code=:code";
    // $stmt = $db->prepare($sql);
    // $stmt->execute([':code' => $code]);
    // $resultcode = $stmt->fetch(PDO::FETCH_OBJ);
    //select data for each unique product
    $sqlselect = "SELECT * FROM products ";
    $stmtselect = $db->prepare($sqlselect);
    $stmtselect->execute();
    $resultselect = $stmtselect->fetchALL(PDO::FETCH_OBJ);
    return $resultselect;
}

//select product all from db
function selectProducts(){
    global $db;
    $sqlselect = "SELECT * FROM products ";
    $stmtselect = $db->prepare($sqlselect);
    $stmtselect->execute();
    $resultselect = $stmtselect->fetchALL(PDO::FETCH_OBJ);
    return $resultselect;
}

//select product by code from db
function selectProductByKind($title){
    global $db;
    $sql = "SELECT * FROM products WHERE title=:title";
    $stmt = $db->prepare($sql);
    $stmt->execute([':title' => $title]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//do discount for each product is selected
function doDiscountProduct($params){
    global $db;
    $sql = "INSERT INTO `discount` (`userid`, `productid`, `discount`) VALUES (:userid, :productid, :discount)";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([':userid' => $params['userid'] , ':productid' => $params['productid'], ':discount' => $params['discount'] ]);
    return $stmt->rowCount();
    }

// // seelct discount product for each user    
// function selectDiscountProduct(){
//   global $db;
//     $sql = "SELECT * FROM `discount` WHERE userid = :userid";
//     $stmt = $db->prepare($sql);
//     $stmt->execute([':userid' => $userid]);
//     $result = $stmt->fetchAll(PDO::FETCH_OBJ);
//     return $result; 
// }    

//take price product
function  takeCurentPrice($userid){
    global $db;
    $sql = "SELECT * FROM `discount` WHERE userid = :userid";
    $stmt = $db->prepare($sql);
    $stmt->execute([':userid' => $userid]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//select unique discount
function TakeUniqueDiscounts($productid,$user){
    global $db;
    $sql = "SELECT * FROM `discount` WHERE productid = :productid AND userid = :userid";
    $stmt = $db->prepare($sql);
    $stmt->execute([':productid' => $productid , ':userid' => $user ]);
    $result = $stmt->rowCount();
    return $result;
}
//select user by id from db
function selectUserByUserid($id){
    global $db;
    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

    //select user for show in profilepage in adminpanel 
    function selectOneUser($id){
        global $db;
        $sql = "SELECT * FROM `users` WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //select group from groupproduct for admin panel
function selectGroupProductActive(){
    global $db;
    $sql = "SELECT * FROM groupproduct WHERE active=1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//select all orders for show in adminpanel
function selectOrders(){
    global $db;
    $sql = "SELECT * FROM orders ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//update active for groupProduct
function updateActiveGroupProduct($id){
    global $db;
    $sql = "SELECT * FROM groupproduct WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    if($product->active == 1){
        $sql = 'UPDATE groupproduct SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 0]);
        $result = $stmt->rowCount();
        return $result;
    }else{
        $sql = 'UPDATE groupproduct SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 1]);
        $result = $stmt->rowCount();
        return $result;
    }
}

//update active for discount
function updateActiveDiscount($id){
    global $db;
    $sql = "SELECT * FROM discount WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    if($product->active == 1){
        $sql = 'UPDATE discount SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 0]);
        $result = $stmt->rowCount();
        return $result;
    }else{
        $sql = 'UPDATE discount SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 1]);
        $result = $stmt->rowCount();
        return $result;
    }
}

//updatae active for listprice products
function updateActiveListPriceProducts($id){
    global $db;
    $sql = "SELECT * FROM products WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    if($product->active == 1){
        $sql = 'UPDATE products SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 0]);
        $result = $stmt->rowCount();
        return $result;
    }else{
        $sql = 'UPDATE products SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 1]);
        $result = $stmt->rowCount();
        return $result;
    }
}

//delete group product by id
function deleteGroupProduct($id){
    global $db;
    $sql = "DELETE  FROM groupproduct WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}

//delete discount by id
function deleteDiscount($id){
    global $db;
    $sql = "DELETE FROM discount WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}

//update groupProduct by send id in adminpanel
function updateGroupProduct($id){
    global $db;
    $sql = "SELECT * FROM groupproduct WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}
//insert groupProduct in database from admin
function groupProduct($group){
    global $db;
    $sql = "INSERT INTO groupproduct (name) VALUES (:name)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':name' => $group]);
    $result = $stmt->rowCount();
    return $result;
}
//// select product for pagination in shop
function selectPostProductAll($getpage){
    global $db;
    $limit = 12;  
    if (isset($getpage)) {
        $page  = $getpage; 
        } 
        else{ 
        $page=1;
        };  
        $start_from = ($page-1) * $limit; 
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT $start_from, $limit";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
}

//select product for products page limit for 4 products
function selectProductLimit(){
    global $db;
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//select listprice for pagination in paneladmin
function selectPostListAll($page){
    global $db;
    $limit = 12;  
    if (isset($getpage)) {
        $page  = $getpage; 
        } 
        else{ 
        $page=1;
        };  
        $start_from = ($page-1) * $limit; 
        $sql = "SELECT * FROM listprice ORDER BY id DESC LIMIT $start_from, $limit";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
}
//show nimber of page from products 
function countProduct(){
    global $db;
    $limit = 12;
    $sql = "SELECT COUNT(id) FROM products";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    $total_records = $result[0]; 
    $total_pages = ceil($total_records / $limit); 
    return $total_pages;
}
//select comment from db in admin panel
function selectComment(){
    global $db;
    $sql = "SELECT * FROM comments";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//select comment from db in index and show 4 comment
function selectCommentShow($num){
    global $db;
    $sql = "SELECT * FROM comments WHERE active = 1 ORDER BY ID desc limit $num";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//select comment bu userid
function selectCommentUser($user){
    global $db;
    $sql = "SELECT * FROM comments WHERE userid=:userid";
    $stmt = $db->prepare($sql);
    $stmt->execute([':userid' => $user]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//select one comment from database by userid and productid
function selectOneComment($productid){
    global $db;
    $sql = "SELECT * FROM comments WHERE productid=:productid AND active=1";
    $stmt = $db->prepare($sql);
    $stmt->execute([':productid' => $productid]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function countComment($productid){
    global $db;
    $sql = "SELECT * FROM comments WHERE productid=:productid AND active=1";
    $stmt = $db->prepare($sql);
    $stmt->execute([':productid' => $productid]);
    $result = $stmt->rowCount();
    return $result;
}
//deleteproduct in admin panel by id
function deleteProduct($id){
    global $db;
    $sql = "DELETE FROM products WHERE id=:id";
    $stmt=$db->prepare($sql);
    $stmt->execute([":id"=>$id]);
    $stmt->rowCount();

}
//update active by send query get to showPostProduct
function updateActive($id){
    global $db;
    $sql = "SELECT * FROM products WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    if($product->active == 1){
        $sql = 'UPDATE products SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 0]);
    }else{
        $sql = 'UPDATE products SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 1]);
    }
}
//select all orders print for show in adminpanel
function selectOrdersPrint(){
    global $db;
    $sql = "SELECT * FROM `orders`";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//submited reservestion by user in database
function submitReserve($params){
    global $db;
    $userid = $_SESSION['login']->id ?? NULL ;
    $kindpic = htmlspecialchars($params['kindpic']);
    $name = htmlspecialchars($params['name']);
    $date = $params['date'];
    $phone = htmlspecialchars($params['phone']);

    $sql = "INSERT INTO reservation (`userid`, `name`, `kindpicture`, `phone`, `date`) VALUES (:userid, :name,:kindpicture, :phone, :date)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':userid' => $userid ,':name' =>$name ,':kindpicture' =>$kindpic  ,':phone' =>$phone ,':date' =>$date]);
    $result = $stmt->rowCount();
    return $result ? TRUE : FALSE;
}
function addFavorit($id){
    global $db;
    $sql = "SELECT `star` FROM products WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' =>$id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $resultstar = $result->star; 

    $sqlUpdate = "UPDATE products SET star = :star WHERE id=:id";
    $stmtUpdate = $db->prepare($sqlUpdate);
    $stmtUpdate->execute(['id' => $id,'star' =>$resultstar +1]);
    $stmtUpdate->rowCount();
}
function selectReservation(){
    global $db;
    $sql = "SELECT * FROM reservation";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//ready picture for use in database
function clearPicture($picture)
{
    $namePic  = $picture['name'];
    $typePic  = $picture['type'];
    $tmpPic   = $picture['tmp_name'];
    $sizePic  = $picture['size'];
    $errorPic     = $picture['error'];

    if ($errorPic > 0) {
        echo " 
        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
        لطفا تمام فیلد ها را پر نماییدمشگلی در ثبت عکس ایجاد شده است
        </div>";
    } else {
        $array = array("jpeg","jpg","gif","png");
        $explode = explode('.', $namePic);
        $trueformat = end($explode);
        ///validate format by picupload
        if ($typePic=="image/jpg" || $typePic=="image/gif" || $typePic=="image/png" || $typePic=="image/jpeg") {
            //true format pic uploaded
            $filename = md5($namePic.microtime()).substr($namePic, -5, 5);
            $fileurl = "assets/admin/uploads/" . $filename;

            return $fileurl;
        } else {
            ///unvalidate format by upload
            echo " 
                    <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                    پسوند فایل قابل قبول نیست
                    </div>";
        }
    }
}
    //delete orderreservation by superadmin as panel
    function deleteOrderReservetion($id)
    {
        global $db;
        $sql = "DELETE  FROM reservation WHERE id =:id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->rowCount();
        return $result;
    }
    //seelct all contact from from user and show in panel
    function selectContactForm()
    {
        global $db;
        $sql = "SELECT * FROM message ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    //select contactform by id
    function selectContactById($id)
    {
        global $db;
        $sql = "SELECT * FROM contact WHERE id =:id AND answer = :answer";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id , ':answer' => 0]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    //update answer in contact table by send answer to user by admin
    function updateAnswer($id)
    {
        global $db;
        $sql = "UPDATE contact SET answer=:answer WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':answer' => 1 ,':id' => $id]);
        $result = $stmt->rowCount();
        // $result ? TRUE : FALSE;
        return true;
    }
    //delete coment from database by id by superadmin
    function deleteComentByAdmin($id)
    {
        global $db;
        $sql = "DELETE FROM contact WHERE id=:id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->rowCount();
        return $result ? true : false;
    }
    //pay basket from user
    function payBasket($id, $totalbasket)
    {
        //insert to database
        //send to bank
        //send sms for user
        //unset session
        return true;
    }

    //select type of post for show in adminpanel
    function selectPostType($type)
    {
        switch ($type) {
        case 1:
            return "بخش اول";
        break;
        case 2:
            return "دسته بندی ها";
        break;
        case 3:
            return "بخش سوم";
        break;
        case 4:
            return "بخش چهارم";
        break;
         }
    }

    function addPicture($params)
    {
        global $db;
    
        $fild = $params['fild'];
        $text     = strip_tags($params['text']);
        $namePic  = $_FILES['pic']['name'];
        $typePic  = $_FILES['pic']['type'];
        $tmpPic   = $_FILES['pic']['tmp_name'];
        $sizePic  = $_FILES['pic']['size'];
        $errorPic     = $_FILES['pic']['error'];

        if ($errorPic > 0) {
            echo " 
        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
        لطفا تمام فیلد ها را پر نماییدمشگلی در ثبت عکس ایجاد شده است
        </div>";

            header(BASE_URL . "post.php");
        } else {
            $array = array("jpeg","jpg","gif","png");
            $explode = explode('.', $namePic);
            $trueformat = end($explode);
            ///validate format by picupload
            if ($typePic=="image/jpg" || $typePic=="image/gif" || $typePic=="image/png" || $typePic=="image/jpeg") {
                //true format pic uploaded
                $filename = md5($namePic.microtime()).substr($namePic, -5, 5);
                $fileurl =BASE_PATH . "assets/admin/uploads/" . $filename;
                //pic add to database
                $sql_post = "INSERT INTO `post` (text,pic,fild,type) VALUES (:text,:pic,:fild,:type)";
                $result_insert_post = $db->prepare($sql_post);
                $result = $result_insert_post->execute([':text' => $text,':pic' =>$fileurl,':fild' => $fild ,':type' => 1]);

                //$result_insert_post->bindValue(9,$fileurl_insert);
                if ($result) {
                    $move = move_uploaded_file($tmpPic, $fileurl);
                    if ($move) {
                        header(BASE_URL . "post.php");
                        echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-check'></i> توجه!</h5>
                        ثبت عکس با موفقیت انجام شده    
                        </div>";
                    }
                } else {
                    header(BASE_URL . "post.php");
                    echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        خطایی در ثبت عکس ایجاد شده است   
                        </div>";
                }
            } else {
                ///unvalidate format by upload
                header(BASE_URL . "post.php");
                echo " 
                        <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        پسوند فایل قابل قبول نیست
                        </div>";
            }
        }
    }

    //select all post from database
function selectPostAll($getpage){
    global $db;
    $limit = 10;  
    if (isset($getpage)) {
        $page  = $getpage; 
        } 
        else{ 
        $page=1;
        };  
        $start_from = ($page-1) * $limit; 
        $sql = "SELECT * FROM post ORDER BY id DESC LIMIT $start_from, $limit";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
}

//show nimber of page from products 
function countPost(){
    global $db;
    $limit = 12;
    $sql = "SELECT COUNT(id) FROM post";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    $total_records = $result[0]; 
    $total_pages = ceil($total_records / $limit); 
    return $total_pages;
}

function partOne(){
    global $db;
    $sql = "SELECT * FROM post WHERE type = 1 && active = 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//delete post from admin panle by admin
function deletePost($id){
    global $db;
    $sql = "DELETE FROM post WHERE id=:id";
    $stmt=$db->prepare($sql);
    if($stmt->execute([":id"=>$id])){
        $_SESSION['deletepost'] = " 
        <div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fa fa-check'></i> توجه!</h5>
           پست موردنظر از دیتابیس حذف شد
        </div>
        ";
        return $stmt->rowCount();
    }
}

//update active post in database for show to panel admin
function updatePost($id){
    global $db;
    $sql = "SELECT * FROM post WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_OBJ);
    if($post->active == 1){
        $sql = 'UPDATE post SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 0]);
    }else{
        $sql = 'UPDATE post SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 1]);
    }
}

function selectPostOne($id){
    global $db;
    $sql = "SELECT * FROM `post` WHERE id=:id";
    $stmt=$db->prepare($sql);
    $stmt->execute([':id'=>$id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

//select post one by filed
function selectPostOneByFiled($fild){
    global $db;
    $sql = "SELECT * FROM `POST` WHERE fild=:fild && type=:type";
    $stmt=$db->prepare($sql);
    $stmt->execute([':fild'=> $fild ,':type'=> 1]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

//add size print picture to database
function addSizePicture($params){
    global $db;
    $sql = "INSERT INTO sizepic  (`groupproductid`,`width`, `height` , `price`) VALUES (:groupproductid ,:width ,:height,:price)";
    $stmt = $db->prepare($sql);
    $stmt->execute([ ':groupproductid' =>$params['groupProductid'], ':width'=>$params['width'], ':height'=>$params['height'], ':price' => $params['price']]);
    $result = $stmt->rowCount();
    if(!$result){
        return false;
    }else{
        return true;
    }
}

//select size for each groupproduct
function selectSizeOne($id){
    global $db;
    $sql = "SELECT * FROM `sizepic`  WHERE groupproductid=:groupproductid";
    $stmt = $db->prepare($sql);
    $stmt->execute([':groupproductid' => $id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

//select size for each groupproduct
function selectSize(){
    global $db;
    $sql = "SELECT * FROM `sizepic`";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//delete size in sizinig product in adminpanel
function deleteItemSize($item){
    global $db;
    $sql = "DELETE FROM `sizepic` WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $item]);
    $result = $stmt->rowCount();
    return $result; 
}
//select width height  for each groupproduct
function selectWidth($id){
    global $db;
    $sql = "SELECT width, height FROM `sizepic` WHERE groupproductid = :groupproductid";
    $stmt = $db->prepare($sql);
    $stmt->execute([':groupproductid' => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//submited message by user
function submitMessage($params){
    global $db;
    $sql = "INSERT INTO `message` (name,email,phone,message) VALUES (:name,:email,:phone,:message)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':name' => $params['name'], ':email' =>$params['email'],'phone' =>$params['phone'],'message' =>$params['message']]);
    $result = $stmt->rowCount();
    return $result;
}

//seelct user by phone 
function selectUserByPhone($phone){
    global $db;
    $sql = "SELECT * FROM users WHERE phone=:phone";
    $stmt = $db->prepare($sql);
    $stmt ->execute([':phone' =>$phone]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}
//submit print picture by user
function submitPrint($params)
{
    global $db;
    $phone = selectUserByPhone($params['phone']);
    $ordercode = ($phone->id) . "_" . (rand(0, 999999));
    $kindpicture = htmlspecialchars($params['kindpic']);
    $titlepicture = htmlspecialchars($params['kindprint']);
    $sizepicture = htmlspecialchars($params['size']);
    $many = htmlspecialchars($params['many']);

    //pic details
    
    $countPic = count(array_values($_FILES['images']['name']));

    if ($countPic > 1) {
        foreach ($_FILES['images']['error'] as $err) {
            switch ($err) {
               case UPLOAD_ERR_NO_FILE:
                   echo "<div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                   <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        فایل به درستی ارسال نشده است
                   </div>";
                   exit;
               case UPLOAD_ERR_INI_SIZE:
               case UPLOAD_ERR_FORM_SIZE:
                echo "<div class='alert alert-danger alert-dismissible' style='width:50%;margin:auto'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                     اشگالی در عکس ارسالی میباشد
                </div>";
                   exit;
             }
        }

        for ($x=0; $x<$countPic; $x++) {
            $namePic  = $_FILES['images']['name'][$x];
            $typePic  = $_FILES['images']['type'][$x];
            $tmpPic   = $_FILES['images']['tmp_name'][$x];
            $sizePic  = $_FILES['images']['size'][$x];
    
            $explode = explode('.', $namePic);
            $trueformat = strtolower(end($explode));

            $array  = array("jpg", "jpeg", "png", "gif", "bmp");
            ///validate format by picupload
            if (in_array($trueformat, $array)) {
                //true format pic uploaded
                $filename = md5($namePic.microtime()).substr($namePic, -5, 5);
                $fileurl = "assets/user/uploads/" . $filename;
                $sql = "INSERT INTO `orders` (userid,name,phone,kindpicture,titlepicture,sizepicture,many,pic,ordercode) VALUES (:userid,:name,:phone,:kindpicture,:titlepicture,:sizepicture,:many,:pic,:ordercode)";
                $stmt = $db->prepare($sql);
                $result =  $stmt->execute([':userid' => $phone->id , ':name' => $phone->firstname, ':phone' => $params['phone'], ':kindpicture' => $kindpicture, ':titlepicture' => $titlepicture , ':sizepicture' => $sizepicture , ':many' => $many ,':pic' => $fileurl,':ordercode' => $ordercode ]);
                if ($result) {
                    $move = move_uploaded_file($tmpPic, $fileurl);
                    if ($move) {
                        echo " 
                             <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                             <h5><i class='icon fa fa-check'></i> توجه!</h5>
                             ثبت عکس با موفقیت انجام شده    
                             </div>";
                    } else {
                        echo " 
                             <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                             <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                             خطایی در ثبت عکس ایجاد شده است   
                             </div>";
                    }
                } else {
                    echo " 
                             <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                             <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                            خطایی در انتقال عکس ایجاد شده است      
                             </div>";
                }
            } else {
                echo " 
                <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                     <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                     پسوند فایل قابل قبول نیست
                </div>";
            }
        }
    } else {
        $namePic  = $_FILES['images']['name'][0];
        $typePic  = $_FILES['images']['type'][0];
        $tmpPic   = $_FILES['images']['tmp_name'][0];
        $sizePic  = $_FILES['images']['size'][0];
        $errorPic     = $_FILES['images']['error'][0];


        if ($errorPic > 0) {
            echo " 
            <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h5><i class='icon fa fa-ban'></i> توجه!</h5>
            لطفا تمام فیلد ها را پر نماییدمشگلی در ثبت عکس ایجاد شده است
            </div>";
        } else {
            $array = array("jpeg","jpg","gif","png");
            $explode = explode('.', $namePic);
            $trueformat = end($explode);
            ///validate format by picupload
            if ($typePic=="image/jpg" || $typePic=="image/gif" || $typePic=="image/png" || $typePic=="image/jpeg") {
                //true format pic uploaded
                $filename = md5($namePic.microtime()).substr($namePic, -5, 5);
                $fileurl ="assets/user/uploads/" . $filename;
                $sql = "INSERT INTO `orders` (userid,name,phone,kindpicture,titlepicture,sizepicture,many,pic,ordercode) VALUES (:userid,:name,:phone,:kindpicture,:titlepicture,:sizepicture,:many,:pic,:ordercode)";
                $stmt = $db->prepare($sql);
                $result =  $stmt->execute([':userid' => $phone->id , ':name' => $phone->firstname, ':phone' => $params['phone'], ':kindpicture' => $kindpicture, ':titlepicture' => $titlepicture , ':sizepicture' => $sizepicture , ':many' => $many ,':pic' => $fileurl,':ordercode' => $ordercode ]);
                if ($result) {
                    $move = move_uploaded_file($tmpPic, $fileurl);
                    if ($move) {
                        echo " 
                         <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                         <h5><i class='icon fa fa-check'></i> توجه!</h5>
                         ثبت عکس با موفقیت انجام شده    
                         </div>";
                    } else {
                        echo " 
                         <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                         <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                         خطایی در ثبت عکس ایجاد شده است   
                         </div>";
                    }
                } else {
                    echo " 
                         <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                         <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                        خطایی در انتقال عکس ایجاد شده است      
                         </div>";
                }
            } else {
                echo " 
            <div class='alert alert-success alert-dismissible' style='width:50%;margin:auto'>
                 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                 <h5><i class='icon fa fa-ban'></i> توجه!</h5>
                 پسوند فایل قابل قبول نیست
            </div>";
            }
        }
    }
}
//select groupingpicture 
function selectGroupPicture($side){
    global $db;
    $sql = "SELECT * FROM `groupingpicture` WHERE side = :side AND active=:active";
    $stmt = $db->prepare($sql);
    $stmt->execute([':side' => $side, ':active' => 1]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result ;
}

//select groupingpicture 
function selectPartThree(){
    global $db;
    $sql = "SELECT * FROM `partthree` WHERE  active=:active";
    $stmt = $db->prepare($sql);
    $stmt->execute([':active' => 1 ]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

//function select data part four 
function selectPartFour($fild){
    global $db;
    $sql = "SELECT * FROM `post` WHERE  fild=:fild AND active=:active AND type=:type";
    $stmt = $db->prepare($sql);
    $stmt->execute([':fild' => $fild ,':active' => 1 ,':type' => 4]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

//select picture for show in index weding
function selectProfilePictures($item){
    global $db;
    $sql = "SELECT * FROM `profile` WHERE  productid=:productid AND active=:active";
    $stmt = $db->prepare($sql);
    $stmt->execute([':productid' => $item ,':active' => 1]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function isOdd($item){
    if($item & 1){
        return  true;
    }
}

//update active by send query get to showPostProduct
function updateActiveUser($id){
    global $db;
    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_OBJ);
    if($product->active == 1){
        $sql = 'UPDATE users SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 0]);
    }else{
        $sql = 'UPDATE users SET active=:active WHERE id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id, ':active' => 1]);
    }
}

//delete user by id in adminpanel 
function deleteUserById($id){
    global $db;
    $sql = "DELETE FROM users WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    $result = $stmt->rowCount();
    return $result; 
}

// show order by user in orderproduct page
function orderProductShow($id){
    global $db;
    $sql = "SELECT * FROM `products` WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
 
}

//check for discunt user
function checkDiscountUser($get,$userid){
    global $db;
    $sql = "SELECT * FROM `discount` WHERE userid=:userid && productid=:productid ";
    $stmt = $db->prepare($sql);
    $stmt->execute([':userid' => $userid , ':productid' =>$get ]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

//submit order user 
function submitOrderByUser($userid,$params){
    global $db;
    $sql = "INSERT INTO `orders` (userid,name,weight,price,discount,total) VALUES (:userid,:name,:weight,:price,:discount,:total)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':userid' => $userid, ':name' =>$params['name'],':weight' =>$params['weight'],':price' =>$params['price'],':discount' =>$params['discount'],':total' =>$params['total']]);
    $result = $stmt->rowCount();
    return $result;
}

// select order user for show in panel user
function selectOrdersUser($userid){
    global $db;
    $sql = "SELECT * FROM `orders` WHERE userid=:userid ";
    $stmt = $db->prepare($sql);
    $stmt->execute([':userid' => $userid ]);
    $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
// function footPrintUser(){
// $indicesServer = array('PHP_SELF',
// 'argv',
// 'argc',
// 'GATEWAY_INTERFACE',
// 'SERVER_ADDR',
// 'SERVER_NAME',
// 'SERVER_SOFTWARE',
// 'SERVER_PROTOCOL',
// 'REQUEST_METHOD',
// 'REQUEST_TIME',
// 'REQUEST_TIME_FLOAT',
// 'QUERY_STRING',
// 'DOCUMENT_ROOT',
// 'HTTP_ACCEPT',
// 'HTTP_ACCEPT_CHARSET',
// 'HTTP_ACCEPT_ENCODING',
// 'HTTP_ACCEPT_LANGUAGE',
// 'HTTP_CONNECTION',
// 'HTTP_HOST',
// 'HTTP_REFERER',
// 'HTTP_USER_AGENT',
// 'HTTPS',
// 'REMOTE_ADDR',
// 'REMOTE_HOST',
// 'REMOTE_PORT',
// 'REMOTE_USER',
// 'REDIRECT_REMOTE_USER',
// 'SCRIPT_FILENAME',
// 'SERVER_ADMIN',
// 'SERVER_PORT',
// 'SERVER_SIGNATURE',
// 'PATH_TRANSLATED',
// 'SCRIPT_NAME',
// 'REQUEST_URI',
// 'PHP_AUTH_DIGEST',
// 'PHP_AUTH_USER',
// 'PHP_AUTH_PW',
// 'AUTH_TYPE',
// 'PATH_INFO',
// 'ORIG_PATH_INFO') ;
// $foot = [];
//  foreach ($indicesServer as $arg) {
//     if (isset($_SERVER[$arg])) {
//         $foot =  $_SERVER[$arg] ;
//     }
//     else {
//         echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
//     }
//     $file = 'people.txt';
//     file_put_contents($file,$foot);
// }

// }

 