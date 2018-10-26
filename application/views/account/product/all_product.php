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
						<h2><span class="content-title">Tất cả sản phẩm</span></h2>
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
							<div class="product-cat-list">
								<?php if (count($all_pro) > 0) { ?>
									<?php foreach ($all_pro as $key => $value) { ?>
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

										<div class="item col-xs-6 col-sm-3 col-md-2">
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
									<div class=""><p class="bg-info">Không có sản phẩm nào...</p></div>
								<?php } ?>
							</div>
							<style>
								div#pagination {text-align: center;}
								#pagination ul {list-style-type: none;margin: 0;padding: 0;}
								#pagination ul li {display: inline-table;list-style-type: none;margin: 0; padding: 0;}
								#pagination > ul > li > a, li > strong {text-decoration: none; border: 1px solid #333;    border-radius: 3px; padding: 6px 20px; margin-left: 1px; margin-right: 1px;}
								#pagination > ul > li > a, li > strong {text-decoration: none;border: 1px solid #333;    border-radius: 3px;padding: 6px 20px;margin-left: 1px;margin-right: 1px;}
							</style>

							<?php if(isset($page) && !empty($page)){ ?>	
								<div class="col-sm-12" style="text-align: center;">
									<?php echo $page; ?>
								</div>				
							<?php } ?>
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