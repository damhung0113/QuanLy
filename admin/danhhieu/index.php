<?php
include "../../connect.php";
include "../../alert.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Khởi tạo biến
$ds_danh_hieu = get_ds_danh_hieu();
$danh_hieu = '<option value="" disabled selected>Chọn một danh hiệu</option>';
$ten_cb = isset($_GET["ten_cb"]) ? $_GET["ten_cb"] : '';

while ($row = mysqli_fetch_row($ds_danh_hieu)) {
  if (isset($_GET["danh_hieu"]) && $row[0] == intval($_GET["danh_hieu"])) {
    $danh_hieu .= '<option value = "' . $row[0] . '" selected>' . $row[1] . '</option>';
  } else {
    $danh_hieu .= '<option value = "' . $row[0] . '">' . $row[1] . '</option>';
  }
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
$result_count = count_data(); // tổng số bản ghi
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

if (isset($_GET["ma_qd"])) {
  is_null($_GET["ho_ten"]) ? null : $_GET["ho_ten"];
  is_null($_GET["ma_qd"]) ? null : $_GET["ma_qd"];
  is_null($_GET["danh_hieu"]) ? null : $_GET["danh_hieu"];
  is_null($_GET["ngay_quyet_dinh_start"]) ? null : $_GET["ngay_quyet_dinh_start"];
  is_null($_GET["ngay_quyet_dinh_end"]) ? null : $_GET["ngay_quyet_dinh_end"];
  is_null($_GET["so_qd"]) ? null : $_GET["so_qd"];
  $titles = filter($_GET["ma_qd"], $_GET["ho_ten"], $_GET["danh_hieu"], $_GET["ngay_quyet_dinh_start"], $_GET["ngay_quyet_dinh_end"],
      $_GET["so_qd"], $offset, $total_records_per_page); // Tìm kiếm và phân trang
} else {
  $titles = select($offset, $total_records_per_page); // select và phân trang
}
$content = '';
while ($row = mysqli_fetch_row($titles)) {
  try {
    $dt = new DateTime($row[3]);
  } catch (Exception $e) {
  }
  $ten_can_bo = (isset(mysqli_fetch_object(get_ten_can_bo($row[1]))->Ho_ten) ? mysqli_fetch_object(get_ten_can_bo($row[1]))->Ho_ten : "");
  $chien_si_thi_dua = (isset(mysqli_fetch_object(get_ten_chien_si_thi_dua($row[2]))->Ten_danh_hieu) ? mysqli_fetch_object(get_ten_chien_si_thi_dua($row[2]))->Ten_danh_hieu : "");
  $content .= '<tr><td style="width: 50px">' . $row[0] .
      '</td><td>' . $ten_can_bo .
      '</td><td>' . $chien_si_thi_dua .
      '</td><td>' . $dt->format('m-d-Y') .
      '</td><td>' . $row[4] .
      '</td><td>' . '<a class="btn btn-success mr-3" type="button" href="edit.php?ma_danh_hieu=' . $row[0] . '&ma_cb=' . $row[1] . '&chien_si_thi_dua=' . $row[2] . '&ngay=' . $dt->format('Y-m-d') . '&so_qd=' . $row[4] . '"' . '>Sửa</a>' . '<a class="btn btn-danger" type="button" href="destroy.php?Ma_danh_hieu=' . $row[0] . '"' . '>Xóa</a>' .
      '</td></tr>';
}
?>

<html lang="vi">
<head>
  <title>Quản Lý Danh Hiệu Thi Đua</title>
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
          <span class="text-uppercase">QUẢN LÝ DANH HIỆU THI ĐUA</span>
          <span class="arrow_chart"></span>
        </div>
        <div class="card">
          <div class="card-header">
            <a href="create.php" class="btn btn-outline-primary float-right" role="button"
               style="border-color: #007bff;">Tạo mới danh hiệu thi đua</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
              <tr style="color:White;background-color:#006699;font-weight:bold;">
                <th scope="col" style="width: 50px;">Mã danh hiệu</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Chiến sĩ thi đua</th>
                <th scope="col" style="width: 100px;">Ngày trao</th>
                <th scope="col">Số quyết định</th>
                <th style="width: 10%;"></th>
              </tr>
              </thead>
              <tbody>
              <form>
                <td><input type="text" name="ma_qd" class="form-control" placeholder="Mã QĐ..." aria-label=""
                           style="width: 50px" value="<?php echo isset($_GET["ma_qd"]) ? $_GET["ma_qd"] : null; ?>">
                </td>
                <td><input type="text" name="ho_ten" class="form-control" placeholder="Họ và tên..." aria-label=""
                           value="<?php echo isset($_GET["ho_ten"]) ? $_GET["ho_ten"] : null; ?>"></td>
                <td>
                  <?php
                  $ds_danh_hieu_filter = get_ds_danh_hieu();
                  echo '<select name="danh_hieu" class="form-control">';
                  echo '<option value="">Chọn một danh hiệu...</option>';
                  while ($row = mysqli_fetch_row($ds_danh_hieu_filter)) {
                    if ($row[0] == $_GET["danh_hieu"]) {
                      echo '<option value="' . $row[0] . '" selected>' . $row[1] . '</option>';
                    } else {
                      echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                  }
                  echo '</select>';
                  ?></td>
                <td style="width: 100px;">
                  <input placeholder="Ngày BĐ" name="ngay_quyet_dinh_start" class="form-control" aria-label=""
                         style="height: 20px; font-size: 10px" type="text" onfocus="(this.type='date')"
                         onblur="(this.type='text')"
                         id="date"
                         value="<?php echo isset($_GET["ngay_quyet_dinh_start"]) ? $_GET["ngay_quyet_dinh_start"] : null; ?>"/>
                  <input placeholder="Ngày KT" name="ngay_quyet_dinh_end" class="form-control mt-1" aria-label=""
                         style="height: 20px; font-size: 10px" type="text" onfocus="(this.type='date')"
                         onblur="(this.type='text')"
                         id="date"
                         value="<?php echo isset($_GET["ngay_quyet_dinh_end"]) ? $_GET["ngay_quyet_dinh_end"] : null; ?>"/>
                </td>
                <td><input type="text" name="so_qd" class="form-control" placeholder="Số quyết định..." aria-label=""
                           value="<?php echo isset($_GET["so_qd"]) ? $_GET["so_qd"] : null; ?>"></td>
                <td class="d-flex">
                  <button type="submit" class="btn btn-info">Search</button>
                  <a href="index.php" class="btn btn-secondary ml-3">Reset</a>
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
