<?php
include "../../connect.php";

function select()
{
    global $connect;
    return mysqli_query($connect, "select * from nguoi_dung ");
}

function select_from_user_name($ten_dang_nhap) {
    global $connect;
    return mysqli_query($connect, "select * from nguoi_dung where Ten_dang_nhap = '$ten_dang_nhap'");
}

function destroy($ten_dang_nhap)
{
    global $connect;
    return mysqli_query($connect, "delete from nguoi_dung where Ten_dang_nhap = '$ten_dang_nhap'");
}

function create($user_name, $pass, $role)
{
    global $connect;
    return mysqli_query($connect, "insert into nguoi_dung (Ten_dang_nhap,Mat_khau,Vai_tro) values ('$user_name','$pass','$role')");
}

function edit($user_name, $role) {
    global $connect;
    return mysqli_query($connect, "update nguoi_dung set Vai_tro = '$role' where Ten_dang_nhap = '$user_name'") or die;
}

function count_data() {
  global $connect;
  return mysqli_query($connect, "select COUNT(*) As total_records FROM nguoi_dung");
}