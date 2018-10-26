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
						<h2><span class="content-title">Giỏ hàng của bạn</span></h2>
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
								<?php if($this->session->userdata('cart')) { ?>
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
							                          	<th width="15%">Số lượng</th>       	
							                          	<th width="10%">Giá bán</th>
							                          	<th width="15%">Thành tiền</th>
							                          	<th width="5%">Xóa</th>
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
								                          		<div class="quantity" id="quantity_<?php echo $itemc['idc'] ?>" >
									                          		<span class="quan_add pointer" id="quan_sub_<?php echo $itemc['idc'] ?>" onclick="updateCart(<?php echo $itemc['idc'] ?>, -1);">-</span>
									                          		<input type="text" name="qty_<?php echo $itemc['idc'] ?>" class="qty" id="qty_<?php echo $itemc['idc'] ?>" value="<?php echo $itemc['quantityc']; ?>" onblur="updateCart(<?php echo $itemc['idc']; ?>, 0);">
									                          		<span class="quan_add pointer" id="quan_add_<?php echo $itemc['idc'] ?>" onclick="updateCart(<?php echo $itemc['idc'] ?>, 1);">+</span>	
									                          		<input type="hidden" name="pid" value="<?php echo $itemc['idc'] ?>">
								                          		</div>
								                          	</td>

								                          	<td>
								                          		<span class="price" style="font-weight: bold;"><?php echo number_format($itemc['pricec'], 0, '.','.'); ?>đ</span>
								                          	</td>

								                          	<td>     		
								                          		<span class="price" style="color:red; font-weight: bold;"><?php echo number_format($itemc['pricec'] * $itemc['quantityc'], 0, '.','.'); ?>đ</span>
								                          	</td>
														  
														  	<td>		
														  		<button type="button" title="Xóa khỏi giỏ hàng" onclick="delCart(<?php echo $itemc['idc']; ?>);" class="btn button-delete btn-sm">Xóa</button>
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
																<a href="<?php echo base_url() .'dat-hang'; ?>" class="btn btn-info pull-right">Thanh toán</a>
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
								<?php } else { ?>

								<div class="col-xs-12">
                                    <div class="alert-warning" role="alert" style="padding:15px; border-radius: 3px;">Không có sản phẩm nào trong giỏ hàng của bạn! Vui lòng trở lại <a href="<?php echo base_url() ?>">trang chủ </a> tìm sản phẩm và chọn thêm vào giỏ hàng!
                    				</div>
                                </div>	
								<?php } ?>

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