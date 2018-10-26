<div class="full-width">
	<div class="blockslideshow">
		<div class="b-content">
			<div class="l-slider">
				<div class="slider" id="home">
				    <div id="main-slider" class="carousel">
				        <div id="carousel-example-generic1" class="carousel slide carousel-fade" data-ride="carousel">
				            <!-- Wrapper for slides -->
				            <div class="carousel-inner" role="listbox">

                            	<div class="item active">
                    				<a href="<?php echo $show_home->sh_url_slide1 ?>">
                    					<img src="<?php echo ($show_home->sh_slide1 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide1)) ? base_url() .'media/images/advertise/'. $show_home->sh_slide1 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="Ví Mèo" title="" width="1200" height="630>" />
                    				</a>                    
                    				<div class="carousel-caption text-right">
                        				<h2 class="upper animation animated-item-1">
                        					<span class="text-color"></span>
                        				</h2>
                    				</div>
                				</div>

                                <div class="item">
                    				<a href="<?php echo $show_home->sh_url_slide2 ?>">
                    					<img src="<?php echo ($show_home->sh_slide2 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide2)) ? base_url() .'media/images/advertise/'. $show_home->sh_slide2 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="vali henry tặng vivo" title="" width="1200" height="630>" />
                    				</a>                    
                    				<div class="carousel-caption text-right">
                        				<h2 class="upper animation animated-item-1">
                        					<span class="text-color"></span>
                        				</h2>
                    				</div>
                				</div>

                                <div class="item">
                    				<a href="<?php echo $show_home->sh_url_slide3 ?>"><img src="<?php echo ($show_home->sh_slide3 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide3)) ? base_url() .'media/images/advertise/'. $show_home->sh_slide3 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="Túi đeo chéo VAN" title="" width="1200" height="630>" />
                    				</a>                    
                    				<div class="carousel-caption text-right">
                        				<h2 class="upper animation animated-item-1">
                        					<span class="text-color"></span>
                        				</h2>
                    				</div>
                				</div>

                                <div class="item">
                                    <a href="<?php echo $show_home->sh_url_slide4 ?>"><img src="<?php echo ($show_home->sh_slide4 != '' && file_exists('media/images/advertise/'. $show_home->sh_slide4)) ? base_url() .'media/images/advertise/'. $show_home->sh_slide4 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="Túi đeo chéo VAN" title="" width="1200" height="630>" />
                                    </a>                    
                                    <div class="carousel-caption text-right">
                                        <h2 class="upper animation animated-item-1">
                                            <span class="text-color"></span>
                                        </h2>
                                    </div>
                                </div>

                            </div>
				            <!-- Controls -->
				            <a class="left carousel-control" href="#carousel-example-generic1" role="button" data-slide="prev">
				            	<span class="fa fa-angle-left fa-2x" aria-hidden="true"></span>
				            	<span class="sr-only">Previous</span>
				            </a>
				            <a class="right carousel-control" href="#carousel-example-generic1" role="button" data-slide="next">
				            	<span class="fa fa-angle-right fa-2x" aria-hidden="true"></span>
				            	<span class="sr-only">Next</span>
				            </a>
				        </div>
				    </div>
				</div>
			</div>

			<div class="r-banner">
				<div class="item">
     				<div class="effect_hover_image">
     					<a href="<?php echo $show_home->sh_url_adver1 ?>">
     						<img src="<?php echo ($show_home->sh_adver1 != '' && file_exists('media/images/advertise/'. $show_home->sh_adver1)) ? base_url() .'media/images/advertise/'. $show_home->sh_adver1 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="TÚI ĐEO BỤNG MISSA" />
     						<span class="hover hover1"></span>
     						<span class="hover hover2"></span>
     						<span class="hover hover3"></span>
     						<span class="hover hover4"></span>
     					</a>
     				</div>
    			</div>
				<div class="item">
     				<div class="effect_hover_image">
     					<a href="<?php echo $show_home->sh_url_adver2 ?>">
     						<img src="<?php echo ($show_home->sh_adver2 != '' && file_exists('media/images/advertise/'. $show_home->sh_adver2)) ? base_url() .'media/images/advertise/'. $show_home->sh_adver2 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="Túi đeo chéo Levi" />
     						<span class="hover hover1"></span>
     						<span class="hover hover2"></span>
     						<span class="hover hover3"></span>
     						<span class="hover hover4"></span>
     					</a>
     				</div>
    			</div>
				<div class="item">
     				<div class="effect_hover_image">
     					<a href="<?php echo $show_home->sh_url_adver3 ?>">
     						<img src="<?php echo ($show_home->sh_adver3 != '' && file_exists('media/images/advertise/'. $show_home->sh_adver3)) ? base_url() .'media/images/advertise/'. $show_home->sh_adver3 : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="TÚI ĐEO CHÉO LUCAS" />
     						<span class="hover hover1"></span>
     						<span class="hover hover2"></span>
     						<span class="hover hover3"></span>
     						<span class="hover hover4"></span>
     					</a>
     				</div>
    			</div>
			</div>
			<script language="javascript">
				$(function(){
					$('.carousel-caption').each(function(){
						var bt = $('h2 span a', this); //alert(bt.attr('href'));
						if(bt.html()){
							$(this).after('<a href="'+bt.attr('href')+'" class="more">'+bt.html()+'</a>');
							bt.hide();
						}
					});
				});
			</script>
		</div>
	</div>
</div>