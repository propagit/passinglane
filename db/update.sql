-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 04, 2014 at 09:05 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `passinglane`
--

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_type` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount_type` varchar(10) NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `valid_period` tinyint(4) NOT NULL DEFAULT '0',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: disabled, 1: actived',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`promotion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`promotion_id`, `promotion_type`, `name`, `description`, `discount_type`, `discount_value`, `valid_period`, `date_from`, `date_to`, `status`, `created_on`) VALUES
(4, 'cart', 'Queens birthday discount', '15% off the order', 'percentage', 15.00, 1, '2014-06-01', '2014-06-08', 1, '2014-06-04 03:16:20'),
(5, 'catalog', 'Test Promotion', 'Test discount on all products', 'percentage', 10.00, 0, '0000-00-00', '0000-00-00', 1, '2014-06-04 04:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_conditions`
--

CREATE TABLE `promotion_conditions` (
  `condition_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_id` int(11) NOT NULL,
  `condition_type` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `promotion_conditions`
--

INSERT INTO `promotion_conditions` (`condition_id`, `promotion_id`, `condition_type`, `value`) VALUES
(20, 5, 'product', 'a:157:{i:0;s:3:"149";i:1;s:3:"148";i:2;s:3:"153";i:3;s:3:"154";i:4;s:3:"155";i:5;s:2:"10";i:6;s:3:"105";i:7;s:3:"178";i:8;s:3:"102";i:9;s:2:"76";i:10;s:2:"75";i:11;s:3:"180";i:12;s:3:"121";i:13;s:2:"88";i:14;s:2:"89";i:15;s:2:"95";i:16;s:2:"43";i:17;s:3:"181";i:18;s:3:"124";i:19;s:3:"170";i:20;s:2:"14";i:21;s:3:"144";i:22;s:3:"140";i:23;s:3:"158";i:24;s:2:"35";i:25;s:2:"64";i:26;s:2:"15";i:27;s:2:"51";i:28;s:2:"83";i:29;s:2:"16";i:30;s:3:"125";i:31;s:3:"116";i:32;s:3:"169";i:33;s:2:"61";i:34;s:2:"58";i:35;s:2:"50";i:36;s:2:"90";i:37;s:2:"60";i:38;s:2:"45";i:39;s:2:"62";i:40;s:3:"146";i:41;s:3:"151";i:42;s:3:"194";i:43;s:2:"67";i:44;s:2:"66";i:45;s:2:"65";i:46;s:3:"100";i:47;s:3:"168";i:48;s:3:"172";i:49;s:2:"39";i:50;s:3:"119";i:51;s:3:"174";i:52;s:2:"97";i:53;s:2:"91";i:54;s:2:"94";i:55;s:3:"122";i:56;s:3:"109";i:57;s:2:"56";i:58;s:3:"104";i:59;s:2:"63";i:60;s:3:"129";i:61;s:3:"159";i:62;s:1:"3";i:63;s:1:"2";i:64;s:3:"135";i:65;s:2:"41";i:66;s:3:"182";i:67;s:2:"52";i:68;s:3:"184";i:69;s:2:"54";i:70;s:3:"171";i:71;s:2:"17";i:72;s:2:"18";i:73;s:3:"186";i:74;s:2:"77";i:75;s:2:"59";i:76;s:3:"163";i:77;s:3:"183";i:78;s:3:"127";i:79;s:3:"167";i:80;s:2:"20";i:81;s:3:"134";i:82;s:3:"165";i:83;s:2:"38";i:84;s:3:"117";i:85;s:2:"21";i:86;s:2:"80";i:87;s:2:"79";i:88;s:2:"68";i:89;s:2:"22";i:90;s:3:"157";i:91;s:3:"108";i:92;s:3:"142";i:93;s:2:"49";i:94;s:2:"81";i:95;s:2:"40";i:96;s:3:"110";i:97;s:3:"156";i:98;s:2:"78";i:99;s:3:"143";i:100;s:3:"139";i:101;s:2:"44";i:102;s:3:"185";i:103;s:3:"131";i:104;s:3:"130";i:105;s:2:"87";i:106;s:3:"123";i:107;s:2:"23";i:108;s:2:"96";i:109;s:2:"92";i:110;s:2:"24";i:111;s:2:"98";i:112;s:3:"118";i:113;s:3:"115";i:114;s:3:"176";i:115;s:3:"164";i:116;s:3:"120";i:117;s:2:"25";i:118;s:3:"137";i:119;s:3:"138";i:120;s:3:"132";i:121;s:3:"133";i:122;s:3:"147";i:123;s:3:"173";i:124;s:1:"9";i:125;s:3:"101";i:126;s:3:"160";i:127;s:2:"46";i:128;s:3:"106";i:129;s:2:"57";i:130;s:3:"162";i:131;s:2:"84";i:132;s:2:"47";i:133;s:2:"26";i:134;s:2:"85";i:135;s:2:"27";i:136;s:2:"93";i:137;s:3:"141";i:138;s:2:"86";i:139;s:3:"177";i:140;s:2:"42";i:141;s:2:"74";i:142;s:2:"73";i:143;s:2:"31";i:144;s:3:"107";i:145;s:3:"103";i:146;s:2:"53";i:147;s:3:"161";i:148;s:3:"136";i:149;s:3:"179";i:150;s:2:"34";i:151;s:3:"128";i:152;s:2:"82";i:153;s:2:"71";i:154;s:2:"70";i:155;s:2:"48";i:156;s:3:"166";}'),
(21, 4, 'order', '800'),
(23, 4, 'coupon', 'XYZ');

