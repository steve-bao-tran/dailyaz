/**
**
**/
CREATE SCHEMA IF NOT EXISTS `DataBaseName` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `dailyaz_db`.`category` ( 
	`cat_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`cat_name` VARCHAR(255) NOT NULL , 
	`cat_image` VARCHAR(100) NULL DEFAULT NULL , 
	`cat_desc` VARCHAR(255) NULL DEFAULT NULL , 
	`cat_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`cat_id`)
) ENGINE = InnoDB;
ALTER TABLE `category` ADD `cat_image1` VARCHAR(255) NULL DEFAULT NULL AFTER `cat_image`;

CREATE TABLE `dailyaz_db`.`content` (
  `con_id` int(11) NOT NULL,
  `con_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `con_intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `con_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `con_detail` text COLLATE utf8_unicode_ci,
  `con_tags` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `con_createdate` datetime NOT NULL,
  `con_editdate` datetime NOT NULL,
  `con_type` tinyint(1) NOT NULL COMMENT '1:tin, 2: blogs, 3:huong dan',
  `con_catid` int(10) NOT NULL,
  `con_view` int(10) NOT NULL,
  `con_interesting` int(10) NOT NULL,
  `con_vote` int(10) NOT NULL,
  `con_publish` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `content` ADD `con_type` TINYINT(1) NOT NULL AFTER `con_editdate`;
ALTER TABLE `content` CHANGE `con_type` `con_type` TINYINT(1) NOT NULL COMMENT '1:tin, 2: blogs, 3:huong dan';
ALTER TABLE `content` ADD `con_catid` INT(10) NOT NULL AFTER `con_type`;
ALTER TABLE `content` ADD `con_user` INT(11) NOT NULL AFTER `con_publish`;


INSERT INTO `category` (`cat_id`, `cat_name`, `cat_image`, `cat_desc`, `cat_publish`) 
	VALUES (NULL, 'Túi xách', NULL, NULL, '1'), (NULL, 'Balo', NULL, NULL, '1'), 
	(NULL, 'Túi du lịch', NULL, NULL, '1'), (NULL, 'Bóp - Ví', NULL, NULL, '1'), 
	(NULL, 'Vali', NULL, NULL, '1'), (NULL, 'Dây nịt', NULL, NULL, '1'), 
	(NULL, 'Phụ kiện khác', NULL, NULL, '1');

CREATE TABLE `dailyaz_db`.`info_us` ( 
	`info_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`info_name` VARCHAR(200) NULL DEFAULT NULL , 
	`info_aliasname` VARCHAR(200) NULL DEFAULT NULL , 
	`info_address` VARCHAR(200) NULL DEFAULT NULL , 
	`info_depot` VARCHAR(200) NULL DEFAULT NULL , 
	`info_tax` VARCHAR(30) NULL DEFAULT NULL , 
	`info_bank1` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Tên ngân hàng,số tk,chi nhánh' , 
	`info_bank2` VARCHAR(255) NULL DEFAULT NULL , 
	`info_bank3` VARCHAR(255) NULL DEFAULT NULL , 
	`info_bank4` VARCHAR(255) NULL DEFAULT NULL , 
	`info_bank5` VARCHAR(255) NULL DEFAULT NULL , 
	`info_email` VARCHAR(50) NULL DEFAULT NULL , 
	`info_mobile` VARCHAR(15) NULL DEFAULT NULL , 
	`info_hotline` VARCHAR(15) NULL DEFAULT NULL , 
	`info_video` VARCHAR(100) NULL DEFAULT NULL , 
	`info_image` VARCHAR(100) NULL DEFAULT NULL , 
	`info_desc` TEXT NULL DEFAULT NULL , 
	`info_facebook` VARCHAR(200) NULL DEFAULT NULL , 
	`info_message` VARCHAR(200) NULL DEFAULT NULL , 
	`info_twitter` VARCHAR(200) NULL DEFAULT NULL , 
	`info_googleplus` VARCHAR(200) NULL DEFAULT NULL , 
	`info_youtube` VARCHAR(200) NULL DEFAULT NULL , 
	`info_pinterest` VARCHAR(200) NULL DEFAULT NULL , 
	`info_linkin` VARCHAR(200) NULL DEFAULT NULL , 
	`info_zalo` VARCHAR(200) NULL DEFAULT NULL , 
	PRIMARY KEY (`info_id`)
) ENGINE = MyISAM;
ALTER TABLE `info_us` ADD `info_website` VARCHAR(200) NULL DEFAULT NULL AFTER `info_hotline`;

