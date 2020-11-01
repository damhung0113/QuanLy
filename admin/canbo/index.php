<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
include "./query.php";
global $connect;
global $data;
if (isset($_SESSION["loged_user"])) {
  header("Location: /opt/lampp/htdocs/QuanLy/index.php");
}

$staffs = select();
$content = '';
while ($row = mysqli_fetch_row($staffs)) {
  $content .= '<tr><td>' . $row[0] .
      '</td><td>' . $row[1] .
      '</td><td>' . (isset(mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong) ? mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong : "") .
      '</td><td>' . (isset(mysqli_fetch_object(get_ten_khoa($row[3]))->Ten_khoa) ? mysqli_fetch_object(get_ten_khoa($row[3]))->Ten_khoa : "") .
      '</td><td>' . (isset(mysqli_fetch_object(get_ten_bo_mon($row[4]))->Ten_bo_mon) ? mysqli_fetch_object(get_ten_bo_mon($row[4]))->Ten_bo_mon : "") .
      '</td><td>' . '<a class="btn btn-success mr-3" type="button" href="edit.php?Ma_CB='. $row[0]. '"' . '>Sửa</a>' . '<a class="btn btn-danger" type="button" href="destroy.php?Ma_CB='. $row[0]. '"' . '>Xóa</a>' .
      '</td></tr>';
}
?>

<html lang="vi">
<head>
  <title>Quản Lý Cán Bộ</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="/QuanLy/images/favicon.ico" type="image/x-icon"/>
</head>
<body>
<div class="container-cus">
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/header.php");
  ?>
  <div class="main py-4">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h2>Quản Lý Cán Bộ</h2>
      </div>
      <div class="filter-form mt-3 mb-3 col-md-12">
        <form action="" method="get">
          <div class="row">
            <div class="col-12 col-md-4">
              <input type="text" class="form-control" placeholder="Họ và tên cán bộ" aria-label="">
            </div>
            <div class="col-12 col-md-4">
              <button class="btn btn-primary" type="submit" name="search">Tìm</button>
            </div>
          </div>
          <!--          <div class="row mt-3">-->
          <!--            <div class="col-12 col-md-2">-->
          <!--              <select name="truong" id="truong"></select>-->
          <!--            </div>-->
          <!--            <div class="col-12 col-md-2">-->
          <!--              <select name="khoa" id="khoa"></select>-->
          <!--            </div>-->
          <!--            <div class="col-12 col-md-2">-->
          <!--              <select name="bomon" id="bomon"></select>-->
          <!--            </div>-->
          <!--          </div>-->
        </form>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="create.php" class="btn btn-outline-primary float-right" role="button">Tạo hồ sơ cán bộ</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
              <tr style="color:White;background-color:#006699;font-weight:bold;">
                <th scope="col">Mã cán bộ</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Trường</th>
                <th scope="col">Khoa</th>
                <th scope="col">Bộ môn</th>
                <th style="width: 10%;"></th>
              </tr>
              </thead>
              <tbody>
              <?php echo $content; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/footer.php");
  ?>
</div>
</body>
</html>

