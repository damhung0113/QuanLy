<?php
include "../connect.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

if (isset($_GET["act"]) && $_GET["act"] == "logout") {
  unset($_SESSION["loged_admin"]);
  header("Location: /QuanLy/taikhoan/login.php");
  setcookie("success", "Bạn đã đăng xuất!", time() + 1, "/", "", 0);
}
if (!isset($_SESSION["loged_admin"]) && $_GET["act"] != "logout") {
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
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-cus">
  <?php
  include_once("../header.php");
  ?>
  <div class="main body-wrapper">
    <div class="left-menu">
      <div class="row">
        <div class="col-lg-3">
          <div class="sidebar" style="border: 1px solid black; margin-top: 30px">
            <div class="sidebar-menu">
              <h2><span>Menu</span></h2>
            </div>
            <ul class="sidebar-height">
              <li class="sidebar-1"><a href="#"> <i class="fa fa-address-card" aria-hidden="true"></i>
                  Danh sách Cán Bộ</a>
                <ul class="list-menu">
                  <li><a href="">Menu1</a></li>
                  <li><a href="">Menu2</a></li>
                  <li><a href="">Menu3</a></li>
                </ul>
              </li>
              <li class="sidebar-1"><a href="#"> <i class="fa fa-trophy" aria-hidden="true"></i> Danh sách
                  Giải thưởng</a>
                <ul class="list-menu">
                  <li><a href="">Menu1</a></li>
                  <li><a href="">Menu2</a></li>
                  <li><a href="">Menu3</a></li>
                </ul>
              </li>
              <li class="sidebar-1"><a href="#"><i class="fa fa-gavel" aria-hidden="true"></i> Danh sách
                  Kỷ luật</a>
                <ul class="list-menu">
                  <li><a href="">Menu1</a></li>
                  <li><a href="">Menu2</a></li>
                  <li><a href="">Menu3</a></li>
                </ul>
              </li>
              <li class="sidebar-1"><a href="#"> <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                  Danh sách Khen thưởng</a>
                <ul class="list-menu">
                  <li><a href="">Menu1</a></li>
                  <li><a href="">Menu2</a></li>
                  <li><a href="">Menu3</a></li>
                </ul>
              </li>
              <li class="sidebar-1"><a href="#"> <i class="fa fa-sign-language" aria-hidden="true"></i>
                  Danh hiệu thi đua</a></li>
              <li class="sidebar-1"><a href="#"> <i class="fa fa-bookmark" aria-hidden="true"></i> Tổng
                  hợp báo cáo</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9" style="text-align: center;">
          <div class="header-header-content" style="margin-top: 30px;">
            <h4>PHẦN MỀM QUẢN LÝ THI ĐUA KHEN THƯỞNG</h4>
            <h5>Trường Đại học Quốc Gia Hà Nội</h5>
          </div>
          <div class="top-content-1 d-flex justify-content-around">
            <div class="">
              <a href="./canbo/index.php">
                <img src="../images/lylich.png" alt="">
                <div class="content-header">
                  Danh sách cán bộ
                </div>
              </a>
            </div>
            <div class="">
              <a href="#">
                <img src="../images/thidua.png" alt="" style="width: 220px;">
                <div class="content-header">
                  Danh sách giải thưởng
                </div>
              </a>
            </div>
            <div class="">
              <a href="#">
                <img src="../images/kyluat.jpg" alt="">
                <div class="content-header">
                  Danh sách kỷ luật
                </div>
              </a>
            </div>
          </div>
          <div class="top-content-1 d-flex justify-content-around">
            <div class="">
              <a href="./nguoidung/index.php">
                <img src="../images/nguoidung.png" alt="">
                <div class="content-header">
                  Quản lý người dùng
                </div>
              </a>
            </div>
            <div class="">
              <a href="./khenthuong/list_khenthuong.php">
                <img src="../images/khen-thuong.png" alt="">
                <div class="content-header">
                  Danh sách khen thưởng
                </div>
              </a>
            </div>
            <div class="">
              <a href="#">
                <img src="../images/van-ban.png" alt="">
                <div class="content-header">
                  Tổng hợp báo cáo
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include_once("../footer.php");
  ?>
</body>
</html>
