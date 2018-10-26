<div class="block-5">
	<div class="container">
		<div class="row">
			<div class="blocksocial col-sm-5">
				<div class="b-content">
					<p><a target="_blank" href="<?php echo (isset($infous->info_facebook) && $infous->info_facebook != '') ? $infous->info_facebook : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/l-facebook.png" alt="Facebook" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_googleplus) && $infous->info_googleplus != '') ? $infous->info_googleplus: ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/l-googleplus.png" alt="Google+" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_twitter) && $infous->info_twitter != '') ? $infous->info_twitter : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/l-twitter.png" alt="Twitter" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_youtube) && $infous->info_youtube != '') ? $infous->info_youtube : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/l-youtube.png" alt="Youtube" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_linkin) && $infous->info_linkin != '') ? $infous->info_linkin : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/l-in.png" alt="In" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_pinterest) && $infous->info_pinterest != '') ? $infous->info_pinterest : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/l-pinterest.png" alt="Pinterest" />
						</a>
					</p>
				</div>
			</div>

			<div class="blocknewsletter col-sm-7">
				<div class="b-content">
					<div class="b-newsletter">
						<div class="title col-sm-4">Đăng ký nhận bản tin &nbsp;</div>
    					<div class="col-sm-8 no-pad-r">
    						<div class="box">
    							<form action="<?php echo base_url() ?>user/subscribe" method="post" class="validateformsubscribe">        
            						<input type="text" name="registeremail" class="inputbox" placeholder="Email của bạn..." />            						
            						<input type="submit" class="button" />
							    </form>
							</div>
     					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>