<?php
include "../../connect.php";
include "../../alert.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}
?>
<html lang="vi">
<head>
  <title>Biểu Đồ</title>
  <?php include "../head.php" ?>
</head>
<body>
<?php include_once("../../header.php"); ?>
<div class="main row">
  <?php
  include_once("../nav_bar.php");
  ?>
  <div class="col-lg-10 row container-cus pl-5">
    <div class="col-md-12">
      <div class="d-flex justify-content-between align-items-center">
        <div class="title_chart">
          <span class="text-uppercase">biểu đồ khen thưởng</span>
          <span class="arrow_chart"></span>
        </div>
      </div>
      <?php
      echo '<form action="">';
      echo '<div class="d-flex mt-3">';
      echo '<select name="loai" id="loai_khen_thuong" class="form-control title_chart" style="width: 290px;">';
      if (isset($_GET["loai"]) && $_GET["loai"] == "ca_nhan") {
        echo '<option value="ca_nhan" selected>BIỂU ĐỒ KHEN THƯỞNG CÁ NHÂN</option>';
        echo '<option value="tap_the">BIỂU ĐỒ KHEN THƯỞNG TẬP THỂ</option>';
      } else if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the") {
        echo '<option value="ca_nhan">BIỂU ĐỒ KHEN THƯỞNG CÁ NHÂN</option>';
        echo '<option value="tap_the" selected>BIỂU ĐỒ KHEN THƯỞNG TẬP THỂ</option>';
      } else {
        echo '<option value="ca_nhan">BIỂU ĐỒ KHEN THƯỞNG CÁ NHÂN</option>';
        echo '<option value="tap_the">BIỂU ĐỒ KHEN THƯỞNG TẬP THỂ</option>';
      }
      echo '</select>';
      if (isset($_GET["loai"]) && $_GET["loai"] != "ca_nhan") {
        echo '<select name="don_vi" id="sl_truong" class="form-control title_chart ml-3 text-uppercase" style="width: 300px;">';
        echo '<option value="khtn" class="text-uppercase" ' . (($_GET["don_vi"] == "khtn") ? 'selected' : '') . '>Đại học Khoa học Tự nhiên</option>';
        echo '<option value="xhnv" class="text-uppercase" ' . (($_GET["don_vi"] == "xhnv") ? 'selected' : '') . '>Trường Đại học Khoa học Xã hội và Nhân văn</option>';
        echo '<option value="dhnn" class="text-uppercase" ' . (($_GET["don_vi"] == "dhnn") ? 'selected' : '') . '>Trường Đại học Ngoại ngữ</option>';
        echo '<option value="dhcn" class="text-uppercase" ' . (($_GET["don_vi"] == "dhcn") ? 'selected' : '') . '>Trường Đại học Công nghệ</option>';
        echo '<option value="dhkt" class="text-uppercase" ' . (($_GET["don_vi"] == "dhkt") ? 'selected' : '') . '>Trường Đại học Kinh tế</option>';
        echo '<option value="dhgd" class="text-uppercase" ' . (($_GET["don_vi"] == "dhgd") ? 'selected' : '') . '>Trường Đại học Giáo dục</option>';
        echo '<option value="dhvn" class="text-uppercase" ' . (($_GET["don_vi"] == "dhvn") ? 'selected' : '') . '>Trường Đại học Việt - Nhật</option>';
        echo '</select>';
      }
      $hinh_thuc_filter = get_ds_hinh_thuc();
      echo '<select name="hinh_thuc" class="form-control ml-3 title_chart" style="width: 200px;">';
      echo '<option value="" disabled selected>Chọn hình thức...</option>';
      while ($row = mysqli_fetch_row($hinh_thuc_filter)) {
        if ($row[0] == $_GET["hinh_thuc"]) {
          echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
        } else {
          echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }
      }
      ?>
      <input placeholder="Ngày QĐ BĐ" name="ngay_quyet_dinh_start" class="form-control ml-3 title_chart" aria-label=""
             style="width: 150px" type="text" onfocus="(this.type='date')"
             onblur="(this.type='text')"
             id="date"
             value="<?php echo isset($_GET["ngay_quyet_dinh_start"]) ? $_GET["ngay_quyet_dinh_start"] : null; ?>"/>
      <span class="mr-4 ml-4 mt-2">~</span>
      <input placeholder="Ngày QĐ KT" name="ngay_quyet_dinh_end" class="form-control title_chart" aria-label=""
             style="width: 150px" type="text" onfocus="(this.type='date')"
             onblur="(this.type='text')"
             id="date"
             value="<?php echo isset($_GET["ngay_quyet_dinh_end"]) ? $_GET["ngay_quyet_dinh_end"] : null; ?>"/>
      <?php
      echo '</select>';
      echo '<button type="submit" class="btn btn-success ml-3">Xuất biểu đồ</button>';
      if($_GET["loai"] == "ca_nhan") {
        echo '<a href="bieudo.php?loai=ca_nhan" class="btn btn-danger ml-3">Xóa bộ lọc</a>';
      } else {
        echo '<a href="bieudo.php?loai=tap_the&don_vi=khtn" class="btn btn-danger ml-3">Xóa bộ lọc</a>';
      }
      echo '</div>';
      echo '</form>';
      if (isset($_GET["loai"]) && $_GET["loai"] == "ca_nhan") {
        echo '<canvas id="bieu_do_khen_thuong_ca_nhan" class="mt-20" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the") {
        echo '<canvas id="bieu_do_danh_hieu_khoa" class="mt-20" width="800" height="300"></canvas>';
      }
      ?>
    </div>
  </div>
