<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "./query.php";

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

if (destroy($_GET["Ma_CB"])) {
    header("Location:index.php");
    setcookie("success", "Xóa cán bộ thành công!", time() + 1, "/", "", 0);
} else {
    header("Location:index.php");
    setcookie("error", "Xóa cán bộ không thành công!", time() + 1, "/", "", 0);
}
