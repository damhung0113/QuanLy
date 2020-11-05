<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "./query.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Khới tạo biến
$ds_truong = get_ds_truong();
$ds_khoa = get_ds_khoa();
$ds_bo_mon = get_ds_bo_mon();
$truong = '<option value="" disabled selected>Chọn một trường</option>';
$khoa = '';
$bo_mon = '';

// lấy dữ liệu cán bộ
$ma_cb = $_GET["Ma_CB"];
$c_truong = $_GET["truong"];
$c_khoa = isset($_GET["khoa"]) ? $_GET["khoa"] : null;
$c_bo_mon = isset($_GET["bo_mon"]) ? $_GET["bo_mon"] : null;

if (mysqli_fetch_row(get_ten_cb($ma_cb)) == null) { // Kiểm tra dữ liệu
  header("Location: /QuanLy/index.php");
} else {
  $ten_cb = mysqli_fetch_row(get_ten_cb($ma_cb))[0];
}


// Chained select
while ($row = mysqli_fetch_row($ds_truong)) {
  if (isset($_GET["truong"]) && $row[0] == intval($_GET["truong"])) {
    $khoa_chained = $row[0];
    $khoa .= '<option value="" disabled selected>Chọn một khoa</option>';
    $truong .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
    $truong .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
}
while ($row = mysqli_fetch_row($ds_khoa)) {
  if (isset($_GET["truong"]) && $_GET["truong"] != null) {
    if (mysqli_fetch_row(get_ten_truong($_GET["truong"])) == null) { // Kiểm tra dữ liệu về trường
      header("Location: /QuanLy/index.php");
    }
    if ($khoa_chained == $row[2]) {
      if (isset($_GET["khoa"]) && $row[0] == intval($_GET["khoa"])) {
        $bo_mon_chained = $row[0];
        $khoa .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
      } else {
        $khoa .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
      }
    }
  }
}
while ($row = mysqli_fetch_row($ds_bo_mon)) {
  if (isset($_GET["khoa"]) && $_GET["khoa"] != null) {
    if (mysqli_fetch_row(get_ten_khoa($_GET["khoa"])) == null) { // Kiểm tra dữ liệu vê khoa
      header("Location: /QuanLy/index.php");
    } else {
      if ($bo_mon_chained == $row[2]) {
        $bo_mon .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
      }

    }
  }
}

if (isset($_GET["bo_mon"]) && mysqli_fetch_row(get_ten_bo_mon($_GET["bo_mon"])) == null && $_GET["bo_mon"] != null) { // Kiểm tra dữ liệu về bộ môn
  header("Location: /QuanLy/index.php");
}

if (isset($_POST["edit"])) {
  $ten_cb_update = $_POST["name"];
  $c_truong_update = $_POST["truong"];
  $c_khoa_update = isset($_POST["khoa"]) ? $_POST["khoa"] : null;
  $c_bo_mon_update = isset($_POST["bo_mon"]) ? $_POST["bo_mon"] : null;
  $ma_cb = $_POST["ma_cb"];
  if (isset($ten_cb_update) && isset($c_truong_update)) { // kiểm tra điều kiện tiên quyết
    if (isset($c_khoa_update) && isset($c_bo_mon_update)) { // kiểm tra nếu có cả khoa và bộ môn
      $c = mysqli_query($connect, "update can_bo set Ho_ten='$ten_cb_update', Ma_truong='$c_truong_update', Ma_khoa='$c_khoa_update', Ma_bo_mon='$c_bo_mon_update' where Ma_CB='$ma_cb'");
    } else if (isset($c_khoa)) { // kiểm tra nếu chỉ có khoa
      $c = mysqli_query($connect, "update can_bo set Ho_ten='$ten_cb_update', Ma_truong='$c_truong_update', Ma_khoa='$c_khoa_update', Ma_bo_mon=null where Ma_CB='$ma_cb'");
    } else { // kiểm tra nếu không có khoa và bộ môn
      $c = mysqli_query($connect, "update can_bo set Ho_ten='$ten_cb_update', Ma_truong='$c_truong_update', Ma_khoa=null, Ma_bo_mon=null where Ma_CB='$ma_cb'");
    }
    if ($c) { // kiểm tra
      header("location:index.php");
      setcookie("success", "Hồ sơ cán bộ được cập nhập thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:edit.php");
      setcookie("error", "Cập nhật hồ sơ cán bộ không thành công!", time() + 1, "/", "", 0);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Quản Lý Thi Đua Khen Thưởng</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script language=JavaScript>
      function reloadTruong(form) {
          const val = form.truong.options[form.truong.options.selectedIndex].value;
          const val_ma_cb = form.ma_cb.value;
          self.location = 'edit.php?truong=' + val + '&Ma_CB=' + val_ma_cb;
      }

      function reloadKhoa(form) {
          const val = form.truong.options[form.truong.options.selectedIndex].value;
          const val2 = form.khoa.options[form.khoa.options.selectedIndex].value;
          const val_ma_cb = form.ma_cb.value;
          self.location = 'edit.php?truong=' + val + '&khoa=' + val2 + '&Ma_CB=' + val_ma_cb;
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
              <h3 class="mb-0 text-center">Sửa hồ sơ cán bộ</h3>
            </div>
            <div class="card-header">
              <a href="index.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
            </div>
            <div class="card-body">
              <form class="form" role="form" autocomplete="off" id="" novalidate="" method="POST">
                <div class="form-group">
                  <label for="truong">Trường</label>
                  <select id="truong" name="truong" onchange="reloadTruong(this.form)" class="form-control">
                    <?php echo $truong; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="khoa">Khoa</label>
                  <select id="khoa" name="khoa" onchange="reloadKhoa(this.form)" class="form-control">
                    <?php echo $khoa; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="bo_mon">Bộ môn</label>
                  <select id="bo_mon" name="bo_mon" class="form-control">
                    <?php echo $bo_mon; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Họ tên cán bộ</label>
                  <?php echo '<input required type="text" class="form-control rounded-0" name="name" 
                                id="name" aria-label="" placeholder="Nhập họ và tên..." value="' . $ten_cb . '">'; ?>
                </div>
                <?php echo '<input type="text" class="d-none" name="ma_cb" value="' . $ma_cb . '">' ?>
                <button type="submit" name="edit" class="btn btn-primary btn float-right"
                        id="">
                  Sửa hồ sơ cán bộ
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
