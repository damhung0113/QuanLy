<?php
include "../../connect.php";

function can_bo() {
  global $connect;
  return mysqli_query($connect, "select * from can_bo order by Ho_ten");
}

function select_giai_thuong_can_bo($ma_cb) {
  global $connect;
  return mysqli_query($connect, "select Ma_giai_thuong, can_bo.Ho_ten, Ten, hinh_thuc_khen_thuong.Ten_hinh_thuc, To_chuc_thuong, To_chuc_trao_giai, Ngay_QD from giai_thuong INNER JOIN can_bo ON can_bo.Ma_CB = giai_thuong.Ma_CB INNER JOIN hinh_thuc_khen_thuong ON hinh_thuc_khen_thuong.Ma_hinh_thuc = giai_thuong.Loai_giai_thuong WHERE can_bo.Ma_CB = '$ma_cb'");
}

function select_danh_hieu_can_bo($ma_cb) {
  global $connect;
  return mysqli_query($connect, "select danh_hieu_thi_dua.Ma_danh_hieu, can_bo.Ho_ten, danh_sach_danh_hieu_thi_dua.Ten_danh_hieu, Ngay, So_QD from danh_hieu_thi_dua INNER JOIN can_bo ON can_bo.Ma_CB = danh_hieu_thi_dua.Ma_CB INNER JOIN danh_sach_danh_hieu_thi_dua ON danh_sach_danh_hieu_thi_dua.Ma_danh_hieu = danh_hieu_thi_dua.Chien_si_thi_dua WHERE can_bo.Ma_CB = '$ma_cb'");
}

function select_khen_thuong_can_bo($ma_cb) {
  global $connect;
  return mysqli_query($connect, "select khen_thuong.Ma_khen_thuong, can_bo.Ho_ten, danh_sach_cap_quyet_dinh.Ten_cap, hinh_thuc_khen_thuong.Ten_hinh_thuc, So_QD, Ngay_QD from khen_thuong INNER JOIN can_bo ON can_bo.Ma_CB = khen_thuong.Ma_CB INNER JOIN hinh_thuc_khen_thuong ON hinh_thuc_khen_thuong.Ma_hinh_thuc = khen_thuong.Ma_hinh_thuc INNER JOIN danh_sach_cap_quyet_dinh ON khen_thuong.Ma_cap_QD = danh_sach_cap_quyet_dinh.Ma_cap WHERE can_bo.Ma_CB = '$ma_cb'");
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

function get_ten_can_bo($ma_can_bo) {
  global $connect;
  return mysqli_query($connect, "select * from can_bo where Ma_CB='$ma_can_bo'");
}