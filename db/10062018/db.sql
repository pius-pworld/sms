-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.40 - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table larafremworktestdb.abcs
CREATE TABLE IF NOT EXISTS `abcs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.abcs: ~1 rows (approximately)
/*!40000 ALTER TABLE `abcs` DISABLE KEYS */;
INSERT INTO `abcs` (`id`, `created_at`, `updated_at`, `name`, `description`, `is_active`) VALUES
	(1, '2018-05-26 02:38:38', '2018-05-26 02:38:38', 'sdsda', 'asdasda', 1);
/*!40000 ALTER TABLE `abcs` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.branches
CREATE TABLE IF NOT EXISTS `branches` (
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

-- Dumping data for table larafremworktestdb.branches: ~0 rows (approximately)
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categories_id` int(10) unsigned DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `segment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ordering` int(10) DEFAULT NULL,
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

-- Dumping data for table larafremworktestdb.brands: ~13 rows (approximately)
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` (`id`, `categories_id`, `brand_name`, `segment`, `description`, `ordering`, `rfu1`, `rfu2`, `created_at`, `created_by`, `updated_by`, `updated_at`, `is_active`) VALUES
	(1, 1, 'Tiger', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(2, 1, 'Black Horse', NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(3, 2, 'Fizz up', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(4, 2, 'Uro Cola', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(5, 2, 'Uro Lemon', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(6, 2, 'Uro Orange', NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(7, 2, 'Uro Zeera', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(8, 3, 'Oranjee', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(9, 3, 'Lemonjee', NULL, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(10, 4, 'Mangolee', NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(11, 4, 'Mango King', NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(12, 5, 'Lychena', NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(13, 6, 'Alma', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.categories
CREATE TABLE IF NOT EXISTS `categories` (
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

-- Dumping data for table larafremworktestdb.categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`, `category_description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `status`) VALUES
	(1, 'saf', 'asdf', 1, '2018-05-27 02:05:25', NULL, '2018-05-27 02:05:25', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.countries
CREATE TABLE IF NOT EXISTS `countries` (
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

-- Dumping data for table larafremworktestdb.countries: ~1 rows (approximately)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `created_at`, `updated_at`, `name`, `description`, `created_by`, `updated_by`, `is_active`) VALUES
	(1, '2018-05-13 06:06:13', '2018-05-13 06:06:13', 'Bangladesh', 'NA', 2, 1, 1);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.departments: ~2 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `details`, `is_active`) VALUES
	(1, 'IT', '2018-05-26 03:08:58', '2018-05-26 03:08:58', 1, 1, 'qwdwq', 1),
	(2, 'Account', '2018-05-26 03:44:39', '2018-05-26 03:44:39', NULL, NULL, 'zxzx', 1);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.designations
CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci COMMENT 'Sometime we need to describe the value of this master data',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'This is basically the row status. whether this record is active or not. 1 = Active, 0 = Inactive ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.designations: ~1 rows (approximately)
/*!40000 ALTER TABLE `designations` DISABLE KEYS */;
INSERT INTO `designations` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `details`, `status`) VALUES
	(1, 'IT Executive', NULL, NULL, 1, NULL, NULL, 1);
/*!40000 ALTER TABLE `designations` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.distribution_houses
CREATE TABLE IF NOT EXISTS `distribution_houses` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table larafremworktestdb.distribution_houses: ~6 rows (approximately)
/*!40000 ALTER TABLE `distribution_houses` DISABLE KEYS */;
INSERT INTO `distribution_houses` (`id`, `zones_id`, `regions_id`, `territories_id`, `market_name`, `code`, `point_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `rfu1`, `rfu2`) VALUES
	(1, 4, 2, 2, 'test market', 'testcode', 'testpoint', 1, '2018-05-27 04:53:20', 1, '2018-05-27 06:32:56', NULL, NULL),
	(2, 4, 2, 2, 'asdfa', 'asdf', 'asdf', NULL, '2018-05-27 06:38:48', NULL, '2018-05-27 06:38:48', NULL, NULL),
	(3, 9, 2, 2, 'dfasda', 'dfdf', 'dfdf', NULL, '2018-05-27 06:39:39', NULL, '2018-05-27 06:39:39', NULL, NULL),
	(4, 3, 1, 2, 'sdfsa', 'sdf', 'dddddddddddd', NULL, '2018-05-27 06:41:56', 1, '2018-05-27 06:44:26', NULL, NULL),
	(5, 4, 2, 3, 'asdf', 'asdf', 'asdf', 1, '2018-05-27 06:43:35', NULL, '2018-05-27 06:43:35', NULL, NULL),
	(6, 7, 2, 5, 'sadfas', 'fdfs', 'sdfsdf', 1, '2018-05-27 06:44:13', NULL, '2018-05-27 06:44:13', NULL, NULL);
/*!40000 ALTER TABLE `distribution_houses` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.districts
CREATE TABLE IF NOT EXISTS `districts` (
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

-- Dumping data for table larafremworktestdb.districts: ~3 rows (approximately)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` (`id`, `created_at`, `updated_at`, `name`, `divisions_id`, `description`, `created_by`, `updated_by`, `is_active`, `countries_id`) VALUES
	(1, '2018-05-13 06:10:55', '2018-05-13 06:10:55', 'Sherpur', 1, 'NA', 2, 1, 1, 1),
	(2, '2018-05-26 02:20:14', '2018-05-26 02:20:14', 'Jakir', 1, '474', NULL, 1, 1, 1),
	(3, '2018-05-26 02:22:27', '2018-05-26 02:22:27', 'Jakir', 1, 'test', NULL, 1, 1, 1);
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.divisions
CREATE TABLE IF NOT EXISTS `divisions` (
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

-- Dumping data for table larafremworktestdb.divisions: ~1 rows (approximately)
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` (`id`, `created_at`, `updated_at`, `name`, `countries_id`, `description`, `created_by`, `updated_by`, `is_active`) VALUES
	(1, '2018-05-13 06:10:32', '2018-05-13 06:10:32', 'Dhaka', 1, 'NA', 2, 1, 1);
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.file_uploads
CREATE TABLE IF NOT EXISTS `file_uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.file_uploads: ~1 rows (approximately)
/*!40000 ALTER TABLE `file_uploads` DISABLE KEYS */;
INSERT INTO `file_uploads` (`id`, `created_at`, `updated_at`, `images`) VALUES
	(1, '2018-05-27 21:25:51', '2018-05-27 21:25:51', 'uploads/qAS6ySN3COIWlRjOYuiDLjnoYJB1O7P9VU5LTyGA.png');
