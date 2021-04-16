<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>پنل کاربری</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/font-awesome/css/font-awesome.min.css"?>>
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/css/adminlte.min.css"?>>
        <!-- iCheck -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/iCheck/flat/blue.css"?>>
        <!-- Morris chart -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/morris/morris.css"?>>
        <!-- jvectormap -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css"?>>
        <!-- Date Picker -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/datepicker/datepicker3.css"?>>
        <!-- Daterange picker -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/daterangepicker/daterangepicker-bs3.css"?>>
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"?>>
        <!-- Google Font: Source Sans Pro -->
        <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
        <!-- bootstrap rtl -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/css/bootstrap-rtl.min.css"?>>
        <!-- template rtl version -->
        <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/css/custom-style.css"?>>

    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href=<?= BASE_URL ."index.php"?> class="nav-link" target="_blank">نمایش صفحه اصلی سایت</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fa fa-th-large"></i></a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href=<?= BASE_URL ."userpanel.php"?> class="brand-link">
                    <img src=<?= BASE_URL . "assets/admin/img/AdminLTELogo.png" ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">پنل کاربر</span>
                </a>
                <div class="sidebar" style="direction: ltr">
                    <div style="direction: rtl">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block"><?php if(isset($_SESSION['login'])){echo ($_SESSION['login']->firstname ." " .$_SESSION['login']->lastname) ;}else if(isset($_SESSION['admin'])){echo ($_SESSION['admin']->firstname ." " .$_SESSION['admin']->lastname);}?></a>
                                <span style="color: red;" >خوش آمدید</span>
                                <a href=<?= BASE_URL . 'index.php?action=logout'  ?>><i class="fa fa-power-off" style="color: yellow;font-size: 32px;margin-right:60px"></i></a>
                            </div>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!--        Every one                       -->
                                <li class="nav-header">دسترسی</li>
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
                                        <?php if(isset($_SESSION['login'])){ $id = $_SESSION['login']->id;} ?>
                                            <a href=<?= BASE_URL . "user.php";  ?>  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>مشخصات کاربری</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="post.php" class="nav-link">
                                        <i class="fa fa-send nav-icon"></i>
                                        <p>
                                             سفارشات
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= BASE_URL . "showorderuser.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                         نمایش سفارشات
                                                    </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="post.php" class="nav-link">
                                        <i class="fa fa-send nav-icon"></i>
                                        <p>
                                             لیست قیمت 
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= BASE_URL . "showpostlistuser.php?page=1"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                        نمایش لیست قیمت
                                                    </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-comment nav-icon"></i>
                                        <p>
                                            بخش کامنت ها 
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=<?= BASE_URL . "comment.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                    مدیریت کامنت 
                                                    </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= BASE_URL . "contactRequest.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                    فرم تماس با ما 
                                                    </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">داشبورد</h1>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><?= countProducts()?></h3>
                                        <p>تعداد محصول</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3><?= countPayment()?><sup style="font-size: 20px">%</sup></h3>
                                        <p>سفارشات تکمیل شده</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><?= countUsers()?></h3>
                                        <p>کاربران ثبت شده</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>65</h3>
                                        <p>بازدید جدید</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <strong>CopyLeft &copy; 2020 <a href="http://rzome.ir/">لبن گستر بینالود</a>.</strong>
            </footer>
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
        </div>

        <script src=<?= BASE_URL ."assets/admin/plugins/jquery/jquery.min.js"?>></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- Bootstrap 4 -->
        <script src=<?= BASE_URL ."assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"?>></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src=<?= BASE_URL ."assets/admin/plugins/morris/morris.min.js"?>></script>
        <!-- Sparkline -->
        <script src=<?= BASE_URL ."assets/admin/plugins/sparkline/jquery.sparkline.min.js"?>></script>
        <!-- jvectormap -->
        <script src=<?= BASE_URL ."assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"?>></script>
        <script src=<?= BASE_URL ."assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"?>></script>
        <!-- jQuery Knob Chart -->
        <script src=<?= BASE_URL ."assets/admin/plugins/knob/jquery.knob.js"?>></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src=<?= BASE_URL ."assets/admin/plugins/daterangepicker/daterangepicker.js"?>></script>
        <!-- datepicker -->
        <script src=<?= BASE_URL ."assets/admin/plugins/datepicker/bootstrap-datepicker.js"?>></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src=<?= BASE_URL ."assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"?>></script>
        <!-- Slimscroll -->
        <script src=<?= BASE_URL ."assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"?>></script>
        <!-- FastClick -->
        <script src=<?= BASE_URL ."assets/admin/plugins/fastclick/fastclick.js"?>></script>
        <!-- AdminLTE App -->
        <script src=<?= BASE_URL ."assets/admin/js/adminlte.js"?>></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src=<?= BASE_URL ."assets/admin/js/pages/dashboard.js"?>></script>
        <!-- AdminLTE for demo purposes -->
        <script src=<?= BASE_URL ."assets/admin/js/demo.js"?>></script>
        <script src=<?= BASE_URL . "assets/admin/js/pages/dashboard3.js"?>></script>
        <script src=<?= BASE_URL . "assets/admin/plugins/chart.js/Chart.min.js" ?>></script>
        <script>$.widget.bridge('uibutton', $.ui.button)</script>
        <!------------------------------------notification part-------------------------------------->
           <!-- <script>
            $(document).ready(function(){
            
             function load_unseen_notification(view ='')
             {
                
              $.ajax({
              url:"fetch.php",
              method:"POST",
              data:{view:view},
              dataType:"json",
              success:function(data)
              {
                $('#notification').html(data.notification);
                if(data.unseen_notification > 0)
                {
                 $('.count').html(data.unseen_notification);
                }
              }
              });
             }

             $(document).on('click', '.dropdown-toggle', function(){
              $('.count').html('');
              load_unseen_notification('yes');
             });
            
             setInterval(function(){ 
              load_unseen_notification();; 
             }, 5000);
            
            });
            </script> -->
        <!----------------------------------------------end notification--------------------------------------->
        <!---------------------------------add to do list --------------------------------->
        <!-- <script>
        $(document).ready(function(){
            $('#btnToDo').click(function(e){
                var input = $('input#inputAddToDo');
                $.ajax({
                    url : "process/ajaxHandler.php",
                    method: "post",
                    data: {action: "addToDo",inputToDo: input.val()},
                    success: function(response){
                        if(response == 1){
                            $('<li><span class="handle"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i></span><input type="checkbox" value="" name=""><span class="text">'+input.val()+'</span><small class="badge badge-secondary"><i class="fa fa-clock-o"></i> 1 ماه</small><div class="tools"><i class="fa fa-edit"></i><i class="fa fa-trash-o"></i></div></li>;').appendTo('.todo-list');
                        }else{
                            alert(1);
                        }
                    }
                });
                });
        });
        </script> -->
        <!---------------------------------end add to do list --------------------------------->
    </body>

</html>