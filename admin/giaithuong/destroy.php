<?php
include "../../connect.php";
include "./query.php";

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

if (destroy($_GET["ma_giai_thuong"])) {
    header("Location:index.php");
    setcookie("success", "Xóa giải thưởng thành công!", time() + 1, "/", "", 0);
} else {
    header("Location:index.php");
    setcookie("error", "Xóa giải thưởng không thành công!", time() + 1, "/", "", 0);
}
