<?php
include "../../connect.php";
include "./query.php";

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

if (destroy($_GET["Ma_danh_hieu"])) {
    header("Location:index.php");
    setcookie("success", "Xóa danh hiệu thành công!", time() + 1, "/", "", 0);
} else {
    header("Location:index.php");
    setcookie("error", "Xóa danh hiệu không thành công!", time() + 1, "/", "", 0);
}
