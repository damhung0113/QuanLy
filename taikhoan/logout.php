<?php
include "../connect.php";
global $connect;

$vaitro = ["Người quản lý", "Trưởng đơn vị (Cấp Đại học Quốc gia)", "Trưởng đơn vị (Cấp trường)", "Trưởng đơn vị (Cấp khoa)"];

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="htt<?php
include "../connect.php";
global $connect;

$vaitro = ["Người quản lý", "Trưởng đơn vị (Cấp Đại học Quốc gia)", "Trưởng đơn vị (Cấp trường)", "Trưởng đơn vị (Cấp khoa)"];

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once("../header.php"); ?>
<div class="main body-wrapper mt-3">
  <div class="row">
    <?php include_once("./nav_bar.php"); ?>
    <div class="col-lg-10 container-cus" style="text-align: center;">
      <div class="header-header-content" style="margin-top: 30px;">
        <h4 class="" style="text-shadow: 3px 2px 6px #8F8E8E;">PHẦN MỀM QUẢN LÝ THI ĐUA KHEN THƯỞNG</h4>
        <h5>Trường Đại học Quốc Gia Hà Nội</h5>
      </div>
      <div class="top-content-1 d-flex justify-content-around">
        <div class="">
          <a href="./canbo/index.php" style="text-decoration: none;">
            <figure><img src="../images/lylich.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Danh sách cán bộ
            </div>
          </a>
        </div>
        <div class="">
          <a href="./giaithuong/index.php" style="text-decoration: none;">
            <figure><img src="../images/thidua.png" alt="" style="width: 220px;"></figure>
            <div class="content-header text-uppercase">
              Danh sách giải thưởng
            </div>
          </a>
        </div>
        <div class="">
          <a href="./danhhieu/index.php" style="text-decoration: none;">
            <figure><img src="../images/kyluat.jpg" alt=""></figure>
            <div class="content-header text-uppercase">
              Danh sách danh hiệu thi đua
            </div>
          </a>
        </div>
      </div>
      <div class="top-content-1 d-flex justify-content-around">
        <div class="">
          <a href="./nguoidung/index.php" style="text-decoration: none;">
            <figure><img src="../images/nguoidung.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Quản lý người dùng
            </div>
          </a>
        </div>
        <div class="">
          <a href="khenthuong/index_ca_nhan.php" style="text-decoration: none;">
            <figure><img src="../images/khen-thuong.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Danh sách khen thưởng
            </div>
          </a>
        </div>
        <div class="">
          <a href="./export/index.php" style="text-decoration: none;">
            <figure><img src="../images/van-ban.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Xuất dữ liệu
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once("../footer.php");
?>
</body>

<style>
	figure img {
		-webkit-transform: scale(1);
		transform: scale(1);
		-webkit-transition: .3s ease-in-out;
		transition: .3s ease-in-out;
	}

	figure:hover img {
		-webkit-transform: scale(1.3);
		transform: scale(1.3);
	}
</style>
</html>
ps://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once("../header.php"); ?>
<div class="main body-wrapper mt-3">
  <div class="row">
    <?php include_once("./nav_bar.php"); ?>
    <div class="col-lg-10 container-cus" style="text-align: center;">
      <div class="header-header-content" style="margin-top: 30px;">
        <h4 class="" style="text-shadow: 3px 2px 6px #8F8E8E;">PHẦN MỀM QUẢN LÝ THI ĐUA KHEN THƯỞNG</h4>
        <h5>Trường Đại học Quốc Gia Hà Nội</h5>
      </div>
      <div class="top-content-1 d-flex justify-content-around">
        <div class="">
          <a href="./canbo/index.php" style="text-decoration: none;">
            <figure><img src="../images/lylich.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Danh sách cán bộ
            </div>
          </a>
        </div>
        <div class="">
          <a href="./giaithuong/index.php" style="text-decoration: none;">
            <figure><img src="../images/thidua.png" alt="" style="width: 220px;"></figure>
            <div class="content-header text-uppercase">
              Danh sách giải thưởng
            </div>
          </a>
        </div>
        <div class="">
          <a href="./danhhieu/index.php" style="text-decoration: none;">
            <figure><img src="../images/kyluat.jpg" alt=""></figure>
            <div class="content-header text-uppercase">
              Danh sách danh hiệu thi đua
            </div>
          </a>
        </div>
      </div>
      <div class="top-content-1 d-flex justify-content-around">
        <div class="">
          <a href="./nguoidung/index.php" style="text-decoration: none;">
            <figure><img src="../images/nguoidung.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Quản lý người dùng
            </div>
          </a>
        </div>
        <div class="">
          <a href="khenthuong/index_ca_nhan.php" style="text-decoration: none;">
            <figure><img src="../images/khen-thuong.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Danh sách khen thưởng
            </div>
          </a>
        </div>
        <div class="">
          <a href="./export/index.php" style="text-decoration: none;">
            <figure><img src="../images/van-ban.png" alt=""></figure>
            <div class="content-header text-uppercase">
              Xuất dữ liệu
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once("../footer.php");
?>
</body>

<style>
	figure img {
		-webkit-transform: scale(1);
		transform: scale(1);
		-webkit-transition: .3s ease-in-out;
		transition: .3s ease-in-out;
	}

	figure:hover img {
		-webkit-transform: scale(1.3);
		transform: scale(1.3);
	}
</style>
</html>
