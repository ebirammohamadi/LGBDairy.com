<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>صورتحساب</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href=<?= SITE_URL ."assets/admin/plugins/font-awesome/css/font-awesome.min.css"?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/adminlte.min.css"?>>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/bootstrap-rtl.min.css"?>>
  <!-- template rtl version -->
  <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/custom-style.css"?>>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href=<?= SITE_URL ."Panel.php"?> class="brand-link">
                <img src=<?= SITE_URL . "assets/admin/img/AdminLTELogo.png" ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">پنل مدیریت</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="direction: ltr">
                <div style="direction: rtl">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?= $_SESSION['admin'] -> firstname . " " . $_SESSION['admin'] -> lastname ?? $_SESSION['superadmin'] -> firstname . " " . $_SESSION['superadmin'] -> lastname?></a>
                            <span style="color: red;" >خوش آمدید</span>
                            <a href=<?= SITE_URL . 'index.php?action=logout'  ?>><i class="fa fa-power-off" style="color: yellow;font-size: 32px;margin-right:60px"></i></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!--        Every one                       -->
                                <li class="nav-header">دسترسی</li>
                                <!-- <li class="nav-item">
                                    <a href="calendar.php" class="nav-link">
                                        <i class="nav-icon fa fa-calendar"></i>
                                        <p>
                                            تقویم
                                            <span class="badge badge-info right">2</span>
                                        </p>
                                    </a>
                                </li> -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-shopping-basket"></i>
                                        <p>
                                            سفارشات
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="invoicePrint.php"  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p> سفارشات چاپ</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="invoiceReserve.php"  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p> رزرو وقت</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-user"></i>
                                        <p>
                                            کاربران
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "users.php" ?>  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>لیست کاربران</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "register.php" ?>  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>صفحه عضویت</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-envelope-o"></i>
                                        <p>
                                            ایمیل‌ باکس
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "mailbox.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>اینباکس</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "compose.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>ایجاد</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "read-mail.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>خواندن</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                                <li class="nav-item has-treeview">
                                    <a href="post.php" class="nav-link">
                                        <i class="fa fa-send nav-icon"></i>
                                        <p>
                                            پست مطلب
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "post.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                        پست مطلب
                                                    </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "showpost.php?page=1"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                        نمایش مطالب ارسالی 
                                                    </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-product-hunt"></i>
                                        <p>
                                            ثبت محصولات در سایت
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                            <a href=<?= SITE_URL . "groupProduct.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                        دسته بندی موضوعات   
                                                    </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "sizeProduct.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                         سایز های قابل چاپ
                                                    </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-comment nav-icon"></i>
                                        <p>
                                            بخش کامنت ها 
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "comment.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                    مدیریت کامنت 
                                                    </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= SITE_URL . "contactRequest.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                    فرم تماس با ما 
                                                    </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>صورتحساب</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fa fa-info"></i> نکته :</h5>
              این صفحه مناسب برای پرینت طراحی شده است برای تست روی دکمه پرینت کلیک کنید
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
              
                    <small class="float-left">تاریخ</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  به
                  <address>
                    <strong></strong><br>
                    آدرس خریدار<br>
                    خیابان فلان<br>
                    تلفن : (555) 539-1037<br>
                    ایمیل : john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>سفارش #007612</b><br>
                  <br>
                  <b>کد سفارش :</b> 4F3S8J<br>
                  <b>تاریخ پرداخت :</b> 12 آبان 1397<br>
                  <b>اکانت :</b> karbar
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>تعداد</th>
                      <th>محصول</th>
                      <th>سریال #</th>
                      <th>توضیحات</th>
                      <th>قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>ندای وظیفه</td>
                      <td>455-981-221</td>
                      <td>بازی شوتر شخص اول</td>
                      <td>150000 تومان</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">روش های پرداخت :</p>
                  <img src="../../dist/img/credit/visa.png" alt="Zarinpal">


                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    پرداخت از طریق کلیه کارت های بانکی عضو شتاب امکان پذیر می باشد.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p>جمع صورت حساب</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">مبلغ کل :</th>
                        <td>1,300,000 تومان</td>
                      </tr>
                      <tr>
                        <th>مالیات (9.3%)</th>
                        <td>300,000 تومان</td>
                      </tr>
                      <tr>
                        <th>تخفیف :</th>
                        <td>20,000 تومان</td>
                      </tr>
                      <tr>
                        <th>مبلغ قابل پرداخت:</th>
                        <td>900,000 تومان</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href=<?= SITE_URL . "invoice-print.php" ?> target="_blank" class="btn btn-default"><i class="fa fa-print"></i> پرینت </a>
                  <!--<button type="button" class="btn btn-success float-left"><i class="fa fa-credit-card"></i> پرداخت صورتحساب-->
                  </button>
                  <button type="button" class="btn btn-primary float-left ml-2" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> تولید PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <strong>CopyLeft &copy; 2020 <a href="http://rzome.ir/">محمّدی</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src=<?= SITE_URL ."assets/admin/plugins/jquery/jquery.min.js"?>></script>
<!-- Bootstrap 4 -->
<script src=<?= SITE_URL ."assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"?>></script>
<!-- FastClick -->
<script src=<?= SITE_URL ."assets/admin/plugins/fastclick/fastclick.js"?>></script>
<!-- AdminLTE App -->
<script src=<?= SITE_URL ."assets/admin/js/adminlte.min.js"?>></script>
<!-- AdminLTE for demo purposes -->
<script src=<?= SITE_URL ."assets/admin/js/demo.js"?>></script>
</body>
</html>
