<?php
include "../../connect.php";
include "../../alert.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// phân trang
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
$result_count = count_data_ca_nhan(); // tổng số bản ghi
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
if (isset($_GET["ten_cb"])) {
  is_null($_GET["ten_cb"]) ? null : $_GET["ten_cb"];
  $list_khen_thuong = search($_GET["ten_cb"], $offset, $total_records_per_page); // Tìm kiếm và phân trang
} else {
  $list_khen_thuong = select_ca_nhan($offset, $total_records_per_page); // select và phân trang
}

$content = '';
while ($row = mysqli_fetch_row($list_khen_thuong)) {
  try {
    $dt = new DateTime($row[7]);
  } catch (Exception $e) {
  }
  $ten_can_bo = (isset(mysqli_fetch_object(get_ten_can_bo($row[1]))->Ho_ten) ? mysqli_fetch_object(get_ten_can_bo($row[1]))->Ho_ten : "");
  $ten_cap_quyet_dinh = (isset(mysqli_fetch_object(get_ten_cap_quyet_dinh($row[4]))->Ten_cap) ? mysqli_fetch_object(get_ten_cap_quyet_dinh($row[4]))->Ten_cap : "");
  $ten_hinh_thuc_khen_thuong = (isset(mysqli_fetch_object(get_ten_hinh_thuc_khen_thuong($row[5]))->Ten_hinh_thuc) ? mysqli_fetch_object(get_ten_hinh_thuc_khen_thuong($row[5]))->Ten_hinh_thuc : "");
  $content .= '<tr><td style="width: 50px">' . $row[0] .
      '</td><td>' . $ten_can_bo .
      '</td><td>' . $ten_cap_quyet_dinh .
      '</td><td>' . $ten_hinh_thuc_khen_thuong .
      '</td><td>' . $row[6] .
      '</td><td>' . $dt->format('m-d-Y') .
      '</td><td>' . $row[8] .
      '<td>' . '<a class="btn btn-success mr-3" type="button">Sửa</a> <a class="btn btn-danger mr-3" type="button">Xóa</a>' . '</td>' .
      '</td></tr>';
}

?>

<html lang="vi">
<head>
  <title>Quản Lý Khen Thưởng</title>
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
<?php
include_once("../../header.php");
?>
<div class="main row">
  <?php
  include_once("../nav_bar.php");
  ?>
  <div class="col-lg-10 row container-cus pl-5">
    <div class="col-md-12">
      <div class="card">
        <div class="title_chart" style="width: 25%">
          <span class="text-uppercase">QUẢN LÝ KHEN THƯỞNG CÁ NHÂN</span>
          <span class="arrow_chart"></span>
        </div>
        <div class="card-header">
          <a href="./create_ca_nhan.php" class="btn btn-outline-primary float-right" role="button"
             style="border-color: #007bff;">Tạo khen
            thưởng cá nhân</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
            <tr style="color:White;background-color:#006699;font-weight:bold;">
              <th scope="col">Mã KT</th>
              <th scope="col">Họ và tên</th>
              <th scope="col">Cấp quyết định</th>
              <th scope="col">Hình thức khen thưởng</th>
              <th scope="col">Số quyết định</th>
              <th scope="col">Ngày ra quyết định</th>
              <th scope="col">Lý do</th>
              <th style="width: 10%;"></th>
            </tr>
            </thead>
            <tbody>
            <form>
              <tr>
                <td><input type="text" name="ma_khen_thuong" class="form-control" placeholder="Mã KT..."
                           style="width: 100px;"
                           value="<?php echo isset($_GET["ma_khen_thuong"]) ? $_GET["ma_khen_thuong"] : null; ?>">
                </td>
                <td><input type="text" name="ho_ten" class="form-control" placeholder="Nhập họ và tên..."
                           value="<?php echo isset($_GET["ho_ten"]) ? $_GET["ho_ten"] : null; ?>">
                </td>
                <td>
                  <?php
                  $cap_quyet_dinh_filter = get_ds_cap_quyet_dinh();
                  echo '<select name="cap_quyet_dinh" class="form-control">';
                  echo '<option value="">Chọn cấp quyết định...</option>';
                  while ($row = mysqli_fetch_row($cap_quyet_dinh_filter)) {
                    if ($row[0] == $_GET["loai_giai_thuong"]) {
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
                  $hinh_thuc_filter = get_ds_hinh_thuc();
                  echo '<select name="hinh_thuc" class="form-control">';
                  echo '<option value="">Chọn hình thức...</option>';
                  while ($row = mysqli_fetch_row($hinh_thuc_filter)) {
                    if ($row[0] == $_GET["loai_giai_thuong"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?>
                </td>
                <td><input type="text" name="so_quyet_dinh" class="form-control" placeholder="Số quyết định..."
                           value="<?php echo isset($_GET["so_quyet_dinh"]) ? $_GET["so_quyet_dinh"] : null; ?>">
                </td>
                <td>
                  <input placeholder="Ngày BĐ" name="ngay_quyet_dinh_start" class="form-control"
                         style="height: 20px; font-size: 10px" type="text" onfocus="(this.type='date')"
                         onblur="(this.type='text')"
                         id="date"
                         value="<?php echo isset($_GET["ngay_quyet_dinh_start"]) ? $_GET["ngay_quyet_dinh_start"] : null; ?>"/>
                  <input placeholder="Ngày KT" name="ngay_quyet_dinh_end" class="form-control mt-1"
                         style="height: 20px; font-size: 10px" type="text" onfocus="(this.type='date')"
                         onblur="(this.type='text')"
                         id="date"
                         value="<?php echo isset($_GET["ngay_quyet_dinh_end"]) ? $_GET["ngay_quyet_dinh_end"] : null; ?>"/>
                </td>
                <td></td>
                <td class="d-flex">
                  <button type="submit" class="btn btn-info">Search</button>
                  <a href="index_ca_nhan.php" class="btn btn-secondary ml-3">Reset</a></td>
              </tr>
            </form>
            <?php echo $content; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <ul class="pagination pl-4">
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