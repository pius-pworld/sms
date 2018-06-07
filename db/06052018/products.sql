/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : laraframework

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-06-06 15:10:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `key_word` varchar(255) DEFAULT NULL,
  `brands_id` int(11) NOT NULL,
  `skues_id` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `description` text,
  `pack_size` varchar(50) DEFAULT NULL,
  `rfu1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfu2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyCodeUnique` (`key_word`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'safda', null, '2', '1', '9.00', '22', 'asdfasdf', null, null, null, '2018-05-27 10:20:29', '1', '1', '2018-05-27 10:30:26', '1');
INSERT INTO `products` VALUES ('2', '250ml pet', null, '5', '5', '5.00', '13', null, null, null, null, '2018-06-04 06:13:38', '1', null, '2018-06-04 06:21:20', '1');
INSERT INTO `products` VALUES ('3', null, 'sdasdfs', '12', '5', '3.00', '3', null, null, null, null, '2018-06-04 06:24:45', '1', '1', '2018-06-06 05:29:32', '0');
INSERT INTO `products` VALUES ('4', null, 'sdasdf', '2', '6', '2.00', '2', '2', null, null, null, '2018-06-06 05:28:52', '1', '1', '2018-06-06 05:29:12', '1');
INSERT INTO `products` VALUES ('5', null, 'sdasdfc', '3', '11', '53345.00', '34534', 'df', '24', null, null, '2018-06-06 08:19:24', '1', '1', '2018-06-06 09:09:56', '1');
INSERT INTO `products` VALUES ('6', null, 'sdasdfe', '1', '5', '344.00', '34', 'ergs', '4', null, null, '2018-06-06 09:08:34', '1', null, '2018-06-06 09:08:34', '1');
