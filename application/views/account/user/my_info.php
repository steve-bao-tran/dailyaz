<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->	

	<div id="stl-body" class="container">
	    <div class="row">
			
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/block_breadcrumb'); ?>
			<!-- END:SLIDE SITE -->	

	        <div id="stl-content" class="col-lg-12 col-xs-12">
	        	
				<div class="usercontent">
					<div class="content-header">
						<h2><span class="content-title">Thông tin cá nhân</span></h2>
					</div>
					<hr>
					<div class="content-body">
						
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

						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

							<div class="panel panel-default info-left" style="background:#f5f5f5;border-radius: inherit;">
								<ul class="list-unstyled">
									<li class="li1 li-active"><a href="<?php echo base_url() ?>tai-khoan/thong-tin"><i class="fa fa-home"></i>  Bảng thông tin </a><i class="fa fa-angle-double-right pull-right"></i></li>
									<li class="li2"><a href="<?php echo base_url() ?>tai-khoan/sua-thong-tin"><i class="fa fa-user"></i>  Sửa thông tin tài khoản</a></li>
									<li class="li2"><a href="<?php echo base_url() ?>tai-khoan/doi-mat-khau"><i class="fa fa-keyboard-o"></i>  Đổi mật khẩu</a></li>
									<li class="li3"><a href="<?php echo base_url() ?>tai-khoan/sua-giao-nhan"><i class="fa fa-map-marker"></i>  Sửa thông tin giao nhận</a></li>
									<li class="li4"><a href="<?php echo base_url() ?>tai-khoan/san-pham-thich"><i class="fa fa-thumbs-o-up"></i>  Sản phẩm yêu thích</a></li>
									<li class="li5"><a href="<?php echo base_url() ?>tai-khoan/san-pham-xem"><i class="fa fa-eye"></i>  Sản phẩm vừa xem</a></li>
									<li class="li6"><a href="<?php echo base_url() ?>tai-khoan/don-hang"><i class="fa fa-cart-plus"></i>  Đơn hàng của tôi</a></li>
									<li class="li7"><a href="<?php echo base_url() ?>tai-khoan/dang-xuat"><i class="fa fa-sign-out"></i>  Đăng xuất</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

							<div class="panel panel-default info-right" style="border-radius: inherit;">
								<div class="panel-heading"><span class="title-uppercase">Thông tin cá nhân</span><span class="pull-right" style="font-size: 20px;"><a href="<?php echo base_url() ?>tai-khoan/sua-thong-tin" title="Sửa thông tin"><i class="fa fa-pencil-square-o"></i></a></span></div>
								<div class="panel-body">									
									<div class="user_info">

										<div class="col-lg-3 col-xs-12">
											<div class="user_image">
												<img src="<?php echo (isset($my_info) && $my_info->us_avatar != '') ? base_url() .'media/images/avatar/'. $my_info->us_avatar : base_url() .'media/images/default/user_icon.png'; ?>" alt="<?php echo (isset($my_info) && $my_info->us_avatar != '') ? $my_info->us_avatar: ''; ?>" style="width: 80%; ">
											</div>	
											<span>Ảnh đại diện</span>								
										</div>

										<div class="col-lg-9 col-xs-12">
											<div class="user_my_info">

												<div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Họ tên:</label>
								                    <div class="col-sm-8">
								                        <?php echo (isset($my_info) && $my_info->us_fullname != '') ? $my_info->us_fullname : 'Chưa cập nhật'; ?>
								                    </div>
							                    </div>

							                    <div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Tên đăng nhập:</label>
								                    <div class="col-sm-8">
								                        <?php echo (isset($my_info) && $my_info->us_username != '') ? $my_info->us_username : 'Chưa cập nhật'; ?>
								                    </div>
							                    </div>

							                    <div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Email:</label>
								                    <div class="col-sm-8">
								                        <?php echo (isset($my_info) && $my_info->us_email != '') ? $my_info->us_email : 'Chưa cập nhật'; ?>
								                    </div>
							                    </div>
												
												<div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Số điện thoại:</label>
								                    <div class="col-sm-8">
								                        <?php echo (isset($my_info) && $my_info->us_mobile != '') ? $my_info->us_mobile : 'Chưa cập nhật'; ?>
								                    </div>
							                    </div>

							                    <div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Địa chỉ:</label>
								                    <div class="col-sm-8">
								                        <?php echo (isset($my_info) && $my_info->us_address != '') ? $my_info->us_address : 'Chưa cập nhật'; ?>
								                    </div>
							                    </div>

							                    <div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Giới tính:</label>
								                    <div class="col-sm-8">
								                    	<?php if(isset($my_info) && $my_info->us_gen == 1) { $gen = 'Nam';
								                    		} else if (isset($my_info) && $my_info->us_gen == 2) { $gen = 'Nữ';
								                    		} else { $gen = 'Không xác định';
								                    		}
								                    	?>	
								                        <?php echo $gen; ?>
								                    </div>
							                    </div>

							                    <div class="form-group row form-group-custom">
							                      	<label class="col-sm-4 form-control-label">Ngày sinh:</label>
								                    <div class="col-sm-8">
								                        <?php echo (isset($my_info) && $my_info->us_age != '') ? $my_info->us_age : 'Chưa cập nhật'; ?>
								                    </div>
							                    </div>

							                    <div class="form-group row form-group-custom">
													<span class="pull-right"><a class="btn btn-default" href="<?php echo base_url() ?>tai-khoan/sua-thong-tin" title="Sửa thông tin">Cập nhật</a></span>
							                    </div>

											</div>
										</div>

									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

			 </div>

				
			<!-- BEGIN:SLIDE SITE -->
			<?php // $this->load->view('account/common/sidebar_right'); ?>
			<!-- END:SLIDE SITE -->	
			
	    </div>
	</div>
	
	<!-- BEGIN:YOUR STYLE SITE -->
	<?php // $this->load->view('account/common/block_yourstyle'); ?>
	<!-- END:YOUR STYLE SITE -->

	<!--body-->
	<!-- BEGIN:FOOTER SITE -->
	<?php // $this->load->view('account/common/block_maps'); ?>
	<?php $this->load->view('account/common/block_guide'); ?>
	<?php $this->load->view('account/common/block_subscribe'); ?>
	<?php $this->load->view('account/common/footer'); ?>
	<!-- END:FOOTER SITE -->

<!-- BEGIN:FOOTER COMMON -->
<?php $this->load->view('account/common/footer_common'); ?>
<!-- END:FOOTER COMMON