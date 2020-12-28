<?php

include "../../connect.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Lấy tên cán bộ
$ten_cb = "";
$ma_cb = "";
if (isset($_GET["ma_cb"])) {
  $ma_cb = is_null($_GET["ma_cb"]) ? null : $_GET["ma_cb"];
  $ten_cb = is_null(mysqli_fetch_row(get_ten_can_bo($ma_cb))) ? "Không tìm thấy cán bộ" : mysqli_fetch_row(get_ten_can_bo($ma_cb))[1];
}

?>
<html lang="vi">
<head>
  <title>Xuất dữ liệu</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <link rel="stylesheet" href="/QuanLy/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="/QuanLy/images/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script lang="javascript">
  function get_ten_cb(form) {
    const ma_cb = form.ma_cb.value;
    self.location = 'index.php?ma_cb=' + ma_cb;
  }

  function check_all() {
    const checkboxes = document.querySelectorAll('input[type=checkbox]');
    for (let i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = true;
    }
  }

  function un_check_all() {
    const checkboxes = document.querySelectorAll('input[type=checkbox]');
    for (let i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = false;
    }
  }

  function change_header() {
    if ($("#doi_tuong").val() === "giai_thuong") {
      $("#html_header").html('' +
          '<div class="form-check-inline mt-3">' +
          '<label class="form-check-label"><input type="checkbox" class="form-check-input" name="ma_giai_thuong" value="">Mã giải thưởng</label>' +
          '</div>' +
          '<div class="form-check-inline"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="ten_giai_thuong" value="">Tên giải thưởng</label> ' +
          '</div>' +
          '<div class="form-check-inline"><label class="form-check-label"> <input type="checkbox" class="form-check-input" name="loai_giai_thuong" value="">Loại giải thưởng</label>' +
          '</div>' +
          '<div class="form-check-inline"><label class="form-check-label"> <input type="checkbox" class="form-check-input" name="to_chuc_thuong" value="">Tổ chức thưởng</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="to_chuc_trao_giai" value="">Tổ chức trao giải</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="ngay_quyet_dinh" value="">Ngày quyết định</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" value="">Diễn giải</label>' +
          '</div>')
    } else if($("#doi_tuong").val() === "danh_hieu") {
      $("#html_header").html('' +
          '<div class="form-check-inline mt-3"><label class="form-check-label"> <input type="checkbox" class="form-check-input" name="ma_danh_hieu" value="">Mã danh hiệu</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="chien_si_thi_dua" value="">Chiến sĩ thi đua</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="ngay_trao" value="">Ngày trao</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="so_quyet_dinh" value="">Số quyết định</label>' +
          '</div>')
    } else if($("#doi_tuong").val() === "khen_thuong") {
      $("#html_header").html('' +
          '<div class="form-check-inline mt-3"><label class="form-check-label"> <input type="checkbox" class="form-check-input" name="ma_khen_thuong" value="">Mã khen thưởng</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="cap_quyet_dinh" value="">Cấp quyết định</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="hinh_thuc" value="">Hình thức khen thưởng</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="so_quyet_dinh" value="">Số quyết định</label>' +
          '</div>' +
          '<div class="form-check-inline"> <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="ngay_trao" value="">Ngày ra quyết định</label>' +
          '</div>')
    }
  }
</script>
<body>
<?php include_once("../../header.php"); ?>
<div class="main row">
  <?php include_once("../nav_bar.php"); ?>
  <div class="col-lg-10 row container-cus pl-5">
    <div class="col-md-12">
      <div class="card">
        <div class="title_chart" style="width: 25%">
          <span class="text-uppercase">Xuất dữ liệu</span>
          <span class="arrow_chart"></span>
        </div>
        <div class="card-header">
        </div>
        <form action="export.php" class="m-3" style="font-size: 18px;">
          <div class="form-group row">
            <div class="col-md-3">
              <label for="ma_cb">Mã cán bộ</label>
              <?php echo '<input required type="text" class="form-control" name="ma_cb" onchange="get_ten_cb(this.form)" id="ma_cb" aria-label="" placeholder="Nhập mã cán bộ..." value="' . $ma_cb . '">'; ?>
            </div>
            <div class="col-md-6">
              <label for="ten_can_bo">Tên cán bộ</label>
              <?php echo '<input type="text" class="form-control" id="ten_can_bo" aria-label="" placeholder="" disabled value="' . $ten_cb . '">'; ?>
            </div>
          </div>
          <div class="form-group">
            <label for="doi_tuong">Chọn đối tượng</label>
            <select name="doi_tuong" id="doi_tuong" class="form-control" onchange="change_header()">
              <option value="giai_thuong">Giải thưởng</option>
              <option value="danh_hieu">Danh hiệu thi đua</option>
              <option value="khen_thuong">Khen thưởng</option>
            </select>
          </div>
          <div class="form-group">
            <label for="noi_dung">Chọn nội dung - </label>
            <div class="btn-group">
              <button type="button" class="btn btn-success" id="sl_all" onclick="check_all()">Chọn tất cả</button>
              <span> </span>
              <button type="button" class="btn btn-danger ml-2" id="un_all" onclick="un_check_all()">Bỏ tất cả</button>
            </div>
            <br>
            <span id="html_header">
              <div class="form-check-inline mt-3">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="ma_giai_thuong" value="">Mã giải thưởng
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="ten_giai_thuong" value="">Tên giải thưởng
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="loai_giai_thuong" value="">Loại giải thưởng
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="to_chuc_thuong" value="">Tổ chức thưởng
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="to_chuc_trao_giai" value="">Tổ chức trao giải
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="ngay_quyet_dinh" value="">Ngày quyết định
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" value="">Diễn giải
                </label>
              </div>
            </span>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">Xuất file</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
include_once("../../footer.php");
?>
</body>
</html>