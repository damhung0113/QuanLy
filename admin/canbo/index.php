<?php
include "../../connect.php";
include "../../alert.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}
// Khởi tạo biến
$ds_truong = get_ds_truong();
$ds_khoa = get_ds_khoa();
$ds_bo_mon = get_ds_bo_mon();
$truong = '<option value="" disabled selected>Chọn một trường</option>';
$khoa = '';
$bo_mon = '';
$ten_cb = isset($_GET["ten_cb"]) ? $_GET["ten_cb"] : '';

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
$result_count = count_data(); // tổng số bản ghi
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
if (isset($_GET["hoten"])) {
  is_null($_GET["macb"]) ? null : $_GET["macb"];
  is_null($_GET["hoten"]) ? null : $_GET["hoten"];
  is_null($_GET["truong"]) ? null : $_GET["truong"];
  is_null($_GET["khoa"]) ? null : $_GET["khoa"];
  is_null($_GET["bo_mon"]) ? null : $_GET["bo_mon"];
  $staffs = filter($_GET["macb"], $_GET["hoten"], $_GET["truong"], $_GET["khoa"], $_GET["bo_mon"], $offset, $total_records_per_page); // Tìm kiếm và phân trang
} else {
  $staffs = select($offset, $total_records_per_page); // select và phân trang
}
$content = '';
while ($row = mysqli_fetch_row($staffs)) {
  $ten_truong = (isset(mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong) ? mysqli_fetch_object(get_ten_truong($row[2]))->Ten_truong : "");
  $ten_khoa = (isset(mysqli_fetch_object(get_ten_khoa($row[3]))->Ten_khoa) ? mysqli_fetch_object(get_ten_khoa($row[3]))->Ten_khoa : "");
  $ten_bo_mon = (isset(mysqli_fetch_object(get_ten_bo_mon($row[4]))->Ten_bo_mon) ? mysqli_fetch_object(get_ten_bo_mon($row[4]))->Ten_bo_mon : "");
  $content .= '<tr><td>' . $row[0] .
      '</td><td>' . $row[1] .
      '</td><td>' . $ten_truong .
      '</td><td>' . $ten_khoa .
      '</td><td>' . $ten_bo_mon .
      '</td><td class="text-center">' . '<a class="btn btn-success mr-3" type="button" href="edit.php?Ma_CB=' . $row[0] . '&truong=' . $row[2] . '&khoa=' . $row[3] . '&bo_mon=' . $row[4] . '"' . '>Sửa</a>' . '<a class="btn btn-danger" type="button" href="destroy.php?Ma_CB=' . $row[0] . '"' . '>Xóa</a>' .
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include_once("../../header.php"); ?>
<div class="main row">
  <?php include_once("../nav_bar.php"); ?>
  <div class="col-lg-10 row container-cus pl-5">
    <div class="col-md-12">
      <div class="card">
        <div class="title_chart" style="width: 25%">
          <span class="text-uppercase">Quản Lý Cán Bộ</span>
          <span class="arrow_chart"></span>
        </div>
        <div class="card-header">
          <a href="create.php" class="btn btn-outline-primary float-right" role="button"
             style="border-color: #007bff;">Tạo hồ sơ cán bộ</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
            <tr style="color:White;background-color:#006699;font-weight:bold;">
              <th scope="col" style="width: 100px;">Mã cán bộ</th>
              <th scope="col">Họ và tên</th>
              <th scope="col">Trường</th>
              <th scope="col">Khoa</th>
              <th scope="col">Bộ môn</th>
              <th style="width: 10%;"></th>
            </tr>
            </thead>
            <tbody>
            <form>
              <tr>
                <td><input type="text" name="macb" class="form-control" placeholder="Mã cán bộ..."
                           style="width: 100px;" value="<?php echo isset($_GET["macb"]) ? $_GET["macb"] : null; ?>">
                </td>
                <td><input type="text" name="hoten" class="form-control" placeholder="Họ và tên..."
                           value="<?php echo isset($_GET["hoten"]) ? $_GET["hoten"] : null; ?>"></td>
                <td>
                  <?php
                  $ds_truong_filter = get_ds_truong();
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
                <td>
                  <?php
                  $ds_khoa_filter = get_ds_khoa();
                  echo '<select name="khoa" class="form-control">';
                  echo '<option value="">Chọn một khoa...</option>';
                  while ($row = mysqli_fetch_row($ds_khoa_filter)) {
                    if ($row[0] == $_GET["khoa"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?>
                </td>
                <td>
                  <?php
                  $ds_bo_mon_filter = get_ds_bo_mon();
                  echo '<select name="bo_mon" class="form-control">';
                  echo '<option value="">Chọn một bộ môn...</option>';
                  while ($row = mysqli_fetch_row($ds_bo_mon_filter)) {
                    if ($row[0] == $_GET["bo_mon"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?>
                </td>
                <td class="d-flex">
                  <button type="submit" class="btn btn-info">Search</button>
                  <a href="index.php" class="btn btn-secondary ml-3">Reset</a></td>
              </tr>
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
</div>
<?php
include_once("../../footer.php");
?>
</body>
</html>