/*!40000 ALTER TABLE `file_uploads` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.flights
CREATE TABLE IF NOT EXISTS `flights` (
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

-- Dumping data for table larafremworktestdb.flights: ~0 rows (approximately)
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.forms
CREATE TABLE IF NOT EXISTS `forms` (
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

-- Dumping data for table larafremworktestdb.forms: ~0 rows (approximately)
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.form_items
CREATE TABLE IF NOT EXISTS `form_items` (
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

-- Dumping data for table larafremworktestdb.form_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `form_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_items` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.grids
CREATE TABLE IF NOT EXISTS `grids` (
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

-- Dumping data for table larafremworktestdb.grids: ~12 rows (approximately)
/*!40000 ALTER TABLE `grids` DISABLE KEYS */;
INSERT INTO `grids` (`id`, `name`, `grid_title`, `description`, `theads`, `data_query`, `query_groupby`, `query_orderby`, `query_limit`, `query_having`, `pagination`, `pagination_rules`, `excel_export`, `pdf_export`, `search_panel`, `search_panel_id`, `search_panel_position`, `created_by`, `grid_template_id`, `created`, `updated_by`, `updated`, `is_active`) VALUES
	(1, 'Purchase List', 'Purchase List', 'All Purchase will show in this grid', 'SL,Purchase Code,Date,Amount,Vendor', 'SELECT purchase_order.purchase_code, purchase_order.order_date, purchase_order.order_value, vendor.vendor_name FROM purchase_order LEFT JOIN vendor ON purchase_order.vendor_id = vendor.vendor_id where 1', NULL, NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 0, 1, 1, 'Top', 1, 0, '2017-01-11 15:59:36', 1, '2017-01-16 19:21:12', 1),
	(2, 'LC Settlement', 'LC Settlement', '', 'SL#,LC Number, Indent Number, Account Head,Date, Amount', 'SELECT\r\nproforma_invoice.lc_number,\r\nproforma_invoice.indent_number,\r\nacc_head.acc_head_name,\r\nvoucherdetails.TransactionDate,\r\nvoucherdetails.Debit\r\nFROM\r\nvoucherdetails\r\nINNER JOIN proforma_invoice ON voucherdetails.LcID = proforma_invoice.proforma_invoice_id\r\nLEFT JOIN acc_head ON voucherdetails.AccountName = acc_head.acc_head_id\r\nWHERE 1 HAVING voucherdetails.Debit > 0', NULL, NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 7, 'Top', 1, 0, '2017-02-01 18:51:58', 1, '2017-06-07 08:44:36', 1),
	(3, 'Trial Balence', 'Trial Balance', '', 'SL#,Date,Account Head, Debit,Credit', 'SELECT voucherdetails.TransactionDate,acc_head.acc_head_name,voucherdetails.Debit,voucherdetails.Credit FROM voucherdetails LEFT JOIN acc_head ON voucherdetails.AccountName = acc_head.acc_head_id WHERE 1', NULL, NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 7, 'Top', 1, 0, '2017-02-01 19:12:44', 1, '2017-02-02 11:11:11', 1),
	(4, 'Accounts Statement', 'Accounts Statement', '', 'SL#,Date,Accounts Head,Debit,Credit', 'SELECT voucherdetails.TransactionDate, acc_head.acc_head_name, voucherdetails.Debit, voucherdetails.Credit FROM voucherdetails LEFT JOIN acc_head ON voucherdetails.AccountName = acc_head.acc_head_id WHERE 1', NULL, NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 6, 'Top', 1, 0, '2017-02-01 19:16:24', 1, '2017-02-02 11:38:25', 1),
	(5, 'Purchase History', 'Purchase History', '', 'Purchase Code, Order Date, Order Value,Status', 'SELECT purchase_order.purchase_id,purchase_order.purchase_code, purchase_order.order_date, purchase_order.order_value,status.status_name FROM purchase_order LEFT JOIN status ON purchase_order.status=status.status_id WHERE 1', NULL, NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 8, 'Top', 1, 0, '2017-06-08 06:15:42', 1, '2017-06-10 09:20:42', 1),
	(6, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 1, '10,25,50,100,All', 0, 0, 1, NULL, 'Top', 0, 0, '2017-06-10 04:16:18', NULL, NULL, 1),
	(7, 'Warranty List', 'Warranty List', '', 'Ticket Code,Sales Code,Product Code,Created,Customer Name,Customer Mobile,Problems,Status,Product Receive,Action', 'SELECT ticket.ticket_id,ticket.ticket_code, ticket.sales_code, product.product_code, ticket.created, ticket.customer_name, ticket.customer_mobile, SUBSTR(ticket.problem_details,1,50) as problems, status.status_name,\'receive\',\'edit\',\'view\',\'delete\' FROM ticket LEFT JOIN status ON ticket.service_status = status.status_id LEFT JOIN product ON product.product_id=ticket.product_id', '', '', NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 9, 'Top', 1, 1, '2017-06-18 08:40:46', 1, '2018-01-08 06:57:24', 1),
	(8, 'Warranty Archive', 'Warranty Archive', '', 'Code, Customer Name, Customer Mobile, Product Problem, Receive Date, Delivery Date, Action', 'SELECT ticket.ticket_id, ticket.ticket_code, ticket.customer_name, ticket.customer_mobile, ticket.problem_details, ticket.created, ticket.updated, \'view\' FROM ticket WHERE ticket.service_status = 74', '', NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 11, 'Top', 1, 0, '2017-07-26 07:00:53', 1, '2017-07-26 08:29:31', 1),
	(9, 'Dealer Target List', 'Dealer Target List', '', 'Branch,Target Month,Base Period,Average By,Based On,Action', 'SELECT dealer_target_set.dealer_target_set_id,location.location_name,dealer_target_set.year_month,dealer_target_set.base_period,dealer_target_set.base_by,dealer_target_set.base_on,\'edit\' FROM dealer_target_set LEFT JOIN location ON dealer_target_set.location_id = location.location_id OR dealer_target_set.dealer_id = \'All\'', 'dealer_target_set.location_id', NULL, NULL, NULL, 1, '10,25,50,100,All', 1, 0, 1, 12, 'Top', 1, 0, '2017-08-03 11:02:24', 1, '2017-08-03 11:41:59', 1),
	(10, 'Current Stock', 'Current Stock', '', 'Origin,Product Name,Product_code,Available Qty,On Process Qty, Reorder Qty', 'select product.product_details_json,product.product_id,region.region_name,product.product_name,product.product_code,IFNULL(sum(purchase_good_receive.available_quantity),0) as avQty,(SELECT ( Sum(	purchase_order_details.confirm_quantity ) - Sum( purchase_order_details.total_received ) ) AS optotal from (purchase_order_details) INNER JOIN proforma_invoice ON purchase_order_details.proforma_invoice_id = proforma_invoice.proforma_invoice_id WHERE purchase_order_details.product_id = product.product_id AND proforma_invoice.pi_status IN (48, 50)) as onProcessing,product.reorder_qty FROM product left join region on region.region_id=product.region_id left join purchase_good_receive on product.product_id=purchase_good_receive.product_id AND purchase_good_receive.good_receive_status_id=45 where product.status=\'Active\'', 'product.product_id', 'product.product_id', NULL, NULL, 1, '10,25,50,100,All', 1, 1, 1, 13, 'Top', 1, 1, '2017-12-21 12:13:18', 1, '2018-01-21 06:49:22', 1),
	(11, 'Receive History', 'Receive History', '', 'Product Name,product Code,Purchase Code,Indent Number,Warehouse,Receive Qty,Available Qty,Receive Date', 'SELECT product.product_code, product.product_name, purchase_order.purchase_code, purchase_good_receive.indent_number, warehouse.warehouse_name,purchase_good_receive.receive_quantity, purchase_good_receive.available_quantity,purchase_good_receive.created FROM purchase_good_receive LEFT JOIN product ON purchase_good_receive.product_id = product.product_id LEFT JOIN purchase_order ON purchase_good_receive.purchase_id = purchase_order.purchase_id LEFT JOIN warehouse ON purchase_good_receive.warehouse_id = warehouse.warehouse_id WHERE purchase_good_receive.good_receive_status_id=45', '', '', NULL, NULL, 1, '10,25,50,100,All', 1, 1, 0, 13, 'Top', 1, 1, '2017-12-23 06:24:31', 1, '2017-12-23 06:45:14', 1),
	(12, 'FOB Ordering', 'FOB Ordering', '', 'Fob Name, Details,Status', 'select \'fob\' as table_name, fob.fob_id as primary_id, fob.fob_name, fob.details,fob.status FROM fob order by ordering', '', '', NULL, NULL, 0, '10,25,50,100,All', 1, 1, 0, 14, 'Top', 1, 1, '2017-12-26 08:14:51', 1, '2017-12-27 05:32:32', 1);
