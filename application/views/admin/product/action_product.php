<!-- BEGIN: HEAD COMMON -->
<?php $this->load->view('admin/common/header_common'); ?>
<!-- END: HEAD COMMON -->
    <!-- BEGIN: SIDEBAR -->
    <?php $this->load->view('admin/common/sidebar'); ?>
    <!-- END: SIDEBAR -->
    <div class="page">
      	<!-- BEGIN: HEADER -->
      	<?php $this->load->view('admin/common/header'); ?>      	
      	<!-- END: HEADER -->

      	<section class="forms">
	        <div class="container-fluid">
	          	<!-- Page Header-->
		        <header> 
		        	<div class="row">
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-left">
			        			<h1 class="h3 display"><?php echo $title_show; ?> hàng hóa</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/product'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
			        			<!-- <a href="/admin/excel-product" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a> -->
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

	            <div class="col-lg-12">
	              	<div class="card">
		                <div class="card-body">
		                  <form name="frmActProduct" id="frmActProduct" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tên hàng hóa <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="proname" id="proname" value="<?php echo (isset($pro_edit->pro_name) && !empty($pro_edit->pro_name)) ? $pro_edit->pro_name : '' ?>" placeholder="Nhập tên hàng hóa..." required>
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Ảnh đại diện</label>
		                      	<div class="col-sm-10">
		                      		<?php if(isset($pro_edit)){
		                      				$imgDetail = array();
				                    		$imgDe = explode(",", $pro_edit->pro_image);
				                    		for($im = 0, $jm = count($imgDe); $im < 5; $im++){
				                    			if($im < $jm){
				                    				$imgDetail[$im] = $imgDe[$im];
				                    			} else {
				                    				$imgDetail[$im] = '';
				                    			}                    			
				                    		}
				                    	}
				                     ?>
		                        	<div class="form-group">
		                        		<div class="row">
		                        			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
		                        				<div class="btn-uploadfile btn-cursor" onclick="CallNext(1);">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh đại diện</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="proimage1" id="proimage1" value="<?php echo (isset($pro_edit) && $imgDetail[0] != '') ? $imgDetail[0] : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 1);" />
											    <div class="img-uploadfile <?php echo (isset($pro_edit) && $imgDetail[0] != '') ? '' : 'hidden'; ?> " id="img_avatar1">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar1" id="preview_avatar1" src="<?php echo (isset($pro_edit) && $imgDetail[0] != '') ? '/media/images/product/'. $pro_edit->pro_dir .'/'. $imgDetail[0] : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar1" style="cursor: pointer;" onclick="RemoveImg(1);">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" name="img_edit1" id="img_edit1" value="<?php echo (isset($pro_edit) && $imgDetail[0] != '') ? $imgDetail[0] : ''; ?>" >
										    	<input type="hidden" name="proid1" id="proid1" value="<?php echo (isset($pro_edit) && (int)$pro_edit->pro_id > 0) ? (int)$pro_edit->pro_id : 0; ?>" >	
		                        			</div>

		                        			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
		                        				<div class="btn-uploadfile btn-cursor" onclick="CallNext(2);">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh đại diện</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="proimage2" id="proimage2" value="<?php echo (isset($pro_edit) && $imgDetail[1] != '') ? $imgDetail[1] : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 2);" />
											    <div class="img-uploadfile <?php echo (isset($pro_edit) && $imgDetail[1] != '') ? '' : 'hidden'; ?> " id="img_avatar2">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar2" id="preview_avatar2" src="<?php echo (isset($pro_edit) && $imgDetail[1] != '') ? '/media/images/product/'. $pro_edit->pro_dir .'/'. $imgDetail[1] : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar2" style="cursor: pointer;" onclick="RemoveImg(2);">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" name="img_edit2" id="img_edit2" value="<?php echo (isset($pro_edit) && $imgDetail[1] != '') ? $imgDetail[1] : ''; ?>" >
										    	<input type="hidden" name="proid2" id="proid2" value="<?php echo (isset($pro_edit) && (int)$pro_edit->pro_id > 0) ? (int)$pro_edit->pro_id : 0; ?>" >	
		                        			</div>

		                        			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
		                        				<div class="btn-uploadfile btn-cursor" onclick="CallNext(3);">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh đại diện</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="proimage3" id="proimage3" value="<?php echo (isset($pro_edit) && $imgDetail[2] != '') ? $imgDetail[2] : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 3);" />
											    <div class="img-uploadfile <?php echo (isset($pro_edit) && $imgDetail[2] != '') ? '' : 'hidden'; ?> " id="img_avatar3">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar3" id="preview_avatar3" src="<?php echo (isset($pro_edit) && $imgDetail[2] != '') ? '/media/images/product/'. $pro_edit->pro_dir .'/'. $imgDetail[2] : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar3" style="cursor: pointer;" onclick="RemoveImg(3);">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" name="img_edit3" id="img_edit3" value="<?php echo (isset($pro_edit) && $imgDetail[2] != '') ? $imgDetail[2] : ''; ?>" >
										    	<input type="hidden" name="proid3" id="proid3" value="<?php echo (isset($pro_edit) && (int)$pro_edit->pro_id > 0) ? (int)$pro_edit->pro_id : 0; ?>" >	
		                        			</div>

		                        			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
		                        				<div class="btn-uploadfile btn-cursor" onclick="CallNext(4);">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh đại diện</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="proimage4" id="proimage4" value="<?php echo (isset($pro_edit) && $imgDetail[3] != '') ? $imgDetail[3] : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 4);" />
											    <div class="img-uploadfile <?php echo (isset($pro_edit) && $imgDetail[3] != '') ? '' : 'hidden'; ?> " id="img_avatar4">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar4" id="preview_avatar4" src="<?php echo (isset($pro_edit) && $imgDetail[3] != '') ? '/media/images/product/'. $pro_edit->pro_dir .'/'. $imgDetail[3] : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar4" style="cursor: pointer;" onclick="RemoveImg(4);">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" name="img_edit4" id="img_edit4" value="<?php echo (isset($pro_edit) && $imgDetail[3] != '') ? $imgDetail[3] : ''; ?>" >
										    	<input type="hidden" name="proid4" id="proid4" value="<?php echo (isset($pro_edit) && (int)$pro_edit->pro_id > 0) ? (int)$pro_edit->pro_id : 0; ?>" >	
		                        			</div>

		                        			<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
		                        				<div class="btn-uploadfile btn-cursor" onclick="CallNext(5);">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh đại diện</span>
													<span class="add">+</span>
											    </div>
											    
											    <input type="file" accept="image" name="proimage5" id="proimage5" value="<?php echo (isset($pro_edit) && $imgDetail[4] != '') ? $imgDetail[4] : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 5);"/>
											    <div class="img-uploadfile <?php echo (isset($pro_edit) && $imgDetail[4] != '') ? '' : 'hidden'; ?>" id="img_avatar5">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar5" id="preview_avatar5" src="<?php echo (isset($pro_edit) && $imgDetail[4] != '') ? '/media/images/product/'. $pro_edit->pro_dir .'/'. $imgDetail[4] : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar5" style="cursor: pointer;" onclick="RemoveImg(5);">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" name="img_edit5" id="img_edit5" value="<?php echo (isset($pro_edit) && $imgDetail[4] != '') ? $imgDetail[4] : ''; ?>" >
										    	<input type="hidden" name="proid5" id="proid5" value="<?php echo (isset($pro_edit) && (int)$pro_edit->pro_id > 0) ? (int)$pro_edit->pro_id : 0; ?>" >
										    	
		                        			</div>
		                        			
		                        		</div>		    
									    					    
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">SKU hàng hóa <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="prosku" value="<?php echo (isset($pro_edit->pro_sku) && !empty($pro_edit->pro_sku)) ? $pro_edit->pro_sku : '' ?>" placeholder="Nhập sku hàng hóa..." required>
		                        	<span class="text-small text-gray help-block-none"><strong>Qui ước</strong> Thương hiệu + chất liệu + thời gian nhập + nơi bán + kích thước + màu sắc. <a href="http://vinafco.com.vn/sku-la-gi" title="Tìm hiểu internet" target="_blank">(JADA110318PRLNA)</a></span>
		                      	</div>
		                    </div>
							
							<div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Chi tiết hàng hóa</label>
		                      	<div class="col-sm-10">
		                        	<textarea class="editorde form-control" name="prodetail" id="prodetail" ><?php echo (isset($pro_edit) && ($pro_edit->pro_detail != '')) ? $pro_edit->pro_detail : ''; ?></textarea><span class="text-small text-gray help-block-none">Nhập mô tả chi tiết...</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Từ khóa</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="protags" value="<?php echo (isset($pro_edit->pro_tags) && !empty($pro_edit->pro_tags)) ? $pro_edit->pro_tags : '' ?>" placeholder="Nhập từ khóa...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Danh mục hàng hóa</label>
		                      	<div class="col-sm-10 mb-3">
			                        <select name="procate" id="procate" class="form-control" onchange="ChangeCate();">
			                        <?php if(count($li_cate) > 0){ ?>
			                        	<?php foreach ($li_cate as $key => $value) { ?>
			                        		<?php 
			                        			$selcat = '';
								    			if(isset($pro_edit) && $pro_edit->pro_cate == $value->cat_id) {
								    				$selcat = 'selected="selected"';
								    			}
			                        		 ?>
			                        		<option value="<?php echo $value->cat_id; ?>" <?php echo $selcat; ?>><?php echo $value->cat_name; ?></option>			
			                        	<?php } ?>
			                        <?php } else { ?>
			                        	<option value="0">Chọn danh mục</option>
			                        <?php } ?>			                          	
			                        </select>
		                        <span class="text-small text-gray help-block-none"><strong></strong>Chọn danh mục cho hàng hóa này</span>
		                      </div>		                      
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Cùng dòng với hàng sau<br><small class="text-primary">Chọn danh mục để thấy các hàng hóa cùng dòng</small></label>
		                      	<div class="col-sm-10">
		                      		<div class="show_relative">
									<?php if(count($list_pro_relative)){ ?>
									<?php
										$relative = array();
										if(isset($pro_edit)){
											$relative = explode(',', $pro_edit->pro_relative);
										}
									 ?>
										<?php foreach ($list_pro_relative as $rp => $vrp) { ?>
											<div class="i-checks" id="checkbox_relative_<?php echo $rp; ?>">
				                          		<input id="checkboxCustom<?php echo $rp; ?>" type="checkbox" class="form-control-custom" name="prorelative[]" id="prorelative" value="<?php echo $vrp->pro_id; ?>" <?php echo (in_array($vrp->pro_id, $relative)) ? 'checked' : ''; ?>>
				                          		<label for="checkboxCustom<?php echo $rp; ?>"><?php echo $vrp->pro_name; ?></label>
				                        	</div>
			                        	<?php } ?>
									<?php } else { ?>
										<span class="text-small text-gray help-block-none" id="no_relative">Chưa có hàng hóa nào trong danh mục này. Vui lòng chọn danh mục khác!</span>
									<?php } ?>
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Số lượng hàng</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="proinstock" value="<?php if(isset($pro_edit->pro_instock) && $pro_edit->pro_instock > 0){ echo $pro_edit->pro_instock; } ?>" placeholder="Nhập số lượng...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Giá hàng</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="procost" value="<?php if(isset($pro_edit->pro_cost) && $pro_edit->pro_cost > 0){ echo $pro_edit->pro_cost; } ?>" placeholder="Nhập giá bán...">
		                        	<span class="text-small text-gray help-block-none"><strong></strong>Đơn vị VNĐ</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

							<div class="form-group row">
		                        <label class="col-sm-2 form-control-label">Khuyến mãi</label>
			                    <div class="col-sm-10">
			                        <div class="form-group">
			                        	<div class="i-checks">
				                          	<input id="checkboxCustom_1" type="checkbox" name="prosaleoff" id="prosaleoff" value="<?php echo (isset($pro_edit) && $pro_edit->pro_saleoff == 1) ? 1 : 0; ?>" class="form-control-custom" data-toggle="collapse" href="#wrap_saleoff" role="button" aria-expanded="false" aria-controls="wrap_saleoff" <?php echo (isset($pro_edit) && $pro_edit->pro_saleoff == 1) ? 'checked' : ''; ?>>
				                          	<label for="checkboxCustom_1">Chạy chương trình khuyến mãi</label>
				                        </div>				                        
			                        </div>

			                        <div class="collapse <?php echo (isset($pro_edit) && $pro_edit->pro_saleoff == 1) ? 'show' : ''; ?>" id="wrap_saleoff">
			                        	<div class="form-group">
					                        <div class="input-group date">
					                        	<input type="text" class="form-control" name="propercent" value="<?php if(isset($pro_edit->pro_percent) && $pro_edit->pro_percent > 0){ echo $pro_edit->pro_percent; } ?>" placeholder="Nhập số phần trăm khuyến mãi...">
					                            <div class="input-group-append"><span class="input-group-text">%</span></div>
					                        </div>
				                        </div>

										<div class="form-group">
				                        	<div class="input-group date">
				                            	<div class="input-group-prepend"><span class="input-group-text">Từ ngày</span></div>
				                            	<input type="date" class="form-control date" name="probeginsale" id="datepicker1" value="<?php echo (isset($pro_edit) && $pro_edit->pro_beginsale != '') ? $pro_edit->pro_beginsale : ''; ?>" placeholder="Nhập hoặc chọn ngày bắt đầu">
				                          </div>
			                       		</div>

			                       		<div class="form-group">
				                        	<div class="input-group">
				                            	<div class="input-group-prepend"><span class="input-group-text">Đến ngày</span></div>
				                            	<input type="date" class="form-control date" name="proendsale" id="datepicker2" value="<?php echo (isset($pro_edit) && $pro_edit->pro_endsale != '') ? $pro_edit->pro_endsale : ''; ?>" placeholder="Nhập hoặc chọn ngày kết thúc">
				                          	</div>
			                       		</div>
			                        </div>
			                    </div>
		                    </div>
		                    
		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Trọng lượng hàng(g)</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="proweight" value="<?php if(isset($pro_edit->pro_weight) && $pro_edit->pro_weight > 0){ echo $pro_edit->pro_weight; } ?>" placeholder="Nhập trọng lượng..."><span class="text-small text-gray help-block-none"><strong></strong>Tỉ lệ 1Kg = 1000g</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Kích thước hàng(mm)</label>
		                      	<div class="col-sm-10">
		                      		<div class="form-group">
		                      			<input type="text" class="form-control" name="prolength" value="<?php if(isset($pro_edit->pro_length) && $pro_edit->pro_length > 0){ echo $pro_edit->pro_length; } ?>" placeholder="Nhập chiều dài..."><span class="text-small text-gray help-block-none"><strong></strong>Dài 1m = 1000mm</span>
		                      		</div>
		                      		<div class="form-group">
		                      			<input type="text" class="form-control" name="prowidth" value="<?php if(isset($pro_edit->pro_width) && $pro_edit->pro_width > 0){ echo $pro_edit->pro_width; } ?>" placeholder="Nhập chiều rộng..."><span class="text-small text-gray help-block-none"><strong></strong>Rộng 1m = 1000mm</span>
		                      		</div>
		                      		<div class="form-group">
		                      			<input type="text" class="form-control" name="proheight" value="<?php if(isset($pro_edit->pro_height) && $pro_edit->pro_height > 0){ echo $pro_edit->pro_height; } ?>" placeholder="Nhập chiều cao..."><span class="text-small text-gray help-block-none"><strong></strong>Cao 1m = 1000mm</span>
		                      		</div>
		                        	
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Dành cho giới tính</label>
			                    <div class="col-sm-10 mb-3">
			                      	<?php $sel1 = ''; $sel2 = ''; $sel3 = '';
			                      		if(isset($pro_edit->pro_forsex) && $pro_edit->pro_forsex == 3){
			                      			$sel3 = 'selected="selected"';
			                      		} else if (isset($pro_edit->pro_forsex) && $pro_edit->pro_forsex == 2) {
			                      			$sel2 = 'selected="selected"';
			                      		} else {
			                      			$sel1 = 'selected="selected"';
			                      		}
			                      	 ?>
			                        <select name="proforsex" class="form-control">
			                          	<option value="3" <?php echo $sel3 ?>>Unisex</option>
			                          	<option value="2" <?php echo $sel2 ?>>Nữ</option>
			                          	<option value="1" <?php echo $sel1 ?>>Nam</option>
			                        </select>
			                    </div>		                      
		                    </div>		                    

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Màu sắc hàng hóa</label>
		                      <div class="col-sm-10 mb-3">
								<select name="procolor" id="procolor" class="form-control">
		                        <?php if(count($li_color) > 0){ ?>
		                        	<?php $selcol0 = false; ?>
		                        	<?php foreach ($li_color as $key => $value) { ?>
		                        		<?php 
		                        			$selcolor = '';
							    			if(isset($pro_edit) && $pro_edit->pro_color == $value->col_id) {
							    				$selcolor = 'selected="selected"';
							    				$selcol0 = true;
							    			}
		                        		 ?>
		                        		<option value="<?php echo $value->col_id; ?>" <?php echo $selcolor; ?>><?php echo $value->col_name; ?></option>			
		                        	<?php } ?>
		                        	<?php if ($selcol0 == false) { ?>
		                        		<option value="0" selected="selected">Chọn màu sắc</option>
		                        	<?php } ?>

		                        <?php } else { ?>
		                        	<option value="0">Chọn màu sắc</option>
		                        <?php } ?>			                          	
		                        </select>	
		                      </div>		                      
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Phong cách hàng hóa</label>
		                      <div class="col-sm-10 mb-3">
								<select name="prostyle" id="prostyle" class="form-control">
		                        <?php if(count($li_style) > 0){ ?>
		                        	<?php $selsty0 = false; ?>
		                        	<?php foreach ($li_style as $key => $value) { ?>
		                        		<?php 
		                        			$selstyle = '';
							    			if(isset($pro_edit) && $pro_edit->pro_style == $value->sty_id) {
							    				$selstyle = 'selected="selected"';
							    				$selsty0 = true;
							    			}
		                        		 ?>
		                        		<option value="<?php echo $value->sty_id; ?>" <?php echo $selstyle; ?>><?php echo $value->sty_name; ?></option>

		                        	<?php } ?>
		                        	<?php if ($selsty0 == false) { ?>
		                        		<option value="0" selected="selected">Chọn phong cách</option>
		                        	<?php } ?>
		                        
		                        <?php } else { ?>
		                        	<option value="0">Chọn phong cách</option>
		                        <?php } ?>			                          	
		                        </select>	
		                      </div>		                      
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Video hàng hóa</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="provideo" value="<?php echo (isset($pro_edit->pro_video) && !empty($pro_edit->pro_video)) ? $pro_edit->pro_video : '' ?>" placeholder="Nhập đường dẫn video..."><span class="text-small text-gray help-block-none"><strong></strong>Nhập đường dẫn từ youtube hoặc một số nền tảng chia sẻ video khác</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tài liệu hướng dẫn</label>
		                      	<div class="col-sm-10">
		                        	<input type="file" class="form-control" name="prodoc[]" value="<?php echo (isset($pro_edit->pro_doc) && !empty($pro_edit->pro_doc)) ? $pro_edit->pro_doc : '' ?>" accept="application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" multiple>
		                        	<span class="text-small text-gray help-block-none">
		                        		<strong>Tài liệu</strong> (nhỏ hơn 10Mb):
		                        		<?php if (isset($pro_edit) && $pro_edit->pro_doc != '') { 
		                        			$docDetail = explode(',', $pro_edit->pro_doc); ?>
			                        		<?php for ($d = 0; $d < count($docDetail); $d++) { ?>
			                        			<span class="show_doc_<?php echo $d; ?>" id="show_doc_<?php echo $d; ?>"><a href="<?php echo '/media/documents/'.$docDetail[$d]; ?>"><?php echo $docDetail[$d]; ?></a><span class="del_doc_<?php echo $d; ?>" onclick="RemoveDoc(<?php echo $d; ?>,'<?php echo $docDetail[$d]; ?>',<?php echo $pro_edit->pro_id; ?>);"> <i class="fa fa-times" style="color: #ff0000; cursor: pointer;"> </i></span></span>
			                        		<?php } ?>
		                        		<?php } ?>
		                        	</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Nổi bật hàng</label>
		                      <div class="col-sm-10 mb-3">
		                      	<?php $selecth0 = ''; $selecth1 = '';
		                      		if(isset($pro_edit->pro_hlight) && $pro_edit->pro_hlight == 1){
		                      			$selecth1 = 'selected="selected"';
		                      		} else {
		                      			$selecth0 = 'selected="selected"';
		                      		}
		                      	 ?>
		                        <select name="prohlight" class="form-control">
		                          	<option value="1" <?php echo $selecth1 ?>>Có</option>
		                          	<option value="0" <?php echo $selecth0 ?>>Không</option>
		                        </select>
		                      </div>		                      
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Xuất bản <span style="color: #ff0000;"> *</span></label>
		                      <div class="col-sm-10 mb-3">
		                      	<?php $select0 = ''; $select1 = '';
		                      		if(isset($con_edit->con_publish) && $con_edit->con_publish == 1){
		                      			$select1 = 'selected="selected"';
		                      		} else {
		                      			$select0 = 'selected="selected"';
		                      		}
		                      	 ?>
		                        <select name="propublish" class="form-control">
		                          <option value="1" <?php echo $select1 ?>>Có</option>
		                          <option value="0" <?php echo $select0 ?>>Không</option>
		                        </select>
		                      </div>		                      
		                    </div>

							
							<!--
		                    <hr>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Password</label>
			                    <div class="col-sm-10">
			                        <input type="password" name="password" class="form-control">
			                    </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Placeholder</label>
			                    <div class="col-sm-10">
			                        <input type="text" placeholder="placeholder" class="form-control">
			                    </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-lg-2 form-control-label">Disabled</label>
		                      	<div class="col-lg-10">
		                        	<input type="text" disabled="" placeholder="Disabled input here..." class="form-control">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Checkboxes and radios <br><small class="text-primary">Normal Bootstrap elements</small></label>
		                      <div class="col-sm-10">
		                        <div>
		                          <input id="option" type="checkbox" value="">
		                          <label for="option">Option one is this and that—be sure to include why it's great</label>
		                        </div>
		                        <div>
		                          <input id="optionsRadios1" type="radio" checked="" value="option1" name="optionsRadios">
		                          <label for="optionsRadios1">Option one is this and that be sure to include why it's great</label>
		                        </div>
		                        <div>
		                          <input id="optionsRadios2" type="radio" value="option2" name="optionsRadios">
		                          <label for="optionsRadios2">Option two can be something else and selecting it will deselect option one</label>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Inline checkboxes</label>
		                      <div class="col-sm-10">
		                        <label class="checkbox-inline">
		                          <input id="inlineCheckbox1" type="checkbox" value="option1"> a
		                        </label>
		                        <label class="checkbox-inline">
		                          <input id="inlineCheckbox2" type="checkbox" value="option2"> b
		                        </label>
		                        <label class="checkbox-inline">
		                          <input id="inlineCheckbox3" type="checkbox" value="option3"> c
		                        </label>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Checkboxes &amp; radios <br><small class="text-primary">Custom elements</small></label>
		                      <div class="col-sm-10">
		                        <div class="i-checks">
		                          <input id="checkboxCustom1" type="checkbox" value="" class="form-control-custom">
		                          <label for="checkboxCustom1">Option one</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="checkboxCustom2" type="checkbox" value="" checked="" class="form-control-custom">
		                          <label for="checkboxCustom2">Option two checked</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="checkboxCustom" type="checkbox" value="" disabled="" checked="" class="form-control-custom">
		                          <label for="checkboxCustom">Option three checked and disabled</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="checkboxCustom3" type="checkbox" value="" disabled="" class="form-control-custom">
		                          <label for="checkboxCustom3">Option four disabled</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="radioCustom1" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
		                          <label for="radioCustom1">Option one</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="radioCustom2" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
		                          <label for="radioCustom2">Option two checked</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="radioCustom3" type="radio" disabled="" checked="" value="option2" class="form-control-custom radio-custom">
		                          <label for="radioCustom3">Option three checked and disabled</label>
		                        </div>
		                        <div class="i-checks">
		                          <input id="radioCustom4" type="radio" disabled="" name="a" class="form-control-custom radio-custom">
		                          <label for="radioCustom4">Option four disabled</label>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Select</label>
		                      <div class="col-sm-10 mb-3">
		                        <select name="account" class="form-control">
		                          <option>option 1</option>
		                          <option>option 2</option>
		                          <option>option 3</option>
		                          <option>option 4</option>
		                        </select>
		                      </div>
		                      <div class="col-sm-10 offset-sm-2">
		                        <select multiple="" class="form-control">
		                          <option>option 1</option>
		                          <option>option 2</option>
		                          <option>option 3</option>
		                          <option>option 4</option>
		                        </select>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row has-success">
		                      <label class="col-sm-2 form-control-label">Input with success</label>
		                      <div class="col-sm-10">
		                        <input type="text" class="form-control is-valid">
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row has-danger">
		                      <label class="col-sm-2 form-control-label">Input with error</label>
		                      <div class="col-sm-10">
		                        <input type="text" class="form-control is-invalid">
		                        <div class="invalid-feedback">Please provide your name.</div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Control sizing</label>
		                      <div class="col-sm-10">
		                        <div class="form-group">
		                          <input type="text" placeholder=".input-lg" class="form-control form-control-lg">
		                        </div>
		                        <div class="form-group">
		                          <input type="text" placeholder="Default input" class="form-control">
		                        </div>
		                        <div class="form-group">
		                          <input type="text" placeholder=".input-sm" class="form-control form-control-sm">
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Column sizing</label>
		                      <div class="col-sm-10">
		                        <div class="row">
		                          <div class="col-md-2">
		                            <input type="text" placeholder=".col-md-2" class="form-control">
		                          </div>
		                          <div class="col-md-3">
		                            <input type="text" placeholder=".col-md-3" class="form-control">
		                          </div>
		                          <div class="col-md-4">
		                            <input type="text" placeholder=".col-md-4" class="form-control">
		                          </div>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"> </div>

		                    <div class="row">
		                      <label class="col-sm-2 form-control-label">Material Inputs</label>
		                      <div class="col-sm-10">
		                        <div class="form-group-material">
		                          <input id="register-username" type="text" name="registerUsername" required class="input-material">
		                          <label for="register-username" class="label-material">Username</label>
		                        </div>
		                        <div class="form-group-material">
		                          <input id="register-email" type="email" name="registerEmail" required class="input-material">
		                          <label for="register-email" class="label-material">Email Address      </label>
		                        </div>
		                        <div class="form-group-material">
		                          <input id="register-password" type="password" name="registerPassword" required class="input-material">
		                          <label for="register-password" class="label-material">Password                                                      </label>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Input groups</label>
		                      <div class="col-sm-10">
		                        <div class="form-group">
		                          <div class="input-group">
		                            <div class="input-group-prepend"><span class="input-group-text">@</span></div>
		                            <input type="text" placeholder="Username" class="form-control">
		                          </div>
		                        </div>
		                        <div class="form-group">
		                          <div class="input-group">
		                            <input type="text" class="form-control">
		                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
		                          </div>
		                        </div>
		                        <div class="form-group">
		                          <div class="input-group">
		                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
		                            <input type="text" class="form-control">
		                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
		                          </div>
		                        </div>
		                        <div class="form-group">
		                          <div class="input-group">
		                            <div class="input-group-prepend">
		                              <div class="input-group-text">
		                                <input type="checkbox">
		                              </div>
		                            </div>
		                            <input type="text" class="form-control">
		                          </div>
		                        </div>
		                        <div class="form-group">
		                          <div class="input-group">
		                            <div class="input-group-prepend">
		                              <div class="input-group-text">
		                                <input type="radio">
		                              </div>
		                            </div>
		                            <input type="text" class="form-control">
		                          </div>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Button addons</label>
		                      <div class="col-sm-10">
		                        <div class="form-group">
		                          <div class="input-group">
		                            <div class="input-group-prepend">
		                              <button type="button" class="btn btn-primary">Go!</button>
		                            </div>
		                            <input type="text" class="form-control">
		                          </div>
		                        </div>
		                        <div class="form-group">
		                          <div class="input-group">
		                            <input type="text" class="form-control">
		                            <div class="input-group-append">
		                              <button type="button" class="btn btn-primary">Go!</button>
		                            </div>
		                          </div>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">With dropdowns</label>
		                      <div class="col-sm-10">
		                        <div class="input-group">
		                          <div class="input-group-prepend">
		                            <button data-toggle="dropdown" type="button" class="btn btn-outline-secondary dropdown-toggle">Action <span class="caret"></span></button>
		                            <div class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a>
		                              <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Separated link</a>
		                            </div>
		                          </div>
		                          <input type="text" class="form-control">
		                        </div>
		                      </div>
		                    </div> -->
							
		                    <div class="line"></div>		                    
		                   
		                    <input type="hidden" name="proid" id="proid" value="<?php echo (isset($pro_edit) && $pro_edit->pro_id > 0) ? $pro_edit->pro_id : 0; ?>">

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                        	<button type="submit" class="btn btn-success btn-create"><?php echo $title_show; ?></button>
						    		<button type="button" class="btn btn-secondary btn-reset" style="display: <?php echo isset($pro_edit) ? 'none' : 'inline-block'; ?>" onclick="ResetForm('frmActProduct', 'proname');">Nhập lại</button>
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/product');">Hủy bỏ</button>
		                      	</div>
		                    </div>

		                  </form>
		                </div>
	              </div>
	            </div>

	          </div>
	        </div>
      	</section>

      	<script src="vendor/tinymce/tinymce.min.js"></script>
		<script type="text/javascript"> 
		    tinymce.init({
				selector: '.editorde',  
				height: 500,
				theme: 'modern',
				skins: 'lightgray',
				plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons template paste textcolor responsivefilemanager',
				toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link image media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat code',
				image_advtab: true,
				menubar: 'edit insert view format table tools help'			
		    });
		</script>
		<script type="text/javascript">
			$(document).ready(function() {

			});

			function CallNext(no){
				$('#proimage' + no).click();
			}

			function PreviewImgAvatar(event, num) {
			    var output = document.getElementById('preview_avatar' + num);
			    output.src = URL.createObjectURL(event.target.files[0]);
			    $(output).parent().parent().removeClass( "hidden" );
			};

			function RemoveImg(i){
				if($('#img_edit'+i).val() != ''){
					$.ajax({
		                type: 'post',
		                url: '/admin/delete-image-product',
		                cache: false,
		                dataType: 'text',
		                data: { img:$('#img_edit'+i).val(), proid: $('#proid'+i).val()},
		                success: function (data) {
		                    var message = '';                  
		                    if (data == '1') {
		                        message = 'Xóa ảnh thành công!';
		                    } else {
		                        message = 'Xóa ảnh không thành công. Vui lòng thử lại!';
		                    }
		                    alert(message);
		                }
		            }); 
				}
				$("#proimage"+i).val("");
				$("#img_avatar"+i).addClass('hidden');				
			}

			function RemoveDoc(d, name, proid){
				var x = confirm('Bạn có chắc chắn muốn xóa tập tin này??');
				if(x == true){
					$.ajax({
		                type: 'post',
		                url: '/admin/delete-doc-product',
		                cache: false,
		                dataType: 'text',
		                data: { name: name, proid: proid},
		                success: function (res) {
		                    var message = '';                  
		                    if (res == '1') {
		                        message = 'Xóa tập tin thành công!';
		                        $('#show_doc_'+ d).remove();
		                    } else {
		                        message = 'Xóa tập tin không thành công. Vui lòng thử lại!';
		                    }
		                    alert(message);
		                }
		            });
				} else {
					return false;
				}
			}

			function ChangeCate(){
				$.ajax({
	                type: 'post',
	                url: '/admin/get-relative-product',
	                cache: false,
	                dataType: 'json',
	                data: { procat: $('#procate').val(), proid: $('#proid').val()},
	                success: function (resp) {
	                    var message = '';                  
	                    if (resp != null && resp.length > 0) {	                       
	                        $('.show_relative').empty();
	                        for(var i = 0; i < resp.length; i++){
	                        	var html = '<div class="i-checks" id="checkbox_relative_'+ i +'"><input id="checkboxCustom'+ i +'" type="checkbox" name="prorelative[]" value="'+ resp[i].PID +'" class="form-control-custom"><label for="checkboxCustom'+ i +'">'+ resp[i].PNAME +'</label></div>';
	                        	$('.show_relative').append(html);
	                        }	                        
	                    } else {
	                    	$('.show_relative').empty();
	                    	$('.show_relative').append('<span class="text-small text-gray help-block-none" id="no_relative">Chưa có hàng hóa nào trong danh mục này. Vui lòng chọn danh mục khác!</span>');
	                    }	                    
	                }
	            });
			}
		</script>


      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    