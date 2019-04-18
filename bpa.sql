-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2019 at 05:59 AM
-- Server version: 8.0.12
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpa`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trial_period` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'trial',
  `subscription_start` int(11) DEFAULT NULL,
  `subscription_end` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `trial_period`, `created_at`, `updated_at`, `status`, `subscription_start`, `subscription_end`) VALUES
(1, 'Tanvir Hasan Piash', 14, '2018-10-16 11:55:51', '2018-10-16 11:55:51', 'trial', NULL, NULL),
(2, 'Tanvir', 14, '2019-01-09 10:32:20', '2019-01-09 10:32:20', 'trial', NULL, NULL),
(3, 'Jonathon Morris', 14, '2019-01-18 13:17:38', '2019-01-18 13:17:38', 'trial', NULL, NULL),
(4, 'Mahmudul Hasan', 14, '2019-01-21 03:49:41', '2019-01-21 03:49:41', 'trial', NULL, NULL),
(6, 'Tanvir Hasan Piash', 14, '2019-01-22 12:51:55', '2019-01-22 12:51:55', 'trial', NULL, NULL),
(7, 'Hillary Clinton', 14, '2019-01-22 13:58:49', '2019-01-22 13:58:49', 'trial', NULL, NULL),
(8, 'Thomas Martin', 14, '2019-01-22 14:01:58', '2019-01-22 14:01:58', 'trial', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `additional_costs`
--

DROP TABLE IF EXISTS `additional_costs`;
CREATE TABLE `additional_costs` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `unit_of_measure_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `make` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_acquired` int(11) DEFAULT NULL,
  `date_returned` int(11) DEFAULT NULL,
  `date_assigned` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `employee_id`, `name`, `serial`, `make`, `value`, `date_acquired`, `date_returned`, `date_assigned`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laptop', '3546FG78', 'Dell', '500', 1538352000, 1539820800, 1540857600, '2018-11-05 10:48:04', '2018-11-05 04:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `bill_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `po_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_date` int(11) DEFAULT NULL,
  `due_date` int(11) DEFAULT NULL,
  `po_date` int(11) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `discount_percentage` double DEFAULT '0',
  `grand_total` double DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `account_id`, `vendor_id`, `bill_no`, `po_no`, `bill_date`, `due_date`, `po_date`, `payment_date`, `shipping_charge`, `discount_percentage`, `grand_total`, `status`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '5555', '44', 1543276800, 1543708800, 1543276800, NULL, 70, 0, 2500.36, 2, 'bill-attachments/1/5555.pdf', '2018-11-27 07:23:37', '2018-12-01 15:17:07'),
(2, 1, 1, '1111', '2222', 1543363200, 1544140800, 1543363200, NULL, 10, 0, 3555, 1, '', '2018-11-27 13:51:55', '2019-01-08 02:09:12'),
(3, 1, 1, '666', '54', 1543363200, 1543449600, 1543363200, NULL, 0, 10, 945, 2, '', '2018-11-27 14:53:31', '2019-01-07 23:50:52'),
(4, 1, 3, '00004', '684648', 1548115200, 1548720000, 1548115200, NULL, 50, 0, 1100, 1, '', '2019-01-22 10:42:10', '2019-01-29 04:22:46'),
(5, 1, 1, '00005', NULL, 1548633600, 0, 0, NULL, 0, 0, NULL, 0, '', '2019-01-28 04:18:53', '2019-01-28 04:18:53'),
(6, 1, 1, '00006', NULL, 1548633600, 0, 0, NULL, 0, 0, NULL, 0, '', '2019-01-28 04:19:16', '2019-01-28 04:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

DROP TABLE IF EXISTS `bill_items`;
CREATE TABLE `bill_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `item_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `expense_type_id` int(11) DEFAULT NULL,
  `uom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`id`, `bill_id`, `item_type`, `item_id`, `expense_type_id`, `uom`, `qty`, `price`, `discount`, `tax`, `tax_id`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 'product', 1, 1, 'SQF', 1, 1050, 0, 0, 5, 1050, '2018-11-27 07:23:37', '2018-11-27 07:23:37'),
(2, 1, 'service', 1, 11, 'Per Day', 1, 1254.87, 0, 10, 6, 1380.36, '2018-11-27 07:23:37', '2018-11-27 07:23:37'),
(3, 2, 'product', 1, 1, 'SQF', 1, 1050, 0, 10, 6, 1155, '2018-11-27 13:51:55', '2018-11-27 13:51:55'),
(4, 2, 'product', 2, 2, 'SQM', 1, 800, 0, 15, 7, 920, '2018-11-27 13:51:55', '2018-11-27 13:51:55'),
(5, 2, 'product', 3, 10, 'SQM', 1, 500, 0, 10, 6, 550, '2018-11-27 13:51:55', '2018-11-27 13:51:55'),
(6, 2, 'product', 2, 10, 'SQM', 1, 800, 0, 15, 7, 920, '2018-11-27 13:51:55', '2018-11-27 13:51:55'),
(7, 3, 'product', 1, 1, 'SQF', 1, 1050, 0, 0, 5, 1050, '2018-11-27 14:53:31', '2018-11-27 21:09:58'),
(8, 4, 'product', 1, NULL, 'SQF', 1, 1050, 0, NULL, NULL, 1050, '2019-01-22 10:42:10', '2019-01-22 10:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(50) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `landline` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `invoice_prefix` varchar(20) DEFAULT NULL,
  `quotation_prefix` varchar(20) DEFAULT NULL,
  `employee_prefix` varchar(20) DEFAULT NULL,
  `po_prefix` varchar(20) DEFAULT NULL,
  `voucher_prefix` varchar(20) DEFAULT NULL,
  `date_format` varchar(15) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'USD',
  `template_version` varchar(20) DEFAULT '1',
  `template_color` varchar(10) NOT NULL DEFAULT 'e4e4e4',
  `text_color` varchar(10) NOT NULL DEFAULT 'FFFFFF',
  `invoice_email` text,
  `quotation_email` text,
  `po_email` text,
  `tc_invoice` text,
  `tc_quote` text,
  `tc_po` text,
  `tc_bill` text,
  `account_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `notifications` text,
  `disk_space` double DEFAULT NULL,
  `bill_color_1` varchar(50) DEFAULT NULL,
  `bill_color_2` varchar(50) DEFAULT NULL,
  `quote_color_1` varchar(50) DEFAULT NULL,
  `quote_color_2` varchar(50) DEFAULT NULL,
  `invoice_color_1` varchar(50) DEFAULT NULL,
  `invoice_color_2` varchar(50) DEFAULT NULL,
  `payslip_color_1` varchar(50) DEFAULT NULL,
  `payslip_color_2` varchar(50) DEFAULT NULL,
  `payslip_color_3` varchar(50) DEFAULT NULL,
  `tax_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `company_name`, `address_line_1`, `address_line_2`, `city`, `zip_code`, `country_id`, `mobile`, `landline`, `website`, `invoice_prefix`, `quotation_prefix`, `employee_prefix`, `po_prefix`, `voucher_prefix`, `date_format`, `currency`, `template_version`, `template_color`, `text_color`, `invoice_email`, `quotation_email`, `po_email`, `tc_invoice`, `tc_quote`, `tc_po`, `tc_bill`, `account_id`, `logo`, `notifications`, `disk_space`, `bill_color_1`, `bill_color_2`, `quote_color_1`, `quote_color_2`, `invoice_color_1`, `invoice_color_2`, `payslip_color_1`, `payslip_color_2`, `payslip_color_3`, `tax_no`, `created_at`, `updated_at`) VALUES
