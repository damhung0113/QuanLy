<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
include "./query.php";
global $connect;
global $data;
if (isset($_SESSION["loged_user"])) {
  header("Location: /opt/lampp/htdocs/QuanLy/index.php");
}

// Chức năng phân trang
if (isset($_GET['page_no']) && $_GET['page_no'] != "") { // kiểm tra chỉ số trang hiện tại
  $page_no = $_GET['page_no'];
} else {
  $page_no = 1;
}

$total_records_per_page = 10; // tổng số bản ghi trong một trang
$offset = ($page_no - 1) * $total_records_per_page; // offset trong mysql
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = count_data(); // tổng số bản ghi
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

$staffs = select($offset, $total_records_per_page); // select và phân trang
$content = '';
while ($row = mysqli_fetch_row($staffs)) {
  $content .= '<tr><td>' . $row[0] .
      '</td><td>' . $row[1] .
      '</td><td>' . (isset(mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong) ? mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong : "") .
      '</td><td>' . (isset(mysqli_fetch_object(get_ten_khoa($row[3]))->Ten_khoa) ? mysqli_fetch_object(get_ten_khoa($row[3]))->Ten_khoa : "") .
      '</td><td>' . (isset(mysqli_fetch_object(get_ten_bo_mon($row[4]))->Ten_bo_mon) ? mysqli_fetch_object(get_ten_bo_mon($row[4]))->Ten_bo_mon : "") .
      '</td><td>' . '<a class="btn btn-success mr-3" type="button" href="edit.php?Ma_CB=' . $row[0] . '"' . '>Sửa</a>' . '<a class="btn btn-danger" type="button" href="destroy.php?Ma_CB=' . $row[0] . '"' . '>Xóa</a>' .
      '</td></tr>';
}
?>

<html lang="vi">
<head>
  <title>Quản Lý Cán Bộ</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <link rel="stylesheet" href="/QuanLy/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="/QuanLy/images/favicon.ico" type="image/x-icon"/>
</head>
<body>
<div class="container-cus">
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/header.php");
  ?>
  <div class="main py-4">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h2>Quản Lý Cán Bộ</h2>
      </div>
      <div class="filter-form mt-3 mb-3 col-md-12">
        <form action="" method="get">
          <div class="row">
            <div class="col-12 col-md-4">
              <input type="text" class="form-control" placeholder="Họ và tên cán bộ" aria-label="">
            </div>
            <div class="col-12 col-md-4">
              <button class="btn btn-primary" type="submit" name="search">Tìm</button>
            </div>
          </div>
          <!--          <div class="row mt-3">-->
          <!--            <div class="col-12 col-md-2">-->
          <!--              <select name="truong" id="truong"></select>-->
          <!--            </div>-->
          <!--            <div class="col-12 col-md-2">-->
          <!--              <select name="khoa" id="khoa"></select>-->
          <!--            </div>-->
          <!--            <div class="col-12 col-md-2">-->
          <!--              <select name="bomon" id="bomon"></select>-->
          <!--            </div>-->
          <!--          </div>-->
        </form>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="create.php" class="btn btn-outline-primary float-right" role="button">Tạo hồ sơ cán bộ</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
              <tr style="color:White;background-color:#006699;font-weight:bold;">
                <th scope="col">Mã cán bộ</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Trường</th>
                <th scope="col">Khoa</th>
                <th scope="col">Bộ môn</th>
                <th style="width: 10%;"></th>
              </tr>
              </thead>
              <tbody>
              <?php echo $content; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pagination -->
  <ul class="pagination">
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
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/footer.php");
  ?>
</div>
</body>
</html>

