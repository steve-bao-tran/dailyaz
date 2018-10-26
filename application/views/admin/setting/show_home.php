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
			        			<h1 class="h3 display">Cài đặt hiển thị trang chủ</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/settup-home'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
			        			<a href="/admin/help-home" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                  <form name="frmActHome" id="frmActHome" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Ảnh silder</label>
		                      	<div class="col-sm-10">
		                        	<div class="form-group">
		                        		<div class="row">

			                        		<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shslide1');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh silder 1</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shslide1" id="shslide1" value="<?php echo (isset($show_home) && $show_home->sh_slide1 != '') ? $show_home->sh_slide1 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar1');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_slide1 != '') ? '' : 'hidden'; ?> " id="img_avatar1">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatar1" src="<?php echo (isset($show_home) && $show_home->sh_slide1 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide1)) ? '/media/images/advertise/'. $show_home->sh_slide1 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar1" style="cursor: pointer;" onclick="RemoveImg('img_edit1', 's1', 'img_avatar1', 'shslide1');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edit1" value="<?php echo (isset($show_home) && $show_home->sh_slide1 != '') ? $show_home->sh_slide1 : ''; ?>" >
											</div>

											<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shslide2');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh silder 2</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shslide2" id="shslide2" value="<?php echo (isset($show_home) && $show_home->sh_slide2 != '') ? $show_home->sh_slide2 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar2');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_slide2 != '') ? '' : 'hidden'; ?> " id="img_avatar2">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatar2" src="<?php echo (isset($show_home) && $show_home->sh_slide2 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide1)) ? '/media/images/advertise/'. $show_home->sh_slide2 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar2" style="cursor: pointer;" onclick="RemoveImg('img_edit2', 's2', 'img_avatar2', 'shslide2');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edit2" value="<?php echo (isset($show_home) && $show_home->sh_slide2 != '') ? $show_home->sh_slide2 : ''; ?>" >
											</div>

											<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shslide3');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh silder 3</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shslide3" id="shslide3" value="<?php echo (isset($show_home) && $show_home->sh_slide3 != '') ? $show_home->sh_slide3 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar3');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_slide3 != '') ? '' : 'hidden'; ?> " id="img_avatar3">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatar3" src="<?php echo (isset($show_home) && $show_home->sh_slide3 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide3)) ? '/media/images/advertise/'. $show_home->sh_slide3 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar3" style="cursor: pointer;" onclick="RemoveImg('img_edit3', 's3', 'img_avatar3', 'shslide3');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edit3" value="<?php echo (isset($show_home) && $show_home->sh_slide3 != '') ? $show_home->sh_slide3 : ''; ?>" >
											</div>

											<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shslide4');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh silder 4</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shslide4" id="shslide4" value="<?php echo (isset($show_home) && $show_home->sh_slide4 != '') ? $show_home->sh_slide4 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar4');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_slide4 != '') ? '' : 'hidden'; ?> " id="img_avatar4">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatar4" src="<?php echo (isset($show_home) && $show_home->sh_slide4 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide4)) ? '/media/images/advertise/'. $show_home->sh_slide4 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatar4" style="cursor: pointer;" onclick="RemoveImg('img_edit4', 's4', 'img_avatar4', 'shslide4');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edit4" value="<?php echo (isset($show_home) && $show_home->sh_slide4 != '') ? $show_home->sh_slide4 : ''; ?>" >
											</div>


										</div>
									</div>
		                      	</div>
		                    </div>		                    

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn slide 1</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurlslide1" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_slide1)) ? $show_home->sh_url_slide1 : '' ?>" placeholder="Nhập đường dẫn cho ảnh slide 1...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn slide 2</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurlslide2" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_slide2)) ? $show_home->sh_url_slide2 : '' ?>" placeholder="Nhập đường dẫn cho ảnh slide 2...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn slide 3</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurlslide3" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_slide3)) ? $show_home->sh_url_slide3 : '' ?>" placeholder="Nhập đường dẫn cho ảnh slide 3...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn slide 4</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurlslide4" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_slide4)) ? $show_home->sh_url_slide4 : '' ?>" placeholder="Nhập đường dẫn cho ảnh slide 4...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Ảnh quảng cáo</label>
		                      	<div class="col-sm-10">
		                        	<div class="form-group">
		                        		<div class="row">

			                        		<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shadver1');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh quảng cáo 1</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shadver1" id="shadver1" value="<?php echo (isset($show_home) && $show_home->sh_adver1 != '') ? $show_home->sh_adver1 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatara1');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_adver1 != '') ? '' : 'hidden'; ?> " id="img_avatara1">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatara1" src="<?php echo (isset($show_home) && $show_home->sh_adver1 != '' && file_exists('media/images/advertise/'. $show_home->sh_adver1)) ? '/media/images/advertise/'. $show_home->sh_adver1 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatara1" style="cursor: pointer;" onclick="RemoveImg('img_edita1', 'a1', 'img_avatara1', 'shadver1');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edita1" value="<?php echo (isset($show_home) && $show_home->sh_adver1 != '') ? $show_home->sh_adver1 : ''; ?>" >
											</div>

											<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shadver2');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh quảng cáo 2</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shadver2" id="shadver2" value="<?php echo (isset($show_home) && $show_home->sh_adver2 != '') ? $show_home->sh_adver2 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatara2');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_adver2 != '') ? '' : 'hidden'; ?> " id="img_avatara2">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatara2" src="<?php echo (isset($show_home) && $show_home->sh_adver2 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide1)) ? '/media/images/advertise/'. $show_home->sh_adver2 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatara2" style="cursor: pointer;" onclick="RemoveImg('img_edita2', 'a2', 'img_avatara2', 'shadver2');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edita2" value="<?php echo (isset($show_home) && $show_home->sh_adver2 != '') ? $show_home->sh_adver2 : ''; ?>" >
											</div>

											<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">		    
											    <div class="btn-uploadfile btn-cursor" onclick="CallNext('shadver3');">
													<br>
													<i class="fa fa-camera fa-4x"></i>
													<br>
													<span>Ảnh quảng cáo 3</span>
													<span class="add">+</span>
											    </div>
											    <input type="file" accept="image" name="shadver3" id="shadver3" value="<?php echo (isset($show_home) && $show_home->sh_adver3 != '') ? $show_home->sh_adver3 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatara3');" />
											    <div class="img-uploadfile <?php echo (isset($show_home) && $show_home->sh_adver3 != '') ? '' : 'hidden'; ?> " id="img_avatara3">
													<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
													    <img class="preview_avatar" id="preview_avatara3" src="<?php echo (isset($show_home) && $show_home->sh_adver3 != '' && file_exists('media/images/advertise/'. $show_home->sh_adver3)) ? '/media/images/advertise/'. $show_home->sh_adver3 : ''; ?>"/>
													    <span class="delete_avatar" id="delete_avatara3" style="cursor: pointer;" onclick="RemoveImg('img_edita3', 'a3', 'img_avatara3', 'shadver3');">X</span>
													</div>								    
										    	</div>
										    	<input type="hidden" id="img_edita3" value="<?php echo (isset($show_home) && $show_home->sh_adver3 != '') ? $show_home->sh_adver3 : ''; ?>" >
											</div>

										</div>
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn quảng cáo 1</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurladver1" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_adver1)) ? $show_home->sh_url_adver1 : '' ?>" placeholder="Nhập đường dẫn cho ảnh quảng cáo 1...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn quảng cáo 2</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurladver2" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_adver2)) ? $show_home->sh_url_adver2 : '' ?>" placeholder="Nhập đường dẫn cho ảnh quảng cáo 2...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn quảng cáo 3</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="shurladver3" value="<?php echo (isset($show_home) && !empty($show_home->sh_url_adver3)) ? $show_home->sh_url_adver3 : '' ?>" placeholder="Nhập đường dẫn cho ảnh quảng cáo 3...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                      		<button type="submit" class="btn btn-success btn-create">Cập nhật</button>						    		
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/show_home');">Hủy bỏ</button>	
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
			function CallNext(e){
				$('#' + e).click();
			}

			function PreviewImgAvatar(event, review) {
			    var output = document.getElementById(review);
			    output.src = URL.createObjectURL(event.target.files[0]);
			    $(output).parent().parent().removeClass( "hidden" );
			}

			function RemoveImg(i, e, m, d){
				if($('#'+i).val() != ''){
					$.ajax({
		                type: 'post',
		                url: '/admin/delete-image-show-home',
		                cache: false,
		                dataType: 'text',
		                data: { img : $('#'+i).val(), pos : e},
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
				$('#' + m).addClass('hidden');
				$('#'+ d).val('');
			}
		</script>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    