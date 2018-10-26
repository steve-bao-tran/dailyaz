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
						<h2><span class="content-title">Thanh toán đơn hàng</span></h2>
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

						<div class="col-lg-12 col-xs-12">
							<div class="show-cart">
								<?php 
									$cart = $this->session->userdata('cart');
									if (empty($cart)) { $cart = array();}
								 ?>

								<div class="panel panel-default info-right">
									<div class="panel-heading" style="background:#337ab7">
										<span class="title-uppercase" style="font-weight: bold; color: #fff;">Thông tin đơn hàng của bạn</span>
									</div>

									<div class="panel-body">
										
										<div class="table-responsive">

						                    <table >
							                    <thead style="border-bottom: 1px solid #ddd;">
							                        <tr >
							                          	<th class="hidden-xs" width="5%">#</th>
							                          	<th width="60%">Sản phẩm</th>
							                          	<th width="10%">Số lượng</th>       	
							                          	<th width="20%">Giá bán</th>
							                          	<th width="30%">Thành tiền</th>
							                        </tr>
							                    </thead>

							                    <tbody style="border-top: 2px solid #ddd;">
													<?php if($this->session->userdata('cart')) { ?>
														<?php $k = 0; $money = 0; ?>
								                        <?php foreach($cart as $ic => $itemc) { ?>
								                        <?php 
								                        	$k += 1;
								                        	$money += ($itemc['quantityc'] * $itemc['pricec']);
								                         ?>
								                        <tr style="border-top: 2px solid #ddd;">	
								                          	<th scope="row"><?php echo $k; ?></th>

								                          	<td>
																<img src="<?php echo ($itemc['imagec'] != '' && file_exists('media/images/product/'. $itemc['dirc'] .'/thumbnail_75_'. $itemc['imagec'])) ? 'media/images/product/'. $itemc['dirc'] .'/thumbnail_75_'. $itemc['imagec'] : 'media/images/default/no_image.jpg' ?>" title="Ảnh minh họa sản phảm" alt="<?php echo $itemc['namec'] ?>">
								                          		<a href="<?php echo base_url() .'san-pham/'. $itemc['idc'] .'-'. RemoveSign($itemc['namec']); ?>" title="Đến chi tiết sản phảm"><?php echo $itemc['namec']; ?></a>
								                          	</td>

								                          	<td> 
								                          		<span class="quantity"><?php echo $itemc['quantityc']; ?></span>
								                          	</td>

								                          	<td>
								                          		<span class="price" style="font-weight: bold;"><?php echo number_format($itemc['pricec'], 0, '.','.'); ?>đ</span>
								                          	</td>

								                          	<td>     		
								                          		<span class="price" style="color:red; font-weight: bold;"><?php echo number_format($itemc['pricec'] * $itemc['quantityc'], 0, '.','.'); ?>đ</span>
								                          	</td>
								                        </tr>	                 
														<?php } ?>
														<hr>
														<tr style="border-top: 1px solid #ddd;">
															<td colspan="6">
																<label class="pull-right" style="background:#f5f5f5;">Tổng tiền: <span class="price" style="color:red; font-weight: bold;"><?php echo number_format($money, 0, '.','.') ?>đ</span></label>
															</td>		
														</tr>
														<tr>
															<td colspan="3">
																<a href="<?php echo base_url() .'danh-muc'; ?>" class="btn btn-info">Tiếp tục mua hàng</a>
															</td>
															<td colspan="3">
																<a href="<?php echo base_url() .'gio-hang'; ?>" class="btn btn-info pull-right"><i class="fa fa-angle-double-left"></i> Trở lại giỏ hàng</a>
															</td>
														</tr>
														
													<?php } else { ?>
							                        <tr>
							                          	<td colspan="6"><span>Không có dữ liệu</span></td>
							                        </tr>
							                        <?php } ?>
							                        
							                    </tbody>

						                    </table>

						                </div>						            	

									</div>
								</div>

								<!-- <hr> -->		
								
								<div class="panel panel-default info-right">
									<div class="panel-heading" style="background:#337ab7">
										<span class="title-uppercase1" style="font-weight: bold; color: #fff;"><i class="fa fa-map-marker"></i> Thông tin người nhận</span>
									</div>

									<div class="panel-body">
										<form name="frmOrder" id="frmOrder" action="<?php echo base_url() ?>showcart/order" method="post">
											<span style="color: #c9141b; font-weight: bold;">(*) Thông tin bắt buộc</span>

											<?php if (isset($createacc) && $createacc == true) { ?>
												<div class="form-group">
													<div class="row" style="padding-right: 15px; padding-left: 15px;">
														<div class="col-lg-6 col-xs-12" style="padding-right: 5px;">
															<label for="chusername"><span style="color: #c9141b; font-weight: bold;">*</span> Tên đăng nhập</label>
											    			<input type="text" class="form-control" name="chusername" id="chusername" placeholder="Nhập tên đăng nhập..." required>
														</div>

														<div class="col-lg-6 col-xs-12" style="padding-left: 5px;">
															<label for="chpassword"><span style="color: #c9141b; font-weight: bold;">*</span> Mật khẩu</label>
											    			<input type="password" class="form-control" name="chpassword" id="chpassword" placeholder="Nhập mật khẩu..." required>
														</div>
													</div>
													
												</div>
											<?php } ?>

											<div class="form-group">
												<label for="chfullname"><span style="color: #c9141b; font-weight: bold;">*</span> Họ & Tên</label>
											    <input type="text" class="form-control" name="chfullname" id="chfullname" placeholder="Nhập họ tên người nhận..." required>
											</div>

											<div class="form-group">
												<label for="chaddress"><span style="color: #c9141b; font-weight: bold;">*</span> Địa chỉ</label>
											    <input type="text" class="form-control" name="chaddress" id="chaddress" placeholder="Nhập địa chỉ người nhận..." required>
											</div>

											<div class="form-group">
												<label for="chmobile"><span style="color: #c9141b; font-weight: bold;">*</span> Số điện thoại</label>
											    <input type="text" class="form-control" name="chmobile" id="chmobile" placeholder="Nhập số điện thoại người nhận..." required>
											</div>

											<div class="form-group">
												<label for="chemail">Thư điện tử</label>
											    <input type="text" class="form-control" name="chemail" id="chemail" placeholder="Nhập thư điện tử người nhận...">
											</div>

											<div class="form-group">
												<label for="chnote">Ghi chú</label>
											    <textarea class="form-control" name="chnote" id="chnote" placeholder="Nhập ghi chú..."></textarea>
											</div>

											<div class="form-group">
												<p><small><span>Vui lòng kiểm tra thông tin người nhận chính xác. Phí ship hàng có thể tham khảo <a href="<?php echo base_url() ?>tham-khao-phi-giao-hang" target="_blank">tại đây</a>.</span></small></p>
												<input type="hidden" name="createacc" id="createacc" value="<?php echo (isset($createacc) && $createacc == true) ? 1 : 0; ?>">
												<button type="submit" name="makeorder" class="btn btn-primary">Đặt hàng</button>
												<button type="reset" class="btn btn-default">Nhập lại</button>
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