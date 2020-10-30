<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "./query.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
    header("Location: /opt/lampp/htdocs/QuanLy/index.php");
}

if (isset($_POST["chinhsua"])) {
    $user_name = $_GET["tendangnhap"];
    $role = $_POST["role"];
    if ($user_name != $_GET["tendangnhap"]) {
        echo 123;
        header("location:edit.php?tendangnhap=" . $_GET["tendangnhap"] . "&vaitro" . $_GET["vaitro"]);
        setcookie("error", "Sửa tài khoản không thành công!", time() + 1, "/", "", 0);
    } else {
        edit($user_name, $role);
        header("location:index.php");
        setcookie("success", "Sửa tài khoản thành công!", time() + 1, "/", "", 0);
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
                            <h3 class="mb-0 text-center">Chỉnh sửa tài khoản</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate=""
                                  method="POST">
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập <span
                                                class="text-danger">(Không thể chỉnh sửa)</span></label>
                                    <input type="text" class="form-control rounded-0" name="user_name"
                                           value="<?php echo $_GET["tendangnhap"]; ?>"
                                           id="username" aria-label="" placeholder="Nhập tên đăng nhập..." disabled>
                                </div>
                                <div class="form-group">

                                    <label for="role">Vai trò:</label>

                                    <select id="role" name="role">
                                        <option value="0">Người quản lý</option>
                                        <option value="1">Trưởng đơn vị (Cấp Đại học Quốc gia)</option>
                                        <option value="2">Trưởng đơn vị (Cấp trường)</option>
                                        <option value="3">Trưởng đơn vị (Cấp khoa)</option>
                                    </select>
                                </div>
                                <button type="submit" name="chinhsua" class="btn btn-primary btn float-right"
                                        id="btn_register">
                                    Sửa tài khoản
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