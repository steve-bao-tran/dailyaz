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
			        			<h1 class="h3 display"><?php echo $title_show; ?> thành viên</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/user'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
			        			<!-- <a href="/admin/excel-product" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a> -->
			        			<a href="/admin/help-user" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                  <form name="frmActUser" id="frmActUser" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tài khoản <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="ususername" id="ususername" value="<?php echo (isset($user_edit->us_username) && !empty($user_edit->us_username)) ? $user_edit->us_username : '' ?>" placeholder="Nhập tên tài khoản..." onblur="checkUsername(this.value)" onkeyup="Notspace(this.value, 'ususername')" required>
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Mật khẩu mới</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="usorigpass"  placeholder="Nhập mật khẩu mới...">
		                        	<span class="text-small text-gray help-block-none"><strong></strong>Khi nào cần đổi mật khẩu cho thành viên</span>
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
									    <input type="file" accept="image" name="usavatar" id="usavatar" value="<?php echo (isset($user_edit) && $user_edit->us_avatar != '') ? $user_edit->us_avatar : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event);" />
									    <div class="img-uploadfile <?php echo (isset($user_edit) && $user_edit->us_avatar != '') ? '' : 'hidden'; ?> " id="img_avatar">
											<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
											    <img class="preview_avatar" id="preview_avatar" src="<?php echo (isset($user_edit) && $user_edit->us_avatar != '' && file_exists('media/images/avatar/'. $user_edit->us_avatar)) ? '/media/images/avatar/'. $user_edit->us_avatar : ''; ?>"/>
											    <span class="delete_avatar" id="delete_avatar" style="cursor: pointer;" onclick="RemoveImg();">X</span>
											</div>								    
								    	</div>
								    	<input type="hidden" name="img_edit" id="img_edit" value="<?php echo (isset($user_edit) && $user_edit->us_avatar != '') ? $user_edit->us_avatar : ''; ?>" >	 
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Họ & Tên</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="usfullname" value="<?php echo (isset($user_edit->us_fullname) && !empty($user_edit->us_fullname)) ? $user_edit->us_fullname : '' ?>" placeholder="Nhập họ tên...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Thư điện tử</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="usemail" id="usemail" value="<?php echo (isset($user_edit->us_email) && !empty($user_edit->us_email)) ? $user_edit->us_email : '' ?>" placeholder="Nhập email..."  onblur="checkEmail(this.value)">
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Số điện thoại</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="usmobile" id="usmobile" value="<?php echo (isset($user_edit->us_mobile) && !empty($user_edit->us_mobile)) ? $user_edit->us_mobile : '' ?>" placeholder="Nhập số điện thoại..." onblur="checkMobile(this.value)">
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Địa chỉ nhà</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="usaddress" value="<?php echo (isset($user_edit->us_address) && !empty($user_edit->us_address)) ? $user_edit->us_address : '' ?>" placeholder="Nhập địa chỉ nhà...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Ngày sinh</label>
		                      	<div class="col-sm-10">
		                      		<div class="input-group date">
		                      			<div class="input-group-prepend"><span class="input-group-text">Chọn ngày</span></div>
		                        		<input type="date" class="form-control date" name="usage" value="<?php echo (isset($user_edit->us_age) && $user_edit->us_age != '') ? $user_edit->us_age : ''; ?>">
		                        	</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Giới tính</label>
		                      	<div class="col-sm-10 mb-3">
		                      		<?php $s1 = ''; $s2 = ''; $s3 = '';
		                      			if(isset($user_edit) && $user_edit->us_gen == 3){
		                      				$s3 = 'selected="selected"';
		                      			} elseif (isset($user_edit) && $user_edit->us_gen == 2) {
		                      				$s2 = 'selected="selected"';
		                      			} else {
		                      				$s1 = 'selected="selected"';
		                      			}
		                      		 ?>
			                        <select name="usgen" id="usgen" class="form-control">
			                          	<option value="1" <?php echo $s1; ?>>Nam</option>
			                          	<option value="2" <?php echo $s2; ?>>Nữ</option>
			                          	<option value="3" <?php echo $s3; ?>>Hỗn hợp</option>
			                        </select>
		                      	</div>		                      
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Nhóm thành viên</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="usgroup" value="<?php echo (isset($user_edit->us_group) && $user_edit->us_group > 0) ? $user_edit->us_group : 0; ?>" placeholder="Nhập số nhóm...">
		                        	<span class="text-small text-gray help-block-none"><strong>Qui ước</strong> 1: quản trị viên, 2: thành viên thường</span>
		                      	</div>
		                    </div>		                    

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Xuất bản <span style="color: #ff0000;"> *</span></label>
		                      	<div class="col-sm-10 mb-3">
			                      	<?php $select0 = ''; $select1 = '';
			                      		if(isset($user_edit->us_publish) && $user_edit->us_publish == 1){
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

		                    <div class="line"></div>

		                    <input type="hidden" name="usid" id="usid" value="<?php echo (isset($user_edit) && (int)$user_edit->us_id > 0) ? (int)$user_edit->us_id : 0; ?>" >

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                        	<button type="submit" class="btn btn-success btn-create"><?php echo $title_show; ?></button>
						    		<button type="button" class="btn btn-secondary btn-reset" style="display: <?php echo isset($user_edit) ? 'none' : 'inline-block'; ?>" onclick="ResetForm('frmActUser', 'ususername');">Nhập lại</button>
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/user');">Hủy bỏ</button>
		                      	</div>
		                    </div>

		                  </form>
		                </div>
	              </div>
	            </div>

	          </div>
	        </div>
      	</section> 
		
		<script type="text/javascript">
			function CallNext(){
				$('#usavatar').click();
			}

			function PreviewImgAvatar(event) {
			    var output = document.getElementById('preview_avatar');
			    output.src = URL.createObjectURL(event.target.files[0]);
			    $(output).parent().parent().removeClass( "hidden" );
			}

			function RemoveImg(){
				if($('#img_edit').val() != ''){
					$.ajax({
		                type: 'post',
		                url: '/admin/delete-image-user',
		                cache: false,
		                dataType: 'text',
		                data: { img:$('#img_edit').val(), usid: $('#usid').val()},
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
				$("#usavatar").val("");
			}			
		</script>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    