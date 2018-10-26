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
			        			<h1 class="h3 display"><?php echo $title_show; ?> màu sắc</h1>
			        		</div>
			        	</div> 
			        	<div class="col-sx-12 col-sm-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/color'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>			        			
			        			<a href="/admin/help-color" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
		                  <form name="frmActColor" id="frmActColor" class="form-horizontal" method="post" enctype="multipart/form-data">

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Tên màu sắc <span style="color: #ff0000"> *</span></label>
		                      	<div class="col-sm-10">
		                        	<input type="text" class="form-control" name="colname" id="colname" value="<?php echo (isset($col_edit->col_name) && !empty($col_edit->col_name)) ? $col_edit->col_name : '' ?>" placeholder="Nhập tên màu sắc..." required>
		                      	</div>
		                    </div>		                    

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<label class="col-sm-2 form-control-label">Mô tả màu sắc</label>
		                      	<div class="col-sm-10">
		                        	<textarea class="editor form-control" name="colnote" id="colnote" ><?php echo (isset($col_edit) && ($col_edit->col_note != '')) ? $col_edit->col_note : ''; ?></textarea><span class="text-small text-gray help-block-none">Nhập đoạn tóm tắt ngắn (khoảng 50 đến 100 từ)...</span>
		                      	</div>
		                    </div>		                    

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      <label class="col-sm-2 form-control-label">Xuất bản <span style="color: #ff0000;"> *</span></label>
		                      <div class="col-sm-10 mb-3">
		                      	<?php $select0 = ''; $select1 = '';
		                      		if(isset($col_edit->col_publish) && $col_edit->col_publish == 1){
		                      			$select1 = 'selected="selected"';
		                      		} else {
		                      			$select0 = 'selected="selected"';
		                      		}
		                      	 ?>
		                        <select name="colpublish" class="form-control">
		                          <option value="1" <?php echo $select1 ?>>Có</option>
		                          <option value="0" <?php echo $select0 ?>>Không</option>
		                        </select>
		                      </div>		                      
		                    </div>						

		                    <div class="line"></div>

		                    <div class="form-group row">
		                      	<div class="col-sm-4 offset-sm-2">
		                      		<button type="submit" class="btn btn-success btn-create"><?php echo $title_show; ?></button>
						    		<button type="button" class="btn btn-secondary btn-reset" style="display: <?php echo isset($col_edit) ? 'none' : 'inline-block'; ?>" onclick="ResetForm('frmActColor', 'colname');">Nhập lại</button>
						    		<button type="button" class="btn btn-secondary btn-cancel" onclick="CancelForm('/admin/color');">Hủy bỏ</button>	
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
		
      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->
    </div>
<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    