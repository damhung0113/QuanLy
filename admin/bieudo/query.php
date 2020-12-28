<?php
include "../../connect.php";

function get_ds_truong() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_truong");
}

function get_ds_khoa() {
  global $connect;
  return mysqli_query($connect, "select * from danh_sach_khoa");
}

function dem_canbo_nam_truong() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_CB), Ma_truong FROM can_bo WHERE Gioi_tinh LIKE 'Nam' GROUP BY Ma_truong");
}

function dem_canbo_nu_truong() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_CB), Ma_truong FROM can_bo WHERE Gioi_tinh LIKE 'Nữ' GROUP BY Ma_truong");
}

function dem_giai_thuong_truong() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_giai_thuong), can_bo.Ma_truong FROM giai_thuong INNER JOIN can_bo on giai_thuong.Ma_CB = can_bo.Ma_CB GROUP BY can_bo.Ma_truong");
}

function dem_giai_thuong_truong_dk($where) {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_giai_thuong), can_bo.Ma_truong FROM giai_thuong INNER JOIN can_bo on giai_thuong.Ma_CB = can_bo.Ma_CB WHERE " . $where . "GROUP BY can_bo.Ma_truong ORDER BY can_bo.Ma_truong");
}

function dem_danh_hieu_truong() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_danh_hieu), can_bo.Ma_truong FROM danh_hieu_thi_dua INNER JOIN can_bo on danh_hieu_thi_dua.Ma_CB = can_bo.Ma_CB GROUP BY can_bo.Ma_truong");
}

function dem_khen_thuong_truong() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), can_bo.Ma_truong FROM khen_thuong INNER JOIN can_bo on khen_thuong.Ma_CB = can_bo.Ma_CB GROUP BY can_bo.Ma_truong");
}

function dem_khen_thuong_khoa_1() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 1 GROUP BY danh_sach_khoa.Ma_khoa");
}

function dem_khen_thuong_khoa_2() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 2 GROUP BY danh_sach_khoa.Ma_khoa");
}

function dem_khen_thuong_khoa_3() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 3 GROUP BY danh_sach_khoa.Ma_khoa");
}

function dem_khen_thuong_khoa_4() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 4 GROUP BY danh_sach_khoa.Ma_khoa");
}

function dem_khen_thuong_khoa_5() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 5 GROUP BY danh_sach_khoa.Ma_khoa");
}

function dem_khen_thuong_khoa_6() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 6 GROUP BY danh_sach_khoa.Ma_khoa");
}

function dem_khen_thuong_khoa_7() {
  global $connect;
  return mysqli_query($connect, "SELECT COUNT(Ma_khen_thuong), danh_sach_khoa.Ma_khoa FROM khen_thuong INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa WHERE danh_sach_khoa.Ma_truong = 7 GROUP BY danh_sach_khoa.Ma_khoa");
}