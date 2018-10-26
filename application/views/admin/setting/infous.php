<!-- BEGIN: HEAD COMMON -->
<?php $this->load->view('admin/common/header_common'); ?>
<!-- END: HEAD COMMON -->
    <!-- Side Navbar -->
    <!-- BEGIN: SIDEBAR -->
    <?php $this->load->view('admin/common/sidebar'); ?>
    <!-- END: SIDEBAR -->
    <div class="page">
      	<!-- navbar-->
      	<!-- BEGIN: HEADER -->
      	<?php $this->load->view('admin/common/header'); ?>
      	<!-- END: HEADER -->
     
      	<section>
        	<div class="container-fluid">
	          	<!-- Page Header-->
		        <header>
		        	<div class="row">
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-left">
			        			<h1 class="h3 display">THÔNG TIN CỬA HÀNG</h1>
			        		</div>
			        	</div>
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-right">
			        			<!-- <a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/infous'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a> -->
			        			<a href="/admin/settup-infous" class="btn btn-outline-success" title="Sửa thông tin cửa hàng"><i class="fa fa-pencil-square-o"></i> Sửa</a>			        			
			        			<a href="/admin/help-infous" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
			        		</div>
			        	</div> 
		            </div>
		        </header>
				

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

	          	<div class="row">
		            <div class="col-sx-12 col-lg-12">
		              <div class="card">

		                <div class="card-body">				

		                  <?php if($infous){ ?>
							<div class="row d-flex align-items-stretch">
								
								<div class="user_my_info" style="margin-left: 20px;">

									<div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Hình ảnh:</label>
					                    <div class="col-sm-8">					                    	
					                        <?php if (isset($infous) && $infous->info_image != '' && file_exists('templates/images/'. $infous->info_image)) { ?>
					                        	<img src="<?php echo 'templates/images/'.  $infous->info_image ?>" alt="<?php echo  $infous->info_image ?>">
					                        <?php } else { echo 'Chưa cập nhật'; } ?>

					                    </div>
				                    </div>

									<div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tên công ty:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_name != '') ? $infous->info_name : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tên bí danh:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_aliasname != '') ? $infous->info_aliasname : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Địa chỉ:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_address != '') ? $infous->info_address : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>
									
									<div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Địa chỉ kho hàng:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_depot != '') ? $infous->info_depot : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Mã số thuế:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_tax != '') ? $infous->info_tax : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tài khoản 1:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_bank1 != '') ? $infous->info_bank1 : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tài khoản 2:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_bank2 != '') ? $infous->info_bank2 : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tài khoản 3:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_bank3 != '') ? $infous->info_bank3 : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tài khoản 4:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_bank4 != '') ? $infous->info_bank4 : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Tài khoản 5:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_bank5 != '') ? $infous->info_bank5 : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Thư điện tử:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_email != '') ? $infous->info_email : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Số điện thoại:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_mobile != '') ? $infous->info_mobile : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dây nóng:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_hotline != '') ? $infous->info_hotline : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Về chúng tôi:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_desc != '') ? $infous->info_desc : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn facebook:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_facebook != '') ? $infous->info_facebook : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn message:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_message != '') ? $infous->info_message : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn twitter:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_twitter != '') ? $infous->info_twitter : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn google+:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_googleplus != '') ? $infous->info_googleplus : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn youtube:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_youtube != '') ? $infous->info_youtube : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn pinterest:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_pinterest != '') ? $infous->info_pinterest : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn linkedin:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_linkin != '') ? $infous->info_linkin : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Đường dẫn zalo:</label>
					                    <div class="col-sm-8">
					                        <?php echo (isset($infous) && $infous->info_zalo != '') ? $infous->info_zalo : 'Chưa cập nhật'; ?>
					                    </div>
				                    </div>

									 <div class="form-group row form-group-custom">
				                      	<label class="col-sm-4 form-control-label">Video:</label>
					                    <div class="col-sm-8">
					                        <?php if (isset($infous) && $infous->info_video != '') { ?>
					                        	<iframe width="560" height="315" src="<?php echo $infous->info_video ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					                        <?php } else {  echo 'Chưa cập nhật'; } ?>
					                        	
					                    </div>
				                    </div>

				                    <div class="form-group row form-group-custom">
										<span class="pull-right"><a class="btn btn-default" href="/admin/settup-infous" title="Sửa thông tin">Cập nhật</a></span>
				                    </div>

								</div>
								
							</div>	
		                  <?php } else { ?>
							<div><span>Không có dữ liệu</span></div>
						  <?php } ?>

		                </div>
		              </div>
		            </div>
          		</div>
        	</div>
      	</section>      	

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->

    </div>

<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    