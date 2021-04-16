<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ورود</title>
    <link rel="stylesheet" type="text/css" href=<?= BASE_URL . "assets/login/css/bootstrap.min.css" ?>>
    <link rel="stylesheet" type="text/css" href=<?= BASE_URL ."assets/login/css/fontawesome-all.min.css"?>>
    <link rel="stylesheet" type="text/css" href=<?= BASE_URL ."assets/login/css/iofrm-style.css"?>>
    <link rel="stylesheet" type="text/css" href=<?= BASE_URL ."assets/login/css/iofrm-theme12.css" ?>>
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="index.php">
                                <div class="logo">
                                    <img class="logo-size" src=<?= BASE_URL . "assets/images/logo.png"?> alt="LOGO">
                                </div>
                            </a>
                        </div>
                        <?php if(isset($_SESSION['loginfailed'])){
                            echo $_SESSION['loginfailed'];
                            UNSET($_SESSION['loginfailed']);
                        } else{
                            echo '<h3>برای دسترسی به سامانه لیست قیمت ها ثبت نام </h3>
                            <p>را توسط شرکت کامل نمایید</p>';
                        }?>
                        <div class="page-links">
                            <a href="login12.html" class="active">ورود</a>
                            <!-- <a href="register12.html">ثبت نام</a> -->
                        </div>
                        <form action="?action=submit" method="POST" > 
                            <input class="form-control" type="text" name="phone" placeholder="شماره همراه" required >
                            <input class="form-control" type="password" name="password" placeholder="رمز عبور" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn" name="submit">ورود</button>
                            </div>
                            <span></span>
                        </form>
                        <div class="other-links">
                            <!-- <span>یا ورود با</span><a href="#">فیسبوک</a><a href="#">گوگل</a><a href="#">لینکداین</a> -->
                            <div class="form-button">
                                <a href="index.php" class="ibtn">خروج از سامانه</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src=<?= BASE_URL . "assets/login/js/jquery.min.js"?>></script>
<script type="text/javascript" src=<?= BASE_URL . "assets/login/js/popper.min.js"?>></script>
<script type="text/javascript" src=<?= BASE_URL . "assets/login/js/bootstrap.min.js"?>></script>
<script type="text/javascript" src=<?= BASE_URL . "assets/login/js/main.js"?>></script>
</body>
</html>