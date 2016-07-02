/*
Navicat MySQL Data Transfer

Source Server         : local-mysql
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : fangkuai

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-07-02 10:12:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for factory
-- ----------------------------
DROP TABLE IF EXISTS `factory`;
CREATE TABLE `factory` (
  `factory_id` int(11) NOT NULL,
  `factory_name` varchar(100) DEFAULT NULL,
  `factory_product_id` int(11) DEFAULT NULL,
  `factory_city` varchar(100) DEFAULT NULL,
  `factory_logo` varchar(100) DEFAULT NULL,
  `factory_zone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`factory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of factory
-- ----------------------------

-- ----------------------------
-- Table structure for fk_goods_quotation
-- ----------------------------
DROP TABLE IF EXISTS `fk_goods_quotation`;
CREATE TABLE `fk_goods_quotation` (
  `gq` int(11) DEFAULT NULL,
  `gtb_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `is_tax_inclusive` int(11) DEFAULT NULL,
  `expired_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `manufacturer` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_fee` float DEFAULT NULL,
  `invoice_option` int(11) DEFAULT NULL,
  `pay_type` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `remark` tinytext,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fk_goods_quotation
-- ----------------------------

-- ----------------------------
-- Table structure for fk_goods_to_buy
-- ----------------------------
DROP TABLE IF EXISTS `fk_goods_to_buy`;
CREATE TABLE `fk_goods_to_buy` (
  `gtb_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `product_material` varchar(50) DEFAULT NULL,
  `product_specifications` varchar(100) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL,
  `price_conditions` varchar(50) DEFAULT NULL,
  `linkman` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `approval_status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`gtb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fk_goods_to_buy
-- ----------------------------

-- ----------------------------
-- Table structure for fk_promotional_goods_record
-- ----------------------------
DROP TABLE IF EXISTS `fk_promotional_goods_record`;
CREATE TABLE `fk_promotional_goods_record` (
  `pgr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) DEFAULT NULL,
  `product_specification` varchar(50) DEFAULT NULL,
  `product_material` varchar(50) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `linkman` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `approval_status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pgr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fk_promotional_goods_record
-- ----------------------------

-- ----------------------------
-- Table structure for fk_spot_goods_record
-- ----------------------------
DROP TABLE IF EXISTS `fk_spot_goods_record`;
CREATE TABLE `fk_spot_goods_record` (
  `sgr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `product_material` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `product_specifications` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `product_width` int(11) DEFAULT NULL,
  `product_length` int(11) DEFAULT NULL,
  `product_height` int(11) DEFAULT NULL,
  `manufacturer` varchar(100) CHARACTER SET big5 DEFAULT NULL,
  `area` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `storehouse` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `weighing_type` tinyint(4) DEFAULT '1',
  `price` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `remark` tinytext CHARACTER SET latin1,
  `approval_status` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sgr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fk_spot_goods_record
-- ----------------------------

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `type` int(2) DEFAULT NULL,
  `is_released` int(2) DEFAULT NULL,
  `relesed_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_no` varchar(100) DEFAULT NULL,
  `order_seller` int(11) DEFAULT NULL,
  `order_buyer` int(111) DEFAULT NULL,
  `order_product_id` int(11) DEFAULT NULL,
  `order_unit_price` float DEFAULT NULL,
  `order_amount` int(11) DEFAULT NULL,
  `order_total_price` float DEFAULT NULL,
  `order_status` int(2) DEFAULT NULL,
  `order_type` int(2) DEFAULT NULL,
  `order_created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `product_quantity` float DEFAULT NULL,
  `product_unit_price` float DEFAULT NULL,
  `product_material` varchar(100) DEFAULT NULL,
  `product_specifications` varchar(100) DEFAULT NULL,
  `product_catgory_id` int(11) DEFAULT NULL,
  `is_promotional` int(1) DEFAULT NULL,
  `product_storehouse_id` varchar(255) DEFAULT NULL,
  `product_factory_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_product_id` int(11) DEFAULT NULL,
  `purchase_contact_user` int(11) DEFAULT NULL,
  `purchase_connect_phone` varchar(255) DEFAULT NULL,
  `purchase_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchase
-- ----------------------------

-- ----------------------------
-- Table structure for receipt
-- ----------------------------
DROP TABLE IF EXISTS `receipt`;
CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_order_no` char(100) DEFAULT NULL,
  `receipt_title` varchar(255) DEFAULT NULL,
  `receipt_total_money` float DEFAULT NULL,
  `receipt_status` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`receipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of receipt
-- ----------------------------

-- ----------------------------
-- Table structure for resource
-- ----------------------------
DROP TABLE IF EXISTS `resource`;
CREATE TABLE `resource` (
  `resourceid` int(11) NOT NULL AUTO_INCREMENT,
  `resource_company_name` varchar(200) DEFAULT NULL,
  `resource_main_class` varchar(100) DEFAULT NULL,
  `resource_main_factory_name` varchar(100) DEFAULT NULL,
  `resource_remark` varchar(255) DEFAULT NULL,
  `resource_upprice` float(10,0) DEFAULT NULL,
  `resource_down_count` varchar(255) DEFAULT NULL,
  `resource_file_name` varchar(255) DEFAULT NULL,
  `resource_file_url` varchar(255) DEFAULT NULL,
  `resource_created_at` varchar(255) DEFAULT NULL,
  `resource_user_id` int(11) DEFAULT NULL,
  `resource_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`resourceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resource
-- ----------------------------

-- ----------------------------
-- Table structure for resource_user
-- ----------------------------
DROP TABLE IF EXISTS `resource_user`;
CREATE TABLE `resource_user` (
  `ru_id` int(11) NOT NULL,
  `ru_resource_id` int(11) DEFAULT NULL,
  `ru_user_id` int(11) DEFAULT NULL,
  `ru_created_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ru_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resource_user
-- ----------------------------

-- ----------------------------
-- Table structure for sms
-- ----------------------------
DROP TABLE IF EXISTS `sms`;
CREATE TABLE `sms` (
  `sms_id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_phone` varchar(255) DEFAULT NULL,
  `sms_code` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sms
-- ----------------------------

-- ----------------------------
-- Table structure for storehouse
-- ----------------------------
DROP TABLE IF EXISTS `storehouse`;
CREATE TABLE `storehouse` (
  `storehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `storehouse_name` varchar(100) DEFAULT NULL,
  `storehouse_address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`storehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of storehouse
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` char(64) DEFAULT NULL,
  `truename` char(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_is_active` int(1) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `mobile_is_active` int(1) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_company
-- ----------------------------
DROP TABLE IF EXISTS `user_company`;
CREATE TABLE `user_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `company_short_name` varchar(100) DEFAULT NULL,
  `company_description` varchar(100) DEFAULT NULL,
  `city` int(8) DEFAULT NULL,
  `zone` int(8) DEFAULT NULL,
  `detailed_address` varchar(100) DEFAULT NULL,
  `company_phone` varchar(20) DEFAULT NULL,
  `company_fax` varchar(20) DEFAULT NULL,
  `company_contact` varchar(20) DEFAULT NULL,
  `person_telephone` varchar(20) DEFAULT NULL,
  `certificate_img1` varchar(100) DEFAULT NULL,
  `certificate_img2` varchar(100) DEFAULT NULL,
  `certificate_img3` varchar(100) DEFAULT NULL,
  `certificate_img4` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_company
-- ----------------------------

-- ----------------------------
-- Table structure for user_score
-- ----------------------------
DROP TABLE IF EXISTS `user_score`;
CREATE TABLE `user_score` (
  `us_id` int(11) NOT NULL AUTO_INCREMENT,
  `us_kuaibi` float DEFAULT NULL,
  `score_name` varchar(100) DEFAULT NULL,
  `score_remark` varchar(200) DEFAULT NULL,
  `created_at` int(20) DEFAULT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_score
-- ----------------------------
