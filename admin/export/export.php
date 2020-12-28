<?php

include "../../connect.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}
header('Content-Type: text/csv; charset=utf-8');
$output = fopen("php://output", "w");
if ($_GET["doi_tuong"] == "giai_thuong") {
  header('Content-Disposition: attachment; filename=giaithuong_canbo_' . $_GET["ma_cb"] . '_' . date("dmYGi") . '.csv');
  if (isset($_GET["ma_cb"])) {
    $header = array();
    if (isset($_GET["ma_giai_thuong"])) {
      array_push($header, "Mã giải thưởng");
    }
    array_push($header, "Họ tên cán bộ");
    if (isset($_GET["ten_giai_thuong"])) {
      array_push($header, "Tên giải thưởng");
    }
    if (isset($_GET["loai_giai_thuong"])) {
      array_push($header, "Loại giải thưởng");
    }
    if (isset($_GET["to_chuc_thuong"])) {
      array_push($header, "Tổ chức thưởng");
    }
    if (isset($_GET["to_chuc_trao_giai"])) {
      array_push($header, "Tổ chức trao giải");
    }
    if (isset($_GET["ngay_quyet_dinh"])) {
      array_push($header, "Ngày quyết định");
    }
    fputcsv($output, $header);
    $giai_thuong = select_giai_thuong_can_bo($_GET["ma_cb"]);
    while ($row = mysqli_fetch_array($giai_thuong)) {
      $temp = array();
      for ($i = 0; $i < count($header); $i++) {
        if ($header[$i] != "") {
          $temp[] = $row[$i];
        }
      }
      fputcsv($output, $temp);
    }
  }
} else if ($_GET["doi_tuong"] == "danh_hieu") {
  header('Content-Disposition: attachment; filename=danhhieu_canbo_' . $_GET["ma_cb"] . '_' . date("dmYGi") . '.csv');
  if (isset($_GET["ma_cb"])) {
    $header = array();
    if (isset($_GET["ma_danh_hieu"])) {
      array_push($header, "Mã danh hiệu");
    }
    array_push($header, "Họ tên cán bộ");
    if (isset($_GET["chien_si_thi_dua"])) {
      array_push($header, "Chiến sĩ thi đua");
    }
    if (isset($_GET["ngay_trao"])) {
      array_push($header, "Ngày trao");
    }
    if (isset($_GET["so_quyet_dinh"])) {
      array_push($header, "Số quyết định");
    }
    fputcsv($output, $header);
    $danh_hieu_thi_dua = select_danh_hieu_can_bo($_GET["ma_cb"]);
    while ($row = mysqli_fetch_array($danh_hieu_thi_dua)) {
      $temp = array();
      for ($i = 0; $i < count($header); $i++) {
        if ($header[$i] != "") {
          $temp[] = $row[$i];
        }
      }
      fputcsv($output, $temp);
    }
  }
} else if ($_GET["doi_tuong"] == "khen_thuong") {
  header('Content-Disposition: attachment; filename=khenthuong_canbo_' . $_GET["ma_cb"] . '_' . date("dmYGi") . '.csv');
  if (isset($_GET["ma_cb"])) {
    $header = array();
    if (isset($_GET["ma_khen_thuong"])) {
      array_push($header, "Mã khen thưởng");
    }
    array_push($header, "Họ tên cán bộ");
    if (isset($_GET["cap_quyet_dinh"])) {
      array_push($header, "Cấp quyết định");
    }
    if (isset($_GET["hinh_thuc"])) {
      array_push($header, "Hình thức khen thưởng");
    }
    if (isset($_GET["so_quyet_dinh"])) {
      array_push($header, "Số quyết định");
    }
    if (isset($_GET["ngay_trao"])) {
      array_push($header, "Ngày ra quyết định");
    }
    fputcsv($output, $header);
    $khen_thuong = select_khen_thuong_can_bo($_GET["ma_cb"]);
    while ($row = mysqli_fetch_array($khen_thuong)) {
      $temp = array();
      for ($i = 0; $i < count($header); $i++) {
        if ($header[$i] != "") {
          $temp[] = $row[$i];
        }
      }
      fputcsv($output, $temp);
    }
  }
}