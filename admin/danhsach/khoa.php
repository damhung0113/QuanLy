<?php
include "../../connect.php";
include "../../alert.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Chức năng phân trang
if (isset($_GET['page_no']) && $_GET['page_no'] != "") { // kiểm tra chỉ số trang hiện tại
  $page_no = $_GET['page_no'];
} else {
  $page_no = 1;
}

$total_records_per_page = 25; // tổng số bản ghi trong một trang
$offset = ($page_no - 1) * $total_records_per_page; // offset trong mysql
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = count_data_khoa(); // tổng số bản ghi
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

if(isset($_GET["truong"])) {
  $where = "Ma_truong = " . $_GET["truong"];
  $ds_khoa = get_ds_khoa_filter_where($offset, $total_records_per_page, $where);
} else {
  $ds_khoa = get_ds_khoa($offset, $total_records_per_page);
}
$content = '';
while ($row = mysqli_fetch_row($ds_khoa)) {
  $content .= '<tr><td>' . $row[0] .
      '</td><td>' . $row[1] .
      '</td><td>' . mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong .
      '</td><td class="text-center">' . '<a class="btn btn-success mr-3" type="button" href="#"' . '>Sửa</a>' . '<a class="btn btn-danger" type="button" href="#"' . '>Xóa</a>' .
      '</td></tr>';
}
?>

<html lang="vi">
<head>
  <title>Quản Lý Khoa</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <link rel="stylesheet" href="/QuanLy/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="">
  <?php include_once("../../header.php"); ?>
  <div class="main row">
    <?php include_once("../nav_bar.php"); ?>
    <div class="col-md-10 row container-cus pl-5">
      <div class="col-md-12">
        <div class="title_chart" style="width: 25%">
          <span class="text-uppercase">Danh sách khoa</span>
          <span class="arrow_chart"></span>
        </div>
        <div class="card">
          <div class="card-header">
            <a href="create_khoa.php" class="btn btn-outline-primary float-right" role="button"
               style="border-color: #007bff;">Tạo mới khoa</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
              <tr style="color:White;background-color:#006699;font-weight:bold;">
                <th scope="col">Mã khoa</th>
                <th scope="col">Tên khoa</th>
                <th scope="col">Tên trường</th>
                <th style="width: 80px;"></th>
              </tr>
              </thead>
              <tbody>
              <form>
                <td></td>
                <td></td>
                <td>
                  <?php
                  $ds_truong_filter = get_ds_truong_filter();
                  echo '<select name="truong" class="form-control">';
                  echo '<option value="">Chọn một trường...</option>';
                  while ($row = mysqli_fetch_row($ds_truong_filter)) {
                    if ($row[0] == $_GET["truong"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?>
                </td>
                <td class="text-center" style="width: 80px;">
                  <button type="submit" class="btn btn-info">Search</button>
                  <a href="khoa.php" class="btn btn-secondary ml-3">Reset</a>
                </td>
              </form>
              <?php echo $content; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <ul class="pagination ml-4">
        <?php if ($page_no > 1) {
          echo "<li><a href='?page_no=1'>Trang đầu</a></li>";
        } ?>

        <li <?php if ($page_no <= 1) {
          echo "class='disabled'";
        } ?>>
          <a <?php if ($page_no > 1) {
            echo "href='?page_no=$previous_page'";
          } ?>>Trang trước</a>
        </li>

        <?php
        if ($total_no_of_pages <= 10) {
          for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
            if ($counter == $page_no) {
              echo "<li class='active'><a>$counter</a></li>";
            } else {
              echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }
          }
        } elseif ($total_no_of_pages > 10) {

          if ($page_no <= 4) {
            for ($counter = 1; $counter < 8; $counter++) {
              if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
              } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
              }
            }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
          } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
            echo "<li><a href='?page_no=1'>1</a></li>";
            echo "<li><a href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";
            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
              if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
              } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
              }
            }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
          } else {
            echo "<li><a href='?page_no=1'>1</a></li>";
            echo "<li><a href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";

            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
              if ($counter == $page_no) {
                echo "<li class='active'><a>$counter</a></li>";
              } else {
                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
              }
            }
          }
        }
        ?>

        <li <?php if ($page_no >= $total_no_of_pages) {
          echo "class='disabled'";
        } ?>>
          <a <?php if ($page_no < $total_no_of_pages) {
            echo "href='?page_no=$next_page'";
          } ?>>Trang tiếp</a>
        </li>
        <?php if ($page_no < $total_no_of_pages) {
          echo "<li><a href='?page_no=$total_no_of_pages'>Trang cuối &rsaquo;&rsaquo;</a></li>";
        } ?>
      </ul>
    </div>
  </div>
  <?php
  include_once("../../footer.php");
  ?>
</div>
</body>
</html>
