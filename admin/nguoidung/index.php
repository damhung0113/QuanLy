<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
include "./query.php";
global $connect;
global $data;
if (isset($_SESSION["loged_user"])) {
  header("Location: /opt/lampp/htdocs/QuanLy/index.php");
}

$users = select();
$vaitro = ["Người quản lý", "Trưởng đơn vị (Cấp Đại học Quốc gia)", "Trưởng đơn vị (Cấp trường)", "Trưởng đơn vị (Cấp khoa)"];
while ($row = mysqli_fetch_row($users)) {
  $data[] = array('tendangnhap' => $row[0], 'vaitro' => $vaitro[$row[2]], 'macanbo' => $row[3]);
}
?>

<html lang="vi">
<head>
  <title>Quản Lý Người Dùng</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">
  <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
  <script
      src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container-cus">
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/header.php");
  ?>
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/footer.php");
  ?>
</div>
</body>
</html>
