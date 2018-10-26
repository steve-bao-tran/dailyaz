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
			        			<h1 class="h3 display">Chi tiết đơn hàng <?php echo $title_show ?></h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">			        			
			        			<a href="/admin/order" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
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
		                <div class="card-body">
		                  <div class="table-responsive">
		                  	<?php if($showcart && $order) { ?>
		                    	<table class="table" width="100%">
		                      		<tbody>			                        		
				                    	<tr>
					                        <td class="text-uppercase" colspan="2">
					                        	<b>Đơn hàng: </b>
					                        	<span class="text-danger"><b><?php echo $title_show ?></b></span>
					                        </td>

					                        <td class="text-uppercase" align="center" colspan="2">
					                            <b>Trạng thái:
					                                <span class="text-danger&quot;"><?php echo $order->sh_name ?></span>
					                            </b>
					                        </td>

					                        <td class="text-uppercase" align="right" colspan="2"><b>Vận đơn:</b> 
					                        	<span class="text-success"><b>#Cửa hàng giao</b></span>
					                        </td>
					                    </tr>

					                    <tr class="tr_title_order">
					                        <td colspan="6">
					                            <div class="row">
					                                <div class="col-sm-4">
					                                    <p>
					                                        <i class="fa fa-clock-o"></i> Ngày đặt hàng:
					                                        <b><?php echo $order->o_date ?></b>
					                                    </p>
					                                </div>

					                                <div class="col-sm-3">
					                                    <p><i class="fa fa-truck"></i> Nhà vận chuyển: 
					                                    	<b>Cửa hàng giao</b></p>
					                                </div>

					                                <div class="col-sm-5">
					                                    <p>
					                                        <i class="fa fa-money"></i> Hình thức thanh toán:
					                                        <b><?php echo 'Thanh toán khi nhận hàng' ?></b>
					                                    </p>
					                                </div>
					                            </div>
												
												<?php if (in_array($order->o_status, array(98,99))) { ?>
						                            <div class="row">
						                                <div class="col-sm-4">
						                                    <p><i class="fa fa-calendar"></i> Ngày hủy: <?php echo $order->o_cancel_date ?></p>
						                                </div>

						                                <div class="col-sm-8">
						                                    <p><i class="fa fa-thumbs-o-down"></i> Lý do hủy: <?php echo $order->o_reason_cancel ?></p>
						                                </div>
						                            </div>
						                        <?php } ?>
					                                
					                                <div class="row">                 
					                                    <div class="col-sm-4">
					                                    <p><i class="fa fa-user"></i> Người nhận:
					                                        <b><?php echo ($order->rc_fullname != '') ? $order->rc_fullname : 'Chưa cập nhật' ?></b></p>
					                                </div>

					                                <div class="col-sm-8">
					                                    <p><i class="fa fa-home"></i> Địa chỉ:
					                                        <b><?php echo ($order->rc_address != '') ? $order->rc_address : 'Chưa cập nhật' ?></b></p>
					                                </div>							                            
					                            </div>

					                            <div class="row">
					                                <div class="col-sm-4">
					                                    <p><i class="fa fa-phone"></i> Điện thoại:
					                                        <b><?php echo ($order->rc_mobile != '') ? $order->rc_mobile : 'Chưa cập nhật' ?></b></p>
					                                </div>
					                                <div class="col-sm-3">
					                                    <p><i class="fa fa-envelope"></i> Email:
					                                        <b><?php echo ($order->rc_email != '') ? $order->rc_email : 'Chưa cập nhật' ?></b></p>
					                                </div>
					                                <div class="col-sm-5 text-left"></div>
					                            </div>
					                        </td>
					                    </tr>
				                        
				                        <tr>
				                            <td colspan="6">
				                                <i><b>Ghi chú: <?php echo ($order->rc_note != '') ? $order->rc_note : '#N/A' ?></b></i>
				                            </td>
				                        </tr>

				                        <tr>
					                        <th width="10%" class="line_showcart_0">Hình ảnh</th>
					                        <th width="20%" class="line_showcart_1">Thông tin</th>
					                        <th width="15%" class="line_showcart_2">Trọng lượng</th>
					                        <th width="10%" class="line_showcart_3 hidden-xs">Số lượng</th>	
					                        <th width="20%" class="line_showcart_4 hidden-xs">Đơn giá (VNĐ)</th>
					                        <th width="15%" class="line_showcart_5">Thành tiền</th>
				                    	</tr>
										
										<?php $total = 0; $vat = 0; $ship = 0; ?>	
				                        <?php foreach ($showcart as $ks => $vs) { ?>
										<?php $total += $vs->sc_quantity * $vs->sc_price; ?>
					                        <tr>
					                            <td class="line_showcart_0">
					                                <a class="menu_1" target="_blank" href="<?php echo base_url() .'san-pham/'. $vs->pro_id .'-'. RemoveSign($vs->pro_name) ?>">
					                                    <img width="80" src="<?php echo ($vs->pro_image != '' && file_exists('media/images/product/'. $vs->pro_dir .'/thumbnail_55_'. explode(',', $vs->pro_image)[0])) ? 'media/images/product/'. $vs->pro_dir .'/thumbnail_55_'. explode(',', $vs->pro_image)[0] : 'media/images/default/no_image.jpg' ?>" alt="<?php echo $vs->pro_name ?>" title="Xem chi tiết sản phẩm">

					                                </a>
					                            </td>

					                            <td class="line_showcart_1">
					                                <a class="menu_1" target="_blank" href="<?php echo base_url() .'san-pham/'. $vs->pro_id .'-'. RemoveSign($vs->pro_name) ?>" title="Xem chi tiết sản phẩm"><?php echo $vs->pro_name ?></a>
					                                <p style="font-size: 13px">
				                                        <i>Tồn kho:
				                                            <a target="_blank" href="#">
				                                                <span class="text-primary" style="color:#ff0202"><?php echo $vs->pro_instock ?></span>
				                                            </a>
				                                        </i>
				                                    </p>						                            
					                            </td>

					                            <td class="line_showcart_2" style="text-align: right;">
					                                <span><?php echo $vs->pro_weight ?>g</span>
					                            </td>

					                            <td style="text-align: right;" class="hidden-xs"><?php echo $vs->sc_quantity ?></td>	

					                            <td class="line_showcart_4 hidden-xs" style="text-align: right;">
					                            	<?php if ($vs->sc_price_orig > $vs->sc_price) { ?>
					                            		<small><span class="product_price_dis" style="text-decoration: line-through;"><?php echo number_format($vs->sc_price_orig, 0, '.', '.')  ?> đ</span></small>
					                            		<p><span class="product_price"><?php echo number_format($vs->sc_price, 0, '.', '.')  ?> đ</span></p>
					                            	<?php } else { ?>
					                            		<span class="product_price"><?php echo number_format($vs->sc_price, 0, '.', '.')  ?> đ</span>
					                            	<?php } ?>
					                            </td>

					                            <td valign="top" style="text-align: right;">
					                                <span class="product_price"><?php echo number_format($vs->sc_price * $vs->sc_quantity, 0, '.', '.') ?> đ</span>
					                            </td>
					                        </tr>
					                    <?php } ?>
				                        
				                        <tr>
					                        <td align="right" colspan="6">
					                            <p>Tổng doanh thu đơn hàng: <span class="product_price"><b><?php echo number_format($total, 0, '.', '.') ?> đ</b></span></p>
					                            <p>VAT (nếu có): <span class="product_price"><b><?php echo $vat ?>  đ</b></span></p>
					                            <p>Phí vận chuyển (nếu có): <span class="product_price"><b><?php echo $ship ?> đ</b></span></p>
					                        </td>
					                    </tr>

				                    	<tr>
					                        <td align="right" colspan="6">
					                            <p class="td_total">Tổng thanh toán: <span class="product_price"><b><?php echo number_format($total - $vat - $ship, 0, '.', '.') ?> đ</b></span></p>
					                            <?php if (! in_array($order->o_status, array(5, 98,99))) { ?>
					                            	<input type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="ChangeStatusOrder(<?php echo $order->o_id ?>, <?php echo $order->o_status ?>, '<?php echo PREORDERNAME . $order->o_id ?>')" title="Chuyển trạng thái đơn hàng" value="Chuyển trạng thái">
					                            <?php } else { ?>
					                            	<span>Đơn hàng đã xử lý.</span>
					                            <?php } ?>
					                        </td>
					                    </tr>

					                    <tr>
					                        <td align="right" colspan="6">
					                            <span class=""><b>***Lưu ý: Phí vận chuyển và VAT chưa lưu trữ trên hệ thống</b></span>
					                        </td>
					                    </tr>
		                      		</tbody>
		                    	</table>
		                    <?php } else { ?>
		                    	<div ><span>Không có dữ liệu</span></div>
		                    <?php } ?>

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
											<?php $sel = ''; ?>
											<?php if ($order->o_status == $vl->sh_code) {
												$sel = 'selected="selected"';
											} ?>
			                          		<option value="<?php echo $vl->sh_code ?>" <?php echo $sel; ?>><?php echo $vl->sh_name ?></option>
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