(1, 'Creativeitem', 'Cecilia Chapman, 711-2880 Nulla St, Mankato', 'Mississippi 96522', 'New York', NULL, 231, NULL, NULL, NULL, 'INV', 'QT', 'EM', NULL, 'Voucher-', 'd/m/Y', 'USD', '1', '08088A', 'FFFFFF', '<p>Hello [CUSTOMER_NAME].</p><p><br></p><p><br></p>[CUSTOMER_NAME][DUE_DATE]', '<p>Hello [CUSTOMER_NAME].</p><p><br></p>[DUE_DATE][SHIPPING_ADDRESS][CUSTOMER_NAME]', '<p>Hello [CUSTOMER_NAME].</p><p><br></p>[PR][DATE][REQUEST_TYPE]', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 'logos/1.png', '{\"vat_return_notification\":\"on\",\"vat_return_date\":1548633600,\"vat_return_date_timing\":[\"0\"],\"vat_return_date_receivers\":[\"admin@example.com\"],\"tax_clearance_expiry_notification\":\"on\",\"tax_clearance_expiry_date\":1548633600,\"tax_clearance_expiry_date_timing\":[\"0\"],\"tax_clearance_expiry_date_receivers\":[\"admin@example.com\"],\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', 2000000, '#b51a62', '#5a32b5', '#872836', '#42358f', '#e65973', '#6470e3', '#119c38', '#eb4d4d', '#827ce6', '6538365383637', '2018-10-30 21:08:16', '2019-01-31 16:59:52'),
(2, 'Creativeitem', 'Address line 1', 'Address line 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'd-m-Y', 'BDT', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 'logos/2.png', '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-09 10:32:20', '2019-01-23 12:02:32'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-18 13:17:38', '2019-01-23 12:02:27'),
(4, 'ActiveIT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'INV', 'QT', 'EM', NULL, NULL, 'd/m/Y', 'USD', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', 2000000, '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#119c38', '#eb4d4d', '#827ce6', NULL, '2019-01-21 03:49:41', '2019-01-21 03:49:41'),
(5, 'THP Technologies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'INV', 'QT', 'EM', NULL, NULL, 'd/m/Y', 'USD', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', 2000000, '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#119c38', '#eb4d4d', '#827ce6', NULL, '2019-01-22 12:49:31', '2019-01-22 12:49:31'),
(6, 'THP Technologies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'INV', 'QT', 'EM', NULL, NULL, 'd/m/Y', 'USD', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', 2000000, '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#119c38', '#eb4d4d', '#827ce6', NULL, '2019-01-22 12:51:55', '2019-01-22 12:51:55'),
(7, 'Digital Ocean', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'INV', 'QT', 'EM', NULL, NULL, 'd/m/Y', 'USD', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', 2000000, '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#119c38', '#eb4d4d', '#827ce6', NULL, '2019-01-22 13:58:49', '2019-01-22 13:58:49'),
(8, 'NameCheap', 'Cecilia Chapman, 711-2880 Nulla St, Mankato', 'Mississippi 96522', 'New York', NULL, 231, NULL, NULL, NULL, 'INV', 'QT', 'EM', NULL, NULL, 'd/m/Y', 'USD', '1', 'e4e4e4', 'FFFFFF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, '{\"vat_return_notification\":null,\"vat_return_date\":false,\"vat_return_date_timing\":null,\"vat_return_date_receivers\":null,\"tax_clearance_expiry_notification\":null,\"tax_clearance_expiry_date\":false,\"tax_clearance_expiry_date_timing\":null,\"tax_clearance_expiry_date_receivers\":null,\"paye_due_date_notification\":null,\"paye_due_date\":false,\"paye_due_date_timing\":null,\"paye_due_date_receivers\":null,\"income_tax_notification\":null,\"income_tax_date\":false,\"income_tax_date_timing\":null,\"income_tax_date_receivers\":null,\"board_meeting_reminder\":null,\"board_meeting_date\":false,\"board_meeting_date_timing\":null,\"board_meeting_date_receivers\":null,\"annual_returns_reminder\":null,\"annual_returns_date\":false,\"annual_returns_date_timing\":null,\"annual_returns_date_receivers\":null,\"payroll_processing_date_notification\":null,\"payroll_processing_date\":false,\"payroll_processing_date_timing\":null,\"payroll_processing_date_receivers\":null,\"debt_repayment_reminder\":null,\"debt_repayment_date\":false,\"debt_repayment_date_timing\":null,\"debt_repayment_date_receivers\":null}', 2000000, '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#fa526c', '#6b55eb', '#119c38', '#eb4d4d', '#827ce6', NULL, '2019-01-22 14:01:58', '2019-01-28 13:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `credit_notes`
--

DROP TABLE IF EXISTS `credit_notes`;
CREATE TABLE `credit_notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `items` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `grand_total` double DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `id` int(5) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT '',
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `dial_code` varchar(5) NOT NULL,
  `currency` varchar(20) NOT NULL DEFAULT '',
  `symbol` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `code` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `country_code`, `dial_code`, `currency`, `symbol`, `code`) VALUES
(1, 'Afghanistan', 'AF', '+93', 'Afghan afghani', '?', 'AFN'),
(2, 'Aland Islands', 'AX', '+358', '', '', ''),
(3, 'Albania', 'AL', '+355', 'Albanian lek', 'L', 'ALL'),
(4, 'Algeria', 'DZ', '+213', 'Algerian dinar', '?.?', 'DZD'),
(5, 'AmericanSamoa', 'AS', '+1684', '', '', ''),
(6, 'Andorra', 'AD', '+376', 'Euro', '?', 'EUR'),
(7, 'Angola', 'AO', '+244', 'Angolan kwanza', 'Kz', 'AOA'),
(8, 'Anguilla', 'AI', '+1264', 'East Caribbean dolla', '$', 'XCD'),
(9, 'Antarctica', 'AQ', '+672', '', '', ''),
(10, 'Antigua and Barbuda', 'AG', '+1268', 'East Caribbean dolla', '$', 'XCD'),
(11, 'Argentina', 'AR', '+54', 'Argentine peso', '$', 'ARS'),
(12, 'Armenia', 'AM', '+374', 'Armenian dram', '', 'AMD'),
(13, 'Aruba', 'AW', '+297', 'Aruban florin', '?', 'AWG'),
(14, 'Australia', 'AU', '+61', 'Australian dollar', '$', 'AUD'),
(15, 'Austria', 'AT', '+43', 'Euro', '?', 'EUR'),
(16, 'Azerbaijan', 'AZ', '+994', 'Azerbaijani manat', '', 'AZN'),
(17, 'Bahamas', 'BS', '+1242', '', '', ''),
(18, 'Bahrain', 'BH', '+973', 'Bahraini dinar', '.?.?', 'BHD'),
(19, 'Bangladesh', 'BD', '+880', 'Bangladeshi taka', '?', 'BDT'),
(20, 'Barbados', 'BB', '+1246', 'Barbadian dollar', '$', 'BBD'),
(21, 'Belarus', 'BY', '+375', 'Belarusian ruble', 'Br', 'BYR'),
(22, 'Belgium', 'BE', '+32', 'Euro', '?', 'EUR'),
(23, 'Belize', 'BZ', '+501', 'Belize dollar', '$', 'BZD'),
(24, 'Benin', 'BJ', '+229', 'West African CFA fra', 'Fr', 'XOF'),
(25, 'Bermuda', 'BM', '+1441', 'Bermudian dollar', '$', 'BMD'),
(26, 'Bhutan', 'BT', '+975', 'Bhutanese ngultrum', 'Nu.', 'BTN'),
(27, 'Bolivia, Plurination', 'BO', '+591', '', '', ''),
(28, 'Bosnia and Herzegovi', 'BA', '+387', '', '', ''),
(29, 'Botswana', 'BW', '+267', 'Botswana pula', 'P', 'BWP'),
(30, 'Brazil', 'BR', '+55', 'Brazilian real', 'R$', 'BRL'),
(31, 'British Indian Ocean', 'IO', '+246', '', '', ''),
(32, 'Brunei Darussalam', 'BN', '+673', '', '', ''),
(33, 'Bulgaria', 'BG', '+359', 'Bulgarian lev', '??', 'BGN'),
(34, 'Burkina Faso', 'BF', '+226', 'West African CFA fra', 'Fr', 'XOF'),
(35, 'Burundi', 'BI', '+257', 'Burundian franc', 'Fr', 'BIF'),
(36, 'Cambodia', 'KH', '+855', 'Cambodian riel', '?', 'KHR'),
(37, 'Cameroon', 'CM', '+237', 'Central African CFA ', 'Fr', 'XAF'),
(38, 'Canada', 'CA', '+1', 'Canadian dollar', '$', 'CAD'),
(39, 'Cape Verde', 'CV', '+238', 'Cape Verdean escudo', 'Esc or $', 'CVE'),
(40, 'Cayman Islands', 'KY', '+ 345', 'Cayman Islands dolla', '$', 'KYD'),
(41, 'Central African Repu', 'CF', '+236', '', '', ''),
(42, 'Chad', 'TD', '+235', 'Central African CFA ', 'Fr', 'XAF'),
(43, 'Chile', 'CL', '+56', 'Chilean peso', '$', 'CLP'),
(44, 'China', 'CN', '+86', 'Chinese yuan', '¥ or ?', 'CNY'),
(45, 'Christmas Island', 'CX', '+61', '', '', ''),
(46, 'Cocos (Keeling) Isla', 'CC', '+61', '', '', ''),
(47, 'Colombia', 'CO', '+57', 'Colombian peso', '$', 'COP'),
(48, 'Comoros', 'KM', '+269', 'Comorian franc', 'Fr', 'KMF'),
(49, 'Congo', 'CG', '+242', '', '', ''),
(50, 'Congo, The Democrati', 'CD', '+243', '', '', ''),
(51, 'Cook Islands', 'CK', '+682', 'New Zealand dollar', '$', 'NZD'),
(52, 'Costa Rica', 'CR', '+506', 'Costa Rican colón', '?', 'CRC'),
(53, 'Cote d\'Ivoire', 'CI', '+225', 'West African CFA fra', 'Fr', 'XOF'),
(54, 'Croatia', 'HR', '+385', 'Croatian kuna', 'kn', 'HRK'),
(55, 'Cuba', 'CU', '+53', 'Cuban convertible pe', '$', 'CUC'),
(56, 'Cyprus', 'CY', '+357', 'Euro', '?', 'EUR'),
(57, 'Czech Republic', 'CZ', '+420', 'Czech koruna', 'K?', 'CZK'),
(58, 'Denmark', 'DK', '+45', 'Danish krone', 'kr', 'DKK'),
(59, 'Djibouti', 'DJ', '+253', 'Djiboutian franc', 'Fr', 'DJF'),
(60, 'Dominica', 'DM', '+1767', 'East Caribbean dolla', '$', 'XCD'),
(61, 'Dominican Republic', 'DO', '+1849', 'Dominican peso', '$', 'DOP'),
(62, 'Ecuador', 'EC', '+593', 'United States dollar', '$', 'USD'),
(63, 'Egypt', 'EG', '+20', 'Egyptian pound', '£ or ?.?', 'EGP'),
(64, 'El Salvador', 'SV', '+503', 'United States dollar', '$', 'USD'),
(65, 'Equatorial Guinea', 'GQ', '+240', 'Central African CFA ', 'Fr', 'XAF'),
(66, 'Eritrea', 'ER', '+291', 'Eritrean nakfa', 'Nfk', 'ERN'),
(67, 'Estonia', 'EE', '+372', 'Euro', '?', 'EUR'),
(68, 'Ethiopia', 'ET', '+251', 'Ethiopian birr', 'Br', 'ETB'),
(69, 'Falkland Islands', 'FK', '+500', '', '', ''),
(70, 'Faroe Islands', 'FO', '+298', 'Danish krone', 'kr', 'DKK'),
(71, 'Fiji', 'FJ', '+679', 'Fijian dollar', '$', 'FJD'),
(72, 'Finland', 'FI', '+358', 'Euro', '?', 'EUR'),
(73, 'France', 'FR', '+33', 'Euro', '?', 'EUR'),
(74, 'French Guiana', 'GF', '+594', '', '', ''),
(75, 'French Polynesia', 'PF', '+689', 'CFP franc', 'Fr', 'XPF'),
(76, 'Gabon', 'GA', '+241', 'Central African CFA ', 'Fr', 'XAF'),
(77, 'Gambia', 'GM', '+220', '', '', ''),
(78, 'Georgia', 'GE', '+995', 'Georgian lari', '?', 'GEL'),
(79, 'Germany', 'DE', '+49', 'Euro', '?', 'EUR'),
(80, 'Ghana', 'GH', '+233', 'Ghana cedi', '?', 'GHS'),
(81, 'Gibraltar', 'GI', '+350', 'Gibraltar pound', '£', 'GIP'),
(82, 'Greece', 'GR', '+30', 'Euro', '?', 'EUR'),
(83, 'Greenland', 'GL', '+299', '', '', ''),
(84, 'Grenada', 'GD', '+1473', 'East Caribbean dolla', '$', 'XCD'),
(85, 'Guadeloupe', 'GP', '+590', '', '', ''),
(86, 'Guam', 'GU', '+1671', '', '', ''),
(87, 'Guatemala', 'GT', '+502', 'Guatemalan quetzal', 'Q', 'GTQ'),
(88, 'Guernsey', 'GG', '+44', 'British pound', '£', 'GBP'),
(89, 'Guinea', 'GN', '+224', 'Guinean franc', 'Fr', 'GNF'),
(90, 'Guinea-Bissau', 'GW', '+245', 'West African CFA fra', 'Fr', 'XOF'),
(91, 'Guyana', 'GY', '+595', 'Guyanese dollar', '$', 'GYD'),
(92, 'Haiti', 'HT', '+509', 'Haitian gourde', 'G', 'HTG'),
(93, 'Holy See (Vatican City)', 'VA', '+379', '', '', ''),
(94, 'Honduras', 'HN', '+504', 'Honduran lempira', 'L', 'HNL'),
(95, 'Hong Kong', 'HK', '+852', 'Hong Kong dollar', '$', 'HKD'),
(96, 'Hungary', 'HU', '+36', 'Hungarian forint', 'Ft', 'HUF'),
(97, 'Iceland', 'IS', '+354', 'Icelandic króna', 'kr', 'ISK'),
(98, 'India', 'IN', '+91', 'Indian rupee', '?', 'INR'),
(99, 'Indonesia', 'ID', '+62', 'Indonesian rupiah', 'Rp', 'IDR'),
(100, 'Iran, Islamic Republ', 'IR', '+98', '', '', ''),
(101, 'Iraq', 'IQ', '+964', 'Iraqi dinar', '?.?', 'IQD'),
(102, 'Ireland', 'IE', '+353', 'Euro', '?', 'EUR'),
(103, 'Isle of Man', 'IM', '+44', 'British pound', '£', 'GBP'),
(104, 'Israel', 'IL', '+972', 'Israeli new shekel', '?', 'ILS'),
(105, 'Italy', 'IT', '+39', 'Euro', '?', 'EUR'),
(106, 'Jamaica', 'JM', '+1876', 'Jamaican dollar', '$', 'JMD'),
(107, 'Japan', 'JP', '+81', 'Japanese yen', '¥', 'JPY'),
(108, 'Jersey', 'JE', '+44', 'British pound', '£', 'GBP'),
(109, 'Jordan', 'JO', '+962', 'Jordanian dinar', '?.?', 'JOD'),
(110, 'Kazakhstan', 'KZ', '+7 7', 'Kazakhstani tenge', '', 'KZT'),
(111, 'Kenya', 'KE', '+254', 'Kenyan shilling', 'Sh', 'KES'),
(112, 'Kiribati', 'KI', '+686', 'Australian dollar', '$', 'AUD'),
(113, 'Korea, Democratic Pe', 'KP', '+850', '', '', ''),
(114, 'Korea, Republic of S', 'KR', '+82', '', '', ''),
(115, 'Kuwait', 'KW', '+965', 'Kuwaiti dinar', '?.?', 'KWD'),
(116, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstani som', '??', 'KGS'),
(117, 'Laos', 'LA', '+856', 'Lao kip', '?', 'LAK'),
(118, 'Latvia', 'LV', '+371', 'Euro', '?', 'EUR'),
(119, 'Lebanon', 'LB', '+961', 'Lebanese pound', '?.?', 'LBP'),
(120, 'Lesotho', 'LS', '+266', 'Lesotho loti', 'L', 'LSL'),
(121, 'Liberia', 'LR', '+231', 'Liberian dollar', '$', 'LRD'),
(122, 'Libyan Arab Jamahiri', 'LY', '+218', '', '', ''),
(123, 'Liechtenstein', 'LI', '+423', 'Swiss franc', 'Fr', 'CHF'),
(124, 'Lithuania', 'LT', '+370', 'Euro', '?', 'EUR'),
(125, 'Luxembourg', 'LU', '+352', 'Euro', '?', 'EUR'),
(126, 'Macao', 'MO', '+853', '', '', ''),
(127, 'Macedonia', 'MK', '+389', '', '', ''),
(128, 'Madagascar', 'MG', '+261', 'Malagasy ariary', 'Ar', 'MGA'),
(129, 'Malawi', 'MW', '+265', 'Malawian kwacha', 'MK', 'MWK'),
(130, 'Malaysia', 'MY', '+60', 'Malaysian ringgit', 'RM', 'MYR'),
(131, 'Maldives', 'MV', '+960', 'Maldivian rufiyaa', '.?', 'MVR'),
(132, 'Mali', 'ML', '+223', 'West African CFA fra', 'Fr', 'XOF'),
(133, 'Malta', 'MT', '+356', 'Euro', '?', 'EUR'),
(134, 'Marshall Islands', 'MH', '+692', 'United States dollar', '$', 'USD'),
(135, 'Martinique', 'MQ', '+596', '', '', ''),
(136, 'Mauritania', 'MR', '+222', 'Mauritanian ouguiya', 'UM', 'MRO'),
(137, 'Mauritius', 'MU', '+230', 'Mauritian rupee', '?', 'MUR'),
(138, 'Mayotte', 'YT', '+262', '', '', ''),
(139, 'Mexico', 'MX', '+52', 'Mexican peso', '$', 'MXN'),
(140, 'Micronesia, Federate', 'FM', '+691', '', '', ''),
(141, 'Moldova', 'MD', '+373', 'Moldovan leu', 'L', 'MDL'),
(142, 'Monaco', 'MC', '+377', 'Euro', '?', 'EUR'),
(143, 'Mongolia', 'MN', '+976', 'Mongolian tögrög', '?', 'MNT'),
(144, 'Montenegro', 'ME', '+382', 'Euro', '?', 'EUR'),
(145, 'Montserrat', 'MS', '+1664', 'East Caribbean dolla', '$', 'XCD'),
(146, 'Morocco', 'MA', '+212', 'Moroccan dirham', '?.?.', 'MAD'),
(147, 'Mozambique', 'MZ', '+258', 'Mozambican metical', 'MT', 'MZN'),
(148, 'Myanmar', 'MM', '+95', 'Burmese kyat', 'Ks', 'MMK'),
(149, 'Namibia', 'NA', '+264', 'Namibian dollar', '$', 'NAD'),
(150, 'Nauru', 'NR', '+674', 'Australian dollar', '$', 'AUD'),
(151, 'Nepal', 'NP', '+977', 'Nepalese rupee', '?', 'NPR'),
(152, 'Netherlands', 'NL', '+31', 'Euro', '?', 'EUR'),
(153, 'Netherlands Antilles', 'AN', '+599', '', '', ''),
(154, 'New Caledonia', 'NC', '+687', 'CFP franc', 'Fr', 'XPF'),
(155, 'New Zealand', 'NZ', '+64', 'New Zealand dollar', '$', 'NZD'),
(156, 'Nicaragua', 'NI', '+505', 'Nicaraguan córdoba', 'C$', 'NIO'),
(157, 'Niger', 'NE', '+227', 'West African CFA fra', 'Fr', 'XOF'),
(158, 'Nigeria', 'NG', '+234', 'Nigerian naira', '?', 'NGN'),
(159, 'Niue', 'NU', '+683', 'New Zealand dollar', '$', 'NZD'),
(160, 'Norfolk Island', 'NF', '+672', '', '', ''),
(161, 'Northern Mariana Isl', 'MP', '+1670', '', '', ''),
(162, 'Norway', 'NO', '+47', 'Norwegian krone', 'kr', 'NOK'),
(163, 'Oman', 'OM', '+968', 'Omani rial', '?.?.', 'OMR'),
(164, 'Pakistan', 'PK', '+92', 'Pakistani rupee', '?', 'PKR'),
(165, 'Palau', 'PW', '+680', 'Palauan dollar', '$', ''),
(166, 'Palestinian Territor', 'PS', '+970', '', '', ''),
(167, 'Panama', 'PA', '+507', 'Panamanian balboa', 'B/.', 'PAB'),
(168, 'Papua New Guinea', 'PG', '+675', 'Papua New Guinean ki', 'K', 'PGK'),
(169, 'Paraguay', 'PY', '+595', 'Paraguayan guaraní', '?', 'PYG'),
(170, 'Peru', 'PE', '+51', 'Peruvian nuevo sol', 'S/.', 'PEN'),
(171, 'Philippines', 'PH', '+63', 'Philippine peso', '?', 'PHP'),
(172, 'Pitcairn', 'PN', '+872', '', '', ''),
(173, 'Poland', 'PL', '+48', 'Polish z?oty', 'z?', 'PLN'),
(174, 'Portugal', 'PT', '+351', 'Euro', '?', 'EUR'),
(175, 'Puerto Rico', 'PR', '+1939', '', '', ''),
(176, 'Qatar', 'QA', '+974', 'Qatari riyal', '?.?', 'QAR'),
(177, 'Romania', 'RO', '+40', 'Romanian leu', 'lei', 'RON'),
(178, 'Russia', 'RU', '+7', 'Russian ruble', '', 'RUB'),
(179, 'Rwanda', 'RW', '+250', 'Rwandan franc', 'Fr', 'RWF'),
(180, 'Reunion', 'RE', '+262', '', '', ''),
(181, 'Saint Barthelemy', 'BL', '+590', '', '', ''),
(182, 'Saint Helena, Ascens', 'SH', '+290', '', '', ''),
(183, 'Saint Kitts and Nevi', 'KN', '+1869', '', '', ''),
(184, 'Saint Lucia', 'LC', '+1758', 'East Caribbean dolla', '$', 'XCD'),
(185, 'Saint Martin', 'MF', '+590', '', '', ''),
(186, 'Saint Pierre and Miq', 'PM', '+508', '', '', ''),
(187, 'Saint Vincent and th', 'VC', '+1784', '', '', ''),
(188, 'Samoa', 'WS', '+685', 'Samoan t?l?', 'T', 'WST'),
(189, 'San Marino', 'SM', '+378', 'Euro', '?', 'EUR'),
(190, 'Sao Tome and Princip', 'ST', '+239', '', '', ''),
(191, 'Saudi Arabia', 'SA', '+966', 'Saudi riyal', '?.?', 'SAR'),
(192, 'Senegal', 'SN', '+221', 'West African CFA fra', 'Fr', 'XOF'),
(193, 'Serbia', 'RS', '+381', 'Serbian dinar', '???. or din.', 'RSD'),
(194, 'Seychelles', 'SC', '+248', 'Seychellois rupee', '?', 'SCR'),
(195, 'Sierra Leone', 'SL', '+232', 'Sierra Leonean leone', 'Le', 'SLL'),
(196, 'Singapore', 'SG', '+65', 'Brunei dollar', '$', 'BND'),
(197, 'Slovakia', 'SK', '+421', 'Euro', '?', 'EUR'),
(198, 'Slovenia', 'SI', '+386', 'Euro', '?', 'EUR'),
(199, 'Solomon Islands', 'SB', '+677', 'Solomon Islands doll', '$', 'SBD'),
(200, 'Somalia', 'SO', '+252', 'Somali shilling', 'Sh', 'SOS'),
(201, 'South Africa', 'ZA', '+27', 'South African rand', 'R', 'ZAR'),
(202, 'South Georgia and th', 'GS', '+500', '', '', ''),
(203, 'Spain', 'ES', '+34', 'Euro', '?', 'EUR'),
(204, 'Sri Lanka', 'LK', '+94', 'Sri Lankan rupee', 'Rs or ??', 'LKR'),
(205, 'Sudan', 'SD', '+249', 'Sudanese pound', '?.?.', 'SDG'),
(206, 'Suriname', 'SR', '+597', 'Surinamese dollar', '$', 'SRD'),
(207, 'Svalbard and Jan May', 'SJ', '+47', '', '', ''),
(208, 'Swaziland', 'SZ', '+268', 'Swazi lilangeni', 'L', 'SZL'),
(209, 'Sweden', 'SE', '+46', 'Swedish krona', 'kr', 'SEK'),
(210, 'Switzerland', 'CH', '+41', 'Swiss franc', 'Fr', 'CHF'),
(211, 'Syrian Arab Republic', 'SY', '+963', '', '', ''),
(212, 'Taiwan', 'TW', '+886', 'New Taiwan dollar', '$', 'TWD'),
(213, 'Tajikistan', 'TJ', '+992', 'Tajikistani somoni', '??', 'TJS'),
(214, 'Tanzania, United Rep', 'TZ', '+255', '', '', ''),
(215, 'Thailand', 'TH', '+66', 'Thai baht', '?', 'THB'),
(216, 'Timor-Leste', 'TL', '+670', '', '', ''),
(217, 'Togo', 'TG', '+228', 'West African CFA fra', 'Fr', 'XOF'),
(218, 'Tokelau', 'TK', '+690', '', '', ''),
(219, 'Tonga', 'TO', '+676', 'Tongan pa?anga', 'T$', 'TOP'),
(220, 'Trinidad and Tobago', 'TT', '+1868', 'Trinidad and Tobago ', '$', 'TTD'),
(221, 'Tunisia', 'TN', '+216', 'Tunisian dinar', '?.?', 'TND'),
(222, 'Turkey', 'TR', '+90', 'Turkish lira', '', 'TRY'),
(223, 'Turkmenistan', 'TM', '+993', 'Turkmenistan manat', 'm', 'TMT'),
(224, 'Turks and Caicos Isl', 'TC', '+1649', '', '', ''),
(225, 'Tuvalu', 'TV', '+688', 'Australian dollar', '$', 'AUD'),
(226, 'Uganda', 'UG', '+256', 'Ugandan shilling', 'Sh', 'UGX'),
(227, 'Ukraine', 'UA', '+380', 'Ukrainian hryvnia', '?', 'UAH'),
(228, 'United Arab Emirates', 'AE', '+971', 'United Arab Emirates', '?.?', 'AED'),
(229, 'United Kingdom', 'GB', '+44', 'British pound', '£', 'GBP'),
(230, 'United States', 'US', '+1', 'United States dollar', '$', 'USD'),
(231, 'Uruguay', 'UY', '+598', 'Uruguayan peso', '$', 'UYU'),
(232, 'Uzbekistan', 'UZ', '+998', 'Uzbekistani som', '', 'UZS'),
(233, 'Vanuatu', 'VU', '+678', 'Vanuatu vatu', 'Vt', 'VUV'),
(234, 'Venezuela, Bolivaria', 'VE', '+58', '', '', ''),
(235, 'Vietnam', 'VN', '+84', 'Vietnamese ??ng', '?', 'VND'),
(236, 'Virgin Islands, Brit', 'VG', '+1284', '', '', ''),
(237, 'Virgin Islands, U.S.', 'VI', '+1340', '', '', ''),
(238, 'Wallis and Futuna', 'WF', '+681', 'CFP franc', 'Fr', 'XPF'),
(239, 'Yemen', 'YE', '+967', 'Yemeni rial', '?', 'YER'),
(240, 'Zambia', 'ZM', '+260', 'Zambian kwacha', 'ZK', 'ZMW'),
(241, 'Zimbabwe', 'ZW', '+263', 'Zimbabwean Dollar', 'Z$', 'ZWD');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '?'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '???'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', '??'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '?'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '?'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '?'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'K?'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', '¢'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', 'Rp'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '?'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '?'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '??'),
(64, 'Korea (North)', 'Won', 'KPW', '?'),
(65, 'Korea (South)', 'Won', 'KRW', '?'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', '??'),
(67, 'Laos', 'Kips', 'LAK', '?'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', '???'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '?'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '?'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '?'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '?'),
(88, 'North Korea', 'Won', 'KPW', '?'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '?'),
(91, 'Pakistan', 'Rupees', 'PKR', '?'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'z?'),
(97, 'Qatar', 'Rials', 'QAR', '?'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '???'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '?'),
(102, 'Serbia', 'Dinars', 'RSD', '???.'),
(103, 'Seychelles', 'Rupees', 'SCR', '?'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '?'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '?'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '?'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '£'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '?'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', '??'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '?'),
(130, 'Yemen', 'Rials', 'YER', '?'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$'),
(132, 'Zambia', 'Zambian Kwacha', 'ZMW', 'K');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_category_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_no`, `customer_type`, `customer_category_id`, `company_name`, `primary_contact`, `customer_name`, `surname`, `email`, `website`, `telephone`, `id_number`, `fax`, `address_line_1`, `address_line_2`, `country_id`, `city`, `zip_code`, `vat_no`, `user_id`, `account_id`, `facebook`, `twitter`, `linkedin`, `skype`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CM001', 'company', 3, 'Google Inc', 'Sundar Pichai', NULL, NULL, 'pichai@gmail.com', NULL, '437363727', NULL, '63827623827', 'Some address line 1', 'Some address line 2', 231, 'New York', '33456', '54763753736367', '2', '1', 'https://facebook.com/profile', 'https://twitter.com/profile', 'https://linkedin.com/profile', NULL, 'customer-photos/1/1.png', 1, '2018-10-16 11:56:51', '2019-01-31 09:39:21'),
(2, NULL, 'individual', NULL, NULL, NULL, 'Sandra Bullok', 'Sandram', 'sandra@gmail.com', NULL, '12312', NULL, '12121', 'Some address line one', 'Some address line 2', 231, 'New York', '5245', NULL, '17', '1', 'facebook.com', 'twitter.com', 'linkedin.com', 'skype.com', 'customer-photos/1/2.png', 1, '2019-01-06 06:04:45', '2019-01-28 03:59:32'),
(3, NULL, 'company', NULL, 'hello one', 'hello one conatct', NULL, NULL, 'helloone@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 231, 'NY', NULL, NULL, '27', '1', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-22 14:41:07', '2019-01-22 14:41:07'),
(4, NULL, 'company', NULL, 'hello one 1', 'hello one conatct 1', NULL, NULL, 'helloone1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 231, 'NY', NULL, NULL, '28', '1', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-22 14:46:13', '2019-01-22 14:46:13'),
(8, NULL, 'individual', NULL, NULL, NULL, 'Hello Customer', 'hellosurname', 'hellocustomer@example.com', NULL, NULL, NULL, NULL, NULL, NULL, 231, 'New York', NULL, NULL, '34', '1', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-28 07:27:50', '2019-01-28 07:27:50'),
(9, NULL, 'individual', NULL, NULL, NULL, 'Hello Customer two', 'hellosurnametwo', 'hellocustomertwo@example.com', NULL, NULL, NULL, NULL, NULL, NULL, 231, 'New York', NULL, NULL, '35', '1', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-28 07:27:50', '2019-01-28 07:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `customer_categories`
--

DROP TABLE IF EXISTS `customer_categories`;
CREATE TABLE `customer_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_categories`
--

INSERT INTO `customer_categories` (`id`, `account_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small Business', '2019-01-31 14:31:38', '2019-01-31 14:31:38'),
(2, 1, 'Medium Business', '2019-01-31 14:31:47', '2019-01-31 14:31:47'),
(3, 1, 'Large Business', '2019-01-31 14:31:59', '2019-01-31 14:31:59'),
(4, 1, 'Industry', '2019-01-31 09:17:05', '2019-01-31 09:17:05'),
(5, 1, 'Restaurant', '2019-01-31 09:27:00', '2019-01-31 09:27:00'),
(6, 1, '213', '2019-02-07 00:39:05', '2019-02-07 00:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `damaged_products`
--

DROP TABLE IF EXISTS `damaged_products`;
CREATE TABLE `damaged_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `damaged_products`
--

INSERT INTO `damaged_products` (`id`, `account_id`, `product_id`, `quantity`, `date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1546128000, 'Some notes about the reason', '2018-12-29 12:19:53', '2018-12-29 12:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(3, 'Support', 1, '2018-11-02 20:56:08', '2018-11-02 14:56:08'),
(4, 'Human Resource', 1, '2018-09-23 07:40:30', '2018-07-30 03:33:32'),
(5, 'Valuation', 1, '2018-09-23 07:40:36', '2018-08-10 03:28:18'),
(6, 'Electrical', 1, '2018-09-23 07:40:47', '2018-08-10 03:28:35'),
(7, 'Mechanical', 1, '2018-09-23 07:40:52', '2018-08-10 03:28:47'),
(8, 'Engineering', 1, '2018-09-23 07:40:54', '2018-08-10 03:29:05'),
(10, 'Health', 1, '2018-09-23 07:40:56', '2018-08-10 16:46:26'),
(11, 'Quality Control', 1, '2018-10-25 09:29:20', '2018-10-25 09:29:20'),
(16, 'Research', 1, '2018-10-25 10:10:14', '2018-10-25 10:10:14'),
(17, 'test123', 1, '2019-01-28 07:56:18', '2019-01-28 07:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` double DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `account_id`, `folder_id`, `user_id`, `name`, `extension`, `size`, `notes`, `path`, `created_at`, `updated_at`) VALUES
(2, 1, 10, 1, 'Certificate.pdf', 'pdf', 239766, 'Some Notes', 'documents/1/Certificates/Certificate.pdf', '2019-01-06 07:59:08', '2019-01-16 06:50:01'),
(3, 1, 10, 1, 'Certificate 2.pdf', 'pdf', 479597, 'Some Notes about the file', 'documents/1/Certificates/Certificate 2.pdf', '2019-01-06 08:08:44', '2019-01-16 06:50:01'),
(4, 1, 10, 1, 'TestDocument.pdf', 'pdf', 72347, 'Some notes', 'documents/1/Certificates/TestDocument.pdf', '2019-01-07 06:06:36', '2019-01-16 06:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

DROP TABLE IF EXISTS `educations`;
CREATE TABLE `educations` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `institution` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `degree` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `major` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `gpa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `employee_id`, `institution`, `degree`, `major`, `start`, `end`, `gpa`, `created_at`, `updated_at`) VALUES
(1, 1, 'California State University, USA', 'Bachelor in Science', 'Computer Science and Engineering', 1406073600, 1497916800, '3.65 (First Class)', '2018-10-30 17:06:42', '2018-11-05 06:46:12'),
(2, 4, 'Porro similique quia', 'Numquam sint et con', 'Et qui laborum deser', 1552435200, 1553126400, 'Illo eum non volupta', '2019-03-13 00:43:09', '2019-03-13 00:43:09'),
(3, 5, 'Labore ut excepturi', 'Id vero ut earum ist', 'Aut molestias sit do', 1551398400, 1552608000, '3.50', '2019-03-14 01:47:41', '2019-03-14 01:47:41'),
(4, 5, 'Magna rerum dolorum', 'Velit pariatur Est', 'Excepturi quia alias', 1552521600, 1553126400, 'Accusamus sint aut r', '2019-03-14 01:48:08', '2019-03-14 01:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `template` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT '',
  `bday` int(20) DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `nid` varchar(20) DEFAULT NULL,
  `passport` varchar(20) DEFAULT NULL,
  `ethnicity` varchar(10) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `tax_no` varchar(255) DEFAULT NULL,
  `joined_date` int(20) DEFAULT NULL,
  `probation_date` int(20) DEFAULT NULL,
  `position` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `effective_date` int(20) DEFAULT NULL,
  `exit_date` int(11) DEFAULT NULL,
  `line_manager` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `branch` varchar(20) DEFAULT NULL,
  `job_type_id` int(11) DEFAULT NULL,
  `job_status_id` int(11) DEFAULT NULL,
  `pay_status_id` int(11) DEFAULT NULL,
  `pay_in_figures` int(11) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `salary_effective_date` int(20) DEFAULT NULL,
  `benefits` text,
  `deductions` text,
  `bank` varchar(50) DEFAULT NULL,
  `bank_account` varchar(30) DEFAULT NULL,
  `payment` varchar(20) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  `facebook` varchar(30) DEFAULT NULL,
  `linkedin` varchar(30) DEFAULT NULL,
  `twitter` varchar(20) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `personal_phone` varchar(15) DEFAULT NULL,
  `office_phone` varchar(15) DEFAULT NULL,
  `house_phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `emergency_name` varchar(255) DEFAULT NULL,
  `emergency_email` varchar(255) DEFAULT NULL,
  `emergency_phone` varchar(255) DEFAULT NULL,
  `emergency_address` varchar(255) DEFAULT NULL,
  `leave_allocation` text,
  `status` int(11) DEFAULT '1',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `employee_no`, `name`, `surname`, `gender`, `bday`, `nationality`, `nid`, `passport`, `ethnicity`, `religion`, `marital_status`, `tax_no`, `joined_date`, `probation_date`, `position`, `effective_date`, `exit_date`, `line_manager`, `department_id`, `branch`, `job_type_id`, `job_status_id`, `pay_status_id`, `pay_in_figures`, `salary`, `salary_effective_date`, `benefits`, `deductions`, `bank`, `bank_account`, `payment`, `method`, `facebook`, `linkedin`, `twitter`, `skype`, `personal_phone`, `office_phone`, `house_phone`, `address`, `account_id`, `emergency_name`, `emergency_email`, `emergency_phone`, `emergency_address`, `leave_allocation`, `status`, `photo`, `created_at`, `updated_at`) VALUES
(1, 6, '00001', 'Leonard Homes', 'Homes', 'male', 0, 'German', '53736353', 'HF76587', 'German', 'Islam', 'single', '5474647', 614390400, 1539129600, 'Managing Director', 1540339200, 1540944000, 'Jerrad Home', 4, 'Demo Branch', 1, 1, 3, 25000, NULL, NULL, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"12\"]', '[\"6\",\"7\",\"8\",\"9\",\"10\",\"11\"]', NULL, NULL, NULL, NULL, 'facebook', 'linkedin', 'twitter', 'skypeid', '3547672', '12121221', '2323223', NULL, 1, 'John Doe', 'john@example.com', '437353', 'Lakeshore LA, United States', '[{\"id\":\"1\",\"name\":\"Casual Leave\",\"days\":\"10\"},{\"id\":\"2\",\"name\":\"Sick Leave\",\"days\":\"15\"},{\"id\":\"3\",\"name\":\"Annual Leave\",\"days\":\"25\"},{\"id\":\"4\",\"name\":\"Compassionate Leave\",\"days\":\"15\"}]', 1, 'employee-photos/1/1.png', '2018-12-25 16:19:23', '2019-03-14 06:19:50'),
(3, 15, '00002', 'James Peterson', 'James', 'male', 1242604800, 'German', '42826527272527', '63524247262526', 'German', 'Christian', 'single', '8272552835627', 1544400000, 1546560000, 'System Engineer', 1544400000, 0, NULL, 8, 'Some branch', 2, 1, 1, 10000, NULL, NULL, '[\"1\",\"2\"]', '[\"7\",\"8\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6258262536', '928645835', '92963637', NULL, 1, 'Madam Peterson', 'mad@example.com', '8463738327', 'Some emergency address', NULL, 1, 'employee-photos/1/3.png', '2018-12-25 16:19:25', '2019-01-23 01:46:05'),
(4, 33, '00003', 'Jerrad Home', 'Jerrard', 'male', 0, NULL, NULL, NULL, NULL, NULL, 'married', NULL, 1552435200, 1553212800, 'Line Worker', 1552435200, 1552435200, 'James Peterson', 6, 'Uttara', 1, 1, 4, 852, NULL, NULL, '[\"1\",\"2\"]', '[\"9\",\"10\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45276874', NULL, NULL, NULL, 1, 'Some name', NULL, '4567890', NULL, NULL, 0, NULL, '2019-01-27 05:01:00', '2019-03-13 05:27:47'),
(5, 36, '00004', 'MC Maje', 'Maje', 'male', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 0, NULL, 4, NULL, 1, 1, NULL, 20000, NULL, NULL, 'null', '[\"6\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4523424', NULL, NULL, NULL, 1, 'Some name', NULL, '9875789', NULL, NULL, 1, NULL, '2019-01-28 07:32:50', '2019-01-31 07:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `employee_documents`
--

DROP TABLE IF EXISTS `employee_documents`;
CREATE TABLE `employee_documents` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee_documents`
--

INSERT INTO `employee_documents` (`id`, `employee_id`, `file`, `type`, `size`, `path`, `label`, `created_at`, `updated_at`) VALUES
(1, 1, '1-1541088219.BUPAdmitCard_36_5_1318192536.pdf', 'pdf', '130147', 'employee-documents/1/1-1541088219.BUPAdmitCard_36_5_1318192536.pdf', 'Provisional Certificate', '2018-11-01 10:03:39', '2018-11-05 06:02:49'),
(2, 1, '1-1541088264.BUPAdmitCard_36_4_1218193152.pdf', 'pdf', '130153', 'employee-documents/1/1-1541088264.BUPAdmitCard_36_4_1218193152.pdf', 'Curriculum', '2018-11-01 10:04:24', '2018-12-24 07:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `employment_histories`
--

DROP TABLE IF EXISTS `employment_histories`;
CREATE TABLE `employment_histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `employer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `present` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employment_histories`
--

INSERT INTO `employment_histories` (`id`, `employee_id`, `title`, `employer`, `start`, `end`, `present`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Some demo title', 'Some demo employer', 1540684800, 1541116800, 1, 'Some description', '2018-11-03 04:37:04', '2018-11-05 04:42:05'),
(2, 3, 'Test Mass Invoice', 'Test', 1552780800, 1552867200, 1, 'asd', '2019-03-17 01:31:41', '2019-03-17 01:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `expense_type_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `paid_through` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_amount` double DEFAULT '0',
  `tip` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `account_id`, `expense_type_id`, `date`, `amount`, `paid_through`, `tax_amount`, `tip`, `total`, `vendor_id`, `customer_id`, `reference`, `notes`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 1543104000, 200, 'petty_cash', 0, 10, 210, NULL, NULL, '5434', 'Some notes', NULL, '2018-11-25 06:19:20', '2018-12-12 18:34:23'),
(2, 1, 1, 1543276800, 200, 'cheque', 0, 0, 200, NULL, NULL, '3213', 'Some notes', NULL, '2018-11-25 06:23:13', '2018-12-12 18:34:27'),
(3, 1, 2, 1543190400, 34, 'card', 0, 0, 34, NULL, NULL, '4555', 'Some notes', NULL, '2018-11-25 06:28:17', '2018-12-12 18:34:30'),
(5, 1, 5, 1543363200, 23, 'petty_cash', 10, 10, 43, NULL, NULL, '44', 'Some notes', NULL, '2018-11-25 06:45:31', '2018-12-12 18:34:35'),
(6, 1, 5, 1542672000, 222, 'petty_cash', 0, 0, 222, NULL, NULL, '4545', 'Some notes', NULL, '2018-11-25 06:46:16', '2018-12-12 18:34:38'),
(8, 1, 1, 1542844800, 65, 'petty_cash', 0, 0, 65, NULL, NULL, '88', 'Some notes', NULL, '2018-11-25 07:05:54', '2018-12-12 18:34:45'),
(9, 1, 5, 1544659200, 2000.5, 'cheque', 50, 0, 2050.5, NULL, NULL, '546457', NULL, NULL, '2018-12-12 12:42:51', '2018-12-12 12:42:51'),
(10, 1, 1, 1545782400, 100, 'petty_cash', 20, 10, 130, NULL, NULL, '253635', 'Some notes', 'expense-receipts/1/253635.pdf', '2018-12-26 11:13:35', '2018-12-26 17:20:36'),
(11, 1, 3, 1548115200, 4456, 'cheque', 0, 0, 4456, NULL, NULL, '23567890', NULL, 'expense-receipts/1/23567890.pdf', '2019-01-21 16:09:31', '2019-01-21 16:09:31'),
(12, 1, 5, 1548288000, 1000, 'cheque', 20, 10, 1030, NULL, NULL, '282628', NULL, NULL, '2019-01-22 10:45:57', '2019-01-22 10:45:57'),
(13, 1, 11, 1549411200, 1250, 'cheque', 0, 200, 1450, NULL, NULL, '293638', NULL, NULL, '2019-01-22 10:47:43', '2019-01-22 10:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

DROP TABLE IF EXISTS `expense_types`;
CREATE TABLE `expense_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Accounting Fees', 1, '2018-11-19 05:45:59', '2018-11-19 05:45:59'),
(2, 'Bank Charges', 1, '2018-11-19 05:46:10', '2018-11-19 05:46:10'),
(3, 'Depreciation', 1, '2018-11-19 05:46:22', '2018-11-19 05:46:22'),
(4, 'Insurance - Cars', 1, '2018-11-19 05:46:33', '2018-11-19 05:46:33'),
(5, 'Insurance Assets', 1, '2018-11-19 05:46:43', '2018-11-19 05:46:43'),
(6, 'Fuel', 1, '2018-11-19 05:47:28', '2018-11-19 05:47:28'),
(7, 'Travel', 1, '2018-11-19 05:47:37', '2018-11-19 05:47:37'),
(8, 'Accomodation', 1, '2018-11-19 05:47:46', '2018-11-19 05:47:46'),
(9, 'Telephone', 1, '2018-11-19 05:47:56', '2018-11-19 05:47:56'),
(10, 'Internet', 1, '2018-11-19 05:48:05', '2018-11-19 05:48:07'),
(11, 'Repairs & Maintenance', 1, '2018-11-19 05:48:13', '2018-11-19 05:48:31'),
(12, 'Adverts & Promotion', 1, '2018-11-19 05:48:42', '2018-11-19 05:48:42'),
(13, 'Consulting Fee', 1, '2018-11-19 05:48:53', '2018-11-19 05:48:53'),
(14, 'Office Supplies', 1, '2018-11-19 05:49:04', '2018-11-19 05:49:04'),
(15, 'Postage', 1, '2018-11-19 05:49:16', '2018-11-19 05:49:16'),
(16, 'Printing & Stationery', 1, '2018-11-19 05:49:28', '2018-11-19 05:49:28'),
(17, 'Rent', 1, '2018-11-19 05:49:43', '2018-11-19 05:49:43'),
(18, 'Salaries & Wages', 1, '2018-11-19 05:49:54', '2018-11-19 05:49:54'),
(19, 'test', 1, '2019-02-14 05:04:21', '2019-02-14 05:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `file_sizes`
--

DROP TABLE IF EXISTS `file_sizes`;
CREATE TABLE `file_sizes` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `size` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `account_id`, `name`, `color`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 1, 'Important', 'danger', 1, '2018-12-30 13:22:11', '2019-01-14 08:25:40'),
(10, 1, 'Certificates', 'success', 1, '2019-01-05 01:00:20', '2019-01-16 06:50:01'),
(11, 1, 'CVs', 'primary', 1, '2019-01-05 02:48:09', '2019-01-14 08:25:52'),
(12, 1, 'Receipts', 'warning', 1, '2019-01-14 02:27:14', '2019-01-14 02:27:14'),
(14, 1, 'Bills', 'info', 1, '2019-01-15 11:46:13', '2019-01-16 06:49:43'),
(15, 1, 'Notes', 'metal', 1, '2019-01-16 06:50:38', '2019-01-16 06:50:38'),
(16, 1, 'Tax Tokens', 'success', 1, '2019-01-16 06:51:21', '2019-03-17 06:04:45'),
(17, 1, 'Invoices', 'danger', 1, '2019-01-29 04:39:59', '2019-01-29 04:39:59'),
(18, 1, 'English', 'warning', 1, '2019-02-11 02:14:02', '2019-02-11 02:14:02'),
(19, 1, 'TesterS', NULL, 1, '2019-03-19 02:58:50', '2019-03-19 02:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quote_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `po_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` int(11) DEFAULT NULL,
  `due_date` int(11) DEFAULT NULL,
  `items` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `shipping_charge` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `recurring` int(11) DEFAULT '0',
  `tax_invoice` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `account_id`, `customer_id`, `quote_id`, `employee_id`, `invoice_no`, `po_no`, `issue_date`, `due_date`, `items`, `shipping_charge`, `grand_total`, `status`, `notes`, `recurring`, `tax_invoice`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, '00001', '70', 1546128000, 1546732800, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1050\",\"discount\":\"0\",\"tax\":\"10\",\"tax_id\":\"6\",\"total\":\"1155.00\"},{\"id\":\"2\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQM\",\"qty\":\"1\",\"price\":\"800\",\"discount\":\"0\",\"tax\":\"15\",\"tax_id\":\"7\",\"total\":\"920.00\"},{\"id\":\"3\",\"type\":\"service\",\"description\":\"Some description about the transport service\",\"uom\":\"Per Hour\",\"qty\":\"1\",\"price\":\"50\",\"discount\":\"0\",\"tax\":\"10\",\"tax_id\":\"6\",\"total\":\"55.00\"}]', 50, 2180, 'paid', 'Some notes', 0, 'yes', '2019-01-08 00:19:03', '2019-01-11 10:34:36'),
(2, 1, 1, 4, NULL, '00004', '6257357', 1546905600, 1547510400, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1050\",\"discount\":\"10\",\"tax\":\"10\",\"tax_id\":\"6\",\"total\":\"1050.00\"}]', 10, 1060, 'partially_paid', 'Some notes', 0, NULL, '2019-01-08 01:54:16', '2019-01-28 13:13:23'),
(3, 1, 2, NULL, 3, '936337', '8272827', 1547337600, 1548028800, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1150\",\"discount\":\"0\",\"tax\":null,\"tax_id\":null,\"total\":\"1150.00\"},{\"id\":\"2\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQM\",\"qty\":\"1\",\"price\":\"900\",\"discount\":\"0\",\"tax\":null,\"tax_id\":null,\"total\":\"900.00\"}]', 20, 2070, 'unpaid', 'Some notes', 0, NULL, '2019-01-13 03:48:37', '2019-01-13 03:48:37'),
(4, 1, 1, NULL, NULL, '00004', '32323', 1547769600, 1548115200, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1150\",\"discount\":\"0\",\"tax\":null,\"tax_id\":null,\"total\":\"1150.00\"}]', 0, 1150, 'partially_paid', NULL, 0, NULL, '2019-01-18 07:55:35', '2019-01-23 02:43:29'),
(5, 1, 1, NULL, NULL, '00005', '4545454', 1548374400, 1548806400, '[{\"id\":\"3\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQM\",\"qty\":\"1\",\"price\":\"550\",\"discount\":\"0\",\"tax\":null,\"tax_id\":null,\"total\":\"550.00\"}]', 0, 550, 'paid', NULL, 0, NULL, '2019-01-25 01:14:03', '2019-01-28 07:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `job_statuses`
--

DROP TABLE IF EXISTS `job_statuses`;
CREATE TABLE `job_statuses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_statuses`
--

INSERT INTO `job_statuses` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Active', 1, '2018-10-25 16:03:04', '2018-10-25 16:03:04'),
(2, 'Inactive', 1, '2018-10-25 16:03:10', '2018-10-25 16:03:10'),
(3, 'Parental Leave', 1, '2018-10-25 10:06:37', '2018-10-25 10:06:37'),
(4, 'Maternal Leave', 1, '2018-10-25 10:09:47', '2018-10-25 10:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

DROP TABLE IF EXISTS `job_types`;
CREATE TABLE `job_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', 1, '2018-10-25 15:49:20', '2018-10-25 15:49:17'),
(2, 'Temporary', 1, '2018-10-25 15:49:28', '2018-10-25 15:49:28'),
(3, 'Contractual', 1, '2018-10-25 15:49:35', '2018-10-25 15:49:35'),
(4, 'Probation', 1, '2018-10-25 09:57:54', '2018-10-25 09:57:54'),
(5, 'Internship', 1, '2018-10-25 10:10:03', '2018-10-25 10:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
CREATE TABLE `leaves` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `account_id`, `leave_type_id`, `employee_id`, `start`, `end`, `days`, `reason`, `status`, `attachment`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 1, 1549238400, 1549411200, 3, 'Some reason', 0, NULL, '2019-01-23 01:30:49', '2019-01-23 01:30:49'),
(5, 1, 1, 3, 1549324800, 1549497600, 3, 'sss', 0, NULL, '2019-01-23 01:31:36', '2019-01-23 01:31:36'),
(6, 1, 2, 1, 1549497600, 1549584000, 2, 'ddd', 0, NULL, '2019-01-23 01:35:07', '2019-01-23 01:35:07'),
(7, 1, 1, 1, 1549324800, 1549411200, 2, 'aaa', 0, NULL, '2019-01-23 01:39:01', '2019-01-23 01:39:01'),
(8, 1, 1, 1, 1548288000, 1548374400, 2, 'Some reason', 0, NULL, '2019-01-23 05:07:27', '2019-01-23 05:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE `leave_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Casual Leave', 1, '2018-11-25 05:46:01', '2018-11-25 05:46:40'),
(2, 'Sick Leave', 1, '2018-11-25 05:46:33', '2018-11-25 05:46:33'),
(3, 'Annual Leave', 1, '2018-12-26 06:13:34', '2018-12-26 06:13:34'),
(4, 'Compassionate Leave', 1, '2018-12-26 06:13:53', '2018-12-26 06:13:53'),
(5, 'Study Leave', 1, '2018-12-26 06:14:07', '2018-12-26 06:14:07'),
(6, 'New Leave Type', 1, '2019-01-29 04:34:19', '2019-01-29 04:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_28_094625_create_services_table', 2),
(6, '2018_04_03_113508_add_role_to_users', 3),
(7, '2018_04_03_115915_create_accounts_table', 4),
(8, '2018_04_04_082544_add_rate_charge_account_to_services', 5),
(9, '2018_04_10_211818_create_products_table', 6),
(10, '2018_04_15_065035_create_vendors_table', 7),
(11, '2018_04_22_054644_create_customers_table', 8),
(12, '2018_04_26_193906_create_quotations_table', 9),
(13, '2018_05_21_070121_create_settings_table', 10),
(16, '2018_05_22_070853_create_invoices_table', 11),
(17, '2018_06_06_093426_add_invoice_type_to_invoices', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `employee_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'This is a simple note title', 'Ma5termind is crazy about Action Games. He just bought a new one and got down to play it. Ma5termind usually finishes all the levels of a game very fast. But, This time however he got stuck at the very first level of this new game. Can you help him play this game.\r\nTo finish the game, Ma5termind has to cross  levels. At each level of the game, Ma5termind has to face  enemies. Each enemy has its associated power  and some number of bullets . To knock down an enemy, Ma5termind needs to shoot him with one or multiple bullets whose collective count is equal to the power of the enemy. If Ma5termind manages to knock down any one enemy at a level, the rest of them run away and the level is cleared.', '2018-10-30 21:51:40', '2018-10-30 15:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@example.com', '$2y$10$qhN.NL95ZTEu8lnqYz0u6usN3FfMyVoQB9Ssuxr/sZ8lt7hUZwMuq', '2019-01-27 11:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `payment_method_id` int(11) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `bill_id`, `invoice_id`, `account_id`, `amount`, `date`, `reference`, `notes`, `payment_method_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 200, 1543276800, '55784357634', 'Some notes', 2, 'bill', '2018-11-27 06:43:34', '2019-01-08 05:44:51'),
(2, 1, NULL, 1, 2300.36, 1543708800, '859585859', NULL, 2, 'bill', '2018-12-01 15:17:07', '2019-01-08 05:44:55'),
(3, 3, NULL, 1, 945, 1546905600, '454', 'Some notes', 1, 'bill', '2019-01-07 23:50:52', '2019-01-07 23:50:52'),
(4, 2, NULL, 1, 1000, 1546905600, '753437', 'Some notes', 1, 'bill', '2019-01-08 02:09:12', '2019-01-08 02:09:12'),
(6, NULL, 1, 1, 1180, 1546905600, '3456353', NULL, 1, 'invoice', '2019-01-08 04:36:51', '2019-01-08 04:36:51'),
(7, NULL, 1, 1, 500, 1546992000, '74547467', 'Some notes', 2, 'invoice', '2019-01-09 05:57:59', '2019-01-09 05:57:59'),
(8, NULL, 1, 1, 500, 1547164800, '75857478', NULL, 3, 'invoice', '2019-01-11 10:34:36', '2019-01-11 10:34:36'),
(9, NULL, 4, 1, 500, 1548201600, '345456', NULL, 1, 'invoice', '2019-01-23 02:43:29', '2019-01-23 02:43:29'),
(10, NULL, 4, 1, 100, 1548201600, '738373', NULL, 2, 'invoice', '2019-01-23 02:50:05', '2019-01-23 02:50:05'),
(11, NULL, 4, 1, 10, 1548201600, '1212121', NULL, 1, 'invoice', '2019-01-23 02:51:39', '2019-01-23 02:51:39'),
(12, NULL, 4, 1, 10, 1548201600, '38736537', NULL, 2, 'invoice', '2019-01-23 02:53:32', '2019-01-23 02:53:32'),
(13, NULL, 4, 1, 10, 1548201600, '876543', 'some notes', 1, 'invoice', '2019-01-23 02:56:12', '2019-01-23 02:56:12'),
(14, NULL, 4, 1, 10, 1548201600, '333333333', NULL, 3, 'invoice', '2019-01-23 02:57:05', '2019-01-23 02:57:05'),
(15, NULL, 4, 1, 10, 1548201600, '456787656', NULL, 1, 'invoice', '2019-01-23 02:58:03', '2019-01-23 02:58:03'),
(16, NULL, 4, 1, 10, 1548201600, '748474837', NULL, 1, 'invoice', '2019-01-23 03:01:00', '2019-01-23 03:01:00'),
(17, NULL, 4, 1, 20, 1548201600, '898989765', NULL, 2, 'invoice', '2019-01-23 03:01:49', '2019-01-23 03:01:49'),
(18, NULL, 4, 1, 100, 1548201600, '7595759', NULL, 1, 'invoice', '2019-01-23 03:07:13', '2019-01-23 03:07:13'),
(19, NULL, 5, 1, 550, 1548633600, '343232123', NULL, 2, 'invoice', '2019-01-28 07:54:23', '2019-01-28 07:54:23'),
(20, NULL, 2, 1, 20, 1548720000, '6765678', NULL, 1, 'invoice', '2019-01-28 13:13:23', '2019-01-28 13:13:23'),
(21, NULL, 2, 1, 10, 1548720000, '789867', NULL, 2, 'invoice', '2019-01-28 13:16:52', '2019-01-28 13:16:52'),
(22, NULL, 4, 1, 120, 1548720000, '95383638', 'Some notes', 1, 'invoice', '2019-01-29 04:07:28', '2019-01-29 04:07:28'),
(23, 4, NULL, 1, 200, 1548720000, '4363427', NULL, 1, 'bill', '2019-01-29 04:22:46', '2019-01-29 04:22:46'),
(24, NULL, 4, 1, 35, 1548720000, '9658688', NULL, 2, 'invoice', '2019-01-29 06:31:38', '2019-01-29 06:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `account_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cash', '2018-11-10 05:45:37', '2018-11-10 05:45:37'),
(2, 1, 'Credit Card', '2018-11-27 06:43:24', '2018-11-27 06:43:24'),
(3, 1, 'Cheque', '2019-01-08 02:29:23', '2019-01-08 02:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

DROP TABLE IF EXISTS `payrolls`;
CREATE TABLE `payrolls` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `month` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `benefits` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `deductions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `net_salary` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `code`, `account_id`, `employee_id`, `department_id`, `month`, `year`, `salary`, `benefits`, `deductions`, `net_salary`, `status`, `created_at`, `updated_at`) VALUES
(1, 'qrc5kddp', 1, 1, 4, '12', 2018, 25000, '[{\"id\":\"1\",\"name\":\"House Rent Allowance\",\"amount\":\"100\"},{\"id\":\"2\",\"name\":\"Medical Allowance\",\"amount\":\"500\"},{\"id\":\"3\",\"name\":\"Travel Allowance\",\"amount\":\"20\"},{\"id\":\"4\",\"name\":\"Over Time Earnings\",\"amount\":\"0\"},{\"id\":\"5\",\"name\":\"Performance Bonus\",\"amount\":\"30\"},{\"id\":\"12\",\"name\":\"Other Earnings\",\"amount\":\"200\"}]', '[{\"id\":\"6\",\"name\":\"P.P.F Contribution\",\"amount\":\"50\"},{\"id\":\"7\",\"name\":\"E.S.I.C Contribution\",\"amount\":\"60\"},{\"id\":\"8\",\"name\":\"Profession Tax\",\"amount\":\"60\"},{\"id\":\"9\",\"name\":\"Income Tax\",\"amount\":\"75\"},{\"id\":\"10\",\"name\":\"Loan Instalment\",\"amount\":\"80\"},{\"id\":\"11\",\"name\":\"Advance\",\"amount\":\"0\"}]', 25525, 0, '2018-12-04 12:38:48', '2018-12-06 17:41:14'),
(2, 'ejhsav24', 1, 3, 8, '01', 2019, 10000, '[{\"id\":\"1\",\"name\":\"House Rent Allowance\",\"amount\":\"100\"},{\"id\":\"2\",\"name\":\"Medical Allowance\",\"amount\":\"100\"}]', '[{\"id\":\"7\",\"name\":\"E.S.I.C Contribution\",\"amount\":\"10\"},{\"id\":\"8\",\"name\":\"Profession Tax\",\"amount\":\"20\"}]', 10170, 0, '2019-01-21 08:13:14', '2019-01-21 08:13:14'),
(3, '7k06a2vx', 1, 3, 8, '01', 2019, 10000, '[{\"id\":\"1\",\"name\":\"House Rent Allowance\",\"amount\":\"50\"},{\"id\":\"2\",\"name\":\"Medical Allowance\",\"amount\":\"50\"}]', '[{\"id\":\"7\",\"name\":\"E.S.I.C Contribution\",\"amount\":\"10\"},{\"id\":\"8\",\"name\":\"Profession Tax\",\"amount\":\"10\"}]', 10080, 0, '2019-01-23 02:05:29', '2019-01-23 02:05:29'),
(6, '5jlplfea', 1, 5, 4, '01', 2019, 20000, NULL, '[{\"id\":\"6\",\"name\":\"P.P.F Contribution\",\"amount\":\"260\"}]', 19740, 0, '2019-01-31 07:30:19', '2019-01-31 07:32:43'),
(7, '8bntvaw8', 1, 3, 8, '03', 2019, 10000, '[{\"id\":\"1\",\"name\":\"House Rent Allowance\",\"amount\":\"123\"},{\"id\":\"2\",\"name\":\"Medical Allowance\",\"amount\":\"213\"}]', '[{\"id\":\"7\",\"name\":\"E.S.I.C Contribution\",\"amount\":\"123\"},{\"id\":\"8\",\"name\":\"Profession Tax\",\"amount\":\"123\"}]', 10090, 0, '2019-03-17 01:46:17', '2019-03-17 01:46:17'),
(8, '1w007c23', 1, 4, 6, '03', 2019, 852, '[{\"id\":\"1\",\"name\":\"House Rent Allowance\",\"amount\":\"123\"},{\"id\":\"2\",\"name\":\"Medical Allowance\",\"amount\":\"0\"}]', '[{\"id\":\"9\",\"name\":\"Income Tax\",\"amount\":\"123\"},{\"id\":\"10\",\"name\":\"Loan Instalment\",\"amount\":\"0\"}]', 852, 1, '2019-03-18 05:43:49', '2019-03-18 05:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `pay_statuses`
--

DROP TABLE IF EXISTS `pay_statuses`;
CREATE TABLE `pay_statuses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pay_statuses`
--

INSERT INTO `pay_statuses` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Weekly', 1, '2018-10-30 23:49:07', '2018-10-30 23:49:43'),
(2, 'Bi-weekly', 1, '2018-10-30 23:49:14', '2018-10-30 23:49:45'),
(3, 'Monthly', 1, '2018-10-30 23:49:19', '2018-10-30 23:49:47'),
(4, 'Fortnightly', 1, '2018-10-30 17:58:21', '2018-10-30 17:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `petty_cashes`
--

DROP TABLE IF EXISTS `petty_cashes`;
CREATE TABLE `petty_cashes` (
  `id` int(11) NOT NULL,
  `date` int(20) NOT NULL,
  `department` varchar(30) NOT NULL,
  `requested_by` varchar(30) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `voucher_no` varchar(30) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `changed_by` varchar(20) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petty_cashes`
--

INSERT INTO `petty_cashes` (`id`, `date`, `department`, `requested_by`, `amount`, `voucher_no`, `description`, `status`, `changed_by`, `account_id`, `created_at`, `updated_at`) VALUES
(5, 1533686400, 'Support', 'Mehedi Hasan', 1545.00, 'Voucher-', NULL, 3, 'Admin Doe', 1, '2018-09-23 08:49:20', '2018-08-08 05:24:48'),
(6, 162235904, 'Support', 'Mehedi Hasan', 10.00, 'dwdwddwdwddddd', 'dwdwd', 1, NULL, 1, '2018-09-23 08:49:23', '2018-08-10 09:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` double(8,2) DEFAULT NULL,
  `sales_price` double(8,2) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `unit_of_measure_id` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `purchase_price`, `sales_price`, `quantity`, `unit_of_measure_id`, `description`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Iphone XS', 'ruandw4e', 1050.00, 1150.00, 10, 2, 'Some description', 1, '2018-11-02 13:30:10', '2018-11-02 13:55:36'),
(2, 'Samsung S9', '7enp3aoi', 800.00, 900.00, 5, 1, 'Some description', 1, '2018-11-02 13:57:48', '2018-11-02 13:57:48'),
(3, 'Some product', '9ivi0xyj', 500.00, 550.00, 10, 1, 'Some description', 1, '2018-11-14 04:43:43', '2018-11-14 04:43:43'),
(4, 'Another product', 'qlnzkvfm', 600.00, 650.00, 10, 2, NULL, 1, '2018-11-14 05:05:15', '2018-11-14 05:05:15'),
(5, 'One Plus 6', 'p7pznuhe', 500.00, 540.00, 10, 3, 'One plus 6, the flagship killer', 1, '2018-12-09 15:14:43', '2018-12-09 15:14:43'),
(6, 'test 1', '5676', 700.00, 750.00, 10, 1, 'some description', 1, '2019-01-05 10:50:10', '2019-01-05 10:50:10'),
(7, 'test2', '8787', 600.00, 650.00, 10, 2, 'some description', 1, '2019-01-05 10:50:10', '2019-01-05 10:50:10'),
(8, 'test 3', '7679', 700.00, 750.00, 8, 1, 'description 3', 1, '2019-01-05 11:09:56', '2019-01-05 11:09:56'),
(9, 'test 4', '9797', 800.00, 820.00, 9, 2, 'description 4', 1, '2019-01-05 11:09:56', '2019-01-05 11:09:56'),
(10, 'test 3', '7679', 700.00, 750.00, 8, 1, 'description 3', 1, '2019-01-06 05:23:27', '2019-01-06 05:23:27'),
(11, 'test 4', '9797', 800.00, 820.00, 9, 2, 'description 4', 1, '2019-01-06 05:23:27', '2019-01-06 05:23:27'),
(12, 'test 3', '7679', 700.00, 750.00, 8, 1, 'description 3', 1, '2019-01-06 05:49:40', '2019-01-06 05:49:40'),
(13, 'test 4', '9797', 800.00, 820.00, 9, 2, 'description 4', 1, '2019-01-06 05:49:40', '2019-01-06 05:49:40'),
(14, 'product by tanvir', '75373537', 200.00, 250.00, 10, 3, 'some description', 1, '2019-01-13 05:31:45', '2019-01-13 05:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `po` varchar(10) NOT NULL,
  `pr` varchar(10) NOT NULL,
  `request_type` varchar(10) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `products` varchar(500) DEFAULT NULL,
  `services` varchar(500) DEFAULT NULL,
  `grand_total` varchar(20) NOT NULL,
  `payments` text,
  `account_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `remarks` varchar(200) DEFAULT NULL,
  `tc` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `vendor_id`, `po`, `pr`, `request_type`, `purpose`, `date`, `products`, `services`, `grand_total`, `payments`, `account_id`, `status`, `remarks`, `tc`, `created_at`, `updated_at`) VALUES
(2, 1, 'PO-1', '1`', 'Normal', 'Food', '1537488000', '[{\"id\":\"4\",\"qty\":\"1\"}]', '[]', '452.00', '[{\"amount\":\"200\",\"date\":1537574400,\"method\":\"Cash\"}]', 1, 2, NULL, 0, '2018-09-21 22:19:52', '2018-09-21 16:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quotation_date` int(20) DEFAULT NULL,
  `valid_till` int(20) DEFAULT NULL,
  `bill_to` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `services` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `costs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `payment_status` int(11) NOT NULL DEFAULT '1',
  `sub_total` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `total_tax` double(8,2) DEFAULT NULL,
  `grand_total` double(8,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `tc` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `code`, `customer_id`, `quotation_date`, `valid_till`, `bill_to`, `shipping_address`, `products`, `services`, `costs`, `status`, `payment_status`, `sub_total`, `discount`, `total_tax`, `grand_total`, `user_id`, `account_id`, `tc`, `created_at`, `updated_at`) VALUES
(2, 'RFQ-123', 5, 1530576000, 1530576000, 'Mehedi', 'House 86, Lake drive road\r\nUttara, Dhaka', '[{\"id\":\"4\",\"qty\":\"1\",\"discount\":\"0\",\"tax\":\"10\"}]', '[{\"id\":\"19\",\"duration\":\"1\",\"discount\":\"0\",\"tax\":\"15\"}]', '[]', 2, 1, 4974.30, 0.00, 723.55, 5767.85, 1, 1, 0, '2018-07-18 04:23:26', '2018-08-09 05:01:28'),
(6, 'Quotation-3', 5, 0, 0, 'Mehedi', 'New Address', '[{\"id\":\"4\",\"qty\":\"1\",\"discount\":\"0\",\"tax\":\"0\"}]', '[]', '[{\"id\":\"2\",\"cost_duration\":\"1\",\"discount\":\"0\",\"tax\":\"10\"},{\"id\":\"1\",\"cost_duration\":\"2\",\"discount\":\"0\",\"tax\":\"0\"}]', 1, 1, 452.00, 0.00, 3.00, 525.00, 1, 1, 0, '2018-08-09 06:42:47', '2018-08-09 06:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE `quotes` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quote_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `po_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` int(11) DEFAULT NULL,
  `expiry_date` int(11) DEFAULT NULL,
  `items` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `shipping_charge` double DEFAULT NULL,
  `grand_total` double DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'pending',
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `account_id`, `customer_id`, `employee_id`, `quote_no`, `po_no`, `issue_date`, `expiry_date`, `items`, `shipping_charge`, `grand_total`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '23232231', '2323422', 1544400000, 1545955200, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1050\",\"discount\":\"0\",\"tax\":\"0\",\"tax_id\":\"5\",\"total\":\"1050.00\"},{\"id\":\"1\",\"type\":\"service\",\"description\":\"Some description edited\",\"uom\":\"Per Day\",\"qty\":\"1\",\"price\":\"1254.87\",\"discount\":\"0\",\"tax\":\"0\",\"tax_id\":\"5\",\"total\":\"1254.87\"}]', 0, 3184.87, 'pending', 'Some notes to the customer', '2018-12-09 15:02:33', '2019-01-29 14:01:34'),
(2, 1, 1, 1, '4578', '23456', 1545955200, 1546646400, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1050\",\"discount\":\"0\",\"tax\":\"0\",\"tax_id\":\"5\",\"total\":\"1050.00\"}]', 100, 1150, 'approved', 'notes', '2018-12-28 11:29:22', '2019-01-30 13:04:30'),
(4, 1, 2, 1, '5373638', '6257357', 1546041600, 1546646400, '[{\"id\":\"1\",\"type\":\"product\",\"description\":\"Some description\",\"uom\":\"SQF\",\"qty\":\"1\",\"price\":\"1050\",\"discount\":\"10\",\"tax\":\"10\",\"tax_id\":\"6\",\"total\":\"1050.00\"}]', 10, 1060, 'active', 'Some notes', '2018-12-28 12:06:01', '2019-01-30 12:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `salary_heads`
--

DROP TABLE IF EXISTS `salary_heads`;
CREATE TABLE `salary_heads` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_heads`
--

INSERT INTO `salary_heads` (`id`, `name`, `type`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'House Rent Allowance', 'benefit', 1, '2018-12-03 12:21:52', '2018-12-03 12:21:52'),
(2, 'Medical Allowance', 'benefit', 1, '2018-12-03 12:22:06', '2018-12-03 12:22:06'),
(3, 'Travel Allowance', 'benefit', 1, '2018-12-03 12:22:15', '2018-12-03 12:22:15'),
(4, 'Over Time Earnings', 'benefit', 1, '2018-12-03 12:22:37', '2018-12-03 12:22:37'),
(5, 'Performance Bonus', 'benefit', 1, '2018-12-03 12:22:48', '2018-12-03 12:22:48'),
(6, 'P.P.F Contribution', 'deduction', 1, '2018-12-03 12:23:18', '2018-12-03 12:23:18'),
(7, 'E.S.I.C Contribution', 'deduction', 1, '2018-12-03 12:23:36', '2018-12-03 12:23:36'),
(8, 'Profession Tax', 'deduction', 1, '2018-12-03 12:24:25', '2018-12-03 12:24:25'),
(9, 'Income Tax', 'deduction', 1, '2018-12-03 12:24:39', '2018-12-03 12:24:39'),
(10, 'Loan Instalment', 'deduction', 1, '2018-12-03 12:24:55', '2018-12-03 12:24:55'),
(11, 'Advance', 'deduction', 1, '2018-12-03 12:25:12', '2018-12-03 12:25:12'),
(12, 'Other Earnings', 'benefit', 1, '2018-12-03 12:47:38', '2018-12-03 12:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rate` double(8,2) DEFAULT NULL,
  `unit_of_measure_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `code`, `description`, `rate`, `unit_of_measure_id`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Simple Service', '1py6gop0', 'Some description edited', 1254.87, 4, 1, '2018-11-02 14:25:16', '2018-11-05 08:17:46'),
(2, 'Housing', 'b1ieup8u', NULL, 100.00, 5, 1, '2018-11-27 04:19:58', '2018-11-27 04:19:58'),
(3, 'Transport Service', 'aof6n9ed', 'Some description about the transport service', 50.00, 5, 1, '2018-12-09 15:59:55', '2018-12-09 15:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `statements`
--

DROP TABLE IF EXISTS `statements`;
CREATE TABLE `statements` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statements`
--

INSERT INTO `statements` (`id`, `code`, `account_id`, `customer_id`, `start`, `end`, `status`, `created_at`, `updated_at`) VALUES
(1, '8taul5fj', 1, 1, 1546300800, 1548892800, 'all', '2019-01-19 00:37:24', '2019-01-29 04:48:06'),
(2, 'h1x4xpl6', 1, 1, 1546300800, 1548892800, 'unpaid', '2019-01-19 00:43:43', '2019-01-29 04:52:29'),
(3, 't5qcfg2k', 1, 2, 1546300800, 1548892800, 'all', '2019-01-20 13:41:37', '2019-01-20 13:41:37'),
(4, 'hl2gzmti', 1, 1, 1548115200, 1548115200, 'all', '2019-01-21 14:41:43', '2019-01-21 14:41:43'),
(5, '3ywt3ewz', 1, 1, 1546300800, 1548892800, 'paid', '2019-01-29 04:52:22', '2019-01-29 04:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_payments`
--

DROP TABLE IF EXISTS `subscription_payments`;
CREATE TABLE `subscription_payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `percentage` double(5,2) NOT NULL,
  `account_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `percentage`, `account_id`, `created_at`, `updated_at`) VALUES
(5, 'None', 0.00, 1, '2018-11-02 21:13:07', '2018-11-02 15:13:07'),
(6, 'VAT', 10.00, 1, '2018-09-23 07:58:19', '2018-07-31 05:51:16'),
(7, 'Tax', 15.00, 1, '2018-09-23 07:58:21', '2018-08-09 04:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT '',
  `subject` varchar(10) DEFAULT '',
  `priority` varchar(10) DEFAULT '',
  `description` varchar(500) DEFAULT '',
  `resolve_status` varchar(10) DEFAULT 'pending',
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `customer_id`, `employee_id`, `title`, `subject`, `priority`, `description`, `resolve_status`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'My issue', 'product', 'high', 'Hi', 'pending', 1, '2018-09-23 08:48:42', '2018-11-06 11:48:50'),
(2, 1, NULL, 'lfkalnbkhsvjd', 'product', 'high', ';kamlnjdsgh', 'pending', 1, '2019-01-20 15:05:20', '2019-01-20 15:05:20'),
(3, 1, 1, 'Hello World', 'service', 'medium', 'Some description', 'pending', 1, '2019-01-23 01:12:51', '2019-01-23 01:12:51'),
(4, 1, NULL, '4567890', 'service', 'high', 'lkjuhgfd', 'pending', 1, '2019-01-30 14:27:50', '2019-01-30 14:27:50'),
(5, 1, NULL, 'tytytytyty', 'product', 'medium', 'ghytr', 'pending', 1, '2019-01-30 14:28:59', '2019-01-30 14:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

DROP TABLE IF EXISTS `trainings`;
CREATE TABLE `trainings` (
  `id` int(11) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `training_type_id` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `duration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `offered_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `award` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `employee_id`, `training_type_id`, `description`, `duration`, `start`, `end`, `offered_by`, `award`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Some description', '10 days', 1538352000, 1539129600, 'Some company', 'Did not get any', '2018-11-05 11:39:44', '2018-11-05 05:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `training_types`
--

DROP TABLE IF EXISTS `training_types`;
CREATE TABLE `training_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_types`
--

INSERT INTO `training_types` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'Seminar', 1, '2018-11-05 05:32:57', '2018-11-05 05:40:29'),
(2, 'Bootcamp', 1, '2018-11-05 05:41:46', '2018-12-03 12:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `unit_of_measures`
--

DROP TABLE IF EXISTS `unit_of_measures`;
CREATE TABLE `unit_of_measures` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit_of_measures`
--

INSERT INTO `unit_of_measures` (`id`, `name`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 'SQM', 1, '2018-11-02 18:33:09', '2018-11-02 18:33:09'),
(2, 'SQF', 1, '2018-11-02 18:33:17', '2018-11-02 18:33:17'),
(3, 'Unit', 1, '2018-11-02 13:29:57', '2018-11-02 13:29:57'),
(4, 'Per Day', 1, '2018-11-02 14:25:09', '2018-11-02 14:25:09'),
(5, 'Per Hour', 1, '2018-11-27 04:19:51', '2018-11-27 04:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `last_login_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `account_id`, `last_login_at`, `last_login_ip`) VALUES
(1, 'Tanvir Hasan Piash', 'admin@example.com', '$2y$10$kIFgqdDfTfCSgzFfQUG9ZeOg3hrEQU87pQ5xP/ZzmWCspzNR2VRsC', '2y7SXQI1thUFn9sdoLwV0fytD7vW50fzOndqubiy98OzGdPnLKUOvltE6zOG', '2018-10-16 11:55:51', '2019-01-27 13:20:35', 'admin', 1, '2019-03-14 06:57:56', '::1'),
(2, 'Sundar Pichai', 'pichai@gmail.com', '$2y$10$kIFgqdDfTfCSgzFfQUG9ZeOg3hrEQU87pQ5xP/ZzmWCspzNR2VRsC', 'qEFjPjajvLSvgdJIroQyTvbl6JDuno6qwZdJFhJel2fcUTyYHuLwlyZEyp33', '2018-10-16 11:56:51', '2019-01-29 04:00:18', 'customer', 1, '2019-02-04 11:49:53', '::1'),
(4, 'Tim Cook', 'tim@apple.com', '$2y$10$tAkmKmumpVAeDBRymRxBH.L4YTUT3tdMln3kJwhata8iPaSRsAj3m', 'MT7slnHPYT2lC0fUqfDJzWhwZWnIvsv35tERXOuNmJeOifdh5QEO0iDkImPQ', '2018-10-16 14:25:30', '2019-01-21 05:49:51', 'vendor', 1, '2019-02-05 08:33:16', NULL),
(6, 'Leonard Homes', 'employee@example.com', '$2y$10$c63TsAhJrOitMl4Lq1U2veU1yhVqkuz1qMDlf1YnF32PETE1YieGe', '9gO96CcRP47OhguxJZQr2m6TieUNrmntu64JC1OtrK67M8y02ci5Y9scJIUR', '2018-10-21 15:03:53', '2018-10-21 15:03:53', 'employee', 1, '2019-02-04 12:06:30', NULL),
(7, 'Tanvir Hasan', 'piash1465@gmail.com', '$2y$10$kIFgqdDfTfCSgzFfQUG9ZeOg3hrEQU87pQ5xP/ZzmWCspzNR2VRsC', 'tY6h6K2A6J4tEMcnG3VXLwuVzrW68ZFDyECMREBKYdK0TKCjqyRkOaMvhEJv', '2018-11-14 04:45:15', '2018-11-14 04:45:15', 'employee', 1, '2019-02-03 11:28:25', NULL),
(8, 'John Doe', 'name@example.com', '$2y$10$DkTc0YJCGUaKuL.mQ557juJIvxaZ3HoOjm96s4OY0qUOEYlbpwMM6', NULL, '2018-11-14 04:48:12', '2018-11-14 04:48:12', 'employee', 1, NULL, NULL),
(9, 'Sheldon Cooper', 'ass@wadxac.com', '$2y$10$//BxQZtIvY9fgKnIqMOF4uiTgK.5y/MTeHSA62bm9D6hXQ/VyptRy', NULL, '2018-11-14 04:56:31', '2018-11-14 04:56:31', 'employee', 1, NULL, NULL),
(10, 'Howard Wolowitz', 'asse@wadxac.com', '$2y$10$f1S2FwcFps5NRigiJZ5zT.aXtzCXKvtud71TI8wyoAIyuqGPU5Mjm', NULL, '2018-11-14 04:59:11', '2018-11-14 04:59:11', 'employee', 1, NULL, NULL),
(11, 'Ross Geller', 'klkgjfcy@hjkmlghk.com', '$2y$10$oIRTus/g9fJkvNrMmOqmTOEd40v9.LGJDch23om/ywuWb2evvPrVy', NULL, '2018-11-14 05:00:56', '2018-11-14 05:00:56', 'employee', 1, NULL, NULL),
(12, 'Joey Tribianni', 'sasas@kljkbhvj.com', '$2y$10$BlxbxIP.KtzyMxJbstKwpOIIWCfHJ7X/0tU04u/08snj5T6tgGS7.', NULL, '2018-11-14 05:01:52', '2018-11-14 05:01:52', 'employee', 1, NULL, NULL),
(13, 'Mike Stenner', 'sasasas@oihug.com', '$2y$10$12WxQZRSwExqkMyFhlu.J.zxAJIzKZK3vZh.zz7qn4JRH8ZWwFqhu', NULL, '2018-11-14 05:03:21', '2018-11-14 05:03:21', 'employee', 1, NULL, NULL),
(14, 'Mark Dewen', 'alkcbjka@example.com', '$2y$10$y.1q5ieaaqf./6YcN6vQz.RZiU8cANDihbZOeikAA/CxTHglToH02', NULL, '2018-11-14 05:04:28', '2018-11-14 05:04:28', 'employee', 1, NULL, NULL),
(15, 'James Peterson', 'james@example.com', '$2y$10$SrGy2ZmxsUD5po5ywl8vRud4itokiym/R2MxuP3Fh4kZnQOAArjae', NULL, '2018-12-10 07:19:47', '2018-12-10 07:19:47', 'employee', 1, NULL, NULL),
(16, 'Larry Page', 'page@gmail.com', '$2y$10$zbLxXLDnBL6toMD8lrvM/eqTJXIz04jgiHHNslXHVYPOA5UCPT8r2', 'FNhADt7RwNaEee2AwkjLiCGurzka7G2kNGll50DbwLEko3eBgUOJ6iGUeLmZ', '2018-12-30 15:58:16', '2018-12-30 15:58:16', 'vendor', 1, NULL, NULL),
(17, 'Sandra Bullok', 'sandra@gmail.com', '$2y$10$kIFgqdDfTfCSgzFfQUG9ZeOg3hrEQU87pQ5xP/ZzmWCspzNR2VRsC', 'GctJvctxXYbuWmmgaxv0oChj4i5t5MblABhJBt1dCP1rbfYN65FuhGPvx2kr', '2019-01-06 06:04:45', '2019-01-06 06:04:45', 'customer', 1, '2019-02-03 08:13:02', NULL),
(18, 'Tanvir', 'tanvir@creativeitem.com', '$2y$10$vrShc6Kc6YMuP2Ny0KdLqeZH1KwX43/ECeE2DkO6gWEMP83sjZ/mG', '3iAIT4VYyueGD01zHevNiJox5wgS7ZI79rKRRXoiOWvz49S90QvcnJ7EhhsL', '2019-01-09 10:32:20', '2019-01-09 10:32:20', 'admin', 2, NULL, NULL),
(19, 'Bill Gates', 'gates@mic.com', '$2y$10$ZBoHB6BJdZWJ.GBlx1Ou3uJctw5aHthdLwHCtWKal5FADmuqFdyqC', NULL, '2019-01-17 03:51:09', '2019-01-17 03:51:09', 'vendor', 1, NULL, NULL),
(20, 'Jonathon Morris', 'jonathon@gmail.com', '$2y$10$0wjsbzEh93ulhjH1XcWbxeYKAYIK92UfGd/BsRX.dxKoDiYu5no..', 'awFi0PYxYeFZ3ftmIIxD0F2zTQfNIjAimAnwdAXLRbOW5BE6Y2HIQ0eZQy9s', '2019-01-18 13:17:38', '2019-01-18 13:17:38', 'admin', 3, NULL, NULL),
(21, 'Mahmudul Hasan', 'active@example.com', '$2y$10$LB7PRR3Im0sORxU3Fd7To.t3qUm6/bFEPK8eYGdhOLNB1.6PmHooq', 'dFjfhQ4TYWEHSLedUnb6a6d2YDhfdoKvLa7t9qPEmayV5aEY5Yuym9QKvuYQ', '2019-01-21 03:49:41', '2019-01-21 03:49:41', 'admin', 4, NULL, NULL),
(23, 'Tanvir Hasan Piash', 'tanvir@creativeitem.com', '$2y$10$nW.hOap7jPTSmvteGUoeOuZU1MfHXyhSZnEKmKwddI53bmzqErv9m', NULL, '2019-01-22 12:51:56', '2019-01-22 12:51:56', 'admin', 6, NULL, NULL),
(24, 'Hillary Clinton', 'hillary@gmail.com', '$2y$10$az7Kj5uFExOstJ4bEG2VnOWGwHNT2rZo2mBDiWlNEolEvNHSw0xte', NULL, '2019-01-22 13:58:49', '2019-01-22 13:58:49', 'admin', 7, NULL, NULL),
(25, 'Thomas Martin', 'thomas@gmail.com', '$2y$10$kq5wFeh925rTLmIQwKEDyutWP7uMXBeFGaGkmH5TjtiqcKcUOmhgu', NULL, '2019-01-22 14:01:58', '2019-01-22 14:01:58', 'admin', 8, NULL, NULL),
(27, 'hello one conatct', 'helloone@gmail.com', '$2y$10$h7z4RWdRyfE9mfwKOzVuw.rqr0l33.39Jpnz/LmHY3qqxgPkBYJ2G', NULL, '2019-01-22 14:41:07', '2019-01-22 14:41:07', 'customer', 1, NULL, NULL),
(28, 'hello one conatct 1', 'helloone1@gmail.com', '', NULL, '2019-01-22 14:46:13', '2019-01-22 14:46:13', 'customer', 1, NULL, NULL),
(29, 'Serius Snape', 'snape@example.com', '$2y$10$TJ4PxZUrREzpTF8e5Ua2uuOmSF64Q9cG68Jba3WVdgJiRmX4JVJfO', NULL, '2019-01-22 14:55:26', '2019-01-22 15:00:33', 'customer', 1, NULL, NULL),
(30, 'Serius Snape', 'snape@example.com', NULL, NULL, '2019-01-22 14:59:02', '2019-01-22 14:59:02', 'customer', 1, NULL, NULL),
(31, 'Serius Snape', 'snape@example.com', NULL, NULL, '2019-01-22 15:00:33', '2019-01-22 15:00:33', 'customer', 1, NULL, NULL),
(32, 'Maje Maje', 'info@phemo.net', '$2y$10$kIFgqdDfTfCSgzFfQUG9ZeOg3hrEQU87pQ5xP/ZzmWCspzNR2VRsC', 'U5F5dTuP8n2HE4ibhAYnq93zjU5SJHDFwbGZ4hgiqjdyWYqLvDzcXk0UUqzF', '2019-01-26 16:59:06', '2019-01-27 13:28:30', 'superadmin', 0, '2019-02-03 08:07:54', '::1'),
(33, 'Jerrad Home', 'jerrard@stephen.com', '$2y$10$G/LkOtc5id74f8HZJln0BOrzHOkZWVFLtwOoRT2AwB7XnVSef6ala', NULL, '2019-01-27 05:01:00', '2019-01-27 05:01:00', 'employee', 1, NULL, NULL),
(34, 'Hello Customer', 'hellocustomer@example.com', '$2y$10$vI9OUY6DrL6lS.UX4zHBpO5bnu.NLOSNwWLLGRlnE.EwVE/7LIHh2', NULL, '2019-01-28 07:27:50', '2019-01-28 07:27:50', 'customer', 1, '2019-01-28 13:27:50', NULL),
(35, 'Hello Customer two', 'hellocustomertwo@example.com', '$2y$10$DvRgeWMjGnqtC/H3BsQlRO6oDLP48a.0kW51cXCtqpU.AiupR0xte', NULL, '2019-01-28 07:27:50', '2019-01-28 07:27:59', 'customer', 1, '2019-01-28 13:27:59', NULL),
(36, 'MC Maje', 'mcmaje@gmail.com', '$2y$10$c3Iz2V4YUj0zt7U8veUKgOFEmYaLEj/CKZQVO4qPVfd8vSIqRk1Ti', 'GA9E5bjh2ZA2vyj1QuequtTdXFHQ5AASN4zc2xiDig9oIYbUfVaqIPZfGbsY', '2019-01-28 07:32:50', '2019-01-28 07:33:21', 'employee', 1, '2019-01-28 13:33:31', '::1'),
(37, 'Harum et non duis vo', 'lulelu@mailinator.com', '$2y$10$KatWAYBikyyTxR6P//kTH.UN3Ic5bEJFB0mELgfLvmZ3xisv3yPKq', NULL, '2019-02-05 04:09:16', '2019-02-05 04:09:16', 'vendor', 1, '2019-02-05 10:09:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `permissions` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 6, '[\"vendor_view\",\"customer_view\",\"product_view\",\"service_view\",\"damaged_product_view\"]', '2018-12-28 03:28:16', '2019-01-22 10:31:51'),
(2, 15, '[\"vendor_view\"]', '2018-12-28 12:07:36', '2018-12-28 12:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cell_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `contact_person`, `company_phone`, `contact_email`, `work_number`, `cell_phone`, `skype_id`, `address_line_1`, `address_line_2`, `country_id`, `city`, `zip_code`, `tax_number`, `swift_code`, `iban`, `state`, `website`, `user_id`, `account_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple Inc', 'Tim Cook', '123456', 'tim@apple.com', '6373638', '123456', 'vendor', 'Some address line 1', 'some address line 2', 231, 'New York', '121', '63537326', '8272682', '6262726', 'NY', 'vendor.com', '4', '1', 1, '2018-10-16 14:25:30', '2019-01-21 05:49:51'),
(2, 'Google', 'Larry Page', '537252726', 'page@gmail.com', '416531', '7153178', 'larry', 'Some address', 'Some address', 13, 'City', '2323', '71517', '176314', '817635', 'State', 'https://google.com', '16', '1', 1, '2018-12-30 15:58:16', '2019-01-17 05:58:59'),
(3, 'Microsoft', 'Bill Gates', '538272', 'gates@mic.com', '456789', '456789', NULL, 'Some address', 'Some address', 231, 'New York', '2323', '4567890', '4567890', '4567890', 'NY', NULL, '19', '1', 1, '2019-01-17 03:51:09', '2019-02-03 00:23:45'),
(4, 'Solis and Hubbard Traders', 'Harum et non duis vo', '0232322232', 'lulelu@mailinator.com', '640', '0232322232', 'Nisi assumenda dolor', '56 Milton Boulevard', 'Quo delectus at tot', 181, 'Est voluptas rem ita', '76249', '451', 'Nulla saepe quia non', 'Similique est alias', 'Nisi reiciendis qui', 'https://www.garyneten.com.au', '37', '1', 1, '2019-02-05 04:09:16', '2019-02-05 04:09:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_costs`
--
ALTER TABLE `additional_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_notes`
--
ALTER TABLE `credit_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`country_code`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer_categories`
--
ALTER TABLE `customer_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damaged_products`
--
ALTER TABLE `damaged_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_documents`
--
ALTER TABLE `employee_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_histories`
--
ALTER TABLE `employment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_sizes`
--
ALTER TABLE `file_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_statuses`
--
ALTER TABLE `job_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_statuses`
--
ALTER TABLE `pay_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petty_cashes`
--
ALTER TABLE `petty_cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_heads`
--
ALTER TABLE `salary_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_payments`
--
ALTER TABLE `subscription_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_types`
--
ALTER TABLE `training_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_of_measures`
--
ALTER TABLE `unit_of_measures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_email` (`contact_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `additional_costs`
--
ALTER TABLE `additional_costs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `credit_notes`
--
ALTER TABLE `credit_notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_categories`
--
ALTER TABLE `customer_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `damaged_products`
--
ALTER TABLE `damaged_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_documents`
--
ALTER TABLE `employee_documents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employment_histories`
--
ALTER TABLE `employment_histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `file_sizes`
--
ALTER TABLE `file_sizes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_statuses`
--
ALTER TABLE `job_statuses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pay_statuses`
--
ALTER TABLE `pay_statuses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petty_cashes`
--
ALTER TABLE `petty_cashes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salary_heads`
--
ALTER TABLE `salary_heads`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statements`
--
ALTER TABLE `statements`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription_payments`
--
ALTER TABLE `subscription_payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_types`
--
ALTER TABLE `training_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_of_measures`
--
ALTER TABLE `unit_of_measures`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
