<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>صفحه ثبت نام</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=<?= BASE_URL . "assets/css/font-awesome.min.css"?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/ionicons.min.css"?>>
  <!-- Theme style -->
  <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/adminlte.min.css"?>>
  <!-- iCheck -->
  <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/plugins/iCheck/square/blue.css"?>>
  <!-- Google Font: Source Sans Pro -->
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/bootstrap-rtl.min.css"?>>
  <!-- template rtl version -->
  <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/custom-style.css"?>>
</head>
<body class="hold-transition register-page">
<div class="register-box">
<?php if(isset($_SESSION['message'])){echo '<p class="login-box-msg">' . $_SESSION['message'] . '</p>' ; UNSET($_SESSION['message']);}?> 
  <div class="register-logo">
      <a href=<?= BASE_URL ."admin.php"?>><p class="login-box-msg">برگشت به پنل مدیریت</p></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
    <?php if(isset($_GET['updateuser']) && is_numeric($_GET['updateuser'])){ $uid = $selectUser;?>
      <form action="<?= BASE_URL . 'register.php?action=updateuser ' ?> " method="POST" class="tm-form tm-register-form tm-form-bordered">
        <h4>بروزرسانی حساب کاربری</h4>
          <div class="tm-form-inner">
            <div class="input-group mb-3">
              <input type="text" class="form-control"  name="firstname" value="<?= $selectUser ->firstname?>">
                  <div class="input-group-append">
                     <span class="fa fa-user input-group-text"></span>
                  </div>
                 </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="lastname"  value="<?= $selectUser ->lastname?>"> 
                    <div class="input-group-append">
                      <span class="fa fa-user input-group-text"></span>
                    </div>
                  </div>
                  <!-- <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="نوع کاربری" name="usertype" >  
                  </div> -->
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="phone"  value="<?= $selectUser ->phone?>">
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="address"  value="<?= $selectUser ->address?>">
                  </div>
                  <div class="input-group mb-3">
                    <input type="email" id="register-email" required="required" name="email"  class="form-control" value="<?= $selectUser ->email?>">
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" id="register-password" required="required" name="password" class="form-control" value="<?= $selectUser ->password?>" >
                </div>
                   <div class="tm-form-field">
                       <button type='submit' class='tm-button' name='submit'>ثبت نام<b></b></button>
            </div>
          </div>
    </form> 

<?php }else{ ?>
    <form action="<?= BASE_URL . 'register.php?action=register' ?>" method="POST" class="tm-form tm-register-form tm-form-bordered">
        <h4>ایجاد یک حساب کاربری</h4>
          <div class="tm-form-inner">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="نام" name="firstname">
                  <div class="input-group-append">
                     <span class="fa fa-user input-group-text"></span>
                  </div>
                 </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="lastname"  placeholder="نام خانوادگی"> 
                    <div class="input-group-append">
                      <span class="fa fa-user input-group-text"></span>
                    </div>
                  </div>
                  <!-- <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="نوع کاربری" name="usertype" >  
                  </div> -->
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="phone"  placeholder="تلفن">
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="address"  placeholder="آدرس">
                  </div>
                  <div class="input-group mb-3">
                    <input type="email" id="register-email" required="required" name="email"  class="form-control" placeholder="آدرس ایمیل">
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" id="register-password" required="required" name="password" class="form-control" placeholder="رمز عبور">
                </div>
                   <div class="tm-form-field">
                       <button type='submit' class='tm-button' name='submit'>ثبت نام<b></b></button>
            </div>
          </div>
    </form> 

    <?php } ?>  
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src=<?= BASE_URL . "assets/admin/plugins/jquery/jquery.min.js"?>></script>
<!-- Bootstrap 4 -->
<script src=<?= BASE_URL . "assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"?>></script>
<!-- iCheck -->
<script src=<?= BASE_URL . "assets/admin/plugins/iCheck/icheck.min.js"?>></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
