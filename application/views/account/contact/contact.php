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
						<h2><span class="content-title">Liên hệ chúng tôi</span></h2>
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
							<div class="contact-form">								
								<h2 class="text-center"><?php echo ($infous && $infous->info_name != '') ? $infous->info_name : 'Daily Az'; ?></h2>
								<div class="row">                    
						    		<div class="col-sm-6" style="padding-right:10px; padding-left:15px;">
				    		    		<h3>Thông tin liên hệ</h3>
						    		    <table class="table">
							    			<tbody>
							    				<tr>
							    			    	<th>Công ty</th>
							    			    	<td><?php echo ($infous && $infous->info_name != '') ? $infous->info_name : 'Đang cập nhật...'; ?></td>
							    				</tr>
								    			<tr>
								    			    <th>Địa chỉ</th>
								    			    <td><?php echo ($infous && $infous->info_address != '') ? $infous->info_address : 'Đang cập nhật...'; ?></td>
								    			</tr>
								    			<tr>
								    			    <th>Điện thoại</th>
								    			    <td><?php echo ($infous && $infous->info_mobile != '') ? $infous->info_mobile : 'Đang cập nhật...'; ?></td>
								    			</tr>
								    			<tr>
								    			    <th>Hotline</th>
								    			    <td><?php echo ($infous && $infous->info_hotline != '') ? $infous->info_hotline : 'Đang cập nhật...'; ?></td>
								    			</tr>								    			
								    			<tr>
								    			    <th>Email</th>
								    			    <td><?php echo ($infous && $infous->info_email != '') ? '<a href="mailto:'. $infous->info_email .'">'. $infous->info_email .'</a>' : 'Đang cập nhật...'; ?></td>
								    			</tr>
								    			<tr>
								    			    <th>Website</th>
								    			    <td><a href="<?php echo $infous->info_website ?>" target="_blank"><?php echo ($infous && $infous->info_website != '') ? $infous->info_website : 'Đang cập nhật...'; ?></a></td>
								    			</tr>
							    		    </tbody>	
						    			</table>
						    			<h3>Xem bản đồ</h3>
						    			<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.322384009375!2d106.6855093154804!3d10.786601992314637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f2d81374683%3A0x8da8bb8f098d160f!2sAzibai!5e0!3m2!1sen!2s!4v1505190032542" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe> -->
						    			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1954.3157458570904!2d109.00642134603098!3d11.578253616874909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1522125713344" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				    				</div>				    				

				    				<div class="col-sm-6" style="padding-left:10px; padding-right:15px;">
				    		    		<h3>Gửi email cho chúng tôi</h3>
				    		    		<!-- <form name="frmContact" method="post" class="" enctype="multipart/form-data"> -->
					    			 		<!-- <div class="form-group">	    
												(<font color="#FF0000"><b>*</b></font>)&nbsp;&nbsp;Bắt buộc nhập dữ liệu			   
					    					</div>

					    					<div class="form-group">
					    			    		<label class="control-label">
					    			    			<font color="#FF0000"><b>*</b></font> Họ tên</label>
					    						<input type="text" name="name_contact" id="name_contact" value="<?php echo (isset($user) && $user->us_fullname != '') ? $user->us_fullname : ''; ?>" maxlength="80" class="form-control" onfocus="ChangeStyle('name_contact', 1)" onblur="ChangeStyle('name_contact', 2)" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập họ tên của bạn..." required>
					    					</div>

					    					<div class="form-group">
					    			    		<label class="control-label">
					    			    			<font color="#FF0000"><b>*</b></font> Email</label>
					    						<input type="text" name="email_contact" id="email_contact" value="<?php echo (isset($user) && $user->us_email != '') ? $user->us_email : ''; ?>" maxlength="80" class="form-control" onfocus="ChangeStyle('email_contact', 1)" onblur="ChangeStyle('email_contact', 2)" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập thư điện tử của bạn..." required>
					    					</div>

					    					<div class="form-group">
					    			    		<label class="control-label">
					    			    			<font color="#FF0000"><b>*</b></font> Địa chỉ</label>
					    						<input type="text" name="address_contact" id="address_contact" value="<?php echo (isset($user) && $user->us_address != '') ? $user->us_address : ''; ?>" maxlength="200" class="form-control" onfocus="ChangeStyle('address_contact', 1)" onblur="ChangeStyle('address_contact', 2)" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập địa chỉ của bạn..." required>
					    					</div>

					    					<div class="form-group">
					    			    		<label class="control-label">
					    			    			<font color="#FF0000"><b>*</b></font> Điện thoại</label>					    			    
					    						<input type="text" name="phone_contact" id="phone_contact" value="<?php echo (isset($user) && $user->us_mobile != '') ? $user->us_mobile : ''; ?>" maxlength="11" class="form-control" onfocus="ChangeStyle('phone_contact', 1)" onblur="ChangeStyle('phone_contact', 2)" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập số điện thoại của bạn..." required>
										       			    
					    					</div>
					    			
					    					<div class="form-group">
					    			    		<label class="control-label">
					    			    			<font color="#FF0000"><b>*</b></font> Tiêu đề</label>
					    						<input type="text" name="title_contact" id="title_contact" value="" maxlength="200" class="form-control" onfocus="ChangeStyle('title_contact', 1);" onblur="ChangeStyle('title_contact', 2);" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập tiêu đề..." required>
										       			   
					    					</div>

							    			<div class="form-group">
							    			    <label class="control-label"><font color="#FF0000"><b>*</b></font> Nội dung</label>
							    				<textarea name="content_contact" id="content_contact" cols="47" rows="8" class="textarea_form form-control" onfocus="ChangeStyle('content_contact', 1);" onblur="ChangeStyle('content_contact', 2);" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập nội dung bạn muốn gửi..."></textarea>
							    			</div>
									    				
										    <div class="form-group">
											    <label class="control-label">
											    	<font color="#FF0000"><b>*</b></font> Mã xác nhận</label>
												<div class="row"> -->
												    <!-- <div class="col-sm-4" style="padding-left:15px;">
														<img src="<?php echo base_url() . $imageCaptchaContact; ?>" width="151" height="34">
												    </div> -->
												<!-- <div class="g-recaptcha" data-sitekey="6LeKIG0UAAAAAMZQrToeGBfz-HNap06MZXAN39Ix"> -->
												    <!-- </div> -->
												    <!-- <div class="col-sm-8" style="padding-right:15px;">
														<input type="text" name="captcha_contact" id="captcha_contact" class="inputcaptcha_form form-control" onfocus="ChangeStyle('captcha_contact', 1);" onblur="ChangeStyle('captcha_contact', 2);" style="border: 1px solid rgb(204, 204, 204);" placeholder="Nhập mã xác nhận" required>
												    </div> -->
												
												<!-- </div>
												<input type="hidden" id="captcha" name="captcha" value="ASIVHD">												
											</div>	
									    
							    			<div class="form-group">
							    				<input type="submit" value="Gởi đi" class="btn btn-primary">
							    				<input type="reset" value="Nhập lại" class="btn btn-default">
							    			</div>    	
						    				
						    		    </form> -->
										<form name="frmContact" method="post" class="" enctype="multipart/form-data">
											<input type="file" name="images">
											<button type="submit">GỦI</button>
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