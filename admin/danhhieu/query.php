<?php
include "../../connect.php";

function select($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from danh_hieu_thi_dua limit $offset, $total_records_per_page");
}

function count_data() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM danh_hieu_thi_dua");
}

function get_ds_danh_hieu() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_danh_hieu_thi_dua");
}

function count_danh_hieu() {
  global $connect;
  return mysqli_query($connect, "select Ma_danh_hieu from danh_sach_danh_hieu_thi_dua order by Ma_danh_hieu DESC LIMIT 1");
}

function get_ten_can_bo($ma_can_bo) {
  global $connect;
  return mysqli_query($connect, "select Ho_ten from can_bo where Ma_CB='$ma_can_bo'");
}

function get_ten_chien_si_thi_dua($ma_danh_hieu) {
  global $connect;
  return mysqli_query($connect, "select Ten_danh_hieu from danh_sach_danh_hieu_thi_dua where Ma_danh_hieu='$ma_danh_hieu'");
}
