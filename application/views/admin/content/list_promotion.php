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
			        			<h1 class="h3 display">Danh sách bài viết khuyến mãi</h1>
			        		</div>
			        	</div>
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="/admin/add-content" class="btn btn-outline-success" title="Thêm nội dung"><i class="fa fa-plus"></i> Thêm</a>
			        			<a href="/admin/excel-content" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-content" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                          <th>Tiêu đề</th>
		                          <th>Loại / Danh mục</th>
		                          <th>Ngày tạo / Ngày sửa</th>
		                          <th>Lượt xem / Lượt quan tâm</th>
		                          <th>ID</th>
		                          <th>Trạng thái</th>
		                          <th>Xóa</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_promotion) > 0) { ?>
		                        <?php foreach($list_promotion as $key => $value) { ?>
		                        <tr>
		                          <th scope="row"><?php echo $key+1; ?></th>

		                          <td><a href="/admin/edit-content/<?php echo $value->con_id; ?>" title="Sửa bài viết"><?php echo $value->con_title; ?></a></td>

		                          <td><p>
		                          	<?php if ($value->con_type == 1) {
		                          			$type = 'Bài viết thường';
		                          		} elseif ($value->con_type == 2) {
		                          			$type = 'Bài viết blogs';
		                          		} elseif ($value->con_type == 3) {
		                          			$type = 'Bài viết khuyến mãi';
		                          		} else {
		                          			$type = 'Bài viết hướng dẫn';
		                          		}
		                          	?>
		                          	<?php echo $type; ?>
		                          </p></td>

		                          <td><p><?php echo $value->con_createdate; ?> / <?php echo $value->con_editdate; ?></p></td>

		                          <td><?php echo $value->con_view; ?> / <?php echo $value->con_interesting; ?></td>

		                          <td><?php echo $value->con_id; ?></td>
									
								  <td><?php if($value->con_publish == 1){ ?>
										<span class="btn btn-cursor btn-active" onclick="ActiveContent(<?php echo $value->con_id ?>, 0);" title="Ngừng kích hoạt"><i class="fa fa-check"></i></span>
							      	  <?php } else { ?>
										<span class="btn btn-cursor btn-unactive" onclick="ActiveContent(<?php echo $value->con_id ?>, 1);" title="Kích hoạt"><i class="fa fa-times"></i></span>	
							      	  <?php } ?>							      	
							      </td>

							      <td><button type="submit" class="btn-del" title="Xóa bài viết" onclick="DeleteContent(<?php echo $value->con_id ?>);"><i class="fa fa-trash"> </i></button></td>

		                        </tr>
								<?php } ?>
								<?php } else { ?>
		                        <tr>
		                          <td colspan="8"><span>Không có dữ liệu</span></td>
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