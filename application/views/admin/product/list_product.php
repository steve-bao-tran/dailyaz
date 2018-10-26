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
			        			<h1 class="h3 display">Danh sách hàng hóa</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="/admin/add-product" class="btn btn-outline-success" title="Thêm hàng hóa"><i class="fa fa-plus"></i> Thêm</a>
			        			<a href="/admin/excel-product" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-product" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                          <th>Hình / Tên(SKU)</th>
		                          <th>Danh mục</th>
		                          <th>Đơn giá(Tồn kho)</th>
		                          <th>Khuyến mãi (% nếu có)</th>
		                          <th>Ngày tạo / Ngày sửa</th>
		                          <th>Lượt xem / Lượt mua</th>		                          
		                          <th>ID</th>
		                          <th>Trạng thái</th>
		                          <th>Xóa</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_product) > 0) { //$stt = 0; ?>
		                        <?php foreach($list_product as $key => $value) { //$stt++; ?>
		                        <tr>
		                          <th scope="row"><?php echo $key+1; ?></th>

		                          <td>
		                          	<?php $img = explode(',', $value->pro_image); ?>
		                          	<img src="media/images/product/<?php echo $value->pro_dir; ?>/<?php echo $img[0]; ?>" alt="<?php echo $value->pro_image; ?>" style="width:30%; height: 15%;">
		                          	<p><a href="/admin/edit-product/<?php echo $value->pro_id; ?>" title="Sửa hàng hóa"><?php echo $value->pro_name; ?></a></p>
		                          	<p><?php echo $value->pro_sku; ?></p>
		                          </td>

		                          <td><p><?php echo $value->cat_name; ?></p></td>

		                          <td><p><span class="product_price"><?php echo number_format($value->pro_cost, 0, ',', '.'); ?>đ</span></p><p>(<?php echo $value->pro_instock; ?>)</p></td>

		                          <td><p><?php echo ($value->pro_saleoff == 1) ? 'Có' : 'Không'; ?></p><p><?php echo ($value->pro_saleoff == 1) ? '('. $value->pro_percent .'%)' : ''; ?></p></td>
									
		                          <td><p><?php echo $value->pro_createdate; ?> / <?php echo $value->pro_editdate; ?></p></td>

		                          <td><?php echo $value->pro_view; ?> / <?php echo $value->pro_buy; ?></td>

		                          <td><?php echo $value->pro_id; ?></td>

		                          <td><?php if($value->pro_publish == 1){ ?>
										<span class="btn btn-cursor btn-active" onclick="ActiveProduct(<?php echo $value->pro_id ?>, 0);" title="Ngừng kích hoạt"><i class="fa fa-check"></i></span>
							      	  <?php } else { ?>
										<span class="btn btn-cursor btn-unactive" onclick="ActiveProduct(<?php echo $value->pro_id ?>, 1);" title="Kích hoạt"><i class="fa fa-times"></i></span>	
							      	  <?php } ?>							      	
							      </td>
								  
								  <td><button type="submit" class="btn-del" title="Xóa hàng hóa" onclick="DeleteProduct(<?php echo $value->pro_id ?>);"><i class="fa fa-trash"> </i></button></td>

		                        </tr>
								<?php } ?>
								<?php } else { ?>
		                        <tr>
		                          <td colspan="10"><span>Không có dữ liệu</span></td>
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