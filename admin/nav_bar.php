<div class="col-lg-2 page-wrapper chiller-theme toggled">
  <div id="show-sidebar">
    <i class="fa fa-list ml-1" aria-hidden="true"></i>
  </div>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a>QUẢN LÝ THI ĐUA KHEN THƯỞNG</a>
        <div id="close-sidebar">
          <i class="fa fa-times" aria-hidden="true"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded"
               src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
               alt="User picture" style="height: 50px">
        </div>
        <div class="user-info">
          <span class="user-name"></span>
          <span class="user-role">Họ tên: <?php echo $_SESSION["current_user"]; ?></span>
          <span class="user-role">Vai trò: <?php echo $vaitro[$_SESSION["role"]]; ?></span>
          <span class="user-role">Địa chỉ: Đại học Quốc Gia Hà Nội</span>
          <span class="user-role">ĐT: 0987654321</span>
        </div>
      </div>
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'admin/index.php') !== false ? 'active' : ''; ?>">
            <a href="/QuanLy/admin/index.php">
              <i class="fa fa-home"></i>
              <span>TRANG CHỦ</span>
            </a>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'canbo') !== false ? 'active' : ''; ?>">
            <a data-toggle="collapse" href="#collapse-canbo" role="button"
               aria-expanded="false" aria-controls="collapse-canbo">
              <i class="fa fa-book" aria-hidden="true"></i>
              <span>QUẢN LÝ CÁN BỘ</span>
            </a>
            <div class="collapse chained_node" id="collapse-canbo" style="background: #3a3f48; width: 100%;">
              <a href="/QuanLy/admin/canbo/index.php" class="dropdown-item">
                <i class="fa fa-database" aria-hidden="true"></i></i><span>QUẢN LÝ DỮ LIỆU</span>
              </a>
              <a href="/QuanLy/admin/canbo/bieudo.php" class="dropdown-item">
                <i class="fa fa-line-chart" aria-hidden="true"></i><span>BIỂU ĐỒ</span>
              </a>
            </div>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'giaithuong') !== false ? 'active' : ''; ?>">
            <a data-toggle="collapse" href="#collapse-giaithuong" role="button"
               aria-expanded="false" aria-controls="collapse-giaithuong">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
              <span>QUẢN LÝ GIẢI THƯỞNG</span>
            </a>
            <div class="collapse chained_node" id="collapse-giaithuong" style="background: #3a3f48; width: 100%;">
              <a href="/QuanLy/admin/giaithuong/index.php" class="dropdown-item">
                <i class="fa fa-database" aria-hidden="true"></i></i><span>QUẢN LÝ DỮ LIỆU</span>
              </a>
              <a href="/QuanLy/admin/giaithuong/bieudo.php" class="dropdown-item">
                <i class="fa fa-line-chart" aria-hidden="true"></i><span>BIỂU ĐỒ</span>
              </a>
            </div>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'danhhieu') !== false ? 'active' : ''; ?>">
            <a data-toggle="collapse" href="#collapse-danhhieu" role="button"
               aria-expanded="false" aria-controls="collapse-danhhieu">
              <i class="fa fa-cubes"></i>
              <span>QUẢN LÝ DANH HIỆU THI ĐUA</span>
            </a>
            <div class="collapse chained_node" id="collapse-danhhieu" style="background: #3a3f48; width: 100%;">
              <a href="/QuanLy/admin/danhhieu/index.php" class="dropdown-item">
                <i class="fa fa-database" aria-hidden="true"></i></i><span>QUẢN LÝ DỮ LIỆU</span>
              </a>
              <a href="/QuanLy/admin/danhhieu/bieudo.php" class="dropdown-item">
                <i class="fa fa-line-chart" aria-hidden="true"></i><span>BIỂU ĐỒ</span>
              </a>
            </div>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'nguoidung') !== false ? 'active' : ''; ?>">
            <a href="/QuanLy/admin/nguoidung/index.php">
              <i class="fa fa-user"></i>
              <span>QUẢN LÝ NGƯỜI DÙNG</span>
            </a>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'khenthuong') !== false ? 'active' : ''; ?>">
            <a data-toggle="collapse" href="#collapseExample" role="button"
               aria-expanded="false" aria-controls="collapseExample">
              <i class="fa fa-calendar-check-o"></i>
              <span>QUẢN LÝ KHEN THƯỞNG</span>
            </a>
            <div class="collapse chained_node" id="collapseExample" style="background: #3a3f48; width: 100%;">
              <a href="/QuanLy/admin/khenthuong/index_tap_the.php" class="dropdown-item">
                <i class="fa fa-users" aria-hidden="true"></i><span>QUẢN LÝ KHEN THƯỞNG TẬP THỂ</span>
              </a>
              <a href="/QuanLy/admin/khenthuong/index_ca_nhan.php" class="dropdown-item">
                <i class="fa fa-user" aria-hidden="true"></i><span>QUẢN LÝ KHEN THƯỞNG CÁ NHÂN</span>
              </a>
              <a href="/QuanLy/admin/khenthuong/bieudo.php?loai=ca_nhan" class="dropdown-item">
                <i class="fa fa-line-chart" aria-hidden="true"></i><span>BIỂU ĐỒ</span>
              </a>
            </div>
          </li>
          <li class="header-menu">
            <span>Extra</span>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-check-square-o"></i>
              <span>GỢI Ý KHEN THƯỞNG</span>
            </a>
          </li>
          <!--          <li>-->
          <!--            <a href="#">-->
          <!--              <i class="fa fa-upload" aria-hidden="true"></i>-->
          <!--              <span>NHẬP DỮ LIỆU TỪ FILE</span>-->
          <!--            </a>-->
          <!--          </li>-->
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'export') !== false ? 'active' : ''; ?>">
            <a href="/QuanLy/admin/export/index.php">
              <i class="fa fa-file-excel-o" aria-hidden="true"></i>
              <span>XUẤT DỮ LIỆU RA FILE</span>
            </a>
          </li>
          <li class="header-menu">
            <span>Manage</span>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'danhsach/truong.php') !== false ? 'active' : ''; ?>">
            <a href="/QuanLy/admin/danhsach/truong.php">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <span>DANH SÁCH TRƯỜNG</span>
            </a>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'danhsach/khoa.php') !== false ? 'active' : ''; ?>">
            <a href="/QuanLy/admin/danhsach/khoa.php">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <span>DANH SÁCH KHOA</span>
            </a>
          </li>
          <li class="sidebar-dropdown <?php echo strpos($_SERVER['REQUEST_URI'], 'danhsach/bomon.php') !== false ? 'active' : ''; ?>">
            <a href="/QuanLy/admin/danhsach/bomon.php">
              <i class="fa fa-bars" aria-hidden="true"></i>
              <span>DANH SÁCH BỘ MÔN</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="sidebar-footer">
      </div>
    </div>
  </nav>
</div>
