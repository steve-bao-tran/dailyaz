<div id="breadcrumb" class="row">
	<div class="block">
		<div class="b-content">
			<div class="breadcrumb">
				<!-- Home -->
				<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo base_url() ?>" title="Trang chủ" itemprop="url">
						<span itemprop="title">
							<!-- <img src="<?php echo base_url() ?>templates/images/home.png" border="0" align="absmiddle"> -->
							Trang chủ
						</span>
					</a>
				</span>
				
				<!-- Level 1 -->
				<?php if (isset($brcrum) && $brcrum['lv1'] != '') { ?>
				<!-- <span class="symbol">&nbsp;> </span> -->
				<!-- <span class="symbol" style="/*background: url(../templates/images/split.png) center right no-repeat;*/">&nbsp;&nbsp;&nbsp; </span> -->
				<span class="symbol">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
				
				<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo $brcrum['link1'] ?>" title="<?php echo $brcrum['lv1'] ?>" itemprop="url">
						<span itemprop="title"><?php echo $brcrum['lv1'] ?></span>
					</a>
				</span>
				<?php } ?>
				
				<!-- Level 2 -->
				<?php if (isset($brcrum) && $brcrum['lv2'] != '') { ?>
				<!-- <span class="symbol">&nbsp;> </span> -->
				<!-- <span class="symbol" style="background: url(../templates/images/split.png) center right no-repeat;">&nbsp;&nbsp;&nbsp; </span> -->
				<span class="symbol">&nbsp;&nbsp;/&nbsp;&nbsp;</span>

				<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo $brcrum['link2'] ?>" title="<?php echo $brcrum['lv2'] ?>" itemprop="url">
						<span itemprop="title"><?php echo $brcrum['lv2'] ?></span>
					</a>
				</span>
				<?php } ?>

				<?php if (isset($brcrum) && $brcrum['lv3'] != '') { ?>
				<!-- Level 3 -->
				<!-- <span class="symbol">&nbsp;> </span> -->
				<!-- <span class="symbol" style="background: url(../templates/images/split.png) center right no-repeat;">&nbsp;&nbsp;&nbsp; </span> -->
				<span class="symbol">&nbsp;&nbsp;/&nbsp;&nbsp;</span>

				<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo $brcrum['link3'] ?>" title="<?php echo $brcrum['lv3'] ?>" itemprop="url">
						<span itemprop="title"><?php echo $brcrum['lv3'] ?></span>
					</a>
				</span>
				<?php } ?>
			</div>
		</div>
	</div>
</div>