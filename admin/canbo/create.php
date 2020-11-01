<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "./query.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

$ds_truong = get_ds_truong();
$ds_khoa = get_ds_khoa();
$ds_bo_mon = get_ds_bo_mon();

$truong = '';
$khoa = '';
$bo_mon = '';
while ($row = mysqli_fetch_row($ds_truong)) {
  $truong .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
}
while ($row = mysqli_fetch_row($ds_khoa)) {
  $khoa .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
}
while ($row = mysqli_fetch_row($ds_bo_mon)) {
  $bo_mon .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
}

$count = intval(mysqli_fetch_row(count_CB())[0]);
$count++;
if (isset($_POST["create"])) {
  $c_name = $_POST["name"];
  $c_truong = $_POST["truong"];
  $c_khoa = $_POST["khoa"];
  $c_bo_mon = $_POST["bo_mon"];

  if (isset($c_name) && isset($c_truong) && isset($c_khoa) && isset($c_bo_mon)) {

    $c = mysqli_query($connect, "insert into can_bo (Ma_CB,Ho_ten,Ma_truong,Ma_khoa,Ma_bo_mon) values ('$count','$c_name','$c_truong','$c_khoa','$c_bo_mon')");
    if ($c) {
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
                  <label for="name">Họ tên cán bộ</label>
                  <input required type="text" class="form-control rounded-0" name="name"
                         id="name" aria-label="" placeholder="Nhập họ và tên...">
                </div>
                <div class="form-group">
                  <label for="truong">Trường</label>
                  <select id="truong" name="truong" class="form-control">
                    <?php echo $truong; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="khoa">Khoa</label>
                  <select id="khoa" name="khoa" class="form-control">
                    <?php echo $khoa; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="bo_mon">Bộ môn</label>
                  <select id="bo_mon" name="bo_mon" class="form-control">
                    <?php echo $bo_mon; ?>
                  </select>
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
