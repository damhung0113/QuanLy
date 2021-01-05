<?php
include "../../connect.php";
include "../../alert.php";
include "./query.php";
global $connect;
if (isset($_SESSION["loged_user"])) {
  header("Location: /QuanLy/index.php");
}

// Khởi tạo biến
$ds_giai_thuong = get_loai_giai_thuong();
$giai_thuong = '<option value="" disabled selected>Chọn một giải thưởng</option>';
$ten_cb = isset($_GET["ten_cb"]) ? $_GET["ten_cb"] : '';

// Chức năng phân trang
if (isset($_GET['page_no']) && $_GET['page_no'] != "") { // kiểm tra chỉ số trang hiện tại
  $page_no = $_GET['page_no'];
} else {
  $page_no = 1;
}

$total_records_per_page = 20; // tổng số bản ghi trong một trang
$offset = ($page_no - 1) * $total_records_per_page; // offset trong mysql
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = count_data(); // tổng số bản ghi
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1

if (isset($_GET["ma_giai_thuong"])) {
  $i_giai_thuong = filter($_GET["ma_giai_thuong"], $_GET["ho_ten"], $_GET["ten_giai_thuong"], $_GET["loai_giai_thuong"], $_GET["to_chuc_thuong"], $_GET["to_chuc_trao_giai"],
      $_GET["ngay_quyet_dinh_start"], $_GET["ngay_quyet_dinh_end"], $offset, $total_records_per_page); // Tìm kiếm và phân trang
} else {
  $i_giai_thuong = select($offset, $total_records_per_page); // select và phân trang
}
$content = '';
while ($row = mysqli_fetch_row($i_giai_thuong)) {
  try {
    $dt = new DateTime($row[6]);
  } catch (Exception $e) {
  }
  $ten_can_bo = (isset(mysqli_fetch_object(get_ten_can_bo($row[1]))->Ho_ten) ? mysqli_fetch_object(get_ten_can_bo($row[1]))->Ho_ten : "");
  $ten_giai_thuong = (isset(mysqli_fetch_object(get_ten_giai_thuong($row[3]))->Ten_giai_thuong) ? mysqli_fetch_object(get_ten_giai_thuong($row[3]))->Ten_giai_thuong : "");
  $content .= '<tr><td>' . $row[0] .
      '</td><td>' . $ten_can_bo .
      '</td><td>' . $row[2] .
      '</td><td>' . $ten_giai_thuong .
      '</td><td>' . $row[4] .
      '</td><td>' . $row[5] .
      '</td><td>' . $dt->format('Y-m-d') .
      '</td><td>' . $row[7] .
      '</td><td>' . '<a class="btn btn-success mr-3" type="button" href="edit.php?ma_giai_thuong=' . $row[0] .
      '&ma_cb=' . $row[1] .
      '&ten=' . $row[2] .
      '&loai_giai_thuong=' . $row[3] .
      '&to_chuc_thuong=' . $row[4] .
      '&to_chuc_trao_giai=' . $row[5] .
      '&ngay_qd=' . $dt->format('Y-m-d') .
      '&dien_giai=' . $row[7] .
      '"' . '>Sửa</a>' .
      '<a class="btn btn-danger" type="button" href="destroy.php?ma_giai_thuong=' . $row[0] . '"' . '>Xóa</a>' .
      '</td></tr>';
}
?>

<html lang="vi">
<head>
  <title>Danh sách giải thưởng</title>
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
<?php include_once("../../header.php"); ?>
<div class="main row">
  <?php include_once("../nav_bar.php"); ?>
  <div class="col-lg-10 row container-cus pl-5">
    <div class="col-md-12">
      <div class="card">
        <div class="title_chart" style="width: 25%">
          <span class="text-uppercase">Danh sách giải thưởng</span>
          <span class="arrow_chart"></span>
        </div>
        <div class="card-header">
          <a href="create.php" class="btn btn-outline-primary float-right" role="button"
             style="border-color: #007bff;">Thêm giải thưởng</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
            <tr style="color:White;background-color:#006699;font-weight:bold; font-size: 16px">
              <th scope="col">Mã GT</th>
              <th scope="col" style="width: 15%;">Họ tên CB</th>
              <th scope="col">Tên giải thưởng</th>
              <th scope="col">Loại giải thưởng</th>
              <th scope="col">Tổ chức thưởng</th>
              <th scope="col">Tổ chức trao giải</th>
              <th scope="col" style="width: 150px">Ngày QĐ</th>
              <th scope="col">Diễn giải</th>
              <th style="width: 10%;"></th>
            </tr>
            </thead>
            <tbody>
            <form>
                <td><input type="text" name="ma_giai_thuong" class="form-control" placeholder="Mã GT..." aria-label=""
                           style="width: 100px;"
                           value="<?php echo isset($_GET["ma_giai_thuong"]) ? $_GET["ma_giai_thuong"] : null; ?>">
                </td>
                <td><input type="text" name="ho_ten" class="form-control" placeholder="Họ và tên..." aria-label=""
                           value="<?php echo isset($_GET["ho_ten"]) ? $_GET["ho_ten"] : null; ?>">
                </td>
                <td><input type="text" name="ten_giai_thuong" class="form-control" placeholder="Tên giải thưởng..." aria-label=""
                           value="<?php echo isset($_GET["ten_giai_thuong"]) ? $_GET["ten_giai_thuong"] : null; ?>">
                </td>
                <td>
                  <?php
                  $loai_giai_thuong_filter = get_loai_giai_thuong();
                  echo '<select name="loai_giai_thuong" class="form-control">';
                  echo '<option value="">Chọn loại giải thưởng...</option>';
                  while ($row = mysqli_fetch_row($loai_giai_thuong_filter)) {
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
                  <select name="to_chuc_thuong" id="to_chuc_thuong" class="form-control" aria-label="">
                    <option value="">Chọn tổ chức thưởng</option>
                    <?php
                    echo '<option value="Trung ương" class="" ' . (($_GET["to_chuc_thuong"] == "Trung ương") ? 'selected' : '') . '>Trung ương</option>';
                    echo '<option value="Địa phương" class="" ' . (($_GET["to_chuc_thuong"] == "Địa phương") ? 'selected' : '') . '>Địa phương</option>';
                    echo '<option value="Tổ chức trong nước" class="" ' . (($_GET["to_chuc_thuong"] == "Tổ chức trong nước") ? 'selected' : '') . '>Tổ chức trong nước</option>';
                    echo '<option value="Tổ chức nước ngoài" class="" ' . (($_GET["to_chuc_thuong"] == "Tổ chức nước ngoài") ? 'selected' : '') . '>Tổ chức nước ngoài</option>';
                    echo '<option value="Quốc gia nước ngoài" class="" ' . (($_GET["to_chuc_thuong"] == "Quốc gia nước ngoài") ? 'selected' : '') . '>Quốc gia nước ngoài</option>';
                    ?>
                  </select>
                </td>
                <td><input type="text" name="to_chuc_trao_giai" class="form-control" placeholder="Tổ chức trao giải..." aria-label=""
                           value="<?php echo isset($_GET["to_chuc_trao_giai"]) ? $_GET["to_chuc_trao_giai"] : null; ?>">
                </td>
                <td>
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
                <td></td>
                <td class="d-flex">
                  <button type="submit" class="btn btn-info">Search</button>
                  <a href="index.php" class="btn btn-secondary ml-3">Reset</a></td>
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
</body>
</html>

<script>
    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled")
    })
</script>
