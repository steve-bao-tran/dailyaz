<nav class="side-navbar">
  <div class="side-navbar-wrapper">
    <!-- Sidebar Header    -->
    <div class="sidenav-header d-flex align-items-center justify-content-center">
      <!-- User Info-->
      <div class="sidenav-header-inner text-center">
        <img src="<?php echo $this->session->userdata('sessionAvatarAdmin') ? 'media/images/avatar/'. $this->session->userdata('sessionAvatarAdmin') : 'media/images/avatar/avatar-1.jpg' ?>" alt="person" class="img-fluid rounded-circle">
        <h2 class="h5"><?php echo $this->session->userdata('sessionNameAdmin') ? $this->session->userdata('sessionNameAdmin') : '' ?></h2><span><?php echo $this->session->userdata('sessionUsernameAdmin') ? $this->session->userdata('sessionUsernameAdmin') : '' ?></span>
      </div>
      <!-- Small Brand information, appears on minimized sidebar-->
      <div class="sidenav-header-logo"><a href="/admin" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
    </div>

    <!-- Sidebar Navigation Menus-->
    <div class="main-menu">
      <h5 class="sidenav-heading">Main</h5>
      <ul id="side-main-menu" class="side-menu list-unstyled">                  
        <li><a href="/admin"> <i class="icon-home"></i>Home </a></li>
        <li><a href="forms.html"> <i class="icon-form"></i>Forms </a></li>
        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
        <li><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>

        <li> 
          <a href="/admin/order"> <i class="icon-screen"></i>Theo dõi đơn hàng
            <?php if (isset($neworder) && $neworder > 0) { ?>
              <div class="badge badge-warning"><?php echo $neworder; ?> Đơn hàng mới</div>
            <?php } ?>
          </a>
        </li>

        <li> 
          <a href="/admin/order"> <i class="icon-flask"></i>Yêu cầu nhận thông báo
            <?php if (isset($neworder) && $neworder > 0) { ?>
              <div class="badge badge-warning"><?php echo $neworder; ?> Yêu cầu</div>
            <?php } ?>
          </a>
        </li>

        <li> 
          <a href="/admin/contact"> <i class="icon-flask"></i>Liên hệ
            <?php if (isset($newcontact) && $newcontact > 0) { ?>
              <div class="badge badge-warning"><?php echo $newcontact; ?> Mới</div>
            <?php } ?>
          </a>
        </li>

        <li><a href="#menu-user" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Quản lý thành viên</a>
          <ul id="menu-user" class="collapse list-unstyled in" aria-expanded="true">
            <li><a href="/admin/user">Thành viên</a></li>
            <li><a href="/admin/customer">Khách hàng</a></li>
          </ul>
        </li>

        <li><a href="#menu-content" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Quản lý nội dung</a>
          <ul id="menu-content" class="collapse list-unstyled in" aria-expanded="true">
            <li><a href="/admin/content">Nội dung số</a></li>
            <li><a href="/admin/blogs">Blogs</a></li>
            <li><a href="/admin/guide">Hướng dẫn</a></li>
            <li><a href="/admin/promotion">Khuyến mãi</a></li>
            <li><a href="/admin/collection">Bộ sứu tập</a></li>
          </ul>
        </li>

        <li><a href="#menu-product" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Quản lý hàng hóa</a>
          <ul id="menu-product" class="collapse list-unstyled in" aria-expanded="true">
            <li><a href="/admin/product">Kho hàng</a></li>
            <li><a href="/admin/category">Danh mục</a></li>
            <li><a href="/admin/style">Thuộc tính phong cách</a></li>
            <li><a href="/admin/color">Thuộc tính màu sắc</a></li>
          </ul>
        </li>

        <!-- <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li> -->

        <!-- <li> <a href="#"> <i class="icon-mail"></i>Demo
            <div class="badge badge-warning">6 New</div></a>
        </li> -->

        <li> 
          <a href="/admin/list-email"> <i class="icon-mail"></i>Email đăng ký
            <?php if (isset($newmail) && $newmail > 0) { ?>
            <div class="badge badge-warning"><?php echo $newmail; ?> Mới</div>
            <?php } ?>
          </a>
        </li>

        <li><a href="#menu-setting" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Cài đặt & Cấu hình</a>
          <ul id="menu-setting" class="collapse list-unstyled in" aria-expanded="true">
            <li><a href="/admin/setting">Cài đặt</a></li>
            <li><a href="/admin/edit-config">Cấu hình cơ bản</a></li>
            <li><a href="/admin/infous">Thông tin cửa hàng</a></li>
            <li><a href="/admin/settup-home">Cài đặt trang chủ</a></li>
          </ul>
        </li>
        
        <li><a href="#menu-media" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Thư viện</a>
          <ul id="menu-media" class="collapse list-unstyled in" aria-expanded="true">
            <li><a href="/admin/images">Hình ảnh</a></li>
            <li><a href="/admin/documents">Tài liệu</a></li>            
            <li><a href="/admin/videos">Videos</a></li>            
            <li><a href="/admin/musics">Âm nhạc</a></li>            
          </ul>
        </li>
        
        <li> <a href="/admin/newicon"> <i class="icon-picture"> </i>Logo & Hình ảnh</a></li>
      </ul>
    </div>

    <div class="admin-menu">
      <h5 class="sidenav-heading">Second menu</h5>
      <ul id="side-admin-menu" class="side-menu list-unstyled"> 
        <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
        <li> <a href="#"> <i class="icon-flask"> </i>Demo
            <div class="badge badge-info">Special</div></a></li>
        <li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>
        <li> <a href="/admin/system-info"> <i class="icon-picture"> </i>Thông tin hệ thống</a></li>
      </ul>
    </div>
  </div>
</nav>