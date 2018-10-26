<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->	
	<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/smart_resize_image.function.php"; ?>
	
	<div id="stl-body" class="container">
	    <div class="row">
			
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/block_breadcrumb'); ?>
			<!-- END:SLIDE SITE -->	

	        <div id="stl-content" class="col-lg-12 col-xs-12">
	        	
				<div class="usercontent">
					<div class="content-header">
						<h2><span class="content-title"><?php echo $show_title ?></span></h2>
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
							<div class="panel panel-default info-left" style="background:#f5f5f5;">
								<div class="panel-heading" style="text-align: center;"><h4>Công cụ lọc sản phẩm</h4></div>
								<div class="panel-body">
									
								</div>
							</div>
						</div>

						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<div class="info-right" style="border-radius: inherit;">	
								<div class="category-header">
									<div class="sort" style="padding-bottom: 5px;">
							            <form class="frmSort" method="post">
							            	<input type="checkbox" class="cbpmt" value="1" name="promt"> Đang khuyến mãi &nbsp;  &nbsp;
											<i class="fa fa-sort"></i> Sắp xếp 
											<select name="psort" id="sort_product" class="inputbox" onchange="document.location.href = this.value;">
												<option value="<?php echo base_url() .'danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name) ?>">Chọn</option>
											 	<option value="<?php echo base_url() .'danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name) .'/sap-xep/moi-nhat' ?>">Mới nhất</option>
											 	<option value="<?php echo base_url() .'danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name) .'/sap-xep/cu-nhat' ?>">Cũ nhất</option>
											 	<option value="<?php echo base_url() .'danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name) .'/sap-xep/gia-tang' ?>">Giá tăng dần</option>
											 	<option value="<?php echo base_url() .'danh-muc/'. $cate->cat_id .'-'. RemoveSign($cate->cat_name) .'/sap-xep/gia-giam' ?>">Giá giảm dần</option>
											</select>
										</form>
							        </div>
								</div>

								<div class="category-body">
									<div class="productList">
										<?php if (count($cat_pro) > 0) { ?>
										<?php foreach ($cat_pro as $key => $value) { ?>
											<?php 
												$image = 'media/images/default/no_image.png';
												if ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/'. explode(',', $value->pro_image)[0])) {
													$image = 'media/images/product/'. $value->pro_dir .'/'. explode(',', $value->pro_image)[0];
												}
												
												$resized174 = 'media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0];

												if ($value->pro_image != '' && ! file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0])) {
													smart_resize_image($image, null, 174, 174, false, $resized174, false , false ,100);
												}
											?>

											<div class="item col-xs-6 col-sm-4 col-md-3">
										    	<div class="i">
										    		<a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" class="view">Xem ngay</a>
										    	</div>
										        <div class="thumb" id="thumb-img">
										        	<?php if ($value->pro_saleoff == 1) { ?>
										        		<span class="icon saleoff"><?php echo $value->pro_percent ?>%</span>
										        	<?php } ?>
										        	<?php if (round((time() - strtotime($value->pro_createdate))/604800) <= 7) { ?>
										            	<span class="icon new">New</span>
										            <?php } ?>
										            <?php if (false) { ?>
							            				<span class="gift"></span>
							            			<?php } ?>
									            	<a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" title="<?php echo $value->pro_name ?>">
									                	<img src="<?php echo base_url() . $resized174 ?>" border="0" alt="<?php echo $value->pro_name ?>">
									            	</a>
										        </div>

										        <div class="bt-item">
										            <h4><a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>"><?php echo $value->pro_name ?></a></h4>
										            <a href="javascript:void(0)" class="like fancybox1 fancybox.iframe1" onclick="addFav(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thích</a>
										            <span class="comment1"><?php echo '('. $value->pro_view .') Lượt xem'; ?></span>
										            <div class="info">
										            	<?php if ($value->pro_instock > 0) { ?>
											            	<?php if ($value->pro_saleoff == 1) { ?>
											            		<del><?php echo number_format($value->pro_cost, 0, '.','.'); ?></del>
											            	<?php } ?>
										               		<span class="price"><?php echo ($value->pro_saleoff == 1) ? number_format($value->pro_cost - $value->DISCOUNT, 0, '.','.') : number_format($value->pro_cost, 0, '.','.'); ?>đ</span>	
										               		<a href="javascript:void(0)" class="cart" onclick="addCart(<?php echo $value->pro_id ?>);"></a>
										               	<?php } else { ?>
										               		<a class="notice-btn" href="javascript:void(0)" onclick="notifyMe(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thông báo tôi khi có hàng</a>
										               		<br><b class="red">Hết hàng</b>               
										               	<?php } ?>                
										            </div>
										        </div>
										        <a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" class="bg-hover"></a>
											</div>
										<?php } ?>
										<?php } else { ?>
											<div class=""><p class="bg-info">Không có dữ liệu...</p></div>
										<?php } ?>
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

	<?php $this->load->view('account/common/popup'); ?>
	
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