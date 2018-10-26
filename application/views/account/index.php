<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->
	
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

	<!-- BEGIN:SLIDE SITE -->
	<?php $this->load->view('account/common/block_slide'); ?>
	<!-- END:SLIDE SITE -->

	<div id="stl-body" class="container">
	    <div class="row">
	        <div id="stl-content" class="col-md-12">
				<div class="homecontent"></div>                    
			</div><!--content-->
	    </div>
	</div>
	
	<!-- BEGIN:YOUR STYLE SITE -->
	<?php $this->load->view('account/common/block_yourstyle'); ?>
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
<!-- END:FOOTER COMMON -->

