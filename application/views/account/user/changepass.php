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
						<h2><span class="content-title">Đổi mật khẩu</span></h2>
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
									<li class="li1"><a href="<?php echo base_url() ?>tai-khoan/thong-tin"><i class="fa fa-home"></i>  Bảng thông tin </a></li>
									<li class="li2"><a href="<?php echo base_url() ?>tai-khoan/sua-thong-tin"><i class="fa fa-user"></i>  Sửa thông tin tài khoản</a></li>
									<li class="li3 li-active"><a href="<?php echo base_url() ?>tai-khoan/doi-mat-khau"><i class="fa fa-keyboard-o"></i>  Đổi mật khẩu </a><i class="fa fa-angle-double-right pull-right"></i></li>
									<li class="li4"><a href="<?php echo base_url() ?>tai-khoan/sua-giao-nhan"><i class="fa fa-map-marker"></i>  Sửa thông tin giao nhận</a></li>
									<li class="li5"><a href="<?php echo base_url() ?>tai-khoan/san-pham-thich"><i class="fa fa-thumbs-o-up"></i>  Sản phẩm yêu thích</a></li>
									<li class="li6"><a href="<?php echo base_url() ?>tai-khoan/san-pham-xem"><i class="fa fa-eye"></i>  Sản phẩm vừa xem</a></li>
									<li class="li7"><a href="<?php echo base_url() ?>tai-khoan/don-hang"><i class="fa fa-cart-plus"></i>  Đơn hàng của tôi</a></li>
									<li class="li8"><a href="<?php echo base_url() ?>tai-khoan/dang-xuat"><i class="fa fa-sign-out"></i>  Đăng xuất</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

							<div class="panel panel-default info-right" style="border-radius: inherit;">
								<div class="panel-heading"><span class="title-uppercase">Đổi mật khẩu</span></div>
								<div class="panel-body">									
									<div class="user_info">
										<form name="frmChangePass" id="frmChangePass" class="form-horizontal" method="post">

						                    <div class="form-group">
						                      	<label class="col-sm-2 form-control-label">Mật khẩu hiện tại <span style="color: #ff0000"> *</span></label>
						                      	<div class="col-sm-10">
						                        	<input type="password" class="form-control" name="currentpass" id="currentpass" placeholder="Nhập mật khẩu hiện tại..." required>
						                      	</div>
						                    </div>

						                    <div class="form-group">
						                      	<label class="col-sm-2 form-control-label">Mật khẩu mới <span style="color: #ff0000"> *</span></label>
						                      	<div class="col-sm-10">
						                        	<input type="password" class="form-control" name="newpass" id="newpass" placeholder="Nhập mật khẩu mới..." required>
						                      	</div>
						                    </div>

						                    <div class="form-group">
						                      	<label class="col-sm-2 form-control-label">Xác nhận mật khẩu mới <span style="color: #ff0000"> *</span></label>
						                      	<div class="col-sm-10">
						                        	<input type="password" class="form-control" name="renewpass" id="renewpass" placeholder="Nhập lại mật khẩu mới..." required>
						                      	</div>
						                    </div>
											
						                    <div class="form-group">
						                    	<div class="col-sm-offset-2 col-sm-10">
													<button type="submit" class="btn btn btn-primary">Xác nhận</button>
													<button type="reset" class="btn btn btn-default">Hủy</button>
												</div>
						                    </div>

										</form>
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