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
			        			<h1 class="h3 display">Danh sách danh mục</h1>
			        		</div>
			        	</div>
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="/admin/add-category" class="btn btn-outline-success" title="Thêm chuyên mục"><i class="fa fa-plus"></i> Thêm</a>
			        			<a href="/admin/excel-category" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-category" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                  <div class="table-responsive">
		                    <table class="table table-striped table-hover table-custom">
		                      <thead>
		                        <tr>
		                          <th>#</th>
		                          <th>Ảnh / Danh mục</th>
		                          <th>ID</th>
		                          <th>Trạng thái</th>
		                          <th>Xóa</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_category) > 0) { ?>
		                        <?php foreach($list_category as $key => $value) { ?>
		                        <tr>
		                          <th scope="row"><?php echo $key+1; ?></th>

		                          <td>
		                          	<div class="row">
		                          		<div class="col-lg-6 col-xs-12">
		                          			<div>Hình cho menu</div>
		                          			<?php if($value->cat_image != '') { ?>
				                          		<img src="media/images/category/<?php echo $value->cat_image; ?>" alt="<?php echo $value->cat_name; ?>" style="width:20%; height: auto;">
				                          	<?php } else { ?>
				                          		<img src="media/images/default/no_image.jpg" alt="<?php echo $value->cat_name; ?>" style="width:20%; height: auto;">
				                          	<?php } ?>
		                          		</div>
		                          		<div class="col-lg-6 col-xs-12">
		                          			<div>Hình trang chủ</div>
		                          			<?php if($value->cat_image1 != '') { ?>
				                          		<img src="media/images/category/<?php echo $value->cat_image1; ?>" alt="<?php echo $value->cat_name; ?>" style="width:50%; height: auto;">
				                          	<?php } else { ?>
				                          		<img src="media/images/default/no_image.jpg" alt="<?php echo $value->cat_name; ?>" style="width:50%; height: auto;">
				                          	<?php } ?>
		                          		</div>
		                          	</div>  
		                          	<p><a href="/admin/edit-category/<?php echo $value->cat_id; ?>" title="Sửa danh mục"><?php echo $value->cat_name; ?></a></p>
		                          </td>

		                          <td><?php echo $value->cat_id; ?></td>
									
								  <td><?php if($value->cat_publish == 1){ ?>
										<span class="btn btn-cursor btn-active" onclick="ActiveCategory(<?php echo $value->cat_id ?>, 0);" title="Ngừng kích hoạt"><i class="fa fa-check"></i></span>
							      	  <?php } else { ?>
										<span class="btn btn-cursor btn-unactive" onclick="ActiveCategory(<?php echo $value->cat_id ?>, 1);" title="Kích hoạt"><i class="fa fa-times"></i></span>	
							      	  <?php } ?>							      	
							      </td>

							      <td><button type="submit" class="btn-del" title="Xóa danh mục" onclick="DeleteCategory(<?php echo $value->cat_id ?>);"><i class="fa fa-trash"> </i></button></td>

		                        </tr>
								<?php } ?>
								<?php } else { ?>
		                        <tr>
		                          <td colspan="7"><span>Không có dữ liệu</span></td>
		                        </tr>
		                        <?php } ?>
		                        
		                      </tbody>
		                    </table>
		                  </div>
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