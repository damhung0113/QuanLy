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
      <div>
        <div class="d-flex justify-content-between align-items-center mr-4">
          <div class="title_chart">
            BIỂU ĐỒ DANH HIỆU THI ĐUA
            <span class="arrow_chart"></span>
          </div>
        </div>
        <canvas id="bieu_do_danh_hieu" class="mt-20" width="800" height="200"></canvas>
      </div>
    </div>
  </div>
</div>
<?php
include_once("../../footer.php");
?>
</body>
<script>
  let ctx_2 = document.getElementById('bieu_do_danh_hieu').getContext('2d');
  let query = location.href.split("?")[1]
  $.post("data_danhhieu_truong.php?" + query, function (data) {
    let labels = [];
    let result = [];
    for (let i in data) {
      labels.push(data[i][1]);
      result.push(data[i][0]);
    }
    new Chart(ctx_2, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: ' số lượng giải thưởng',
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
              callback: function(value) {if (value % 2 === 0) {return value;}}
            }
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
          text: "SỐ LƯỢNG GIẢI THƯỞNG",
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
</script>
</html>

