<?php
include "../../connect.php";
include "./query.php";

header('Content-Type: application/json');

$data = array();
$array_ds_truong = array();

$ds_truong = get_ds_truong();
while($row = mysqli_fetch_row($ds_truong)) {
  $array_ds_truong[] = $row[1];
}


$smst = dem_khen_thuong_truong();
while($row = mysqli_fetch_row($smst)) {
  $data[] = [$row[0], $array_ds_truong[$row[1]-1]];
}
echo json_encode($data);
