<?php
include "../../connect.php";
include "./query.php";

if (isset($_SESSION["loged_user"])) {
    header("Location: ../index.php");
}

if (destroy($_GET["ten_dang_nhap"])) {
    header("Location:index.php");
    setcookie("success", "Xóa người dùng thành công!", time() + 1, "/", "", 0);
}
