<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->

<style type="text/css">
	.header-show-order {
		border: 1px solid #ddd;
		border-radius:10px;
		background:#f5f5f5;
	}
	.title-text {
		text-align: center;
		color: green;
		padding-top: 15px;
		font-size: 1.1em;
	}
	.content-text{
		padding: 0 15px 15px 15px;
	}

	.body-show-order {
		margin-top: 15px;
	}

	.body-show-order .info-order{		
		border:1px solid #ddd;		
	}

	.order_detail{
		border: 1px solid #ddd;
	}

	.{
		font-family: 'Muli', serif;
		font-size: 
	}
	.date-box .title{
		float:left;
		width: 150px;
	}
	dl dt {
		float: left;font-weight: bold;
	}
	.status-orders-left .rows1, .col_bottom{
		padding: 10px;
		background: rgba(255, 255, 255, 0.65);
		border-bottom: 1px solid #dadada;
	}

	.checkout-success {
	    font-size: 13px;
	    min-height: 490px;
	}
	.ttl-checkout {
	    font-size: 16px;
	    line-height: 40px;
	    margin-top: 10px;
	    text-transform: uppercase;
	    font-weight:bold;
	}
	.checkout-success-cont {
	    background: #fff5ba none repeat scroll 0 0;
	    border: 1px solid #d2c67a;
	    border-radius: 3px;
	    margin-top: 10px;
	    padding: 4px;
	}
	.checkout-success-cont .checkout-success-cont-bg {
	    background: #fffceb none repeat scroll 0 0;
	    overflow: hidden;
	    position: relative;
	}
	.checkout-success .content-order {
	    float: left;
	    font-size: 14px;
	    padding: 10px 10px 10px 36px;
	    position: relative;
	}
	.checkout-success .content-order .ic-check::before {
	    border-color: #4db748;
	    border-image: none;
	    border-style: solid;
	    border-width: 0 4px 4px 0;
	    content: "";
	    display: block;
	    height: 20px;
	    transform: rotate(35deg);
	    width: 10px;
	}
	.checkout-success .content-order .ic-check {
	    left: 15px;
	    position: absolute;
	    top: 22px;
	}
	.checkout-success .content-order > p {
	    padding-top: 5px;
	}
	.checkout-success-cont .block_buy_product {
	    border-left: 2px solid #f1e39a;
	    border-radius: 3px;
	    float: right;
	    height: 360px;
	    line-height: 20px;
	    overflow: auto;
	    padding: 10px 10px 10px 18px;
	    position: relative;
	    width: 268px;
	}
	.checkout-success-cont .block_buy_product h2 {
	    border-bottom: 1px solid #ddd;
	    color: #2e4384;
	    font-size: 16px;
	    line-height: 30px;
	    position: relative;
	}
	.checkout-success-cont .block_buy_product .author {
	    line-height: 20px;
	    margin-top: 10px;
	}
	.checkout-success-cont .block_buy_product .author span {
	    color: #3f53aa;
	}
	.checkout-success-cont .block_buy_product .product_ {
	    margin-top: 10px;
	}
	.checkout-success-cont .block_buy_product .product_ img {
	    border: 1px solid #ccc;
	    float: left;
	    height: 52px;
	    margin-right: 10px;
	    width: 52px;
	}
	.checkout-success-cont .block_buy_product .product_ .name {
	    display: block;
	    line-height: 16px;
	}
	.checkout-success-cont .block_buy_product .share-fb {
	    background: #e4101e none repeat scroll 0 0;
	    border: 1px solid #bf0711;
	    border-radius: 2px;
	    color: #fff;
	    display: inline-block !important;
	    font-size: 12px;
	    line-height: 24px;
	    margin-top: 10px;
	    overflow: hidden;
	    padding: 0 10px;
	}
	.checkout-success .content-order .g-link a {
	    background: #e60f1e none repeat scroll 0 0;
	    border: 1px solid #bf0711;
	    border-radius: 2px;
	    color: #fff;
	    cursor: pointer;
	    display: inline-block;
	    line-height: 32px;
	    margin: 20px 10px 20px 0;
	    padding: 0 20px;
	    text-decoration: none;
	}
	.product_ ul{
	    padding: 2px 0px;
	    list-style: none;
	}
	.product_ ul li{
	    display: inline-block;
	    padding:4px 0px;
	}
	.block_buy_product h2 .icon {
	    fill: #2e4384;
	    height: 22px;
	    margin-right: 5px;
	    vertical-align: middle;
	    width: 22px;
	}
	/*ThÃ´ng tin Ä‘Æ¡n hÃ ng*/
	.check-orders-wrap > .tl {
	    font-size: 18px;
	    font-weight: bold;
	    line-height: 24px;
	    color: #555;
	}
	.check-orders-wrap > .tl b {
	    color: #e5101d;
	}
	.check-orders-wrap .date-box {
	    padding-top: 5px;
	    line-height: 22px;
	    font-size: 14px;
	}
	.date-box .title {
	    float: left;
	    width: 150px;
	}
	.check-orders-wrap .date-box span {
	    display: inline-block;
	    margin-right: 20px;
	}
	.check-orders-wrap .date-box span b {
	    color: #555;
	}
	.status-orders-block {
	    margin-top: 15px;
	    position: relative;
	    border: 1px solid #ddd;
	}
	.status-orders-block .status-orders-left {
	    /*position: absolute;*/
	    /*left: 0;*/
	    /*top: 0;*/
	    /*width: 320px;*/
	    background: #fff;
	    padding: 10px;
	}
	.status-orders-left dl {
	    overflow: hidden;
	}
	.status-orders-left dl dt {
	    float: left;	   
	    font-weight:bold;
	}
	.status-orders-left dl dd {
	    float: left;
	    padding-left: 5px;
	}
	.status-orders-left dl a {
	    color: #e5101d;font-weight:bold;
	}
	.status-orders-right {    
	    border-left: 1px solid #ddd;
	}

	.status-orders-right .box-status .tl {
	    background: #999999;
	    line-height: 40px;
	    padding-left: 10px;
	    font-size: 15px;
	    color: white;
	    border-bottom: 1px solid #E8E8E8;
	    font-weight: bold;
	}
	.status-orders-right .box-status .cont {
	    padding: 11px 0px;
	    overflow: hidden;
	    line-height: 20px;
	}
	.box-status .box-steps {
	    overflow: hidden;
	}
	.box-status .box-steps .step {
	    position: relative;
	    float: left;
	    width: 33%;
	    text-align: center;
	}
	.box-status .box-steps .step.done span, .box-status .box-steps .step.done:after {
	    background-color: #17a117;
	}
	.box-status .box-steps .step span {
	    background: #a8a8a8;
	    width: 34px;
	    height: 34px;
	    line-height: 34px;
	    text-align: center;
	    border-radius: 100%;
	    display: block;
	    position: absolute;
	    left: 50%;
	    margin-left: -15px;
	    z-index: 1;
	}
	.box-status .box-steps .step .icon {
	    width: 20px;
	    height: 20px;
	    color: #fff ;
	    vertical-align: middle;
	    margin:5px;
	}
	.box-status .box-steps .step.done p {
	    color: #17a117;
	}
	.box-status .box-steps .step.current span {
	    background-color: #e5101d;
	}
	.box-status .box-steps .step.current p {
	    color: #e5101d;
	}
	.box-status .box-steps .step p {
	    padding-top: 35px;
	    line-height: 18px;
	}
	.box-status .item {
	    float: left;
	}
	.box-status .item > img {
	    float: left;
	    width: 80px;
	}
	.box-status .item .info {
	    margin-left: 90px;
	    line-height: 18px;
	    font-size: 13px;
	}
	.box-status .item .info a {
	    display: block;
	}

	.box-status .item .info p span {
	    display: inline-block;
	    width: 200px;
	    font-weight:bold;
	}

	.box-status .nn p span {
	    display: inline-block;
	    width: 90px;
	}

	.box-status .box-steps .step:after {
	    content: '';
	    width: 100%;
	    position: absolute;
	    top: 15px;
	    left: 50%;
	    height: 2px;
	    background-color: #a8a8a8;
	}
	.final:after{
	    display: none;
	}
	.money{color:red;font-weight:bold;}

	.status-orders-right .box-status .nn{
	    padding-left: 10px;
	}
	.status-orders-404{
	    text-align:center;
	}
	.order_status{
	    font-weight:bold;
	    color:red;
	    padding:0 20px;
	}

