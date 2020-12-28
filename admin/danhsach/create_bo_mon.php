<?php
include "../../connect.php";
include "./query.php";
include "../../alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Lấy mã trường
$count = is_null(mysqli_fetch_row(count_bo_mon())) ? 0 : intval(mysqli_fetch_row(count_bo_mon())[0]);
$count++;

// Tạp mới trường
if (isset($_POST["create"])) {
  $ten_khoa = $_POST["ten_khoa"];
  $ten_bo_mon = $_POST["ten_bo_mon"];
  if (isset($ten_khoa)) { // kiểm tra điều kiện tiên quyết
    $c = mysqli_query($connect, "INSERT INTO danh_sach_bo_mon (Ma_bo_mon, Ten_bo_mon, Ma_khoa) VALUES ('$count',$ten_bo_mon,'$ten_khoa')");
    if ($c) { // kiểm tra
      header("location:bo_mon.php");
      setcookie("success", "Thêm mới bộ môn thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:create_bo_mon.php");
      setcookie("error", "Thêm mới bộ môn không thành công!", time() + 1, "/", "", 0);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Quản Lý Bộ Môn</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<form action="" method="post">
  <div class="row">
    <div class="col-md-12 mt-5 d-flex flex-column justify-content-center">
      <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
          <div class="card rounded shadow shadow-sm">
            <div class="card-header">
              <h3 class="mb-0 text-center">Thêm mới bộ môn</h3>
            </div>
            <div class="card-header">
              <a href="bomon.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
            </div>
            <div class="card-body">
              <form class="form" role="form" autocomplete="off" id="" novalidate="" method="POST">
                <div class="form-group">
                  <label for="ten_truong">Chọn trường</label>
                  <?php
                  $ds_truong_filter = get_ds_truong_filter();
                  echo '<select name="ten_truong" class="form-control">';
                  echo '<option value="">Chọn một trường...</option>';
                  while ($row = mysqli_fetch_row($ds_truong_filter)) {
                    if ($row[0] == $_GET["truong"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?>
                </div>
                <div class="form-group">
                  <label for="ten_khoa">Chọn khoa</label>
                  <?php
                  $ds_khoa_filter = get_ds_khoa_filter();
                  echo '<select id="ten_khoa" name="ten_khoa" class="form-control">';
                  echo '<option value="">Chọn một khoa...</option>';
                  while ($row = mysqli_fetch_row($ds_khoa_filter)) {
                    if ($row[0] == $_GET["khoa"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?>
                </div>
                <div class="form-group">
                  <label for="ten_bo_mon">Tên bộ môn</label>
                  <input required type="text" class="form-control" name="ten_bo_mon"
                         id="ten_bo_mon" aria-label="" placeholder="Nhập tên bộ môn">
                </div>
                <button type="submit" name="create" class="btn btn-primary btn float-right"
                        id="">
                  Thêm mới bộ môn
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</body>
</html>

<!--<script>-->
<!--  $('#so_qd').val('QD' + Math.floor((Math.random() * 9) + 1) + '' + Math.floor((Math.random() * 9) + 1) + '' + Math.floor((Math.random() * 9) + 1)  + '' + Math.floor((Math.random() * 9) + 1))-->
<!--</script>-->