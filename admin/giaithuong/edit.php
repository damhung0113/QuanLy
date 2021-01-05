<?php
include "../../connect.php";
include "./query.php";
include "../../alert.php";
global $connect;

if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}
// Lấy tên cán bộ
$ten_cb = "";
$ma_cb = "";
if (isset($_GET["ma_cb"])) {
  $ma_cb = is_null($_GET["ma_cb"]) ? null : $_GET["ma_cb"];
  $ten_cb = is_null(mysqli_fetch_row(get_ten_cb($ma_cb))) ? "Không tìm thấy cán bộ" : mysqli_fetch_row(get_ten_cb($ma_cb))[1];
}

$ds_giai_thuong = get_loai_giai_thuong();
$loai_giai_thuong = "";
while ($row = mysqli_fetch_row($ds_giai_thuong)) {
  if (isset($_GET["giai_thuong"]) && $row[0] == intval($_GET["loai_giai_thuong"])) {
    $loai_giai_thuong .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
    $loai_giai_thuong .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
}

// Sửa giải thưởng
if (isset($_POST["edit"])) {
  $e_ma_giai_thuong = $_POST["ma_giai_thuong"];
  $e_ma_cb = $_POST["ma_cb"];
  $e_ten_giai_thuong = isset($_POST["ten_giai_thuong"]) ? $_POST["ten_giai_thuong"] : null;
  $e_giai_thuong = $_POST["giai_thuong"];
  $e_ngay_qd = isset($_POST["ngay_qd"]) ? $_POST["ngay_qd"] : null;
  $e_to_chuc_thuong = isset($_POST["to_chuc_thuong"]) ? $_POST["to_chuc_thuong"] : null;
  $e_to_chuc_trao_giai = isset($_POST["to_chuc_trao_giai"]) ? $_POST["to_chuc_trao_giai"] : null;
  $e_dien_giai = isset($_POST["dien_giai"]) ? $_POST["dien_giai"] : null;


  if (isset($e_ma_cb) && isset($e_giai_thuong)) { // kiểm tra điều kiện tiên quyết
    $e = mysqli_query($connect, "UPDATE giai_thuong SET Ma_CB='$e_ma_cb', Ten='$e_ten_giai_thuong', Loai_giai_thuong='$e_giai_thuong', To_chuc_thuong='$e_to_chuc_thuong', To_chuc_trao_giai='$e_to_chuc_trao_giai', Ngay_QD='$e_ngay_qd', Dien_giai='$e_dien_giai' WHERE Ma_giai_thuong = '$e_ma_giai_thuong'");
    if ($e) { // kiểm tra
      header("location:index.php");
      setcookie("success", "Sửa danh giải thưởng thành công!", time() + 1, "/", "", 0);
    } else {
      header("location:create.php");
      setcookie("error", "Sửa giải thưởng không thành công!", time() + 1, "/", "", 0);
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
              <h3 class="mb-0 text-center">Sửa giải thưởng</h3>
            </div>
            <div class="card-header">
              <a href="index.php" class="btn btn-outline-primary float-right">Trở về trang danh sách</a>
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
                  <label for="ten_giai_thuong">Tên giải thưởng</label>
                  <input type="text" id="ten_giai_thuong" class="form-control" name="ten_giai_thuong" aria-label=""
                         placeholder="Nhập tên giải thưởng" value="<?php echo $_GET["ten"]; ?>">
                </div>
                <div class="form-group">
                  <label for="giai_thuong">Loại giải thưởng</label>
                  <select id="giai_thuong" name="giai_thuong" class="form-control">
                    <?php echo $loai_giai_thuong; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="to_chuc_thuong">Tổ chức thưởng</label>
                  <select name="to_chuc_thuong" id="to_chuc_thuong" class="form-control">
                    <?php
                    echo '<option value="Trung ương" class="" ' . (($_GET["to_chuc_thuong"] == "Trung ương") ? 'selected' : '') . '>Trung ương</option>';
                    echo '<option value="Địa phương" class="" ' . (($_GET["to_chuc_thuong"] == "Địa phương") ? 'selected' : '') . '>Địa phương</option>';
                    echo '<option value="Tổ chức trong nước" class="" ' . (($_GET["to_chuc_thuong"] == "Tổ chức trong nước") ? 'selected' : '') . '>Tổ chức trong nước</option>';
                    echo '<option value="Tổ chức nước ngoài" class="" ' . (($_GET["to_chuc_thuong"] == "Tổ chức nước ngoài") ? 'selected' : '') . '>Tổ chức nước ngoài</option>';
                    echo '<option value="Quốc gia nước ngoài" class="" ' . (($_GET["to_chuc_thuong"] == "Quốc gia nước ngoài") ? 'selected' : '') . '>Quốc gia nước ngoài</option>';
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="to_chuc_trao_giai">Tổ chức trao giải</label>
                  <input type="text" id="to_chuc_trao_giai" class="form-control" name="to_chuc_trao_giai" aria-label=""
                         placeholder="Nhập tổ chức trao giải" value="<?php echo $_GET["to_chuc_trao_giai"]; ?>">
                </div>
                <div class="form-group">
                  <label for="ngay_qd">Ngày quyết định</label>
                  <input required type="date" class="form-control" name="ngay_qd" id="ngay_qd" aria-label=""
                         value="<?php echo $_GET["ngay_qd"]; ?>">
                </div>
                <div class="form-group">
                  <label for="dien_giai">Diễn giải</label><br>
                  <textarea name="dien_giai" id="dien_giai" cols="70"
                            rows="5"><?php echo $_GET["dien_giai"]; ?></textarea>
                </div>
                <?php echo '<input type="text" class="d-none" name="ma_giai_thuong" value="' . $_GET["ma_giai_thuong"] . '">' ?>
                <button type="submit" name="edit" class="btn btn-primary btn float-right" id="">Sửa</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</body>
