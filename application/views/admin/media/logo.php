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
			        			<h1 class="h3 display">LOGO & HÌNH ẢNH</h1>
			        		</div>
			        	</div>
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/newicon'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>			        			
			        			<a href="/admin/help-newicon" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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

		              	<div class="card-header">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<h4><i class="fa fa-folder-open"> <a href="/admin/images" style="text-decoration: none;" title="Về thư mục ảnh gốc">Thư mục</a>: <?php echo $path; ?></i></h4>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div>
										<label class="btn btn-default btn-add pointer" title="Tạo thư mục mới" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"> Tạo thư mục</i></label>
									</div>									
									<div style="display:block;">
										<form name="frmUploadImage" id="frmUploadImage" method="post" enctype="multipart/form-data">
											<input type="file" name="uploadimg[]" id="up_img" accept="image/*" multiple />
											<input type="hidden" name="submitimg" value="upload">
											<label class="btn btn-default btn-add pointer" title="Tải hình lên thư mục" onclick="SubmitFrm('frmUploadImage');" ><i class="fa fa-cloud-upload"></i> Tải hình</label>
										</form>	
									</div>									
								</div>
							</div>							
						</div>


		                <div class="card-body">				

		                  <?php if($list_images){ ?>
							<div class="row d-flex align-items-stretch">
								<?php foreach ($list_images as $key => $value) { ?>
									<?php if($value['type'] == 'Folder') { ?>
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6"  style="margin-bottom: 2%; display: block;">
										<!-- <div class="btn pointer" onclick="DeleteObject('<?php echo $value['path']; ?>', 1);" style="position: absolute;" title="Xóa thư mục"><img src="/templates/images/admin/icon_del.png" style="width:70%;"></div> -->
							            <!-- Income-->
							            <div class="wrapper income text-center"><span>Thư mục</span>
							            	<a href="/admin/images?pa=<?php echo $path; ?>&dir=<?php echo $value['name']; ?>"><img src="/templates/images/admin/icon_folder.png" alt="Thư mục" style="height: 60px; width: 65px;">
											<span><?php echo $value['name']; ?></span>
											</a>
						             	</div>
						             	<input type="hidden" name="path_obj" value="<?php echo $value['path']; ?>">
						            </div>
						            <?php } else { ?>
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 2%; display: block;">
										<!-- <div class="btn pointer" onclick="DeleteObject('<?php echo $value['path']; ?>', 0);" style="position: absolute;" title="Xóa tập tin"><img src="/templates/images/admin/icon_del.png" style="width:70%;"></div> -->
							            <!-- Income-->
							            <div class="wrapper income text-center"><span>Tập tin</span>
							            	<a href="<?php echo '/'.$value['path']; ?>">
							            	<img src="<?php echo '/'.$value['path']; ?>" alt="<?php echo $value['name']; ?>" style="height:60px; width:65px;"></a>
							            	<span><?php echo $value['name']; ?></span>
						             	</div>
						             	<input type="hidden" name="path_obj" value="<?php echo $value['path']; ?>">
						            </div>
						            <?php } ?> 
					            <?php } ?>
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

      	<!-- Modal -->
	    <div class="modal fade" id="myModal" role="dialog">
	        <div class="modal-dialog">        
	          <!-- Modal content-->
	          <div class="modal-content">
	            <form name="frmCreateFolder" id="frmCreateFolder" action="#" method="post">
	                <div class="modal-header">
	                	<h4 class="modal-title">Tạo thư mục mới</h4>
	                  	<button type="button" class="close" data-dismiss="modal">&times;</button>
	                </div>
	                <div class="modal-body">
	                  	<p>Nhập tên thư mục bạn muốn tạo:<span style="color: red;"> * </span></p>
	                  	<div style="margin-bottom: 25px" class="input-group">
	                    	<span class="input-group-addon"><i class="fa fa-folder-open-o"></i></span>
	                    	<input type="text" class="form-control" name="namedirectories" id="namedirectories" placeholder="Tên thư mục mới" required>                                                                          
	                	</div>
	                </div>
	                <div class="modal-footer">
	                	<input type="hidden" name="parent" id="parent" value="<?php echo $path; ?>">
	                    <input type="submit" class="btn btn-default" onclick="CreateDirectory();" value="Tạo thư mục" />
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
	                </div>
	            </form>  
	          </div>
	          
	        </div>
	    </div>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->

    </div>

<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    