/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : mysalon

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 07/07/2023 09:47:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for booking_details
-- ----------------------------
DROP TABLE IF EXISTS `booking_details`;
CREATE TABLE `booking_details`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_booking` int NOT NULL,
  `id_service` int NOT NULL,
  `id_employee` int NOT NULL,
  `is_finish` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of booking_details
-- ----------------------------
INSERT INTO `booking_details` VALUES (4, 4, 2, 6, 1, '2023-07-01 13:06:01', '2023-07-01 15:24:43');
INSERT INTO `booking_details` VALUES (5, 4, 1, 6, 1, NULL, '2023-07-01 15:24:59');
INSERT INTO `booking_details` VALUES (6, 5, 2, 6, 2, '2023-07-02 12:24:01', '2023-07-02 14:10:26');
INSERT INTO `booking_details` VALUES (7, 6, 2, 5, 1, '2023-07-02 20:47:29', '2023-07-02 21:02:06');
INSERT INTO `booking_details` VALUES (8, 7, 2, 5, 1, '2023-07-02 21:32:42', '2023-07-02 21:44:18');
INSERT INTO `booking_details` VALUES (9, 8, 1, 5, 1, '2023-07-04 00:39:10', '2023-07-04 01:45:15');
INSERT INTO `booking_details` VALUES (10, 8, 2, 6, 1, '2023-07-04 00:39:10', '2023-07-04 01:45:22');
INSERT INTO `booking_details` VALUES (11, 8, 3, 6, 1, '2023-07-04 00:39:10', '2023-07-04 01:45:29');
INSERT INTO `booking_details` VALUES (12, 9, 3, 6, 1, '2023-07-04 00:41:45', '2023-07-04 01:44:40');
INSERT INTO `booking_details` VALUES (13, 9, 2, 6, 1, '2023-07-04 00:41:45', '2023-07-04 01:44:48');
INSERT INTO `booking_details` VALUES (14, 9, 1, 5, 1, '2023-07-04 00:41:45', '2023-07-04 01:44:55');
INSERT INTO `booking_details` VALUES (15, 10, 2, 5, 1, '2023-07-04 00:53:09', '2023-07-04 01:01:05');
INSERT INTO `booking_details` VALUES (16, 10, 3, 6, 1, '2023-07-04 00:53:09', '2023-07-04 01:02:18');
INSERT INTO `booking_details` VALUES (17, 10, 1, 5, 1, '2023-07-04 00:53:09', '2023-07-04 01:02:04');
INSERT INTO `booking_details` VALUES (18, 11, 2, 5, 0, '2023-07-04 02:13:52', '2023-07-04 02:13:52');
INSERT INTO `booking_details` VALUES (19, 11, 3, 6, 0, '2023-07-04 02:13:52', '2023-07-04 02:13:52');
INSERT INTO `booking_details` VALUES (20, 12, 2, 6, 1, '2023-07-04 02:35:21', '2023-07-04 02:35:50');
INSERT INTO `booking_details` VALUES (21, 12, 3, 6, 1, '2023-07-04 02:35:21', '2023-07-04 02:35:57');
INSERT INTO `booking_details` VALUES (22, 13, 2, 6, 0, '2023-07-04 11:28:59', '2023-07-04 11:28:59');
INSERT INTO `booking_details` VALUES (23, 14, 3, 6, 1, '2023-07-06 04:17:31', '2023-07-06 05:12:55');
INSERT INTO `booking_details` VALUES (24, 14, 2, 6, 1, '2023-07-06 04:17:31', '2023-07-06 05:13:06');
INSERT INTO `booking_details` VALUES (27, 17, 2, 6, 1, '2023-07-07 03:23:19', '2023-07-07 04:05:14');
INSERT INTO `booking_details` VALUES (28, 18, 2, 5, 1, '2023-07-07 04:42:03', '2023-07-07 08:53:55');
INSERT INTO `booking_details` VALUES (29, 19, 2, 5, 0, '2023-07-07 08:50:31', '2023-07-07 08:50:31');
INSERT INTO `booking_details` VALUES (30, 19, 3, 6, 0, '2023-07-07 08:50:31', '2023-07-07 08:50:31');
INSERT INTO `booking_details` VALUES (31, 20, 2, 5, 0, '2023-07-07 09:05:54', '2023-07-07 09:05:54');
INSERT INTO `booking_details` VALUES (32, 21, 2, 5, 0, '2023-07-07 09:06:12', '2023-07-07 09:06:12');
INSERT INTO `booking_details` VALUES (33, 22, 2, 6, 0, '2023-07-07 09:07:29', '2023-07-07 09:07:29');
INSERT INTO `booking_details` VALUES (34, 23, 1, 5, 0, '2023-07-07 09:09:04', '2023-07-07 09:09:04');
INSERT INTO `booking_details` VALUES (35, 24, 1, 5, 0, '2023-07-07 09:09:33', '2023-07-07 09:09:33');
INSERT INTO `booking_details` VALUES (36, 25, 1, 5, 0, '2023-07-07 09:11:09', '2023-07-07 09:11:09');
INSERT INTO `booking_details` VALUES (37, 25, 2, 6, 0, '2023-07-07 09:11:09', '2023-07-07 09:11:09');
INSERT INTO `booking_details` VALUES (38, 26, 1, 5, 0, '2023-07-07 09:14:28', '2023-07-07 09:14:28');

-- ----------------------------
-- Table structure for booking_products
-- ----------------------------
DROP TABLE IF EXISTS `booking_products`;
CREATE TABLE `booking_products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_booking` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `booking_products_id_booking_foreign`(`id_booking`) USING BTREE,
  INDEX `booking_products_id_product_foreign`(`id_product`) USING BTREE,
  CONSTRAINT `booking_products_id_booking_foreign` FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `booking_products_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of booking_products
