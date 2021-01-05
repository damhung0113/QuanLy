<?php
include "../../connect.php";
include "./query.php";
include "../../alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

$ds_cap_quyet_dinh = get_ds_cap_quyet_dinh();
$ma_hinh_thuc = get_ds_hinh_thuc();
$cap_quyet_dinh = '<option value="" disabled selected>Chọn cấp quyết định</option>';
$hinh_thuc = '<option value="" disabled selected>Chọn hình thức</option>';

while ($row = mysqli_fetch_row($ds_cap_quyet_dinh)) {
  if (isset($_GET["cap_quyet_dinh"]) && $row[0] == intval($_GET["cap_quyet_dinh"])) {
    $cap_quyet_dinh .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
    $cap_quyet_dinh .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
}

while ($row = mysqli_fetch_row($ma_hinh_thuc)) {
  if (isset($_GET["ma_hinh_thuc"]) && $row[0] == intval($_GET["ma_hinh_thuc"])) {
    $hinh_thuc .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
    $hinh_thuc .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
}

// Lấy tên cán bộ
$ten_cb = "";
$ma_cb = "";
if (isset($_GET["ma_cb"])) {
  $ma_cb = is_null($_GET["ma_cb"]) ? null : $_GET["ma_cb"];
  $ten_cb = is_null(mysqli_fetch_row(get_ten_cb($ma_cb))) ? "Không tìm thấy cán bộ" : mysqli_fetch_row(get_ten_cb($ma_cb))[1];
}

// Lấy mã khen thưởng
$count = is_null(mysqli_fetch_row(count_khen_thuong())) ? 0 : intval(mysqli_fetch_row(count_khen_thuong())[0]);
$count++;

// Tạo mới khen thưởng
if (isset($_POST["create"])) {
  $c_ma_cb = $_POST["ma_cb"];
  $c_cap_quyet_dinh = isset($_POST["cap_quyet_dinh"]) ? $_POST["cap_quyet_dinh"] : null;
  $c_ma_hinh_thuc = isset($_POST["ma_hinh_thuc"]) ? $_POST["ma_hinh_thuc"] : null;
  $c_so_quyet_dinh = isset($_POST["so_quyet_dinh"]) ? $_POST["so_quyet_dinh"] : null;
  $c_ngay_qd = isset($_POST["ngay_qd"]) ? $_POST["ngay_qd"] : null;
  $c_li_do = isset($_POST["li_do"]) ? $_POST["li_do"] : null;

  if (isset($c_ma_cb) && isset($c_cap_quyet_dinh)) { // kiểm tra điều kiện tiên quyết
    $c = mysqli_query($connect,
        "INSERT INTO khen_thuong (Ma_khen_thuong, Ma_CB, Ma_cap_QD, Ma_hinh_thuc,So_QD,Ngay_QD, Ly_do)
         VALUES ('$count','$c_ma_cb','$c_cap_quyet_dinh','$c_ma_hinh_thuc','$c_so_quyet_dinh','$c_ngay_qd','$c_li_do')");
    if ($c) { // kiểm tra
      header("location:index_ca_nhan.php");
      setcookie("success", "Thêm mới khen thưởng thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:create_ca_nhan.php");
      setcookie("error", "Thêm mới khen thưởng không thành công!", time() + 1, "/", "", 0);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Quản Lý Danh Hiệu Thi Đua</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script lang="javascript">
    function get_ten_cb(form) {
      const ma_cb = form.ma_cb.value;
      self.location = 'create_ca_nhan.php?ma_cb=' + ma_cb;
    }
  </script>
</head>
<body>
<form action="" method="post">
  <div class="row">
    <div class="col-md-12 mt-5 d-flex flex-column justify-content-center">
      <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
          <div class="card rounded shadow shadow-sm">
            <div class="card-header">
              <h3 class="mb-0 text-center">Thêm mới khen thưởng cá nhân</h3>
            </div>
            <div class="card-header">
              <a href="index_ca_nhan.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
            </div>
            <div class="card-body">
              <form class="form" role="form" autocomplete="off" id="" novalidate="" method="POST">
                <div class="form-group row">
                  <div class="col-3">
                    <label for="ma_cb">Mã cán bộ</label>
                    <?php echo '<input required type="text" class="form-control" name="ma_cb" onchange="get_ten_cb(this.form)"
                           id="ma_cb" aria-label="" placeholder="Nhập mã cán bộ..." value="' . $ma_cb . '">' ?>
                  </div>
                  <div class="col-6">
                    <label for="ten_can_bo">Tên cán bộ</label>
                    <?php echo '<input type="text" class="form-control" id="ten_can_bo" aria-label="" placeholder="" disabled value="' . $ten_cb . '">' ?>
                  </div>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                  <label for="cap_quyet_dinh">Cấp quyết định</label>
                  <select id="cap_quyet_dinh" name="cap_quyet_dinh" class="form-control">
                    <?php echo $cap_quyet_dinh; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ma_hinh_thuc">Hình thức</label>
                  <select id="ma_hinh_thuc" name="ma_hinh_thuc" class="form-control">
                    <?php echo $hinh_thuc; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="so_quyet_dinh">Số quyết định</label>
                  <input type="text" id="so_quyet_dinh" class="form-control" name="so_quyet_dinh" aria-label=""
                         placeholder="Nhập số quyết định">
                </div>
                <div class="form-group">
                  <label for="ngay_qd">Ngày quyết định</label>
                  <input required type="date" class="form-control" name="ngay_qd" id="ngay_qd" aria-label="">
                </div>
                <div class="form-group">
                  <label for="li_do">Lí do</label><br>
                  <textarea name="li_do" id="li_do" cols="70" rows="5"></textarea>
                </div>
                <button type="submit" name="create" class="btn btn-primary btn float-right" id="">Thêm mới</button>
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
<!--  $('#so_quyet_dinh').val('QD' + Math.floor((Math.random() * 9) + 1) + '' + Math.floor((Math.random() * 9) + 1) + '' + Math.floor((Math.random() * 9) + 1)  + '' + Math.floor((Math.random() * 9) + 1))-->
<!--</script>-->
