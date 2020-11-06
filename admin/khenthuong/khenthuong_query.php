<?php
include "../../connect.php";

function select($offset, $total_records_per_page){
    global $connect;
    return mysqli_query($connect,"select * from khen_thuong limit $offset, $total_records_per_page");
}

function count_data() {
    global $connect;
    return mysqli_query($connect, "select COUNT(*) As total_records FROM khen_thuong");
}

function list_khenthuong(){
    global $connect;
    return mysqli_query($connect,"SELECT khen_thuong.Ma_khen_thuong ,can_bo.Ho_ten, 
                        danh_sach_khoa.Ten_khoa, danh_sach_bo_mon.Ten_bo_mon, danh_sach_cap_quyet_dinh.Ten_cap, 
                        hinh_thuc_khen_thuong.Ten_hinh_thuc,khen_thuong.So_QD, khen_thuong.Ngay_QD, khen_thuong.Ly_do
                         FROM khen_thuong INNER JOIN can_bo on khen_thuong.Ma_CB = can_bo.Ma_CB 
                         INNER JOIN danh_sach_khoa on khen_thuong.Ma_khoa = danh_sach_khoa.Ma_khoa 
                         INNER JOIN danh_sach_bo_mon on khen_thuong.Ma_bo_mon= danh_sach_bo_mon.Ma_bo_mon
                         INNER JOIN danh_sach_cap_quyet_dinh on khen_thuong.Ma_cap_QD= danh_sach_cap_quyet_dinh.Ma_cap 
                         INNER JOIN hinh_thuc_khen_thuong on khen_thuong.Ma_hinh_thuc = hinh_thuc_khen_thuong.Ma_hinh_thuc ");
}