-- ----------------------------
INSERT INTO `booking_products` VALUES (1, 14, 1, 2, NULL, '2023-07-07 02:42:10');
INSERT INTO `booking_products` VALUES (6, 14, 2, 2, '2023-07-07 02:35:45', '2023-07-07 02:42:10');
INSERT INTO `booking_products` VALUES (7, 17, 1, 1, '2023-07-07 03:23:19', '2023-07-07 03:23:19');
INSERT INTO `booking_products` VALUES (8, 18, 1, 1, '2023-07-07 08:55:02', '2023-07-07 08:55:02');
INSERT INTO `booking_products` VALUES (9, 18, 2, 1, '2023-07-07 08:55:02', '2023-07-07 08:55:02');
INSERT INTO `booking_products` VALUES (10, 25, 1, 1, '2023-07-07 09:11:09', '2023-07-07 09:11:09');
INSERT INTO `booking_products` VALUES (11, 25, 2, 1, '2023-07-07 09:11:09', '2023-07-07 09:11:09');
INSERT INTO `booking_products` VALUES (12, 26, 1, 2, '2023-07-07 09:14:28', '2023-07-07 09:14:28');
INSERT INTO `booking_products` VALUES (13, 26, 2, 2, '2023-07-07 09:14:28', '2023-07-07 09:14:28');

