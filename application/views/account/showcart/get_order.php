<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->

	<style>
		.o-detail {
			border: 1px solid #d1d1d1;
			border-radius: 3px;
			height: auto;
			margin-bottom: 5px;
		}

		.od-money, .od-delive, .od-info, .od-recei{
			padding: 10px;
		}
		
		.od-money {
			height: 70px;			
		}

		.o-detail .tl {
		    background: #999999;
		    line-height: 40px;
		    padding-left: 10px;
		    font-size: 15px;
		    color: white;
		    border-bottom: 1px solid #E8E8E8;
		    font-weight: bold;
		}
		.o-detail .cont {
		    padding: 11px 0px;
		    overflow: hidden;
		    line-height: 15px;
		}
		.o-detail .box-steps {
		    overflow: hidden;
		}
		.o-detail .box-steps .step {
		    position: relative;
		    float: left;
		    width: 33%;
		    text-align: center;
		}
		.o-detail .box-steps .step.done span, .o-detail .box-steps .step.done:after {
		    background-color: #17a117;
		}
		.o-detail .box-steps .step span {
		    background: #a8a8a8;
		    width: 34px;
		    height: 34px;
		    line-height: 34px;
		    text-align: center;
		    border-radius: 100%;
		    display: block;
		    position: absolute;
		    left: 50%;
		    margin-left: -15px;
		    z-index: 1;
		}
		.o-detail .box-steps .step .icon {
		    width: 20px;
		    height: 20px;
		    color: #fff ;
		    vertical-align: middle;
		    margin:5px;
		}
		.o-detail .box-steps .step.done p {
		    color: #17a117;
		}
		.o-detail .box-steps .step.current span {
		    background-color: #e5101d;
		}
		.o-detail .box-steps .step.current p {
		    color: #e5101d;
		}
		.o-detail .box-steps .step p {
		    padding-top: 35px;
		    line-height: 18px;
		}
		.o-detail .item {
		    float: left;
		}
		.o-detail .item > img {
		    float: left;
		    width: 80px;
		}
		.o-detail .item .info {
		    margin-left: 90px;
		    line-height: 18px;
		    font-size: 13px;
		}
		.o-detail .item .info a {
		    display: block;
		}

		.o-detail .item .info p span {
		    display: inline-block;
		    width: 200px;
		    font-weight:bold;
		}

		.o-detail .nn p span {
		    display: inline-block;
		    width: 90px;
		}

		.o-detail .box-steps .step:after {
		    content: '';
		    width: 100%;
		    position: absolute;
		    top: 15px;
		    left: 50%;
		    height: 2px;
		    background-color: #a8a8a8;
		}
		.final:after{
		    display: none;
		}
		.money{color:red;font-weight:bold;}

		.o-detail .nn{
		    padding-left: 10px;
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
						<h2><span class="content-title">Đơn hàng: <?php echo PREORDERNAME . $oid ?></span></h2>
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
								<div class="panel-heading"><span class="title-uppercase">Chi tiết đơn hàng</span><span class="pull-right total-like" style="font-size: 15px;"></span></div>
								<div class="panel-body">
									<?php if (count($order) > 0 && count($detail) > 0) { ?>
										<div class="order-detail-panel">
											<div class="o-detail od-money">
												<div class="o-d-id pull-left">
													<span>Mã đơn hàng: <?php echo PREORDERNAME . $order->o_id ?></span>
													<p>Ngày đặt: <span><small><?php echo date('d-m-Y H:i:s', time($order->o_date)); ?></small></span></p>
												</div>
												<div class="o-d-cost pull-right">
													Tổng tiền: <span class="money"><?php echo number_format($order->o_cost_promos, 0, '.', '.'); ?>đ</span>
												</div>
											</div>

											<div class="clearfix"></div>

											<div class="o-detail od-delive">
												<div class="cont">
			                                        <div class="box-steps">
														<?php if (isset($order) && in_array($order->o_status, array(1,2,3,4,5))) { ?>
			                                        	<div class="step <?php echo (isset($order) && in_array($order->o_status, array(1,2,3,4,5))) ? 'done' : '' ?>">
			                                                <span>
			                                                	<i class="fa fa-shopping-cart"></i>
			                                                </span>
			                                                <p>Mới</p>
			                                            </div>

			                                            <div class="step <?php echo (isset($order) && in_array($order->o_status, array(2,3,4,5))) ? 'done' : '' ?>">
			                                                <span>
			                                                	<i class="fa fa-shopping-bag"></i>
			                                                </span>
			                                                <p>Đã xác nhận và đang vận chuyển</p>
			                                            </div>

			                                            <div class="step final <?php echo (isset($order) && $order->o_status == 5) ? 'done' : '' ?>">
			                                                <span>
			                                                	<i class="fa fa-check"></i>
			                                                </span>
			                                                <p>Đã hoàn tất</p>
			                                            </div>
													<?php } else if (isset($order) && $order->o_status == 98) { ?>
														<div class="step done final">
			                                                <span><i class="fa fa-times"></i></span>
			                                                <p>Cửa hàng hủy. Lý do: <?php echo (isset($order) && $order->o_reason_cancel != '') ? $order->o_reason_cancel : 'Chưa cập nhật' ?></p>
			                                            </div>
													<?php } else if (isset($order) && $order->o_status == 99) { ?>
														<div class="step done final">
			                                                <span><i class="fa fa-times"></i></span>
			                                                <p>Khách hàng hủy. Lý do: <?php echo (isset($order) && $order->o_reason_cancel != '') ? $order->o_reason_cancel : 'Chưa cập nhật' ?></p>
			                                            </div>
													<?php } ?>
			                                        </div>
			                                    </div>
											</div>

											<div class="clearfix"></div>
											
											<div class="o-detail od-info">
												<?php foreach ($detail as $key => $value) { ?>
													<div class="o-d-items">
														<div class="o-d-img">
															<a href="/">
																<img src="<?php echo ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_75_'. explode(',', $value->pro_image)[0])) ? 'media/images/product/'. $value->pro_dir .'/thumbnail_75_'. explode(',', $value->pro_image)[0] : 'media/images/default/no_image.jpg' ?>" alt="<?php echo $value->pro_name ?>">
															</a>
														</div>
														<div class="o-d-name">
															<a href="/">
																<span><?php echo $value->pro_name ?></span>
															</a>
														</div>
														<div class="o-d-price">
															Giá: <span class="money"><?php echo number_format($value->sc_price * $value->sc_quantity, 0, '.', '.') ?>đ</span>
														</div>
														<div class="o-d-qty">
															SL: <span><?php echo $value->sc_quantity ?></span>
														</div>														
													</div>
												<?php } ?>
											</div>

											<div class="clearfix"></div>
											
											<div class="o-detail od-recei">
												<div class="o-d-receiname">
													Tên người nhận: <span><?php echo $order->rc_fullname ?></span>
												</div>
												<div class="o-d-address">
													Địa chỉ: <span><?php echo $order->rc_address ?></span>
												</div>
												<div class="o-d-mobile">
													Điện thoại: <span><?php echo $order->rc_mobile ?></span>
												</div>
												<div class="o-d-email">
													Thử điện tử: <span><?php echo $order->rc_email ?></span>
												</div>
												<div class="o-d-note">
													Ghi chú: <span><?php echo $order->rc_note ?></span>
												</div>
											</div>
										</div>
									<?php } else { ?>
										<p class="text-center">Không có dữ liệu!!</p>
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