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
			        			<h1 class="h3 display"><?php echo $title_show; ?> phong cách</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/style'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
			        			<!-- <a href="/admin/excel-style" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a> -->
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

	            <div class="col-lg-12">
	              	<div class="card">
		                <div class="card-body">
		                  <form name="frmActStyle" id="frmActStyle" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tên phong cách <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="styname" id="styname" value="<?php echo (isset($sty_edit->sty_name) && !empty($sty_edit->sty_name)) ? $sty_edit->sty_name : '' ?>" placeholder="Nhập tên phong cách..." required>
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
									    <input type="file" accept="image" name="styimage" id="styimage" value="<?php echo (isset($sty_edit) && $sty_edit->sty_image != '') ? $sty_edit->sty_image : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event);" />
									    <div class="img-uploadfile <?php echo (isset($sty_edit) && $sty_edit->sty_image != '') ? '' : 'hidden'; ?> " id="img_avatar">
											<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
											    <img class="preview_avatar" id="preview_avatar" src="<?php echo (isset($sty_edit) && $sty_edit->sty_image != '' && file_exists('media/images/style/'. $sty_edit->sty_image)) ? '/media/images/style/'. $sty_edit->sty_image : ''; ?>"/>
											    <span class="delete_avatar" id="delete_avatar" style="cursor: pointer;" onclick="RemoveImg();">X</span>
											</div>								    
								    	</div>
								    	<input type="hidden" name="img_edit" id="img_edit" value="<?php echo (isset($sty_edit) && $sty_edit->sty_image != '') ? $sty_edit->sty_image : ''; ?>" >
								    	<input type="hidden" name="styid" id="styid" value="<?php echo (isset($sty_edit) && (int)$sty_edit->sty_id > 0) ? (int)$sty_edit->sty_id : 0; ?>" >						    
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Mô tả phong cách</label>
		                      	<div class="col-sm-10">
		                        	<textarea class="editor form-control" name="stynote" id="stynote" ><?php echo (isset($sty_edit) && ($sty_edit->sty_note != '')) ? $sty_edit->sty_note : ''; ?></textarea><span class="text-small text-gray help-block-none">Nhập đoạn tóm tắt ngắn (khoảng 50 đến 100 từ)...</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Gán đường dẫn</label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="styurlimage" value="<?php echo (isset($sty_edit->sty_url_image) && !empty($sty_edit->sty_url_image)) ? $sty_edit->sty_url_image : '' ?>" placeholder="Nhập đường dẫn cho ảnh...">
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Xuất bản <span style="color: #ff0000;"> *</span></label>
		                      <div class="col-sm-10 mb-3">
		                      	<?php $select0 = ''; $select1 = '';
		                      		if(isset($sty_edit->sty_publish) && $sty_edit->sty_publish == 1){
		                      			$select1 = 'selected="selected"';
		                      		} else {
		                      			$select0 = 'selected="selected"';
		                      		}
		                      	 ?>
		                        <select name="stypublish" class="form-control">
		                          <option value="1" <?php echo $select1 ?>>Có</option>
		                          <option value="0" <?php echo $select0 ?>>Không</option>
		                        </select>
		                      </div>		                      
		                    </div>						

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                      		<button type="submit" class="btn btn-success btn-create"><?php echo $title_show; ?></button>
						    		<button type="button" class="btn btn-secondary btn-reset" style="display: <?php echo isset($sty_edit) ? 'none' : 'inline-block'; ?>" onclick="ResetForm('frmActStyle', 'styname');">Nhập lại</button>
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/style');">Hủy bỏ</button>	
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
			function CallNext(){
				$('#styimage').click();
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
		                url: '/admin/delete-image-style',
		                cache: false,
		                dataType: 'text',
		                data: { img:$('#img_edit').val(), styid: $('#styid').val()},
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
				$("#styimage").val("");
			}
		</script>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    