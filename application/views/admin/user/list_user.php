<!-- BEGIN: HEAD COMMON -->
<?php $this->load->view('admin/common/header_common'); ?>
<!-- END: HEAD COMMON -->
    <!-- Side Navbar -->
    <!-- BEGIN: SIDEBAR -->
    <?php $this->load->view('admin/common/sidebar'); ?>
    <!-- END: SIDEBAR -->
    <div class="page">
      	<!-- navbar-->
      	<!-- BEGIN: HEADER -->
      	<?php $this->load->view('admin/common/header'); ?>
      	<!-- END: HEADER -->
     
      	<section>
        	<div class="container-fluid">
	          	<!-- Page Header-->
		        <header>
		        	<div class="row">
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-left">
			        			<h1 class="h3 display">Danh sách thành viên</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="/admin/add-user" class="btn btn-outline-success" title="Thêm thành viên"><i class="fa fa-plus"></i> Thêm</a>
			        			<a href="/admin/excel-user" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-user" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
			        		</div>
			        	</div> 
		            </div>
		        </header>

		        <?php if($this->session->flashdata('sessionError') || $this->session->flashdata('sessionSuccess')){ ?>
				<div class="row">
					<div class="col-xs-12 col-lg-12">
		                <div class="alert <?php echo $this->session->flashdata('sessionError') ? 'alert-danger' : ($this->session->flashdata('sessionSuccess') ? 'alert-success' : '') ?>  alert-dismissable">
		                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                    <strong>Note: </strong> <?php echo $this->session->flashdata('sessionError') ? $this->session->flashdata('sessionError') : ($this->session->flashdata('sessionSuccess') ? $this->session->flashdata('sessionSuccess') : '') ; ?>
		                </div>
	                </div>          
                </div>                
            	<?php } ?>

	          	<div class="row">

		            <div class="col-sx-12 col-lg-12">
		              <div class="card">
		                <div class="card-body">
		                  <div class="table-responsive">
		                    <table class="table table-striped table-hover table-custom">
		                      <thead>
		                        <tr>
		                          <th>#</th>
		                          <th>Tài khoản</th>
		                          <th>Họ tên</th>
		                          <th>Email / Điện thoại</th>
		                          <th>Địa chỉ</th>
		                          <th>Ngày tạo</th>
		                          <th>Vào gần nhất</th>
		                          <th>Nhóm</th>
		                          <th>Trạng thái</th>
		                          <th>Xóa</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_user) > 0) { ?>
		                        <?php foreach($list_user as $key => $value) { ?>
		                        <tr>
		                          <th scope="row"><?php echo $key+1; ?></th>

		                          <td><a href="/admin/edit-user/<?php echo $value->us_id; ?>" title="Sửa tài khoản"><?php echo $value->us_username; ?></a></td>

		                          <td><?php echo $value->us_fullname; ?></td>

		                          <td><p><a href="mailto:<?php echo $value->us_email; ?>" target="_top" title="Gửi thư tới"><?php echo $value->us_email; ?></a> & <?php echo $value->us_mobile; ?></p></td>

		                          <td><?php echo $value->us_address; ?></td>

		                          <td><?php echo $value->us_createdate; ?></td>

		                          <td><?php echo $value->us_lastlogin; ?></td>

		                          <td><?php echo $value->us_group; ?></td>
								  
								  <td><?php if($value->us_publish == 1){ ?>
										<span class="btn btn-cursor btn-active" onclick="ActiveUser(<?php echo $value->us_id ?>, 0);" title="Ngừng kích hoạt"><i class="fa fa-check"></i></span>
							      	  <?php } else { ?>
										<span class="btn btn-cursor btn-unactive" onclick="ActiveUser(<?php echo $value->us_id ?>, 1);" title="Kích hoạt"><i class="fa fa-times"></i></span>	
							      	  <?php } ?>							      	
							      </td>
								  
								  <td><button type="submit" class="btn-del" title="Xóa thành viên" onclick="DeleteUser(<?php echo $value->us_id ?>);"><i class="fa fa-trash"> </i></button></td>

		                        </tr>
								<?php } ?>
								<?php } else { ?>
		                        <tr>
		                          <td colspan="10"><span>Không có dữ liệu</span></td>
		                        </tr>
		                        <?php } ?>
		                        
		                      </tbody>
		                    </table>
		                  </div>
		                </div>
		              </div>
		            </div>
          		</div>
        	</div>
      	</section>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->

    </div>

<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    