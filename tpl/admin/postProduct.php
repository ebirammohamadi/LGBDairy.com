
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ارسال مطلب</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Font Awesome -->
      <link rel="stylesheet" href=<?= BASE_URL ."assets/admin/plugins/font-awesome/css/font-awesome.min.css"?>>
    <!-- Ionicons -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/ionicons.min.css"?>>
    <!-- daterange picker -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/plugins/daterangepicker/daterangepicker-bs3.css"?>>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href=<?= BASE_URL . "asstes/admin/plugins/iCheck/all.css"?>>
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css"?>>
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/plugins/timepicker/bootstrap-timepicker.min.css"?>>
    <!-- Persian Data Picker -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/persian-datepicker.min.css"?>>
    <!-- Select2 -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/plugins/select2/select2.min.css"?>>
    <!-- Theme style -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/adminlte.min.css"?>>
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"?>>
    <!-- Google Font: Source Sans Pro -->
    <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/bootstrap-rtl.min.css"?>>
    <!-- template rtl version -->
    <link rel="stylesheet" href=<?= BASE_URL . "assets/admin/css/custom-style.css"?>>
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
                <a href=<?= BASE_URL ."admin.php"?> class="brand-link">
                    <img src=<?= BASE_URL . "assets/admin/img/AdminLTELogo.png" ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                                        <i class="nav-icon fa fa-shopping-basket"></i>
                                        <p>
                                            محصولات
                                            <i class="fa fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="groupproduct.php"  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>ثبت دسته بندی محصولات</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="postproduct.php"  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>ثبت محصولات</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="showpostproduct.php?page=1"  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>نمایش محصولات</p>
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
                                            <a href=<?= BASE_URL . "users.php" ?>  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>لیست کاربران</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= BASE_URL . "register.php" ?>  class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>صفحه عضویت</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
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
                                            <a href=<?= BASE_URL . "post.php"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                        پست مطلب
                                                    </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=<?= BASE_URL . "showpost.php?page=1"?> class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                    <p>
                                                        نمایش مطالب ارسالی 
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
                                            <a href=<?= BASE_URL . "postlist.php"?> class="nav-link">
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
      <!-----------------------content part------------------------------------->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="col-md-12">
                  <!-- /.card-header -->
              <div class="card-header">
                <div class="card-body">
                  <?php if (isset($_GET['updateproduct']) && is_numeric($_GET['updateproduct'])) { ?>
                    <form enctype="multipart/form-data"  action=<?= BASE_URL . "postproduct.php?action=update&num=$selectProductOne->id"?> method="POST" >
                  <?php }else{?>
                    <form enctype="multipart/form-data"  action=<?= BASE_URL . "postproduct.php?action=submit"?> method="POST" >
                  <?php }?>
                  <div class="form-group">
                    <label>  کد محصول </label><span style="color:red">*</span>:
                      <input type="text" class="form-control" name="code" value="<?= $selectProductOne->code;?>">
                      <label>   دسته بندی </label><span style="color:red">*</span>:
                      <select  class="form-control" style="width:inherit" name="title">
                        <?php foreach($selectGroupProducts as $selectGroupProduct){?>
                          <option value="<?= $selectGroupProduct->name;?>"> <?= $selectGroupProduct->name;?> </option>
                          <?php }?>
                      </select>    
                      <label> نام محصول </label><span style="color:red">*</span>:
                      <input type="text" class="form-control" name="name" value="<?=$selectProductOne->name ?? NULL; ?>">
                        <label> قیمت محصول </label><span style="color:red">*</span>:
                        <input type="text" class="form-control" name="price" value="<?=$selectProductOne->price ?? NULL ;?>">
                        <label> وزن محصول </label><span style="color:red">*</span>:
                        <input type="text" class="form-control" name="weight" value="<?=$selectProductOne->weight ?? NULL ;?>">  
                        <div class="mb-3">
                          <label> متن :</label>
                          <textarea class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="text"><?php if($selectProductOne != NULL){ echo $selectProductOne->text;}else{echo 'لطفا متن خود را وارد کنید';}  ?> </textarea>
                        </div>
                        <label> عکس :</label>
                        <input type="file" class="form-control" name="pic" >
                    <!-- </div> -->
                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">ارسال</button>
                    </div>
                  </div>
                </form>
              </div>
              </div>
            </div>
            <div class="card-body">
            </div>
          </div>
        </section>
      </div>  
        <!-- /.content -->
    </div>
    <!-----------------------end content -------------------------------------->

  
    <footer class="main-footer">
      <strong>CopyLeft &copy; 2020 <a href="www.rzome.ir">لبن گستر بینالود</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>

    <!-- jQuery -->
    <script src=<?= BASE_URL . "assets/admin/plugins/jquery/jquery.min.js"?>></script>
    <!-- Bootstrap 4 -->
    <script src=<?= BASE_URL . "assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"?>></script>
    <!-- Select2 -->
    <script src=<?= BASE_URL . "assets/admin/plugins/select2/select2.full.min.js"?>></script>
    <!-- InputMask -->
    <script src=<?= BASE_URL . "assets/admin/plugins/input-mask/jquery.inputmask.js"?>></script>
    <script src=<?= BASE_URL . "assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"?>></script>
    <script src=<?= BASE_URL . "assets/admin/plugins/input-mask/jquery.inputmask.extensions.js"?>></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src=<?= BASE_URL . "assets/admin/plugins/daterangepicker/daterangepicker.js"?>></script>
    <!-- bootstrap color picker -->
    <script src=<?= BASE_URL . "assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js"?>></script>
    <!-- SlimScroll 1.3.0 -->
    <script src=<?= BASE_URL . "assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"?>></script>
    <!-- iCheck 1.0.1 -->
    <script src=<?= BASE_URL . "assets/admin/plugins/iCheck/icheck.min.js"?>></script>
    <!-- FastClick -->
    <script src=<?= BASE_URL . "assets/admin/plugins/fastclick/fastclick.js"?>></script>
    <!-- Persian Data Picker -->
    <script src=<?= BASE_URL . "assets/admin/js/persian-date.min.js"?>></script>
    <script src=<?= BASE_URL . "assets/admin/js/persian-datepicker.min.js"?>></script>
    <!-- AdminLTE App -->
    <script src=<?= BASE_URL . "assets/admin/js/adminlte.min.js"?>></script>
    <!-- AdminLTE for demo purposes -->
    <script src=<?= BASE_URL . "assets/admin/js/demo.js"?>></script>
    <!-- Page script -->
    <!-- CK Editor -->
    <script src=<?= BASE_URL . "assets/admin/plugins/ckeditor/ckeditor.js"?>></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src=<?= BASE_URL . "assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"?>></script>
    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

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

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()


        $('.normal-example').persianDatepicker();




      })

      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
          .create(document.querySelector('#editor1'))
          .then(function (editor) {
            // The editor instance
          })
          .catch(function (error) {
            console.error(error)
          })

        // bootstrap WYSIHTML5 - text editor

          $('.textarea').wysihtml5({
              toolbar: { fa: true }
          })
      })

    </script>
  </body>
</html>
