<div class="block-3 container">
	<div class="blockcat">
		<div class="b-content">
			<div class="t">
    			<h3>Lựa chọn sản phẩm dailyaz dành cho bạn</h3>
    			<div class="adsearch">
    			<!--<span class="bt">Tìm kiếm nâng cao</span>-->
    			</div>
			</div>
			<div class="row catList">
				<?php if ($cate_home) { ?>
					<?php foreach ($cate_home as $key => $value) { ?>
					
						<?php if ($value->cat_id == 1) { ?>
						<div class="item col-sm-4">
					      <h4><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>"><?php echo $value->cat_name ?></a></h4>
					      <div class="thumb">
					        <a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>"><img src="<?php echo ($value->cat_image1 != '' && file_exists('media/images/category/'. $value->cat_image1)) ? base_url() .'media/images/category/'. $value->cat_image1 : ''; ?>" alt="<?php echo $value->cat_name ?>" /></a>
					        <div class="i"><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>">Xem ngay</a></div>
					        <div class="bg-hover"></div>
					      </div>
					    </div>
					    <?php } ?>

					    <?php if ($value->cat_id == 4) { ?>
						<div class="item col-sm-4">
					      <h4><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>"><?php echo $value->cat_name ?></a></h4>
					      <div class="thumb">
					        <a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>"><img src="<?php echo ($value->cat_image1 != '' && file_exists('media/images/category/'. $value->cat_image1)) ? base_url() .'media/images/category/'. $value->cat_image1 : ''; ?>" alt="<?php echo $value->cat_name ?>" /></a>
					        <div class="i"><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>">Xem ngay</a></div>
					        <div class="bg-hover"></div>
					      </div>
					    </div>
					    <?php } ?>
					<?php } ?>
				    <div class="col-sm-4 ritem">
				    	<?php foreach ($cate_home as $key => $value) { ?>
					    	<?php if ($value->cat_id == 2) { ?>
						    	<div class="item">
						          	<div class="thumb col-sm-8 col-xs-8">
						                <img src="<?php echo ($value->cat_image1 != '' && file_exists('media/images/category/'. $value->cat_image1)) ? base_url() .'media/images/category/'. $value->cat_image1 : ''; ?>" alt="<?php echo $value->cat_name ?>" />
						                <div class="i"><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>">Xem ngay</a></div>
						                <div class="bg-hover"></div>
						          	</div>
						            <h4 class="col-sm-4 col-xs-4"><a href="<?php echo base_url() .'danh-muc/'. $value->cat_name ?>"><?php echo $value->cat_name ?></a></h4>
						       	</div>
					       	<?php } ?>

				       		<?php if ($value->cat_id == 6) { ?>
				        	<div class="break"></div>
					        
						    	<div class="item">
						          	<div class="thumb col-sm-8 col-xs-8">
						                <img src="<?php echo ($value->cat_image1 != '' && file_exists('media/images/category/'. $value->cat_image1)) ? base_url() .'media/images/category/'. $value->cat_image1 : ''; ?>" alt="<?php echo $value->cat_name ?>" />
						                <div class="i"><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>">Xem ngay</a></div>
						                <div class="bg-hover"></div>
						          	</div>
						            <h4 class="col-sm-4 col-xs-4"><a href="<?php echo base_url() .'danh-muc/'. $value->cat_id .'-'. RemoveSign($value->cat_name); ?>"><?php echo $value->cat_name ?></a></h4>
						       	</div>
					       	<?php } ?>
					    <?php } ?>
				    </div>	
				
			    <?php } ?>
			</div>
		</div>
	</div>

	<div class="blockstyle">
		<div class="b-content">
			<div class="t">
    			<h2>Phong cách của bạn</h2>
    			<p>Hãy chọn phong riêng cách của bạn hoặc hãy đề xuất phong cách của bạn <a href="<?php echo base_url() ?>lien-he">tại đây</a>!</p>
			</div>

			<div class="row filterList">
				<?php if ($style_home) { ?>
					<?php foreach ($style_home as $ks => $vs) { ?>					
					
						<div class="col-sm-4 item">
					    	<a href="<?php echo $vs->sty_url_image ?>">
					    		<img src="<?php echo ($vs->sty_image != '' && file_exists('media/images/style/'. $vs->sty_image)) ? base_url() .'media/images/style/'. $vs->sty_image : base_url() . 'media/images/default/no_image.jpg'; ?>" alt="<?php echo $vs->sty_name ?>" />
					    	</a>
					        <div class="i">
					        	<a href="<?php echo $vs->sty_url_image ?>"><?php echo $vs->sty_name ?></a>
					        </div>
					        <div class="bg-hover"></div>
					    </div>
					<?php } ?>
				<?php } ?>
				
			</div>
		</div>
	</div>


	<div class="homebar-icons row">
	    <div class="col-sm-3 item item1">
	      <div class="i">
	        ĐỔI HÀNG TRONG VÒNG 03 NGÀY<br />ĐỔI HÀNG NẾU XUẤT HIỆN LỖI
	      </div>
	    </div>
	    <div class="col-sm-3 item item2">
	      <div class="i">
	        BẢO HÀNH SUỐT THỜI GIAN SỬ DỤNG<br />
	      </div>
	    </div>
	    <div class="col-sm-3 item item3">
	      <div class="i">
	        GIAO HÀNG NHANH<br />GIAO HÀNG NHANH TOÀN QUỐC
	      </div>
	    </div>
	    <div class="col-sm-3 item item4">
	      <div class="i">
	        HỖ TRỢ NHANH<br /><?php echo HOTLINE; ?>
	      </div>
	    </div>
	</div>
</div>