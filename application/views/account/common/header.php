<?php 
	$cart = $this->session->userdata('cart');
	$num = 0;
	if (! empty($cart)) {
		foreach ($cart as $kc => $vc) {				
			$num += (int)$vc['quantityc'];
		}
	}
 ?>
<div id="stl-top" class="container">
  	<div class="row">
        <div class="logo col-md-2">
        	<a href="<?php echo base_url() ?>" title="DAILYAZ.COM">
        		<h1><p><img src="<?php echo base_url() ?>templates/images/logo.png" /></p></h1>
        	</a>
        </div>

        <div class="top col-md-6">
        	<div class="blockhotline">        		
        		<div class="b-content">Gọi ngay  <?php echo HOTLINE; ?></div>
			</div>
			<div class="blocksearch">
				<div class="b-content">
					<script language="javascript" src="<?php echo base_url() ?>templates/js/ajax.js"> </script>
					<div class="top-search">
    					<form method="post" action="<?php echo base_url() ?>san-pham/tim-kiem" name="frmSearch" id="frmSearch">
	    					<div class="box">	        					
	        					<input type="text" class="inputbox" name="q" id="search" value="<?php echo (isset($q) && $q != '') ? $q : '' ?>" placeholder="Nhập tên túi xách, ví, balo,..." autocomplete="off" onkeyup="SearchQ(this.value);">
	        					<ul id="listboxsearch"></ul>
	    					</div>
	       					<button class="button" type="submit"></button>
    					</form>
 					</div>   
 					<i>Tìm nhiều nhất: túi xách kales, túi bác hồ, balo du lịch, ...</i>
					<script language="javascript">
						function SearchQ(q = '') {
							$.ajax({
					            type: "POST",
					            dataType: "json",
					            url: siteUrl + 'product/get_product',
					            data: {q: q},
					            success: function (result) {
					            	console.log(result);  
					                if (result != null && result.error == false) {
					                	$('#listboxsearch').empty();
					                	$('#listboxsearch').css('display', 'block');
					                	var count = Object.keys(result).length - 1;
					                	var html = '';
					                	for(var i = 0; i < count; i++){
					                		html += '<li><a href="'+ result[i].link +'"><img src="'+ result[i].image +'"><span class="pull-right"><h5>'+ result[i].name +'</h5><span class="price">'+ result[i].cost +'</span></span><cite style="font-style: normal; text-decoration: line-through"></cite></a></li>';
					                	}
					                	$('#listboxsearch').html(html);
					                } else {
					                	$('#listboxsearch').empty();
					                	$('#listboxsearch').css('display', 'none');
					                }
					            },
					            error: function () {
					            }
					        });
						}

						function submitFrmSearch(){	var f = document.frmSearch;	if(f.k.value != 'Nhập tên túi xách, ví, balo... cần tìm?') f.submit();}
						
						function getCatSearch(cat_name, cat_id){
							var f = document.frmSearch;
							getObj('catProductName').innerHTML = cat_name;
							f.catid.value = cat_id;
							getObj('dropCatList').style.display = 'none';
						}

						$(document).ready(function(){
							$('li#showdropcatlist').hover(
								function() { $('#dropCatList', this).css('display', 'block'); },
								function() { $('#dropCatList', this).css('display', 'none'); 
							});
						});

						var _m_timeout;

						$(document).ready(function(){
							$('#q').keyup(function(){
								var ajax = new SAjax();
								ajax.setVar("m", 'product');
								ajax.setVar("t", 'aj_kwsearch');
								ajax.setVar("k", $('#q').val());
								ajax.setVar("catid", document.frmSearch.catid.value);
								
								$('#listboxsearch').css('display','block');
								ajax.method = 'POST';
								ajax.element = 'listboxsearch';
								ajax.runAJAX();
							});
								
							$('#q').blur(function(){
								_m_timeout = setTimeout("hideListboxs()", 200);
							});
								
							$('#listboxsearch').scroll(function(){
								clearTimeout(_m_timeout);
								$('#listboxsearch').blur(function(){
									_m_timeout = setTimeout("hideListboxs()", 200);
								});
							});
							
						});

						function hideListboxs(){
							$('#listboxsearch').css('display','none');
						}

						function getrk(obj){
							submitFrmSch(obj.innerHTML);
						}

						function submitFrmSch(k, _link){
							window.location.href=_link;
						}
					</script>
				</div>
			</div>
		</div>

		<div class="top-right col-md-4">
			<div class="blocksocial">
				<div class="b-content">
					<p><a target="_blank" href="<?php echo (isset($infous->info_facebook) && $infous->info_facebook != '') ? $infous->info_facebook : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/facebook.png" alt="Facebook" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_googleplus) && $infous->info_googleplus != '') ? $infous->info_googleplus: ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/googleplus.png" alt="Google+" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_twitter) && $infous->info_twitter != '') ? $infous->info_twitter : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/twitter.png" alt="Twitter" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_youtube) && $infous->info_youtube != '') ? $infous->info_youtube : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/youtube.png" alt="Youtube" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_pinterest) && $infous->info_pinterest != '') ? $infous->info_pinterest : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/pin.png" alt="Pin" />
						</a> 
						<a target="_blank" href="<?php echo (isset($infous->info_linkin) && $infous->info_linkin != '') ? $infous->info_linkin : ''; ?>">
							<img src="<?php echo base_url() ?>templates/images/social/in.png" alt="In" />
						</a>
					</p>
				</div>
			</div>
			<div class="blockcart">
				<div class="b-content">
					<div class="bcart">
						<?php if ($this->session->userdata('sessionUser')) { ?>
		    				<span class="myaccount">
								<a href="<?php echo base_url() ?>tai-khoan/thong-tin" class="a" style="background:url('<?php echo base_url() ?>templates/images/default.png') no-repeat left;"><?php echo $this->session->userdata('sessionName'); ?></a>
						        <ul style="display: none;">
						        	<li><a href="<?php echo base_url() ?>tai-khoan/thong-tin">Thông tin tài khoản</a></li>
						            <li><a href="<?php echo base_url() ?>tai-khoan/don-hang">Đơn hàng của tôi</a></li>
						            <li><a href="<?php echo base_url() ?>tai-khoan/san-pham-thich">Danh sách yêu thích</a></li>
						            <li><a href="<?php echo base_url() ?>tai-khoan/san-pham-xem">Danh sách vừa xem</a></li>
						            <li><a href="<?php echo base_url() ?>tai-khoan/dang-xuat" class="logout">Đăng xuất</a></li>
						        </ul>						    
						    </span>
	    				<?php } else { ?>
	    					<a href="<?php echo base_url() ?>tai-khoan/dang-nhap" class="a">Đăng nhập</a>
	    					<a href="<?php echo base_url() ?>tai-khoan/dang-ky" class="a">Đăng ký</a>
	    				<?php } ?> 
	        			<a href="<?php echo base_url() ?>tai-khoan/san-pham-thich" class="f">Yêu thích</a>
	    				<a href="<?php echo base_url() ?>gio-hang" class="t">Giỏ hàng <span class="num"><?php echo '('. $num .')' ?></span><span id="minicart"></span></a>
					</div>
					<script language="javascript">
						$(function(){
							$('.myaccount').hover(
								function() { $('ul', this).css('display', 'block'); },
								function() { $('ul', this).css('display', 'none');}
							);
						});
						
						/*$(document).ready(function(){
							$('.bcart a.t').hover(
								function() { $('#minicart', this).css('display', 'block');showminicart(); },
								function() { $('#minicart', this).css('display', 'none'); 
							});
						});

						function showminicart(){
							var ajax = new SAjax();
							ajax.setVar("m", 'product');
							ajax.setVar("t", 'aj_cart');
							ajax.method = 'POST';
							ajax.element = 'minicart';
							ajax.runAJAX();
						}*/
					</script>
				</div>
			</div>
		</div>

		<div class="main-menu">
			<nav class="b-main-menu navbar navbar-default">
			    <div class="navbar-header">
			      	<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			        </button>
			    </div>
	    		<div class="navbar-collapse collapse" id="navbar">       
					<ul class="nav navbar-nav">
						<li class=" <?php echo (isset($me_active) && $me_active == 'home') ? 'current' : '' ?>"><a href="<?php echo base_url() ?>"><span>Trang chủ</span></a></li>

						<li class=" dropdown <?php echo (isset($me_active) && $me_active == 'product') ? 'current' : '' ?>"><a href="<?php echo base_url() ?>danh-muc"><span>Sản phẩm</span></a>
							<ul class="dropdown-menu lv1" role="menu">
								<?php if($cate_menu) { ?>
									<?php $all = 0; ?>
									<?php foreach ($cate_menu as $key => $value) { ?>
									<?php $all += $value->count; ?>
										<li class="">
											<a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>">
												<span><?php echo $value->cat_name .' ('. $value->count .')'; ?></span>
											</a>
											<span class="banner banner<?php echo $key; ?>">
												<img src="<?php echo base_url() .'media/images/category/'. $value->cat_image; ?>" alt="<?php echo $value->cat_name; ?>" />
											</span>
										</li>
									<?php } ?>
									<li class="">
										<a href="<?php echo base_url() .'san-pham/tat-ca-san-pham'; ?>">
											<span><?php echo 'Tất cả sản phẩm' .' ('. $all .')'; ?></span>
										</a>
										<span class="banner banner<?php echo count($cate_menu); ?>">
											<img src="<?php echo base_url() .'media/images/category/tui-deo-cheo.jpg'; ?>" alt="<?php echo 'Tất cả sản phẩm'; ?>" />
										</span>
									</li>								
								<?php } ?>		
							</ul>
						</li>

						<!-- <li class=""><a href="/lookbooks.html"><span>Bộ sưu tập</span></a></li> -->
						<li class=" <?php echo (isset($me_active) && $me_active == 'blogs') ? 'current' : '' ?>"><a href="<?php echo base_url() ?>blogs"><span>Blogs</span></a></li>
						
						<li class=" <?php echo (isset($me_active) && $me_active == 'promo') ? 'current' : '' ?>"><a href="<?php echo base_url() ?>khuyen-mai"><span>Khuyến mãi</span></a></li>
						
						<li class=" <?php echo (isset($me_active) && $me_active == 'news') ? 'current' : '' ?> last"><a href="<?php echo base_url() ?>tin-tuc"><span>Tin tức</span></a></li>
					</ul>
	    		</div><!--/.nav-collapse -->
			</nav>
	    
			<script language="javascript">
				$(document).ready(function(){
					$('.navbar ul.nav li').hover(
						function(){ $('> ul', this).show(); },
						function(){ $('> ul', this).hide(); }
					);
				});
			</script>

			<script language="javascript">
				$(document).ready(function(){
					$('.navbar-nav .dropdown li .active').parents('li').children('a').addClass('active');
				});
			</script>
		</div> 	  
	</div>
</div>