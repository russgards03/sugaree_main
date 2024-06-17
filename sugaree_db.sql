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

DROP TABLE IF EXISTS `tbl_specialties`;
CREATE TABLE `tbl_specialties` (
  `specialty_id` int(11) NOT NULL AUTO_INCREMENT,
  `specialty_title` varchar(255) NOT NULL,
  `specialty_desc` text NOT NULL,
  `specialty_img` varchar(255) NOT NULL,
  `specialty_alt` varchar(255) NOT NULL,
  PRIMARY KEY (`specialty_id`)
);

INSERT INTO tbl_specialties(specialty_title,specialty_desc,specialty_img,specialty_alt) 
VALUES
  ("Pizza", "Originating from Italy but cherished worldwide, pizza is a universal symbol of comfort and culinary craftsmanship.", "img/Pizza.png", "img/Pizza.png"),
  ("Gelato", "Indulge in the exquisite world of gelato, a heavenly Italian frozen dessert that captivates with its luxurious texture and intense flavors. Unlike conventional ice cream, gelato offers a velvety-smooth experience that melts on your tongue, leaving a lingering sensation of creamy delight.", "img/Gelato.png", "img/Gelato.png"),
  ("Croissant", "Picture a golden-brown crescent-shaped delight, freshly baked and irresistibly fragrant, waiting to be savored.", "img/Croissant.png", "img/Croissant.png")
;

DROP TABLE IF EXISTS `tbl_images`;
CREATE TABLE `tbl_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_src` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `image_category` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
);

INSERT INTO `tbl_images` (`image_src`, `image_alt`, `image_category`)
VALUES
  ('img/crew1.jpg', 'Crew member 1', 'crew'),
  ('img/crew2.JPG', 'Crew member 2', 'crew'),
  ('img/crew3.JPG', 'Crew member 3', 'crew'),
  ('img/crew4.jpg', 'Crew member 4', 'crew'),
  ('img/crew5.jpg', 'Crew member 5', 'crew'),
  ('img/crew6.jpg', 'Crew member 6', 'crew'),
  ('img/crew7.jpg', 'Crew member 7', 'crew'),
  ('img/crew8.JPG', 'Crew member 8', 'crew'),
  ('img/place1.jpg', 'Place 1', 'place'),
  ('img/place2.jpg', 'Place 2', 'place'),
  ('img/food1.jpg', 'Food 1', 'food'),
  ('img/food2.jpg', 'Food 2', 'food')
;