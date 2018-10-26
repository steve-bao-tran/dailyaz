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
						<h2><span class="content-title">Sản phẩm xem gần đây</span></h2>
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
									<li class="li6 li-active"><a href="<?php echo base_url() ?>tai-khoan/san-pham-xem"><i class="fa fa-eye"></i>  Sản phẩm vừa xem </a><i class="fa fa-angle-double-right pull-right"></i></li>
									<li class="li7"><a href="<?php echo base_url() ?>tai-khoan/don-hang"><i class="fa fa-cart-plus"></i>  Đơn hàng của tôi</a></li>
									<li class="li8"><a href="<?php echo base_url() ?>tai-khoan/dang-xuat"><i class="fa fa-sign-out"></i>  Đăng xuất</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

							<div class="panel panel-default info-right" style="border-radius: inherit;">
								<div class="panel-heading"><span class="title-uppercase">Sản phẩm xem gần đây</span><span class="pull-right total-viewed" style="font-size: 15px;"></span></div>
								<div class="panel-body">									
									<div class="productFavList">
										<?php if ($pro_view) { ?>
											<?php foreach ($pro_view as $key => $value) { $key++; ?>

												<div class="item row">
											        <div class="thumb col-sm-4">
											            <a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name) ?>" title="<?php echo $value->pro_name ?>">
											                <img src="<?php echo ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0])) ? 'media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0] : 'media/images/default/no_image.jpg' ?>" border="0" alt="<?php echo $value->pro_name ?>">
											            </a>
											        </div>
											        
											        <div class="col-sm-4 info">
											            <h4><a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name) ?>" target="_blank"><?php echo $value->pro_name ?></a></h4>
											            <a href="javascript:void(0)" class="like fancybox fancybox.iframe" onclick="addFav(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thích</a>
											            <span class="comment1">(<?php echo $value->pro_view; ?>) Lượt xem</span>
											            <div class="price-info">
											               <span class="price"><?php echo ($value->pro_saleoff == 1) ? number_format($value->pro_cost - $value->DISCOUNT, 0, '.','.') : number_format($value->pro_cost, 0, '.','.'); ?>đ</span>            
											            </div>
											            <a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name) ?>" class="view" target="_blank">Xem chi tiết sản phẩm</a>
											        </div>
											        <div class="col-sm-4 r-button">	
										            	<?php if ($value->pro_instock > 0) { ?>
										            		<input type="submit" value="Thêm vào giỏ hàng" class="button_2" onclick="addCart(<?php echo $value->pro_id; ?>);">
										            	<?php } else { ?>
										            		<input type="submit" value="Hết hàng" class="btn btn-default">
										            	<?php } ?>
											        </div>
												</div>
											<?php } ?>
										<?php } else { ?>
											<p class="text-center">Bạn chưa xem sản phẩm nào !!</p>
										<?php } ?>

										<br class="break">
										
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

	<div id="showloading">
		<div class="loading_bg"></div>
		<span class="loading" style="display: none;"><i class="fa fa-circle-o-notch fa-spin"></i></span>
		<div class="showmsg"></div>
	</div>

	<script>
		$(document).ready(function($) {
			var toview = 'Tổng: '+<?php echo $key ? $key : 0; ?>+' sản phẩm đã xem';
			$('.total-viewed').html(toview);
		});
	</script>
	
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