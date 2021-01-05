<?php
include "../../connect.php";
include "../bieudo/query.php";

header('Content-Type: application/json');

$data = array();
$array_ds_truong = array();

$ds_truong = get_ds_truong();
while($row = mysqli_fetch_row($ds_truong)) {
  $array_ds_truong[] = $row[1];
}

if (isset($_GET["danh_hieu"])) {
  $ngay_quyet_dinh_start = $_GET["ngay_quyet_dinh_start"];
  $ngay_quyet_dinh_end = $_GET["ngay_quyet_dinh_end"];
  $danh_hieu = $_GET["danh_hieu"];
  $where = "danh_hieu_thi_dua.Chien_si_thi_dua = '$danh_hieu'";
  if (!empty($ngay_quyet_dinh_start) && !empty($ngay_quyet_dinh_end)) {
    $where .= "and danh_hieu_thi_dua.Ngay > '$ngay_quyet_dinh_start' and danh_hieu_thi_dua.Ngay < '$ngay_quyet_dinh_end'";
  }
  $smst = dem_danh_hieu_truong_dk($where);
} elseif(isset($_GET["ngay_quyet_dinh_start"])) {
  $ngay_quyet_dinh_start = $_GET["ngay_quyet_dinh_start"];
  $ngay_quyet_dinh_end = $_GET["ngay_quyet_dinh_end"];
  $where = "danh_hieu_thi_dua.Ngay > '$ngay_quyet_dinh_start' and danh_hieu_thi_dua.Ngay < '$ngay_quyet_dinh_end'";
  $smst = dem_danh_hieu_truong_dk($where);
} else {
  $smst = dem_danh_hieu_truong();
}
while ($row = mysqli_fetch_row($smst)) {
  $data[] = [$row[0], $array_ds_truong[$row[1] - 1]];
}
echo json_encode($data);


