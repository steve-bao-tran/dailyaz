<!-- BEGIN:HEADER COMMON -->
<?php $this->load->view('account/common/header_common'); ?>
<!-- END:HEADER COMMON -->
	<!-- BEGIN:HEADER SITE -->
	<?php $this->load->view('account/common/header'); ?>
	<!-- END:HEADER SITE -->
	<?php include_once $_SERVER['DOCUMENT_ROOT'] ."/smart_resize_image.function.php"; ?>
	<link href="<?php echo base_url() ?>templates/css/detail.css" rel="stylesheet" type="text/css" />	
	<link href="<?php echo base_url() ?>templates/css/jquery.jqzoom.css" rel="stylesheet" type="text/css" />	

	<div id="stl-body" class="container">
	    <div class="row">
			
			<!-- BEGIN:SLIDE SITE -->
			<?php $this->load->view('account/common/block_breadcrumb'); ?>
			<!-- END:SLIDE SITE -->	

	        <div id="stl-content" class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	        	
				<div class="usercontent">
					
					<div class="content-body">
						
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
						
						<div class="productcontent">
							<?php if ($product) { ?>
							<?php 
								$img = explode(',', $product->pro_image);
								$image = 'media/images/default/no_image.jpg';							

								for ($i = 0; $i < count($img); $i++) {
									if ($product->pro_image != '' && file_exists('media/images/product/'. $product->pro_dir .'/'. $img[$i])) {
										$image = 'media/images/product/'. $product->pro_dir .'/'. $img[$i];
									}

									$resized380 = 'media/images/product/'. $product->pro_dir .'/thumbnail_380_'. $img[$i];
									$resized75 = 'media/images/product/'. $product->pro_dir .'/thumbnail_75_'. $img[$i];
									$resized55 = 'media/images/product/'. $product->pro_dir .'/thumbnail_55_'. $img[$i];
									if ($product->pro_image != '' && ! file_exists('media/images/product/'. $product->pro_dir .'/thumbnail_380_'. $img[$i])) {
										smart_resize_image($image, null, 380, 380, false, $resized380, false , false ,100);
									}

									if ($product->pro_image != '' && $i == 0 && ! file_exists('media/images/product/'. $product->pro_dir .'/thumbnail_75_'. $img[$i])) {
										smart_resize_image($image, null, 75, 75, false, $resized75, false , false ,100);
									}

									if ($product->pro_image != '' && ! file_exists('media/images/product/'. $product->pro_dir .'/thumbnail_55_'. $img[$i])) {
										smart_resize_image($image, null, 55, 55, false, $resized55, false , false ,100);
									}

								}

							 ?>							

								<div class="productcontent">
									<div class="product_detail" itemscope="" itemtype="http://schema.org/Product">
										
									  	<div id="product-preview" class="col-md-5">
									  		<div class="preview">
										
												<a href="<?php echo base_url() . 'media/images/product/'. $product->pro_dir .'/'. $img[0] ?>" target="_blank" onclick="window.open(this.href,'win2','width=780,height=540,menubar=yes,resizable=yes'); return false;" class="jqzoom" rel="gal1" title="" style="outline-style: none; text-decoration: none;">
													<div class="zoomPad">
														<img src="<?php echo ($product->pro_image != '' && file_exists('media/images/product/'. $product->pro_dir .'/thumbnail_380_'. $img[0])) ? 'media/images/product/'. $product->pro_dir .'/thumbnail_380_'. $img[0] : 'media/images/default/no_image.jpg' ?>" border="0" title="<?php echo $product->pro_name ?>" align="" alt="<?php echo $product->pro_name ?>" hspace="0" vspace="0" id="fullimg_preview" itemprop="image" style="opacity: 1;">
														<div class="zoomPup" style="top: 226px; left: 55px; width: 185px; height: 129px; position: absolute; border-width: 1px; display: none;"></div>
														<div class="zoomWindow" style="position: absolute; z-index: 5001; left: 366px; top: 0px; display: none;">
															<div class="zoomWrapper" style="width: 500px;">
																<div class="zoomWrapperTitle" style="width: 100%; position: absolute; display: block;"><?php echo $product->pro_name ?></div>
																<div class="zoomWrapperImage" style="width: 100%; height: 350px;">
																	<img src="<?php echo ($product->pro_image != '' && file_exists('media/images/product/'. $product->pro_dir .'/'. $img[0])) ? base_url() .'media/images/product/'. $product->pro_dir .'/'. $img[0] : base_url() .'media/images/default/no_image.jpg' ?>" style="position: absolute; border: 0px; display: block; left: -151.011px; top: -612.135px;">
																</div>
															</div>
														</div>
														<div class="zoomPreload" style="visibility: hidden; top: 165.5px; left: 142px; position: absolute;">Loading zoom</div>
													</div>
												</a>
											</div>

											<div class="thumblist">
												<ul>
													<?php for ($j = 0; $j < count($img); $j++) { ?>
														<?php 
															if ($product->pro_image != '' && file_exists('media/images/product/'. $product->pro_dir .'/thumbnail_55_'. $img[$j])) { 
																$imagethumb55 = 'media/images/product/'. $product->pro_dir .'/thumbnail_55_'. $img[$j];
															}

															if ($product->pro_image != '' && file_exists('media/images/product/'. $product->pro_dir .'/thumbnail_380_'. $img[$j])) { 
																$imagethumb380 = 'media/images/product/'. $product->pro_dir .'/thumbnail_380_'. $img[$j];
															}
														?>
														<li src="<?php echo base_url() . $imagethumb380 ?>" class="thumb_preview current">
															<a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: <?php echo '/'. $imagethumb380 ?>,largeimage: <?php echo base_url() .'media/images/product/'. $product->pro_dir .'/'. $img[$j] ?>}" class="zoomThumbActive">
																<img src="<?php echo $imagethumb55; ?>" alt="<?php echo $product->pro_name ?>">
															</a>
														</li>
													<?php } ?>
													
												</ul>
											</div>

											<div class="break"></div>

											<script language="javascript">
											$(document).ready(function(){
												$('.thumb_preview').click(function(){
													var src = $(this).attr('src');
													$('.thumb_preview').each(function(){$(this).removeClass('current');});
													$(this).addClass('current');
													$('#fullimg_preview').attr('src',src);
													$('#fullimg_preview').hide();
													$('#fullimg_preview').fadeIn(800);
												});
											});

											// change color
											function changeFullImg2(img, index){
												var path = img+'&w=380&h=400';
												var img = getObj('fullimg_preview');
												img.src=path;
											}

											</script>

											<script type="text/javascript">
												$(document).ready(function() {
													$('.jqzoom').jqzoom({
											            zoomType: 'standard',
											            lens:true,
											            preloadImages: false,
											            alwaysOn:false,
											            zoomWidth: 500,
											            zoomHeight: 350
											        });													
												});
											</script>
											<link href="css/jquery.jqzoom.css" type="text/css" rel="stylesheet">
											<script language="javascript" src="js/jquery.jqzoom.js"></script>
										</div>

									    <div class="product-info col-md-4">
									    	<h1 class="pname">
									    		<span itemprop="name"><?php echo $product->pro_name ?></span>
									    	</h1>

									        <div class="mf_logo"></div>

									        <p>
									            P/N: <strong><?php echo $product->pro_sku ?></strong> &nbsp; 
									            <a href="javascript:void(0)" class="like fancybox1 fancybox.iframe1" onclick="addFav(<?php echo $product->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thích</a>&nbsp; &nbsp;
									            <span class="comment1">(<?php echo $product->pro_view ?>) Lượt xem</span>
									        </p>

									        Tình trạng: <b>Còn hàng</b><br>
											<span class="price">Giá: <?php echo ($product->pro_saleoff == 1) ? number_format($product->pro_cost - $product->DISCOUNT, 0, '.','.') : number_format($product->pro_cost, 0, '.','.'); ?>đ</span> &nbsp;
									        <!-- <a href="/he-thong-cua-hang-leetee.html" class="nearstores">Liên hệ của hàng gần nhất</a> -->
									        <div class="shipping_txt">
									        	<p><strong>(Thanh toán khi nhận hàng</strong></p>
												<p><strong>Giao hàng từ 3 - 5 ngày làm việc</strong><br>
													<strong>Xem phí gửi hàng&nbsp;<a href="chinh-sach-van-chuyen.html">tại đây!</a> )</strong>
												</p>
											</div>

									        <span class="title">Mô tả</span>

										   	<span itemprop="description">
									   			<?php $vovel = array("&curren;");
                            						echo html_entity_decode(str_replace($vovel, "#", $product->pro_detail)); 
                            					?>
											</span>

									        <span class="promotxt"> </span>

											<?php if (count($re_pro)) { ?>
									            <div class="productListBuymore">
													<div class="title">CHỌN MÀU SẮC KHÁC</div>
													<div class="plist">	
														<?php foreach ($re_pro as $value) { ?>	
								   						<div class="item">
								        					<a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name) ?>" title="<?php echo $value->pro_name ?>">
								        						<img src="<?php echo ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_75_'. explode(',', $value->pro_image)[0])) ? 'media/images/product/'. $value->pro_dir .'/thumbnail_75_'. explode(',', $value->pro_image)[0] : 'media/images/default/no_image.jpg' ?>" alt="<?php echo $value->pro_name ?>" border="0" title="<?php echo $value->pro_name ?>" class="imglink">
								        					</a>
								            			</div>
								            			<?php } ?>
													</div>
												</div>
											<?php } ?>

											<br class="break"></div>

								    		<div class="product-buy col-sm-3">
							        			<div class="bookmarks">Chia sẻ &nbsp;
							        				<?php $link_share = base_url() .'san-pham/'. $product->pro_id .'-'. RemoveSign($product->pro_name); ?>
							        				<a href="http://www.facebook.com/share.php?u=<?php echo $link_share ?>&amp;t=<?php echo $product->pro_name ?>" title="Facebook!" target="_blank">
							        					<img style="width: 10%; margin-bottom: 22px; border-radius: 3px;" src="/templates/images/account/icon_face.png" alt="Facebook!" align="absmiddle">
							        				</a>

							        				<a href="https://plus.google.com/share?url=<?php echo $link_share ?>" title="Google!" target="_blank">
							        					<img style="width: 10%; margin-bottom: 22px; border-radius: 3px;" src="/templates/images/account/icon_google+.jpg" alt="Google!" align="absmiddle">
							        				</a>

							        				<a href="https://twitter.com/intent/tweet?status=<?php echo $link_share ?>" title="Twitter!" target="_blank">
							        					<img style="width: 10%; margin-bottom: 22px; border-radius: 3px;" src="/templates/images/account/icon_twiter.png" alt="Twitter!" align="absmiddle">
							        				</a>

							        				<!-- <a href="http://link.apps.zing.vn/share?url=<?php echo $link_share ?>&amp;title=<?php echo $product->pro_name ?>" title="Zalo!" target="_blank">
							        					<img style="width: 9%;" src="/templates/images/account/icon_zalo.jpg" alt="Zalo!" align="absmiddle">
							        				</a> -->

							        				<div class="zalo-share-button" data-href="<?php echo $link_share ?>" data-oaid="3454874117992033100" data-layout="3" data-color="blue" data-customize="false" title="Zalo!"></div>
							        			</div>        
							        			<!-- like button -->

								            	<!-- // like button-->
								   				<div class="box-frm" style="margin-top: -15px;">
								                  	<form action="index.php" method="post">
								              			<div class="quantity-ctr">
								              				<span>Số lượng</span>
								            				<input type="button" class="control down" value="-" onclick="change_qty(-1);">
								                			<input type="text" name="quantity" id="quantity" value="1" class="inputbox quantity" readonly="readonly" size="5">
								                			<input type="button" class="control up" onclick="change_qty(1);" value="+">
								              			</div>							              		

								              			<div class="promotion">
								        					<p><!-- promotion here--></p>
								              			</div>								              			
								              			<span class="addtocart bt" onclick="addCart(<?php echo $product->pro_id ?>);" >Thêm vào giỏ hàng</span>
								              			<input type="submit" class="buy bt" name="quickbuy" onclick="buyNow(<?php echo $product->pro_id ?>);" value="Mua ngay">
								              		</form>

								                    <a type="button" class="addtofav bt fancybox1 fancybox.iframe1" href="javascript:void(0)" onclick="addFav(<?php echo $product->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thêm vào yêu thích</a>

								          			<div class="support">
								            			<span class="t">BẠN CẦN TƯ VẤN?</span><br>
								            			Hotline: <?php echo HOTLINE ?><br>
								            			Thời gian: <?php echo WORKTIME ?>
								          			</div>

								          			<div class="callme">
							           					<h4>Bạn cần <?php echo Company ?> gọi cho bạn?</h4>
						                				<div class="box">
						                					<input type="number" class="inputbox hint" id="callmyphone" placeholder="Nhập số điện thoại của bạn" maxlength="15"> 
						                					<input type="submit" class="button2" onclick="callMe(<?php echo $product->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">
						               					</div>	
						                				<input type="hidden" name="pid" value="<?php echo $product->pro_id ?>">
								          			</div>
								              
								        		</div>	
								    		</div>
									    
									    	<div class="break"></div>
									    
									        <h4 class="modheading" style="font-size: 24px;">Sản phẩm xem thêm</h4>
									        	
								        	<div class="productList">
								        	<?php if (count($pro_in_cat) > 0) { ?>
								        		<?php foreach ($pro_in_cat as $key => $value) { ?>
													<div class="item col-xs-6 col-sm-4 col-md-2">
									        			<div class="i">
												    		<a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" class="view">Xem ngay</a>
												    	</div>
												        <div class="thumb" id="thumb-img">
												        	<?php if ($value->pro_saleoff == 1) { ?>
												        		<span class="icon saleoff"><?php echo $value->pro_percent ?>%</span>
												        	<?php } ?>
												        	<?php if (round((time() - strtotime($value->pro_createdate))/604800) <= 7) { ?>
												            	<span class="icon new">New</span>
												            <?php } ?>
												            <?php if (false) { ?>
									            				<span class="gift"></span>
									            			<?php } ?>
											            	<a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" title="<?php echo $value->pro_name ?>">
											                	<img src="<?php echo ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0])) ? 'media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0] : 'media/images/default/no_image.jpg' ?>" border="0" alt="<?php echo $value->pro_name ?>">
											            	</a>
												        </div>
														
														<div class="bt-item">
												            <h4><a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>"><?php echo $value->pro_name ?></a></h4>
												            <a href="javascript:void(0)" class="like fancybox1 fancybox.iframe1" onclick="addFav(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thích</a>
												            <span class="comment1"><?php echo '('. $value->pro_view .') Lượt xem'; ?></span>
												            <div class="info">
												            	<?php if ($value->pro_instock > 0) { ?>
													            	<?php if ($value->pro_saleoff == 1) { ?>
													            		<del><?php echo number_format($value->pro_cost, 0, '.','.'); ?></del>
													            	<?php } ?>
												               		<span class="price"><?php echo ($value->pro_saleoff == 1) ? number_format($value->pro_cost - $value->DISCOUNT, 0, '.','.') : number_format($value->pro_cost, 0, '.','.'); ?>đ</span>
												               		<a href="javascript:void(0)" class="cart" onclick="addCart(<?php echo $value->pro_id ?>);"></a>
												               	<?php } else { ?> 
												               		<a class="notice-btn" href="javascript:void(0)" onclick="notifyMe(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thông báo tôi khi có hàng</a>
												               		<br><b class="red">Hết hàng</b>               
												               	<?php } ?>                
												            </div>
												        </div>
												        <a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" class="bg-hover"></a>	
													</div>
												<?php } ?>
											<?php } ?>
											</div>

											<br class="break">
									        
									        <h4 class="modheading" style="font-size: 24px;">Sản phẩm bạn vừa xem</h4>
									        <div class="productList">
									        <?php if (count($pro_viewed) > 0) { ?>
												<?php foreach ($pro_viewed as $key => $value) { ?>
									        	<div class="item col-xs-6 col-sm-4 col-md-2">
											    	<div class="i">
											    		<a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" class="view">Xem ngay</a>
											    	</div>
											        <div class="thumb">
											        	<?php if ($value->pro_saleoff == 1) { ?>
											        		<span class="icon saleoff"><?php echo $value->pro_percent ?>%</span>
											        	<?php } ?>
											        	<?php if (round((time() - strtotime($value->pro_createdate))/604800) <= 7) { ?>
											            	<span class="icon new">New</span>
											            <?php } ?>
											            <?php if (false) { ?>
											            	<span class="gift"></span>
											            <?php } ?>

											            <a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" title="<?php echo $value->pro_name ?>">
											                <img src="<?php echo ($value->pro_image != '' && file_exists('media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0])) ? 'media/images/product/'. $value->pro_dir .'/thumbnail_174_'. explode(',', $value->pro_image)[0] : 'media/images/default/no_image.jpg' ?>" border="0" alt="<?php echo $value->pro_name ?>">
											            </a>
											        </div>
											        <div class="bt-item">
											            <h4><a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>"><?php echo $value->pro_name ?></a></h4>
											            <a href="javascript:void(0)" class="like fancybox1 fancybox.iframe1" onclick="addFav(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thích</a>
											            <span class="comment1"><?php echo '('. $value->pro_view .') Lượt xem'; ?></span>
											            <div class="info">
											            	<?php if ($value->pro_instock > 0) { ?>
												            	<?php if ($value->pro_saleoff == 1) { ?>
												            		<del><?php echo number_format($value->pro_cost, 0, '.','.'); ?></del>
												            	<?php } ?>
											               		<span class="price"><?php echo ($value->pro_saleoff == 1) ? number_format($value->pro_cost - $value->DISCOUNT, 0, '.','.') : number_format($value->pro_cost, 0, '.','.'); ?>đ</span>
											               		<a href="javascript:void(0)" class="cart" onclick="addCart(<?php echo $value->pro_id ?>);"></a>
											               	<?php } else { ?> 
											               		<a class="notice-btn" href="javascript:void(0)" onclick="notifyMe(<?php echo $value->pro_id ?>, <?php echo ($this->session->userdata('sessionUser')) ? $this->session->userdata('sessionUser') : 0 ?>);">Thông báo tôi khi có hàng</a>
											               		<br><b class="red">Hết hàng</b>               
											               	<?php } ?>                
											            </div>
											        </div>
											        <a href="<?php echo base_url() .'san-pham/'. $value->pro_id .'-'. RemoveSign($value->pro_name); ?>" class="bg-hover"></a>
												</div>
												<?php } ?>
											<?php } ?>												
											</div>

											<br class="break">

											<div align="right">
												<a href="<?php echo base_url() ?>san-pham/xem-gan-day" class="">Xem tất cả &gt;</a>
											</div>

											<br class="break">

											<h2 class="modheading"><span>Thông tin sản phẩm <?php echo $product->pro_name ?></span></h2>

											<br class="break">&nbsp;

											<table class="tech_pro" cellspacing="0" border="0">
											</table>
									      
									<!-- Comments -->
									<div class="product-comments">
									    <div class="comments">
									    	<div class="c-title">Bình luận</div>
									  		<p><b>(0) Ý kiến khách hàng về Sản phẩm <?php echo $product->pro_name ?></b>.
									        Hãy là người đầu tiên đánh giá sản phẩm này.</p>
									    	<div class="reviews">
									    		<div class="content"></div><!-- content-->
											</div>

											<br class="break">

											<script language="javascript">
												$(document).ready(function(){
													$('a.reply-review').click(function(){
														$('.reply-review-frm').each(function(){$(this).hide('slow');});
														//$(this).hide('slow');
														var id = $(this).attr('id'); 
														var display = $('div#reply-review-'+id).css('display');
														display = display.toLowerCase(); //alert(display);
														if(display == 'none')
															$('div#reply-review-'+id).show('slow');
													});
												});

												$(document).ready(function(){
													$("a.like-review").click(function(){
														$(this).attr('href','index.php?m=product&t=like_review&tpl=m&id='+$(this).attr('rid'));
													});
													
													/*$("a.like-review").fancybox({
														'width'				: 530,
														'height'			: 50,
														'autoScale'			: true,
														'titleShow'			: false,
														'transitionIn'		: 'none',
														'transitionOut'		: 'none',
														'type'				: 'iframe'
													});*/

												});
											</script>
									    </div>

									    <div class="comment-form">
									    	<script language="javascript" src="/theme/modules/product/js/vote.js"></script>
											<script language="javascript">
												var default_point = 5;
											</script>
											<a name="commentform"></a>
									<form class="validateform" action="index.php" method="post">
									<h4>Ý kiến của bạn</h4>
									<div class="row">
									<div class="col-sm-6">
										<p>Đánh giá (*) <span class="em_rating"><img src="images/rating/ratingOn.png" class="votestart" onclick="setRating(1)" onmouseover="votestart(1)" onmouseout="resetvote();" id="votestart1"><img src="images/rating/ratingOn.png" class="votestart" onclick="setRating(2)" onmouseover="votestart(2)" onmouseout="resetvote();" id="votestart2"><img src="images/rating/ratingOn.png" class="votestart" onclick="setRating(3)" onmouseover="votestart(3)" onmouseout="resetvote();" id="votestart3"><img src="images/rating/ratingOn.png" class="votestart" onclick="setRating(4)" onmouseover="votestart(4)" onmouseout="resetvote();" id="votestart4"><img src="images/rating/ratingOn.png" class="votestart" onclick="setRating(5)" onmouseover="votestart(5)" onmouseout="resetvote();" id="votestart5"></span></p>
									        <table width="95%" border="0" cellspacing="0" cellpadding="3">
									          <tbody><tr>
									           <td></td>
									            <td></td>
									          </tr>
									          <tr>
									            <td nowrap="nowrap">Tiêu đề (*)</td>
									            <td><input type="text" name="title" value="" class="inputbox required" size="30" maxlength="50"></td>
									           </tr>
									           <tr>
									             <td nowrap="nowrap">Tên (*)</td>
									             <td><input type="text" name="name" value="" class="inputbox required" size="30" maxlength="40"></td>
									          </tr>
									          <tr>
									            <td>Email</td>
									            <td><input type="text" name="email" value="" class="inputbox email" size="30" maxlength="40"></td>
									          </tr>
									        </tbody></table>
									</div>
									<div class="col-sm-6">
									    	<strong>Nội dung nhận xét: </strong>(Gõ tiếng Việt có dấu)<br>
									        <textarea name="review_text" rows="5" class="inputbox required" cols="40" maxlength="500"></textarea>
									        <p><input type="submit" value="Gửi nhận xét" name="submit" class="button"> &nbsp; <input type="reset" class="button" value="Làm lại"></p>
									</div>
									</div>

										<input type="hidden" name="m" value="product">
										<input type="hidden" name="t" value="save_review">
										<input type="hidden" name="rating" value="5" id="user_rating">
										<input type="hidden" name="pid" value="1058">
									    <input type="hidden" name="id" value="">
										<input type="hidden" name="return" value="aW5kZXgucGhwP209cHJvZHVjdCZ0PWRldGFpbCZpZD0xMDU4OmJhbG8tcm9ja3ktbWF1LWxvdA==">
									    <input type="hidden" name="uid" value="">
									    <div class="review_token"><input type="hidden" name="be4b9feff9f8cf842edb40671b317ed8" value="1"></div>
									    </form>
									    </div>
									    </div><!-- bottom-->
									  
									</div><!-- detail -->

									<script language="javascript">
										function change_qty(q){
											var v = $('input.quantity').val(); 
											v = parseInt(v);
											v = v + q;
											if (v < 1) v = 1;
											$('input.quantity').val(v);
										}

										$('span.comment').click(function(){
											$('html,body').animate({
												scrollTop: $('.product-comments').offset().top
											}, 500);
										});
									</script>

									<!-- Location -->
									<script language="javascript">
										navigator.geolocation.getCurrentPosition(function(location) {
											  _link = $('.nearstores').attr('href');
											  _link += '?crd='+location.coords.latitude+','+location.coords.longitude;
											  //_link += '&acc='+location.coords.accuracy;
											  $('.nearstores').attr('href', _link);
										});
									</script>
								</div>						
							<?php } else { ?>
								<div>Đang cập nhật...</div>
							<?php } ?>
						</div>						

					</div>

				</div>

			 </div>
				
			<!-- BEGIN:SLIDE SITE -->
			<?php // $this->load->view('account/common/sidebar_right'); ?>
			<!-- END:SLIDE SITE -->	
			
	    </div>
	</div>

	<?php $this->load->view('account/common/popup'); ?>
	
	<!-- BEGIN:YOUR STYLE SITE -->
	<?php // $this->load->view('account/common/block_yourstyle'); ?>
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
<!-- END:FOOTER COMMON