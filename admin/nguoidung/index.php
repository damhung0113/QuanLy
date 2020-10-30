<?php
include "/opt/lampp/htdocs/QuanLy/connect.php";
include "/opt/lampp/htdocs/QuanLy/alert.php";
include "./query.php";
global $connect;
global $data;
if (isset($_SESSION["loged_user"])) {
  header("Location: /opt/lampp/htdocs/QuanLy/index.php");
}

$users = select();
$vaitro = ["Người quản lý", "Trưởng đơn vị (Cấp Đại học Quốc gia)", "Trưởng đơn vị (Cấp trường)", "Trưởng đơn vị (Cấp khoa)"];
while ($row = mysqli_fetch_row($users)) {
  $data[] = array('tendangnhap' => $row[0], 'vaitro' => $vaitro[$row[2]], 'macanbo' => $row[3]);
}
?>

<html lang="vi">
<head>
  <title>Quản Lý Người Dùng</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/QuanLy/css/login.css">
  <link rel="stylesheet" href="/QuanLy/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">
  <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
  <script
      src="https://unpkg.com/bootstrap-table@1.18.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container-cus">
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/header.php");
  ?>
  <div class="main">
    <div class="row mt-5">
      <div class="col-12 box-content">
        <div class="d-flex justify-content-between">
          <h4>Danh sách người dùng</h4>
          <a class="btn btn-primary mr-2" href="create.php" role="button">Thêm</a>
        </div>
        <table
            class="mt-3 table-border"
            id="table"
            data-filter-control="true"
            data-pagination="true">
          <thead>
          <tr>
            <th class="nbgr" data-field="tendangnhap" data-filter-control="input" data-sortable="true"
                data-filter-control-placeholder="Tên đăng nhập">Tên đăng nhập
            </th>
            <th class="nbgr" data-field="vaitro" data-filter-control="input"
                data-filter-control-placeholder="Vai trò">
              Vai trò
            </th>
            <th class="action" data-field="hanhdong" data-formatter="action_formatter"></th>
          </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <?php
  include_once("/opt/lampp/htdocs/QuanLy/footer.php");
  ?>
</div>
</body>
</html>

<style rel="stylesheet">
	.action {
		width: 170px !important;
	}

	.nbgr .th-inner {
		background: #4796CE;
	}
</style>

<script lang="js">
    const $table = $('#table');

    $(function () {
        let data = <?php echo json_encode($data) ?>

            $table.bootstrapTable({data: data})
    })

    function action_formatter(value, row, index) {
        return [
            '<div class="d-flex justify-content-around">',
            `<a class="btn btn-info" href="edit.php?tendangnhap=${row.tendangnhap}&vaitro=${row.vaitro}">Sửa</a>`,
            `<a class="btn btn-danger" href="destroy.php?tendangnhap=${row.tendangnhap}" role="button" methods="DELETE"" role="button">Xóa</a>`,
            '</div>'
        ].join('')
    }
</script>