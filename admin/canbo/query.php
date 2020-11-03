<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";

function select($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from can_bo limit $offset, $total_records_per_page");
}

function count_data() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM can_bo");
}

function get_ds_truong() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_truong");
}

function get_ds_khoa() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_khoa");
}

function get_ds_bo_mon() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_bo_mon");
}

function count_CB() {
  global $connect;
  return mysqli_query($connect, "select Ma_CB from can_bo order by Ma_CB DESC LIMIT 1");
}

function get_ten_truong($ma_truong) {
  global $connect;
  return mysqli_query($connect, "select Ten_truong from danh_sach_truong where Ma_truong='$ma_truong'");
}

function get_ten_khoa($ma_khoa) {
  global $connect;
  return mysqli_query($connect, "select Ten_khoa from danh_sach_khoa where Ma_khoa='$ma_khoa'");
}

function get_ten_bo_mon($ma_bo_mon) {
  global $connect;
  return mysqli_query($connect, "select Ten_bo_mon from danh_sach_bo_mon where Ma_bo_mon='$ma_bo_mon'");
}
