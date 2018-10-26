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
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-left">
			        			<h1 class="h3 display">THÔNG TIN HỆ THỐNG</h1>
			        		</div>
			        	</div>
			        	<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">
			        		<div class="pull-right">
			        			<a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/system-info'; ?>" class="btn btn-outline-success" title="Trở lại trang trước"><i class="fa fa-arrow-left"></i> Trở lại</a>			        					        			
			        			<a href="/admin/help-system" class="btn btn-outline-warning" title="Giúp đỡ"><i class="fa fa-question"></i> Trợ giúp</a>
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
							<div class="row d-flex align-items-stretch">
								
								<div class="user_my_info" style="margin-left: 20px;">

									<!-- <?php foreach ($dulieu as $value) {
										echo $value->name.'<br>';
									} ?> -->

									<?php echo $dulieu[4]->name; ?>
				                    
									<?php
	                                    #General
	         //                            ob_start();
										// phpinfo(1);
										// preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);
										// echo "<div class='phpinfodisplay'><style type='text/css'>\n", join("\n", array_map(create_function('$i','return ".phpinfodisplay " . preg_replace( "/,/", ",.phpinfodisplay ", $i );'), preg_split( '/\n/', $matches[1] ))), "</style>\n", $matches[2], "\n</div>\n";
	         //                            #Configuration
	         //                            ob_start();
										// phpinfo(4);
										// preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);
										// echo "<div class='phpinfodisplay'><style type='text/css'>\n", join("\n", array_map(create_function('$i','return ".phpinfodisplay " . preg_replace( "/,/", ",.phpinfodisplay ", $i );'), preg_split( '/\n/', $matches[1] ))), "</style>\n", $matches[2], "\n</div>\n";
										// #Credits
	         //                            ob_start();
										// phpinfo(2);
										// preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);
										// echo "<div class='phpinfodisplay'><style type='text/css'>\n", join("\n", array_map(create_function('$i','return ".phpinfodisplay " . preg_replace( "/,/", ",.phpinfodisplay ", $i );'), preg_split( '/\n/', $matches[1] ))), "</style>\n", $matches[2], "\n</div>\n";
										// #Configuration
	         //                            ob_start();
										// phpinfo(3);
										// preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);
										// echo "<div class='phpinfodisplay'><style type='text/css'>\n", join("\n", array_map(create_function('$i','return ".phpinfodisplay " . preg_replace( "/,/", ",.phpinfodisplay ", $i );'), preg_split( '/\n/', $matches[1] ))), "</style>\n", $matches[2], "\n</div>\n";

										ob_start();
										phpinfo();
										preg_match ('%<style type="text/css">(.*?)</style>.*?(<body>.*</body>)%s', ob_get_clean(), $matches);
										echo "<div class='phpinfodisplay'><style type='text/css'>\n", join("\n", array_map(create_function('$i','return ".phpinfodisplay " . preg_replace( "/,/", ",.phpinfodisplay ", $i );'), preg_split( '/\n/', $matches[1] ))), "</style>\n", $matches[2], "\n</div>\n";
	                                ?>				                   

								</div>
								
							</div>
		                </div>
		              </div>
		            </div>
          		</div>
        	</div>
      	</section>      	

      	<!-- BEGIN: FOOTER -->
      	<?php $this->load->view('admin/common/footer'); ?>
      	<!-- END: FOOTER -->

    </div>

<!-- BEGIN: FOOTER COMMON -->
<?php $this->load->view('admin/common/footer_common'); ?>
<!-- END: FOOTER COMMON -->    