INSERT INTO `info_us` (`info_id`, `info_name`, `info_aliasname`, `info_address`, `info_depot`, `info_tax`, `info_bank1`, `info_bank2`, `info_bank3`, `info_bank4`, `info_bank5`, `info_email`, `info_mobile`, `info_hotline`, `info_video`, `info_image`, `info_desc`, `info_facebook`, `info_message`, `info_twitter`, `info_googleplus`, `info_youtube`, `info_pinterest`, `info_linkin`, `info_zalo`) VALUES (NULL, 'Túi Xách Ví Da Daily Az', 'Daily Az', '156B Nguyễn Văn Cừ, Kp.2, P.Mỹ Bình, Tp.Phan Rang - Tháp Chàm, T.Ninh Thuận', NULL, NULL, 'DongA,0101010110,Bình Thạnh', 'ACB,009837362,Tân Bình', NULL, NULL, NULL, 'dailyaz.phanrang@gmail.com', '0946404282', '19008888', 'https://www.youtube.com/watch?v=OJvQ6gg8qQ8', NULL, NULL, 'https://www.facebook.com/azdaily/', NULL, NULL, NULL, NULL, NULL, NULL, NULL);


CREATE TABLE `dailyaz_db`.`product` ( 
	`pro_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`pro_name` VARCHAR(200) NULL DEFAULT NULL , 
	`pro_sku` VARCHAR(200) NULL DEFAULT NULL , 
	`pro_desc` VARCHAR(255) NULL DEFAULT NULL , 
	`pro_tags` VARCHAR(255) NULL DEFAULT NULL , 
	`pro_image` VARCHAR(150) NULL DEFAULT NULL , 
	`pro_keyword` VARCHAR(255) NULL DEFAULT NULL , 
	`pro_detail` TEXT NULL DEFAULT NULL , 
	`pro_cost` FLOAT NOT NULL , 
	`pro_instock` INT(11) NOT NULL , 
	`pro_listimg` VARCHAR(255) NULL DEFAULT NULL , 
	`pro_cate` INT(10) NOT NULL , 
	`pro_relative` VARCHAR(100) NULL DEFAULT NULL , 
	`pro_weight` FLOAT NOT NULL , 
	`pro_width` INT(10) NOT NULL , 
	`pro_height` INT(10) NOT NULL , 
	`pro_length` INT(10) NOT NULL , 
	`pro_saleoff` TINYINT(1) NOT NULL , 
	`pro_beginsale` DATE NOT NULL , 
	`pro_endsale` DATE NOT NULL , 
	`pro_percent` INT(10) NOT NULL , 
	`pro_video` VARCHAR(200) NULL DEFAULT NULL , 
	`pro_doc` VARCHAR(100) NULL DEFAULT NULL , 
	`pro_view` INT(10) NOT NULL , 
	`pro_buy` INT(10) NOT NULL , 
	`pro_hlight` TINYINT(1) NOT NULL , 
	`pro_code` VARCHAR(100) NOT NULL , 
	`pro_createdate` DATETIME NOT NULL , 
	`pro_editdate` DATETIME NOT NULL , 
	`pro_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`pro_id`)
) ENGINE = InnoDB;
ALTER TABLE `product` ADD `pro_dir` VARCHAR(20) NULL DEFAULT NULL AFTER `pro_publish`;
ALTER TABLE `product` CHANGE `pro_image` `pro_image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `product` CHANGE `pro_doc` `pro_doc` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `product` ADD `pro_color` INT(5) NOT NULL COMMENT '1:nam, 2: nữ, 3: unisex' AFTER `pro_dir`, ADD `pro_forsex` INT(5) NOT NULL AFTER `pro_color`, ADD `pro_style` INT(5) NOT NULL AFTER `pro_forsex`;


CREATE TABLE `dailyaz_db`.`user` ( 
	`us_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`us_username` VARCHAR(100) NULL DEFAULT NULL , 
	`us_password` VARCHAR(100) NULL DEFAULT NULL , 
	`us_salt` VARCHAR(10) NULL DEFAULT NULL , 
	`us_fullname` VARCHAR(200) NULL DEFAULT NULL , 
	`us_email` VARCHAR(200) NULL DEFAULT NULL , 
	`us_mobile` VARCHAR(15) NULL DEFAULT NULL , 
	`us_address` VARCHAR(255) NULL DEFAULT NULL , 
	`us_origpass` VARCHAR(100) NULL DEFAULT NULL , 
	`us_gen` INT(3) NOT NULL , 
	`us_age` DATE NOT NULL , 
	`us_avatar` VARCHAR(100) NULL DEFAULT NULL , 
	`us_lastlogin` DATETIME NOT NULL , 
	`us_createdate` DATETIME NOT NULL , 
	`us_update` DATETIME NOT NULL , 
	`us_publish` BOOLEAN NOT NULL ,
	`us_group` INT(10) NOT NULL , 	 
	PRIMARY KEY (`us_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`love_product` ( 
	`lp_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`lp_user` INT(11) NOT NULL , 
	`lp_product` INT(11) NOT NULL , 
	`lp_lovedate` DATETIME NOT NULL , 
	PRIMARY KEY (`lp_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`collection` ( 
	`co_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`co_name` VARCHAR(255) NULL DEFAULT NULL , 
	`co_img1` VARCHAR(100) NULL DEFAULT NULL , 
	`co_img2` VARCHAR(100) NULL DEFAULT NULL , 
	`co_img3` VARCHAR(100) NULL DEFAULT NULL , 
	`co_detail` TEXT NULL DEFAULT NULL , 
	`co_picture` VARCHAR(255) NULL DEFAULT NULL , 
	`co_tags` VARCHAR(255) NULL DEFAULT NULL , 
	`co_createdate` DATETIME NOT NULL , 
	`co_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`co_id`)
) ENGINE = MyISAM;

INSERT INTO `user` (`us_id`, `us_username`, `us_password`, `us_salt`, `us_fullname`, `us_email`, `us_mobile`, `us_address`, `us_origpass`, `us_gen`, `us_age`, `us_avatar`, `us_lastlogin`, `us_createdate`, `us_update`, `us_publish`, `us_group`) VALUES (NULL, 'admin', 'rgthtreaAVGSDHEHYEVHETRHER', '1234', 'Steve Tran', 'stevetran.bao@gmail.com', '0934987672', '200 Trường Chinh, P.Tân Thới Nhất, Q.12, TP.HCM', '1234', '1', '1990-12-30', NULL, '2018-03-08 11:29:29', '2018-03-08 00:00:00', '2018-03-08 00:00:00', '1', '1');

CREATE TABLE `dailyaz_db`.`counter` ( 
	`cou_id` INT(1) NOT NULL AUTO_INCREMENT , 
	`cou_num` INT(11) NOT NULL , 
	`cou_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`cou_id`)
) ENGINE = MyISAM;

