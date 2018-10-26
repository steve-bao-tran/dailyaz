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
			        			<h1 class="h3 display">Danh sách đơn hàng</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="/admin/add-order" class="btn btn-outline-success" title="Tạo đơn hàng"><i class="fa fa-plus"></i> Thêm</a>
			        			<a href="/admin/excel-order" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a>
			        			<a href="/admin/help-order" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                	<div class="card-body" style="margin-bottom:-25px; margin-top: -10px;">
								<div id="form_seach_order">
			                        <form method="post" class="form-inline" name="frmSearchOrder" id="frmSearchOrder">
			                            <div class="input-group mb-3">
										    <div class="input-group-prepend">
										        <span class="input-group-text" id="basic-addon1"><i class="fa fa-barcode" title="Mã đơn hàng"></i></span>
										    </div>
										    <input type="text" name="ord_id" value="<?php echo (isset($ord_id) && $ord_id > 0) ? $ord_id : ''; ?>" class="form-control" placeholder="Mã số đơn hàng ..." aria-label="Username" aria-describedby="basic-addon1">
										</div>

										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										        <span class="input-group-text" id="basic-addon1"><i class="fa fa-male" title="Tên khách hàng"></i></span>
										    </div>
										    <input type="text" name="ord_name" value="<?php echo (isset($ord_name) && $ord_name != '') ? $ord_name : ''; ?>" class="form-control" placeholder="Tên khách hàng ..." aria-label="Username" aria-describedby="basic-addon2">
										</div>

										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" title="Số điện thoại khách hàng"></i></span>
										    </div>
										    <input type="text" name="ord_mobile" value="<?php echo (isset($ord_mobile) && $ord_mobile != '') ? $ord_mobile : ''; ?>" class="form-control" placeholder="Số điện thoại khách hàng..." aria-label="Username" aria-describedby="basic-addon3">
										</div>

										<div class="input-group mb-3">
										    <div class="input-group-prepend">
										        <label class="input-group-text" for="order_status"><i class="fa fa-tag" title="Trạng thái"></i></label>
										    </div>
										  	<select class="custom-select" name="ord_status" id="order_status">
										  		<?php if (isset($li_ship) && count($li_ship) > 0) { ?>
										  			<option value="0">--Chọn trạng thái--</option>
											  		<?php foreach ($li_ship as $ks => $vs) { ?>
											  			<?php $sel_status = ''; ?>
											  			<?php if (isset($ord_status) && $ord_status > 0 && $ord_status == (int)$vs->sh_code) { $sel_status = 'selected="selected"'; } ?>
													    <option value="<?php echo $vs->sh_code ?>" <?php echo $sel_status; ?>><?php echo $vs->sh_name ?></option>
													<?php } ?>
											    <?php } else { ?>
											    	<option value="-1">Chưa cập nhật</option>
											    <?php } ?>
										  	</select>
										</div>	

			                            <div class="input-group mb-3">
										  	<div class="input-group-prepend">
										    	<span class="input-group-text" id="basic-addon4"><i class="fa fa-calendar-o" title="Từ ngày"></i></span>
										  	</div>
										  	<input type="date" name="ord_fromdate" value="<?php echo (isset($ord_fromdate) && $ord_fromdate != '') ? $ord_fromdate : ''; ?>" class="form-control" placeholder="Từ ngày" aria-label="Username" aria-describedby="basic-addon4"  title="Từ ngày">
										</div>

										<div class="input-group mb-3">
										  	<div class="input-group-prepend">
										    	<span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar-o" title="Đến ngày"></i></span>
										  	</div>
										  	<input type="date" name="ord_todate" value="<?php echo (isset($ord_todate) && $ord_todate != '') ? $ord_todate : ''; ?>" class="form-control" placeholder="Đến ngày" aria-label="Username" aria-describedby="basic-addon5" title="Đến ngày">
										</div>                     

			                            <div class="input-group mb-3">
			                            	<input type="hidden" name="search_order" value="search_order">
			                                <button type="submit" class="btn btn-primary input-sm" title="Tìm đơn hàng"><i class="fa fa-search"></i> Tìm kiếm</button>
			                                <input type="reset" class="btn btn-default" title="Xóa từ khóa" value="Hủy tìm" >
			                            </div>			                           
			                        </form>

			                    </div>

		                	</div>
		                </div>	

		              <div class="card" style="margin-top:-25px;">
		                <div class="card-body">
		                  <div class="table-responsive">
		                    <table class="table table-striped table-hover table-custom">
		                      <thead>
		                        <tr class="order-info-header">
		                          	<th>#</th>
		                          	<th>Mã đơn hàng</th>
		                          	<th>Ngày đặt</th>
		                          	<th>Thanh toán</th>
		                          	<th>Trạng thái</th>
		                          	<th>Tổng tiền</th>
		                          	<th>Chuyển trạng thái</th>
		                        </tr>
		                      </thead>

		                      <tbody>
								<?php if(count($list_order) > 0) { ?>
		                        <?php foreach($list_order as $key => $value) { ?>
		                        <tr class="order-info-line1">
		                           	<th scope="row"><?php echo $key+1; ?></th>
		                           	<td>
		                          		<a href="/admin/detail-order/<?php echo $value->o_id ?>" title="Xem chi tiết đơn hàng"><?php echo PREORDERNAME . $value->o_id; ?></a>
		                          	</td>
		                          	<td><?php echo $value->o_date; ?></td>
		                          	<td><?php echo ($value->o_payment_status == 0) ? 'Chưa thanh toán' : 'Đã thanh toán'; ?></td>	
		                          	<td><?php echo $value->sh_name; ?></td>
		                          	<td><span class="product_price"><?php echo number_format($value->o_cost_promos, 0, '.','.'); ?> đ</span>
		                          		<p><small>Số lượng: </small><?php echo $value->o_quantity ?></p>
		                          	</td>	
								  	<td>
								  		<?php if (! in_array($value->o_status, array(5, 98, 99)) ) { ?>
								  			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" title="Chuyển trạng thái đơn hàng" onclick="ChangeStatusOrder(<?php echo $value->o_id ?>, <?php echo $value->o_status ?>, '<?php echo PREORDERNAME . $value->o_id ?>');"><i class="fa fa-tasks"></i></button>
								  		<?php } else { ?>
								  			<span>Đơn hàng đã xử lý.</span>
								  		<?php } ?>
								  	</td>
		                        </tr>
		                        
		                        <tr class="order-info-line2">		                        	
		                        	<td colspan="3">
		                        		<div class="">
		                        			<span class="title1">Tên khách hàng</span>
		                        			<span>: <i><?php echo $value->rc_fullname ?></i></span>
		                        		</div>
		                        		<div class="">
		                        			<span class="title1">Số điện thoại</span>
		                        			<span>: <i><?php echo $value->rc_mobile ?></i></span>
		                        		</div>
		                        		<div class="">
		                        			<span class="title1">Thư điện tử</span>
		                        			<span>: <i><?php echo $value->rc_email ?></i></span>
		                        		</div>		                        		
		                        	</td>	
		                        	<td colspan="3">										
		                        		<div class="">
		                        			<span class="title2">Địa chỉ</span>
		                        			<span>: <i><?php echo $value->rc_address ?></i></span>
		                        		</div>
		                        		<div class="">
		                        			<span class="title2">Ghi chú</span>
		                        			<span>: <i><?php echo ($value->rc_note != '') ? $value->rc_note : 'Chưa cập nhật' ?></i></span>
		                        		</div>
		                        	</td>
		                        	<td><a href="<?php echo base_url() .'admin/detail-order/'. $value->o_id ?>" title="Xem chi tiết đơn hàng"><i class="fa fa-shopping-basket"> </i> Xem chi tiết</a></td>
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

      	<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
	        <div class="modal-dialog">        
	          <!-- Modal content-->
	          <div class="modal-content">
	            <form action="<?php echo base_url() ?>admin/change-status-order" name="frmChangeStatusOrder" id="frmChangeStatusOrder" method="post">

	                <div class="modal-header">
	                	<h4 class="modal-title">Chuyển Trạng Thái Đơn Hàng <span class="order-code"></span></h4>
	                  	<button type="button" class="close" data-dismiss="modal">&times;</button>
	                </div>

	                <div class="modal-body">

	                  	<div class="input-group">
							<label class="col-sm-4 form-control-label"><span style="color: red;"> * </span> Chọn trạng thái</label>
							<div class="col-sm-8 mb-3">
		                    	<select name="statusorder" class="form-control" id="statusorder" onchange="CallReason(this.value);">
									<?php if ($li_ship) { ?>
										<?php foreach ($li_ship as $vl) { ?>											
			                          		<option value="<?php echo $vl->sh_code ?>"><?php echo $vl->sh_name ?></option>
			                          	<?php } ?>
		                          	<?php } else { ?>
										<option value="0" selected="selected">Không có dữ liệu</option>
		                          	<?php } ?>
		                        </select>
	                    	</div>
	                	</div>

	                	<div class="input-group hidden" id="show-reason">
							<label class="col-sm-4 form-control-label"><span style="color: red;"> * </span> Lý do hủy</label>
							<div class="col-sm-8 mb-3">
	                    		<textarea name="reasoncancel" id="reasoncancel" cols="32" rows="2" placeholder="Nhập lý do hủy..."></textarea>
	                    	</div>
	                	</div>
	                </div>

	                <div class="modal-footer">
	                	<input type="hidden" name="orderidmodal" id="orderidmodal">
	                	<input type="hidden" name="status" id="status">	                    
	                    <input type="button" class="btn btn-default" value="Thực hiện" onclick="EmptyCheck();" />
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