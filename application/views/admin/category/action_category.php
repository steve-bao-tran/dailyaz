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
			        			<h1 class="h3 display"><?php echo $title_show; ?> danh mục</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/category'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>
			        			<!-- <a href="/admin/excel-product" class="btn btn-outline-info" title="Xuất excel"><i class="fa fa-file-excel-o"></i> Xuất excel</a> -->
			        			<a href="/admin/help-category" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                  <form name="frmActCategory" id="frmActCategory" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tên danh mục <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="catname" id="catname" value="<?php echo (isset($cat_edit->cat_name) && !empty($cat_edit->cat_name)) ? $cat_edit->cat_name : '' ?>" placeholder="Nhập tên danh mục..." required>
		                      	</div>
		                    </div>

		                    <div class="line"></div>		                    

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Ảnh đại diện</label>
		                      	<div class="col-sm-10">		                      		
		                        	<div class="form-group">
										<div class="btn-uploadfile btn-cursor" onclick="CallNext('catimage');">
											<br>
											<i class="fa fa-camera fa-4x"></i>
											<br>
											<span>Đăng ảnh</span>
											<span class="add">+</span>
									    </div>
									    <input type="file" accept="image" name="catimage" id="catimage" value="<?php echo (isset($cat_edit) && $cat_edit->cat_image != '') ? $cat_edit->cat_image : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar');" />
									    <div class="img-uploadfile <?php echo (isset($cat_edit) && $cat_edit->cat_image != '') ? '' : 'hidden'; ?> " id="img_avatar">
											<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
											    <img class="preview_avatar" id="preview_avatar" src="<?php echo (isset($cat_edit) && $cat_edit->cat_image != '' && file_exists('media/images/category/'. $cat_edit->cat_image)) ? '/media/images/category/'. $cat_edit->cat_image : ''; ?>"/>
											    <span class="delete_avatar" id="delete_avatar" style="cursor: pointer;" onclick="RemoveImg('img_edit', 'catimage', 'img_avatar', 0);">X</span>
											</div>								    
								    	</div>
						    			<input type="hidden" name="img_edit" id="img_edit" value="<?php echo (isset($cat_edit) && $cat_edit->cat_image != '') ? $cat_edit->cat_image : ''; ?>" >
									</div>
		                      	</div>
		                    </div>

		                    <div class="line"></div>
							
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">Ảnh đại diện trang chủ</label>
		                      	<div class="col-sm-10">
				                    <div class="form-group">
				                    	<div class="btn-uploadfile btn-cursor" onclick="CallNext('catimage1');">
											<br>
											<i class="fa fa-camera fa-4x"></i>
											<br>
											<span>Đăng ảnh</span>
											<span class="add">+</span>
									    </div>
									    <input type="file" accept="image" name="catimage1" id="catimage1" value="<?php echo (isset($cat_edit) && $cat_edit->cat_image1 != '') ? $cat_edit->cat_image1 : ''; ?>" style="display: none" onchange="PreviewImgAvatar(event, 'preview_avatar1');" />
									    <div class="img-uploadfile <?php echo (isset($cat_edit) && $cat_edit->cat_image1 != '') ? '' : 'hidden'; ?> " id="img_avatar1">
											<div style="display: table-cell; vertical-align: middle;height: 140px; width: 140px;">
											    <img class="preview_avatar" id="preview_avatar1" src="<?php echo (isset($cat_edit) && $cat_edit->cat_image1 != '' && file_exists('media/images/category/'. $cat_edit->cat_image1)) ? '/media/images/category/'. $cat_edit->cat_image1 : ''; ?>"/>
											    <span class="delete_avatar" id="delete_avatar1" style="cursor: pointer;" onclick="RemoveImg('img_edit1', 'catimage1', 'img_avatar1', 1);">X</span>
											</div>								    
								    	</div>
						    			<input type="hidden" name="img_edit1" id="img_edit1" value="<?php echo (isset($cat_edit) && $cat_edit->cat_image1 != '') ? $cat_edit->cat_image1 : ''; ?>" >
				                    </div>
				                </div>
		                    </div>
							
							<div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Mô tả danh mục</label>
		                      	<div class="col-sm-10">
		                        	<textarea class="editorde form-control" name="catdesc" id="catdesc" ><?php echo (isset($cat_edit) && ($cat_edit->cat_desc != '')) ? $cat_edit->cat_desc : ''; ?></textarea><span class="text-small text-gray help-block-none">Nhập mô tả danh mục...</span>
		                      	</div>
		                    </div>

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Xuất bản <span style="color: #ff0000;"> *</span></label>
		                      <div class="col-sm-10 mb-3">
		                      	<?php $select0 = ''; $select1 = '';
		                      		if(isset($cat_edit->cat_publish) && $cat_edit->cat_publish == 1){
		                      			$select1 = 'selected="selected"';
		                      		} else {
		                      			$select0 = 'selected="selected"';
		                      		}
		                      	 ?>
		                        <select name="catpublish" class="form-control">
		                          <option value="1" <?php echo $select1 ?>>Có</option>
		                          <option value="0" <?php echo $select0 ?>>Không</option>
		                        </select>
		                      </div>		                      
		                    </div>
							
		                    <div class="line"></div>		                    
		                   
		                    <input type="hidden" name="catid" id="catid" value="<?php echo (isset($cat_edit) && $cat_edit->cat_id > 0) ? $cat_edit->cat_id : 0; ?>">

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                        	<button type="submit" class="btn btn-success btn-create"><?php echo $title_show; ?></button>
						    		<button type="button" class="btn btn-secondary btn-reset" style="display: <?php echo isset($cat_edit) ? 'none' : 'inline-block'; ?>" onclick="ResetForm('frmActCategory', 'catname');">Nhập lại</button>
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/category');">Hủy bỏ</button>
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
			function CallNext(e){
				$('#'+e).click();
			}

			function PreviewImgAvatar(event, pre) {
			    var output = document.getElementById(pre);
			    output.src = URL.createObjectURL(event.target.files[0]);
			    $(output).parent().parent().removeClass( "hidden" );
			};

			function RemoveImg(i, m, n, l){
				if($('#'+i).val() != ''){
					$.ajax({
		                type: 'post',
		                url: '/admin/delete-image-category',
		                cache: false,
		                dataType: 'text',
		                data: { img: $('#'+i).val(), catid: $('#catid').val(), num: l},
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
				$('#'+m).val('');
				$('#'+n).addClass('hidden');			
			}			
		</script>

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    