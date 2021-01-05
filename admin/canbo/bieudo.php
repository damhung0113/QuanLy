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
          BIỂU ĐỒ SỐ LƯỢNG CÁN BỘ
          <span class="arrow_chart"></span>
        </div>
      </div>
      <canvas id="bieu_do_sl_can_bo" class="mt-20" width="800" height="200"></canvas>
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
    let result_nam = [];
    let result_nu = [];
    for (let i in data) {
      if (data.hasOwnProperty(i)) {
        labels.push(data[i][1]);
        result_nam.push(data[i][0]);
        result_nu.push(data[i][2]);
      }
    }
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: ' cán bộ nam',
          data: result_nam,
          backgroundColor: 'rgb(0, 125, 197)',
          borderColor: 'rgb(255, 255, 255)',
          borderWidth: 2
        }, {
          label: ' cán bộ nữ',
          data: result_nu,
          backgroundColor: 'rgb(255, 128, 128)',
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
              max: 10,
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
          text: "SỐ LƯỢNG CÁN BỘ",
          position: "bottom",
          fontSize: 20,
        },
        legend: {
          labels: {
            // This more specific font property overrides the global property
            fontColor: 'black',
            fontSize: 15
          }
        }
      }
    })
  })

</script>
</html>

