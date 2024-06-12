CREATE DATABASE IF NOT EXISTS db_sugaree;
USE db_sugaree;
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(8) unsigned NOT NULL auto_increment, 
  `user_firstname` varchar(180) NOT NULL default '',
  `user_lastname` varchar(180) NOT NULL default '',
  `user_name` varchar(180) NOT NULL default '',
  `user_email` varchar(180) NOT NULL default '',
  `user_password` varchar(180) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
);

DROP TABLE IF EXISTS `tbl_dishes`;
CREATE TABLE `tbl_dishes` (
  `dish_id` int(11) NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(255) NOT NULL,
  `dish_img` varchar(255) NOT NULL,
  `dish_price` int(255) NOT NULL,
  PRIMARY KEY (`dish_id`)
);

DROP TABLE IF EXISTS `tbl_specialites`;
CREATE TABLE `tbl_specialties` (
  `specialty_id` int(11) NOT NULL AUTO_INCREMENT,
  `specialty_title` varchar(255) NOT NULL,
  `specialty_desc` text NOT NULL,
  `specialty_img` varchar(255) NOT NULL,
  `specialty_alt` varchar(255) NOT NULL,
  PRIMARY KEY (`specialty_id`)
);