/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : laraframework

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-30 15:14:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for abcs
-- ----------------------------
DROP TABLE IF EXISTS `abcs`;
CREATE TABLE `abcs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of abcs
-- ----------------------------
INSERT INTO `abcs` VALUES ('1', '2018-05-26 08:38:38', '2018-05-26 08:38:38', 'sdsda', 'asdasda', '1');

-- ----------------------------
-- Table structure for branches
-- ----------------------------
DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of branches
-- ----------------------------

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categories_id` int(10) unsigned DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES ('1', '1', 'Tiger', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('2', '1', 'Black Horse', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('3', '2', 'Fizz up', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('4', '2', 'Uro Cola', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('5', '2', 'Uro Lemon', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('6', '2', 'Uro Orange', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('7', '2', 'Uro Zeera', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('8', '3', 'Oranjee', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('9', '3', 'Lemonjee', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('10', '4', 'Mangolee', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('11', '4', 'Mango King', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('12', '5', 'Lychena', null, null, null, null, null, null, null, null, '1');
INSERT INTO `brands` VALUES ('13', '6', 'Alma', null, null, null, null, null, null, null, null, '1');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` text,
  `ordering` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Energy Drink', null, '1', '1', '2018-05-30 15:02:28', null, null, null);
INSERT INTO `categories` VALUES ('2', 'Carbonated Soft Drinks', null, '2', '1', '2018-05-30 15:02:28', null, null, null);
INSERT INTO `categories` VALUES ('3', 'Pulpy Drink', null, '3', '1', '2018-05-30 15:02:28', null, null, null);
INSERT INTO `categories` VALUES ('4', 'Mango Fruit Drink', null, '4', '1', '2018-05-30 15:02:28', null, null, null);
INSERT INTO `categories` VALUES ('5', 'Flavor Drink', null, '5', '1', '2018-05-30 15:02:28', null, null, null);
INSERT INTO `categories` VALUES ('6', 'Drinking Water', null, '6', '1', '2018-05-30 15:02:28', null, null, null);

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_created_by_index` (`created_by`),
  KEY `countries_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', '2018-05-13 12:06:13', '2018-05-13 12:06:13', 'Bangladesh', 'NA', '2', '1', '1');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', 'Jakir', '2018-05-26 09:07:46', '2018-05-26 09:07:46', '1', '1', 'adf', '1');

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
-- Table structure for distribution_houses
-- ----------------------------
DROP TABLE IF EXISTS `distribution_houses`;
CREATE TABLE `distribution_houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zones_id` int(11) DEFAULT NULL,
  `regions_id` int(11) DEFAULT NULL,
  `territories_id` int(11) DEFAULT NULL,
  `market_name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `point_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of distribution_houses
-- ----------------------------
INSERT INTO `distribution_houses` VALUES ('1', '1', '1', '1', 'Dinajpur', '10110', 'Enamul Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('2', '1', '1', '1', 'Fulbari', '10115', 'Alim Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('3', '1', '1', '1', 'Saidpur', '10120', 'Monaf Siddique', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('4', '1', '1', '1', 'Nilphamari', '10125', 'Maruf Chira & Rice Mill', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('5', '1', '1', '1', 'Birgonj ', '10130', 'Motalib & Sons', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('6', '1', '1', '2', 'Thakurgaon', '10135', 'Yeakub Ali & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('7', '1', '1', '2', 'Panchagar', '10140', 'Dipu Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('8', '1', '1', '2', 'Dimla', '10145', 'Plabon Gift Korner', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('9', '1', '2', '3', 'Rangpur-1', '10150', 'Nowshad Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('10', '1', '2', '3', 'Rangpur-2', '10155', 'Fatema Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('11', '1', '2', '3', 'Pirgonj', '10160', 'Mithila Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('12', '1', '2', '3', 'Pirgacha', '10165', 'Milon Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('13', '1', '2', '4', 'Lalmonirhat', '10180', 'Rafi Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('14', '1', '2', '4', 'Kurigram', '10170', 'Nurain Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('15', '1', '2', '4', 'Ulipur', '10175', 'Ayon Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('16', '1', '2', '4', 'Patgram', '10185', 'Madina Bekary', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('17', '1', '3', '5', 'Joypurhat', '10190', ' Shahidul Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('18', '1', '3', '5', 'Panchbibi', '10210', 'Tojammel Hossain', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('19', '1', '3', '6', 'Gaibandah-2', '10200', 'Ava Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('20', '1', '3', '6', 'Gaibandah-1', '10195', 'Bismillah Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('21', '1', '3', '6', 'Gobindogonj', '10205', 'Afrid Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('22', '2', '4', '7', 'Bogra Sadar ', '15110', 'Sarker Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('23', '2', '4', '7', 'Gabtoli', '15115', 'Siddik Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('24', '2', '4', '7', 'Sherpur ', '15125', 'Sarker Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('25', '2', '4', '8', 'Mohasthan ', '15120', 'Sharif Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('26', '2', '4', '8', 'Dupchachia ', '15130', 'Vai Vai Rice & Boilar Mills', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('27', '2', '4', '8', 'Nondigram', '15135', 'Chacha Vatiga Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('28', '2', '5', '9', 'Rajsahi-1 ', '15145', 'Soma Construction', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('29', '2', '5', '9', 'Kessorhat ', '15150', 'Sadia fall Vander', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('30', '2', '5', '9', 'Bagha ', '15180', 'No Dist.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('31', '2', '5', '10', 'Godagari ', '15140', 'Akhey Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('32', '2', '5', '10', 'Chapai Nawabgonj ', '15155', 'Zaman Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('33', '2', '5', '10', 'Kanset', '15160', 'Chapai Agro Food ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('34', '2', '6', '11', 'Naogoan ', '15190', 'Sufi Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('35', '2', '6', '11', 'Nazipur ', '15195', 'Fatema Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('36', '2', '6', '11', 'Nowhata ', '15200', 'Kona Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('37', '2', '6', '12', 'Natore', '15165', 'Sorna Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('38', '2', '6', '12', 'Singra ', '15170', 'S.K Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('39', '2', '6', '12', 'Atrai ', '15205', 'Sarwer Verity Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('40', '2', '7', '13', 'Pabna-1 ', '15210', 'S.S Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('41', '2', '7', '13', 'Bera', '15220', 'Naim Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('42', '2', '7', '13', 'Nazirgonj', '15225', 'Fatema Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('43', '2', '7', '14', 'Pabna-2 ', '15215', 'New Haque Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('44', '2', '7', '14', 'Bonpara', '15175', 'Reza Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('45', '2', '7', '14', 'Ishwardi', '15185', 'BNF Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('46', '2', '8', '15', 'Sirajgonj ', '15230', 'Faruk Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('47', '2', '8', '15', 'Sirajgonj Road ', '15235', 'Green Chillis Resturant', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('48', '2', '8', '16', 'Ullapara ', '15240', 'Fardin Trade Center', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('49', '2', '8', '16', 'Shajadpur', '15245', 'Eva Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('50', '2', '8', '16', 'Belkhuchi ', '15250', 'Azad Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('51', '3', '9', '17', 'Kushtia', '20110', 'Monoronjon Kumar sen', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('52', '3', '9', '18', 'Mirpur', '20115', 'S.K Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('53', '3', '9', '18', 'Bheramara', '20125', 'Kajol enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('54', '3', '9', '19', 'Gangni', '20155', 'Shyamoli Book Land', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('55', '3', '9', '19', 'Meherpur', '20160', 'N.R Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('56', '3', '9', '19', 'Alamdanga', '20150', ' Sainik Kollan Shonghostha ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('57', '3', '10', '20', 'Jhenaidah', '20130', 'AR Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('58', '3', '10', '21', 'Kumarkhali', '20120', 'Shabu Cycle Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('59', '3', '10', '21', 'Shailakupa', '20140', 'Bhai Bhai Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('60', '3', '10', '22', 'Cotchadpur', '20135', 'Raihan Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('61', '3', '10', '22', 'Chuadanga', '20145', 'Iqbal Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('62', '3', '11', '23', 'Jessore', '20165', 'Falguni Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('63', '3', '11', '24', 'Jhikorgacha', '20170', 'Golder Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('64', '3', '11', '24', 'Sharsha', '20175', 'No Distributor', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('65', '3', '11', '24', 'Monirampur', '20190', 'Sawpna store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('66', '3', '11', '25', 'Magura', '20210', 'Sharif Cosmetics', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('67', '3', '11', '25', 'AR Para', '20180', 'Synthia Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('68', '3', '11', '25', 'Mohammadpur', '20185', 'No Distributor', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('69', '3', '11', '26', 'Narail', '20195', 'Sheikh Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('70', '3', '11', '26', 'Nowapara', '20200', 'Binimoy store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('71', '3', '11', '26', 'Kalia', '20205', 'Kalia Kundu Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('72', '3', '12', '27', 'Khulna', '20215', 'Marine Beverage', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('73', '3', '12', '28', 'Lockpur/ East Rupsha', '20225', 'Allahr Daan Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('74', '3', '12', '28', 'Mongla', '20235', 'N.J Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('75', '3', '12', '28', 'Terokhada', '20230', 'B.M Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('76', '3', '12', '29', 'Dawlatpur', '20220', 'Mostafa Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('77', '3', '13', '30', 'Satkhira', '20240', 'Aqua Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('78', '3', '13', '30', 'Kaligonj', '20245', 'Fatah Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('79', '3', '13', '31', 'Chuknagar', '20245', 'Vai Vai Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('80', '3', '13', '31', 'Kapilmani', '20245', 'Toha Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('81', '3', '13', '31', 'Patkelghata', '20260', 'Bismillah Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('82', '3', '14', '32', 'Bagerhat', '20265', 'Siam Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('83', '3', '14', '32', 'Morrelgonj', '20285', 'Shaha Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('84', '3', '14', '33', 'Pirozpur', '20280', 'Jakir Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('85', '3', '14', '33', 'Shoronkhola', '20270', 'Saroar Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('86', '3', '14', '33', 'Chitalmari', '20275', 'Joi oil & Agency', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('87', '3', '14', '34', 'Gopalgonj', '20290', 'Maa Varity Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('88', '3', '14', '34', 'Kotalipara', '20295', 'Joy Guru Vandar', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('89', '3', '14', '34', 'Tungipara', '20300', 'Khondakar Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('90', '3', '14', '34', 'Muksudpur', '20305', 'Tanvir Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('91', '3', '14', '34', 'Kashiani', '20310', ' Taz Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('92', '4', '15', '35', 'Mymensingh', '25110', 'S.M. Enterprise ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('93', '4', '15', '35', 'Muktagachha', '25115', 'Lokanath Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('94', '4', '15', '35', 'Shambugonj', '25120', 'Rimjim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('95', '4', '15', '35', 'Shaymgonj', '25125', 'Pondit Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('96', '4', '15', '36', 'Bhaluka', '25155', 'Talukder Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('97', '4', '15', '36', 'Gaforgaon', '25160', 'Razzak & Sons', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('98', '4', '16', '37', 'Jamalpur', '25130', 'Siddique Porag Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('99', '4', '16', '37', 'Sarisabari', '25135', 'Saha Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('100', '4', '16', '37', 'Dewangonj', '25140', 'Satter & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('101', '4', '16', '37', 'Bakshigonj ', '25145', 'Jahid Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('102', '4', '16', '37', 'Rawmari', '25150', 'Rezaul Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('103', '4', '16', '38', 'Sherpur', '25165', 'Janani Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('104', '4', '16', '38', 'Fulpur', '25170', '.Sohag Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('105', '4', '17', '39', 'Kotiadi', '25175', 'Juwel Traders.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('106', '4', '17', '39', ' Kuliarchar ', '25180', 'Haque Enterprise ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('107', '4', '17', '39', ' Nikle ', '25185', 'Nur Shahin Business Center', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('108', '4', '17', '39', ' Bazitpur ', '25190', 'Bonik Store ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('109', '4', '17', '40', 'Netrokona ', '25195', 'Shah Sultan Enterprise ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('110', '4', '17', '40', ' Kalmakanda ', '25200', 'Moon Traders ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('111', '4', '17', '40', ' Mohangonj ', '25205', 'Vai VaiI Enterprise ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('112', '4', '17', '40', 'Madon ', '25210', ' Jubeda Enterprise.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('113', '4', '17', '41', 'Nandail', '25215', 'Mayer doa Store  ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('114', '4', '17', '41', 'Korimgonj', '25220', 'Rashel Traders ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('115', '4', '17', '41', ' Hossainpur ', '25225', 'Jishan Store ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('116', '4', '17', '41', ' Kishorgonj ', '25230', 'Hazi Safiruddin & Co. ', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('117', '5', '18', '42', 'Tongi', '30110', 'Reazul Karim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('118', '5', '18', '42', 'Mirerbazar', '30125', 'Majukhan Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('119', '5', '18', '43', 'Uttara', '30115', 'Saiful & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('120', '5', '18', '44', 'Dakhin Khan', '30120', 'Saad Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('121', '5', '18', '45', 'Board Bazar', '30130', 'Tijara Corporation', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('122', '5', '19', '46', 'Gazipur', '30135', ' Talukder Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('123', '5', '19', '47', 'Kapasia', '30140', ' Khan Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('124', '5', '19', '48', 'Hotapara', '30145', 'Shawon Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('125', '5', '19', '49', 'Mawna', '30150', 'Rudro Bristy Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('126', '5', '19', '50', 'Konabari', '40150', 'Bismillah Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('127', '5', '19', '51', 'Kaliakoir', '40155', 'Ela Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('128', '5', '19', '51', 'Shakipur', '40160', 'Rafi Sumi Ent', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('129', '5', '20', '52', 'Narsingdi', '30155', 'Lisan Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('130', '5', '20', '53', 'Raipura', '30160', 'Bondu Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('131', '5', '20', '53', 'Bhairab', '30165', 'Nazma Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('132', '5', '20', '54', 'Rupgonj', '30170', '  S. Bhuiyan & Co.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('133', '5', '20', '54', 'Araihazar', '30175', 'Labina Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('134', '5', '21', '55', 'Gulshan', '30180', 'M.M Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('135', '5', '21', '55', 'Khilgoan', '30185', 'J.K Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('136', '5', '21', '56', 'Tejgoan', '30190', 'Wafa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('137', '5', '21', '56', 'Rampura', '30195', 'Islam Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('138', '5', '21', '57', 'Badda', '30200', 'Razzak Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('139', '5', '21', '57', 'Dumni', '30205', 'Raisa Enterprise 2', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('140', '6', '22', '58', 'Lalbag', '35110', 'Rafsan Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('141', '6', '22', '58', 'Kamrangichar', '35115', 'Al Amin Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('142', '6', '22', '59', 'Mohammadpur', '35120', 'Mannan Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('143', '6', '22', '59', 'Zigatola', '35125', 'Hossain Trading Corporation', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('144', '6', '22', '60', 'Hatirpool', '35130', 'Dhaka Confectionery', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('145', '6', '22', '60', 'Farmgate', '35135', 'Fahim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('146', '6', '23', '61', 'Jatrabari', '35140', 'Maa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('147', '6', '23', '62', 'Demra', '35145', 'Nuha Trade Center', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('148', '6', '23', '63', 'Sutrapur', '35150', 'Al Madina G.Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('149', '6', '23', '63', 'Shyampur', '35155', 'Bismillah Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('150', '6', '23', '64', 'Sabujbagh', '35160', 'Bhai Bhai Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('151', '6', '23', '64', 'Bashabo,Nandipara', '35165', 'Al Madina Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('152', '6', '24', '65', 'Narayangonj', '35170', 'Takwa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('153', '6', '24', '66', 'Bhuygor', '35175', 'Maa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('154', '6', '24', '66', 'Adamjee', '35180', 'Khokon Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('155', '6', '24', '67', 'Sonargaon', '35185', 'Mohammadia Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('156', '6', '24', '67', 'Bandar', '35190', 'Jonaki Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('157', '6', '24', '67', 'Gozariya ', '35195', 'M.M Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('158', '6', '25', '68', 'Zinzira', '35200', 'Nafi & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('159', '6', '25', '68', 'Sreenagar', '35205', 'Partho Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('160', '6', '25', '69', 'Ruhitpur', '35210', 'Anowar & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('161', '6', '25', '69', 'Dohar', '35215', 'Kabiraz Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('162', '6', '25', '69', 'Nawabgonj', '35220', 'Sinha Food Products', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('163', '6', '25', '70', 'Munshigonj', '35225', 'Samanta Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('164', '7', '26', '71', 'Tangail', '40110', 'Friends Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('165', '7', '26', '71', 'Nagorpur', '40115', 'Rajib Sajib Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('166', '7', '26', '71', 'Mirzapur', '40120', 'Sollan Cosmatics', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('167', '7', '26', '71', 'Pakulla', '40125', 'S.G Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('168', '7', '26', '72', 'Elenga', '40130', 'N. K. Datta & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('169', '7', '26', '72', 'Ghatail', '40135', 'Mostafa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('170', '7', '26', '72', 'Bhuapur', '40140', 'Ibrahim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('171', '7', '26', '72', 'Madhupur', '40145', 'Sarker Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('172', '7', '27', '73', 'Savar', '40165', 'Seam Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('173', '7', '27', '73', 'Ashulia', '40170', 'Ratul Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('174', '7', '27', '74', 'Nobinagar', '40175', 'Afroza Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('175', '7', '27', '75', 'Kalampur', '40180', ' Rima Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('176', '7', '27', '75', 'Aricha', '40185', 'Abdul Latif Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('177', '7', '27', '75', 'Manikgonj', '40190', 'S.K. Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('178', '7', '28', '76', 'Mirpur-1', '40195', 'Janata Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('179', '7', '28', '77', 'Mirpur-13', '40200', 'Abdullah Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('180', '7', '28', '77', 'Pallabi', '40205', 'Sayma Sweets & Bakery', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('181', '7', '28', '78', 'Hemayetpur', '40210', 'Bismillah Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('182', '7', '28', '78', 'Shingair', '40215', 'Bhai Bhai Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('183', '8', '29', '80', 'Faridpur', '45110', 'Shohag Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('184', '8', '29', '80', 'Shibchar', '45145', 'Rajib Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('185', '8', '29', '80', 'Vanga', '45155', 'Mithu Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('186', '8', '29', '81', 'Boalmari', '45115', 'Saha Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('187', '8', '29', '81', 'Rajbari', '45120', 'Datta Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('188', '8', '29', '81', 'Pangsha', '45125', 'Showkhin Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('189', '8', '30', '82', 'Shariatpur', '45130', 'Chitta Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('190', '8', '30', '82', 'Kazirhat', '45135', 'Kamal Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('191', '8', '30', '82', 'Vedorgonj', '45140', 'Parvin Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('192', '8', '30', '83', 'Madaripur ', '45150', 'Bepari Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('193', '8', '30', '83', 'Tekerhat', '45160', 'Shahid Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('194', '8', '30', '83', 'Torky', '45205', 'Nowshin Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('195', '8', '31', '84', 'Barisal -1', '45165', 'Hasan Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('196', '8', '31', '84', 'Barisal -2', '45170', 'Faruk Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('197', '8', '31', '84', 'Sharupkathi', '45175', 'Popular store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('198', '8', '31', '85', 'Muladi', '45200', ' Topader Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('199', '8', '31', '85', 'Uzirpur', '45210', 'Maa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('200', '8', '31', '86', 'Jhalakathi', '45215', 'Khondoker Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('201', '8', '31', '86', 'Rajapur', '45220', 'Rubel & Baten Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('202', '8', '31', '86', 'Bhandaria', '45225', ' Tasnim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('203', '8', '32', '87', 'Bhola', '45180', 'Bandhan Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('204', '8', '32', '87', 'Borhanuddin', '45185', 'Sabiha Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('205', '8', '32', '87', 'Charfashion', '45195', 'Belayet Motors', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('206', '8', '32', '88', 'Lalmohon', '45190', ' Sayera Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('207', '8', '32', '88', 'Golachipa', '45240', 'Gawtom & Bros.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('208', '8', '32', '88', 'Bawfal', '45250', 'Akota Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('209', '8', '33', '89', 'Patuakhali', '45230', 'R K Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('210', '8', '33', '89', 'Mirzagonj', '45260', 'Keshob Devnath', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('211', '8', '33', '90', 'Amtoli', '45235', 'Thakur & Bros.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('212', '8', '33', '90', 'Khepupara', '45245', 'Das Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('213', '8', '33', '91', 'Barguna', '45255', 'Samira Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('214', '8', '33', '91', 'Patharghata', '45265', 'Rabby Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('215', '8', '33', '91', 'Mathbaria', '45270', 'New Jomadder Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('216', '9', '34', '92', 'Eidgah', '50110', 'SM Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('217', '9', '34', '93', 'Laldighi', '50115', 'Hazi Md. Mokhlesh Mia & Sons', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('218', '9', '34', '93', 'Companygonj', '50120', 'Rafa Iron', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('219', '9', '34', '94', 'Kanaighat', '50125', 'Ajmal & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('220', '9', '34', '94', 'Goainghat', '50130', 'Azad  Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('221', '9', '35', '95', 'South Surma', '50155', 'Shohag Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('222', '9', '35', '95', 'Fenchugonj', '50185', 'Mahmud Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('223', '9', '35', '95', 'Goalabazar', '50170', 'Mahima Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('224', '9', '35', '96', 'Golapgonj', '50175', 'Jaman Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('225', '9', '35', '96', 'Bianibazar', '50180', 'Jamil Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('226', '9', '35', '96', 'Jokigonj', '50190', 'Satata Distribution', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('227', '9', '36', '97', 'Sunamgonj', '50135', 'Nikesh Ranjon Dey', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('228', '9', '36', '97', 'Derai', '50150', 'Marif Eterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('229', '9', '36', '97', 'Taherpur', '50145', 'Roman Shah Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('230', '9', '36', '98', 'Chattak', '50140', 'Juthi Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('231', '9', '36', '98', 'Jogonathpur', '50160', 'Islam & Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('232', '9', '36', '98', 'Bisawnath', '50165', 'Shahid Entterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('233', '9', '37', '99', 'Moulivibazar', '50195', 'South Sylhet Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('234', '9', '37', '99', 'Sremongol', '50210', 'Kanika Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('235', '9', '37', '100', 'Kulaura', '50200', 'M.J Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('236', '9', '37', '100', 'Borolekha', '50205', 'Alam Brothers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('237', '9', '37', '101', 'Hobigonj', '50215', 'Ishaq Mia & sons.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('238', '9', '37', '101', 'Nobigonj', '50225', 'Dulal Chandra Roy', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('239', '9', '37', '101', 'Ranigonj', '50235', 'Hazi Selim & Sons.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('240', '9', '37', '102', 'Madhabpur', '50220', 'Mohanam Electrics', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('241', '9', '37', '102', 'Sayestagonj', '50230', 'R.P Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('242', '10', '38', '103', 'B.Baria', '55110', 'Mamun Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('243', '10', '38', '103', 'Akhaura', '55115', 'Parimol Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('244', '10', '38', '103', 'Kosba', '55120', 'Maa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('245', '10', '38', '104', 'Sorail', '55125', 'Tamim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('246', '10', '38', '104', 'Nasirnagar', '55130', 'Rahmania Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('247', '10', '38', '104', 'Ashugonj', '55135', 'Sheba Stationary', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('248', '10', '38', '105', 'Companygonj', '55140', 'Rahman Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('249', '10', '38', '105', 'Nabinagar', '55145', 'Nasir Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('250', '10', '38', '105', 'Bancharampur', '55150', 'Al Rifat Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('251', '10', '38', '105', 'Dabidar', '55155', 'Tanvir Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('252', '10', '39', '106', 'Comilla Sador', '55160', 'Ovi Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('253', '10', '39', '106', 'Burichang', '55170', 'Maa Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('254', '10', '39', '107', 'Gouripur', '55180', 'Rakib Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('255', '10', '39', '107', 'Chandina', '55175', 'Janani Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('256', '10', '39', '107', 'Homna', '55185', 'Humayun Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('257', '10', '40', '108', 'Poduar bazar', '55165', 'Brothers Trade Link', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('258', '10', '40', '108', 'Barura', '55205', 'Ahsan Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('259', '10', '40', '109', 'Laksham', '55190', 'Satota Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('260', '10', '40', '109', 'Monohorgonj', '55195', 'Sraboni Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('261', '10', '40', '109', 'Naglocourt', '55200', 'Shahjalal Rice Mill', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('262', '10', '41', '110', 'Chandpur', '55210', 'Jalak Confectionary', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('263', '10', '41', '110', 'Motlob', '55215', 'Bismilla Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('264', '10', '41', '110', 'Chhangarchar', '55220', 'Bismilla Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('265', '10', '41', '111', 'Hajigonj', '55225', 'Titon shaha', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('266', '10', '41', '111', 'Kachua', '55230', 'Bhai Bhai Traders.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('267', '10', '41', '111', 'Shahrasti', '55235', 'Abdur Rahman Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('268', '11', '42', '112', 'Chowmuhani', '60155', 'Unique Conf.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('269', '11', '42', '112', 'Senbagh', '60160', 'Yasin Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('270', '11', '42', '113', 'Sonaimuri', '60165', 'Romana Trdaers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('271', '11', '42', '113', 'Chatkhil', '60170', 'Sahed Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('272', '11', '42', '113', 'Ramgonj', '60175', 'Orchede & Bro.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('273', '11', '42', '114', 'Luxmipur', '60220', 'M.K.H Trad.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('274', '11', '42', '114', 'Chandragonj', '60225', 'Purobi Enter.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('275', '11', '42', '114', 'Raipur', '60230', 'Fathama Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('276', '11', '43', '115', 'Maijdee', '60180', 'A.B center', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('277', '11', '43', '115', 'Datterhat', '60185', 'Rabbi & Bro.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('278', '11', '43', '115', 'Karmullah', '60190', 'Anawara Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('279', '11', '43', '116', 'Subarnachar', '60195', 'Samol Watch & Elec.', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('280', '11', '43', '116', 'Hatia-1 ', '60200', 'MA Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('281', '11', '43', '116', 'Hatia-2', '60205', 'M.A Hossain', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('282', '11', '43', '116', 'Alexander', '60210', ' Horipod Kundu & Sons', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('283', '11', '43', '116', 'Ramgoti', '60215', 'Ramgoty Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('284', '11', '44', '117', 'Feni Sadar', '60110', 'Dubai Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('285', '11', '44', '117', 'Chagolnaiya', '60115', ' Dhaka Bekary & Sweets', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('286', '11', '44', '117', 'Parsuram', '60120', 'Alam Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('287', '11', '44', '118', 'Chowddagram', '60130', 'Rabbi Dept. Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('288', '11', '44', '118', 'Bariyerhat', '60135', 'M.M Trdaers', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('289', '11', '44', '119', 'Dagonbuiyan', '60140', 'Amanat Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('290', '11', '44', '119', 'Basurhat', '60145', 'Chowdury Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('291', '11', '44', '119', 'Sonagazi', '60150', 'Hossain Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('292', '11', '45', '120', 'Nazirhat', '60375', 'Chowdhury Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('293', '11', '45', '120', 'Manikchari', '60380', 'Riya Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('294', '11', '45', '120', 'Ramgor', '60395', 'Khan Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('295', '11', '45', '120', 'Matiranga', '60405', 'Hazi Momin store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('296', '11', '45', '121', 'Khagrachari', '60385', 'Ayesha Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('297', '11', '45', '121', 'Dighinala', '60390', 'Shaha Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('298', '11', '45', '121', 'Bagaichari', '60400', 'Jashim Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('299', '12', '46', '122', 'Bondor', '60290', 'Minhaj Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('300', '12', '46', '122', 'EPZ', '60300', 'Jain Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('301', '12', '46', '123', 'Potenga', '60295', 'Anas Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('302', '12', '46', '124', 'Halishahar', '60255', 'Kashem & Sons', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('303', '12', '46', '124', 'Madar Bari', '60315', 'Nasim Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('304', '12', '46', '125', 'R.Bazar', '60305', 'Tanver Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('305', '12', '46', '125', 'Asadgonj', '60320', 'Hazi A.Razzak Sawdagor', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('306', '12', '46', '126', 'Bakulia', '60250', 'Tahsin Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('307', '12', '46', '126', 'Chaktai', '60310', 'New Harun Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('308', '12', '47', '127', 'Panchlish', '60240', 'Sultan Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('309', '12', '47', '127', 'Khulshi', '60270', 'Nusaiba Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('310', '12', '47', '128', 'Alangker', '60260', 'Nobojagoron Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('311', '12', '47', '128', 'Pahartoli', '60265', 'Filter Collection', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('312', '12', '47', '129', 'Sitakunda', '60235', 'Nuhash Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('313', '12', '47', '129', 'Bhatiari', '60275', 'Salauddin store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('314', '12', '47', '129', 'Sandip-1', '60280', 'S.A Enter', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('315', '12', '47', '129', 'Sandip-2', '60285', 'Rifat Ent', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('316', '12', '48', '130', 'Hathazari', '60370', 'Alompur Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('317', '12', '48', '130', 'Ranirhat', '60365', 'Adiba Chy.Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('318', '12', '48', '131', 'Oxyzen', '60345', 'A P Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('319', '12', '48', '132', 'Chandragona', '60350', 'S A Chy.Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('320', '12', '48', '132', 'Rangamati', '60360', 'S F Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('321', '12', '48', '133', 'Noapara', '60355', 'Bagdad Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('322', '12', '48', '133', 'Mohora', '60245', 'Modina Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('323', '12', '49', '134', 'Cox\'s Bazar', '60410', 'Hazi Kashem & Son\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('324', '12', '49', '135', 'Taknaf', '60425', 'Giash Uddin & Brother\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('325', '12', '49', '136', 'Ramu', '60415', 'Nazir Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('326', '12', '49', '136', 'Eidgaon', '60420', 'Anwar & Brother\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('327', '12', '49', '136', 'Lama', '60460', 'Juwel & Brother\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('328', '12', '49', '136', 'Alikodom', '60465', 'Nasir Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('329', '12', '49', '137', 'Chokoria', '60450', 'Modina Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('330', '12', '49', '138', 'Moheskhali', '60455', 'Progoti Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('331', '12', '49', '138', 'Kutubdia', '60470', 'Kashem Store', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('332', '12', '50', '139', 'Amirabad', '60430', 'Alomgir & Brother\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('333', '12', '50', '139', 'Bandorban', '60445', 'Abu Taher & Brother\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('334', '12', '50', '140', 'Banskhali', '60440', 'Nasir Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('335', '12', '50', '140', 'Satkania/ Keranir Hat', '60435', 'J M Traders', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('336', '12', '50', '141', 'Patiya', '60330', 'Shahi Trader\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('337', '12', '50', '141', 'Chandanish', '60335', 'Mostofa Trader\'s', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('338', '12', '50', '142', 'Anowara', '60325', 'Muhin Enterprise', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);
INSERT INTO `distribution_houses` VALUES ('339', '12', '50', '142', 'Boalkhali', '60340', 'Hazi Monir Trading', null, '2018-05-30 14:46:17', null, '2018-05-30 14:46:17', null, null);

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisions_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `countries_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_divisions_id_index` (`divisions_id`),
  KEY `districts_created_by_index` (`created_by`),
  KEY `districts_updated_by_index` (`updated_by`),
  KEY `districts_countries_id_index` (`countries_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES ('1', '2018-05-13 12:10:55', '2018-05-13 12:10:55', 'Sherpur', '1', 'NA', '2', '1', '1', '1');
INSERT INTO `districts` VALUES ('2', '2018-05-26 08:20:14', '2018-05-26 08:20:14', 'Jakir', '1', '474', null, '1', '1', '1');
INSERT INTO `districts` VALUES ('3', '2018-05-26 08:22:27', '2018-05-26 08:22:27', 'Jakir', '1', 'test', null, '1', '1', '1');

-- ----------------------------
-- Table structure for divisions
-- ----------------------------
DROP TABLE IF EXISTS `divisions`;
CREATE TABLE `divisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countries_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `divisions_countries_id_index` (`countries_id`),
  KEY `divisions_created_by_index` (`created_by`),
  KEY `divisions_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of divisions
-- ----------------------------
INSERT INTO `divisions` VALUES ('1', '2018-05-13 12:10:32', '2018-05-13 12:10:32', 'Dhaka', '1', 'NA', '2', '1', '1');

-- ----------------------------
-- Table structure for file_uploads
-- ----------------------------
DROP TABLE IF EXISTS `file_uploads`;
CREATE TABLE `file_uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of file_uploads
-- ----------------------------
INSERT INTO `file_uploads` VALUES ('1', '2018-05-28 03:25:51', '2018-05-28 03:25:51', 'uploads/qAS6ySN3COIWlRjOYuiDLjnoYJB1O7P9VU5LTyGA.png');

-- ----------------------------
-- Table structure for flights
-- ----------------------------
DROP TABLE IF EXISTS `flights`;
CREATE TABLE `flights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of flights
-- ----------------------------

-- ----------------------------
-- Table structure for forms
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Value should not contain any space',
  `form_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Title of the Form that will apear at the top of that form',
  `form_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_target` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `encType` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_form_of` int(10) DEFAULT NULL COMMENT 'NULL is define that this is the parent form',
  `is_innerForm` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'if 1 then all the items may append using ADD MORE Button',
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'POST' COMMENT 'POST or GET',
  `number_of_col` int(2) NOT NULL DEFAULT '1',
  `form_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_class` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_attr` text COLLATE utf8mb4_unicode_ci COMMENT 'Additional attribute like data-type , style etc',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `submit_for` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'Save' COMMENT 'Save = submit to store data in datastore; Search = Submit to search something from the datastore',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of forms
-- ----------------------------

-- ----------------------------
-- Table structure for form_items
-- ----------------------------
DROP TABLE IF EXISTS `form_items`;
CREATE TABLE `form_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forms_id` int(10) unsigned NOT NULL,
  `tag` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'input' COMMENT 'Input, Select or Textarea',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text' COMMENT 'date, number, email, password and so on',
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) DEFAULT '0',
  `tagClassName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagId` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_attr` text COLLATE utf8mb4_unicode_ci,
  `datasource` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'In case of SELECT Tag. it will carry comma separated value. Otherwise data grid information',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_fi_forms_id` (`forms_id`),
  CONSTRAINT `form_items_ibfk_1` FOREIGN KEY (`forms_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of form_items
-- ----------------------------

-- ----------------------------
-- Table structure for grids
-- ----------------------------
DROP TABLE IF EXISTS `grids`;
CREATE TABLE `grids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `grid_title` varchar(100) DEFAULT NULL,
  `description` text,
  `theads` text NOT NULL COMMENT 'JSON Format data with necessary information relate with column. Every column information will able to config by this data.\r\n\r\n-> field_name [as it is in query]\r\n-> searchable\r\n-> clickable\r\n-> clickable_url\r\n-> click_target [blank, self, popup]',
  `data_query` text NOT NULL COMMENT 'A DB Query',
  `query_groupby` text,
  `query_orderby` text,
  `query_limit` text,
  `query_having` text,
  `pagination` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = TRUE, 0 = FALSE',
  `pagination_rules` varchar(50) NOT NULL DEFAULT '10,25,50,100,All' COMMENT 'Comma Separated Value to define Pagination Rules',
  `excel_export` tinyint(1) NOT NULL DEFAULT '0',
  `pdf_export` tinyint(1) NOT NULL DEFAULT '0',
  `search_panel` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = TRUE, 0 = FALSE',
  `search_panel_id` int(10) DEFAULT NULL,
  `search_panel_position` enum('Left','Top') DEFAULT 'Top',
  `created_by` int(10) NOT NULL,
  `grid_template_id` int(10) unsigned NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grids
-- ----------------------------
INSERT INTO `grids` VALUES ('1', 'Purchase List', 'Purchase List', 'All Purchase will show in this grid', 'SL,Purchase Code,Date,Amount,Vendor', 'SELECT purchase_order.purchase_code, purchase_order.order_date, purchase_order.order_value, vendor.vendor_name FROM purchase_order LEFT JOIN vendor ON purchase_order.vendor_id = vendor.vendor_id where 1', null, null, null, null, '1', '10,25,50,100,All', '1', '0', '1', '1', 'Top', '1', '0', '2017-01-11 21:59:36', '1', '2017-01-17 01:21:12', '1');
INSERT INTO `grids` VALUES ('2', 'LC Settlement', 'LC Settlement', '', 'SL#,LC Number, Indent Number, Account Head,Date, Amount', 'SELECT\r\nproforma_invoice.lc_number,\r\nproforma_invoice.indent_number,\r\nacc_head.acc_head_name,\r\nvoucherdetails.TransactionDate,\r\nvoucherdetails.Debit\r\nFROM\r\nvoucherdetails\r\nINNER JOIN proforma_invoice ON voucherdetails.LcID = proforma_invoice.proforma_invoice_id\r\nLEFT JOIN acc_head ON voucherdetails.AccountName = acc_head.acc_head_id\r\nWHERE 1 HAVING voucherdetails.Debit > 0', null, null, null, null, '1', '10,25,50,100,All', '1', '1', '1', '7', 'Top', '1', '0', '2017-02-02 00:51:58', '1', '2017-06-07 14:44:36', '1');
INSERT INTO `grids` VALUES ('3', 'Trial Balence', 'Trial Balance', '', 'SL#,Date,Account Head, Debit,Credit', 'SELECT voucherdetails.TransactionDate,acc_head.acc_head_name,voucherdetails.Debit,voucherdetails.Credit FROM voucherdetails LEFT JOIN acc_head ON voucherdetails.AccountName = acc_head.acc_head_id WHERE 1', null, null, null, null, '1', '10,25,50,100,All', '1', '1', '1', '7', 'Top', '1', '0', '2017-02-02 01:12:44', '1', '2017-02-02 17:11:11', '1');
INSERT INTO `grids` VALUES ('4', 'Accounts Statement', 'Accounts Statement', '', 'SL#,Date,Accounts Head,Debit,Credit', 'SELECT voucherdetails.TransactionDate, acc_head.acc_head_name, voucherdetails.Debit, voucherdetails.Credit FROM voucherdetails LEFT JOIN acc_head ON voucherdetails.AccountName = acc_head.acc_head_id WHERE 1', null, null, null, null, '1', '10,25,50,100,All', '1', '1', '1', '6', 'Top', '1', '0', '2017-02-02 01:16:24', '1', '2017-02-02 17:38:25', '1');
INSERT INTO `grids` VALUES ('5', 'Purchase History', 'Purchase History', '', 'Purchase Code, Order Date, Order Value,Status', 'SELECT purchase_order.purchase_id,purchase_order.purchase_code, purchase_order.order_date, purchase_order.order_value,status.status_name FROM purchase_order LEFT JOIN status ON purchase_order.status=status.status_id WHERE 1', null, null, null, null, '1', '10,25,50,100,All', '1', '1', '1', '8', 'Top', '1', '0', '2017-06-08 12:15:42', '1', '2017-06-10 15:20:42', '1');
INSERT INTO `grids` VALUES ('6', '', null, null, '', '', null, null, null, null, '1', '10,25,50,100,All', '0', '0', '1', null, 'Top', '0', '0', '2017-06-10 10:16:18', null, null, '1');
INSERT INTO `grids` VALUES ('7', 'Warranty List', 'Warranty List', '', 'Ticket Code,Sales Code,Product Code,Created,Customer Name,Customer Mobile,Problems,Status,Product Receive,Action', 'SELECT ticket.ticket_id,ticket.ticket_code, ticket.sales_code, product.product_code, ticket.created, ticket.customer_name, ticket.customer_mobile, SUBSTR(ticket.problem_details,1,50) as problems, status.status_name,\'receive\',\'edit\',\'view\',\'delete\' FROM ticket LEFT JOIN status ON ticket.service_status = status.status_id LEFT JOIN product ON product.product_id=ticket.product_id', '', '', null, null, '1', '10,25,50,100,All', '1', '1', '1', '9', 'Top', '1', '1', '2017-06-18 14:40:46', '1', '2018-01-08 12:57:24', '1');
INSERT INTO `grids` VALUES ('8', 'Warranty Archive', 'Warranty Archive', '', 'Code, Customer Name, Customer Mobile, Product Problem, Receive Date, Delivery Date, Action', 'SELECT ticket.ticket_id, ticket.ticket_code, ticket.customer_name, ticket.customer_mobile, ticket.problem_details, ticket.created, ticket.updated, \'view\' FROM ticket WHERE ticket.service_status = 74', '', null, null, null, '1', '10,25,50,100,All', '1', '1', '1', '11', 'Top', '1', '0', '2017-07-26 13:00:53', '1', '2017-07-26 14:29:31', '1');
INSERT INTO `grids` VALUES ('9', 'Dealer Target List', 'Dealer Target List', '', 'Branch,Target Month,Base Period,Average By,Based On,Action', 'SELECT dealer_target_set.dealer_target_set_id,location.location_name,dealer_target_set.year_month,dealer_target_set.base_period,dealer_target_set.base_by,dealer_target_set.base_on,\'edit\' FROM dealer_target_set LEFT JOIN location ON dealer_target_set.location_id = location.location_id OR dealer_target_set.dealer_id = \'All\'', 'dealer_target_set.location_id', null, null, null, '1', '10,25,50,100,All', '1', '0', '1', '12', 'Top', '1', '0', '2017-08-03 17:02:24', '1', '2017-08-03 17:41:59', '1');
INSERT INTO `grids` VALUES ('10', 'Current Stock', 'Current Stock', '', 'Origin,Product Name,Product_code,Available Qty,On Process Qty, Reorder Qty', 'select product.product_details_json,product.product_id,region.region_name,product.product_name,product.product_code,IFNULL(sum(purchase_good_receive.available_quantity),0) as avQty,(SELECT ( Sum(	purchase_order_details.confirm_quantity ) - Sum( purchase_order_details.total_received ) ) AS optotal from (purchase_order_details) INNER JOIN proforma_invoice ON purchase_order_details.proforma_invoice_id = proforma_invoice.proforma_invoice_id WHERE purchase_order_details.product_id = product.product_id AND proforma_invoice.pi_status IN (48, 50)) as onProcessing,product.reorder_qty FROM product left join region on region.region_id=product.region_id left join purchase_good_receive on product.product_id=purchase_good_receive.product_id AND purchase_good_receive.good_receive_status_id=45 where product.status=\'Active\'', 'product.product_id', 'product.product_id', null, null, '1', '10,25,50,100,All', '1', '1', '1', '13', 'Top', '1', '1', '2017-12-21 18:13:18', '1', '2018-01-21 12:49:22', '1');
INSERT INTO `grids` VALUES ('11', 'Receive History', 'Receive History', '', 'Product Name,product Code,Purchase Code,Indent Number,Warehouse,Receive Qty,Available Qty,Receive Date', 'SELECT product.product_code, product.product_name, purchase_order.purchase_code, purchase_good_receive.indent_number, warehouse.warehouse_name,purchase_good_receive.receive_quantity, purchase_good_receive.available_quantity,purchase_good_receive.created FROM purchase_good_receive LEFT JOIN product ON purchase_good_receive.product_id = product.product_id LEFT JOIN purchase_order ON purchase_good_receive.purchase_id = purchase_order.purchase_id LEFT JOIN warehouse ON purchase_good_receive.warehouse_id = warehouse.warehouse_id WHERE purchase_good_receive.good_receive_status_id=45', '', '', null, null, '1', '10,25,50,100,All', '1', '1', '0', '13', 'Top', '1', '1', '2017-12-23 12:24:31', '1', '2017-12-23 12:45:14', '1');
INSERT INTO `grids` VALUES ('12', 'FOB Ordering', 'FOB Ordering', '', 'Fob Name, Details,Status', 'select \'fob\' as table_name, fob.fob_id as primary_id, fob.fob_name, fob.details,fob.status FROM fob order by ordering', '', '', null, null, '0', '10,25,50,100,All', '1', '1', '0', '14', 'Top', '1', '1', '2017-12-26 14:14:51', '1', '2017-12-27 11:32:32', '1');

-- ----------------------------
-- Table structure for grid_templates
-- ----------------------------
DROP TABLE IF EXISTS `grid_templates`;
CREATE TABLE `grid_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_of_column` int(2) NOT NULL DEFAULT '1' COMMENT 'Bootstrap Column. value must be 1-12',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of grid_templates
-- ----------------------------

-- ----------------------------
-- Table structure for locations
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of locations
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('2', 'Nationally', 'All National', 'Main', '0', '1', 'fa fa-pencil', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('3', 'Zone', '#', 'Sub', '2', '1', 'fa fa-list', 'zones', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('4', 'Region', '#', 'Sub', '2', '1', 'fa fa-list', 'regions', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('5', 'Territories', '#', 'Sub', '2', '1', 'fa fa-list', 'territories', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('6', 'Distributor', '#', 'Sub', '2', '1', 'fa fa-list', 'distribution_houses', '2', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('7', 'Product Info', 'All product info here', 'Main', '0', '1', 'fa fa-list', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('8', 'Category', '#', 'Sub', '7', '1', 'fa fa-list', 'categories', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('9', 'Product Type', '#', 'Sub', '7', '1', 'fa fa-list', 'product_types', '1', '1', '0', null, null, '0');
INSERT INTO `menus` VALUES ('10', 'Product', '#', 'Sub', '7', '1', 'fa fa-list', 'products', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('11', 'Skue', '#', 'Sub', '7', '1', 'fa fa-list', 'skues', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('12', 'Brand', '#', 'Sub', '7', '1', 'fa fa-list', 'brands', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('13', 'SMS', 'All SMS Menu Here', 'Main', '0', '1', 'fa fa-list', '#', '1', '1', '0', null, null, '1');
INSERT INTO `menus` VALUES ('14', 'SMS Inbox', '#', 'Sub', '13', '1', 'fa fa-list', 'sms_inboxes', '1', '1', '0', null, null, '1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2018_05_13_085233_create_product_brands_table', '2');
INSERT INTO `migrations` VALUES ('4', '2018_05_13_101626_create_product_categories_table', '3');
INSERT INTO `migrations` VALUES ('5', '2018_05_13_104138_alter_product_brands_table_1', '4');
INSERT INTO `migrations` VALUES ('6', '2018_05_13_110008_alter_product_categories_table_1', '5');
INSERT INTO `migrations` VALUES ('7', '2018_05_13_113810_create_products_table', '6');
INSERT INTO `migrations` VALUES ('8', '2018_05_13_115234_alter_products_table_1', '7');
INSERT INTO `migrations` VALUES ('9', '2018_05_13_115545_alter_products_table_2', '8');
INSERT INTO `migrations` VALUES ('10', '2018_05_13_120250_create_countries_table', '9');
INSERT INTO `migrations` VALUES ('11', '2018_05_13_120339_alter_countries_table_1', '10');
INSERT INTO `migrations` VALUES ('12', '2018_05_13_120454_create_divisions_table', '11');
INSERT INTO `migrations` VALUES ('13', '2018_05_13_120828_create_districts_table', '12');
INSERT INTO `migrations` VALUES ('14', '2018_05_13_120937_alter_districts_table_1', '13');
INSERT INTO `migrations` VALUES ('15', '2018_05_13_121148_create_upazilas_table', '14');
INSERT INTO `migrations` VALUES ('16', '2018_05_13_121326_create_unions_table', '15');
INSERT INTO `migrations` VALUES ('17', '2018_05_06_110955_create_user_levels_table', '16');
INSERT INTO `migrations` VALUES ('18', '2018_05_06_115449_create_privilege_levels_table', '16');
INSERT INTO `migrations` VALUES ('19', '2018_05_06_120343_create_privilege_menus_table', '16');
INSERT INTO `migrations` VALUES ('20', '2018_05_06_120810_create_privilege_modules_table', '16');
INSERT INTO `migrations` VALUES ('21', '2018_05_07_062039_create_module_table', '16');
INSERT INTO `migrations` VALUES ('22', '2018_05_07_073353_create_menus_table', '16');
INSERT INTO `migrations` VALUES ('23', '2018_05_07_100639_create_user_settings_table', '16');
INSERT INTO `migrations` VALUES ('24', '2018_05_14_052659_alter_products_table_3', '17');
INSERT INTO `migrations` VALUES ('25', '2018_05_14_053227_alter_products_table_4', '18');
INSERT INTO `migrations` VALUES ('26', '2018_05_14_092034_rename_user_levels_id_to_user_levels', '19');
INSERT INTO `migrations` VALUES ('27', '2018_05_22_094815_create_posts_table', '19');
INSERT INTO `migrations` VALUES ('28', '2018_05_26_083641_create_abcs_table', '20');
INSERT INTO `migrations` VALUES ('29', '2018_05_26_083034_create_zones_table', '21');
INSERT INTO `migrations` VALUES ('30', '2018_05_26_084100_alter_zones_table_1', '22');
INSERT INTO `migrations` VALUES ('31', '2018_05_26_090458_alter_zones_table_1', '23');
INSERT INTO `migrations` VALUES ('32', '2018_05_28_032246_create_file_uploads_table', '24');

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modules_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `home_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'value only after base url. Should not use the full URL',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', 'Admin', 'fff', 'na', '/', '0', '0', null, null, '1');

-- ----------------------------
-- Table structure for occupations
-- ----------------------------
DROP TABLE IF EXISTS `occupations`;
CREATE TABLE `occupations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of occupations
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for post1s
-- ----------------------------
DROP TABLE IF EXISTS `post1s`;
CREATE TABLE `post1s` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sms_inbox_name` varchar(100) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post1s
-- ----------------------------
INSERT INTO `post1s` VALUES ('4', 'asdf', '1', '2018-05-28 08:39:16', '2018-05-28 08:39:16', '1', '1');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '2018-05-24 10:31:51', '2018-05-24 10:31:51', 'dfs', 'sdf', '1');
INSERT INTO `posts` VALUES ('2', '2018-05-26 08:17:02', '2018-05-26 08:17:19', 'Jakir', 'sdf', '1');

-- ----------------------------
-- Table structure for privilege_levels
-- ----------------------------
DROP TABLE IF EXISTS `privilege_levels`;
CREATE TABLE `privilege_levels` (
  `users_id` int(11) DEFAULT NULL,
  `user_levels_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `privilege_levels_user_id_user_level_id_unique` (`users_id`,`user_levels_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of privilege_levels
-- ----------------------------
INSERT INTO `privilege_levels` VALUES ('1', '1', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- ----------------------------
-- Table structure for privilege_modules
-- ----------------------------
DROP TABLE IF EXISTS `privilege_modules`;
CREATE TABLE `privilege_modules` (
  `users_id` int(11) NOT NULL DEFAULT '0',
  `modules_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_levels_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of privilege_modules
-- ----------------------------
INSERT INTO `privilege_modules` VALUES ('1', '1', null, null, '1');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `brands_id` int(11) NOT NULL,
  `skues_id` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `description` text,
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
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'safda', '2', '1', '9.00', '22', 'asdfasdf', null, null, '2018-05-27 10:20:29', '1', '1', '2018-05-27 10:30:26', '1');

-- ----------------------------
-- Table structure for product_brands
-- ----------------------------
DROP TABLE IF EXISTS `product_brands`;
CREATE TABLE `product_brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_brands_created_by_index` (`created_by`),
  KEY `product_brands_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_brands
-- ----------------------------
INSERT INTO `product_brands` VALUES ('1', '2018-05-13 09:26:11', '2018-05-13 09:26:11', 'Sony Rangs', 'sdfsdfsdf', null, '1', '1');
INSERT INTO `product_brands` VALUES ('2', '2018-05-13 10:01:40', '2018-05-13 10:10:09', 'Pran RFL', 'sdfsdfs', null, null, '1');
INSERT INTO `product_brands` VALUES ('3', '2018-05-13 10:40:32', '2018-05-13 10:40:32', 'fsdfsdf', 'sdfsfsdf', null, '1', '1');
INSERT INTO `product_brands` VALUES ('4', '2018-05-13 11:25:00', '2018-05-13 11:25:00', 'New Brand', 'NA', null, null, '1');
INSERT INTO `product_brands` VALUES ('5', '2018-05-13 11:30:11', '2018-05-13 11:30:11', 'mukul', 'sdfsdfsdf', null, null, '1');

-- ----------------------------
-- Table structure for product_categories
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_brands_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_categories_product_brands_id_index` (`product_brands_id`),
  KEY `product_categories_created_by_index` (`created_by`),
  KEY `product_categories_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_categories
-- ----------------------------
INSERT INTO `product_categories` VALUES ('1', '2018-05-13 10:59:14', '2018-05-13 11:01:04', 'Electronics', '1', 'dfdfdfdf', '2', '2', '1');

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
-- Table structure for regions
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(255) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES ('1', 'Dinajpur', '1', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('2', 'Rangpur', '2', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('3', 'Gobindogonj', '3', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('4', 'Bogura', '4', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('5', 'Rajshahi', '5', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('6', 'Naogoan ', '6', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('7', 'Pabna', '7', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('8', 'Sirajgonj ', '8', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('9', 'Kushtia', '9', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('10', 'Jhenaidah', '10', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('11', 'Jessore', '11', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('12', 'Khulna', '12', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('13', 'Satkhira', '13', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('14', 'Bagerhat', '14', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('15', 'Mymensingh', '15', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('16', 'Jamalpur', '16', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('17', ' Kishorgonj ', '17', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('18', 'Dhaka- (Tongi)', '18', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('19', 'Dhaka-  (Gazipur)', '19', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('20', 'Dhaka- (Narshingdi)', '20', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('21', 'Dhaka- (Gulshan)', '21', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('22', 'Dhaka - (Lalbag)', '22', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('23', 'Dhaka -(Jatrabari)', '23', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('24', 'Dhaka - (Narayangonj)', '24', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('25', 'Dhaka - (Zinzira)', '25', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('26', 'Dhaka Tangail', '26', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('27', 'Dhaka Savar', '27', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('28', 'Dhaka Mirpur', '28', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('29', 'Faridpur', '29', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('30', 'Madaripur', '30', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('31', 'Barishal', '31', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('32', 'Bhola', '32', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('33', 'Patuakhali', '33', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('34', 'Sylhet -1', '34', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('35', 'Sylhet -2', '35', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('36', 'Sylhet -3', '36', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('37', 'Moulovibazar', '37', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('38', 'B-Baria', '38', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('39', 'Comilla-1', '39', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('40', 'Comilla-2', '40', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('41', 'Chandpur', '41', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('42', 'Noakhali - 1', '42', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('43', 'Noakhali - 2', '43', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('44', 'Feni', '44', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('45', 'Khagrachari', '45', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('46', 'CTG-1', '46', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('47', 'CTG-2', '47', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('48', 'Ctg-3', '48', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('49', 'Cox\'s Bazar-1', '49', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);
INSERT INTO `regions` VALUES ('50', 'Cox\'s Bazar-2', '50', '1', '2018-05-30 14:08:38', null, '2018-05-30 14:08:38', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skues
-- ----------------------------
INSERT INTO `skues` VALUES ('1', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:52', null, null, '1');
INSERT INTO `skues` VALUES ('2', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('3', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('4', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('5', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('6', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('7', '500ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('8', '1L', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('9', '2L', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('10', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('11', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('12', '500ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('13', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('14', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('15', '500ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('16', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('17', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('18', '500ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('19', '1 L', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('20', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('21', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('22', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('23', '250ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('24', '500ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('25', '1 L', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('26', '250ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('27', '250ml Tetra', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('28', '300ml pet', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('29', '250ml can', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('30', '500 ml', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');
INSERT INTO `skues` VALUES ('31', '1.5 L', null, null, null, null, null, '2018-05-30 15:11:53', null, null, '1');

-- ----------------------------
-- Table structure for smsinboxes
-- ----------------------------
DROP TABLE IF EXISTS `smsinboxes`;
CREATE TABLE `smsinboxes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sms_inbox_name` varchar(100) DEFAULT NULL,
  `transactionId` varchar(30) DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `sms_status` varchar(100) DEFAULT NULL,
  `sms_received` datetime DEFAULT NULL,
  `replied_at` datetime DEFAULT NULL,
  `sms_content` text NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of smsinboxes
-- ----------------------------
INSERT INTO `smsinboxes` VALUES ('3', 'asdf', null, '01915117181', null, null, null, 'sdfsdfsdf', null, null, '2018-05-28 08:54:18', '1', '1');
INSERT INTO `smsinboxes` VALUES ('4', 'sdf', null, '', null, null, null, '', '1', '2018-05-28 08:44:36', '2018-05-28 08:44:36', '1', '1');
INSERT INTO `smsinboxes` VALUES ('5', 'sdf', 'asdfsf', '', null, null, null, '', '1', '2018-05-28 08:45:28', '2018-05-28 08:45:28', '1', '1');
INSERT INTO `smsinboxes` VALUES ('6', null, null, null, null, null, null, 'sdfsdf', '1', '2018-05-28 08:47:16', '2018-05-28 08:52:21', '1', '0');
INSERT INTO `smsinboxes` VALUES ('7', 'ffffff', 'ffffff', null, null, null, null, '', '1', '2018-05-28 08:47:42', '2018-05-28 08:47:42', '1', '1');
INSERT INTO `smsinboxes` VALUES ('8', 'asdf', 'asdf', null, null, null, null, '', '1', '2018-05-28 08:49:39', '2018-05-28 08:49:39', '1', '1');
INSERT INTO `smsinboxes` VALUES ('9', 'asdf', 'asdf', null, null, null, null, '', '1', '2018-05-28 08:50:41', '2018-05-28 08:50:41', '1', '0');
INSERT INTO `smsinboxes` VALUES ('10', null, null, null, null, null, null, 'sdfs', '1', '2018-05-28 08:52:07', '2018-05-28 08:52:07', null, '0');
INSERT INTO `smsinboxes` VALUES ('11', 'sdf', 'sdfasd', '01915117181', 'asdf', null, null, 'saf', null, '2018-05-28 08:57:38', '2018-05-28 08:57:38', null, '0');
INSERT INTO `smsinboxes` VALUES ('12', null, null, null, null, null, null, 'sdfsdf', null, '2018-05-28 08:59:06', '2018-05-28 08:59:06', null, '0');
INSERT INTO `smsinboxes` VALUES ('13', null, null, null, null, null, null, 'sdfasdf', null, '2018-05-28 09:07:29', '2018-05-28 09:07:29', null, '0');
INSERT INTO `smsinboxes` VALUES ('14', null, null, null, null, null, null, 'sdf', '1', '2018-05-29 09:27:23', '2018-05-29 09:27:23', null, '0');

-- ----------------------------
-- Table structure for sms_inboxes
-- ----------------------------
DROP TABLE IF EXISTS `sms_inboxes`;
CREATE TABLE `sms_inboxes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sms_inbox_name` varchar(100) DEFAULT NULL,
  `transactionId` varchar(30) DEFAULT NULL,
  `sender` varchar(15) NOT NULL,
  `sms_content` text NOT NULL,
  `sms_received` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `replied_datetime` datetime DEFAULT NULL,
  `sms_status` enum('Active','Inactive','Pending','Replied','Unread') DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_sms_inbox` (`sender`,`sms_received`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sms_inboxes
-- ----------------------------
INSERT INTO `sms_inboxes` VALUES ('3', null, null, '01915117181', 'test', null, '1', null, null, 'Active', '2018-05-29 16:24:55', null, null);
INSERT INTO `sms_inboxes` VALUES ('4', null, null, 'sdf', 'sadf', null, '1', null, null, 'Active', '2018-05-29 16:29:44', null, '1');
INSERT INTO `sms_inboxes` VALUES ('5', null, null, '01915117181', 'sdfsdf', null, null, null, null, 'Active', '2018-05-29 16:24:55', null, null);
INSERT INTO `sms_inboxes` VALUES ('6', null, null, '01721874222', 'sms test process', null, null, null, null, 'Active', '2018-05-29 16:24:56', null, null);
INSERT INTO `sms_inboxes` VALUES ('7', null, null, '01915117181', 'fsdf', null, null, null, null, 'Active', null, null, '1');
INSERT INTO `sms_inboxes` VALUES ('8', null, null, '01915117181', 'final test', null, null, null, null, 'Active', null, null, '1');

-- ----------------------------
-- Table structure for sms_inboxes28052018
-- ----------------------------
DROP TABLE IF EXISTS `sms_inboxes28052018`;
CREATE TABLE `sms_inboxes28052018` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sms_inbox_name` varchar(100) DEFAULT NULL,
  `transactionId` varchar(30) DEFAULT NULL,
  `sms_sender_number` varchar(255) NOT NULL,
  `sms_content` text NOT NULL,
  `sms_received` datetime DEFAULT NULL,
  `replied_datetime` datetime DEFAULT NULL,
  `sms_status` varchar(100) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_sms_inbox` (`sms_sender_number`,`sms_received`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sms_inboxes28052018
-- ----------------------------
INSERT INTO `sms_inboxes28052018` VALUES ('3', '', null, '01915117181', 'sdfas', null, null, null, null, null, '2018-05-28 13:47:19', null, '1');

-- ----------------------------
-- Table structure for territories
-- ----------------------------
DROP TABLE IF EXISTS `territories`;
CREATE TABLE `territories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `territory_name` varchar(255) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of territories
-- ----------------------------
INSERT INTO `territories` VALUES ('1', 'Dinajpur', '1', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('2', 'Thakurgaon', '2', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('3', 'Rangpur', '3', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('4', 'Lalmonirhat', '4', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('5', 'Joypurhat', '5', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('6', 'Gaibandah', '6', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('7', 'Bogura Sadar ', '7', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('8', 'Mohastangar', '8', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('9', 'Rajshahi Sadar', '9', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('10', 'Chapai Nawabgonj', '10', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('11', 'Naogoan Sadar', '11', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('12', 'Natore Sadar', '12', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('13', 'Pabna 1', '13', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('14', 'Pabna 2', '14', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('15', 'Sirajgonj Road (Solonga )', '15', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('16', 'Ullapara', '16', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('17', 'Kushtia', '17', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('18', 'Mirpur', '18', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('19', 'Gangni', '19', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('20', 'Jhenaidah', '20', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('21', 'Kumarkhali', '21', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('22', 'Chuadanga', '22', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('23', 'Jessore', '23', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('24', 'Jhikorgacha', '24', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('25', 'Magura', '25', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('26', 'Narail', '26', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('27', 'Khulna', '27', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('28', 'Lockpur/ East Rupsha', '28', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('29', 'Dawlatpur', '29', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('30', 'Satkhira', '30', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('31', 'Chuknagar', '31', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('32', 'Bagerhat', '32', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('33', 'Pirozpur', '33', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('34', 'Gopalgonj', '34', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('35', 'Mymensingh Sadar', '35', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('36', 'Bhaluka', '36', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('37', 'Jamalpur', '37', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('38', 'Sherpur', '38', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('39', 'Kotiadi', '39', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('40', 'Netrokona ', '40', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('41', ' Kishorgonj ', '41', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('42', 'Tongi', '42', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('43', 'Uttara', '43', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('44', 'Dakhin Khan', '44', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('45', 'Board Bazar', '45', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('46', 'Gazipur', '46', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('47', 'Kapasia', '47', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('48', 'Hotapara', '48', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('49', 'Mawna', '49', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('50', 'Konabari', '50', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('51', 'Kaliakoir', '51', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('52', 'Narshingdi', '52', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('53', 'Bhairob', '53', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('54', 'Rupgonj', '54', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('55', 'Gulshan', '55', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('56', 'Tejgaon', '56', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('57', 'Badda', '57', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('58', 'Lalbag', '58', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('59', 'Mohammadpur', '59', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('60', 'Farmgate', '60', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('61', 'Jatrabari', '61', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('62', 'Demra', '62', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('63', 'Sutrapur', '63', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('64', 'Sabujbagh', '64', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('65', 'Narayangonj', '65', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('66', 'Bhuygor', '66', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('67', 'Sonargaon', '67', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('68', 'Zinzira', '68', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('69', 'Dohar', '69', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('70', 'Munsigonj', '70', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('71', 'Tangail', '71', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('72', 'Elenga', '72', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('73', 'Savar', '73', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('74', 'Nobinagar', '74', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('75', 'Manikgonj', '75', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('76', 'Mirpur-1', '76', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('77', 'Mirpur-13', '77', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('78', 'Hemayetpur', '78', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('79', 'CSD- Cantonment', '79', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('80', 'Faridpur Sadar', '80', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('81', 'Rajbari', '81', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('82', 'Shariatpur', '82', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('83', 'Madaripur ', '83', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('84', 'Barishal Sadar', '84', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('85', 'Uzirpur', '85', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('86', 'Jhalakathi', '86', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('87', 'Bhola Sadar', '87', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('88', 'Bawfal', '88', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('89', 'Patuakhali', '89', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('90', 'Amtoli', '90', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('91', 'Barguna', '91', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('92', 'Eidgah', '92', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('93', 'Laldighi', '93', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('94', 'Goainghat', '94', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('95', 'South Surma', '95', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('96', 'Bianibazar', '96', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('97', 'Sunamgonj', '97', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('98', 'Bisawnath', '98', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('99', 'Moulovibazar', '99', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('100', 'Kulaura', '100', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('101', 'Hobigonj', '101', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('102', 'Sayestagonj', '102', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('103', 'B-Baria Sador', '103', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('104', 'Sarail', '104', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('105', 'Companygonj', '105', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('106', 'Comilla', '106', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('107', 'Gauripur', '107', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('108', 'Paduar Bazar', '108', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('109', 'Laksham', '109', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('110', 'Chandpur', '110', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('111', 'Hajigonj', '111', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('112', 'Chowmuhani', '112', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('113', 'Sonaimuri', '113', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('114', 'Chandragonj', '114', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('115', 'Maijdee', '115', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('116', 'Subarnachar', '116', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('117', 'Feni Sadar', '117', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('118', 'Chowddagram', '118', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('119', 'Dagonbuiyan', '119', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('120', 'Nazirhat', '120', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('121', 'Khagrachari', '121', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('122', 'Bondar', '122', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('123', 'Patenga', '123', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('124', 'Halishahar', '124', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('125', 'Asadgonj', '125', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('126', 'Bakulia', '126', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('127', 'Khulshi', '127', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('128', 'Alangkar', '128', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('129', 'Sitakundu', '129', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('130', 'Hathazari', '130', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('131', 'Oxyzen', '131', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('132', 'Rangamati', '132', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('133', 'Mohora', '133', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('134', 'Cox\'s Bazar Sadar', '134', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('135', 'Ukhiya', '135', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('136', 'Eidgaon', '136', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('137', 'Chokoria', '137', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('138', 'Moheskhali', '138', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('139', 'Amirabad', '139', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('140', 'Keranir Hat', '140', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('141', 'Patiya', '141', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);
INSERT INTO `territories` VALUES ('142', 'Anowara', '142', '1', '2018-05-30 14:10:56', null, '2018-05-30 14:10:56', null, null);

-- ----------------------------
-- Table structure for unions
-- ----------------------------
DROP TABLE IF EXISTS `unions`;
CREATE TABLE `unions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countries_id` int(10) unsigned DEFAULT NULL,
  `divisions_id` int(10) unsigned DEFAULT NULL,
  `districts_id` int(10) unsigned DEFAULT NULL,
  `upazilas_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unions_countries_id_index` (`countries_id`),
  KEY `unions_divisions_id_index` (`divisions_id`),
  KEY `unions_districts_id_index` (`districts_id`),
  KEY `unions_upazilas_id_index` (`upazilas_id`),
  KEY `unions_created_by_index` (`created_by`),
  KEY `unions_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of unions
-- ----------------------------
INSERT INTO `unions` VALUES ('1', '2018-05-13 12:14:05', '2018-05-13 12:14:05', 'Gazir Khamar', '1', '1', '1', '1', 'NA', '2', '1', '1');
INSERT INTO `unions` VALUES ('2', '2018-05-13 12:18:07', '2018-05-13 12:18:07', 'Kalshi', '1', '1', '1', '1', 'NA', '2', '1', '1');

-- ----------------------------
-- Table structure for upazilas
-- ----------------------------
DROP TABLE IF EXISTS `upazilas`;
CREATE TABLE `upazilas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countries_id` int(10) unsigned DEFAULT NULL,
  `divisions_id` int(10) unsigned DEFAULT NULL,
  `districts_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upazilas_countries_id_index` (`countries_id`),
  KEY `upazilas_divisions_id_index` (`divisions_id`),
  KEY `upazilas_districts_id_index` (`districts_id`),
  KEY `upazilas_created_by_index` (`created_by`),
  KEY `upazilas_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of upazilas
-- ----------------------------
INSERT INTO `upazilas` VALUES ('1', '2018-05-13 12:12:24', '2018-05-13 12:12:24', 'Sherpur Sadar', '1', '1', '1', 'NA', '2', '1', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_key` varchar(200) DEFAULT NULL,
  `password_expire_days` int(3) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `home_telephone` varchar(20) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `secret_question_1` varchar(100) DEFAULT NULL,
  `secret_question_2` varchar(100) DEFAULT NULL,
  `secret_question_ans_1` varchar(100) DEFAULT NULL,
  `secret_question_ans_2` varchar(100) DEFAULT NULL,
  `identification_type_id` int(11) DEFAULT '0',
  `identification_number` varchar(30) DEFAULT NULL,
  `identification_expire_date` date DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(500) DEFAULT NULL,
  `religion_id` int(11) DEFAULT '0',
  `father_name` varchar(100) DEFAULT NULL,
  `father_occupation_id` int(11) DEFAULT '0',
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_occupation_id` int(11) DEFAULT '0',
  `bank_account_number` varchar(30) DEFAULT NULL,
  `bank_id` int(11) DEFAULT '0',
  `bank_branch` varchar(100) DEFAULT NULL,
  `last_login_date_time` timestamp NULL DEFAULT NULL,
  `default_module_id` int(11) DEFAULT '0',
  `user_image` varchar(100) DEFAULT 'images/default/avatar.jpg',
  `address` varchar(100) DEFAULT NULL,
  `is_reliever` tinyint(4) DEFAULT '0',
  `reliever_to` int(11) DEFAULT '0',
  `reliever_start_datetime` timestamp NULL DEFAULT NULL,
  `reliever_end_datetime` timestamp NULL DEFAULT NULL,
  `line_manager_id` int(11) DEFAULT '0',
  `designation_id` int(11) DEFAULT '0',
  `department_id` int(11) DEFAULT '0',
  `location_id` int(11) DEFAULT '0',
  `default_vehicle_id` int(11) DEFAULT '0' COMMENT 'If this employee or user is a driver',
  `default_url` varchar(500) DEFAULT NULL,
  `default_language_id` int(11) DEFAULT '0',
  `joining_date` date DEFAULT NULL,
  `emergency_contact_person_name` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(30) DEFAULT NULL,
  `emergency_contact_number` varchar(20) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `territories_id` int(10) NOT NULL DEFAULT '0',
  `distribution_houses_id` int(10) NOT NULL DEFAULT '0',
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  `zones_id` int(10) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Apsis', 'apsis@gmail.com', '$2y$10$2nkgX.Wgvs4q3wCgICad/uz2g90yakp5Tb5y9UYGyYSslArBSJXvK', null, null, null, null, null, 'apsis', null, null, null, null, '0', null, null, null, null, '0', null, '0', null, '0', null, '0', null, null, '0', 'images/default/avatar.jpg', null, '0', '0', null, null, '0', '0', '0', '0', '0', null, '0', null, null, null, null, 'Pc3DlVzUks53124A1y1GYdFmj5p360neJsvfNJSTHGiO3dbeNnS63DGGJUu1', '0', '0', null, null, '0', '0', null, '0', null, null);

-- ----------------------------
-- Table structure for user_levels
-- ----------------------------
DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE `user_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Active','Inactive') NOT NULL,
  `privilege_edit` tinyint(4) NOT NULL DEFAULT '0',
  `privilege_delete` tinyint(4) NOT NULL DEFAULT '0',
  `privilege_add` tinyint(4) NOT NULL DEFAULT '0',
  `privilege_view_all` tinyint(4) NOT NULL DEFAULT '0',
  `all_privilege` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_levels_user_level_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_levels
-- ----------------------------
INSERT INTO `user_levels` VALUES ('1', 'Admin', 'dd', '0', '2018-05-14 16:24:52', '0', '2018-05-14 16:25:03', 'Active', '0', '0', '0', '0', '0', null, null);

-- ----------------------------
-- Table structure for user_settings
-- ----------------------------
DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE `user_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email' COMMENT 'login by username/email/mobile',
  `username_minimum_length` int(11) NOT NULL DEFAULT '5',
  `username_maximum_length` int(11) NOT NULL DEFAULT '25',
  `username_have_special_character` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=no and 1=yes',
  `maximum_login_same_user` tinyint(4) NOT NULL DEFAULT '1',
  `maximum_login_perday` tinyint(4) NOT NULL DEFAULT '10',
  `maximum_login_permonth` int(11) NOT NULL DEFAULT '1000',
  `maximum_login_attempt` tinyint(4) NOT NULL DEFAULT '5',
  `maximum_login_attempt_reset_time` tinyint(4) NOT NULL DEFAULT '15' COMMENT 'minimum 15 minutes',
  `have_login_security_code` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no , 1= yes',
  `security_code_length` tinyint(4) NOT NULL DEFAULT '6',
  `session_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30' COMMENT 'default 30 minutes',
  `password_minimum_length` int(11) NOT NULL DEFAULT '6',
  `password_maximum_length` int(11) NOT NULL DEFAULT '12',
  `password_have_special_character` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no and 1=yes',
  `password_special_character` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_have_expire_day` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `password_expire_days` int(11) NOT NULL DEFAULT '0',
  `last_used_password` tinyint(4) NOT NULL DEFAULT '5' COMMENT 'do not use last 5 used password',
  `have_default_password` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `default_password_length` int(11) NOT NULL DEFAULT '8',
  `default_password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_password_plaintext` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=no, 1=yes',
  `username_email_phone_as_password` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=no, 1=yes',
  `password_prohibited_words` text COLLATE utf8mb4_unicode_ci COMMENT 'this words are not as a password',
  `user_activation_policy` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=no, 1=yes',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_settings
-- ----------------------------

-- ----------------------------
-- Table structure for zones
-- ----------------------------
DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(255) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rfu1` int(11) DEFAULT NULL,
  `rfu2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of zones
-- ----------------------------
INSERT INTO `zones` VALUES ('1', 'North Bengal - 01', '1', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('2', 'North Bengal-2', '2', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('3', 'Jessore Zone', '3', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('4', 'Mymensingh Zone', '4', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('5', 'Dhaka North Zone', '5', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('6', 'Dhaka South Zone', '6', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('7', 'Dhaka West Zone', '7', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('8', 'Barishal Zone', '8', '1', '2018-05-30 14:01:46', '1', '2018-05-30 08:01:22', null, null);
INSERT INTO `zones` VALUES ('9', 'Sylhet Zone', '9', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('10', 'Comilla Zone ', '10', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('11', 'Noakhali Zone', '11', '1', '2018-05-30 14:01:46', null, null, null, null);
INSERT INTO `zones` VALUES ('12', 'Chottrogram Zone', '12', '1', '2018-05-30 14:01:46', null, null, null, null);
