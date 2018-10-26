<?php $viewed = $this->session->userdata('viewed'); ?>
<div id="stl-right" class="col-lg-3 col-sm-4 col-xs-12">
   <div class="block">
      <div class="b-content">
         <div class="blbanners"></div>
      </div>
   </div>
   <div class="block blstyle1">
      <div class="b-title"><span>Sản phẩm bạn vừa xem</span></div>
      <div class="b-content">
         <?php if (! empty($viewed)) { ?>

            <div class="productList2">
               <?php foreach ($viewed as $kv => $vv) { ?> 
                  <div class="item">
                     <div class="thumb">
                        <a href="<?php echo base_url() .'san-pham/'. $vv['idv'] .'-'. RemoveSign($vv['namev']) ?>" title="<?php echo $vv['namev'] ?>">
                           <img src="<?php echo (file_exists('media/images/product/'. $vv['dirv'] .'/thumbnail_75_'. $vv['imagev'])) ? 'media/images/product/'. $vv['dirv'] .'/thumbnail_75_'. $vv['imagev'] : 'media/images/default/no_image.jpg'; ?>" alt="<?php echo $vv['namev'] ?>" border="0" title="<?php echo $vv['namev'] ?>">
                        </a>
                     </div>
                     <a href="<?php echo base_url() .'san-pham/'. $vv['idv'] .'-'. RemoveSign($vv['namev']) ?>" title="<?php echo $vv['namev'] ?>">
                        <h4><?php echo $vv['namev'] ?></h4>
                     </a>
                     <div class="price">
                        <span class="lbprice">Giá:</span> <strong><?php echo number_format($vv['pricev'], 0, '.','.'); ?>đ</strong><br>                
                     </div>
                  </div>
                  
                  <div class="break"></div>            
               <?php } ?>
            </div>
            <br class="break">
            <div align="right"><a href="/san-pham/xem-gan-day" class="">Xem tất cả &gt;</a></div>
         <?php } else { ?>
            <p class="note">Chưa có sản phẩm nào</p>      
         <?php } ?>
      </div>
   </div>
</div>