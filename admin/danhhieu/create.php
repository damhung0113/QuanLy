<?php
include "../../connect.php";
include "./query.php";
include "../../alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

$ds_danh_hieu = get_ds_danh_hieu();
$danh_hieu = '<option value="" disabled selected>Chọn danh hiệu</option>';

while ($row = mysqli_fetch_row($ds_danh_hieu)) {
  if (isset($_GET["danh_hieu_thi_dua"]) && $row[0] == intval($_GET["danh_hieu_thi_dua"])) {
      $danh_hieu .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
      $danh_hieu .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
}

// Lấy mã danh hiệu
$count = intval(mysqli_fetch_row(count_danh_hieu())[0]);
$count++;

// Tạp mới danh hiệu thi đua
if (isset($_POST["create"])) {
  $c_ma_cb = $_POST["ma_can_bo"];
  $c_chien_si_thi_dua = $_POST["danh_hieu"];
  $c_ngay = isset($_POST["ngay"]) ? $_POST["ngay"] : null;
  $c_so_qd = isset($_POST["so_qd"]);

  if (isset($c_ma_cb) && isset($c_chien_si_thi_dua) && isset($c_so_qd)) { // kiểm tra điều kiện tiên quyết
    if (isset($c_ngay)) {
        $c = mysqli_query($connect, "INSERT INTO danh_hieu_thi_dua (Ma_danh_hieu, Ma_CB, Chien_si_thi_dua, Ngay, So_QD) VALUES ('$count','$c_ma_cb','$c_chien_si_thi_dua',$c_ngay,$c_so_qd)");
    } else {
        $c = mysqli_query($connect, "INSERT INTO danh_hieu_thi_dua (Ma_danh_hieu, Ma_CB, Chien_si_thi_dua, Ngay, So_QD) VALUES ('$count','$c_ma_cb','$c_chien_si_thi_dua',null ,$c_so_qd)");
    }
    if ($c) { // kiểm tra
      header("location:index.php");
      setcookie("success", "Thêm mới danh hiệu thi đua thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:create.php");
      setcookie("error", "Thêm mới danh hiệu thi đua không thành công!", time() + 1, "/", "", 0);
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

  <script language=JavaScript>
      function reloadDanhHieu(form) {
          const val = form.$danh_hieu.options[form.$danh_hieu.options.selectedIndex].value;
          self.location = 'create.php?$danh_hieu=' + val;
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
              <h3 class="mb-0 text-center">Thêm mới danh hiệu thi đua</h3>
            </div>
            <div class="card-header">
              <a href="index.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
            </div>
            <div class="card-body">
              <form class="form" role="form" autocomplete="off" id="" novalidate="" method="POST">
                <div class="form-group">
                  <label for="danh_hieu">Danh hiệu</label>
                  <select id="danh_hieu" name="danh_hieu" onchange="reloadDanhHieu(this.form)" class="form-control">
                    <?php echo $danh_hieu; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ma_can_bo">Mã cán bộ</label>
                  <input required type="text" class="form-control rounded-0" name="ma_can_bo"
                         id="ma_can_bo" aria-label="" placeholder="Nhập mã cán bộ...">
                </div>
                <div class="form-group">
                  <label for="ma_qd">Mã quyết định</label>
                  <input required type="text" class="form-control rounded-0" name="ma_qd"
                         id="ma_qd" aria-label="" placeholder="Nhập mã quyết định...">
                </div>
                <button type="submit" name="create" class="btn btn-primary btn float-right"
                        id="">
                    Thêm mới quyết định trao danh hiệu thi đua
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
