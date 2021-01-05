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
          BIỂU ĐỒ DANH HIỆU THI ĐUA
          <span class="arrow_chart"></span>
        </div>
      </div>
      <form action="" class="mt-5">
        <div class="d-flex">
          <input placeholder="Ngày trao BĐ" name="ngay_quyet_dinh_start" class="form-control title_chart" aria-label=""
                 style="width: 150px" type="text" onfocus="(this.type='date')"
                 onblur="(this.type='text')"
                 id="date"
                 value="<?php echo isset($_GET["ngay_quyet_dinh_start"]) ? $_GET["ngay_quyet_dinh_start"] : null; ?>"/>
          <span class="mr-4 ml-4 mt-2">~</span>
          <input placeholder="Ngày trao KT" name="ngay_quyet_dinh_end" class="form-control title_chart mr-4"
                 aria-label=""
                 style="width: 150px" type="text" onfocus="(this.type='date')"
                 onblur="(this.type='text')"
                 id="date"
                 value="<?php echo isset($_GET["ngay_quyet_dinh_end"]) ? $_GET["ngay_quyet_dinh_end"] : null; ?>"/>
          <?php
          $danh_hieu_filter = get_ds_danh_hieu();
          echo '<select name="danh_hieu" class="form-control title_chart mr-4" style="width: 250px;">';
          echo '<option value="" disabled selected>Chọn một danh hiệu</option>';
          while ($row = mysqli_fetch_row($danh_hieu_filter)) {
            if ($row[0] == $_GET["danh_hieu"]) {
              echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
            } else {
              echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
            }
          }
          echo '</select>';
          ?>
          <button type="submit" class="btn btn-success">Xuất biểu đồ</button>
          <a href="bieudo.php" class="btn btn-danger ml-3">Xóa bộ lọc</a>
        </div>
      </form>
      <canvas id="bieu_do_danh_hieu" class="mt-20" width="800" height="200"></canvas>
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
      if (data.hasOwnProperty(i)) {
        labels.push(data[i][1]);
        result.push(data[i][0]);
      }
    }
    new Chart(ctx_2, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: ' số lượng danh hiệu',
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
          text: "SỐ LƯỢNG DANH HIỆU THI ĐUA",
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

