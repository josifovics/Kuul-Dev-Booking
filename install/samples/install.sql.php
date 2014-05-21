<?php
/**
 * SQL installation import
 *
 * @package    Install
 * @category   Helper
 * @author     Slobodan <slobodan.josifovic@gmail.com> AND Chema <chema@open-classifieds.com>
 * @copyright  (c) 2009-2013 Open Classifieds Team
 * @license    GPL v3
 */

defined('SYSPATH') or exit('Install must be loaded from within index.php!');

mysqli_query($link,'SET NAMES '.core::request('DB_CHARSET'));
mysqli_query($link,"SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';");

/*
  ******************* COMMON TABLES ******************
*/

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."roles` (
  `id_role` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(245) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."roles_UK_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");


mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."access` (
  `id_access` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(10) unsigned NOT NULL,
  `access` varchar(100) NOT NULL,
  PRIMARY KEY (`id_access`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");


mysqli_query($link,"CREATE TABLE IF NOT EXISTS  `".core::request('TABLE_PREFIX')."users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(145) DEFAULT NULL,
  `seoname` varchar(145) DEFAULT NULL,
  `email` varchar(145) NOT NULL,
  `paypal_email` varchar(145) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `id_role` int(10) unsigned DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL,
  `logins` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_ip`  float DEFAULT NULL,
  `user_agent` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `token_created` datetime DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `hybridauth_provider_name` varchar(40) NULL DEFAULT NULL,
  `hybridauth_provider_uid` varchar(245) NULL DEFAULT NULL,
  `signature` varchar(245) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."users_UK_email` (`email`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."users_UK_token` (`token`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."users_UK_seoname` (`seoname`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."users_UK_provider_AND_uid` (`hybridauth_provider_name`,`hybridauth_provider_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS  `".core::request('TABLE_PREFIX')."categories` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(145) NOT NULL,
  `order` int(2) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_category_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_deep` int(2) unsigned NOT NULL DEFAULT '0',
  `seoname` varchar(145) NOT NULL,
  `description` varchar(255) NULL,
  PRIMARY KEY (`id_category`) USING BTREE,
  UNIQUE KEY `".core::request('TABLE_PREFIX')."categories_IK_seo_name` (`seoname`)
) ENGINE=InnoDB DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."locations` (
  `id_location` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `order` int(2) unsigned NOT NULL DEFAULT '0',
  `id_location_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_deep` int(2) unsigned NOT NULL DEFAULT '0',
  `seoname` varchar(145) NOT NULL,
  `description` varchar(255) NULL,
  PRIMARY KEY (`id_location`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."categories_UK_seoname` (`seoname`)
) ENGINE=InnoDB DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."visits` (
  `id_visit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned DEFAULT NULL,
  `id_user` int(10) unsigned DEFAULT NULL,
  `id_affiliate` int(10) unsigned DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` float DEFAULT NULL,
  PRIMARY KEY (`id_visit`),
  KEY `".core::request('TABLE_PREFIX')."visits_IK_id_user` (`id_user`),
  KEY `".core::request('TABLE_PREFIX')."visits_IK_id_product` (`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");


mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."config` ( 
  `group_name` VARCHAR(128)  NOT NULL, 
  `config_key` VARCHAR(128)  NOT NULL, 
  `config_value` TEXT,
   KEY `".core::request('TABLE_PREFIX')."config_IK_group_name_AND_config_key` (`group_name`,`config_key`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET')." ;");


mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."content` (
  `id_content` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) NOT NULL DEFAULT 'en_US',
  `order` int(2) unsigned NOT NULL DEFAULT '0',
  `title` varchar(145) NOT NULL,
  `seotitle` varchar(145) NOT NULL,
  `description` TEXT NULL,
  `from_email` varchar(145) NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` enum('page','email','help') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_content`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

/*
  ******************* PRODUCT TABLES ******************
*/

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."products` (
  `id_product` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned DEFAULT NULL,
  `id_category` int(10) unsigned DEFAULT NULL,
  `id_location` int(10) unsigned DEFAULT NULL,
  `title` varchar(145) NOT NULL,
  `seotitle` varchar(145) NOT NULL,
  `url_demo` varchar(145) NOT NULL,
  `description` text NOT NULL,
  `email_purchase_notes` text NOT NULL,
  `currency` char(3) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0',
  `price_offer` decimal(10,2) NOT NULL DEFAULT '0',
  `offer_valid` DATETIME  NULL,
  `featured` DATETIME  NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` DATETIME  NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `has_images` tinyint(1) NOT NULL DEFAULT '0',
  `confirm_file` varchar(40) DEFAULT NULL,
  `rate` FLOAT( 4, 2 ) NULL DEFAULT NULL,
  `affiliate_percentage` decimal(14,3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_product`),
  KEY `".core::request('TABLE_PREFIX')."products_IK_id_user` (`id_user`),
  KEY `".core::request('TABLE_PREFIX')."products_IK_id_category` (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS  `".core::request('TABLE_PREFIX')."posts` (
  `id_post` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `id_post_parent` int(10) unsigned NULL DEFAULT NULL,
  `id_forum` int(10) unsigned NULL DEFAULT NULL,
  `title` varchar(245) NOT NULL,
  `seotitle` varchar(245) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` float DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`) USING BTREE,
  UNIQUE KEY `".core::request('TABLE_PREFIX')."posts_UK_seotitle` (`seotitle`),
  KEY `".core::request('TABLE_PREFIX')."posts_IK_id_user` (`id_user`),
  KEY `".core::request('TABLE_PREFIX')."posts_IK_id_post_parent` (`id_post_parent`),
  KEY `".core::request('TABLE_PREFIX')."posts_IK_id_forum` (`id_forum`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");


mysqli_query($link,"CREATE TABLE IF NOT EXISTS  `".core::request('TABLE_PREFIX')."forums` (
  `id_forum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(145) NOT NULL,
  `order` int(2) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_forum_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_deep` int(2) unsigned NOT NULL DEFAULT '0',
  `seoname` varchar(145) NOT NULL,
  `description` varchar(255) NULL,
  PRIMARY KEY (`id_forum`) USING BTREE,
  UNIQUE KEY `".core::request('TABLE_PREFIX')."forums_IK_seo_name` (`seoname`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."reviews` (
  `id_review` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `id_order` int(10) unsigned NOT NULL,
  `id_product` int(10) unsigned NOT NULL,
  `rate` int(2) unsigned NOT NULL DEFAULT '0',
  `description` varchar(1000) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` float DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_review`) USING BTREE,
  KEY `".core::request('TABLE_PREFIX')."reviews_IK_id_user` (`id_user`),
  KEY `".core::request('TABLE_PREFIX')."reviews_IK_id_order` (`id_order`),
  KEY `".core::request('TABLE_PREFIX')."reviews_IK_id_product` (`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."coupons` (
  `id_coupon` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned NULL DEFAULT NULL,
  `name` varchar(145) NOT NULL,
  `notes` varchar(245) DEFAULT NULL,
  `discount_amount` decimal(14,3) NOT NULL DEFAULT '0',
  `discount_percentage` decimal(14,3) NOT NULL DEFAULT '0',
  `number_coupons` int(10) DEFAULT NULL,
  `valid_date` DATETIME  NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_coupon`),
  UNIQUE KEY `".core::request('TABLE_PREFIX')."coupons_UK_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS ".core::request('TABLE_PREFIX')."affiliates (
    id_affiliate int(10) unsigned NOT NULL AUTO_INCREMENT,
    id_user int(10) unsigned NOT NULL,
    id_order int(10) unsigned NOT NULL,
    id_order_payment int(10) unsigned,
    id_product int(10) unsigned NOT NULL,
    percentage decimal(14,3) NOT NULL DEFAULT '0',
    amount decimal(14,3) NOT NULL DEFAULT '0',
    currency char(3) NOT NULL,
    created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_to_pay datetime DEFAULT NULL,
    date_paid datetime DEFAULT NULL,
    ip_address float DEFAULT NULL,
    status tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (id_affiliate) USING BTREE,
    KEY ".core::request('TABLE_PREFIX')."affiliates_IK_id_user (id_user),
    KEY ".core::request('TABLE_PREFIX')."affiliates_IK_id_order (id_order),
    KEY ".core::request('TABLE_PREFIX')."affiliates_IK_id_product (id_product)
    ) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

/*
  ******************* BOOKING TABLES ******************
*/
mysqli_query($link,"CREATE TABLE IF NOT EXISTS  `".core::request('TABLE_PREFIX')."orders` (
  `id_order` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `id_product` int(10) unsigned NULL,
  `id_coupon` int(10) unsigned NULL,
  `paymethod` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `currency` char(3) NOT NULL,
  `amount` decimal(14,3) NOT NULL DEFAULT '0',
  `ip_address` float DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `pay_date` DATETIME  NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notes` VARCHAR( 245 ) NULL DEFAULT NULL,
  PRIMARY KEY (`id_order`),
  KEY `".core::request('TABLE_PREFIX')."orders_IK_id_user` (`id_user`),
  KEY `".core::request('TABLE_PREFIX')."orders_IK_status` (`status`)
)ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");

mysqli_query($link,"CREATE TABLE IF NOT EXISTS `".core::request('TABLE_PREFIX')."slots` (
  `id_slot` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned NOT NULL,
  `spaces` int(10) unsigned DEFAULT NULL,
  `extra_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_slot`) USING BTREE,
  KEY `".core::request('TABLE_PREFIX')."slots_IK_id_product` (`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=".core::request('DB_CHARSET').";");


/**
 * add basic content like emails
 */
mysqli_query($link,"INSERT INTO `".core::request('TABLE_PREFIX')."content` (`order`, `title`, `seotitle`, `description`, `from_email`, `type`, `status`) 
    VALUES
(0, 'Change Password [SITE.NAME]', 'auth.remember', 'Hello [USER.NAME],\n\nFollow this link  [URL.QL]\n\nThanks!!', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'Welcome to [SITE.NAME]!', 'auth.register', 'Welcome [USER.NAME],\n\nWe are really happy that you have joined us! [URL.QL]\n\nRemember your user details:\nEmail: [USER.EMAIL]\nPassword: [USER.PWD]\n\nWe do not have your original password anymore.\n\nRegards!', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, '[EMAIL.SENDER] wants to contact you!', 'contactadmin', 'Hello Admin,\n\n [EMAIL.SENDER]: [EMAIL.FROM], have a message for you:\n\n [EMAIL.BODY] \n\n Regards!', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'Hello [USER.NAME]!', 'user.new', 'Welcome to [SITE.NAME]. \n\n We are really happy that you have joined us! , \n\n you can log in with you email : [USER.EMAIL], \n\n with password: [USER.PWD]. Password is generated for you, to change it you can visit this link [URL.PWCH]. \n\n Thank you for trusting us! \n\n Regards!', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'New reply: [TITLE]', 'new.reply', '[URL.QL]\n\n[DESCRIPTION]', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'Purchase Receipt for [PRODUCT.TITLE]', 'new.sale', '==== Order Details ====\nDate: [DATE]\nOrder ID: [ORDER.ID]\nName: [USER.NAME]\nEmail: [USER.EMAIL]\n\n==== Your Order ====\nProduct: [PRODUCT.TITLE]\nProduct Price: [PRODUCT.PRICE]\n\n[PRODUCT.NOTES][DOWNLOAD][EXPIRE][LICENSE]', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'Product updated [TITLE]', 'product.update', '==== Update Details ====\nVersion: [VERSION]\nProduct name: [TITLE][DOWNLOAD][EXPIRE]\n\n==== Product Page ====\n[URL.PRODUCT]', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'Ticket assigned to you: [TITLE]', 'assignagent', '[URL.QL]\n\n[DESCRIPTION]', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'New review for [TITLE] [RATE]', 'reviewproduct', '[URL.QL]\n\n[RATE]\n\n[DESCRIPTION]', '".core::request('ADMIN_EMAIL')."', 'email', 1),
(0, 'New support ticket created `[TITLE]`', 'newticket', 'We have received your support inquiry. We will try to answer you within the next 24 working hours, thank you for your patience.\n\n[URL.QL]', '".core::request('ADMIN_EMAIL')."', 'email', 1)
(0, 'Congratulations! New affiliate commission [AMOUNT]', 'affiliatecommission', 'Congratulations!,\n\n We just registered a sale from your affiliate link for the amount of [AMOUNT], check them all at your affiliate panel [URL.AFF]. \n\n Thanks for using our affiliate program!', '".core::request('ADMIN_EMAIL')."', 'email', 1)
");

/**
 * Access
 */
mysqli_query($link,"INSERT INTO `".core::request('TABLE_PREFIX')."roles` (`id_role`, `name`, `description`) VALUES (1, 'user', 'Normal user'), (5, 'translator', 'User + Translations'), (10, 'admin', 'Full access');");
mysqli_query($link,"INSERT INTO `".core::request('TABLE_PREFIX')."access` (`id_access`, `id_role`, `access`) VALUES 
            (1, 10, '*.*'),
            (2, 1, 'profile.*'),(3, 1, 'stats.user'),(8, 1, 'support.*'),
            (4, 5, 'translations.*'),(5, 5, 'profile.*'),(6, 5, 'stats.user'),(7, 5, 'content.*');");

/**
 * Create user God/Admin 
 */
$password = hash_hmac('sha256', core::request('ADMIN_PWD'), install::$hash_key);
mysqli_query($link,"INSERT INTO `".core::request('TABLE_PREFIX')."users` (`id_user`, `name`, `seoname`, `email`, `password`, `status`, `id_role`) 
VALUES (1, 'admin', 'admin', '".core::request('ADMIN_EMAIL')."', '$password', 1, 10)");

/**
 * Configs to make the app work
 * @todo refactor to use same coding standard
 * @todo widgets examples? at least at sidebar, rss, text advert, pages, locations...
 *
 */
mysqli_query($link,"INSERT INTO `".core::request('TABLE_PREFIX')."config` (`group_name`, `config_key`, `config_value`) VALUES
('sitemap', 'expires', '43200'),
('sitemap', 'on_post', 0),
('appearance', 'theme', 'default'),
('appearance', 'theme_mobile', ''),
('appearance', 'allow_query_theme', 0),
('i18n', 'charset', 'utf-8'),
('i18n', 'timezone', '".core::request('TIMEZONE')."'),
('i18n', 'locale', '".core::request('LANGUAGE')."'),
('i18n', 'allow_query_language', 0),
('payment', 'thanks_page', ''),
('payment', 'sandbox', 0),
('payment', 'paypal_account', ''),
('payment', 'paymill_private', ''),
('payment', 'paymill_public', ''),
('payment', 'stripe_private', ''),
('payment', 'stripe_public', ''),
('payment', 'stripe_address', '0'),
('payment', 'alternative', ''),
('payment', 'bitpay_apikey', ''),
('general', 'number_format', '%n'),
('general', 'date_format', 'd-m-y'),
('general', 'base_url', '".core::request('SITE_URL')."'),
('general', 'maintenance', 0),
('general', 'analytics', ''),
('general', 'translate', ''),
('general', 'menu', ''),
('general', 'feed_elements', '20'),
('general', 'site_name', '".core::request('SITE_NAME')."'),
('general', 'site_description', ''),
('general', 'products_per_page', '12'),
('general', 'alert_terms', ''),
('general', 'landing_page', ''),
('general', 'blog', '0'),
('general', 'blog_disqus', ''),
('general', 'faq', '0'),
('general', 'faq_disqus', ''),
('general', 'forums', '0'),
('general', 'minify', 0),
('general', 'sort_by', 'published-asc'),
('image', 'allowed_formats', 'jpeg,jpg,png,'),
('image', 'max_image_size', '5'),
('image', 'height', ''),
('image', 'width', '1200'),
('image', 'height_thumb', '200'),
('image', 'width_thumb', '200'),
('image', 'quality', '90'),
('image', 'watermark', '0'),
('image', 'watermark_path', ''),
('image', 'watermark_position', '0'),
('product', 'formats', 'txt,doc,docx,pdf,tif,tiff,gif,psd,raw,wav,aif,mp3,rm,ram,wma,ogg,avi,wmv,mov,mp4,mkv,jpeg,jpg,png,zip,7z,7zip,rar,rar5,gzip,'),
('product', 'max_size', '5'),
('product', 'num_images', '5'),
('product', 'products_in_home', '0'),
('product', 'disqus', ''),
('product', 'related', '5'),
('product', 'reviews', '0'),
('product', 'demo_theme', 'yeti'),
('product', 'demo_resize', '1'),
('product', 'qr_code', 0),
('product', 'location', '1'),
('email', 'notify_email', '".core::request('ADMIN_EMAIL')."'),
('email', 'smtp_active', 0),
('email', 'new_sale_notify', 0),
('email', 'smtp_host', ''),
('email', 'smtp_port', ''),
('email', 'smtp_auth', 0),
('email', 'smtp_ssl', 0),
('email', 'smtp_user', ''),
('email', 'smtp_pass', ''),
('affiliate', 'active', '0'),
('affiliate', 'cookie', '90'),
('affiliate', 'payment_days', '30'),
('affiliate', 'payment_min', '50'),
('affiliate', 'tos', ''),
('social', 'config', '{\"debug_mode\":\"0\",\"providers\":{\"OpenID\":{\"enabled\":\"1\"},\"Yahoo\":{\"enabled\":\"0\",\"keys\":{\"id\":\"\",\"secret\":\"\"}},
\"AOL\":{\"enabled\":\"1\"},\"Google\":{\"enabled\":\"0\",\"keys\":{\"id\":\"\",\"secret\":\"\"}},\"Facebook\":{\"enabled\":\"0\",\"keys\":{\"id\":\"\",\"secret\":\"\"}},
\"Twitter\":{\"enabled\":\"0\",\"keys\":{\"key\":\"\",\"secret\":\"\"}},\"Live\":{\"enabled\":\"0\",\"keys\":{\"id\":\"\",\"secret\":\"\"}},\"MySpace\":{\"enabled\":\"0\",\"keys\":{\"key\":\"\",\"secret\":\"\"}},
\"LinkedIn\":{\"enabled\":\"0\",\"keys\":{\"key\":\"\",\"secret\":\"\"}},\"Foursquare\":{\"enabled\":\"0\",\"keys\":{\"id\":\"\",\"secret\":\"\"}}},\"base_url\":\"\",\"debug_file\":\"\"}');");


//base category
mysqli_query($link,"INSERT INTO `".core::request('TABLE_PREFIX')."categories` 
  (`id_category` ,`name` ,`order` ,`id_category_parent` ,`parent_deep` ,`seoname` ,`description` )
VALUES (1, 'Home category', 0 , 0, 0, 'all', 'root category');");

 


mysqli_close($link);