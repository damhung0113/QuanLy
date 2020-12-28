<?php
include "../../connect.php";

function select_ca_nhan($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from khen_thuong where Ma_CB IS NOT NULL order by Ma_khen_thuong DESC limit $offset, $total_records_per_page");
}

function select_tap_the($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from khen_thuong where Ma_khoa IS NOT NULL order by Ma_khen_thuong DESC limit $offset, $total_records_per_page");
}

function count_data_ca_nhan() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM khen_thuong where Ma_CB is not null");
}

function count_data_tap_the() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM khen_thuong where Ma_CB is null");
}

function get_ds_danh_hieu() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_danh_hieu_thi_dua");
}

function count_danh_hieu() {
  global $connect;
  return mysqli_query($connect, "select Ma_danh_hieu from danh_hieu_thi_dua order by Ma_danh_hieu DESC LIMIT 1");
}

function get_ten_can_bo($ma_can_bo) {
  global $connect;
  return mysqli_query($connect, "select * from can_bo where Ma_CB='$ma_can_bo'");
}

function get_ten_cap_quyet_dinh($ma_cap_quyet_dinh) {
  global $connect;
  return mysqli_query($connect, "select Ten_cap from danh_sach_cap_quyet_dinh where Ma_cap ='$ma_cap_quyet_dinh'");
}

function get_ten_hinh_thuc_khen_thuong($ma_hinh_thuc_khen_thuong) {
  global $connect;
  return mysqli_query($connect, "select Ten_hinh_thuc from hinh_thuc_khen_thuong where Ma_hinh_thuc ='$ma_hinh_thuc_khen_thuong'");
}

function destroy($ma_khen_thuong) {
  global $connect;
  return mysqli_query($connect, "delete from khen_thuong where Ma_khen_thuong = '$ma_khen_thuong'");
}


function get_ten_cb($ma_cb) {
  global $connect;
  return mysqli_query($connect, "select * from can_bo where Ma_CB='$ma_cb' limit 1");
}

function get_ds_cap_quyet_dinh() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_cap_quyet_dinh");
}

function get_ds_hinh_thuc() {
  global $connect;
  return mysqli_query($connect, "select * from hinh_thuc_khen_thuong");
}

function count_khen_thuong() {
  global $connect;
  return mysqli_query($connect, "select Ma_khen_thuong from khen_thuong order by Ma_khen_thuong DESC LIMIT 1");
}

function get_ds_truong() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_truong");
}

function get_ds_khoa() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_khoa");
}

function get_ten_truong($ma_truong) {
  global $connect;
  return mysqli_query($connect, "select Ten_truong from danh_sach_truong where Ma_truong='$ma_truong'");
}

function get_ten_khoa($ma_khoa) {
  global $connect;
  return mysqli_query($connect, "select Ten_khoa from danh_sach_khoa where Ma_khoa='$ma_khoa'");
}
