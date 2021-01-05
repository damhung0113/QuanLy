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

// Lấy tên cán bộ
$ten_cb = "";
$ma_cb = "";
if (isset($_GET["ma_cb"])) {
  $ma_cb = is_null($_GET["ma_cb"]) ? null : $_GET["ma_cb"];
  $ten_cb = is_null(mysqli_fetch_row(get_ten_can_bo($ma_cb))) ? "Không tìm thấy cán bộ" : mysqli_fetch_row(get_ten_can_bo($ma_cb))[1];
}

while ($row = mysqli_fetch_row($ds_danh_hieu)) {
  if (isset($_GET["chien_si_thi_dua"]) && $row[0] == intval($_GET["chien_si_thi_dua"])) {
    $danh_hieu .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
    $danh_hieu .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
}

// Sửa danh hiệu thi đua
if (isset($_POST["edit"])) {
  $e_ma_danh_hieu = $_POST["ma_danh_hieu"];
  $e_ma_cb = $_POST["ma_cb"];
  $e_chien_si_thi_dua = $_POST["danh_hieu"];
  $e_ngay = isset($_POST["ngay_qd"]) ? $_POST["ngay_qd"] : null;
  $e_so_qd = $_POST["so_qd"];

  if (isset($e_ma_cb) && isset($e_chien_si_thi_dua) && isset($e_so_qd)) { // kiểm tra điều kiện tiên quyết
    $e = mysqli_query($connect, "UPDATE danh_hieu_thi_dua SET Ma_CB='$e_ma_cb', Chien_si_thi_dua='$e_chien_si_thi_dua', Ngay='$e_ngay', So_QD='$e_so_qd' WHERE Ma_danh_hieu='$e_ma_danh_hieu'");
    if ($e) { // kiểm tra
      header("location:index.php");
      setcookie("success", "Sửa danh hiệu thi đua thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:create.php");
      setcookie("error", "Sửa danh hiệu thi đua không thành công!", time() + 1, "/", "", 0);
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
      self.location = 'create.php?ma_cb=' + ma_cb;
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
              <h3 class="mb-0 text-center">Sửa danh hiệu thi đua</h3>
            </div>
            <div class="card-header">
              <a href="index.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
            </div>
            <div class="card-body">
              <form class="form" role="form" autocomplete="off" id="" novalidate="" method="POST">
                <div class="form-group row">
                  <div class="col-3">
                    <label for="ma_cb">Mã cán bộ</label>
                    <?php echo '<input required type="text" class="form-control rounded-0" name="ma_cb" onchange="get_ten_cb(this.form)"
                           id="ma_cb" aria-label="" placeholder="Nhập mã cán bộ..." value="' . $ma_cb . '">' ?>
                  </div>
                  <div class="col-6">
                    <label for="ten_can_bo">Tên cán bộ</label>
                    <?php echo '<input type="text" class="form-control" id="ten_can_bo" aria-label="" placeholder="" disabled value="' . $ten_cb . '">' ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="danh_hieu">Danh hiệu</label>
                  <select id="danh_hieu" name="danh_hieu" class="form-control" required>
                    <?php echo $danh_hieu; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ngay_qd">Ngày quyết định</label>
                  <input required type="date" class="form-control" name="ngay_qd"
                         id="ngay_qd" aria-label="" value="<?php echo $_GET["ngay"]; ?>">
                </div>
                <div class="form-group">
                  <label for="so_qd">Số quyết định</label>
                  <input required type="text" class="form-control" name="so_qd"
                         id="so_qd" aria-label="" placeholder="Nhập số quyết định" value="<?php echo $_GET["so_qd"]; ?>">
                </div>
                <?php echo '<input type="text" class="d-none" name="ma_danh_hieu" value="' . $_GET["ma_danh_hieu"] . '">' ?>
                <button type="submit" name="edit" class="btn btn-primary btn float-right"
                        id="">Sửa quyết định
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
