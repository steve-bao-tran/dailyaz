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
			        			<h1 class="h3 display">Liên hệ khách hàng</h1>
			        		</div>
			        	</div>
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-right">			        			
			        			<a href="javascript:void(0);" class="btn btn-outline-info" title="Xuất excel" ><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-email" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>			        			
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
		                          <th>Tiêu đề / Tên</th>
		                          <th>Email / SĐT / Địa chỉ</th>
		                          <th>Ngày tạo</th>
		                          <th>Ghi chú</th>
		                          <th>ID</th>
		                          <th>Trạng thái</th>
		                          <th>Xóa</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_contact) > 0) { ?>
		                        <?php foreach($list_contact as $key => $value) { ?>
		                        <tr>
		                          <th scope="row"><?php echo $key+1; ?></th>
								  
								  <td>
		                          	<a href="mailto:<?php echo $value->ct_email; ?>" target="_top" title="Gửi tới thư điện tử"><?php echo $value->ct_name; ?></a>
		                          	<p><?php echo $value->ct_fullname; ?></p>	
		                          </td>

		                          <td>
		                          	<a href="mailto:<?php echo $value->ct_email; ?>" target="_top" title="Gửi tới thư điện tử"><?php echo $value->ct_email; ?></a><br>
		                          	<?php echo $value->ct_mobile; ?><br>
		                          	<?php echo $value->ct_address; ?>
		                          </td>

		                          <td><?php echo $value->ct_createdate; ?></td>

		                          <td><?php echo $value->ct_detail; ?></td>

		                          <td><?php echo $value->ct_id; ?></td>
									
								  <td><?php if($value->ct_status == 1){ ?>
										<span class="btn btn-cursor btn-active" onclick="ActiveEmail(<?php echo $value->ct_id ?>, 0);" title="Ngừng kích hoạt"><i class="fa fa-check"></i></span>
							      	  <?php } else { ?>
										<span class="btn btn-cursor btn-unactive" onclick="ActiveEmail(<?php echo $value->ct_id ?>, 1);" title="Kích hoạt"><i class="fa fa-times"></i></span>	
							      	  <?php } ?>							      	
							      </td>

							      <td><button type="submit" class="btn-del" title="Xóa thư điện tử" onclick="DeleteEmail(<?php echo $value->ct_id ?>);"><i class="fa fa-trash"> </i></button></td>

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