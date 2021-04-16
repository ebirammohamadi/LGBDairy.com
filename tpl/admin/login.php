<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>صفحه ورود</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/css/font-awesome.min.css"?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/ionicons.min.css"?>>
  <!-- Theme style -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/adminlte.min.css"?>>
  <!-- iCheck -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/plugins/iCheck/square/blue.css"?>>
  <!-- Google Font: Source Sans Pro -->
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/bootstrap-rtl.min.css"?>>
  <!-- template rtl version -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/custom-style.css"?>>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=<?= SITE_URL ."Panel.php"?>><b>برگشت به پنل مدیریت</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="ایمیل">
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="رمز عبور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> یاد آوری من
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fa fa-facebook mr-2"></i> ورود با اکانت فیسوبک
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fa fa-google-plus mr-2"></i> ورود با اکانت گوگل
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#">رمز عبورم را فراموش کرده ام.</a>
      </p>
      <p class="mb-0">
        <a href=<?= SITE_URL ."register.php"?> class="text-center">ثبت نام</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src=<?= SITE_URL . "assets/admin/plugins/jquery/jquery.min.js"?>></script>
<!-- Bootstrap 4 -->
<script src=<?= SITE_URL . "assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"?>></script>
<!-- iCheck -->
<script src=<?= SITE_URL . "assets/admin/plugins/iCheck/icheck.min.js"?>></script>
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
