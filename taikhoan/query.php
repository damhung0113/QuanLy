<?php
include "../connect.php";

function login_user($tk, $mk) {
    global $connect;
    return mysqli_query($connect,"
				select * from nguoi_dung where Ten_dang_nhap = '$tk' and Mat_khau = '$mk'
			");
}
