<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->

	<style>
		.order-item .item-pic {
		    float: left;
		}
		.order-item .item-main-mini {
		    width: 280px;
		}

		.order-item .item-quantity {
		    font-size: 14px;
		    float: left;
		    width: 64px;
		    min-height: 80px;
		    text-align: left;
		}

		.order-item .item-capsule {
		    width: 204px;
		    text-align: center;
		}

		.order-item .item-status {
		    float: left;
		    min-height: 80px;
		    text-align: left;
		}

		.order-item .item-info {
		    float: right;
		    min-height: 80px;
		    text-align: right;
		    max-width: 204px;
		}

	</style>	

	<div id="stl-body" class="container">
	    <div class="row">
			
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/block_breadcrumb'); ?>
			<!-- END:SLIDE SITE -->	

	        <div id="stl-content" class="col-lg-12 col-xs-12">
	        	
				<div class="usercontent">
					<div class="content-header">
						<h2><span class="content-title">Đơn hàng của tôi</span></h2>
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
									<li class="li3"><a href="<?php echo base_url() ?>tai-khoan/doi-mat-khau"><i class="fa fa-keyboard-o"></i>  Đổi mật khẩu</a></li>
									<li class="li4"><a href="<?php echo base_url() ?>tai-khoan/sua-giao-nhan"><i class="fa fa-map-marker"></i>  Sửa thông tin giao nhận</a></li>
									<li class="li5"><a href="<?php echo base_url() ?>tai-khoan/san-pham-thich"><i class="fa fa-thumbs-o-up"></i>  Sản phẩm yêu thích</a></li>
									<li class="li6"><a href="<?php echo base_url() ?>tai-khoan/san-pham-xem"><i class="fa fa-eye"></i>  Sản phẩm vừa xem</a></li>
									<li class="li7  li-active"><a href="<?php echo base_url() ?>tai-khoan/don-hang"><i class="fa fa-cart-plus"></i>  Đơn hàng của tôi </a><i class="fa fa-angle-double-right pull-right"></i></li>
									<li class="li8"><a href="<?php echo base_url() ?>tai-khoan/dang-xuat"><i class="fa fa-sign-out"></i>  Đăng xuất</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

							<div class="panel panel-default info-right" style="border-radius: inherit;">
								<div class="panel-heading"><span class="title-uppercase">Danh sách đơn hàng</span><span class="pull-right total-like" style="font-size: 15px;"></span></div>
								<div class="panel-body">
									<?php if (count($my_order) > 0) { ?>
										<div class="order-list" style="margin: -15px;">
											<div class="order-filter" style="padding: 7px;">
												<span>Hiển thị:</span>
												<span class="next-select medium filter" tabindex="0">
													<input type="hidden" name="select-faker" value="1"><span class="next-select-inner">5 đơn hàng gần đây</span><i class="next-icon next-icon-arrow-down next-icon-small next-select-arrow"></i>
												</span>
											</div>

											<div class="orders" style="padding:7px; background: #d1d1d1;">
												<?php $key = 0; ?>
												<?php foreach ($my_order as $item => $items) { $key++; ?>
													<div class="order" style="background: #fff;">
														<div class="order-info" style="border: 1px solid #ddd;">
															<a href="/">
																<div class="pull-left">
																	<span class="info-order-left-text">Đơn hàng <a class="link" href="/"><?php echo PREORDERNAME . $items['oid']; ?></a>
																	</span>
																	<span class="text info desc">Đặt ngày <?php echo date('d-m-Y', time($items['odate'])); ?></span>
																</div>
																<a class="pull-right link manage" href="<?php echo base_url() .'tai-khoan/don-hang/'. $items['oid']; ?>">QUẢN LÝ</a>
																<div class="clear"></div>
															</a>
														</div>

														<?php foreach ($items as $key => $value) { ?>
															<?php if ((bool)preg_match( '/^[\-+]?[0-9]+$/', $key)) { ?>	
																<div class="order-item">
																	<div class="item-pic" data-spm="detail_image">
																		<a href="/">
																			<img src="<?php echo ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_75_'. explode(',', $value->pro_image)[0])) ? 'media/images/product/'. $value->pro_dir .'/thumbnail_75_'. explode(',', $value->pro_image)[0] : 'media/images/default/no_image.jpg' ?>">
																		</a>
																	</div>

																	<div class="item-main item-main-mini">
																		<div>
																			<div class="text title item-title" data-spm="details_title"><?php echo $value->pro_name ?></div>
																			<p class="text desc"></p>
																			<p class="text desc bold"></p>
																		</div>
																	</div>

																	<div class="item-quantity">
																		<span class="text desc info multiply">SL:</span>
																		<span class="text">&nbsp;<?php echo $value->sc_quantity ?></span>
																	</div>

																	<div class="item-status item-capsule">
																		<?php
																			$st = 'Chưa cập nhật';
																		 if ($items['ostatus'] == 1) { 
																		 	$st = 'Mới đặt'; 
																		 } else if ($items['ostatus'] == 5) {
																		 	$st = 'Đã giao hàng';	
																		 } else if (in_array($items['ostatus'], array(2,3,4))) {
																		 	$st = 'Đang vận chuyển';
																		 } else if (in_array($items['ostatus'], array(98,99))) {
																		 	$st = 'Đã hủy';
																		 } ?>
																		<p class="capsule"><?php echo $st; ?></p>
																		<?php if (in_array($items['ostatus'], array(5,98,99))) { ?>
																		<p>Vào lúc <?php echo date('d-m-Y H:i:s', time($items['ochangestatus'])); ?></p>
																		<?php } ?>
																	</div>

																	<div class="item-info"></div>

																	<div class="clear"></div>
																</div>
															<?php } ?>						
														<?php } ?>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } else { ?>
										<p class="text-center">Chưa có đơn hàng nào của bạn!!</p>
									<?php } ?>

									<br class="break">									
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