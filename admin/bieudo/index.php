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
          SỐ LƯỢNG CÁN BỘ
          <span class="arrow_chart"></span>
        </div>
      </div>
      <canvas id="bieu_do_sl_can_bo" width="700" height="200"></canvas>
      <div class="d-flex justify-content-between">
        <div>
          <div class="d-flex justify-content-between align-items-center">
            <div class="title_chart">
              GIẢI THƯỞNG
              <span class="arrow_chart"></span>
            </div>
          </div>
          <canvas id="bieu_do_giai_thuong" width="800" height="400"></canvas>
        </div>
        <div>
          <div class="d-flex justify-content-between align-items-center mr-4">
            <div class="title_chart">
              DANH HIỆU THI ĐUA
              <span class="arrow_chart"></span>
            </div>
          </div>
          <canvas id="bieu_do_danh_hieu" width="800" height="400"></canvas>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="title_chart">
          <span class="text-uppercase">Khen thưởng cá nhân</span>
          <span class="arrow_chart"></span>
        </div>
      </div>
      <canvas id="bieu_do_khen_thuong_ca_nhan" width="800" height="300"></canvas>
      <div class="d-flex justify-content-between align-items-center">
        <div class="title_chart">
          <span class="text-uppercase">Khen thưởng tập thể</span>
          <span class="arrow_chart"></span>
        </div>
      </div>
      <div>
        <select name="sl_truong" id="sl_truong" class="form-control mt-3" style="width: 252px;">
          <option value="truong_1">Đại học Khoa học Tự nhiên</option>
          <option value="truong_2">Trường Đại học Khoa học Xã hội và Nhân văn</option>
          <option value="truong_3">Trường Đại học Ngoại ngữ</option>
          <option value="truong_4">Trường Đại học Công nghệ</option>
          <option value="truong_5">Trường Đại học Kinh tế</option>
          <option value="truong_6">Trường Đại học Giáo dục</option>
          <option value="truong_7">Trường Đại học Việt - Nhật</option>
        </select>
      </div>
      <div id="truong_1">
        <canvas id="bieu_do_danh_hieu_khoa_1" width="800" height="300"></canvas>
      </div>
      <div id="truong_2">
        <canvas id="bieu_do_danh_hieu_khoa_2" width="800" height="300"></canvas>
      </div>
      <div id="truong_3">
        <canvas id="bieu_do_danh_hieu_khoa_3" width="800" height="300"></canvas>
      </div>
      <div id="truong_4">
        <canvas id="bieu_do_danh_hieu_khoa_4" width="800" height="300"></canvas>
      </div>
      <div id="truong_5">
        <canvas id="bieu_do_danh_hieu_khoa_5" width="800" height="300"></canvas>
      </div>
      <div id="truong_6">
        <canvas id="bieu_do_danh_hieu_khoa_6" width="800" height="300"></canvas>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php
include_once("../../footer.php");
?>
</body>
<script>
  let ctx = document.getElementById('bieu_do_sl_can_bo').getContext('2d');
  $.post("data_canbo_truong.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: ' số cán bộ',
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        title: {
          display: true,
          text: "SỐ LƯỢNG CÁN BỘ",
          position: "bottom",
        }
      }
    });
  })

  let ctx_1 = document.getElementById('bieu_do_giai_thuong').getContext('2d');
  $.post("data_giaithuong_truong.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "GIẢI THƯỞNG",
        position: "bottom",
      },
      tooltips: {
        callbacks: {
          label: function (tooltipItem, data) {
            let sum = 0
            for (let i = 0; i < data['datasets'][0]['data'].length; i++) {
              sum += parseInt(data['datasets'][0]['data'][i])
            }
            return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + ' (' + data['datasets'][0]['data'][tooltipItem['index']] * 100 / sum + '%)';
          }
        }
      }
    };

    new Chart(ctx_1, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_2 = document.getElementById('bieu_do_danh_hieu').getContext('2d');
  $.post("data_danhhieu_truong.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "DANH HIỆU THI ĐUA",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_2, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_3 = document.getElementById('bieu_do_khen_thuong_ca_nhan').getContext('2d');
  $.post("data_khenthuong_truong.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "KHEN THƯỞNG CÁ NHÂN",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_3, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_4 = document.getElementById('bieu_do_danh_hieu_khoa_1').getContext('2d');
  $.post("data_khenthuong_khoa_1.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "KHOA HỌC TỰ NHIÊN",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_4, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_5 = document.getElementById('bieu_do_danh_hieu_khoa_2').getContext('2d');
  $.post("data_khenthuong_khoa_2.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "KHOA HỌC XÃ HỘI VÀ NHÂN VĂN",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_5, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_6 = document.getElementById('bieu_do_danh_hieu_khoa_3').getContext('2d');
  $.post("data_khenthuong_khoa_3.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "NGOẠI NGỮ",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_6, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_7 = document.getElementById('bieu_do_danh_hieu_khoa_4').getContext('2d');
  $.post("data_khenthuong_khoa_4.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "CÔNG NGHỆ",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_7, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_8 = document.getElementById('bieu_do_danh_hieu_khoa_5').getContext('2d');
  $.post("data_khenthuong_khoa_5.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "KINH TẾ",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_8, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  let ctx_9 = document.getElementById('bieu_do_danh_hieu_khoa_6').getContext('2d');
  $.post("data_khenthuong_khoa_6.php", function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    var options = {
      title: {
        display: true,
        text: "GIÁO DỤC",
        position: "bottom",
      },
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
      }
    };

    new Chart(ctx_9, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: result,
          backgroundColor: [
            'rgb(0, 102, 255)',
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

  $('#truong_2').hide()
  $('#truong_3').hide()
  $('#truong_4').hide()
  $('#truong_5').hide()
  $('#truong_6').hide()
  $('#sl_truong').change(function () {
    $('#truong_1').hide()
    $('#truong_2').hide()
    $('#truong_3').hide()
    $('#truong_4').hide()
    $('#truong_5').hide()
    $('#truong_6').hide()
    $('#' + this.value).show()
  })
</script>
</html>