/*!40000 ALTER TABLE `grids` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.grid_templates
CREATE TABLE IF NOT EXISTS `grid_templates` (
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

-- Dumping data for table larafremworktestdb.grid_templates: ~0 rows (approximately)
/*!40000 ALTER TABLE `grid_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `grid_templates` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.locations
CREATE TABLE IF NOT EXISTS `locations` (
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

-- Dumping data for table larafremworktestdb.locations: ~0 rows (approximately)
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.menus
CREATE TABLE IF NOT EXISTS `menus` (
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

-- Dumping data for table larafremworktestdb.menus: ~17 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `menus_description`, `menus_type`, `parent_menus_id`, `modules_id`, `icon_class`, `menu_url`, `sort_number`, `created_by`, `updated_by`, `created_at`, `updated_at`, `is_active`) VALUES
	(2, 'Nationally', 'All National', 'Main', 0, 1, 'fa fa-address-card', '#', 1, 1, 0, NULL, NULL, 1),
	(3, 'Zone', '#', 'Sub', 2, 1, 'fa fa-list', 'zones', 1, 1, 0, NULL, NULL, 1),
	(4, 'Region', '#', 'Sub', 2, 1, 'fa fa-list', 'regions', 2, 1, 0, NULL, NULL, 1),
	(5, 'Territories', '#', 'Sub', 2, 1, 'fa fa-list', 'territories', 2, 1, 0, NULL, NULL, 1),
	(6, 'Distributor', '#', 'Sub', 2, 1, 'fa fa-list', 'distribution_houses', 2, 1, 0, NULL, NULL, 1),
	(7, 'Product Info', 'All product info here', 'Main', 0, 1, 'fa fa-product-hunt', '#', 1, 1, 0, NULL, NULL, 1),
	(8, 'Category', '#', 'Sub', 7, 1, 'fa fa-list', 'categories', 1, 1, 0, NULL, NULL, 1),
	(9, 'Product Type', '#', 'Sub', 7, 1, 'fa fa-list', 'product_types', 1, 1, 0, NULL, NULL, 0),
	(10, 'Product', '#', 'Sub', 7, 1, 'fa fa-list', 'products', 1, 1, 0, NULL, NULL, 1),
	(11, 'Skue', '#', 'Sub', 7, 1, 'fa fa-list', 'skues', 1, 1, 0, NULL, NULL, 1),
	(12, 'Brand', '#', 'Sub', 7, 1, 'fa fa-list', 'brands', 1, 1, 0, NULL, NULL, 1),
	(13, 'SMS', 'All SMS Menu Here', 'Main', 0, 1, 'fa fa-comment', '#', 1, 1, 0, NULL, NULL, 1),
	(14, 'SMS Inbox', '#', 'Sub', 13, 1, 'fa fa-list', 'sms_inboxes', 1, 1, 0, NULL, NULL, 1),
	(15, 'Settings', '#', 'Main', 0, 1, 'fa fa-cog', '#', 1, 1, 0, NULL, NULL, 1),
	(16, 'Ordering Brand&Skue', '#', 'Sub', 15, 1, 'fa fa-list-ol', 'settings/brand_skue', 1, 1, 0, NULL, NULL, 1),
	(17, 'Promotion', '#', 'Sub', 15, 1, 'fa fa-plus-square', 'promotions', 1, 1, 0, NULL, NULL, 1),
	(18, 'Promotion List', '#', 'Sub', 15, 1, 'fa fa-list', 'promotionsList', 2, 1, 0, NULL, NULL, 1);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.migrations: ~32 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_05_13_085233_create_product_brands_table', 2),
	(4, '2018_05_13_101626_create_product_categories_table', 3),
	(5, '2018_05_13_104138_alter_product_brands_table_1', 4),
	(6, '2018_05_13_110008_alter_product_categories_table_1', 5),
	(7, '2018_05_13_113810_create_products_table', 6),
	(8, '2018_05_13_115234_alter_products_table_1', 7),
	(9, '2018_05_13_115545_alter_products_table_2', 8),
	(10, '2018_05_13_120250_create_countries_table', 9),
	(11, '2018_05_13_120339_alter_countries_table_1', 10),
	(12, '2018_05_13_120454_create_divisions_table', 11),
	(13, '2018_05_13_120828_create_districts_table', 12),
	(14, '2018_05_13_120937_alter_districts_table_1', 13),
	(15, '2018_05_13_121148_create_upazilas_table', 14),
	(16, '2018_05_13_121326_create_unions_table', 15),
	(17, '2018_05_06_110955_create_user_levels_table', 16),
	(18, '2018_05_06_115449_create_privilege_levels_table', 16),
	(19, '2018_05_06_120343_create_privilege_menus_table', 16),
	(20, '2018_05_06_120810_create_privilege_modules_table', 16),
	(21, '2018_05_07_062039_create_module_table', 16),
	(22, '2018_05_07_073353_create_menus_table', 16),
	(23, '2018_05_07_100639_create_user_settings_table', 16),
	(24, '2018_05_14_052659_alter_products_table_3', 17),
	(25, '2018_05_14_053227_alter_products_table_4', 18),
	(26, '2018_05_14_092034_rename_user_levels_id_to_user_levels', 19),
	(27, '2018_05_22_094815_create_posts_table', 19),
	(28, '2018_05_26_083641_create_abcs_table', 20),
	(29, '2018_05_26_083034_create_zones_table', 21),
	(30, '2018_05_26_084100_alter_zones_table_1', 22),
	(31, '2018_05_26_090458_alter_zones_table_1', 23),
	(32, '2018_05_28_032246_create_file_uploads_table', 24);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.modules
CREATE TABLE IF NOT EXISTS `modules` (
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

-- Dumping data for table larafremworktestdb.modules: ~1 rows (approximately)
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `name`, `modules_icon`, `description`, `home_url`, `created_by`, `updated_by`, `created_at`, `updated_at`, `is_active`) VALUES
	(1, 'Admin', 'fff', 'na', '/', 0, 0, NULL, NULL, 1);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.occupations
CREATE TABLE IF NOT EXISTS `occupations` (
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

-- Dumping data for table larafremworktestdb.occupations: ~0 rows (approximately)
/*!40000 ALTER TABLE `occupations` DISABLE KEYS */;
/*!40000 ALTER TABLE `occupations` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aso_id` int(11) NOT NULL DEFAULT '0',
  `asm_rsm_id` int(11) NOT NULL DEFAULT '0',
  `dbid` int(11) NOT NULL DEFAULT '0',
  `order_date` date DEFAULT NULL,
  `requester_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `requester_phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dh_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dh_phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tso_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tso_phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `total_outlet` int(11) DEFAULT NULL,
  `visited_outlet` int(11) NOT NULL DEFAULT '0',
  `order_type` enum('Primary','Secondary','Promotion','') COLLATE utf8_bin DEFAULT NULL,
  `total_no_of_memo` int(11) DEFAULT NULL,
  `order_total` int(11) NOT NULL,
  `order_da` decimal(10,2) DEFAULT '0.00',
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `rfu2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table larafremworktestdb.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `short_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `quantity` decimal(6,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_fk0` (`orders_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table larafremworktestdb.order_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larafremworktestdb.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.posts: ~2 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `name`, `description`, `is_active`) VALUES
	(1, '2018-05-24 04:31:51', '2018-05-24 04:31:51', 'dfs', 'sdf', 1),
	(2, '2018-05-26 02:17:02', '2018-05-26 02:17:19', 'Jakir', 'sdf', 1);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.privilege_levels
CREATE TABLE IF NOT EXISTS `privilege_levels` (
  `users_id` int(11) DEFAULT NULL,
  `user_levels_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `privilege_levels_user_id_user_level_id_unique` (`users_id`,`user_levels_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.privilege_levels: ~1 rows (approximately)
/*!40000 ALTER TABLE `privilege_levels` DISABLE KEYS */;
INSERT INTO `privilege_levels` (`users_id`, `user_levels_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL);
/*!40000 ALTER TABLE `privilege_levels` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.privilege_menus
CREATE TABLE IF NOT EXISTS `privilege_menus` (
  `menus_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_levels_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menus_id`),
  UNIQUE KEY `privilege_menus_menu_id_user_level_id_unique` (`menus_id`,`user_levels_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.privilege_menus: ~18 rows (approximately)
/*!40000 ALTER TABLE `privilege_menus` DISABLE KEYS */;
INSERT INTO `privilege_menus` (`menus_id`, `user_levels_id`, `users_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL, NULL),
	(2, 1, NULL, NULL, NULL),
	(3, 1, NULL, NULL, NULL),
	(4, 1, NULL, NULL, NULL),
	(5, 1, NULL, NULL, NULL),
	(6, 1, NULL, NULL, NULL),
	(7, 1, NULL, NULL, NULL),
	(8, 1, NULL, NULL, NULL),
	(9, 1, NULL, NULL, NULL),
	(10, 1, NULL, NULL, NULL),
	(11, 1, NULL, NULL, NULL),
	(12, 1, NULL, NULL, NULL),
	(13, 1, NULL, NULL, NULL),
	(14, 1, NULL, NULL, NULL),
	(15, 1, NULL, NULL, NULL),
	(16, 1, NULL, NULL, NULL),
	(17, 1, NULL, NULL, NULL),
	(18, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `privilege_menus` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.privilege_modules
CREATE TABLE IF NOT EXISTS `privilege_modules` (
  `users_id` int(11) NOT NULL DEFAULT '0',
  `modules_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_levels_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larafremworktestdb.privilege_modules: ~1 rows (approximately)
/*!40000 ALTER TABLE `privilege_modules` DISABLE KEYS */;
INSERT INTO `privilege_modules` (`users_id`, `modules_id`, `created_at`, `updated_at`, `user_levels_id`) VALUES
	(1, 1, NULL, NULL, 1);
/*!40000 ALTER TABLE `privilege_modules` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.products
CREATE TABLE IF NOT EXISTS `products` (
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table larafremworktestdb.products: ~9 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_name`, `key_word`, `brands_id`, `skues_id`, `price`, `quantity`, `description`, `pack_size`, `rfu1`, `rfu2`, `created_at`, `created_by`, `updated_by`, `updated_at`, `is_active`) VALUES
	(1, NULL, '1-1', 1, 1, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(2, NULL, '1-2', 1, 2, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(3, NULL, '2-1', 2, 1, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(4, NULL, '2-2', 2, 2, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(5, NULL, '3-1', 3, 1, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(6, NULL, '3-2', 3, 2, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(7, NULL, '3-7', 3, 7, 0.00, 0, NULL, '1 × 24', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(8, NULL, '3-8', 3, 8, 0.00, 0, NULL, '1 × 12', NULL, NULL, NULL, NULL, NULL, NULL, 1),
	(9, NULL, '3-9', 3, 9, 0.00, 0, NULL, '1 × 6', NULL, NULL, NULL, NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.product_brands
CREATE TABLE IF NOT EXISTS `product_brands` (
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

-- Dumping data for table larafremworktestdb.product_brands: ~5 rows (approximately)
/*!40000 ALTER TABLE `product_brands` DISABLE KEYS */;
INSERT INTO `product_brands` (`id`, `created_at`, `updated_at`, `name`, `description`, `created_by`, `updated_by`, `is_active`) VALUES
	(1, '2018-05-13 03:26:11', '2018-05-13 03:26:11', 'Sony Rangs', 'sdfsdfsdf', NULL, 1, 1),
	(2, '2018-05-13 04:01:40', '2018-05-13 04:10:09', 'Pran RFL', 'sdfsdfs', NULL, NULL, 1),
	(3, '2018-05-13 04:40:32', '2018-05-13 04:40:32', 'fsdfsdf', 'sdfsfsdf', NULL, 1, 1),
	(4, '2018-05-13 05:25:00', '2018-05-13 05:25:00', 'New Brand', 'NA', NULL, NULL, 1),
	(5, '2018-05-13 05:30:11', '2018-05-13 05:30:11', 'mukul', 'sdfsdfsdf', NULL, NULL, 1);
/*!40000 ALTER TABLE `product_brands` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.product_categories
CREATE TABLE IF NOT EXISTS `product_categories` (
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

-- Dumping data for table larafremworktestdb.product_categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` (`id`, `created_at`, `updated_at`, `name`, `product_brands_id`, `description`, `created_by`, `updated_by`, `is_active`) VALUES
	(1, '2018-05-13 04:59:14', '2018-05-13 05:01:04', 'Electronics', 1, 'dfdfdfdf', 2, 2, 1);
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.product_types
CREATE TABLE IF NOT EXISTS `product_types` (
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

-- Dumping data for table larafremworktestdb.product_types: ~1 rows (approximately)
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;
INSERT INTO `product_types` (`id`, `category_name`, `rfu1`, `rfu2`, `created_at`, `created_by`, `updated_by`, `updated_at`, `is_active`) VALUES
	(1, 'test', NULL, NULL, '2018-05-27 02:29:16', 1, NULL, '2018-05-27 02:29:16', 1);
/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.promotional_package
CREATE TABLE IF NOT EXISTS `promotional_package` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table larafremworktestdb.promotional_package: ~1 rows (approximately)
/*!40000 ALTER TABLE `promotional_package` DISABLE KEYS */;
INSERT INTO `promotional_package` (`id`, `package_name`, `package_start`, `package_end`, `package_details`, `package_free_item`, `created_by`, `created_at`, `updated_at`, `rfu1`, `rfu2`, `is_active`) VALUES
	(5, 'asss', '2018-05-01 00:00:00', '2018-06-07 00:00:00', '{"2":"1","12":"12","4":"1"}', '{"3":"1","2":"1"}', 1, '2018-06-05 16:24:33', '2018-06-05 16:24:33', NULL, NULL, 0);
/*!40000 ALTER TABLE `promotional_package` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.regions
CREATE TABLE IF NOT EXISTS `regions` (
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

-- Dumping data for table larafremworktestdb.regions: ~2 rows (approximately)
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` (`id`, `region_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `rfu1`, `rfu2`) VALUES
	(1, 'test updated', 1, '2018-05-26 10:26:18', 1, '2018-05-27 04:35:41', NULL, NULL),
	(2, 'test 1', 1, '2018-05-27 04:34:43', NULL, '2018-05-27 04:34:43', NULL, NULL);
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aso_id` int(11) NOT NULL,
  `asm_rsm_id` int(11) NOT NULL DEFAULT '0',
  `sale_date` date NOT NULL,
  `sender_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `sender_phone` varchar(255) COLLATE utf8_bin NOT NULL,
  `dh_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `dh_phone` varchar(50) COLLATE utf8_bin NOT NULL,
  `tso_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `tso_phone` varchar(50) COLLATE utf8_bin NOT NULL,
  `sale_type` enum('Primary','Secondary','Promotional','') COLLATE utf8_bin NOT NULL,
  `sale_total` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `rfu2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table larafremworktestdb.sales: ~0 rows (approximately)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.sale_details
CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `short_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `quantity` decimal(6,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `delivery_details_fk0` (`sales_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table larafremworktestdb.sale_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `sale_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_details` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.skues
CREATE TABLE IF NOT EXISTS `skues` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `brands_id` int(10) DEFAULT NULL,
  `sku_name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `description` text,
  `ordering` int(10) DEFAULT NULL,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu2` varchar(255) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table larafremworktestdb.skues: ~31 rows (approximately)
/*!40000 ALTER TABLE `skues` DISABLE KEYS */;
INSERT INTO `skues` (`id`, `brands_id`, `sku_name`, `short_name`, `description`, `ordering`, `rfu1`, `rfu2`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_active`) VALUES
	(1, 1, '250ml pet', NULL, NULL, 1, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:59:45', 1),
	(2, 1, '250ml can', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:59:44', 1),
	(3, 2, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:59:05', 1),
	(4, 2, '250ml can', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:59:03', 1),
	(5, 3, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(6, 3, '250ml can', NULL, NULL, 3, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 06:12:17', 1),
	(7, 3, '500ml', NULL, NULL, 4, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 06:00:07', 1),
	(8, 3, '1L', NULL, NULL, 1, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 06:12:17', 1),
	(9, 3, '2L', NULL, NULL, 2, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 06:12:17', 1),
	(10, 4, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(11, 4, '250ml can', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(12, 4, '500ml', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(13, 5, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(14, 5, '250ml can', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(15, 5, '500ml', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(16, 6, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(17, 6, '250ml can', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(18, 6, '500ml', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(19, 6, '1 L', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(20, 7, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(21, 8, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(22, 9, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(23, 10, '250ml', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(24, 10, '500ml', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:46', 1),
	(25, 10, '1 L', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1),
	(26, 11, '250ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1),
	(27, 11, '250ml Tetra', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1),
	(28, 12, '300ml pet', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1),
	(29, 12, '250ml can', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1),
	(30, 13, '500 ml', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1),
	(31, 13, '1.5 L', NULL, NULL, 0, NULL, NULL, NULL, '2018-06-04 05:22:51', NULL, '2018-06-04 05:25:47', 1);
/*!40000 ALTER TABLE `skues` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.sms_inboxes
CREATE TABLE IF NOT EXISTS `sms_inboxes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sms_inbox_name` varchar(100) DEFAULT NULL,
  `transactionId` varchar(30) DEFAULT NULL,
  `sender` varchar(15) NOT NULL,
  `sms_content` text NOT NULL,
  `sms_received` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `replied_datetime` datetime DEFAULT NULL,
  `sms_status` enum('Active','Inactive','Pending','Replied','Unread','Processed') DEFAULT 'Active',
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `U_sms_inbox` (`sender`,`sms_received`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table larafremworktestdb.sms_inboxes: ~2 rows (approximately)
/*!40000 ALTER TABLE `sms_inboxes` DISABLE KEYS */;
INSERT INTO `sms_inboxes` (`id`, `sms_inbox_name`, `transactionId`, `sender`, `sms_content`, `sms_received`, `created_by`, `created`, `replied_datetime`, `sms_status`, `updated`, `updated_by`, `is_active`) VALUES
	(1, NULL, NULL, '01719415744', 'Order/ASOID-0011/Dt-2018-02-17/Rt-Banani/OU-10/VO-8/Tp-000,001/Tc-001,01/BHp-000,0/BHc-000,1/Fp-000,1/Fc-000,1/F(h)-000,1/F(1)-000,1/F(2)-000,1/UCp-000,1/UCc-000,1/UC(h)-000,1/ULp-000,1/ULc-000,1/UL(h)-000,1/UOp-000,1/UOc-000,2/UO(h)-000,1/UO(1)-000,2/UZ-000,1/Ornj-000,1/Lmnj-000,1/M-000,1/M(h)-000,1/M(1)-000,1/MKp-000,1/MKt-000,1/MK(h)-000,1/LYp-000,1/Lyc-000,1/A(h)-000,1/A(1.5)-000,1/Total-0001', NULL, NULL, NULL, NULL, 'Processed', '2018-06-07 10:35:06', NULL, 1),
	(2, NULL, NULL, '01719415744', 'Sale/ASOID-0011/dt-2018-02-17/Tp-001/Tc-000/BHp-000/BHc-000/Fp-000/Fc-000/F(h)-003/F(1)-000/F(2)-000/UCp-000/UCc-012/UC(h)-000/ULp-000/ULc-000/UL(h)-000/UOp-000/UOc-000/UO(h)-000/UO(1)-000/UZ-000/Ornj-000/Lmnj-000/M-000/M(h)-000/M(1)-000/MKp-000/MKt-000/MK(h)-000/LYp-000/Lyc-000/A(h)-000/A(1.5)-000/Total-16', NULL, NULL, NULL, NULL, 'Processed', '2018-06-07 10:35:24', NULL, 1);
/*!40000 ALTER TABLE `sms_inboxes` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `distribution_house_id` int(10) NOT NULL,
  `sku_id` int(10) NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rfu1` varchar(255) DEFAULT NULL,
  `rfu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table larafremworktestdb.stocks: ~0 rows (approximately)
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.territories
CREATE TABLE IF NOT EXISTS `territories` (
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

-- Dumping data for table larafremworktestdb.territories: ~5 rows (approximately)
/*!40000 ALTER TABLE `territories` DISABLE KEYS */;
INSERT INTO `territories` (`id`, `territory_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `rfu1`, `rfu2`) VALUES
	(1, 'test', 1, '2018-05-27 04:26:44', NULL, '2018-05-27 04:26:44', NULL, NULL),
	(2, 'test2', 1, '2018-05-27 04:28:54', 1, '2018-05-27 04:30:02', NULL, NULL),
	(3, 'test3x', 1, '2018-05-27 04:29:43', 1, '2018-05-27 05:58:33', NULL, NULL),
	(4, 'test4', 1, '2018-05-27 06:19:34', NULL, '2018-05-27 06:19:34', NULL, NULL),
	(5, 'test6', 1, '2018-05-27 06:26:37', NULL, '2018-05-27 06:26:37', NULL, NULL);
/*!40000 ALTER TABLE `territories` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.unions
CREATE TABLE IF NOT EXISTS `unions` (
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

-- Dumping data for table larafremworktestdb.unions: ~2 rows (approximately)
/*!40000 ALTER TABLE `unions` DISABLE KEYS */;
INSERT INTO `unions` (`id`, `created_at`, `updated_at`, `name`, `countries_id`, `divisions_id`, `districts_id`, `upazilas_id`, `description`, `created_by`, `updated_by`, `is_active`) VALUES
	(1, '2018-05-13 06:14:05', '2018-05-13 06:14:05', 'Gazir Khamar', 1, 1, 1, 1, 'NA', 2, 1, 1),
	(2, '2018-05-13 06:18:07', '2018-05-13 06:18:07', 'Kalshi', 1, 1, 1, 1, 'NA', 2, 1, 1);
/*!40000 ALTER TABLE `unions` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.upazilas
CREATE TABLE IF NOT EXISTS `upazilas` (
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

-- Dumping data for table larafremworktestdb.upazilas: ~1 rows (approximately)
/*!40000 ALTER TABLE `upazilas` DISABLE KEYS */;
INSERT INTO `upazilas` (`id`, `created_at`, `updated_at`, `name`, `countries_id`, `divisions_id`, `districts_id`, `description`, `created_by`, `updated_by`, `is_active`) VALUES
	(1, '2018-05-13 06:12:24', '2018-05-13 06:12:24', 'Sherpur Sadar', 1, 1, 1, 'NA', 2, 1, 1);
/*!40000 ALTER TABLE `upazilas` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` enum('zone','region','territory','area') DEFAULT NULL,
  `zones_id` int(10) DEFAULT NULL,
  `regions_id` int(10) DEFAULT NULL,
  `territories_id` int(10) DEFAULT NULL,
  `distribution_house_id` int(11) DEFAULT NULL,
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
  `created_by` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT '0',
  `status` varchar(500) DEFAULT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table larafremworktestdb.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user_type`, `zones_id`, `regions_id`, `territories_id`, `distribution_house_id`, `name`, `email`, `password`, `password_key`, `password_expire_days`, `last_name`, `mobile`, `home_telephone`, `username`, `secret_question_1`, `secret_question_2`, `secret_question_ans_1`, `secret_question_ans_2`, `identification_type_id`, `identification_number`, `identification_expire_date`, `date_of_birth`, `gender`, `religion_id`, `father_name`, `father_occupation_id`, `mother_name`, `mother_occupation_id`, `bank_account_number`, `bank_id`, `bank_branch`, `last_login_date_time`, `default_module_id`, `created_by`, `updated_by`, `status`, `user_image`, `address`, `is_reliever`, `reliever_to`, `reliever_start_datetime`, `reliever_end_datetime`, `line_manager_id`, `designation_id`, `department_id`, `location_id`, `default_vehicle_id`, `default_url`, `default_language_id`, `joining_date`, `emergency_contact_person_name`, `emergency_contact_relation`, `emergency_contact_number`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, 'Apsis', 'apsis@gmail.com', '$2y$10$2nkgX.Wgvs4q3wCgICad/uz2g90yakp5Tb5y9UYGyYSslArBSJXvK', NULL, NULL, NULL, NULL, NULL, 'apsis', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, 'images/default/avatar.jpg', NULL, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, 'UkFIalitisZHtGJ4taJapkeOnncBf4QtXqNeGNhTy9E5yPdrE38dt4kXjOVX', NULL, NULL),
	(2, NULL, NULL, NULL, NULL, NULL, 'jakir', 'jakir@gmail.com', '$2y$10$2nkgX.Wgvs4q3wCgICad/uz2g90yakp5Tb5y9UYGyYSslArBSJXvK', '', NULL, '', '', '', 'jakir', '', '', '', '', 0, '', '2018-06-09', '2018-06-09', '', 0, '', 0, '', 0, '', 0, '', '2018-06-09 03:28:46', 0, 1, 0, '', 'images/default/avatar.jpg', '', 0, 0, '2018-06-09 03:28:59', '2018-06-09 03:29:04', 0, 0, 0, 0, 0, '', 0, '2018-06-09', '', '', '', 'UkFIalitisZHtGJ4taJapkeOnncBf4QtXqNeGNhTy9E5yPdrE38dt4kXjOVX', '2018-06-09 03:29:21', '2018-06-09 03:30:05'),
	(3, NULL, NULL, NULL, NULL, NULL, 'mukul', 'engr.mukul@hotmail.com', '$2y$10$/e3gXX5PyjwHsO1QMMkEpu/2TuLvMMTrd1L64vRFN5EnHtrfe3gFe', NULL, NULL, NULL, NULL, NULL, 'mukul123', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, 'images/default/avatar.jpg', NULL, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2018-06-08 21:32:45', '2018-06-08 21:32:45'),
	(4, NULL, NULL, NULL, NULL, NULL, 'meshop', 'superadministrator@app.com', '$2y$10$KAWeTUT8exC3C0x5b/YFLOkCi4Zj/Tv5JiK1RcdnqQlkioqQsZGHO', NULL, NULL, NULL, NULL, NULL, 'apsis@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, 0, 0, 0, NULL, 'images/default/avatar.jpg', NULL, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2018-06-08 21:36:09', '2018-06-08 21:36:09'),
	(5, NULL, NULL, NULL, NULL, NULL, 'mukul', 'engr.mukul000@hotmail.com', '$2y$10$cNJb6EY6rRXqra83V.0WXuVKACc2zN2xzVxq2bvsOz1jvENQ3nVN.', NULL, 0, 'sdfsdfsdfd', '23121212231', NULL, 'apsis2014', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2018-06-27', NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, 1, 0, 0, NULL, 'images/default/avatar.jpg', NULL, 0, 0, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, '0ETnGzA67d5DNEKP1kYegbpZ7iePKlFiXMbQzVtv83CKEHlI7P1eFUWBLIZT', '2018-06-08 21:50:54', '2018-06-08 21:50:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.user_levels
CREATE TABLE IF NOT EXISTS `user_levels` (
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

-- Dumping data for table larafremworktestdb.user_levels: ~1 rows (approximately)
/*!40000 ALTER TABLE `user_levels` DISABLE KEYS */;
INSERT INTO `user_levels` (`id`, `name`, `description`, `created_by`, `created`, `updated_by`, `updated`, `status`, `privilege_edit`, `privilege_delete`, `privilege_add`, `privilege_view_all`, `all_privilege`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'dd', 0, '2018-05-14 10:24:52', 0, '2018-05-14 10:25:03', 'Active', 0, 0, 0, 0, 0, NULL, NULL);
/*!40000 ALTER TABLE `user_levels` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.user_settings
CREATE TABLE IF NOT EXISTS `user_settings` (
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

-- Dumping data for table larafremworktestdb.user_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_settings` ENABLE KEYS */;

-- Dumping structure for table larafremworktestdb.zones
CREATE TABLE IF NOT EXISTS `zones` (
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

-- Dumping data for table larafremworktestdb.zones: ~12 rows (approximately)
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` (`id`, `zone_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `rfu1`, `rfu2`) VALUES
	(1, 'North Bengal - 02', NULL, NULL, NULL, '2018-05-26 04:31:11', NULL, NULL),
	(3, 'North Bengal - 01', NULL, NULL, NULL, '2018-05-26 04:30:49', NULL, NULL),
	(4, 'Jessore Zone', NULL, NULL, NULL, '2018-05-26 04:31:27', NULL, NULL),
	(7, 'Mymensingh Zone', 1, '2018-05-26 04:31:43', NULL, '2018-05-26 04:31:43', NULL, NULL),
	(8, 'Dhaka North Zone', 1, '2018-05-26 04:31:56', NULL, '2018-05-26 04:31:56', NULL, NULL),
	(9, 'Dhaka South Zone', 1, '2018-05-26 04:32:13', NULL, '2018-05-26 04:32:13', NULL, NULL),
	(10, 'Dhaka West Zone', 1, '2018-05-26 04:32:31', NULL, '2018-05-26 04:32:31', NULL, NULL),
	(11, 'Barishal Zone', 1, '2018-05-26 04:32:43', 1, '2018-05-26 22:38:06', NULL, NULL),
	(12, 'Sylhet Zone', 1, '2018-05-26 04:32:55', NULL, '2018-05-26 04:32:55', NULL, NULL),
	(13, 'Comilla Zone', 1, '2018-05-26 04:33:12', NULL, '2018-05-26 04:33:12', NULL, NULL),
	(14, 'Noakhali Zone', 1, '2018-05-26 04:33:35', NULL, '2018-05-26 04:33:35', NULL, NULL),
	(15, 'Chottrogram Zone', 1, '2018-05-26 04:33:48', NULL, '2018-05-26 04:33:48', NULL, NULL);
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