</style>
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
						<h2><span class="content-title">Đặt hàng thành công</span></h2>
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
							<div class="show-order">

								<div class="header-show-order">
									<div class="title-uppercase title-text">Chúc mừng bạn đã đặt hàng thành công</div>
									<div class="content-text">
										<p>Chào <strong><?php echo (isset($new_user) && $new_user->rc_fullname != '') ? $new_user->rc_fullname : '' ?>!</strong></p>										
										<p>Bạn vừa đặt thành công đơn hàng có mã đơn hàng là <a data-toggle="collapse" href="#OrderDetail" aria-expanded="false" title="Xem chi tiết đơn hàng" style="cursor: pointer; color: green;"><strong><?php echo (isset($ord) && $ord->o_id > 0) ? PREORDERNAME . $ord->o_id : '#N/A' ?></strong></a>. Đơn hàng của bạn sẽ được xác nhận, xử lý và sẽ giao đến cho bạn theo địa chỉ đã yêu cầu là: <strong><?php echo (isset($new_user) && $new_user->rc_address != '') ? $new_user->rc_address : '' ?></strong>. Mọi thông tin về đơn hàng sẽ được gửi tới email của bạn, vui lòng kiểm tra email để biết thêm chi tiết. Cảm ơn bạn đã mua hàng của chúng tôi!!!</p>
										<p>Mọi thắc mắc vui lòng liên hệ: <strong><?php echo HOTLINE ?></strong><span class="pull-right btn btn-primary" data-toggle="collapse" href="#OrderDetail" title="Xem chi tiết đơn hàng" style="cursor: pointer; color: #fff;">Xem chi tiết</span></p>
										<?php if (! $this->session->userdata('sessionUser') && $ord->o_user > 0) { ?>
											<p>Thành viên mới đã được tạo: <?php echo (isset($new_user->us_username) && $new_user->us_username != '') ? $new_user->us_username : 'Chưa cập nhật' ?></p>
										<?php } ?>
									</div>
								</div>

								<div class="body-show-order">
									<div class="col-lg-4 col-md-4 col-xs-12">
										<div class="info-order">
											<div class="panel-heading" style="background:#337ab7">
												<span class="title-uppercase" style="font-weight:bold;color:#fff;">Thông tin đơn hàng</span>
											</div>										

											<div class="status-orders-left">
					                            <div class="rows1">
					                                <div class="tl">
					                                    <a href="/print-order/979?order_token=942de6047c4d8b5f83a4f9fac904117e">
					                                    	<img src="<?php echo base_url() ?>templates/images/icon-print.png">
					                                    </a>
					                                </div>

					                                <div class="tl">
					                                	<span class="title">Chào bạn: </span><b><?php echo $new_user->rc_fullname ?></b>
					                                </div>

					                                <div class="date-box">
					                                    <span class="title"><b>Mã đơn hàng</b></span>
					                                    <span>: <?php echo PREORDERNAME . $ord->o_id ?></span><br>
					                                    <span class="title"><b>Ngày mua</b></span>
					                                    <span>: <?php echo $ord->o_date ?></span><br>
					                                    <span class="title"><b>Giá trị đơn hàng</b></span>
					                                    <span class="money">: <?php echo number_format($ord->o_cost_promos, 0, '.','.') ?> đ</span>
					                                </div>
					                            </div>

					                            <div class="col_bottom">
					                                <div class="rows">                 
					                                    <dl>
					                                        <dt>Trạng thái đơn hàng: </dt>
					                                        <dd> <?php echo (isset($ord) && $ord->sh_name != '') ? $ord->sh_name : '' ?></dd>
					                                    </dl>
					                                    <dl>
					                                        <dt>Trạng thái thanh toán: </dt>
					                                        <dd> <?php echo (isset($ord) && $ord->o_status == 5) ? 'Đã thanh toán' : 'Chưa thanh toán' ?></dd>
					                                    </dl>
					                                    <dl>
					                                        <dt>Hình thức thanh toán: </dt>
					                                        <dd> Thanh toán khi nhận hàng</dd>
					                                    </dl>
					                                </div>
					                                <dl>
					                                	<?php if (isset($ord) && $ord->o_status == 1) { ?>
					                                		<button id="cancel_order" class="btn btn-danger pointer" data-toggle="modal" data-target="#myModalCancel">Hủy đơn hàng</button>
					                                	<?php } ?>
					                                </dl>
					                            </div>
					                        </div>

										</div>
									</div>

									<div class="col-lg-8 col-md-8 col-xs-12">
										<div class="info-order">
											<div class="panel-heading" style="background:#337ab7">
												<span class="title-uppercase" style="font-weight:bold;color:#fff;">Chi tiết đơn hàng</span>
											</div>

											<div class="collapse status-orders-right " id="OrderDetail">
					                            <div class="row" style="margin:auto 0;">
					                                <div class="box-status">
					                                    <div class="tl">Tình trạng đơn hàng</div>
					                                    <div class="cont">
					                                        <div class="box-steps">
																<?php if (isset($ord) && in_array($ord->o_status, array(1,2,3,4,5))) { ?>
					                                        	<div class="step <?php echo (isset($ord) && in_array($ord->o_status, array(1,2,3,4,5))) ? 'done' : '' ?>">
					                                                <span>
					                                                	<i class="fa fa-shopping-cart"></i>
					                                                </span>
					                                                <p>Mới</p>
					                                            </div>

					                                            <div class="step <?php echo (isset($ord) && in_array($ord->o_status, array(2,3,4,5))) ? 'done' : '' ?>">
					                                                <span>
					                                                	<i class="fa fa-shopping-bag"></i>
					                                                </span>
					                                                <p>Đã xác nhận và đang vận chuyển</p>
					                                            </div>

					                                            <div class="step final <?php echo (isset($ord) && $ord->o_status == 5) ? 'done' : '' ?>">
					                                                <span>
					                                                	<i class="fa fa-check"></i>
					                                                </span>
					                                                <p>Đã hoàn tất</p>
					                                            </div>
															<?php } else if (isset($ord) && $ord->o_status == 98) { ?>
																<div class="step done final">
					                                                <span><i class="fa fa-times"></i></span>
					                                                <p>Cửa hàng hủy. Lý do: <?php echo (isset($ord) && $ord->o_reason_cancel != '') ? $ord->o_reason_cancel : 'Chưa cập nhật' ?></p>
					                                            </div>
															<?php } else if (isset($ord) && $ord->o_status == 99) { ?>
																<div class="step done final">
					                                                <span><i class="fa fa-times"></i></span>
					                                                <p>Khách hàng hủy. Lý do: <?php echo (isset($ord) && $ord->o_reason_cancel != '') ? $ord->o_reason_cancel : 'Chưa cập nhật' ?></p>
					                                            </div>
															<?php } ?>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="box-status">
					                                    <div class="tl">Sản phẩm</div>
					                                    <div class="cont">
					                                        <table class="table table-hover" width="100%" border="0" cellpadding="0" cellspacing="0">
					                                            <tbody>
					                                            	<!-- <?php echo '<pre>'; print_r($order); echo '</pre>'; ?> -->
																	<?php foreach ($order as $ko => $vo) { ?>
					                                            	<tr>
					                                                    <td width="10%">
					                                                        <img width="80" src="<?php echo ($vo->pro_image != '' && file_exists('media/images/product/'. $vo->pro_dir .'/thumbnail_55_'. explode(',', $vo->pro_image)[0])) ? 'media/images/product/'. $vo->pro_dir .'/thumbnail_55_'. explode(',', $vo->pro_image)[0] : 'media/images/default/no_image.jpg'?>">
					                                                    </td>                                               <td width="50%">
					                                                    	<b><a href="<?php echo base_url() .'san-pham/'. $vo->pro_id .'-'. RemoveSign($vo->pro_name) ?>" title="<?php echo $vo->pro_name ?>"><?php echo $vo->pro_name ?></a></b>
					                                                    </td>

					                                                    <td width="20%">Mã SP: 
					                                                    	<span class="text-primary">#<?php echo $vo->pro_id ?></span>
					                                                    </td>

					                                                    <td>Số lượng: 
					                                                    	<span class="text-primary"><?php echo $vo->sc_quantity ?></span>
					                                                    </td>
					                                                </tr>
																	<?php } ?>	
					                                            </tbody>
					                                        </table>
					                                    </div>
					                                </div>

					                                <div class="box-status">
					                                    <div class="tl">Thông tin người nhận hàng</div>
					                                    <div class="cont">
					                                        <div class="nn">
					                                            <p>
					                                            	<span>Người nhận</span>
					                                                <b>: <?php echo (isset($new_user) && $new_user->rc_fullname != '') ? $new_user->rc_fullname : 'Chưa cập nhật' ?></b>
					                                            </p>
				                                                <p>
				                                                	<span>Email</span>
				                                                    <b>: <?php echo (isset($new_user) && $new_user->rc_email != '') ? $new_user->rc_email : 'Chưa cập nhật' ?></b>
				                                                </p>
				                                                <p>
				                                                	<span>Phone</span>
				                                                	<b>: <?php echo (isset($new_user) && $new_user->rc_mobile != '') ? $new_user->rc_mobile : 'Chưa cập nhật' ?></b>
				                                                </p>
				                                                <p>
				                                                	<span>Địa chỉ</span>
				                                                	<strong>: <?php echo (isset($new_user) && $new_user->rc_address != '') ? $new_user->rc_address : 'Chưa cập nhật' ?></strong>
				                                            	</p>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
										</div>
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
	
	<!-- Modal -->
	<div id="myModalCancel" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		    	<form name="frmCancelOrder" id="frmCancelOrder" action="<?php echo base_url() .'showcart/cancel-order'; ?>" method="post">
			      	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			        	<h4 class="modal-title title-uppercase">Yêu cầu hủy đơn hàng này</h4>
			      	</div>
				    <div class="modal-body">
						<div class="form-group">
							<span>Lý do hủy: </span>
						    <textarea class="form-control" name="reasoncancel" id="reasoncancel" placeholder="Nhập lý do bạn muốn hủy đơn hàng này..." required></textarea>
						    <span class="hidden check_reason" id="check_reason" style="color: #CDBEF4;"><small>Bạn chưa nhập lý do hủy đơn hàng này. Vui lòng điền đầy đủ!!</small></span>
						</div>

				    </div>
			      	<div class="modal-footer">
			      		<input type="hidden" name="orderid" value="<?php echo (isset($ord) && $ord->o_id > 0) ? $ord->o_id : 0; ?>">
			        	<button type="button" class="btn btn-primary" onclick="SubmitCancelOrder('frmCancelOrder');">Xác nhận</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
			      	</div>
		      	</form>
		    </div>

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