INSERT INTO `counter` (`cou_id`, `cou_num`, `cou_publish`) VALUES (NULL, '1', '1');

CREATE TABLE `dailyaz_db`.`authorized_code` ( 
	`ac_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`ac_code` VARCHAR(100) NOT NULL , 
	`ac_email` VARCHAR(100) NOT NULL , 
	`ac_during` INT(1) NOT NULL , 
	`ac_createdate` DATE NOT NULL , 
	PRIMARY KEY (`ac_id`)
) ENGINE = MyISAM;

CREATE TABLE `registry_email` ( 
	`re_id` int(20) NOT NULL, 
	`re_email` varchar(80) COLLATE utf8_unicode_ci NOT NULL, 
	`re_ipaddress` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL, 
	`re_device` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL, 
	`re_note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL, 
	`re_createdate` datetime NOT NULL, `re_status` tinyint(4) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

ALTER TABLE `registry_email` ADD PRIMARY KEY( `re_id`);
ALTER TABLE `registry_email` CHANGE `re_id` `re_id` INT(11) NOT NULL;
ALTER TABLE `registry_email` ADD `re_publish` BOOLEAN NOT NULL AFTER `re_status`;

CREATE TABLE `dailyaz_db`.`order` ( 
	`o_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`o_code` VARCHAR(255) NULL DEFAULT NULL , 
	`o_date` DATETIME NOT NULL , 
	`o_user` INT(11) NOT NULL , 
	`o_receiver` INT(11) NOT NULL
	`o_cost` FLOAT NOT NULL , 
	`o_cost_promos` FLOAT NOT NULL , 
	`o_quantity` INT(5) NOT NULL , 
	`o_status` INT(1) NOT NULL , 
	`o_change_status_date` DATETIME NOT NULL , 
	`o_is_ship` BOOLEAN NOT NULL , 
	`o_fee_ship` FLOAT NOT NULL , 
	`o_reason_cancel` VARCHAR(255) NULL DEFAULT NULL , 
	`o_cancel_date` DATETIME NOT NULL , 
	`o_payment_status` INT(2) NOT NULL , 
	PRIMARY KEY (`o_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`showcart` ( 
	`sc_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`sc_product` INT(11) NOT NULL , 
	`sc_orderid` INT(11) NOT NULL , 	
	`sc_cate_product` INT(11) NOT NULL , 
	`sc_quantity` INT(2) NOT NULL , 
	`sc_price_orig` FLOAT NOT NULL , 
	`sc_price` FLOAT NOT NULL , 
	`sc_date` DATETIME NOT NULL , 
	`sc_discount` FLOAT NOT NULL , 
	PRIMARY KEY (`sc_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`status_shipping` ( 
	`sh_id` INT(2) NOT NULL AUTO_INCREMENT , 
	`sh_code` INT(2) NOT NULL , 
	`sh_name` VARCHAR(50) NULL DEFAULT NULL , 
	`sh_note` VARCHAR(200) NULL DEFAULT NULL , 
	PRIMARY KEY (`sh_id`)
) ENGINE = MyISAM;

INSERT INTO `status_shipping` (`sh_id`, `sh_code`, `sh_name`, `sh_note`) 
	VALUES (NULL, '1', 'Mới đặt', 'Đơn hàng mới được đặt'), (NULL, '2', 'Đã xác nhận', 'Cửa hàng xác nhận, đang chờ giao hàng');
INSERT INTO `status_shipping` (`sh_id`, `sh_code`, `sh_name`, `sh_note`) 
	VALUES (NULL, '3', 'Đang chờ gia công', 'Đơn hàng đang chờ kho gia công'), (NULL, '4', 'Đang chờ thu tiền', 'Đơn hàng đang chờ thu tiền');
INSERT INTO `status_shipping` (`sh_id`, `sh_code`, `sh_name`, `sh_note`) 
	VALUES (NULL, '5', 'Hoàn thành', 'Đơn hàng giao thành công, và đã thu tiền'), (NULL, '98', 'Kho hủy', 'Kho hết hàng, hoặc không giao được');
INSERT INTO `status_shipping` (`sh_id`, `sh_code`, `sh_name`, `sh_note`) 
	VALUES (NULL, '99', 'Khách hủy', 'Khách hàng đặt nhằm, hoặc lý do khác');

CREATE TABLE `dailyaz_db`.`color_attribute` ( 
	`col_id` INT(5) NOT NULL AUTO_INCREMENT , 
	`col_name` VARCHAR(50) NULL DEFAULT NULL , 
	`col_note` VARCHAR(200) NULL DEFAULT NULL , 
	`col_createdate` DATETIME NOT NULL ,  
	`col_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`col_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`style_attribute` ( 
	`sty_id` INT(5) NOT NULL AUTO_INCREMENT , 
	`sty_name` VARCHAR(50) NULL DEFAULT NULL , 
	`sty_note` VARCHAR(200) NULL DEFAULT NULL , 
	`sty_createdate` DATETIME NOT NULL , 
	`sty_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`sty_id`)
) ENGINE = MyISAM;

ALTER TABLE `style_attribute` 
ADD `sty_image` VARCHAR(200) NULL DEFAULT NULL AFTER `sty_publish`, 
ADD `sty_url_image` VARCHAR(255) NULL DEFAULT NULL AFTER `sty_image`,
ADD `sty_update` DATETIME NOT NULL AFTER `sty_url_image`;

CREATE TABLE `dailyaz_db`.`show_home` ( 
	`sh_id` INT(2) NOT NULL AUTO_INCREMENT , 
	`sh_slide1` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_slide1` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_slide2` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_slide2` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_slide3` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_slide3` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_slide4` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_slide4` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_adver1` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_adver1` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_adver2` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_adver2` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_adver3` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_url_adver3` VARCHAR(200) NULL DEFAULT NULL , 
	`sh_createdate` DATETIME NOT NULL , 
	`sh_update` DATETIME NOT NULL , 
	PRIMARY KEY (`sh_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`contact` ( 
	`ct_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`ct_name` VARCHAR(255) NULL DEFAULT NULL , 
	`ct_fullname` VARCHAR(100) NULL DEFAULT NULL , 
	`ct_email` VARCHAR(100) NULL DEFAULT NULL , 
	`ct_mobile` VARCHAR(20) NULL DEFAULT NULL , 
	`ct_address` VARCHAR(255) NULL DEFAULT NULL , 
	`ct_detail` TEXT NULL DEFAULT NULL , 
	`ct_attach` VARCHAR(255) NULL DEFAULT NULL , 
	`ct_status` INT(2) NOT NULL , 
	`ct_createdate` DATETIME NOT NULL , 
	PRIMARY KEY (`ct_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`notify_product` ( 
	`np_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`np_user` INT(11) NOT NULL , 
	`np_product` INT(11) NOT NULL , 
	`np_createdate` DATETIME NOT NULL , 
	`np_type` INT(2) NOT NULL COMMENT '1: thông báo; 2: liên lạc lại qua đt' , 
	`np_mobile` VARCHAR(50) NULL DEFAULT NULL , 
	`np_email` VARCHAR(100) NULL DEFAULT NULL , 
	`np_status` INT(2) NOT NULL COMMENT '1: Chưa giải quyết, 2: Đăng giải quyết, 3: Đã giải quyết' , 
	PRIMARY KEY (`np_id`)
) ENGINE = MyISAM;

CREATE TABLE `dailyaz_db`.`receiver` ( 
	`rc_id` INT(11) NOT NULL AUTO_INCREMENT , 
	`rc_fullname` VARCHAR(100) NULL DEFAULT NULL , 
	`rc_address` VARCHAR(255) NULL DEFAULT NULL , 
	`rc_mobile` VARCHAR(15) NULL DEFAULT NULL , 
	`rc_email` VARCHAR(80) NULL DEFAULT NULL , 
	`rc_note` VARCHAR(255) NULL DEFAULT NULL , 
	`rc_createdate` DATETIME NOT NULL , 
	`rc_user` INT(11) NOT NULL , 
	`rc_publish` BOOLEAN NOT NULL , 
	PRIMARY KEY (`rc_id`)
) ENGINE = MyISAM;







