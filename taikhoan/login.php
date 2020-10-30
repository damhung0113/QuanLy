<?php
include "../connect.php";
include "./query.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
    header("Location: ../index.php");
}
if (isset($_SESSION["loged_admin"])) {
    header("Location: ../admin/index.php");
}

?>

<head>
    <title>Đăng nhập - Quản Lý Thi Đua Khen Thưởng</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            <h3 class="mb-0 text-center">Đăng nhập hệ thống</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                                  method="POST">
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập</label>
                                    <input type="text" class="form-control rounded-0" name="user_name_lg"
                                           id="username" aria-label="">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control rounded-0" id="password"
                                           name="passlg" aria-label="">
                                </div>
                                <button type="submit" name="dangnhap" class="btn btn-primary btn float-right"
                                        id="btnLogin">
                                    Đăng nhập
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST["dangnhap"])) {
    $tk = $_POST["user_name_lg"];
    $mk = md5($_POST["passlg"]);
    $user = login_user($tk, $mk);
    $count = mysqli_num_rows($user);
    if ($count == 1) {
        if (mysqli_fetch_row($user)[2] == "1") {
            header("Location: ../admin/index.php");
            $_SESSION["loged_admin"] = true;
        } else {
            header("Location: ../index.php");
            $_SESSION["loged_user"] = true;
        }
        setcookie("success", "Đăng nhập thành công!", time() + 1, "/", "", 0);
    } else {
        header("Location:login.php");
        setcookie("error", "Tên đăng nhập hoặc mật khẩu không chính xác!", time() + 1, "/", "", 0);
    }
}

if (isset($_COOKIE["error"])) {
    ?>
    <div class="alert alert-danger fixed-top">
        <?php echo $_COOKIE["error"]; ?>
    </div>
<?php } ?>

<?php
if (isset($_COOKIE["success"])) {
    ?>
    <div class="alert alert-success fixed-top">
        <?php echo $_COOKIE["success"]; ?>
    </div>
<?php } ?>
