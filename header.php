<?php
$vaitro = ["Người quản lý", "Trưởng đơn vị (Cấp Đại học Quốc gia)", "Trưởng đơn vị (Cấp trường)", "Trưởng đơn vị (Cấp khoa)"];
echo '<header class="" style="">';
echo '<div class="header-top" style="background: linear-gradient(to right, rgba(24,120,175,0) 34%, rgba(24,120,175,1) 45%, rgba(24,119,175,1) 45%, rgba(24,119,175,1) 45%);">';
echo '<div class="row pr-3">';
echo '<div class="col-lg-3 col-md-4">';
echo '</div>';
echo '<div class="col-lg-9 col-md-8">';
echo '<div class="header-top-right">';
echo '<ul class="ht-menu text-light">';
echo '<li>';
echo '<a class="text-light" href="" style="text-decoration: none;">Hướng dẫn sử dụng</a>';
echo '</li>';
echo '<li>';
echo '<a class="text-light" href="" style="text-decoration: none;">Thông báo</a>';
echo '</li>';
echo '<li>';
echo '<a class="text-light" href="" style="text-decoration: none;">' . 'Xin chào: ' . '<b>' . $_SESSION["current_user"] . ' [' . $vaitro[$_SESSION["role"]] . ']' . '</b>' . '</a>';
echo '</li>';
echo '<a href="index.php?act=logout" class="btn btn-danger float-right">Đăng xuất</a>';
echo '</li>';
echo '</ul>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</header>';
