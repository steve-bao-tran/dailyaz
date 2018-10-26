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

	        <div id="stl-content" class="col-lg-9 col-sm-8 col-xs-12">
	        	
				<div class="usercontent">
					<div class="content-header">
						<h2><span class="content-title">Đăng ký thành viên</span></h2>
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

						<div class="col-lg-6 col-lg-offset-3 col-xs-12" >
							<div class="panel panel-default">
								<div class="panel-body">
									<form name="frmSignup" id="frmSignup" method="post" enctype="multipart/form-data">

										<div class="form-group">
										    <input type="text" class="input-form-custom form-control" name="ususername" id="usUsername" placeholder="Tên đăng nhập (*)" onblur="checkUsername(this.value);" required>
										</div>

										<div class="form-group">
										    <input type="text" class="input-form-custom form-control" name="usemailmobile" id="usEmailMobile" placeholder="Email / Điện thoại (*)" onblur="checkIfMailExisted(this.value, 'usEmailMobile');" required>
										</div>

										<div class="form-group">
										    <input type="password" class="input-form-custom form-control" name="uspassword" id="usPassword" placeholder="Mật khẩu (*)" required>
										</div>

										<div class="form-group">
										    <input type="password" class="input-form-custom form-control" name="usrepassword" id="usRepassword" placeholder="Nhập lại mật khẩu (*)" required>
										</div>
										
										<div class="form-group">
											<button type="submit" class="btn btn btn-primary">Đăng ký</button><span class="pull-right"><h6>Khi bạn đăng ký tức là đã đọc các <a href="#">điều kiện</a> của chúng tôi</h6></span>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>

				</div>

			 </div>

				
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/sidebar_right'); ?>
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