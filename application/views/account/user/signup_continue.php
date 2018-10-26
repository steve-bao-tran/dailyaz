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
						<h2><span class="content-title">Cập nhật thông tin</span></h2>
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
									<form name="frmSignupContinue" id="frmSignupContinue" method="post" enctype="multipart/form-data">

										<div class="form-group">
										    <input type="text" class="input-form-custom form-control" name="usfullname" id="usfullname" placeholder="Họ tên (*)" onblur="checkUsername(this.value);" required>
										</div>

										<?php if ($new_user->us_email == '') { ?>

											<div class="form-group">
											    <input type="text" class="input-form-custom form-control" name="usemail" id="usEmail" placeholder="Email" onblur="checkIfMailExisted(this.value, 'usEmail');">
											</div>

										<?php } else { ?>
												
											<div class="form-group">
											    <input type="text" class="input-form-custom form-control" name="usmobile" id="usMobile" placeholder="Số điện thoại">
											</div>
												
										<?php } ?>

										<div class="form-group">
											<div class="avatar-user">
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('usimage');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh đại diện</span>
													<span class="add">+</span>
												</div>
												<input type="file" accept="image" name="usimage" id="usimage" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar');" />
												<div class="img-uploadfile hidden" id="img_avatar">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
														<img class="preview_avatar" id="preview_avatar" src=""/>
														<span class="delete_avatar" id="delete_avatar" style="cursor: pointer;" onclick="RemoveImg('img-uploadfile', 'usimage');">X</span>
													</div>								    
											    </div>
										    </div>	
										</div>

										<div class="form-group">
											<button type="submit" class="btn btn btn-primary">Hoàn tất</button>
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