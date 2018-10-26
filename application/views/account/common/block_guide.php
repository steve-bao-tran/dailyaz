<div class="block-4">
	<div class="container">
		<div class="row">

			<!-- BEGIN: HINH -->
			<?php $this->load->view('account/common/block_promos'); ?>
			<!-- END: HINH -->

			<div class="blockmenu col-sm-3">
				<div class="b-title"><span>Thông tin <?php echo Company; ?></span></div>

				<div class="b-content">
					<ul class="menu">
				        <li><a href="<?php echo base_url(); ?>gioi-thieu">Giới thiệu <?php echo Company; ?></a></li>
				        <li><a href="<?php echo base_url(); ?>tuyen-dung">Tuyển dụng</a></li>
				        <li><a href="<?php echo base_url(); ?>chinh-sach-bao-hanh-va-doi-tra">Chính sách bảo hành và đổi trả</a></li>
				        <li><a href="<?php echo base_url(); ?>chinh-sach-bao-mat">Chính sách bảo mật</a></li>
				        <li><a href="<?php echo base_url(); ?>lien-he">Liên hệ</a></li>
				    </ul>
				</div>
			</div>

			<div class="blockmenu col-sm-3">
				<div class="b-title">
					<span>Hỗ trợ khách hàng</span>
				</div>
				<div class="b-content">
					<ul class="menu">
				        <li><a href="<?php echo base_url(); ?>huong-dan-mua-hang">Hướng dẫn mua hàng</a></li>
			            <li><a href="<?php echo base_url(); ?>huong-dan-doi-tra-hang">Hướng dẫn đổi trả hàng</a></li>
			            <li><a href="<?php echo base_url(); ?>chinh-sach-van-chuyen">Chính sách vận chuyển</a></li>
			            <li><a href="<?php echo base_url(); ?>cau-hoi-thuong-gap">Câu hỏi thường gặp</a></li>
			    	</ul>
				</div>
			</div>

			<div class="blockmenu col-sm-3">
				<div class="b-title"><span>Hợp tác với Lee&Tee</span></div>
				<div class="b-content">
					<ul class="menu">
				        <li><a href="<?php echo base_url(); ?>doi-tac-quang-cao">Đối tác quảng cáo</a></li>
				        <li><a href="<?php echo base_url(); ?>ban-hang-voi-leetee-affiliate">Cộng tác viên bán hàng</a></li>
				        <li><a href="<?php echo base_url(); ?>mo-cua-hang-leetee">Mở cửa hàng</a></li>
				        <li><a href="<?php echo base_url(); ?>thanh-vien-vip">Thành viên</a></li>
				    </ul>
				</div>
			</div>

			<div class="blocksocial col-sm-3">
				<div class="b-title"><span>Kết nối</span></div>
				<div class="b-content">
					<div class="row">
						<div class="col-sm-6">
							<p><a href="<?php echo (isset($infous->info_facebook) && $infous->info_facebook != '') ? $infous->info_facebook : ''; ?>" target="_blank">
								<img style="vertical-align: middle;" src="<?php echo base_url(); ?>templates/images/social/icon-fa.png" /></a>
								<a href="<?php echo (isset($infous->info_facebook) && $infous->info_facebook != '') ? $infous->info_facebook : ''; ?>" target="_blank"> Facebook</a>
							</p>
							<p><a href="<?php echo (isset($infous->info_googleplus) && $infous->info_googleplus != '') ? $infous->info_googleplus: ''; ?>" target="_blank">
								<img style="vertical-align: middle;" src="<?php echo base_url(); ?>templates/images/social/icon-go.png" alt="Google+" /></a> 
								<a href="<?php echo (isset($infous->info_googleplus) && $infous->info_googleplus != '') ? $infous->info_googleplus: ''; ?>" target="_blank">Google+</a>
							</p>
							<p><a href="<?php echo (isset($infous->info_twitter) && $infous->info_twitter != '') ? $infous->info_twitter : ''; ?>" target="_blank">
								<img style="vertical-align: middle;" src="<?php echo base_url(); ?>templates/images/social/icon-twitter.png" alt="Twitter" /></a> 
								<a href="<?php echo (isset($infous->info_twitter) && $infous->info_twitter != '') ? $infous->info_twitter : ''; ?>" target="_blank">Twitter</a>
							</p>
							<p><a href="<?php echo (isset($infous->info_pinterest) && $infous->info_pinterest != '') ? $infous->info_pinterest : ''; ?>" target="_blank">
								<img style="vertical-align: middle;" src="<?php echo base_url(); ?>templates/images/social/icon-pin.png" alt="Pin" /></a> 
								<a href="<?php echo (isset($infous->info_pinterest) && $infous->info_pinterest != '') ? $infous->info_pinterest : ''; ?>" target="_blank">Pinterest</a>
							</p>
						</div>

						<div class="col-sm-6 reg">
							<a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=9429" target="_blank">
								<img src="<?php echo base_url(); ?>templates/images/dang-ky-bo-cong-thuong.jpg" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>