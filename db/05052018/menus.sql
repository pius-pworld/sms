/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : laraframework

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-06-05 16:00:17
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('2', 'Nationally', 'All National', 'Main', '0', '1', 'fa fa-address-card', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('3', 'Zone', '#', 'Sub', '2', '1', 'fa fa-list', 'zones', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('4', 'Region', '#', 'Sub', '2', '1', 'fa fa-list', 'regions', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('5', 'Territories', '#', 'Sub', '2', '1', 'fa fa-list', 'territories', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('6', 'Distributor', '#', 'Sub', '2', '1', 'fa fa-list', 'distribution_houses', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('7', 'Product Info', 'All product info here', 'Main', '0', '1', 'fa fa-product-hunt', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('8', 'Category', '#', 'Sub', '7', '1', 'fa fa-list', 'categories', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('9', 'Product Type', '#', 'Sub', '7', '1', 'fa fa-list', 'product_types', '1', '1', '0', null, null, '0');
INSERT INTO `menus` VALUES ('10', 'Product', '#', 'Sub', '7', '1', 'fa fa-list', 'products', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('11', 'Skue', '#', 'Sub', '7', '1', 'fa fa-list', 'skues', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('12', 'Brand', '#', 'Sub', '7', '1', 'fa fa-list', 'brands', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('13', 'SMS', 'All SMS Menu Here', 'Main', '0', '1', 'fa fa-comment', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('14', 'SMS Inbox', '#', 'Sub', '13', '1', 'fa fa-list', 'sms_inboxes', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('15', 'Settings', '#', 'Main', '0', '1', 'fa fa-cog', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('16', 'Ordering Brand&Skue', '#', 'Sub', '15', '1', 'fa fa-list-ol', 'settings/brand_skue', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('17', 'Promotion', '#', 'Sub', '15', '1', 'fa fa-plus-square', 'promotions', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('18', 'Promotion List', '#', 'Sub', '15', '1', 'fa fa-list', 'promotionsList', '2', '1', '0', null, null, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
INSERT INTO `privilege_menus` VALUES ('12', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('13', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('14', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('15', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('16', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('17', '1', null, null, null);
INSERT INTO `privilege_menus` VALUES ('18', '1', null, null, null);

-- ----------------------------
-- Table structure for promotional_package
-- ----------------------------
DROP TABLE IF EXISTS `promotional_package`;
CREATE TABLE `promotional_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(50) NOT NULL DEFAULT '0',
  `package_start` datetime NOT NULL,
  `package_end` datetime NOT NULL,
  `package_details` text NOT NULL,
  `package_free_item` text NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `rfu1` varchar(50) DEFAULT NULL,
  `rfu2` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of promotional_package
-- ----------------------------
INSERT INTO `promotional_package` VALUES ('3', 'test', '2018-06-05 00:00:00', '2018-06-30 00:00:00', '{\"4\":\"1\"}', '{\"4\":\"1\"}', '1', '2018-06-05 14:47:34', '2018-06-05 14:47:34', null, null, '0');
INSERT INTO `promotional_package` VALUES ('4', 'test 2', '2018-06-01 00:00:00', '2018-06-30 00:00:00', '{\"3\":\"3\",\"8\":\"4\",\"10\":\"3\",\"24\":\"3\"}', '{\"3\":\"1\",\"4\":\"2\"}', '1', '2018-06-05 15:44:56', '2018-06-05 15:44:56', null, null, '1');
