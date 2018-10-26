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
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-left">
			        			<h1 class="h3 display">Danh sách thuộc tính phong cách</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="/admin/add-style" class="btn btn-outline-success" title="Thêm phong cách"><i class="fa fa-plus"></i> Thêm</a>
			        			<a href="/admin/excel-style" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-style" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                          <th>Hình / Tên</th>
		                          <th>Đường dẫn</th>		                          
		                          <th>Ngày tạo / Ngày sửa</th>      
		                          <th>ID</th>
		                          <th>Trạng thái</th>
		                          <th>Xóa</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_style) > 0) { //$stt = 0; ?>
		                        <?php foreach($list_style as $key => $value) { //$stt++; ?>
		                        <tr>
		                          <th scope="row"><?php echo $key+1; ?></th>

		                          <td>
		                          	<?php if ($value->sty_image != '') { ?>
		                          		<img src="media/images/style/<?php echo $value->sty_image; ?>" alt="<?php echo $value->sty_image; ?>" style="width:30%; height: 30%;">
		                          	<?php } else { ?>
		                          		<img src="media/images/default/no_image.jpg" alt="<?php echo $value->sty_name; ?>" style="width:30%; height: 30%;">
		                          	<?php } ?>
		                          	<p><a href="/admin/edit-style/<?php echo $value->sty_id; ?>" title="Sửa phong cách"><?php echo $value->sty_name; ?></a></p>
		                          </td>

		                          <td><?php echo $value->sty_url_image; ?></td>
									
		                          <td><?php echo $value->sty_createdate; ?> > <p><?php echo $value->sty_update; ?></p></td>

		                          <td><?php echo $value->sty_id; ?></td>

		                          <td><?php if($value->sty_publish == 1){ ?>
										<span class="btn btn-cursor btn-active" onclick="ActiveStyle(<?php echo $value->sty_id ?>, 0);" title="Ngừng kích hoạt"><i class="fa fa-check"></i></span>
							      	  <?php } else { ?>
										<span class="btn btn-cursor btn-unactive" onclick="ActiveStyle(<?php echo $value->sty_id ?>, 1);" title="Kích hoạt"><i class="fa fa-times"></i></span>	
							      	  <?php } ?>							      	
							      </td>
								  
								  <td><button type="submit" class="btn-del" title="Xóa phong cách" onclick="DeleteStyle(<?php echo $value->sty_id ?>);"><i class="fa fa-trash"> </i></button></td>

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