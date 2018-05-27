/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : laraframework

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-27 15:23:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` text,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'saf', 'asdf', '1', '2018-05-27 08:05:25', null, '2018-05-27 08:05:25', null);

-- ----------------------------
-- Table structure for designations
-- ----------------------------
DROP TABLE IF EXISTS `designations`;
CREATE TABLE `designations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'This is basically the row status. whether this record is active or not. 1 = Active, 0 = Inactive ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of designations
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menus_description` text COLLATE utf8mb4_unicode_ci,
  `menus_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_menus_id` int(11) NOT NULL,
  `modules_id` int(11) NOT NULL,
  `icon_class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'value after the base url only',
  `sort_number` int(11) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Master', 'ww', 'Main', '0', '1', 'fa fa-list', '/', '0', '0', '0', null, null, '1');
INSERT INTO `menus` VALUES ('2', 'Nationally', 'All National', 'Main', '0', '1', 'fa fa-list', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('3', 'Zone', '#', 'Sub', '2', '1', 'fa fa-list', 'zones', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('4', 'Region', '#', 'Sub', '2', '1', 'fa fa-list', 'regions', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('5', 'Territories', '#', 'Sub', '2', '1', 'fa fa-list', 'territories', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('6', 'Distributor', '#', 'Sub', '2', '1', 'fa fa-list', 'distribution_houses', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('7', 'Product Info', 'All product info here', 'Main', '0', '1', 'fa fa-list', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('8', 'Category', '#', 'Sub', '7', '1', 'fa fa-list', 'categories', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('9', 'Product Type', '#', 'Sub', '7', '1', 'fa fa-list', 'product_types', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('10', 'Product', '#', 'Sub', '7', '1', 'fa fa-list', 'products', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('11', 'Skue', '#', 'Sub', '7', '1', 'fa fa-list', 'skues', '1', '1', '0', null, null, '1');

-- ----------------------------
-- Table structure for privilege_menus
-- ----------------------------
DROP TABLE IF EXISTS `privilege_menus`;
CREATE TABLE `privilege_menus` (
  `menus_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_levels_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menus_id`),
  UNIQUE KEY `privilege_menus_menu_id_user_level_id_unique` (`menus_id`,`user_levels_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of privilege_menus
-- ----------------------------
INSERT INTO `privilege_menus` VALUES ('1', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('2', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('3', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('4', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('5', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('6', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('7', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('8', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('9', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('10', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('11', '1', null, null, null);

-- ----------------------------
-- Table structure for product_types
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `rfu1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfu2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_types
-- ----------------------------
INSERT INTO `product_types` VALUES ('1', 'test', null, null, '2018-05-27 08:29:16', '1', null, '2018-05-27 08:29:16', '1');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_types_id` int(10) DEFAULT NULL,
  `categories_id` int(10) unsigned DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfu1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfu2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `products_product_categories_id_index` (`categories_id`),
  KEY `products_created_by_index` (`created_by`),
  KEY `products_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', null, '1', null, 'TV', null, 'NA', 'uploads/AqfQpe7RxNCaAsBCuzUUDEeDSQhJNJfz4Fl0LnxG.png', null, null, '2018-05-13 11:58:49', '2', '1', '2018-05-13 11:58:49', '1');
INSERT INTO `products` VALUES ('2', '1', '1', 'da', 'asdf', 'asdf', 'asdf', null, null, null, '2018-05-27 08:44:54', null, null, '2018-05-27 08:44:54', '1');
INSERT INTO `products` VALUES ('3', '1', '1', 'asdf', 'asdf', 'asdf', 'asdf', 'uploads/14fwbhIL5Rl9nCu1iVQsI80WqgZQiDltFzlnn0bF.png', null, null, '2018-05-27 08:45:15', null, '1', '2018-05-27 08:48:03', '1');
INSERT INTO `products` VALUES ('4', '1', '1', 'fsdf', 'sdf', 'sdf', 'sdf', 'uploads/IZ1xKRxzCftHlMTMqPEapUmpN1sspCYhxSpVQbwB.png', null, null, '2018-05-27 08:48:17', '1', null, '2018-05-27 08:48:17', '1');
INSERT INTO `products` VALUES ('5', '1', '1', 'da', 'sf', 'sdf', 'asdf', 'uploads/EoDPPr72xm4AIQd6Ftr1Fzig4nON0BZEENgZr01k.jpeg', null, null, '2018-05-27 09:00:34', '1', null, '2018-05-27 09:00:34', '0');

-- ----------------------------
-- Table structure for regions
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES ('1', 'test updated', '1', '2018-05-26 10:26:18', '1', '2018-05-27 04:35:41', null, null);
INSERT INTO `regions` VALUES ('2', 'test 1', '1', '2018-05-27 04:34:43', null, '2018-05-27 04:34:43', null, null);

-- ----------------------------
-- Table structure for skues
-- ----------------------------
DROP TABLE IF EXISTS `skues`;
CREATE TABLE `skues` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sku_name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `description` text,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skues
-- ----------------------------
INSERT INTO `skues` VALUES ('1', 'sdf', 'asdf', 'asdf', null, null, null, '2018-05-27 09:08:02', null, '2018-05-27 09:08:02', '1');

-- ----------------------------
-- Table structure for territories
-- ----------------------------
DROP TABLE IF EXISTS `territories`;
CREATE TABLE `territories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `territory_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of territories
-- ----------------------------
INSERT INTO `territories` VALUES ('1', 'test', '1', '2018-05-27 04:26:44', null, '2018-05-27 04:26:44', null, null);
INSERT INTO `territories` VALUES ('2', 'test2', '1', '2018-05-27 04:28:54', '1', '2018-05-27 04:30:02', null, null);
INSERT INTO `territories` VALUES ('3', 'test3x', '1', '2018-05-27 04:29:43', '1', '2018-05-27 05:58:33', null, null);
INSERT INTO `territories` VALUES ('4', 'test4', '1', '2018-05-27 06:19:34', null, '2018-05-27 06:19:34', null, null);
INSERT INTO `territories` VALUES ('5', 'test6', '1', '2018-05-27 06:26:37', null, '2018-05-27 06:26:37', null, null);

-- ----------------------------
-- Table structure for zones
-- ----------------------------
DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rfu1` int(11) DEFAULT NULL,
  `rfu2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of zones
-- ----------------------------
INSERT INTO `zones` VALUES ('1', 'North Bengal - 02', null, null, null, '2018-05-26 10:31:11', null, null);
INSERT INTO `zones` VALUES ('3', 'North Bengal - 01', null, null, null, '2018-05-26 10:30:49', null, null);
INSERT INTO `zones` VALUES ('4', 'Jessore Zone', null, null, null, '2018-05-26 10:31:27', null, null);
INSERT INTO `zones` VALUES ('7', 'Mymensingh Zone', '1', '2018-05-26 10:31:43', null, '2018-05-26 10:31:43', null, null);
INSERT INTO `zones` VALUES ('8', 'Dhaka North Zone', '1', '2018-05-26 10:31:56', null, '2018-05-26 10:31:56', null, null);
INSERT INTO `zones` VALUES ('9', 'Dhaka South Zone', '1', '2018-05-26 10:32:13', null, '2018-05-26 10:32:13', null, null);
INSERT INTO `zones` VALUES ('10', 'Dhaka West Zone', '1', '2018-05-26 10:32:31', null, '2018-05-26 10:32:31', null, null);
INSERT INTO `zones` VALUES ('11', 'Barishal Zone', '1', '2018-05-26 10:32:43', '1', '2018-05-27 04:38:06', null, null);
INSERT INTO `zones` VALUES ('12', 'Sylhet Zone', '1', '2018-05-26 10:32:55', null, '2018-05-26 10:32:55', null, null);
INSERT INTO `zones` VALUES ('13', 'Comilla Zone', '1', '2018-05-26 10:33:12', null, '2018-05-26 10:33:12', null, null);
INSERT INTO `zones` VALUES ('14', 'Noakhali Zone', '1', '2018-05-26 10:33:35', null, '2018-05-26 10:33:35', null, null);
INSERT INTO `zones` VALUES ('15', 'Chottrogram Zone', '1', '2018-05-26 10:33:48', null, '2018-05-26 10:33:48', null, null);
