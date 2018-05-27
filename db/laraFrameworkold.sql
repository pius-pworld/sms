/*
Navicat MySQL Data Transfer

Source Server         : 201
Source Server Version : 50636
Source Host           : localhost:3306
Source Database       : laraFramework

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2018-05-22 15:33:36
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES ('1', '2018-05-13 12:10:55', '2018-05-13 12:10:55', 'Sherpur', '1', 'NA', '2', '1', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Master', 'ww', 'Main', '0', '1', 'fa fa-list', '/', '0', '0', '0', null, null, '1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of privilege_menus
-- ----------------------------
INSERT INTO `privilege_menus` VALUES ('1', '1', null, null, null);

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
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_categories_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `product_brands_id` int(10) unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_product_categories_id_index` (`product_categories_id`),
  KEY `products_created_by_index` (`created_by`),
  KEY `products_updated_by_index` (`updated_by`),
  KEY `products_product_brands_id_index` (`product_brands_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '2018-05-13 11:58:49', '2018-05-13 11:58:49', 'TV', '1', 'NA', '2', '1', '1', '1', 'uploads/AqfQpe7RxNCaAsBCuzUUDEeDSQhJNJfz4Fl0LnxG.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Apsis', 'apsis@gmail.com', '$2y$10$2nkgX.Wgvs4q3wCgICad/uz2g90yakp5Tb5y9UYGyYSslArBSJXvK', null, null, null, null, null, 'apsis', null, null, null, null, '0', null, null, null, null, '0', null, '0', null, '0', null, '0', null, null, '0', '0', '0', null, 'images/default/avatar.jpg', null, '0', '0', null, null, '0', '0', '0', '0', '0', null, '0', null, null, null, null, 'Qg3YLr5DowSsKAmPyq4PeK2x8xDLkpw1S4I56DugvKK9qvKp5s0Pj0iIf4AA', null, null);
