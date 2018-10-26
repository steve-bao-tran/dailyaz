<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->
	<link href="<?php echo base_url() ?>templates/css/detail.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url() ?>templates/css/jquery.jqzoom.css" rel="stylesheet" type="text/css" />	

	<div id="stl-body" class="container">
	    <div class="row">
			
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/block_breadcrumb'); ?>
			<!-- END:SLIDE SITE -->	

	        <div id="stl-content" class="col-lg-12 col-xs-12">
	        	
				<div class="usercontent">
					
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
							<div class="productcontent">
							<?php if ($pro_viewed) { ?>

							<div class="productList" itemscope="" itemtype="http://schema.org/Product">
							   	
								<?php foreach ($pro_viewed as $kpv => $vpv) { ?>
								<?php 
									$image = 'media/images/default/no_image.jpg';
									if ($vpv->pro_image != '' && file_exists('media/images/product/'. $vpv->pro_dir .'/thumbnail_174_'. explode(',', $vpv->pro_image)[0])) {
										$image = 'media/images/product/'. $vpv->pro_dir .'/thumbnail_174_'. explode(',', $vpv->pro_image)[0];
									}
								 ?>									
								
								<div class="item col-xs-6 col-sm-4 col-md-3">
									<div class="i">
										<a href="<?php echo base_url() .'san-pham/'. $vpv->pro_id .'-'. RemoveSign($vpv->pro_name); ?>" class="view">Xem ngay</a>
									</div>
							    	
									<div class="thumb" id="thumb-img">
							        	<?php if ($vpv->pro_saleoff == 1) { ?>
							        		<span class="icon saleoff"><?php echo $vpv->pro_percent ?>%</span>
							        	<?php } ?>
							        	<?php if (round((time() - strtotime($vpv->pro_createdate))/604800) <= 7) { ?>
							            	<span class="icon new">New</span>
							            <?php } ?>
							            <?php if (false) { ?>
							            	<span class="gift"></span>
							            <?php } ?>
						            	<a href="<?php echo base_url() .'san-pham/'. $vpv->pro_id .'-'. RemoveSign($vpv->pro_name); ?>" title="<?php echo $vpv->pro_name ?>">
						                	<img src="<?php echo base_url() . $image ?>" border="0" alt="<?php echo $vpv->pro_name ?>">
						            	</a>
							        </div>

							        <div class="bt-item">
							            <h4><a href="<?php echo base_url() .'san-pham/'. $vpv->pro_id .'-'. RemoveSign($vpv->pro_name); ?>"><?php echo $vpv->pro_name ?></a></h4>
							            <a href="javascript:void(0)" class="like fancybox1 fancybox.iframe1" onclick="addFav(<?php echo $vpv->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thích</a>
							            <span class="comment1"><?php echo '('. $vpv->pro_view .') Lượt xem'; ?></span>
							            <div class="info">
							            	<?php if ($vpv->pro_instock > 0) { ?>
								            	<?php if ($vpv->pro_saleoff == 1) { ?>
								            		<del><?php echo number_format($vpv->pro_cost, 0, '.','.'); ?></del>
								            	<?php } ?>
							               		<span class="price"><?php echo ($vpv->pro_saleoff == 1) ? number_format($vpv->pro_cost - $vpv->DISCOUNT, 0, '.','.') : number_format($vpv->pro_cost, 0, '.','.'); ?>đ</span><a href="javascript:void(0)" class="cart" onclick="addCart(<?php echo $vpv->pro_id ?>);"></a>
							               	<?php } else { ?> 
							               		<a class="notice-btn" href="javascript:void(0)" onclick="notifyMe(<?php echo $vpv->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thông báo tôi khi có hàng</a><br><b class="red">Hết hàng</b>               
							               	<?php } ?>                
							            </div>
							        </div>
							        <a href="<?php echo base_url() .'san-pham/'. $vpv->pro_id .'-'. RemoveSign($vpv->pro_name); ?>" class="bg-hover"></a>
								</div>

								<?php } ?>	


							</div>							
							
							<?php } else { ?>
								<div>Đang cập nhật</div>
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