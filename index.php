<?php
include "../connect.php";
global $connect;
if (isset($_SESSION["loged_admin"])) {
    header("Location: /QuanLy/admin/index.php");
}

if (isset($_GET["act"]) && $_GET["act"] == "logout") {
    unset($_SESSION["loged_user"]);
    header("Location: /QuanLy/taikhoan/login.php");
    setcookie("success", "Bạn đã đăng xuất!", time() + 1, "/", "", 0);
}

if (!isset($_SESSION["loged_user"]) && $_GET["act"] != "logout") {
    header("Location: /QuanLy/taikhoan/login.php");
    setcookie("error", "Bạn chưa đăng nhập!", time() + 1, "/", "", 0);
} else ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản Lý Thi Đua Khen Thưởng</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <a href="index.php" class="btn btn-info">Trang chủ</a>
        <?php if (isset($_SESSION["loged_user"])) {
            echo "<a href='index.php?act=logout' class='btn btn-danger float-right'>Đăng xuất</a>";
        } ?>
    </div>
    <div>
    </div>
</div>
</body>
</html>
