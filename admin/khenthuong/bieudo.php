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
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <link rel="stylesheet" href="/QuanLy/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="/QuanLy/images/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
          integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"
          integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg=="
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"
          integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg=="
          crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css"
        integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g=="
        crossorigin="anonymous"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"
          integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw=="
          crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"
        integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
        crossorigin="anonymous"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
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
      echo '<div class="d-flex">';
      echo '<select name="sl_truong" id="loai_khen_thuong" class="form-control mt-3 title_chart" style="width: 290px;">';
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
        echo '<select name="sl_truong" id="sl_truong" class="form-control mt-3 title_chart ml-3 text-uppercase" style="width: auto;">';
        echo '<option value="khtn" class="text-uppercase"' . (($_GET["don_vi"] == "khtn") ? 'selected' : '') . '>Đại học Khoa học Tự nhiên</option>';
        echo '<option value="xhnv" class="text-uppercase"' . (($_GET["don_vi"] == "xhnv") ? 'selected' : '') . '>Trường Đại học Khoa học Xã hội và Nhân văn</option>';
        echo '<option value="dhnn" class="text-uppercase"' . (($_GET["don_vi"] == "dhnn") ? 'selected' : '') . '>Trường Đại học Ngoại ngữ</option>';
        echo '<option value="dhcn" class="text-uppercase"' . (($_GET["don_vi"] == "dhcn") ? 'selected' : '') . '>Trường Đại học Công nghệ</option>';
        echo '<option value="dhkt" class="text-uppercase"' . (($_GET["don_vi"] == "dhkt") ? 'selected' : '') . '>Trường Đại học Kinh tế</option>';
        echo '<option value="dhgd" class="text-uppercase"' . (($_GET["don_vi"] == "dhgd") ? 'selected' : '') . '>Trường Đại học Giáo dục</option>';
        echo '<option value="dhvn" class="text-uppercase"' . (($_GET["don_vi"] == "dhvn") ? 'selected' : '') . '>Trường Đại học Việt - Nhật</option>';
        echo '</select>';
      }
      echo '</div>';
      if (isset($_GET["loai"]) && $_GET["loai"] == "ca_nhan") {
        echo '<canvas id="bieu_do_khen_thuong_ca_nhan" class="mt-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "khtn") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_1" class="mt-5 mr-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "xhnv") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_2" class="mt-5 mr-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "dhnn") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_3" class="mt-5 mr-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "dhcn") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_4" class="mt-5 mr-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "dhkt") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_5" class="mt-5 mr-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "dhgd") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_6" class="mt-5 mr-5" width="800" height="300"></canvas>';
      }
      if (isset($_GET["loai"]) && $_GET["loai"] == "tap_the" && $_GET["don_vi"] == "dhvn") {
        echo '<canvas id="bieu_do_danh_hieu_khoa_7" class="mt-5 mr-5" width="800" height="300"></canvas>';
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
  $("#sl_truong").change(function () {
    self.location = 'bieudo.php?loai=tap_the&don_vi=' + this.value
  })

  if (document.getElementById('bieu_do_khen_thuong_ca_nhan') != null) {
    let ctx_3 = document.getElementById('bieu_do_khen_thuong_ca_nhan').getContext('2d');
    $.post("data_khenthuong_truong.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        }
      };

      new Chart(ctx_3, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_1') != null) {
    let ctx_4 = document.getElementById('bieu_do_danh_hieu_khoa_1').getContext('2d');
    $.post("data_khenthuong_khoa_1.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        }
      };

      new Chart(ctx_4, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_2') != null) {
    let ctx_5 = document.getElementById('bieu_do_danh_hieu_khoa_2').getContext('2d');
    $.post("data_khenthuong_khoa_2.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        }
      };

      new Chart(ctx_5, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_3') != null) {
    let ctx_6 = document.getElementById('bieu_do_danh_hieu_khoa_3').getContext('2d');
    $.post("data_khenthuong_khoa_3.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        }
      };

      new Chart(ctx_6, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_4') != null) {
    let ctx_7 = document.getElementById('bieu_do_danh_hieu_khoa_4').getContext('2d');
    $.post("data_khenthuong_khoa_4.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        },
      };

      new Chart(ctx_7, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_5') != null) {
    let ctx_8 = document.getElementById('bieu_do_danh_hieu_khoa_5').getContext('2d');
    $.post("data_khenthuong_khoa_5.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        },
      };

      new Chart(ctx_8, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_6') != null) {
    let ctx_9 = document.getElementById('bieu_do_danh_hieu_khoa_6').getContext('2d');
    $.post("data_khenthuong_khoa_6.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        },
      };

      new Chart(ctx_9, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

  if (document.getElementById('bieu_do_danh_hieu_khoa_7') != null) {
    let ctx_9 = document.getElementById('bieu_do_danh_hieu_khoa_7').getContext('2d');
    $.post("data_khenthuong_khoa_6.php", function (data) {
      let labels = [];
      let result = [];
      for (let i in data) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
      var options = {
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              let sum = 0
              for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
                sum += parseInt(data['datasets'][0]['data'][i])
              }
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + Math.round(data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum) + '%)';
            }
          }
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                sum += parseInt(data);
              });
              return (value * 100 / sum).toFixed(2) + "%";
            },
            color: '#fff',
            font: {
              size: 18
            }
          }
        },
        legend: {
          position: 'right',
          labels: {
            padding: 15,
            fontSize: 18,
          }
        },
      };

      new Chart(ctx_9, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgb(0, 125, 197)',
              'rgb(255, 128, 128)',
              'rgb(255, 153, 51)',
              'rgb(204, 204, 0)',
              'rgb(0, 153, 0)',
              'rgb(102, 51, 0)',
              'rgb(255, 0, 0)',
              'rgb(0, 77, 0)'
            ],
            borderColor: [
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
              'rgb(255, 255, 255)',
            ],
            borderWidth: 2,
            color: '#fff',
          }]
        },
        options: options
      });
    })
  }

</script>
</html>

