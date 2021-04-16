<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>سایز بندی</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href=<?= SITE_URL ."assets/admin/plugins/font-awesome/css/font-awesome.min.css"?>>
        <!-- Ionicons -->
        <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/ionicons.min.css"?>>
        <!-- Theme style -->
        <link rel="stylesheet" href=<?= SITE_URL ."assets/admin/css/adminlte.min.css"?>>
        <!-- Google Font: Source Sans Pro -->
        <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
        <!--table css------->
        <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/plugins/datatables/dataTables.bootstrap4.css"?>>
        <!-- bootstrap rtl -->
        <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/bootstrap-rtl.min.css"?>>
        <!-- template rtl version -->
        <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/css/custom-style.css"?>>
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href=<?= SITE_URL . "assets/admin/plugins/iCheck/all.css"?>>
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
                    <a href=<?= SITE_URL ."PanelStudio.php"?> class="brand-link">
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
                                    <a href="#" class="d-block"><?php if(isset($_SESSION['superadmin'])){echo ($_SESSION['superadmin']->firstname ." " .$_SESSION['superadmin']->lastname) ;}else if(isset($_SESSION['admin'])){echo ($_SESSION['admin']->firstname ." " .$_SESSION['admin']->lastname);}?></a>
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
                        <h1>سایز بندی انواع چاپ </h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                    </div>
                </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="sizeProduct.php?action=submit" method="POST" >
                                <label for="">دسته بندی چاپ</label><br/>
                                <select class="form-control" style="width:inherit" name="groupProductid">
                                    <?php foreach($selectGroupProducts as $selectGroupProduct){?>
                                        <option value="<?=$selectGroupProduct->id?>"><?= $selectGroupProduct->name;?></option>
                                    <?php }?>
                                </select><br/>
                                <label for="">سایز قابل دسترسی را وارد نمایید</label>
                                <div class="card-body" >
                                        <div class="row">
                                            <input type="text" class="form-control" style="width: 60px;float: right" name="width">
                                            <span style="float: right;padding-top:20px">X</span>
                                            <input type="text" class="form-control" style="width: 60px;float: right" name="height">
                                        </div>
                                </div>
                                <lable class=""> قیمت محصول: </lable>
                                <div class="card-body">        
                                        <div class="row">
                                            <input type="text" class="form-control" style="width:100px;float: right" name="price">
                                        </div>
                                </div>

                                <button type="submit" class="btn btn-primary" style="margin-top: 10px">ثبت</button>
                                
                            </form>
                           
                            <br/><br/>
                                <?php foreach($selectGroupProducts as $selectGroupProduct){ ?>
                                    <div class="col-4" style="float: right">
                                        <table id="example2" class="table table-bordered table-hover">          
                                            <thead>
                                                <tr>
                                                    <th><?= $selectGroupProduct->name;?></th>
                                                    <th><?= 'ابعاد عکس'?></th>
                                                    <th><?= 'قیمت عکس'?></th>
                                                </tr>
                                            </thead>      
                                            <?php foreach($selectSizes as $selectSize){ ?>
                                                <?php if($selectSize->groupproductid == $selectGroupProduct->id){ echo ("<tbody><tr><td></td><td>" .$selectSize->width . '<span style= color:red;> در </span>' . $selectSize->height  ." </td><td>$selectSize->price</td><td style='flot: right'><a href='?deletitem=$selectSize->id'><button type='button' class='btn btn-block btn-outline-danger btn-sm'>حذف</button></a></td></tr></tbody>") ;} ?></td>
                                            <?php }?>   
                                        </table>
                                    </div>   
                                <?php } ?>
                            </div> 
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>


                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
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
        <script src=<?= SITE_URL . "assets/admin/plugins/jquery/jquery.min.js"?>></script>
        <!-- Bootstrap 4 -->
        <script src=<?= SITE_URL . "assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"?>></script>
        <!-- FastClick -->
        <script src=<?= SITE_URL . "assets/admin/plugins/fastclick/fastclick.js"?>></script>
        <!-- DataTables -->
        <script src=<?= SITE_URL . "assets/admin/plugins/datatables/jquery.dataTables.js"?>></script>
        <script src=<?= SITE_URL . "assets/admin/plugins/datatables/dataTables.bootstrap4.js"?>></script>
        <!-- SlimScroll -->
        <script src=<?= SITE_URL . "assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"?>></script>
        <!-- FastClick -->
        <script src=<?= SITE_URL . "assets/admin/plugins/fastclick/fastclick.js"?>></script>
        <!-- AdminLTE App -->
        <script src=<?= SITE_URL . "assets/admin/js/adminlte.min.js"?>></script>
        <!-- AdminLTE for demo purposes -->
        <script src=<?= SITE_URL . "assets/admin/js/demo.js"?>></script>
        <!-- iCheck 1.0.1 -->
        <script src=<?= SITE_URL . "assets/admin/plugins/iCheck/icheck.min.js"?>></script>
        <script> 
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()
            //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
                })
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
                })
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
                })
            });
        </script>
    </body>
</html>
