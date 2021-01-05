<?php
include "../../connect.php";

function get_ds_truong($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_truong limit $offset, $total_records_per_page");
}

function get_ds_khoa($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_khoa limit $offset, $total_records_per_page");
}

function get_ds_khoa_filter_where($offset, $total_records_per_page, $where) {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_khoa where $where limit $offset, $total_records_per_page");
}

function get_ds_bo_mon($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_bo_mon limit $offset, $total_records_per_page");
}

function count_data_truong() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM danh_sach_truong");
}

function count_data_khoa() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM danh_sach_bo_mon");
}

function count_data_bo_mon() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM danh_sach_khoa");
}

function get_ds_truong_filter() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_truong");
}

function get_ds_khoa_filter() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_khoa");
}

function get_ds_bo_mon_filter() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_bo_mon");
}

function get_ten_truong($ma_truong) {
  global $connect;
  return mysqli_query($connect, "select Ten_truong from danh_sach_truong where Ma_truong='$ma_truong'");
}

function get_ten_khoa($ma_khoa) {
  global $connect;
  return mysqli_query($connect, "select Ten_khoa from danh_sach_khoa where Ma_khoa='$ma_khoa'");
}

function count_truong() {
  global $connect;
  return mysqli_query($connect, "select Ma_truong from danh_sach_truong order by Ma_truong DESC LIMIT 1");
}

function count_khoa() {
  global $connect;
  return mysqli_query($connect, "select Ma_khoa from danh_sach_khoa order by Ma_khoa DESC LIMIT 1");
}

function count_bo_mon() {
  global $connect;
  return mysqli_query($connect, "select Ma_bo_mon from danh_sach_bo_mon order by Ma_bo_mon DESC LIMIT 1");
}