-- ----------------------------
-- Table structure for bookings
-- ----------------------------
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_date` datetime NOT NULL,
  `no_booking` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_customer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_service_category` int NOT NULL,
  `status` int NOT NULL,
  `discount` int NOT NULL,
  `total_price` int NOT NULL,
  `estimate_end` datetime NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_paid` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bookings
-- ----------------------------
INSERT INTO `bookings` VALUES (4, '2023-08-02 09:00:00', 'BR/02082023/00001', '1', 8, 1, 0, 250000, NULL, '2023-07-01 13:06:01', '2023-07-01 16:17:15', 1);
INSERT INTO `bookings` VALUES (5, '2023-07-02 14:00:00', 'BR/02072023/00001', '1', 8, 2, 0, 250000, NULL, '2023-07-02 12:24:01', '2023-07-02 14:10:26', NULL);
INSERT INTO `bookings` VALUES (6, '2023-07-03 17:00:00', 'BR/03072023/00001', '15', 8, 1, 0, 250000, NULL, '2023-07-02 20:47:29', '2023-07-02 21:02:57', 1);
INSERT INTO `bookings` VALUES (7, '2023-07-03 17:00:00', 'BR/03072023/00002', '15', 8, 1, 0, 250000, NULL, '2023-07-02 21:32:42', '2023-07-04 02:37:42', 1);
INSERT INTO `bookings` VALUES (8, '2023-07-04 10:00:00', 'BR/04072023/00001', '1', 8, 1, 0, 700500, NULL, '2023-07-04 00:39:10', '2023-07-04 01:45:30', NULL);
INSERT INTO `bookings` VALUES (9, '2023-07-04 09:00:00', 'BR/04072023/00002', '1', 8, 1, 0, 700500, NULL, '2023-07-04 00:41:45', '2023-07-04 01:44:57', NULL);
INSERT INTO `bookings` VALUES (10, '2023-07-05 10:00:00', 'BR/05072023/00001', '1', 8, 1, 0, 700500, '2023-07-05 13:00:00', '2023-07-04 00:53:09', '2023-07-04 02:38:11', 1);
INSERT INTO `bookings` VALUES (11, '2023-07-04 10:00:00', 'BR/04072023/00001', '1', 8, 2, 0, 505000, '2023-07-04 12:00:00', '2023-07-04 02:13:52', '2023-07-04 11:27:42', NULL);
INSERT INTO `bookings` VALUES (12, '2023-07-04 12:00:00', 'BR/04072023/00002', '1', 8, 1, 0, 505000, '2023-07-04 14:00:00', '2023-07-04 02:35:21', '2023-07-04 02:35:58', NULL);
INSERT INTO `bookings` VALUES (13, '2023-07-04 13:00:00', 'BR/04072023/00003', '15', 8, 2, 0, 250000, '2023-07-04 14:00:00', '2023-07-04 11:28:59', '2023-07-05 00:12:38', NULL);
INSERT INTO `bookings` VALUES (14, '2023-07-06 09:00:00', 'BR/06072023/00001', '15', 8, 1, 0, 865000, '2023-07-06 11:00:00', '2023-07-06 04:17:31', '2023-07-07 04:15:05', 1);
INSERT INTO `bookings` VALUES (17, '2023-07-07 11:00:00', 'BR/07072023/00001', '1', 8, 1, 0, 270000, '2023-07-07 12:00:00', '2023-07-07 03:23:19', '2023-07-07 04:05:38', 1);
INSERT INTO `bookings` VALUES (18, '2023-07-07 10:00:00', 'BR/07072023/00002', '15', 8, 1, 0, 345000, '2023-07-07 11:00:00', '2023-07-07 04:42:03', '2023-07-07 08:55:02', NULL);
INSERT INTO `bookings` VALUES (19, '2023-07-08 09:00:00', 'BR/08072023/00001', '1', 8, 0, 0, 505000, '2023-07-08 11:00:00', '2023-07-07 08:50:31', '2023-07-07 08:50:31', NULL);
INSERT INTO `bookings` VALUES (20, '2023-07-07 11:00:00', 'BR/07072023/00001', '15', 8, 0, 0, 250000, '2023-07-07 12:00:00', '2023-07-07 09:05:54', '2023-07-07 09:05:54', NULL);
INSERT INTO `bookings` VALUES (21, '2023-07-08 10:00:00', 'BR/08072023/00001', '15', 8, 0, 0, 250000, '2023-07-08 11:00:00', '2023-07-07 09:06:12', '2023-07-07 09:06:12', NULL);
INSERT INTO `bookings` VALUES (22, '2023-07-08 10:00:00', 'BR/08072023/00002', '15', 8, 0, 0, 250000, '2023-07-08 11:00:00', '2023-07-07 09:07:29', '2023-07-07 09:07:29', NULL);
INSERT INTO `bookings` VALUES (23, '2023-07-08 11:00:00', 'BR/08072023/00003', '15', 8, 0, 0, 195500, '2023-07-08 12:00:00', '2023-07-07 09:09:04', '2023-07-07 09:09:04', NULL);
INSERT INTO `bookings` VALUES (24, '2023-07-10 09:00:00', 'BR/10072023/00001', '15', 8, 0, 0, 195500, '2023-07-10 10:00:00', '2023-07-07 09:09:33', '2023-07-07 09:09:33', NULL);
INSERT INTO `bookings` VALUES (25, '2023-07-08 12:00:00', 'BR/08072023/00001', '13', 8, 0, 0, 540500, '2023-07-08 14:00:00', '2023-07-07 09:11:09', '2023-07-07 09:11:09', NULL);
INSERT INTO `bookings` VALUES (26, '2023-07-08 13:00:00', 'BR/08072023/00002', '17', 8, 0, 0, 385500, '2023-07-08 14:00:00', '2023-07-07 09:14:28', '2023-07-07 09:14:28', NULL);

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `customers_phone_unique`(`phone`) USING BTREE,
  UNIQUE INDEX `customers_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (4, 'Customer', 'customer@example.com', '08231231231', '2023-06-30 12:43:59', '2023-06-30 12:43:59');
