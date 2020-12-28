<?php
include "../../connect.php";

function select($offset, $total_records_per_page) {
  global $connect;
  return mysqli_query($connect, "select * from giai_thuong limit $offset, $total_records_per_page");
}

function get_ten_cb($ma_cb) {
  global $connect;
  return mysqli_query($connect, "select * from can_bo where Ma_CB='$ma_cb' limit 1");
}

function get_loai_giai_thuong() {
  global $connect;
  return mysqli_query($connect, "select * from loai_giai_thuong");
}

function destroy($ma_cb) {
  global $connect;
  return mysqli_query($connect, "delete from can_bo where Ma_CB = '$ma_cb'");
}

function count_data() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM giai_thuong");
}

function get_ds_danh_hieu() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_danh_hieu_thi_dua");
}

function count_giai_thuong() {
  global $connect;
  return mysqli_query($connect, "select Ma_giai_thuong from giai_thuong order by Ma_giai_thuong DESC LIMIT 1");
}

function get_ten_can_bo($ma_can_bo) {
  global $connect;
  return mysqli_query($connect, "select Ho_ten from can_bo where Ma_CB='$ma_can_bo'");
}

function get_ten_giai_thuong($ma_giai_thuong) {
  global $connect;
  return mysqli_query($connect, "select Ten_giai_thuong from loai_giai_thuong where Ma_giai_thuong='$ma_giai_thuong'");
}

function filter($ma_giai_thuong, $ho_ten, $ten_giai_thuong, $loai_giai_thuong, $to_chuc_thuong, $to_chuc_trao_giai, $ngay_quyet_dinh_start, $ngay_quyet_dinh_end, $offset, $total_records_per_page) {
  global $connect;
  $where = "Ten like '%$ten_giai_thuong%' and To_chuc_thuong like '%$to_chuc_thuong%' and To_chuc_trao_giai like '%$to_chuc_trao_giai'";
  if ($loai_giai_thuong !== "") {
    $where .= "and Loai_giai_thuong = $loai_giai_thuong";
  }
  if ($ma_giai_thuong !== "") {
    $where .= "and Ma_giai_thuong = $ma_giai_thuong";
  }
  if ($ngay_quyet_dinh_start !== "" && $ngay_quyet_dinh_end !== "") {
    $where .= "and Ngay_QD > '$ngay_quyet_dinh_start' and Ngay_QD < '$ngay_quyet_dinh_end'";
  }
  return mysqli_query($connect, "select * from giai_thuong where $where order by Ma_giai_thuong limit $offset, $total_records_per_page");
}