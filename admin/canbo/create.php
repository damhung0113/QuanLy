<?php
include "../../connect.php";
include "./query.php";
include "../../alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Khởi tạo biến
$ds_truong = get_ds_truong();
$ds_khoa = get_ds_khoa();
$ds_bo_mon = get_ds_bo_mon();
$truong = '<option value="" disabled selected>Chọn một trường</option>';
$khoa = '';
$bo_mon = '';
$ten_cb = isset($_GET["ten_cb"]) ? $_GET["ten_cb"] : '';

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
    }
    if ($bo_mon_chained == $row[2]) {
      $bo_mon .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
    }
  }
}

// Lấy mã cán bộ
$count = is_null(mysqli_fetch_row(count_CB())) ? 0 : intval(mysqli_fetch_row(count_CB())[0]);
$count++;

// Tạp cán bộ
if (isset($_POST["create"])) {
  $c_name = $_POST["name"];
  $c_truong = $_POST["truong"];
  $c_khoa = isset($_POST["khoa"]) ? $_POST["khoa"] : null;
  $c_bo_mon = isset($_POST["bo_mon"]) ? $_POST["bo_mon"] : null;

  if (isset($c_name) && isset($c_truong)) { // kiểm tra điều kiện tiên quyết
    if (isset($c_khoa) && isset($c_bo_mon)) { // kiểm tra nếu có cả khoa và bộ môn
      $c = mysqli_query($connect, "insert into can_bo (Ma_CB,Ho_ten,Ma_truong,Ma_khoa,Ma_bo_mon) values ('$count','$c_name','$c_truong',$c_khoa,$c_bo_mon)");
    } else if (isset($c_khoa)) { // kiểm tra nếu chỉ có khoa
      $c = mysqli_query($connect, "insert into can_bo (Ma_CB,Ho_ten,Ma_truong,Ma_khoa,Ma_bo_mon) values ('$count','$c_name','$c_truong',$c_khoa,null)");
    } else { // kiểm tra nếu không có khoa và bộ môn
      $c = mysqli_query($connect, "insert into can_bo (Ma_CB,Ho_ten,Ma_truong,Ma_khoa,Ma_bo_mon) values ('$count','$c_name','$c_truong',null,null)");
    }
    if ($c) { // kiểm tra
      header("location:index.php");
      setcookie("success", "Hồ sơ cán bộ được tạo thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:create.php");
      setcookie("error", "Tạo cán bộ không thành công!", time() + 1, "/", "", 0);
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
          const val_ten_cb = form.name.value;
          self.location = 'create.php?truong=' + val + '&ten_cb=' + val_ten_cb;
      }

      function reloadKhoa(form) {
          const val = form.truong.options[form.truong.options.selectedIndex].value;
          const val2 = form.khoa.options[form.khoa.options.selectedIndex].value;
          const val_ten_cb = form.name.value;
          self.location = 'create.php?truong=' + val + '&khoa=' + val2 + '&ten_cb=' + val_ten_cb;
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
              <h3 class="mb-0 text-center">Tạo hồ sơ cán bộ</h3>
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
                <button type="submit" name="create" class="btn btn-primary btn float-right"
                        id="">
                  Tạo hồ sơ cán bộ
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
