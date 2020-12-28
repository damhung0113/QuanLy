<?php
include "../../connect.php";
include "../bieudo/query.php";
include "../../connect.php";

header('Content-Type: application/json');

$data = array();
$array_ds_truong = array();

$ds_truong = get_ds_truong();
while ($row = mysqli_fetch_row($ds_truong)) {
  $array_ds_truong[] = $row[1];
}

if (isset($_GET["loai_giai_thuong"])) {
  $ngay_quyet_dinh_start = $_GET["ngay_quyet_dinh_start"];
  $ngay_quyet_dinh_end = $_GET["ngay_quyet_dinh_end"];
  $loai_giai_thuong = $_GET["loai_giai_thuong"];
  $where = "giai_thuong.Loai_giai_thuong = '$loai_giai_thuong'";
  if (!empty($ngay_quyet_dinh_start) && !empty($ngay_quyet_dinh_end)) {
    $where .= "and giai_thuong.Ngay_QD > '$ngay_quyet_dinh_start' and giai_thuong.Ngay_QD < '$ngay_quyet_dinh_end'";
  }
  $smst = dem_giai_thuong_truong_dk($where);
} elseif(isset($_GET["ngay_quyet_dinh_start"])) {
  $ngay_quyet_dinh_start = $_GET["ngay_quyet_dinh_start"];
  $ngay_quyet_dinh_end = $_GET["ngay_quyet_dinh_end"];
  $where = "giai_thuong.Ngay_QD > '$ngay_quyet_dinh_start' and giai_thuong.Ngay_QD < '$ngay_quyet_dinh_end'";
  $smst = dem_giai_thuong_truong_dk($where);
} else {
  $smst = dem_giai_thuong_truong();
}
while ($row = mysqli_fetch_row($smst)) {
  $data[] = [$row[0], $array_ds_truong[$row[1] - 1]];
}
echo json_encode($data);
