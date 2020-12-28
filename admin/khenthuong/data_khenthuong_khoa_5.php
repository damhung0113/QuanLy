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


$smst = dem_khen_thuong_khoa_5();
while($row = mysqli_fetch_row($smst)) {
  $data[] = [$row[0], $array_ds_khoa[$row[1]-1]];
}
echo json_encode($data);
