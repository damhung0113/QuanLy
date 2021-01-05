<?php
include "../../connect.php";
include "../bieudo/query.php";

header('Content-Type: application/json');

$data = array();
$array_ds_khoa = array();

$ds_khoa = get_ds_khoa();
while($row = mysqli_fetch_row($ds_khoa)) {
  $array_ds_khoa[] = $row[1];
}

if (isset($_GET["don_vi"]) && $_GET["don_vi"] == "khtn") {
  $where = "danh_sach_khoa.Ma_truong = 1";
} elseif($_GET["don_vi"] == "xhnv") {
  $where = "danh_sach_khoa.Ma_truong = 2";
} elseif($_GET["don_vi"] == "dhnn") {
  $where = "danh_sach_khoa.Ma_truong = 3";
} elseif($_GET["don_vi"] == "dhcn") {
  $where = "danh_sach_khoa.Ma_truong = 4";
} elseif($_GET["don_vi"] == "dhkt") {
  $where = "danh_sach_khoa.Ma_truong = 5";
} elseif($_GET["don_vi"] == "dhgd") {
  $where = "danh_sach_khoa.Ma_truong = 6";
} elseif($_GET["don_vi"] == "dhvn") {
  $where = "danh_sach_khoa.Ma_truong = 7";
}
if (isset($_GET["hinh_thuc"])) {
  $ngay_quyet_dinh_start = $_GET["ngay_quyet_dinh_start"];
  $ngay_quyet_dinh_end = $_GET["ngay_quyet_dinh_end"];
  $hinh_thuc = $_GET["hinh_thuc"];
  $where .= " and khen_thuong.Ma_hinh_thuc = '$hinh_thuc'";
  if (!empty($ngay_quyet_dinh_start) && !empty($ngay_quyet_dinh_end)) {
    $where .= " and khen_thuong.Ngay_QD > '$ngay_quyet_dinh_start' and khen_thuong.Ngay_QD < '$ngay_quyet_dinh_end'";
  }
  $smst = dem_khen_thuong_khoa($where);
} elseif(!empty($ngay_quyet_dinh_start) && !empty($ngay_quyet_dinh_end)) {
  $ngay_quyet_dinh_start = $_GET["ngay_quyet_dinh_start"];
  $ngay_quyet_dinh_end = $_GET["ngay_quyet_dinh_end"];
  $where .= " and khen_thuong.Ngay_QD > '$ngay_quyet_dinh_start' and khen_thuong.Ngay_QD < '$ngay_quyet_dinh_end'";
  $smst = dem_khen_thuong_khoa($where);
} else {
  $smst = dem_khen_thuong_khoa($where);
}
while ($row = mysqli_fetch_row($smst)) {
  $data[] = [$row[0], $array_ds_khoa[$row[1] - 1]];
}
echo json_encode($data);