INSERT INTO `customers` VALUES (5, 'Riki', 'test@gmail.com', '0819', '2023-07-02 13:12:41', '2023-07-02 13:12:41');
INSERT INTO `customers` VALUES (6, 'riki', 'riki@example.com', '08222', '2023-07-02 20:44:32', '2023-07-02 20:44:32');
INSERT INTO `customers` VALUES (12, 'Julia', '08224213123', '', '2023-07-07 03:23:19', '2023-07-07 03:23:19');
INSERT INTO `customers` VALUES (13, 'Test', '', '083213124', '2023-07-07 08:50:31', '2023-07-07 08:50:31');
INSERT INTO `customers` VALUES (14, 'baru', 'baru@example.com', '084124124', '2023-07-07 09:11:09', '2023-07-07 09:11:09');
INSERT INTO `customers` VALUES (15, 'baru', 'baru2@email.com', '4102412432', '2023-07-07 09:14:28', '2023-07-07 09:14:28');
INSERT INTO `customers` VALUES (16, 'baru', 'baru3@email.com', '08312313', '2023-07-07 09:31:56', '2023-07-07 09:31:56');
INSERT INTO `customers` VALUES (17, 'baru3', 'baru4@email.com', '085124314', '2023-07-07 09:32:53', '2023-07-07 09:32:53');

-- ----------------------------
-- Table structure for employee_services
-- ----------------------------
DROP TABLE IF EXISTS `employee_services`;
CREATE TABLE `employee_services`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_employee` bigint UNSIGNED NOT NULL,
  `id_service` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `employee_services_id_employee_foreign`(`id_employee`) USING BTREE,
  INDEX `employee_services_id_service_foreign`(`id_service`) USING BTREE,
  CONSTRAINT `employee_services_id_employee_foreign` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `employee_services_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of employee_services
