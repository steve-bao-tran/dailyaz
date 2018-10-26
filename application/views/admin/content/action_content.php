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
     
      	<section class="forms">
	        <div class="container-fluid">
	          	<!-- Page Header-->
		        <header> 
		        	<div class="row">
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-left">
			        			<h1 class="h3 display"><?php echo $title_show; ?> nội dung</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/content'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
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

	            <!-- <div class="col-lg-6">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h4>Basic Form</h4>
	                </div>
	                <div class="card-body">
	                  <p>Lorem ipsum dolor sit amet consectetur.</p>
	                  <form>
	                    <div class="form-group">
	                      <label>Email</label>
	                      <input type="email" placeholder="Email Address" class="form-control">
	                    </div>
	                    <div class="form-group">       
	                      <label>Password</label>
	                      <input type="password" placeholder="Password" class="form-control">
	                    </div>
	                    <div class="form-group">       
	                      <input type="submit" value="Signin" class="btn btn-primary">
	                    </div>
	                  </form>
	                </div>
	              </div>
	            </div>

	            <div class="col-lg-6">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h4>Horizontal Form</h4>
	                </div>
	                <div class="card-body">
	                  <p>Lorem ipsum dolor sit amet consectetur.</p>
	                  <form class="form-horizontal">
	                    <div class="form-group row">
	                      <label class="col-sm-2">Email</label>
	                      <div class="col-sm-10">
	                        <input id="inputHorizontalSuccess" type="email" placeholder="Email Address" class="form-control form-control-success"><small class="form-text">Example help text that remains unchanged.</small>
	                      </div>
	                    </div>
	                    <div class="form-group row">
	                      <label class="col-sm-2">Password</label>
	                      <div class="col-sm-10">
	                        <input id="inputHorizontalWarning" type="password" placeholder="Pasword" class="form-control form-control-warning"><small class="form-text">Example help text that remains unchanged.</small>
	                      </div>
	                    </div>
	                    <div class="form-group row">       
	                      <div class="col-sm-10 offset-sm-2">
	                        <input type="submit" value="Signin" class="btn btn-primary">
	                      </div>
	                    </div>
	                  </form>
	                </div>
	              </div>
	            </div>

	            <div class="col-lg-8">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h4>Inline Form</h4>
	                </div>
	                <div class="card-body">
	                  <form class="form-inline">
	                    <div class="form-group">
	                      <label for="inlineFormInput" class="sr-only">Name</label>
	                      <input id="inlineFormInput" type="text" placeholder="Jane Doe" class="mr-3 form-control">
	                    </div>
	                    <div class="form-group">
	                      <label for="inlineFormInputGroup" class="sr-only">Username</label>
	                      <input id="inlineFormInputGroup" type="text" placeholder="Username" class="mr-3 form-control form-control">
	                    </div>
	                    <div class="form-group">
	                      <input type="submit" value="Submit" class="mr-3 btn btn-primary">
	                    </div>
	                  </form>
	                </div>
	              </div>
	            </div>

	            <div class="col-lg-4">
	              <div class="card">
	                <div class="card-header d-flex align-items-center">
	                  <h4>Modal Form</h4>
	                </div>
	                <div class="card-body text-center">
	                  <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Form in simple modal </button>
	                  <!-- Modal-->
	                  <!--<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
	                    <div role="document" class="modal-dialog">
	                      <div class="modal-content">
	                        <div class="modal-header">
	                          <h5 id="exampleModalLabel" class="modal-title">Signin Modal</h5>
	                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
	                        </div>
	                        <div class="modal-body">
	                          <p>Lorem ipsum dolor sit amet consectetur.</p>
	                          <form>
	                            <div class="form-group">
	                              <label>Email</label>
	                              <input type="email" placeholder="Email Address" class="form-control">
	                            </div>
	                            <div class="form-group">       
	                              <label>Password</label>
	                              <input type="password" placeholder="Password" class="form-control">
	                            </div>
	                            <div class="form-group">       
	                              <input type="submit" value="Signin" class="btn btn-primary">
	                            </div>
	                          </form>
	                        </div>
	                        <div class="modal-footer">
	                          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
	                          <button type="button" class="btn btn-primary">Save changes</button>
	                        </div>
	                      </div>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div> -->

	            <div class="col-lg-12">
	              	<div class="card">
		                <div class="card-body">
		                  <form name="frmActContent" id="frmActContent" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tiêu đề <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="contitle" id="contitle" value="<?php echo (isset($con_edit->con_title) && !empty($con_edit->con_title)) ? $con_edit->con_title : '' ?>" placeholder="Nhập tiêu đề..." required>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Ảnh đại diện</label>
		                      	<div class="col-sm-10">
		                        	<div class="form-group">		    
									    <div class="btn-uploadfile btn-cursor" onclick="CallNext();">
											<br>
											<i class="fa fa-camera fa-4x"></i>
											<br>
											<span>Ảnh đại diện</span>
											<span class="add">+</span>
									    </div>
									    <input type="file" accept="image" name="conimage" id="conimage" value="<?php echo (isset($con_edit) && $con_edit->con_image != '') ? $con_edit->con_image : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event);" />
									    <div class="img-uploadfile <?php echo (isset($con_edit) && $con_edit->con_image != '') ? '' : 'hidden'; ?> " id="img_avatar">
											<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
											    <img class="preview_avatar" id="preview_avatar" src="<?php echo (isset($con_edit) && $con_edit->con_image != '' && file_exists('media/images/content/'. $con_edit->con_image)) ? '/media/images/content/'. $con_edit->con_image : ''; ?>"/>
											    <span class="delete_avatar" id="delete_avatar" style="cursor: pointer;" onclick="RemoveImg();">X</span>
											</div>								    
								    	</div>
								    	<input type="hidden" name="img_edit" id="img_edit" value="<?php echo (isset($con_edit) && $con_edit->con_image != '') ? $con_edit->con_image : ''; ?>" >
								    	<input type="hidden" name="conid" id="conid" value="<?php echo (isset($con_edit) && (int)$con_edit->con_id > 0) ? (int)$con_edit->con_id : 0; ?>" >						    
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tóm tắt</label>
		                      	<div class="col-sm-10">
		                        	<textarea class="editor form-control" name="conintro" id="conintro" ><?php echo (isset($con_edit) && ($con_edit->con_intro != '')) ? $con_edit->con_intro : ''; ?></textarea><span class="text-small text-gray help-block-none">Nhập đoạn tóm tắt ngắn (khoảng 50 đến 100 từ)...</span>
		                      	</div>
		                    </div>
							
							<div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Nội dung</label>
		                      	<div class="col-sm-10">
		                        	<textarea class="editorde form-control" name="condetail" id="condetail" ><?php echo (isset($con_edit) && ($con_edit->con_detail != '')) ? $con_edit->con_detail : ''; ?></textarea><span class="text-small text-gray help-block-none">Nhập nội dung chi tiết...</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Từ khóa</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="contags" value="<?php echo (isset($con_edit->con_tags) && !empty($con_edit->con_tags)) ? $con_edit->con_tags : '' ?>" placeholder="Nhập từ khóa...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Loại nội dung</label>
		                      	<div class="col-sm-10 mb-3">
		                      		<?php $s1 = ''; $s2 = ''; $s3 = ''; $s4 = '';
		                      			if(isset($con_edit) && $con_edit->con_type == 4){
		                      				$s4 = 'selected="selected"';
		                      			} elseif (isset($con_edit) && $con_edit->con_type == 3) {
		                      				$s3 = 'selected="selected"';
		                      			} elseif (isset($con_edit) && $con_edit->con_type == 2) {
		                      				$s2 = 'selected="selected"';
		                      			} else {
		                      				$s1 = 'selected="selected"';
		                      			}
		                      		 ?>
			                        <select name="contype" id="contype" class="form-control contype" onchange="ChangeType();">			                        	
			                          	<option value="1" <?php echo $s1; ?>>Bài viết thường</option>
			                          	<option value="2" <?php echo $s2; ?>>Bài viết Blogs</option>
			                          	<option value="3" <?php echo $s3; ?>>Bài viết khuyến mãi</option>
			                          	<option value="4" <?php echo $s4; ?>>Bài viết hướng dẫn</option>
			                        </select>
		                      	</div>		                      
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Danh mục nội dung</label>
		                      	<div class="col-sm-10 mb-3">
			                        <select name="concatid" id="concatid" class="form-control concatid" <?php echo (isset($con_edit) && $con_edit->con_type != 1) ? 'disabled' : ''; ?>>
			                        <?php if(count($li_cate) > 0){ ?>
			                        	<?php foreach ($li_cate as $key => $value) { ?>
			                        		<?php 
			                        			$selcat = '';
								    			if(isset($con_edit) && $con_edit->con_catid == $value->cat_id) {
								    				$selcat = 'selected="selected"';
								    			}
			                        		 ?>
			                        		<option value="<?php echo $value->cat_id; ?>" <?php echo $selcat; ?>><?php echo $value->cat_name; ?></option>			
			                        	<?php } ?>
			                        <?php } else { ?>
			                        	<option value="0">Chọn danh mục</option>
			                        <?php } ?>			                          	
			                        </select>
		                        <span class="text-small text-gray help-block-none"><strong>Bài viết thường</strong> mới có danh mục</span>
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
		                        <select name="conpublish" class="form-control">
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

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                      		<button type="submit" class="btn btn-success btn-create"><?php echo $title_show; ?></button>
						    		<button type="button" class="btn btn-secondary btn-reset" style="display: <?php echo isset($con_edit) ? 'none' : 'inline-block'; ?>" onclick="ResetForm('frmActContent', 'contitle');">Nhập lại</button>
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/content');">Hủy bỏ</button>	
		                      	</div>
		                    </div>

		                  </form>
		                </div>
	              </div>
	            </div>

	          </div>
	        </div>
      	</section>

      	<script src="../vendor/tinymce/tinymce.min.js"></script>
      	<script type="text/javascript"> 
		    tinymce.init({
				selector: '.editor',  
				height: 100,
				theme: 'modern',
				skins: 'lightgray',
				plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons template paste textcolor responsivefilemanager',
				toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link image media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat code',
				image_advtab: true,
				menubar: 'edit insert view format table tools help'			
		    });
		</script>

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
			function CallNext(){
				$('#conimage').click();
			}

			var PreviewImgAvatar = function(event) {
			    var output = document.getElementById('preview_avatar');
			    output.src = URL.createObjectURL(event.target.files[0]);
			    $(output).parent().parent().removeClass( "hidden" );
			};

			function RemoveImg(){
				if($('#img_edit').val() != ''){
					$.ajax({
		                type: 'post',
		                url: '/admin/delete-image-content',
		                cache: false,
		                dataType: 'text',
		                data: { img:$('#img_edit').val(), conid: $('#conid').val()},
		                success: function (data) {
							console.log(data);
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
				$(".img-uploadfile").addClass('hidden');
				$("#conimage").val("");
			}

			function ChangeType(){
				if($('#contype').val() == 1){
					$( "#concatid" ).prop( "disabled", false );		
				} else {
					$( "#concatid" ).prop( "disabled", true );	
				}				
			}
		</script>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    