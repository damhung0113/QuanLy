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


$smst = dem_canbo_nam_truong();
$smst_1 = dem_canbo_nu_truong();
while($row = mysqli_fetch_row($smst)) {
  $data[] = [$row[0],  $array_ds_truong[$row[1]-1]];
}
$row = mysqli_fetch_all($smst_1);
for ($i = 0; $i < count($row); $i++) {
  array_push($data[$i], $row[$i][0]);
}
echo json_encode($data);
