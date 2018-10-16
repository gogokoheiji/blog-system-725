



-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'blog'
-- 
-- ---

DROP TABLE IF EXISTS `blog`;
		
CREATE TABLE `blog` (
  `id` BIGINT(20) NULL AUTO_INCREMENT DEFAULT NULL,
  `status` INT(11) NOT NULL,
  `client_id` BIGINT(20) NOT NULL,
  `blog_title` VARCHAR(100) NOT NULL,
  `blog_description` VARCHAR(500) NULL DEFAULT NULL,
  `blog_keywords` VARCHAR(500) NULL DEFAULT NULL,
  `blog_author_name` VARCHAR(50) NULL DEFAULT NULL,
  `blog_header_image` BLOB NULL DEFAULT NULL,
  `blog_header_image_ext` VARCHAR(10) NULL DEFAULT NULL,
  `blog_favicon_image` BLOB NULL DEFAULT NULL,
  `blog_favicon_image_ext` VARCHAR(10) NULL DEFAULT NULL,
  `blog_favicon180_image` BLOB NULL DEFAULT NULL,
  `blog_favicon180_image_ext` VARCHAR(10) NULL DEFAULT NULL,
  `blog_default_eye_catch_image` BLOB NULL DEFAULT NULL,
  `blog_default_eye_catch_image_ext` VARCHAR(10) NULL DEFAULT NULL,
  `analytics_ua_code` VARCHAR(50) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'blog_entry'
-- 
-- ---

DROP TABLE IF EXISTS `blog_entry`;
		
CREATE TABLE `blog_entry` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `status` INT(11) NOT NULL,
  `client_id` BIGINT(20) NOT NULL,
  `blog_id` BIGINT(20) NOT NULL,
  `blog_entry_code` BIGINT(20) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `contents` VARCHAR(200) NULL DEFAULT NULL,
  `posting_date` DATETIME NOT NULL,
  `seo_title` VARCHAR(200) NOT NULL,
  `seo_description` VARCHAR(500) NULL DEFAULT NULL,
  `seo_keywords` VARCHAR(200) NULL DEFAULT NULL,
  `slug` VARCHAR(50) NULL DEFAULT NULL,
  `eye_catch_image` BLOB NULL DEFAULT NULL,
  `eye_catch_image_ext` VARCHAR(10) NULL DEFAULT NULL,
  `view_count` BIGINT(20) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'blog_entry_image'
-- 
-- ---

DROP TABLE IF EXISTS `blog_entry_image`;
		
CREATE TABLE `blog_entry_image` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `client_id` BIGINT(20) NOT NULL,
  `blog_id` BIGINT(20) NOT NULL,
  `blog_entry_id` BIGINT(20) NOT NULL,
  `image_code` VARCHAR(16) NOT NULL,
  `image` BLOB NOT NULL,
  `image_ext` VARCHAR(10) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'blog_category_master'
-- 
-- ---

DROP TABLE IF EXISTS `blog_category_master`;
		
CREATE TABLE `blog_category_master` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `status` INT(11) NOT NULL,
  `client_id` BIGINT(20) NOT NULL,
  `blog_id` BIGINT(20) NOT NULL,
  `blog_category_code` BIGINT(20) NOT NULL,
  `blog_category_slug` VARCHAR(50) NULL DEFAULT NULL,
  `category_name` VARCHAR(200) NOT NULL,
  `sort_order` INT(11) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'blog_category'
-- 
-- ---

DROP TABLE IF EXISTS `blog_category`;
		
CREATE TABLE `blog_category` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `status` INT(11) NOT NULL,
  `client_id` BIGINT(20) NOT NULL,
  `blog_id` BIGINT(20) NOT NULL,
  `blog_entry_id` BIGINT(20) NOT NULL,
  `blog_category_master_id` BIGINT(20) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'client'
-- 
-- ---

DROP TABLE IF EXISTS `client`;
		
CREATE TABLE `client` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `status` INT(11) NOT NULL,
  `client_code` VARCHAR(12) NOT NULL,
  `client_name` VARCHAR(400) NOT NULL,
  `mail_address` VARCHAR(500) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `client_profile` MEDIUMTEXT NULL DEFAULT NULL,
  `client_profile_image` BLOB NULL DEFAULT NULL,
  `client_profile_image_ext` VARCHAR(10) NOT NULL,
  `client_copyright` VARCHAR(50) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'client_auto_login'
-- 
-- ---

DROP TABLE IF EXISTS `client_auto_login`;
		
CREATE TABLE `client_auto_login` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `status` INT(11) NOT NULL,
  `client_id` BIGINT(20) NOT NULL,
  `c_key` VARCHAR(40) NOT NULL,
  `expire` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'blog_entry_code_sequence'
-- 
-- ---

DROP TABLE IF EXISTS `blog_entry_code_sequence`;
		
CREATE TABLE `blog_entry_code_sequence` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `client_id` BIGINT(20) NOT NULL,
  `blog_id` BIGINT(20) NOT NULL,
  `sequence` BIGINT(20) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'blog_category_code_sequence'
-- 
-- ---

DROP TABLE IF EXISTS `blog_category_code_sequence`;
		
CREATE TABLE `blog_category_code_sequence` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `client_id` BIGINT(20) NOT NULL,
  `blog_id` BIGINT(20) NOT NULL,
  `sequence` BIGINT(20) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `blog` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_entry` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_entry` ADD FOREIGN KEY (blog_id) REFERENCES `blog` (`id`);
ALTER TABLE `blog_entry_image` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_entry_image` ADD FOREIGN KEY (blog_id) REFERENCES `blog` (`id`);
ALTER TABLE `blog_entry_image` ADD FOREIGN KEY (blog_entry_id) REFERENCES `blog_entry` (`id`);
ALTER TABLE `blog_category_master` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_category_master` ADD FOREIGN KEY (blog_id) REFERENCES `blog` (`id`);
ALTER TABLE `blog_category` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_category` ADD FOREIGN KEY (blog_id) REFERENCES `blog` (`id`);
ALTER TABLE `blog_category` ADD FOREIGN KEY (blog_entry_id) REFERENCES `blog_entry` (`id`);
ALTER TABLE `blog_category` ADD FOREIGN KEY (blog_category_master_id) REFERENCES `blog_category_master` (`id`);
ALTER TABLE `client_auto_login` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `client_auto_login` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_entry_code_sequence` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_entry_code_sequence` ADD FOREIGN KEY (blog_id) REFERENCES `blog` (`id`);
ALTER TABLE `blog_category_code_sequence` ADD FOREIGN KEY (client_id) REFERENCES `client` (`id`);
ALTER TABLE `blog_category_code_sequence` ADD FOREIGN KEY (blog_id) REFERENCES `blog` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `blog` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `blog_entry` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `blog_entry_image` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `blog_category_master` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `blog_category` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `client` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `client_auto_login` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `blog_entry_code_sequence` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `blog_category_code_sequence` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `blog` (`id`,`status`,`client_id`,`blog_title`,`blog_description`,`blog_keywords`,`blog_author_name`,`blog_header_image`,`blog_header_image_ext`,`blog_favicon_image`,`blog_favicon_image_ext`,`blog_favicon180_image`,`blog_favicon180_image_ext`,`blog_default_eye_catch_image`,`blog_default_eye_catch_image_ext`,`analytics_ua_code`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','','','','','','','','','','','','');
-- INSERT INTO `blog_entry` (`id`,`status`,`client_id`,`blog_id`,`blog_entry_code`,`title`,`contents`,`posting_date`,`seo_title`,`seo_description`,`seo_keywords`,`slug`,`eye_catch_image`,`eye_catch_image_ext`,`view_count`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','','','','','','','','','','','');
-- INSERT INTO `blog_entry_image` (`id`,`client_id`,`blog_id`,`blog_entry_id`,`image_code`,`image`,`image_ext`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `blog_category_master` (`id`,`status`,`client_id`,`blog_id`,`blog_category_code`,`blog_category_slug`,`category_name`,`sort_order`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','','','','');
-- INSERT INTO `blog_category` (`id`,`status`,`client_id`,`blog_id`,`blog_entry_id`,`blog_category_master_id`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `client` (`id`,`status`,`client_code`,`client_name`,`mail_address`,`password`,`client_profile`,`client_profile_image`,`client_profile_image_ext`,`client_copyright`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','','','','','','');
-- INSERT INTO `client_auto_login` (`id`,`status`,`client_id`,`c_key`,`expire`,`created_at`,`updated_at`) VALUES
-- ('','','','','','','');
-- INSERT INTO `blog_entry_code_sequence` (`id`,`client_id`,`blog_id`,`sequence`,`created_at`,`updated_at`) VALUES
-- ('','','','','','');
-- INSERT INTO `blog_category_code_sequence` (`id`,`client_id`,`blog_id`,`sequence`,`created_at`,`updated_at`) VALUES
-- ('','','','','','');