-- ----------------------------
INSERT INTO `employee_services` VALUES (9, 5, 2, NULL, NULL);
INSERT INTO `employee_services` VALUES (10, 5, 1, NULL, NULL);
INSERT INTO `employee_services` VALUES (13, 6, 2, NULL, NULL);
INSERT INTO `employee_services` VALUES (14, 6, 3, NULL, NULL);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `employees_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `employees_phone_unique`(`phone`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (5, 'jajang', 'employee@example.com', '08231231231', '2023-06-30 12:44:47', '2023-06-30 12:44:47');
INSERT INTO `employees` VALUES (6, 'amora', 'employee2@example.com', '08231231', '2023-06-30 15:43:17', '2023-06-30 15:43:17');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_06_23_170441_create_user_roles_table', 2);
INSERT INTO `migrations` VALUES (6, '2023_06_25_105450_create_services_table', 3);
INSERT INTO `migrations` VALUES (7, '2023_06_25_110153_create_servicecategories_table', 4);
INSERT INTO `migrations` VALUES (8, '2023_06_26_031541_create_customers_table', 5);
INSERT INTO `migrations` VALUES (9, '2023_06_30_033231_create_bookings_table', 6);
INSERT INTO `migrations` VALUES (10, '2023_06_30_033621_create_booking_details_table', 6);
INSERT INTO `migrations` VALUES (11, '2023_06_30_085219_create_employees_table', 7);
INSERT INTO `migrations` VALUES (12, '2023_06_30_085627_create_employee_services_table', 8);
INSERT INTO `migrations` VALUES (13, '2023_07_05_030452_create_products_table', 9);
INSERT INTO `migrations` VALUES (14, '2023_07_06_030319_create_booking_products_table', 10);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10, 0) NOT NULL,
  `stock` decimal(10, 0) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Hair Conditioner', 20000, NULL, NULL, NULL);
INSERT INTO `products` VALUES (2, 'Goat Milk Shampoo', 75000, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for servicecategories
-- ----------------------------
DROP TABLE IF EXISTS `servicecategories`;
CREATE TABLE `servicecategories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of servicecategories
-- ----------------------------
INSERT INTO `servicecategories` VALUES (1, 'Body Treatment', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (2, 'Facial Treatment', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (3, 'Hair Treatment', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (4, 'Hand and Foot Treatment', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (5, 'Salon Service', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (6, 'Paket PUTRI', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (7, 'paket AYU', '0', NULL, NULL);
INSERT INTO `servicecategories` VALUES (8, 'Non Paket', '', NULL, NULL);

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category` int NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NULL DEFAULT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of services
-- ----------------------------
INSERT INTO `services` VALUES (1, 'body massage', 1, '', '01_totok.jpg', 60, 195500, NULL, '2023-07-02 22:03:35');
INSERT INTO `services` VALUES (2, 'body scrub (lulur)', 1, '', '02_facial.jpg', 60, 250000, NULL, NULL);
INSERT INTO `services` VALUES (3, 'body masker', 1, '', '03_ear_candle.jpg', 60, 255000, NULL, NULL);
INSERT INTO `services` VALUES (4, 'body steam', 1, '', '04_creambath.jpg', 60, 110000, NULL, NULL);
INSERT INTO `services` VALUES (5, 'ratus', 1, '', '05_catok.jpg', 60, 85000, NULL, NULL);
INSERT INTO `services` VALUES (6, 'basic facial wardah', 2, '', '06_curly.jpg', 60, 100000, NULL, NULL);
INSERT INTO `services` VALUES (7, 'facial ristra biokos', 2, '', '07_lulur.jpg', 60, 135000, NULL, NULL);
INSERT INTO `services` VALUES (8, 'anti aging facial', 2, '', '08_masker.jpg', 60, 110000, NULL, NULL);
INSERT INTO `services` VALUES (9, 'acne treatment facial', 2, '', '09_manicure.jpg', 60, 150000, NULL, NULL);
INSERT INTO `services` VALUES (10, 'whitening facial', 2, '', '10_spa.jpg', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (11, 'totok wajah', 2, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (12, 'masker wajah', 2, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (13, 'creambath buah (pendek)', 3, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (14, 'creambath buah (panjang)', 3, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (15, 'hair spa texture makarizo (pendek)', 3, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (16, 'hair spa texture makarizo (panjang)', 3, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (17, 'anti dandruff', 3, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (18, 'creambath matrix', 3, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (19, 'manicure', 4, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (20, 'pedicure', 4, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (21, 'manicure + pedicure', 4, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (22, 'foot spa', 4, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (23, 'reflexi', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (24, 'hair cut (pendek)', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (25, 'hair cut (panjang)', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (26, 'potong poni', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (27, 'blow variasi (pendek)', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (28, 'blow variasi (panjang)', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (29, 'jasa colouring henna', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (30, 'Facial biokos + totok', 6, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (31, 'Facial wardah + totok', 6, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (32, 'body steam + body massage + scrub', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (33, 'body massage + scrub + totok', 5, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (34, 'body masssage + Scrub ', 7, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (35, 'body massage + lulur + menipedi', 7, '', '', 60, 120000, NULL, NULL);
INSERT INTO `services` VALUES (36, 'body massage', 1, '', '', NULL, 195000, '2023-06-30 17:01:29', '2023-06-30 17:01:29');
INSERT INTO `services` VALUES (37, 'body massage', 1, '', '', NULL, 195000, '2023-06-30 17:01:36', '2023-06-30 17:01:36');
INSERT INTO `services` VALUES (38, 'body massage', 1, '', '', NULL, 190000, '2023-06-30 17:01:48', '2023-06-30 17:01:48');
INSERT INTO `services` VALUES (39, 'body massage', 1, '', '', NULL, 191000, '2023-06-30 17:02:08', '2023-06-30 17:02:08');
INSERT INTO `services` VALUES (40, 'body scrub (lulur)', 2, '', '', NULL, 250000, '2023-06-30 17:02:50', '2023-06-30 17:02:50');
INSERT INTO `services` VALUES (41, 'body scrub (lulur)', 2, '', '', NULL, 250000, '2023-06-30 17:03:09', '2023-06-30 17:03:09');
INSERT INTO `services` VALUES (42, 'body massage', 1, '', '', NULL, 195000, '2023-06-30 17:04:17', '2023-06-30 17:04:17');
INSERT INTO `services` VALUES (43, 'body massage', 1, '', '', 60, 195000, '2023-06-30 17:06:33', '2023-06-30 17:06:33');
INSERT INTO `services` VALUES (44, 'body massage', 1, '', '01_totok.jpg', 60, 195500, '2023-06-30 17:08:19', '2023-06-30 17:08:19');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_code` int NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES (1, 'Superadmin', 10, '', NULL, NULL);
INSERT INTO `user_roles` VALUES (2, 'Recepsionist', 20, '', NULL, NULL);
INSERT INTO `user_roles` VALUES (3, 'Karyawan', 30, '', NULL, NULL);
INSERT INTO `user_roles` VALUES (4, 'Kasir', 40, '', NULL, NULL);
INSERT INTO `user_roles` VALUES (5, 'Customer', 50, '', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int UNSIGNED NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` int NULL DEFAULT NULL,
  `is_deleted` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Superadmin', 'admin@example.com', NULL, '$2y$10$O0DIIX8LMPjfuGktbrD.zuiu7YOuCCLGezE06bXoZKjLPRd3zHTfK', 10, NULL, 1, 0, NULL, '2023-06-25 11:41:01');
INSERT INTO `users` VALUES (10, 'Customer', 'customer@example.com', NULL, '$2y$10$2UPXzCoyb.e9nTsTHWmne.wSvs5NrPli8pfQHU/sFGHSndPQOLn7C', 50, NULL, 1, 0, '2023-06-30 12:43:59', '2023-06-30 12:43:59');
INSERT INTO `users` VALUES (11, 'Employee Jajang', 'employee@example.com', NULL, '$2y$10$KrH8ByiJHnFleJnLMIg9Ley.Bo3KRfPh5shvX2pZ8I/v.Lq/1ybzG', 30, NULL, 1, 0, '2023-06-30 12:44:47', '2023-06-30 12:44:47');
INSERT INTO `users` VALUES (12, 'amora', 'employee2@example.com', NULL, '$2y$10$xVMW09NShpzr5Zg5/5AAmeHJbxPlZFtks2YifdaZ.8hp/7Ll.LO12', 30, NULL, 1, 0, '2023-06-30 15:43:17', '2023-06-30 15:43:17');
INSERT INTO `users` VALUES (13, 'Cashier', 'cashier@example.com', NULL, '$2y$10$EvPQSEBDbaL6sY3DTfiLRuCYWRLAI2CN3WUs0rTs/Z7zLPykLmOde', 40, NULL, 1, 0, '2023-07-01 16:10:34', '2023-07-01 16:10:34');
INSERT INTO `users` VALUES (14, 'Riki', 'test@gmail.com', NULL, '$2y$10$NyNYHmxjEgCTBY0I4GN.d.qw9.S9XTUwBJTtLDF8MJfM5T2Z6zNZ.', 50, NULL, 1, 0, '2023-07-02 13:12:41', '2023-07-02 13:12:41');
INSERT INTO `users` VALUES (15, 'riki', 'riki@example.com', NULL, '$2y$10$sP1Roz2eORrhBH25eKuAwu1KnyqezjjSjttc1VZuCeNYqPLKvPTnq', 50, NULL, 1, 0, '2023-07-02 20:44:32', '2023-07-02 20:44:32');
INSERT INTO `users` VALUES (16, 'baru', 'baru@example.com', NULL, '$2y$10$IQwRvJYU1V4xPza.2EmqHuzSQjtvau42KWjKwDKfl6W6NSaL1xIJS', 50, NULL, 1, 0, '2023-07-07 09:11:09', '2023-07-07 09:11:09');
INSERT INTO `users` VALUES (17, 'baru', 'baru2@email.com', NULL, '$2y$10$0tsOJnN5SZk9a2/Wr420yevedUQW0.3YTNQa.M9a62LpTTLE9inM.', 50, NULL, 1, 0, '2023-07-07 09:14:28', '2023-07-07 09:14:28');
INSERT INTO `users` VALUES (18, 'baru', 'baru3@email.com', NULL, '$2y$10$JCAipEuDqLMVeRtCkYpng.p4wkBq8jPYFnf1I211rMIzDm5p6UalW', 50, NULL, 1, 0, '2023-07-07 09:31:56', '2023-07-07 09:31:56');
INSERT INTO `users` VALUES (19, 'baru3', 'baru4@email.com', NULL, '$2y$10$HuNPurAoyY.ggPdyDpXRJe1nYi9G1tizgUEGqPWOZjOTrawLLZX7C', 50, NULL, 1, 0, '2023-07-07 09:32:53', '2023-07-07 09:32:53');

SET FOREIGN_KEY_CHECKS = 1;