</div>
<?php
include_once("../../footer.php");
?>
</body>
<script>
  $("#loai_khen_thuong").change(function () {
    self.location = 'bieudo.php?loai=' + this.value + '&don_vi=khtn'
  })

  if (document.getElementById('bieu_do_khen_thuong_ca_nhan') != null) {
    let ctx_3 = document.getElementById('bieu_do_khen_thuong_ca_nhan').getContext('2d')
    let query = location.href.split("?")[1]
    $.post("data_khenthuong_truong.php? " + query, function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        if (data.hasOwnProperty(i)) {
          labels.push(data[i][1]);
          result.push(data[i][0]);
        }
      }

      new Chart(ctx_3, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: ' số lượng khen thưởng',
            data: result,
            backgroundColor: 'rgb(0, 125, 197)',
            borderColor: 'rgb(255, 255, 255)',
            borderWidth: 2
          }]
        },
        options: {
          scales: {
            yAxes: [{
              display: true,
              ticks: {
                min: 0,
                callback: function (value) {
                  if (value % 1 === 0) {
                    return value;
                  }
                }
              },
              gridLines: {
                color: 'rgb(217, 217, 217)',
                lineWidth: 2,
                zeroLineColor: "#000",
                zeroLineWidth: 2
              },
              stacked: true
            }],
            xAxes: [{
              display: true,
              ticks: {
                fontSize: 12,
                fontColor: 'black',
              }
            }],
          },
          title: {
            display: true,
            text: "SỐ LƯỢNG KHEN THƯỞNG",
            position: "bottom",
            fontSize: 20,
          },
          legend: {
            labels: {
              fontColor: 'black',
              fontSize: 15
            }
          }
        }
      })
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa') != null) {
    let ctx_4 = document.getElementById('bieu_do_danh_hieu_khoa').getContext('2d');
    let query = location.href.split("?")[1]
    $.post("data_khenthuong_khoa.php? " + query, function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        if (data.hasOwnProperty(i)) {
          labels.push(data[i][1]);
          result.push(data[i][0]);
        }
      }

      new Chart(ctx_4, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: ' số lượng khen thưởng',
            data: result,
            backgroundColor: 'rgb(0, 125, 197)',
            borderColor: 'rgb(255, 255, 255)',
            borderWidth: 2
          }]
        },
        options: {
          scales: {
            yAxes: [{
              display: true,
              ticks: {
                min: 0,
                callback: function (value) {
                  if (value % 1 === 0) {
                    return value;
                  }
                }
              },
              gridLines: {
                color: 'rgb(217, 217, 217)',
                lineWidth: 2,
                zeroLineColor: "#000",
                zeroLineWidth: 2
              },
              stacked: true
            }],
            xAxes: [{
              display: true,
              ticks: {
                fontSize: 12,
                fontColor: 'black',
              }
            }],
          },
          title: {
            display: true,
            text: "SỐ LƯỢNG KHEN THƯỞNG",
            position: "bottom",
            fontSize: 20,
          },
          legend: {
            labels: {
              fontColor: 'black',
              fontSize: 15
            }
          }
        }
      })
    })
  }
</script>
</html>

