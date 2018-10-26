<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->	
	<link href="<?php echo base_url() ?>templates/css/article.list.css" rel="stylesheet" type="text/css" />	
	

	<div id="stl-body" class="container">
	    <div class="row">
			
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/block_breadcrumb'); ?>
			<!-- END:SLIDE SITE -->	

	        <div id="stl-content" class="col-lg-9 col-sm-8 col-xs-12">
	        	
				<div class="usercontent">
					<div class="content-header">
						<?php 
							if ($me_active == 'news') {
								$title_show = 'Tin tức';
							} else if ($me_active == 'blogs') {
								$title_show = 'Blogs';
							} else if ($me_active == 'promo') {
								$title_show = 'Tin khuyến mãi';
							}
						 ?>
						<h2><span class="content-title"><?php echo $title_show ?></span></h2>
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

						<div class="col-lg-12 col-sm-12 col-xs-12" >
							<div  class="S_articleList">
								<?php if ($li_news && count($li_news) > 0) { ?>
									<?php foreach ($li_news as $key => $value) { ?>
										<div class="row item" style="margin-right:15px; margin-left:15px;">
										    <h3>
										    	<a href="<?php echo base_url() .'tin-tuc/'. $value->con_id .'-'. RemoveSign($value->con_title); ?>"><?php echo $value->con_title ?></a>
										    </h3>

										    <div class="date">
										    	<span><?php echo date('d/m/Y', strtotime($value->con_createdate)); ?></span>
										    </div>

										    <div class="thumb col-sm-5">
										        <div class="effect_hover_image">
										        	<a href="<?php echo base_url() .'tin-tuc/'. $value->con_id .'-'. RemoveSign($value->con_title); ?>">
										        		<img src="<?php echo ($value->con_image != '' && file_exists('media/images/content/'. $value->con_image)) ? base_url() .'media/images/content/'. $value->con_image : ''; ?>" border="0" class="imglink" alt="<?php echo $value->con_title ?>">
										        		<span class="hover hover1"></span>
										        		<span class="hover hover2"></span>
										        		<span class="hover hover3"></span>
										        		<span class="hover hover4"></span>
										        	</a>
										        </div>
										    </div>

										    <div class="intro col-sm-7">
										        <p><?php $vovel = array("&curren;"); echo html_entity_decode(str_replace($vovel, "#", $value->con_intro)); ?></p>
										        <br>
										        <a href="<?php echo base_url() .'tin-tuc/'. $value->con_id .'-'. RemoveSign($value->con_title); ?>">
										        	<button class="btn btn-default" type="button">Xem thêm...</button>
										        </a>
										    </div>
										</div>
									<?php } ?>
								<?php } else { ?>
									<p>Đang cập nhật...</p>
								<?php } ?>
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