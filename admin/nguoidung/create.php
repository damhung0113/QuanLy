<?php
include "../../connect.php";
include "./query.php";
include "../../alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

if (isset($_POST["dangky"])) {
  $user_name = $_POST["user_name"];
  $pass1 = $_POST["pass1"];
  $pass2 = $_POST["pass2"];
  $role = $_POST["role"];
  if ($pass1 != $pass2 || $user_name == "") {
    header("location:create.php");
    setcookie("error", "Tạo tài khoản không thành công!", time() + 1, "/", "", 0);
  } else {
    $pass = md5($pass1);
    if (mysqli_num_rows(select_from_user_name($user_name)) == 1) {
      header("location:create.php");
      setcookie("error", "Tên tài khoản đã tồn tại!", time() + 1, "/", "", 0);
    } else {
      create($user_name, $pass, $role);
      header("location:index.php");
      setcookie("success", "Tạo tài khoản thành công!", time() + 1, "/", "", 0);
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
              <h3 class="mb-0 text-center">Tạo tài khoản</h3>
            </div>
            <div class="card-header">
              <a href="index.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
            </div>
            <div class="card-body">
              <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                    method="POST">
                <div class="form-group">
                  <label for="username">Tên đăng nhập</label>
                  <input type="text" class="form-control rounded-0" name="user_name"
                         id="username" aria-label="" placeholder="Nhập tên đăng nhập...">
                </div>
                <div class="form-group">
                  <label for="pwd">Mật khẩu</label>
                  <input required type="password" class="form-control rounded-0" name="pass1"
                         placeholder="Nhập mật khẩu...">
                </div>
                <div class="form-group">
                  <label for="pwd">Nhập lại mật khẩu</label>
                  <input required type="password" class="form-control rounded-0" name="pass2"
                         placeholder="Nhập mật khẩu...">
                </div>
                <div class="form-group">

                  <label for="role">Vai trò:</label>

                  <select id="role" name="role" class="form-control">
                    <option value="0">Người quản lý</option>
                    <option value="1">Trưởng đơn vị (Cấp Đại học Quốc gia)</option>
                    <option value="2">Trưởng đơn vị (Cấp trường)</option>
                    <option value="3">Trưởng đơn vị (Cấp khoa)</option>
                  </select>
                </div>
                <button type="submit" name="dangky" class="btn btn-primary btn float-right"
                        id="btn_register">
                  Tạo tài khoản
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