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
						<h2><span class="content-title">Sửa thông tin cá nhân</span></h2>
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
									<li class="li2 li-active"><a href="<?php echo base_url() ?>tai-khoan/sua-thong-tin"><i class="fa fa-user"></i>  Sửa thông tin tài khoản </a><i class="fa fa-angle-double-right pull-right"></i></li>
									<li class="li3"><a href="<?php echo base_url() ?>tai-khoan/doi-mat-khau"><i class="fa fa-keyboard-o"></i>  Đổi mật khẩu</a></li>
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
								<div class="panel-heading"><span class="title-uppercase">Sửa thông tin cá nhân</span></div>
								<div class="panel-body">									
									<div class="user_info">
										<form name="frmChangeInfo" id="frmChangeInfo" class="form-horizontal" method="post" enctype="multipart/form-data">

						                    <div class="form-group row form-group-custom">
						                      	<label class="col-sm-2 form-control-label">Họ tên</label>
						                      	<div class="col-sm-10">
						                        	<input type="text" class="form-control" name="usfullname" id="usfullname" value="<?php echo (isset($usinfo) && $usinfo->us_fullname != '') ? $usinfo->us_fullname : ''; ?>" placeholder="Nhập họ tên...">
						                      	</div>
						                    </div>

						                    <div class="form-group row form-group-custom">
						                      	<label class="col-sm-2 form-control-label">Ảnh đại diện</label>
						                      	<div class="col-sm-10">
						                        	<div class="avatar-user">
													    <div class="btn-uploadfile btn-cursor" onclick="CallNext('usimage');">
															<br>
															<i class="fa fa-camera fa-4x"></i>
															<br>
															<span>Ảnh đại diện</span>
															<span class="add">+</span>
														</div>
														<input type="file" accept="image" name="usimage" id="usimage" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar');" />
														<div class="img-uploadfile <?php echo (isset($usinfo) && $usinfo->us_avatar != '') ? '' : 'hidden'; ?> " id="img_avatar">
															<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
																<img class="preview_avatar" id="preview_avatar" src="<?php echo (isset($usinfo) && $usinfo->us_avatar != '' && file_exists('media/images/avatar/'. $usinfo->us_avatar)) ? base_url() .'media/images/avatar/'. $usinfo->us_avatar : ''; ?>"/>
																<span class="delete_avatar" id="delete_avatar" style="cursor: pointer;" onclick="RemoveImg('img-uploadfile', 'usimage', 'usiavataredit', true);">X</span>
															</div>								    
													    </div>
													    <input type="hidden" name="usiavataredit" id="usiavataredit" value="<?php echo (isset($usinfo) && $usinfo->us_avatar != '') ? $usinfo->us_avatar : ''; ?>">
												    </div>
						                      	</div>
						                    </div>

						                    <div class="form-group  row form-group-custom">
						                      	<label class="col-sm-2 form-control-label">Thư điện tử</label>
						                      	<div class="col-sm-10">
						                        	<input type="text" class="form-control" name="usemail" id="usemail" value="<?php echo (isset($usinfo) && $usinfo->us_email != '') ? $usinfo->us_email : ''; ?>" placeholder="Nhập thư điện tử...">
						                      	</div>
						                    </div>

						                    <div class="form-group">
						                      	<label class="col-sm-2 form-control-label">Số điện thoại</label>
						                      	<div class="col-sm-10">
						                        	<input type="text" class="form-control" name="usmobile" id="usmobile" value="<?php echo (isset($usinfo) && $usinfo->us_mobile != '') ? $usinfo->us_mobile : ''; ?>" placeholder="Nhập số điện thoại...">
						                      	</div>
						                    </div>

						                    <div class="form-group  row form-group-custom">
						                      	<label class="col-sm-2 form-control-label">Địa chỉ</label>
						                      	<div class="col-sm-10">
						                        	<input type="text" class="form-control" name="usaddress" id="usaddress" value="<?php echo (isset($usinfo) && $usinfo->us_address != '') ? $usinfo->us_address : ''; ?>" placeholder="Nhập địa chỉ người nhận...">
						                        	<span class="text-small text-gray help-block-none"><small>Bao gồm: Số nhà, phường/xã, quận/huyện, tỉnh/thành. Tùy địa phường cũng cấp đầy đủ để tiện giao hàng</small></span>
						                      	</div>
						                    </div>

						                    <div class="form-group">
						                      	<label class="col-sm-2 form-control-label">Ngày sinh</label>
						                      	<div class="col-sm-10">
						                        	<input type="date" class="form-control date" name="usage" id="usage" value="<?php echo (isset($usinfo) && $usinfo->us_age != '') ? $usinfo->us_age : ''; ?>" placeholder="Nhập ngày sinh...">
						                      	</div>
						                    </div>

						                    <div class="form-group">
						                      	<label class="col-sm-2 form-control-label">Giới tính</label>
						                      	<div class="col-sm-10">
										            <?php $s1 = ''; $s2 = ''; $s3 = '';
						                      			if(isset($usinfo) && $usinfo->us_gen == 3){
						                      				$s3 = 'selected="selected"';
						                      			} elseif (isset($usinfo) && $usinfo->us_gen == 2) {
						                      				$s2 = 'selected="selected"';
						                      			} else {
						                      				$s1 = 'selected="selected"';
						                      			}
						                      		 ?>
							                        <select name="usgen" id="usgen" class="form-control">
							                          	<option value="1" <?php echo $s1; ?>>Nam</option>
							                          	<option value="2" <?php echo $s2; ?>>Nữ</option>
							                          	<option value="3" <?php echo $s3; ?>>Hỗn hợp</option>
							                        </select>
						                      	</div>
						                    </div>
											
						                    <div class="form-group">
						                    	<div class="col-sm-offset-2 col-sm-10">
													<button type="submit" class="btn btn btn-primary">Xác nhận</button>
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