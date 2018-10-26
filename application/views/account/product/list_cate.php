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
						<h2><span class="content-title">Danh mục sản phẩm</span></h2>
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
								<?php if ($list_cate) { ?>
									<?php foreach ($list_cate as $key => $value) { ?>	
										<div class="item col-sm-4">
									    	<div class="thumb">
									        	<a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>" title="<?php echo $value->cat_name; ?>">
									        		<img src="<?php echo ($value->cat_image1 != '') ? base_url() .'media/images/category/'. $value->cat_image1 : base_url() .'media/images/default/no_image.jpg'; ?>" alt="<?php echo $value->cat_name; ?>" border="0" class="imglink">
									        	</a>
									    	</div>
									        <a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>" title="<?php echo $value->cat_name; ?>"><h3><?php echo $value->cat_name . ' ('. $value->total .' sản phẩm)'; ?></h3></a>
									   </div>
									<?php } ?>
									
								<?php } else { ?>								
									<div class=""><p class="bg-info">Đang cập nhật...</p></div>
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