-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: mysql01
-- Generation Time: Nov 10, 2017 at 01:24 PM
-- Server version: 5.6.36-82.1-log
-- PHP Version: 5.4.45-1~dotdeb+7.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `3444-syplotest`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdetails`
--

CREATE TABLE IF NOT EXISTS `accountdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `secretno` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT '0=debitcard,1=bank,2=paypal',
  `status` varchar(255) NOT NULL COMMENT '0=not,1=active',
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `mobile`, `image`, `status`, `timestamp`) VALUES
(1, 'KARIM ', 'syplo@gmail.com', '123', '2147483644', 'logo.png', 'admin', '2017-03-15 16:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `another_service`
--

CREATE TABLE IF NOT EXISTS `another_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `sub_category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `pricetype` varchar(25) NOT NULL COMMENT '0=perhour, 1=wholeday',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `another_service`
--

INSERT INTO `another_service` (`id`, `user_id`, `category`, `sub_category`, `price`, `pricetype`, `create_at`, `update_at`) VALUES
(1, 8, 'NAGLAR', 'a', 0, '', '2017-08-30 10:24:59', ''),
(2, 22, 'FRISOR', 'Tr\\345dning', 1, '1', '2017-09-02 19:15:02', '2017-09-02 21:23'),
(3, 37, 'FRANSAR', 'extra serve', 0, '', '2017-09-16 10:21:51', ''),
(4, 37, 'FRISOR', 'extra serv 2', 0, '', '2017-09-16 10:22:16', ''),
(5, 37, 'MASSAGE', 'extra serv 3', 0, '', '2017-09-16 10:22:40', ''),
(6, 37, 'NAGLAR', 'extra@serv 4', 0, '', '2017-09-16 10:22:56', ''),
(7, 37, 'SMINKNING', 'extra@serv 3', 0, '', '2017-09-16 10:23:16', ''),
(8, 37, 'VAXNING', 'extra@serv 4', 0, '', '2017-09-16 10:23:40', ''),
(9, 48, 'FRISOR', 'new', 0, '', '2017-09-25 07:31:13', ''),
(10, 48, 'FRANSAR', 'pandya service', 1, '1', '2017-09-25 09:10:21', ''),
(11, 69, 'FRANSAR', 'jqcoehe', 0, '', '2017-10-16 13:08:37', ''),
(12, 72, 'FRANSAR', 'Spectrix', 50, '1', '2017-10-17 05:21:06', ''),
(13, 37, 'FRANSAR', 'Other', 21, '1', '2017-10-17 08:49:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=certificate 2= work',
  `type` varchar(100) NOT NULL,
  `approve_status` int(10) NOT NULL COMMENT '0=not, 1= approved',
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `user_id`, `image`, `about`, `status`, `type`, `approve_status`, `creat_at`) VALUES
(1, 4, 'Mib6p9wTScreenshot_20170816-154845.png', '', 1, 'application/octet-stream', 0, '2017-08-30 09:59:33'),
(2, 4, 'z6WRFWUDIMG_20170830_151834.jpg', '', 2, 'application/octet-stream', 1, '2017-08-30 09:59:33'),
(5, 9, 'nhxbw5Apimage.jpg', 'My certificates', 1, 'image/jpeg', 0, '2017-08-30 10:42:14'),
(6, 9, 'Gn3PGHYjimage.jpg', 'My certificates', 1, 'image/jpeg', 0, '2017-08-30 10:42:14'),
(7, 9, 'pwvsNYS3image.jpg', '', 2, 'image/jpeg', 1, '2017-08-30 10:42:14'),
(8, 9, 'e2O7JrT7image.jpg', '', 2, 'image/jpeg', 1, '2017-08-30 10:42:14'),
(9, 9, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18251679_736359229858454_8148102501577523200_n.jpg', '', 2, '', 1, '2017-08-30 10:42:14'),
(10, 9, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18013143_1923593901251465_4954720452153966592_n.jpg', '', 2, '', 1, '2017-08-30 10:42:14'),
(11, 9, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18096084_447620215572759_3805351053004636160_n.jpg', '', 2, '', 1, '2017-08-30 10:42:14'),
(12, 12, 'kZ1lZpC7image.jpg', 'My certificates', 1, 'image/jpeg', 0, '2017-08-30 11:10:00'),
(13, 12, 'UA2reyNqimage.jpg', 'My certificates', 1, 'image/jpeg', 0, '2017-08-30 11:10:00'),
(16, 12, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18095751_149116925623186_7377906597869125632_n.jpg', '', 2, '', 1, '2017-08-30 11:10:00'),
(17, 12, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18096084_447620215572759_3805351053004636160_n.jpg', '', 2, '', 1, '2017-08-30 11:10:00'),
(18, 14, 'n9g2GqPUimage.jpg', 'Not now', 1, 'image/jpeg', 0, '2017-08-30 12:46:46'),
(19, 14, 'FoDJY5aaimage.jpg', 'Not now', 1, 'image/jpeg', 0, '2017-08-30 12:46:46'),
(20, 14, 'F4a4hhmeimage.jpg', '', 2, 'image/jpeg', 1, '2017-08-30 12:46:46'),
(21, 14, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/17818483_247636228975625_8135662764459819008_n.jpg', '', 2, '', 1, '2017-08-30 12:46:46'),
(22, 14, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/17817958_439077259777071_3334212163043590144_n.jpg', '', 2, '', 1, '2017-08-30 12:46:46'),
(23, 14, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/17817682_1447461228886846_3952181914542014464_n.jpg', '', 2, '', 1, '2017-08-30 12:46:46'),
(24, 22, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/20066710_915693598569654_2750695788790153216_n.jpg', '', 2, '', 1, '2017-09-02 19:15:48'),
(25, 22, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/20180870_702732049922701_3024809625347162112_n.jpg', '', 2, '', 1, '2017-09-02 19:15:48'),
(26, 22, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19986088_830559440435990_6432402567363297280_n.jpg', '', 2, '', 1, '2017-09-02 19:15:48'),
(28, 22, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/20180870_702732049922701_3024809625347162112_n.jpg', '', 2, '', 1, '2017-09-02 19:16:06'),
(30, 30, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18251538_217603792070827_8434084543954157568_n.jpg', '', 2, '', 1, '2017-09-05 05:51:47'),
(31, 30, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18251538_217603792070827_8434084543954157568_n.jpg', '', 2, '', 1, '2017-09-05 05:51:47'),
(32, 32, 'jyXoxa5ximage.jpg', 'Shree certificates', 1, 'image/jpeg', 0, '2017-09-16 08:38:55'),
(33, 32, '4e0StnV2image.jpg', 'Shree certificates', 1, 'image/jpeg', 0, '2017-09-16 08:38:55'),
(34, 32, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/20582635_1424300057651697_8897972665831129088_n.jpg', '', 2, '', 1, '2017-09-16 08:38:55'),
(35, 32, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18013143_1923593901251465_4954720452153966592_n.jpg', '', 2, '', 1, '2017-09-16 08:38:55'),
(36, 32, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18095751_149116925623186_7377906597869125632_n.jpg', '', 2, '', 1, '2017-09-16 08:38:55'),
(37, 32, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/17817682_1447461228886846_3952181914542014464_n.jpg', '', 2, '', 1, '2017-09-16 08:38:55'),
(38, 32, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/17818155_159412801248959_1684752641852178432_n.jpg', '', 2, '', 1, '2017-09-16 08:38:55'),
(39, 36, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18251386_1848410205409618_4703442333939531776_n.jpg', '', 2, '', 1, '2017-09-16 10:19:54'),
(40, 36, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/20590271_106341623394858_1425403790462287872_n.jpg', '', 2, '', 1, '2017-09-16 10:19:54'),
(41, 36, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18252196_658892000987589_2590472119712219136_n.jpg', '', 2, '', 1, '2017-09-16 10:19:54'),
(42, 36, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18252249_1903705043198042_807034980667490304_n.jpg', '', 2, '', 1, '2017-09-16 10:19:54'),
(43, 36, 'https://scontent.cdninstagram.com/t51.2885-15/s320x320/e35/18253007_1755354201423344_6070826137049628672_n.jpg', '', 2, '', 1, '2017-09-16 10:19:54'),
(45, 41, 'I5L3bNsmtmp8327072464547515699.jpeg', '', 2, 'application/octet-stream', 1, '2017-09-18 06:54:01'),
(46, 48, 'DQRRzgidimage.jpg', '', 1, 'image/jpeg', 0, '2017-09-25 09:19:03'),
(47, 48, 'k5wPPOcvimage.jpg', '', 2, 'image/jpeg', 1, '2017-09-25 09:19:03'),
(48, 54, '2y42BEINIMG_20170929_141134.jpg', '', 1, 'application/octet-stream', 0, '2017-10-04 06:26:07'),
(49, 54, 'iXT8T0vctemp.jpg', '', 2, 'application/octet-stream', 1, '2017-10-04 06:26:07'),
(50, 41, 'OYkjKDOkprofileimg.jpg', '', 1, 'application/octet-stream', 0, '2017-10-10 08:58:03'),
(51, 57, 'M5xzQhm7tmp3556657824905440912.jpeg', '', 1, 'application/octet-stream', 0, '2017-10-10 09:51:05'),
(52, 57, 'u9DpbTZxtmp413118576464537718.jpeg', '', 2, 'application/octet-stream', 1, '2017-10-10 09:51:05'),
(53, 58, 'PekRcb2Ttmp3556657824905440912.jpeg', '', 1, 'application/octet-stream', 0, '2017-10-10 09:55:25'),
(54, 70, '1p2yneKpIMG_20171016_174506.jpg', '', 1, 'application/octet-stream', 0, '2017-10-16 13:15:11'),
(55, 72, 'F5uFzAnBtmp1055771334511455162.jpeg', '', 1, 'application/octet-stream', 0, '2017-10-17 05:21:49'),
(56, 72, '0V33VWRrFB_IMG_1495125426603.jpg', '', 2, 'application/octet-stream', 1, '2017-10-17 05:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `check`
--

CREATE TABLE IF NOT EXISTS `check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commissionsetting`
--

CREATE TABLE IF NOT EXISTS `commissionsetting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commission` double NOT NULL,
  `type` int(10) NOT NULL COMMENT '0=bronz,1=silver,2=gold',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `commissionsetting`
--

INSERT INTO `commissionsetting` (`id`, `commission`, `type`, `update_at`) VALUES
(1, 15, 0, '2017-08-21 16:04:00'),
(2, 10, 1, '2017-08-21 16:05:00'),
(3, 3, 2, '2017-08-21 16:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE IF NOT EXISTS `customer_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `card_no` int(20) NOT NULL,
  `login` varchar(255) NOT NULL,
  `expiredate` varchar(255) NOT NULL,
  `cvvno` int(11) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT '0=creditcard,1=paypal',
  `secret_no` int(11) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `type` int(10) NOT NULL COMMENT '0=% 1=currency',
  `discount_type` int(22) NOT NULL COMMENT '0=General,1=Referral,1=Sponsor',
  `status` int(10) NOT NULL COMMENT '0=invalid,1=valid',
  `expiredate` varchar(50) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `code`, `discount`, `type`, `discount_type`, `status`, `expiredate`, `creat_at`, `update_at`) VALUES
(1, '', '10', 1, 1, 1, '', '2017-06-15 10:23:35', '2017-08-04 12:44'),
(2, 'FRAN52', '10', 0, 0, 0, '2017-06-30', '2017-06-22 08:52:41', ''),
(3, 'START10', '10', 0, 0, 1, '2017-12-31', '2017-07-02 20:18:54', '');

-- --------------------------------------------------------

--
-- Table structure for table `freelancher_availability`
--

CREATE TABLE IF NOT EXISTS `freelancher_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(22) NOT NULL,
  `start_time` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dates` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `show_position` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '0=Visible, 1=On break',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `freelancher_availability`
--

INSERT INTO `freelancher_availability` (`id`, `user_id`, `start_time`, `end_time`, `dates`, `show_position`, `created_at`) VALUES
(1, 12, '16:59', '16:59', '2017/10/25', '1', '2017-09-04 11:28:08'),
(2, 41, '06:30 ', '19:30 ', '2017/10/10', '0', '2017-10-10 07:23:53'),
(3, 41, '06:30 ', '19:30 ', '2017/10/10', '0', '2017-10-10 07:24:02'),
(4, 41, '06:30 ', '19:30 ', '2017/10/10', '1', '2017-10-10 07:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `geographicalarea`
--

CREATE TABLE IF NOT EXISTS `geographicalarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(255) NOT NULL,
  `timesatmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `geographicalarea`
--

INSERT INTO `geographicalarea` (`id`, `area`, `timesatmp`) VALUES
(1, 'Botkyrka', '2017-03-31 06:49:50'),
(2, 'Danderyd', '2017-03-31 06:49:50'),
(3, 'Ekerö', '2017-03-31 06:49:50'),
(4, 'Haninge', '2017-03-31 06:49:50'),
(5, 'Huddinge', '2017-03-31 06:49:50'),
(6, 'Järfälla', '2017-03-31 06:49:50'),
(7, 'Lidingö', '2017-03-31 06:49:50'),
(8, 'Nacka', '2017-03-31 06:49:50'),
(9, 'Norrtälje', '2017-03-31 06:49:50'),
(10, 'Nykvarn', '2017-03-31 06:49:50'),
(11, 'Nynäshamn', '2017-03-31 06:49:50'),
(12, 'Salem', '2017-03-31 06:49:50'),
(13, 'Sigtuna', '2017-03-31 06:49:50'),
(14, 'Sollentuna', '2017-03-31 06:49:50'),
(15, 'Solna', '2017-03-31 06:49:50'),
(16, 'Stockholm', '2017-03-31 06:49:50'),
(17, 'Bromma', '2017-03-31 06:49:50'),
(18, 'Enskede / Årsta / Skarpnäck', '2017-03-31 06:49:50'),
(19, 'Hägersten / Liljeholmen', '2017-03-31 06:49:50'),
(20, 'Katarina / Sofia', '2017-03-31 06:49:50'),
(21, 'Kista / Hässelby / vällingby / Spånga', '2017-03-31 06:49:50'),
(22, 'Kungsholmen / Essingen', '2017-03-31 06:49:50'),
(23, 'Maria / Gamla stan / Högalid', '2017-03-31 06:49:50'),
(24, 'Skärholmen / Bredäng', '2017-03-31 06:49:50'),
(25, 'Vasastan / Norrmalm', '2017-03-31 06:49:50'),
(26, 'Älvsjö / Farsta / Vantör', '2017-03-31 06:49:50'),
(27, 'Östermalm / Djurgården', '2017-03-31 06:49:50'),
(28, 'Sundbyberg', '2017-03-31 06:49:50'),
(29, 'Södertälje', '2017-03-31 06:49:50'),
(30, 'Tyresö', '2017-03-31 06:49:50'),
(31, 'Täby', '2017-03-31 06:52:24'),
(32, 'Upplands-Bro', '2017-03-31 06:52:24'),
(33, 'Upplands Väsby', '2017-03-31 06:52:24'),
(34, 'Vallentuna', '2017-03-31 06:52:24'),
(35, 'Vaxholm', '2017-03-31 06:52:24'),
(36, 'Värmdö', '2017-03-31 06:52:24'),
(37, 'Österåker', '2017-03-31 06:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

CREATE TABLE IF NOT EXISTS `notification_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `isSms` int(11) NOT NULL COMMENT '0=off,1=On;',
  `isEmail` int(11) NOT NULL COMMENT '0=off,1=On;',
  `user_type` int(11) NOT NULL COMMENT '1=individual,2=customer,3=company',
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `notification_setting`
--

INSERT INTO `notification_setting` (`id`, `user_id`, `isSms`, `isEmail`, `user_type`, `creat_at`) VALUES
(1, 1, 1, 1, 2, '2017-08-30 09:40:19'),
(2, 2, 1, 1, 2, '2017-08-30 09:50:17'),
(3, 3, 1, 1, 2, '2017-08-30 09:56:46'),
(4, 4, 1, 1, 1, '2017-08-30 09:59:58'),
(5, 7, 1, 1, 1, '2017-08-30 10:17:34'),
(6, 9, 1, 1, 1, '2017-08-30 10:43:01'),
(7, 10, 1, 1, 3, '2017-08-30 10:44:11'),
(8, 12, 1, 1, 1, '2017-08-30 11:10:41'),
(9, 13, 1, 1, 2, '2017-08-30 12:18:40'),
(10, 14, 1, 1, 4, '2017-08-30 12:47:39'),
(11, 15, 1, 1, 2, '2017-08-30 13:17:46'),
(12, 16, 1, 1, 1, '2017-08-30 13:22:00'),
(13, 17, 1, 1, 2, '2017-08-31 07:09:18'),
(14, 18, 1, 1, 1, '2017-08-31 09:03:35'),
(15, 19, 1, 1, 1, '2017-08-31 09:04:59'),
(16, 21, 1, 1, 2, '2017-08-31 11:24:36'),
(17, 22, 1, 1, 1, '2017-09-02 19:16:31'),
(18, 23, 1, 1, 2, '2017-09-02 19:16:58'),
(19, 24, 1, 1, 1, '2017-09-02 19:18:58'),
(20, 26, 1, 1, 2, '2017-09-04 08:31:02'),
(21, 27, 1, 1, 2, '2017-09-04 08:31:24'),
(22, 30, 1, 1, 1, '2017-09-05 05:23:36'),
(23, 32, 1, 1, 1, '2017-09-16 08:43:48'),
(24, 33, 1, 1, 2, '2017-09-16 10:11:01'),
(25, 34, 1, 1, 2, '2017-09-16 10:12:22'),
(26, 35, 1, 1, 1, '2017-09-16 10:17:17'),
(27, 36, 1, 1, 1, '2017-09-16 10:20:08'),
(28, 38, 1, 1, 2, '2017-09-16 11:30:57'),
(29, 40, 1, 1, 2, '2017-09-18 06:50:05'),
(30, 41, 1, 1, 1, '2017-09-18 06:54:44'),
(31, 43, 1, 1, 1, '2017-09-22 11:57:42'),
(32, 44, 1, 1, 3, '2017-09-22 12:00:12'),
(33, 45, 1, 1, 4, '2017-09-22 12:03:21'),
(34, 47, 1, 1, 2, '2017-09-25 07:16:47'),
(35, 48, 1, 1, 1, '2017-09-25 09:19:55'),
(36, 51, 1, 1, 2, '2017-10-03 11:42:17'),
(37, 52, 1, 1, 2, '2017-10-04 06:13:39'),
(38, 53, 1, 1, 2, '2017-10-04 06:17:56'),
(39, 54, 1, 1, 1, '2017-10-04 06:26:41'),
(40, 55, 1, 1, 2, '2017-10-09 12:31:31'),
(41, 57, 1, 1, 1, '2017-10-10 09:51:32'),
(42, 58, 1, 1, 1, '2017-10-10 09:55:50'),
(43, 59, 1, 1, 3, '2017-10-10 09:57:08'),
(44, 60, 1, 1, 4, '2017-10-10 10:24:53'),
(45, 61, 1, 1, 2, '2017-10-10 11:18:15'),
(46, 62, 1, 1, 2, '2017-10-11 09:49:54'),
(47, 63, 1, 1, 2, '2017-10-13 20:42:28'),
(48, 64, 1, 1, 1, '2017-10-14 20:42:59'),
(49, 65, 1, 1, 2, '2017-10-16 11:41:34'),
(50, 66, 1, 1, 1, '2017-10-16 11:53:17'),
(51, 68, 1, 1, 2, '2017-10-16 12:51:56'),
(52, 70, 1, 1, 1, '2017-10-16 13:15:35'),
(53, 71, 1, 1, 2, '2017-10-17 05:19:08'),
(54, 72, 1, 1, 1, '2017-10-17 05:22:26'),
(55, 37, 1, 1, 1, '2017-10-17 08:51:48'),
(56, 73, 1, 1, 2, '2017-10-17 08:52:55'),
(57, 76, 1, 1, 2, '2017-10-23 11:22:08'),
(58, 77, 1, 1, 3, '2017-11-05 18:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `address_type` int(10) NOT NULL COMMENT '0=providerAdd,1=customerAdd,2=both',
  `address` varchar(255) NOT NULL,
  `lat` varchar(55) NOT NULL,
  `lng` varchar(55) NOT NULL,
  `approve_status` int(10) NOT NULL COMMENT '0=no, 1=yes,2=reject',
  `provider_cancelPolicy` int(10) NOT NULL COMMENT '0=moderate,1=flexible,2=strict, ',
  `order_status` int(10) NOT NULL COMMENT '0=not, 1=done',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `provider_id`, `customer_id`, `date`, `time`, `address_type`, `address`, `lat`, `lng`, `approve_status`, `provider_cancelPolicy`, `order_status`, `create_at`) VALUES
(1, 4, 2, '2017-08-30', '15:30', 1, '576, Mahatma Gandhi Road\nSouth Tukoganj\nIndore, Madhya Pradesh 452001\n    ', '22.721991', '75.878057', 1, 0, 1, '2017-08-30 10:29:12'),
(2, 12, 3, '2017-08-30', '07:46', 1, '13-20, Railway Hospital Rd, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, Indien', '22.71658', '75.8708', 1, 0, 1, '2017-08-30 11:49:08'),
(3, 12, 3, '2017-08-30', '17:21', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71369', '75.87488', 2, 0, 0, '2017-08-30 11:52:13'),
(4, 7, 13, '2017-08-30', '06:30', 1, 'A-73\nAmbedkar Nagar, New Palasia\nIndore, Madhya Pradesh 452001\n    ', '22.733892', '75.888923', 2, 0, 0, '2017-08-30 12:21:15'),
(5, 7, 13, '2017-08-30', '06:30', 1, 'A-73\nAmbedkar Nagar, New Palasia\nIndore, Madhya Pradesh 452001\n    ', '22.733892', '75.888923', 1, 0, 1, '2017-08-30 12:21:24'),
(6, 7, 15, '2017-08-30', '19:40', 1, 'The Grace\nPlot No. 1 & 2, Chhawni Road\nOpp. President Hotel, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n    ', '22.7136723', '75.8746615', 2, 0, 0, '2017-08-30 14:11:49'),
(7, 7, 15, '2017-08-30', '19:40', 1, 'The Grace\nPlot No. 1 & 2, Chhawni Road\nOpp. President Hotel, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n    ', '22.7136723', '75.8746615', 2, 0, 0, '2017-08-30 14:11:56'),
(8, 14, 15, '2017-08-30', '19:40', 1, 'The Grace\nPlot No. 1 & 2, Chhawni Road\nOpp. President Hotel, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n    ', '22.7136723', '75.8746615', 2, 0, 0, '2017-08-30 14:14:08'),
(9, 14, 15, '2017-08-30', '19:40', 1, 'The Grace\nPlot No. 1 & 2, Chhawni Road\nOpp. President Hotel, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n    ', '22.7136723', '75.8746615', 2, 0, 0, '2017-08-30 14:14:25'),
(10, 7, 15, '2017-08-31', '17:25', 1, 'The Grace\nPlot No. 1 & 2, Chhawni Road\nOpp. President Hotel, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n    ', '22.7136723', '75.8746615', 2, 0, 0, '2017-08-31 04:31:06'),
(11, 22, 23, '2017-09-02', '21:27', 1, 'Birger Jarlsgatan 68, 113 56 Stockholm, Sverige', '59.34303', '18.0633', 1, 0, 1, '2017-09-02 19:29:53'),
(12, 22, 23, '2017-09-03', '21:43', 1, 'Kungstensgatan 9, 114 25 Stockholm, Sverige', '59.34315', '18.06396', 2, 0, 0, '2017-09-02 19:44:37'),
(13, 12, 3, '2017-09-04', '14:24', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 1, 0, 1, '2017-09-04 08:55:26'),
(14, 14, 3, '2017-09-04', '14:25', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 1, 0, 1, '2017-09-04 08:56:23'),
(15, 12, 3, '2017-09-04', '15:00', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 1, 0, 1, '2017-09-04 09:32:05'),
(16, 14, 3, '2017-09-04', '15:03', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 2, 0, 0, '2017-09-04 09:34:43'),
(17, 14, 3, '2017-09-04', '15:17', 1, '137, Radio Colony Lane Number 2, Gandhi Park Colony, Residency Area, Indore, Madhya Pradesh 452001, Indien', '22.70379', '75.88511', 1, 0, 1, '2017-09-04 09:47:48'),
(18, 14, 3, '2017-09-04', '15:20', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 1, 0, 1, '2017-09-04 09:52:45'),
(19, 16, 21, '2017-09-05', '11:46', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.7136', '75.87471', 2, 0, 0, '2017-09-05 06:17:57'),
(20, 16, 21, '2017-09-05', '14:10', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.71366', '75.87483', 2, 0, 0, '2017-09-05 08:41:42'),
(21, 16, 21, '2017-09-08', '14:30', 1, 'madhumillan square, indore', '27.1235', '75.23546', 1, 1, 1, '2017-09-06 13:17:32'),
(22, 16, 21, '2017-09-15', '18:30', 1, 'org.apache.http.entity.mime.content.StringBody@54aedb6', '22.7133123', '75.8747188', 2, 0, 0, '2017-09-15 09:25:38'),
(23, 14, 21, '2017-09-23', '17:25', 1, 'org.apache.http.entity.mime.content.StringBody@1f22b00', '22.7133123', '75.8747188', 2, 0, 0, '2017-09-15 09:26:55'),
(24, 16, 21, '2017-09-15', '15:20', 1, '7/2, Shreenath Business Center, Kibe Compound, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.71307', '75.8717', 1, 0, 1, '2017-09-15 09:47:34'),
(25, 16, 21, '2017-09-15', '15:22', 1, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.7138', '75.87476', 2, 0, 0, '2017-09-15 09:53:55'),
(26, 14, 21, '2017-09-19', '08:40', 1, 'org.apache.http.entity.mime.content.StringBody@22239592', '22.7133123', '75.8747188', 2, 0, 0, '2017-09-18 05:31:09'),
(27, 16, 3, '2017-09-18', '07:35', 1, 'org.apache.http.entity.mime.content.StringBody@2087b3d3', '22.7136478', '75.8746818', 2, 0, 0, '2017-09-18 06:22:33'),
(28, 41, 40, '2017-09-19', '18:30', 1, 'org.apache.http.entity.mime.content.StringBody@22bd65e', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-18 07:02:30'),
(29, 41, 40, '2017-09-18', '07:35', 1, 'org.apache.http.entity.mime.content.StringBody@bf453ef', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-18 07:05:21'),
(30, 41, 40, '2017-09-18', '07:35', 1, 'org.apache.http.entity.mime.content.StringBody@ac522ea', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-18 07:05:38'),
(31, 41, 40, '2017-09-19', '19:35', 1, 'org.apache.http.entity.mime.content.StringBody@3ff0f6', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-18 11:18:24'),
(32, 41, 40, '2017-09-20', '18:30', 1, 'org.apache.http.entity.mime.content.StringBody@5ec66ef', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-18 11:25:03'),
(33, 41, 40, '2017-09-19', '18:30', 1, 'Shalimar Corporate Centre\n311, Nath Mandir Road\nSouth Tukoganj, Tukoganj\nIndore, Madhya Pradesh 452001\n    ', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-18 11:30:42'),
(34, 16, 21, '2017-09-19', '07:35', 1, '1, Chhawni Rd, Raj Plaza Extension, Raj Talkies, Sanyogitaganj, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.71261', '75.87482', 1, 0, 1, '2017-09-19 11:22:16'),
(35, 16, 21, '2017-09-19', '16:58', 1, 'Rajat Complex, 15, 18, Chhawni Rd, Kibe Compound, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.71285', '75.87493', 2, 0, 0, '2017-09-19 11:30:01'),
(36, 22, 23, '2017-09-22', '13:27', 1, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.34304', '18.06325', 1, 0, 1, '2017-09-22 11:29:02'),
(37, 22, 23, '2017-09-22', '13:42', 0, 'Karlavägen 13, 114 31 Stockholm, Sverige', '59.34401', '18.06696', 2, 0, 0, '2017-09-22 11:43:40'),
(38, 22, 23, '2017-09-22', '13:46', 1, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.34305', '18.06328', 2, 0, 0, '2017-09-22 11:48:00'),
(39, 41, 40, '2017-09-26', '18:30', 1, 'Shalimar Corporate Centre\n311, Nath Mandir Road\nSouth Tukoganj, Tukoganj\nIndore, Madhya Pradesh 452001\n', '22.7173213', '75.8743939', 2, 0, 0, '2017-09-25 06:06:31'),
(40, 12, 3, '2017-09-25', '12:10', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.71375', '75.87476', 2, 0, 0, '2017-09-25 06:41:46'),
(41, 48, 47, '2017-09-25', '14:57', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.71375', '75.87476', 2, 0, 0, '2017-09-25 09:28:10'),
(42, 12, 33, '2017-09-29', '12:48', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 2, 0, 0, '2017-09-29 07:21:02'),
(43, 7, 33, '2017-09-29', '12:52', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 1, 0, 1, '2017-09-29 07:23:13'),
(44, 7, 33, '2017-09-29', '12:57', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375', '75.87476', 2, 0, 0, '2017-09-29 07:27:32'),
(45, 16, 51, '2017-10-03', '05:13', 1, 'No 8-A-1, Nath Mandir Rd, Near Nath Mandir, South Tukoganj, Tukoganj, Indore, Madhya Pradesh 452001, India', '22.7191831', '75.8764556', 0, 0, 0, '2017-10-03 11:45:02'),
(46, 16, 51, '2017-10-03', '05:13', 1, 'No 8-A-1, Nath Mandir Rd, Near Nath Mandir, South Tukoganj, Tukoganj, Indore, Madhya Pradesh 452001, India', '22.7191831', '75.8764556', 0, 0, 0, '2017-10-03 11:45:14'),
(47, 16, 53, '2017-10-18', '16:20', 1, 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.7128972', '75.87477109999999', 0, 0, 0, '2017-10-04 08:19:38'),
(48, 7, 3, '2017-10-06', '15:44', 1, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.71375', '75.87476', 0, 0, 0, '2017-10-06 10:14:51'),
(49, 4, 55, '2017-10-10', '03:15', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 2, 0, 0, '2017-10-09 13:07:51'),
(50, 41, 55, '2017-10-10', '16:25', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 2, 0, 0, '2017-10-09 13:16:23'),
(51, 41, 55, '2017-10-26', '05:25', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 1, 0, 0, '2017-10-10 05:36:20'),
(52, 41, 55, '2017-10-26', '05:25', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 2, 0, 0, '2017-10-10 05:37:44'),
(53, 14, 55, '2017-10-10', '06:25', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 1, 0, 0, '2017-10-10 10:29:02'),
(54, 14, 55, '2017-10-10', '06:25', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 0, 0, 0, '2017-10-10 10:29:06'),
(55, 35, 61, '2017-10-10', '04:20', 1, 'Dawa Bazaar', '22.7131957', '75.8758591', 1, 0, 1, '2017-10-10 11:21:52'),
(56, 35, 61, '2017-10-10', '04:20', 1, 'Dawa Bazaar', '22.7131957', '75.8758591', 1, 0, 0, '2017-10-10 11:21:59'),
(57, 35, 61, '2017-10-11', '03:14', 1, 'Dawa Bazaar', '22.7131957', '75.8758591', 1, 0, 0, '2017-10-11 09:44:49'),
(58, 35, 61, '2017-10-11', '03:14', 1, 'Dawa Bazaar', '22.7131957', '75.8758591', 1, 0, 0, '2017-10-11 09:44:54'),
(59, 36, 62, '2017-10-11', '03:20', 1, 'CRP Line', '22.7134057', '75.8746478', 1, 0, 1, '2017-10-11 09:51:10'),
(60, 41, 55, '2017-10-13', '09:40', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 1, 0, 1, '2017-10-13 05:34:46'),
(61, 41, 55, '2017-10-13', '09:40', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 1, 0, 1, '2017-10-13 05:34:54'),
(62, 12, 55, '2017-10-13', '11:18', 1, '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 1, 0, 1, '2017-10-13 05:45:04'),
(63, 22, 63, '2017-10-14', '15:42', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-13 20:43:02'),
(64, 22, 63, '2017-10-14', '15:42', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-13 20:43:07'),
(65, 22, 63, '2017-10-14', '15:42', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-13 20:43:15'),
(66, 22, 63, '2017-10-14', '15:42', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-13 20:43:19'),
(67, 22, 63, '2017-10-17', '16:40', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-15 14:40:55'),
(68, 22, 63, '2017-10-17', '16:40', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-15 14:41:00'),
(69, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 12:57:21'),
(70, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 12:58:32'),
(71, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 12:58:44'),
(72, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 12:59:51'),
(73, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 13:00:18'),
(74, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 13:00:21'),
(75, 22, 68, '2017-10-17', '19:00', 1, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329595899999994', '18.0680841', 0, 0, 0, '2017-10-16 13:00:29'),
(76, 22, 63, '2017-11-01', '14:19', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.33421589999999', '18.0749681', 2, 0, 0, '2017-10-30 13:23:30'),
(77, 22, 63, '2017-11-01', '20:11', 1, 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '59.3342159', '18.0749681', 2, 0, 0, '2017-10-30 19:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE IF NOT EXISTS `order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `bill_amount` double NOT NULL,
  `discount` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL COMMENT '0=% 1=currency',
  `discount_id` varchar(10) NOT NULL,
  `gross_amount` double NOT NULL,
  `transaction_status` varchar(20) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`id`, `order_id`, `transaction_id`, `customer_id`, `provider_id`, `bill_amount`, `discount`, `type`, `discount_id`, `gross_amount`, `transaction_status`, `creat_at`) VALUES
(1, 1, '34235135', 2, 4, 20, '', '1', '', 20, 'Approved', '2017-08-30 10:29:12'),
(2, 2, '259561', 3, 12, 10, '', '', '', 10, 'Godkänd', '2017-08-30 11:49:08'),
(3, 3, '259572', 3, 12, 24, '', '', '', 24, 'Godkänd', '2017-08-30 11:52:13'),
(4, 4, '34235135', 13, 7, 13, '', '0', '', 13, 'Approved', '2017-08-30 12:21:15'),
(5, 5, '34235135', 13, 7, 13, '', '0', '', 13, 'Approved', '2017-08-30 12:21:24'),
(6, 6, '34235135', 15, 7, 25, '', '0', '', 25, 'Approved', '2017-08-30 14:11:49'),
(7, 7, '34235135', 15, 7, 25, '', '0', '', 25, 'Approved', '2017-08-30 14:11:56'),
(8, 8, '34235135', 15, 14, 31, '', '1', '', 31, 'Approved', '2017-08-30 14:14:08'),
(9, 9, '34235135', 15, 14, 31, '', '1', '', 31, 'Approved', '2017-08-30 14:14:25'),
(10, 10, '34235135', 15, 7, 25, '', '0', '', 25, 'Approved', '2017-08-31 04:31:06'),
(11, 11, '262799', 23, 22, 1, '', '', '', 1, 'Godkänd', '2017-09-02 19:29:53'),
(12, 12, '262811', 23, 22, 1, '10', '0', '1', 0.9, 'Godkänd', '2017-09-02 19:44:37'),
(13, 13, '263885', 3, 12, 24, '', '', '', 24, 'Godkänd', '2017-09-04 08:55:26'),
(14, 14, '263886', 3, 14, 19, '', '', '', 19, 'Godkänd', '2017-09-04 08:56:23'),
(15, 15, '263919', 3, 12, 10, '', '', '', 10, 'Godkänd', '2017-09-04 09:32:05'),
(16, 16, '263925', 3, 14, 42, '', '', '', 42, 'Godkänd', '2017-09-04 09:34:43'),
(17, 17, '263939', 3, 14, 54, '', '', '', 54, 'Godkänd', '2017-09-04 09:47:48'),
(18, 18, '263952', 3, 14, 31, '', '', '', 31, 'Godkänd', '2017-09-04 09:52:45'),
(19, 19, '264791', 21, 16, 42, '', '', '', 42, 'Godkänd', '2017-09-05 06:17:57'),
(20, 20, '264915', 21, 16, 42, '', '', '', 42, 'Godkänd', '2017-09-05 08:41:42'),
(21, 21, '215743', 21, 16, 21, '', '', '', 21, 'Approved', '2017-09-06 13:17:32'),
(22, 22, '34235135', 21, 16, 21, '', '1', '', 21, 'Approved', '2017-09-15 09:25:38'),
(23, 23, '34235135', 21, 14, 31, '', '1', '', 31, 'Approved', '2017-09-15 09:26:55'),
(24, 24, '275130', 21, 16, 21, '', '', '', 21, 'Godkänd', '2017-09-15 09:47:34'),
(25, 25, '275137', 21, 16, 21, '', '', '', 21, 'Godkänd', '2017-09-15 09:53:55'),
(26, 26, '34235135', 21, 14, 12, '', '1', '', 12, 'Approved', '2017-09-18 05:31:09'),
(27, 27, '34235135', 3, 16, 42, '', '1', '', 42, 'Approved', '2017-09-18 06:22:33'),
(28, 28, '34235135', 40, 41, 30, '', '1', '', 30, 'Approved', '2017-09-18 07:02:30'),
(29, 29, '34235135', 40, 41, 10, '', '1', '', 10, 'Approved', '2017-09-18 07:05:21'),
(30, 30, '34235135', 40, 41, 10, '', '1', '', 10, 'Approved', '2017-09-18 07:05:38'),
(31, 31, '34235135', 40, 41, 20, '', '1', '', 20, 'Approved', '2017-09-18 11:18:24'),
(32, 32, '34235135', 40, 41, 10, '', '1', '', 10, 'Approved', '2017-09-18 11:25:03'),
(33, 33, '34235135', 40, 41, 10, '', '1', '', 10, 'Approved', '2017-09-18 11:30:42'),
(34, 34, '278984', 21, 16, 42, '', '', '', 42, 'Godkänd', '2017-09-19 11:22:16'),
(35, 35, '278989', 21, 16, 42, '', '', '', 42, 'Godkänd', '2017-09-19 11:30:01'),
(36, 36, '282047', 23, 22, 1, '', '', '', 1, 'Godkänd', '2017-09-22 11:29:02'),
(37, 37, '282079', 23, 22, 1, '', '', '', 1, 'Godkänd', '2017-09-22 11:43:40'),
(38, 38, '282082', 23, 22, 1, '', '', '', 1, 'Godkänd', '2017-09-22 11:48:00'),
(39, 39, '34235135', 40, 41, 20, '', '1', '', 20, 'Approved', '2017-09-25 06:06:31'),
(40, 40, '284099', 3, 12, 24, '', '', '', 24, 'Godkänd', '2017-09-25 06:41:46'),
(41, 41, '284195', 47, 48, 5, '', '', '', 5, 'Godkänd', '2017-09-25 09:28:10'),
(42, 42, '288613', 33, 12, 10, '', '', '', 10, 'Godkänd', '2017-09-29 07:21:02'),
(43, 43, '288615', 33, 7, 25, '', '', '', 25, 'Godkänd', '2017-09-29 07:23:13'),
(44, 44, '288628', 33, 7, 12, '', '', '', 12, 'Godkänd', '2017-09-29 07:27:32'),
(45, 45, '34235135', 51, 16, 42, '', '1', '', 42, 'Approved', '2017-10-03 11:45:02'),
(46, 46, '34235135', 51, 16, 42, '', '1', '', 42, 'Approved', '2017-10-03 11:45:14'),
(47, 47, '34235135', 53, 16, 2, '', '1', '', 2, 'Approved', '2017-10-04 08:19:38'),
(48, 48, '295413', 3, 7, 12, '', '', '', 12, 'Godkänd', '2017-10-06 10:14:51'),
(49, 49, '34235135', 55, 4, 20, '', '1', '', 20, 'Approved', '2017-10-09 13:07:51'),
(50, 50, '34235135', 55, 41, 10, '', '1', '', 10, 'Approved', '2017-10-09 13:16:23'),
(51, 51, '34235135', 55, 41, 10, '', '1', '', 10, 'Approved', '2017-10-10 05:36:20'),
(52, 52, '34235135', 55, 41, 10, '', '1', '', 10, 'Approved', '2017-10-10 05:37:44'),
(53, 53, '34235135', 55, 14, 12, '', '1', '', 12, 'Approved', '2017-10-10 10:29:02'),
(54, 54, '34235135', 55, 14, 12, '', '1', '', 12, 'Approved', '2017-10-10 10:29:06'),
(55, 55, '34235135', 61, 35, 24, '', '0', '', 24, 'Approved', '2017-10-10 11:21:52'),
(56, 56, '34235135', 61, 35, 24, '', '0', '', 24, 'Approved', '2017-10-10 11:21:59'),
(57, 57, '34235135', 61, 35, 24, '', '0', '', 24, 'Approved', '2017-10-11 09:44:49'),
(58, 58, '34235135', 61, 35, 24, '', '0', '', 24, 'Approved', '2017-10-11 09:44:54'),
(59, 59, '34235135', 62, 36, 8, '', '0', '', 8, 'Approved', '2017-10-11 09:51:10'),
(60, 60, '34235135', 55, 41, 20, '', '1', '', 20, 'Approved', '2017-10-13 05:34:46'),
(61, 61, '34235135', 55, 41, 20, '', '1', '', 20, 'Approved', '2017-10-13 05:34:54'),
(62, 62, '34235135', 55, 12, 10, '', '1', '', 10, 'Approved', '2017-10-13 05:45:04'),
(63, 63, '34235135', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-13 20:43:02'),
(64, 64, '34235135', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-13 20:43:07'),
(65, 65, '34235135', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-13 20:43:15'),
(66, 66, '34235135', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-13 20:43:19'),
(67, 67, '34235135', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-15 14:40:55'),
(68, 68, '34235135', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-15 14:41:00'),
(69, 69, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 12:57:21'),
(70, 70, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 12:58:32'),
(71, 71, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 12:58:44'),
(72, 72, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 12:59:51'),
(73, 73, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 13:00:18'),
(74, 74, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 13:00:21'),
(75, 75, '34235135', 68, 22, 1, '', '1', '', 1, 'Approved', '2017-10-16 13:00:29'),
(76, 76, '319265', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-30 13:23:30'),
(77, 77, '319673', 63, 22, 1, '', '1', '', 1, 'Approved', '2017-10-30 19:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_service`
--

CREATE TABLE IF NOT EXISTS `order_service` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `order_id` int(20) NOT NULL,
  `service_id` int(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `total_hour` varchar(20) NOT NULL,
  `total_cost` varchar(20) NOT NULL,
  `price_type` int(10) NOT NULL COMMENT '0=perhour, 1=wholeday',
  `service_type` int(20) NOT NULL COMMENT '0=actual,1=another',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `order_service`
--

INSERT INTO `order_service` (`id`, `order_id`, `service_id`, `price`, `total_hour`, `total_cost`, `price_type`, `service_type`, `created_at`, `update_at`) VALUES
(1, 1, 22, '20', '1', '20', 1, 0, '2017-08-30 10:29:12', '2017-08-30 14:11:38'),
(2, 2, 20, '10', '1', '10', 1, 0, '2017-08-30 11:49:08', '2017-08-30 14:27:43'),
(3, 3, 22, '14', '24', '14', 1, 0, '2017-08-30 11:52:13', ''),
(4, 3, 20, '10', '24', '10', 1, 0, '2017-08-30 11:52:13', ''),
(5, 4, 22, '13', '24', '13', 1, 0, '2017-08-30 12:21:15', ''),
(6, 5, 22, '13', '1', '13', 1, 0, '2017-08-30 12:21:24', '2017-08-30 14:42:09'),
(7, 6, 22, '13', '24', '13', 1, 0, '2017-08-30 14:11:49', ''),
(8, 6, 20, '12', '24', '12', 1, 0, '2017-08-30 14:11:49', ''),
(9, 7, 22, '13', '24', '13', 1, 0, '2017-08-30 14:11:56', ''),
(10, 7, 20, '12', '24', '12', 1, 0, '2017-08-30 14:11:56', ''),
(11, 8, 22, '19', '24', '19', 1, 0, '2017-08-30 14:14:08', ''),
(12, 8, 20, '12', '24', '12', 1, 0, '2017-08-30 14:14:08', ''),
(13, 9, 22, '19', '24', '19', 1, 0, '2017-08-30 14:14:25', ''),
(14, 9, 20, '12', '24', '12', 1, 0, '2017-08-30 14:14:25', ''),
(15, 10, 22, '13', '24', '13', 1, 0, '2017-08-31 04:31:06', ''),
(16, 10, 20, '12', '24', '12', 1, 0, '2017-08-31 04:31:06', ''),
(17, 11, 1, '1', '1', '1', 1, 0, '2017-09-02 19:29:53', '2017-09-02 21:38:17'),
(18, 12, 1, '1', '24', '1', 1, 0, '2017-09-02 19:44:37', ''),
(19, 13, 22, '14', '3', '14', 1, 0, '2017-09-04 08:55:26', '2017-09-04 11:14:03'),
(20, 13, 20, '10', '2', '10', 1, 0, '2017-09-04 08:55:26', '2017-09-04 11:14:03'),
(21, 14, 22, '19', '4', '19', 1, 0, '2017-09-04 08:56:23', '2017-09-04 11:26:39'),
(22, 15, 20, '10', '1', '10', 1, 0, '2017-09-04 09:32:05', '2017-09-04 11:35:48'),
(23, 16, 22, '19', '24', '19', 1, 0, '2017-09-04 09:34:43', ''),
(24, 16, 21, '23', '24', '23', 1, 0, '2017-09-04 09:34:43', ''),
(25, 17, 22, '19', '1', '19', 1, 0, '2017-09-04 09:47:48', '2017-09-04 11:49:33'),
(26, 17, 20, '12', '1', '12', 1, 0, '2017-09-04 09:47:48', '2017-09-04 11:49:33'),
(27, 17, 21, '23', '1', '23', 1, 0, '2017-09-04 09:47:48', '2017-09-04 11:49:33'),
(28, 18, 22, '19', '1', '19', 1, 0, '2017-09-04 09:52:45', '2017-09-04 11:53:32'),
(29, 18, 20, '12', '1', '12', 1, 0, '2017-09-04 09:52:45', '2017-09-04 11:53:32'),
(30, 19, 22, '21', '24', '21', 1, 0, '2017-09-05 06:17:57', ''),
(31, 19, 20, '21', '24', '21', 1, 0, '2017-09-05 06:17:57', ''),
(32, 20, 22, '21', '24', '21', 1, 0, '2017-09-05 08:41:42', ''),
(33, 20, 20, '21', '24', '21', 1, 0, '2017-09-05 08:41:42', ''),
(34, 21, 20, '21', '24', '21', 1, 0, '2017-09-06 13:17:32', ''),
(35, 22, 20, '21', '24', '21', 1, 0, '2017-09-15 09:25:38', ''),
(36, 23, 22, '19', '24', '19', 1, 0, '2017-09-15 09:26:55', ''),
(37, 23, 20, '12', '24', '12', 1, 0, '2017-09-15 09:26:55', ''),
(38, 24, 20, '21', '1', '21', 1, 0, '2017-09-15 09:47:34', '2017-09-15 12:18:35'),
(39, 25, 20, '21', '24', '21', 1, 0, '2017-09-15 09:53:55', ''),
(40, 26, 20, '12', '24', '12', 1, 0, '2017-09-18 05:31:09', ''),
(41, 27, 22, '21', '24', '21', 1, 0, '2017-09-18 06:22:33', ''),
(42, 27, 20, '21', '24', '21', 1, 0, '2017-09-18 06:22:33', ''),
(43, 28, 22, '20', '24', '20', 1, 0, '2017-09-18 07:02:30', ''),
(44, 28, 20, '10', '24', '10', 1, 0, '2017-09-18 07:02:30', ''),
(45, 29, 20, '10', '24', '10', 1, 0, '2017-09-18 07:05:21', ''),
(46, 30, 20, '10', '24', '10', 1, 0, '2017-09-18 07:05:38', ''),
(47, 31, 22, '20', '24', '20', 1, 0, '2017-09-18 11:18:24', ''),
(48, 32, 20, '10', '24', '10', 1, 0, '2017-09-18 11:25:03', ''),
(49, 33, 20, '10', '24', '10', 1, 0, '2017-09-18 11:30:42', ''),
(50, 34, 22, '21', '1', '21', 1, 0, '2017-09-19 11:22:16', '2017-09-19 13:36:41'),
(51, 34, 20, '21', '1', '21', 1, 0, '2017-09-19 11:22:16', '2017-09-19 13:36:41'),
(52, 35, 22, '21', '24', '21', 1, 0, '2017-09-19 11:30:01', ''),
(53, 35, 20, '21', '24', '21', 1, 0, '2017-09-19 11:30:01', ''),
(54, 36, 1, '1', '3', '1', 1, 0, '2017-09-22 11:29:02', '2017-09-22 13:38:13'),
(55, 37, 1, '1', '24', '1', 1, 0, '2017-09-22 11:43:40', ''),
(56, 38, 1, '1', '24', '1', 1, 0, '2017-09-22 11:48:00', ''),
(57, 39, 22, '20', '24', '20', 1, 0, '2017-09-25 06:06:31', ''),
(58, 40, 22, '14', '24', '14', 1, 0, '2017-09-25 06:41:46', ''),
(59, 40, 20, '10', '24', '10', 1, 0, '2017-09-25 06:41:46', ''),
(60, 41, 22, '3', '24', '3', 1, 0, '2017-09-25 09:28:10', ''),
(61, 41, 20, '2', '24', '2', 1, 0, '2017-09-25 09:28:10', ''),
(62, 42, 20, '10', '24', '10', 1, 0, '2017-09-29 07:21:02', ''),
(63, 43, 22, '13', '1', '13', 1, 0, '2017-09-29 07:23:13', '2017-09-29 09:24:50'),
(64, 43, 20, '12', '1', '12', 1, 0, '2017-09-29 07:23:13', '2017-09-29 09:24:50'),
(65, 44, 20, '12', '24', '12', 1, 0, '2017-09-29 07:27:32', ''),
(66, 45, 22, '21', '24', '21', 1, 0, '2017-10-03 11:45:02', ''),
(67, 45, 20, '21', '24', '21', 1, 0, '2017-10-03 11:45:02', ''),
(68, 46, 22, '21', '24', '21', 1, 0, '2017-10-03 11:45:14', ''),
(69, 46, 20, '21', '24', '21', 1, 0, '2017-10-03 11:45:14', ''),
(70, 47, 7, '2', '24', '2', 1, 0, '2017-10-04 08:19:38', ''),
(71, 48, 20, '12', '24', '12', 1, 0, '2017-10-06 10:14:51', ''),
(72, 49, 22, '20', '24', '20', 1, 0, '2017-10-09 13:07:51', ''),
(73, 50, 20, '10', '24', '10', 1, 0, '2017-10-09 13:16:23', ''),
(74, 51, 20, '10', '24', '10', 1, 0, '2017-10-10 05:36:20', ''),
(75, 52, 20, '10', '24', '10', 1, 0, '2017-10-10 05:37:44', ''),
(76, 53, 20, '12', '24', '12', 1, 0, '2017-10-10 10:29:02', ''),
(77, 54, 20, '12', '24', '12', 1, 0, '2017-10-10 10:29:06', ''),
(78, 55, 22, '12', '1', '12', 1, 0, '2017-10-10 11:21:52', '2017-10-10 13:23:45'),
(79, 55, 20, '12', '1', '12', 1, 0, '2017-10-10 11:21:52', '2017-10-10 13:23:45'),
(80, 56, 22, '12', '24', '12', 1, 0, '2017-10-10 11:21:59', ''),
(81, 56, 20, '12', '24', '12', 1, 0, '2017-10-10 11:21:59', ''),
(82, 57, 22, '12', '24', '12', 1, 0, '2017-10-11 09:44:49', ''),
(83, 57, 20, '12', '24', '12', 1, 0, '2017-10-11 09:44:49', ''),
(84, 58, 22, '12', '24', '12', 1, 0, '2017-10-11 09:44:54', ''),
(85, 58, 20, '12', '24', '12', 1, 0, '2017-10-11 09:44:54', ''),
(86, 59, 22, '8', '1', '8', 1, 0, '2017-10-11 09:51:10', '2017-10-11 11:53:00'),
(87, 60, 20, '20', '1', '20', 1, 0, '2017-10-13 05:34:46', '2017-10-13 10:26:37'),
(88, 61, 20, '20', '1', '20', 1, 0, '2017-10-13 05:34:54', '2017-10-13 10:41:41'),
(89, 62, 20, '10', '1', '10', 1, 0, '2017-10-13 05:45:04', '2017-10-13 07:48:53'),
(90, 63, 1, '1', '24', '1', 1, 0, '2017-10-13 20:43:02', ''),
(91, 64, 1, '1', '24', '1', 1, 0, '2017-10-13 20:43:07', ''),
(92, 65, 1, '1', '24', '1', 1, 0, '2017-10-13 20:43:15', ''),
(93, 66, 1, '1', '24', '1', 1, 0, '2017-10-13 20:43:19', ''),
(94, 67, 1, '1', '24', '1', 1, 0, '2017-10-15 14:40:55', ''),
(95, 68, 1, '1', '24', '1', 1, 0, '2017-10-15 14:41:00', ''),
(96, 69, 1, '1', '24', '1', 1, 0, '2017-10-16 12:57:21', ''),
(97, 70, 1, '1', '24', '1', 1, 0, '2017-10-16 12:58:32', ''),
(98, 71, 1, '1', '24', '1', 1, 0, '2017-10-16 12:58:44', ''),
(99, 72, 1, '1', '24', '1', 1, 0, '2017-10-16 12:59:51', ''),
(100, 73, 1, '1', '24', '1', 1, 0, '2017-10-16 13:00:18', ''),
(101, 74, 1, '1', '24', '1', 1, 0, '2017-10-16 13:00:21', ''),
(102, 75, 1, '1', '24', '1', 1, 0, '2017-10-16 13:00:29', ''),
(103, 76, 1, '1', '24', '1', 1, 0, '2017-10-30 13:23:30', ''),
(104, 77, 1, '1', '24', '1', 1, 0, '2017-10-30 19:14:44', '');

-- --------------------------------------------------------

--
-- Table structure for table `provierlocation`
--

CREATE TABLE IF NOT EXISTS `provierlocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_acceptance` varchar(255) NOT NULL COMMENT '0=providerAdd,1=customerAdd,2=both',
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `provider_address` varchar(255) NOT NULL,
  `provider_lat` varchar(255) NOT NULL,
  `provider_long` varchar(255) NOT NULL,
  `show_position` int(11) NOT NULL COMMENT '0=Off, 1=on',
  `mobile` varchar(25) NOT NULL,
  `availability` varchar(255) NOT NULL COMMENT '1=always, 2=selecttime',
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `canceling_policy` varchar(255) NOT NULL COMMENT '0=moderate,1=flexible,2=strict, ',
  `acceptance` varchar(255) NOT NULL COMMENT '0=instant,1=pre-approval',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `previous_workplace` varchar(255) NOT NULL,
  `current_workplace` varchar(255) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1=individual,2=customer,3=company,4=member',
  `seen_status` varchar(255) NOT NULL COMMENT '0=not, 1=yes',
  `accept_term` varchar(20) NOT NULL,
  `approve_status` varchar(255) NOT NULL COMMENT '0=not approved, 1=approved',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(255) NOT NULL,
  `device_type` int(11) NOT NULL COMMENT '0=android, 1=ios, 2=web',
  `status` int(11) NOT NULL COMMENT '0=incomplete, 1=complete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `company_id`, `referral_code`, `device_token`, `company_name`, `registration_no`, `first_name`, `last_name`, `dob`, `address`, `address_acceptance`, `lat`, `long`, `provider_address`, `provider_lat`, `provider_long`, `show_position`, `mobile`, `availability`, `start_time`, `end_time`, `user_image`, `canceling_policy`, `acceptance`, `email`, `password`, `gender`, `about`, `previous_workplace`, `current_workplace`, `experience`, `user_type`, `seen_status`, `accept_term`, `approve_status`, `created_at`, `update_at`, `device_type`, `status`) VALUES
(7, 0, 'H2OABP6H', '', '', '', 'New', 'Freelancer ', '1995-06-21', 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, Indien', '2', '22.71994', '75.90731', '12, Kanadia Main Rd, Bengali Chowk, Gajraj Nagar, Shri Ram Nagar, Indore, Madhya Pradesh 452016, Indien', '22.71994', '75.90731', 1, '+461234657899', '1', '', '', 'FtP4tvEJimage.jpg', '2', '1', 'new@gmail.com', '123456', 'Male', '', 'Ujjain', 'Indore', '1', 1, '', 'Yes', '1', '2017-08-30 10:12:50', '2017-09-29 09:30:32', 1, 1),
(10, 0, 'URELPAC5', '', 'Matrix Saloon ', '6589743658', '', '', '', 'C-41, Mall Godam Rd, New Siyaganj, Indore GPO, Indore, Madhya Pradesh 452007, Indien', '', '22.724', '75.86823', '', '', '', 0, '+461236547899', '', '', '', 'NLXnv4S8image.jpg', '', '', 'matrix@gmail.com', '123456', '', '', '', '', '', 3, '', '', '1', '2017-08-30 10:44:11', '', 0, 1),
(12, 0, 'ZCHOB69X', '', '', '', 'David', 'Gutta', '1987-07-18', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '0', '22.751400399999998', '75.8955187', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.7136478', '75.87468179999999', 1, '+46124357689', '1', '', '', 'ZU6SDUj6profileimg.jpg', '1', '1', 'david@gmail.com', '123456', 'Male', 'I''m what I''m ', 'Old', 'Newp', '4', 1, '', 'Yes', '1', '2017-08-30 11:07:09', '2017-10-25 01:20:45', 0, 1),
(14, 10, 'PVYQ1NQ3', '', '', '', 'Nandu', 'Member', '1990-09-28', '93, Janki Nagar, Navlakha, Indore, Madhya Pradesh 452001, India', '2', '0', '0', '3/9, Agra Bombay Rd, Parsi Mohalla, Navlakha, Indore, Madhya Pradesh 452001, India', '0', '0', 1, '+466457891322', '1', '', '', 'XZhlHlonimage.jpg', '1', '1', 'nandu@gmail.com', '123456', 'Male', 'I''m member of metrix saloon!', 'Nawlakha square', 'Rajwada Chok', '12', 4, '', 'Yes', '1', '2017-08-30 12:42:25', '2017-08-30 03:14:57', 1, 1),
(20, 0, '7T4ZOIU5', '493b9c16dc04c17c97e74647b9e35d2ba1c101bbcf52c0621d921062dbd6c886', '', '', 'Bfkfj', 'Ndnfn', '2017-08-31', '?irinyal? Mahallesi, 1537. Sk. No:14, 07160 Muratpa?a/Antalya, Turkiet', '2', '36.851784', '30.746401', '?irinyal? Mahallesi, 1537. Sk. No:14, 07160 Muratpa?a/Antalya, Turkiet', '36.85181', '30.74641', 1, '+467216464', '1', '', '', 'Kt6W9DTximage.jpg', '1', '0', 'kdkd@dkks.se', '', 'Man', '', '', '', '', 1, '', '', '1', '2017-08-31 09:34:15', '', 1, 0),
(22, 0, 'J82V5FYS', '', '', '', 'Samira', 'Metto', '1999-09-02', 'Birger Jarlsgatan 68, 113 56 Stockholm, Sverige', '2', '59.34401', '18.06696', 'Karlavägen 13, 114 31 Stockholm, Sverige', '59.34401', '18.06696', 1, '+46707828485', '1', '', '', 'NscIFKtqimage.jpg', '1', '1', 'yaprak.sayyad@gmail.com', 'ssssss', 'Female', '', 'Nk\nTre\nFlera andra', '', '3', 1, '', 'Yes', '1', '2017-09-02 19:14:51', '2017-09-22 01:23:16', 1, 1),
(24, 0, '0GWV5CFG', '493b9c16dc04c17c97e74647b9e35d2ba1c101bbcf52c0621d921062dbd6c886', '', '', 'Sipan', 'Metto', '2005-09-02', 'Karlavägen 14B, 114 31 Stockholm, Sverige', '2', '59.343380', '18.066460', 'Uggelviksgatan 2a, 114 27 Stockholm, Sverige', '59.34372', '18.06862', 1, '+46721460172', '1', '', '', 'kUEBEeOBimage.jpg', '1', '0', 'sipan@metto.se', 'ssssss', 'Man', '', '', '', '', 1, '', 'Yes', '1', '2017-09-02 19:18:42', '', 1, 1),
(25, 0, 'HGFVMR4J', '493b9c16dc04c17c97e74647b9e35d2ba1c101bbcf52c0621d921062dbd6c886', '', '', 'Jbdbd', 'Udjd', '2007-09-02', 'Birger Jarlsgatan 68, 113 56 Stockholm, Sverige', '1', '59.342983', '18.063396', '', '0', '0', 1, '+465757', '1', '', '', 'P6WiifN5image.jpg', '1', '0', 'ndnd@skjs.se', '', 'Man', '', '', '', '', 1, '', '', '', '2017-09-02 19:19:53', '', 1, 0),
(28, 0, 'O4RA5RRO', 'e05b006931d3563680798b42a3c4308819288b5e10d404d1c9ae74c3735590b6', '', '', 'Bz', 'Cc', '2017-09-05', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '2', '22.713623', '75.874504', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.7137', '75.87473', 1, '+465466645551', '1', '', '', 'ST7mmbqfimage.jpg', '1', '0', 'hsja@gmail.com', '', 'Man', 'KF', '', '', '', 1, '', '', '1', '2017-09-04 08:42:08', '', 1, 0),
(29, 0, 'OJ5XPJNP', 'e05b006931d3563680798b42a3c4308819288b5e10d404d1c9ae74c3735590b6', '', '', 'BB', 'Z', '1996-09-04', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '1', '22.713745', '75.874474', '', '0', '0', 1, '+465466645551', '1', '', '', 'iYCgM1Y3image.jpg', '1', '0', 'haja@gnail.com', '', 'Man', '', '', '', '', 1, '', '', '1', '2017-09-04 09:48:50', '', 1, 0),
(30, 0, 'VL8R66EP', '', '', '', 'Bz', 'Vv', '2017-09-05', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '1', '0', '0', '', '0', '0', 1, '+465466645555', '1', '', '', 'o2OGxFjoimage.jpg', '1', '0', 'provider@gmail.com', 'qwerty', 'Man', '', ' ', 'Bz', '', 1, '', 'Yes', '1', '2017-09-05 05:23:04', '2017-09-05 07:52:53', 1, 1),
(31, 0, 'A4IAAITR', '0148072a74a3082dfcebeac48ee1b3a3128ea63a6dbbe8247ebf3cd53fc4344b', '', '', '  V', 'K', '2017-09-05', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '1', '22.713676', '75.874802', '', '22.71368', '75.8748', 1, '+461235232123', '1', '', '', 'XVignBIgimage.jpg', '1', '0', 'providetwo@gmail.com', '', 'Man', '', '', '', '', 1, '', '', '1', '2017-09-05 05:56:42', '', 1, 0),
(32, 0, '0YFC5HBH', '', '', '', 'Shree', 'Shree 108', '1989-11-16', '56, New Dewas Rd, Shivaji Nagar, Indore, Madhya Pradesh 452003, India', '0', '22.72605', '75.88775', '282, Garipipliya Road, New Palasia, Indore, Madhya Pradesh 452001, India', '22.72605', '75.88775', 1, '+465645465642', '1', '', '', '0AHga0ESimage.jpg', '1', '0', 'shree@gmail.com', '123456', 'Male', 'Shree shree 108 shree Syplo', 'Palasia\nSanket nagar\nLIG square', 'Madhumilan', '108', 1, '', 'Yes', '1', '2017-09-16 08:34:56', '2017-09-16 10:49:28', 1, 1),
(35, 0, 'U5D704GL', 'fmzMUYn_B3I:APA91bH7jS4zyi_IyQiwt4WeSE6CqvcWdxCanQujb8x943y_-8l1xY2C5uG4eUX4x5qDNjQhT-K49LVD55A_MpllDY11DgLZ9wLKsy5gQHS5bNUYYCvPa0QxjTqzFStpA5frZxLLT6FN', '', '', 'Free One', 'One', '1986-09-16', '567/5, Nehru Park 2, Dhenu Market, Indore, Madhya Pradesh 452001, India', '1', '22.71367', '75.87453', '', '22.71367', '75.87453', 1, '+465466645551', '1', '', '', 'DAAnUi4Iimage.jpg', '1', '0', 'freeone@gmail.com', 'qwerty', 'Male', '', '', '', '', 1, '', 'Yes', '1', '2017-09-16 10:16:38', '2017-09-16 01:41:11', 0, 1),
(36, 0, 'OFS2SRQV', '', '', '', 'Free', 'Two', '2001-09-16', '40/2, Kibe Compound, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '2', '22.713877', '75.872986', 'g8, Bhaktavar Ram Nagar, Vinoba Nagar, Tilak Nagar, Indore, Madhya Pradesh 452018, India', '22.71836', '75.89364', 1, '+465466645551', '1', '', '', 'Ymf4GgKoimage.jpg', '1', '0', 'freetwo@gmail.com', 'qwerty', 'Male', '', '', '', '', 1, '', 'Yes', '1', '2017-09-16 10:18:27', '', 0, 1),
(37, 0, 'IZUEV9ZW', 'fwHRXWzfNgo:APA91bFSZOskOGCFKCUS5EcTEUH3vE7aDJflh2zPgQ_O_sfDU6MFmOaXkP2Slj7ysoGbx82jKVQVRUX8RR5oFXJfKRXkHzZwR6FsKy8woOifoTpIFeizMsWpZmgqFQa7WzI7ufJbRg5h', '', '', 'Freeming', 'King', '2017-10-09', 'Silver Mall', '2', '22.7165318', '75.8737455', 'Silver Mall', '22.7165318', '75.8737455', 0, '+467854568523', '1', '', '', 'idrRDxmjprofileimg.jpg', '1', '0', 'freeking@gmail.com', 'qwerty', 'Male', '', '', '', '', 1, '', 'No', '0', '2017-09-16 10:21:27', '', 0, 1),
(39, 0, 'YFYCHS4P', '19727151e58a63d8f17ef45a59500fba75301f19fa1f12eea93785a6c04f1415', '', '', 'Jc', 'C', '2017-09-16', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '2', '22.713671', '75.874702', 'navlkha Complex, 2-C, Navlakha Rd, Near Agrasen Chouraha, Snehnagar, Indore, Madhya Pradesh 452001, India', '22.70469', '75.87245', 1, '+465466645551', '1', '', '', 'PHLiLB8Fimage.jpg', '1', '0', 'freethree@gmail.com', '', 'Male', '', '', '', '', 1, '', '', '', '2017-09-16 11:34:35', '', 1, 0),
(41, 0, '9RP3QWRF', '', '', '', 'Hakoona', 'Matata', '1996-09-18', '14, Rabindranath Tagore MargNear Madu Milan Talkies, Kibe CompoundIndore, Madhya Pradesh 452001', '2', '22.7181778', '75.8739103', '14, Rabindranath Tagore Marg\nNear Madu Milan Talkies, Kibe Compound\nIndore, Madhya Pradesh 452001\n', '22.7132427', '75.8736164', 1, '+918370038820', '1', '', '', '6WVVVhKZprofileimg.jpg', '1', '1', 'hakoona@gmail.com', 'qwerty', 'male', 'hakoona matata ', 'Larable spa', 'Jallynean', '1', 1, '', 'Yes', '1', '2017-09-18 06:52:42', '', 0, 1),
(42, 0, 'UG3U4WU5', '6056e9cf6ab9f059af0d4f60773e1fdc65077c050db5c36dc32b9398e8eadb29', '', '', 'Jdjdejdk', 'Ndnd', '2011-09-22', 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '1', '59.343060', '18.063221', '', '0', '0', 1, '+467887', '1', '', '', 'o0qCKcFqimage.jpg', '1', '0', 'bdnd@snnd.se', '', 'Male', '', '', '', '', 1, '', '', '', '2017-09-22 11:15:47', '', 1, 0),
(43, 0, 'PDSZ0KJ0', '6056e9cf6ab9f059af0d4f60773e1fdc65077c050db5c36dc32b9398e8eadb29', '', '', 'Bdnnd', 'Kdj', '2017-09-22', 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '0', '59.343082', '18.063244', 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.34306', '18.06325', 1, '+467887', '1', '', '', 'uetOgACvimage.jpg', '1', '0', 'bsjd@ns.se', 'ssssss', 'Male', '', '', '', '', 1, '', 'No', '0', '2017-09-22 11:57:24', '', 1, 1),
(44, 0, 'KU9EOZJA', '', 'Salong Hår', '555555', '', '', '', 'Birger Jarlsgatan 62, 111 39 Stockholm, Sverige', '', '59.34104', '18.06554', '', '', '', 0, '+46721460172', '', '', '', '7rCJHz0Rimage.jpg', '', '', 'karim.sayyad@gmail.com', 'ssssss', '', '', '', '', '', 3, '', '', '1', '2017-09-22 12:00:12', '', 1, 1),
(45, 44, 'WZG0QIZL', '', '', '', 'Behandalre', 'Vra', '2006-09-22', 'Birger Jarlsgatan 68, 113 56 Stockholm, Sverige', '1', '59.343094', '18.063320', '', '59.34309', '18.06322', 1, '+46721460172', '2', '09:00', '17:00', 'PB8AI28pimage.jpg', '2', '1', 'behandlare@salong.se', 'ssssss', 'Female', '', '', '', '', 4, '', 'No', '1', '2017-09-22 12:02:02', '', 1, 1),
(46, 0, 'R2WCMBQ7', 'e89058d74882e2f9f4c62549fe3e9f3935476969ddba15bc0e84cc89cd9d576d', '', '', 'R', 'R', '2017-09-23', 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '0', '22.713860', '75.874748', 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.71386', '75.87475', 1, '+46879465132', '1', '', '', 'Ib798IZUimage.jpg', '1', '0', 'gk@gk.com', '', 'Male', 'Hsjd', '', '', '', 1, '', '', '', '2017-09-23 14:26:32', '', 1, 0),
(48, 0, '4BGZVZRS', '', '', '', 'Kung Fu', 'Pandya', '1988-07-15', '81, Padmawati Colony Rd, Padmavati Colony, Indore, Madhya Pradesh 452001, India', '2', '22.712332', '75.890999', 'H-21, Van Shree Nagar, Anand Nagar, Navlakha, Indore, Madhya Pradesh 452001, India', '22.69172', '75.87791', 1, '+468528523697', '1', '', '', '1k5kT8ofimage.jpg', '1', '0', 'pandya@gmail.com', '123456', 'Male', '', 'Old Palasia', 'New Palasia', '2', 1, '', 'Yes', '1', '2017-09-25 07:26:25', '', 1, 1),
(49, 0, '486NEXTX', '', '', '', 'Job', 'Job', '1986-10-25', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '2', '22.713753', '75.874756', '33, Nehru Park Rd, Nehru Park 2, Shivaji Nagar, Indore, Madhya Pradesh 452003, India', '22.72121', '75.86922', 1, '+466542315645', '1', '', '', 'TtcuuufYimage.jpg', '1', '0', 'job@gmail.com', '', 'Male', '', '', '', '', 1, '', '', '', '2017-09-25 07:37:56', '', 1, 0),
(50, 0, 'IW7KQEIV', 'e89058d74882e2f9f4c62549fe3e9f3935476969ddba15bc0e84cc89cd9d576d', '', '', 'Snand', 'Djdj', '1996-02-25', 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '1', '22.713892', '75.874741', '', '0', '0', 1, '+466457896452', '1', '', '', 'yGfi7k9Rimage.jpg', '1', '0', 'haja@gmail.com', '', 'Male', '', '', '', '', 1, '', '', '', '2017-09-25 08:59:48', '', 1, 0),
(56, 0, 'H43W9QLO', '', '', '', 'July', 'Lee', '1999-10-09', 'Devrashi Complex, M.G-6, 166, Rabindranath Tagore Marg, Opp. Maans Bhawan, South Tukoganj, Indore, Madhya Pradesh 452001, India', '2', '22.7150777', '75.8736153', 'Devrashi Complex, M.G-6, 166, Rabindranath Tagore Marg, Opp. Maans Bhawan, South Tukoganj, Indore, Madhya Pradesh 452001, India', '22.7156621', '75.8736399', 1, '+46363259808', '1', '', '', 'CR7I8UAKprofileimg.jpg', '1', '1', 'july@gmail.com', '', 'Male', 'lovely...', '', '', '', 1, '', '', '', '2017-10-09 13:29:06', '', 0, 0),
(58, 0, 'FSQ0GQRK', 'd_E4-LlmKcg:APA91bE0cfzgly3wzfRJUYL6vnjdeyH_-OGHqxNPK8ltQ2vNMfnmyCZ8KzIytJz-AxyWKcELPtI-fodpvAdb59qWxUcx-eAT241QoIlk7ElcPNUMZml9PUty3sksyawba4cpUybVqP4E', '', '', 'Jack ', 'Ma', '2010-10-10', '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '0', '22.713946029002464', '75.87304584681988', '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713932999999997', '75.8730458', 1, '+469797977979', '2', '1:0', '6:0', 'GKDVBHX6profileimg.jpg', '2', '1', 'jackma@gmail.com', 'qwerty', 'Male', 'about jack john.', 'Nodshow', 'Chuilooo', '1', 1, '', 'Yes', '0', '2017-10-10 09:55:02', '', 0, 1),
(59, 0, 'D7WGDC5C', '', 'Sessior Saloon', '123467', 'Jack ', 'Ma', '2010-10-10', '57, Madhumilan Cinema Rd, South Tukoganj, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '0', '22.713453', '75.8747953', '', '', '', 0, '+464346464949', '2', '', '', 'sNF5E39Mprofileimg.jpg', '2', '1', 'sessior@gmail.com', '123456', 'Male', 'about jack john.', '', '', '', 3, '', '', '1', '2017-10-10 09:57:08', '', 0, 1),
(60, 59, 'TWC2TN33', '', '', '', 'Jackson', 'Lee', '2012-10-10', '164-165, Rabindranath Tagore Marg, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '0', '22.715140128759813', '75.8739822730422', '164-165, Rabindranath Tagore Marg, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.7150777', '75.8736153', 1, '+463636000000', '1', '', '', '9HPRdEdVprofileimg.jpg', '2', '1', 'jackson@gmail.com', 'qwerty', 'Male', 'jackson jack', '', '', '', 4, '', 'No', '1', '2017-10-10 10:24:13', '', 0, 1),
(63, 0, 'IXOO3W9Q', '', '', '', 'Rojen Erik', 'Sürek', '1981-10-25', 'Birger Jarlsgatan 8, 114 34 Stockholm, Sverige', '', '59.33421589999999', '18.0749681', '', '', '', 0, '+46707500393', '', '', '', 'X2BN6lo4profileimg.jpg', '', '', 'rojen.erik.surek@gmail.com', 'rojensurek1', 'Male', '', '', '', '', 2, '', '', '1', '2017-10-13 20:42:28', '17-10-17 03:57:24', 0, 1),
(64, 0, 'SCY5D7PP', 'eK2ZjSZ6w4g:APA91bFP_p-qtbEvDNFDg3ASfOD8LU9S-4SkJ6uVW0tkw42kqYg_oH1TfnxnbiCk3VFkthN2ga6nbHKju-tXKJ_o6_30aKPZOsUxEolrTb3bxhEAPt4VGoaJBm3RfUv-vacX4zUNL96y', '', '', 'Rojen', 'Surek', '1981-10-14', 'Stockholm, Sweden', '2', '59.329595899999994', '18.0680841', 'Södermannagatan 42, 116 39 Stockholm, Sverige', '59.3110489', '18.0813546', 0, '+465', '1', '', '', 'Z2mzvzCwprofileimg.jpg', '0', '1', 'rojen.erik.surek@gmail.com', 'rojensurek1', 'Male', '', '', '', '', 1, '', 'No', '0', '2017-10-14 20:39:52', '', 0, 1),
(67, 0, '4N2VKF5G', 'eTSsiaempqw:APA91bF7ebz3CAFo7sCvllmHNk1xuCvOfnHkxdA4l53HC76SwpKHmeqVlCbWjScPFSDnJrDclMJVf6heO6N0fZgMeQiNYGqfx6PItslDZaCL4rQ8NQVG9ybGpFalPtyZaAErMRi_6DnY', '', '', 'xbd', 'dh', '2017-10-16', '21, Rabindranath Tagore Marg, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '0', '22.713453', '75.8747953', '21, Rabindranath Tagore Marg, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713001199999997', '75.8752135', 1, '+466656568868', '1', '', '', 'V7rEJTxJprofileimg.jpg', '2', '1', 'j@gmail.com', '', 'Male', '', '', '', '', 1, '', '', '', '2017-10-16 12:44:28', '', 0, 0),
(68, 0, 'C9Z5MLII', '', '', '', 'Haydar ', 'Iich', '1988-06-25', 'Norgegatan 1, 164 32 Kista, Sverige', '', '59.406440533114925', '17.934310622513294', '', '', '', 0, '+46765550249', '', '', '', 'nrYYP4nkprofileimg.jpg', '', '', 'haydar.iich@gmail.com', 'Alert88a', 'Male', '', '', '', '', 2, '', '', '1', '2017-10-16 12:51:56', '', 0, 1),
(69, 0, 'XS2WNQEG', 'eTSsiaempqw:APA91bF7ebz3CAFo7sCvllmHNk1xuCvOfnHkxdA4l53HC76SwpKHmeqVlCbWjScPFSDnJrDclMJVf6heO6N0fZgMeQiNYGqfx6PItslDZaCL4rQ8NQVG9ybGpFalPtyZaAErMRi_6DnY', '', '', 'address ', 'snssn', '2017-10-16', 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '0', '22.7134406', '75.8747839', 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.7128972', '75.87477109999999', 1, '+465659598889', '1', '', '', 'QqgIDBEyprofileimg.jpg', '1', '1', 'ja@gmail.com', '', 'Male', '', '', '', '', 1, '', '', '', '2017-10-16 13:02:05', '', 0, 0),
(70, 0, 'M51SP1HH', 'ddA_JYQTpqo:APA91bGmNvFf2QcwJXUurF2MNH23NEEy3FRPXn55J6AtMS3EXzGBP-IavXr2RMoicoKDMuHHYVIpr1YFfd-S3IR-oj_Mug4rJhjP4bPqgOyw3U69_6BHYXpdtLERblaFEK-Lb0vVRURp', '', '', 'Suraj', 'Apptech', '1994-10-16', 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '0', '22.7134536647121', '75.87478391826153', 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.7128972', '75.87477109999999', 1, '+4618871243260', '1', '', '', 'KNXVdjRRprofileimg.jpg', '2', '1', 'suraj@gmail.com', 'qwerty', 'Male', '', 'MATRIX', 'MATRIX', '2', 1, '', 'Yes', '0', '2017-10-16 13:14:42', '', 0, 1),
(71, 0, 'BRCSC5VZ', '', '', '', 'Suraj', 'Shakya', '1990-10-01', 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '', '22.7135358', '75.8748293', '', '', '', 0, '+468871243260', '', '', '', 'YLsRlZRBprofileimg.jpg', '', '', 'surajapptech@gmail.com', 'qwerty', 'Male', 'Android dev.', '', '', '', 2, '', '', '1', '2017-10-17 05:19:08', '17-10-25 03:11:04', 0, 1),
(72, 0, '4AJIHP5F', 'eMBAfVKYRp0:APA91bElmIP2xWWyGfxJJDCtXMHBdhb7canb48Wh5PiN6Bcs7HLhzkuMh-Dew3p3ho9l-z6tmpH551-2bCKTByGNKDN2ZbhP6Lr_C1ugRhWftZlz-U2a2GyBw5OqMrN9yBSeTJxl8rWE', '', '', 'Suraj', 'Shakya', '1990-10-17', 'Sham Tower, No. 164 164/2, Rabindranath Tagore Marg, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '2', '22.7195187', '75.87557869999999', 'Sham Tower, No. 164 164/2, Rabindranath Tagore Marg, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.7150055', '75.8742954', 1, '+468871243260', '1', '', '', 'uS61pn35profileimg.jpg', '1', '1', 'surajapptech@gmail.com', 'qwerty', 'Male', 'Android', 'Specrtus ', 'Matrix', '2', 1, '', 'Yes', '0', '2017-10-17 05:20:39', '', 0, 1),
(73, 0, '8G7PWPIM', '', '', '', 'Bx', 'Vv', '2017-10-09', 'Rajat Complex', '2', '22.713440675177946', '75.87478391826153', '', '', '', 0, '+464545658522', '1', '', '', 'hF9wqMt3profileimg.jpg', '1', '0', 'freeking@gmail.com', 'qwerty', 'Male', '', '', '', '', 2, '', '', '1', '2017-10-17 08:52:55', '', 0, 1),
(74, 0, '6GUV3IIN', 'ddA_JYQTpqo:APA91bGmNvFf2QcwJXUurF2MNH23NEEy3FRPXn55J6AtMS3EXzGBP-IavXr2RMoicoKDMuHHYVIpr1YFfd-S3IR-oj_Mug4rJhjP4bPqgOyw3U69_6BHYXpdtLERblaFEK-Lb0vVRURp', '', '', 'f', 'c', '2017-10-17', 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '0', '22.713456757458143', '75.87478693574667', 'Rajat Complex, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713456757458143', '75.87478693574667', 1, '+4678455665545', '1', '', '', 'UKKPWfBjprofileimg.jpg', '1', '0', 'ff@gmail.com', '', 'Male', '', '', '', '', 1, '', '', '', '2017-10-17 09:08:13', '', 0, 0),
(75, 0, 'TUE17XQO', 'ewxXo3nqveQ:APA91bHuSjInnOHBqqMbdLI8RTLp2BX8rZnHNHJQ0tAGcEOxkFgR_xwGu9MJ2raxm_XdaSJW9JCbXLGIq3SrHEzQ0G2Va8k8qxPgtZwBVk4zp2xwobDCVRQqJF7oGteg1hjEOTbQJM-L', '', '', 'G', 'G', '2017-10-17', 'Stockholm, Sweden', '1', '59.329595899999994', '18.0680841', '11 Rue Payenne, 75003 Paris, Frankrike', '48.8581681', '2.3620771', 0, '+465', '2', '', '', 'BVciqYfIprofileimg.jpg', '0', '1', 'g', '', 'Man', 'h', '', '', '', 1, '', '', '', '2017-10-17 13:36:42', '', 0, 0),
(76, 0, 'ELYA2MCC', '', '', '', 'Asdf', 'Vvbb', '2017-10-23', 'Storkyrkobrinken 2', '', '59.326516465968375', '18.070953749120235', '', '', '', 0, '+465456525232', '', '', '', 'im8vrMkgprofileimg.jpg', '', '', 'vzhx@gmail.com', 'qwerty', 'Male', '', '', '', '', 2, '', '', '1', '2017-10-23 11:22:08', '', 0, 1),
(77, 0, 'Z89GX9SK', '', 'Sk?nhet On-demand', '9', '', '', '', 'Birger Jarlsgatan, Stockholm, Sweden', '', '59.341712997734305', '18.06516721844673', '', '', '', 0, '+467', '', '', '', 'yJn3ZFmVprofileimg.jpg', '', '', 'rojen.erik.surek@gmail.com', 'rojensurek1', '', '', '', '', '', 3, '', '', '0', '2017-11-05 18:20:45', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL COMMENT 'Giver',
  `provider_id` int(11) NOT NULL COMMENT 'Receiver',
  `rating` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `order_id`, `customer_id`, `provider_id`, `rating`, `comment`, `creat_at`) VALUES
(1, 1, 4, 4, '4.5', 'nice+work+by+you+thanks.%F0%9F%98%89', '2017-08-30 12:12:03'),
(2, 2, 12, 3, '5.0', 'Good work ', '2017-08-30 12:28:18'),
(3, 5, 7, 7, '3.5', 'Hiii+nice+job', '2017-08-30 12:42:23'),
(4, 0, 3, 12, '-1', 'Beställning stiden går ut', '2017-08-30 23:49:01'),
(5, 0, 15, 7, '-1', 'Beställning stiden går ut', '2017-08-31 02:08:01'),
(6, 0, 15, 7, '-1', 'Beställning stiden går ut', '2017-08-31 02:08:01'),
(7, 0, 15, 7, '-1', 'Beställning stiden går ut', '2017-08-31 23:53:01'),
(8, 11, 22, 23, '4.0', 'Super', '2017-09-02 19:38:32'),
(9, 11, 23, 22, '4.5', 'Bra!', '2017-09-02 19:41:23'),
(10, 12, 23, 22, '-1', 'Behandlaren avbokade denna bekräftade bokning.', '2017-09-02 19:46:10'),
(11, 13, 12, 3, '5.0', '', '2017-09-04 09:14:26'),
(12, 14, 14, 3, '4.5', 'Shandarrrr. . . . .', '2017-09-04 09:27:04'),
(13, 15, 12, 3, '5.0', 'Good', '2017-09-04 09:36:15'),
(14, 16, 3, 14, '-1', 'Behandlaren avbokade denna bekräftade bokning.', '2017-09-04 09:45:30'),
(15, 18, 14, 3, '5.0', 'Good service', '2017-09-04 09:53:47'),
(16, 15, 3, 3, '3.5', 'org.apache.http.entity.mime.content.StringBody@dc6e34', '2017-09-04 10:50:34'),
(17, 13, 3, 3, '4.5', 'org.apache.http.entity.mime.content.StringBody@20a68c7', '2017-09-04 11:15:35'),
(20, 21, 21, 16, '4.5', 'Nice', '2017-09-06 14:18:54'),
(23, 24, 21, 16, '5', 'Nice', '2017-09-15 10:25:14'),
(24, 24, 21, 16, '5', 'Nice', '2017-09-15 10:33:07'),
(30, 0, 21, 16, '-1', 'Beställning stiden går ut', '2017-09-16 00:58:01'),
(31, 0, 3, 16, '-1', 'Beställning stiden går ut', '2017-09-18 14:03:01'),
(32, 34, 16, 21, '3.5', 'Hi shubham good cutting', '2017-09-19 11:37:22'),
(33, 34, 21, 16, '4.5', 'Good service cheaitan', '2017-09-19 11:43:00'),
(34, 0, 21, 16, '-1', 'Beställning stiden går ut', '2017-09-19 23:26:01'),
(35, 36, 22, 23, '4.0', 'Bra', '2017-09-22 11:38:25'),
(36, 36, 23, 22, '1.5', 'Helt ok', '2017-09-22 11:41:55'),
(37, 37, 23, 22, '-1', 'Behandlaren avbokade denna bekräftade bokning.', '2017-09-22 11:45:36'),
(38, 0, 3, 12, '-1', 'Beställning stiden går ut', '2017-09-25 18:38:01'),
(39, 0, 47, 48, '-1', 'Beställning stiden går ut', '2017-09-25 21:25:01'),
(40, 0, 40, 41, '-1', 'Beställning stiden går ut', '2017-09-27 00:58:01'),
(41, 43, 7, 33, '4.5', 'Good', '2017-09-29 07:24:58'),
(42, 0, 33, 12, '-1', 'Beställning stiden går ut', '2017-09-29 19:16:02'),
(43, 52, 55, 55, '3.5', 'org.apache.http.entity.mime.content.StringBody@2a8248ad', '2017-10-10 08:45:56'),
(44, 55, 35, 35, '3.5', 'org.apache.http.entity.mime.content.StringBody@9272142', '2017-10-10 11:24:12'),
(45, 59, 36, 36, '3.5', 'org.apache.http.entity.mime.content.StringBody@9f60869', '2017-10-11 09:52:26'),
(46, 59, 36, 36, '3.0', 'org.apache.http.entity.mime.content.StringBody@3ddef55', '2017-10-11 09:52:54'),
(47, 59, 36, 36, '5.0', 'org.apache.http.entity.mime.content.StringBody@78e26eb', '2017-10-11 09:53:07'),
(48, 50, 55, 55, '3.5', 'org.apache.http.entity.mime.content.StringBody@3289bd58', '2017-10-13 08:10:46'),
(49, 49, 55, 55, '5.0', 'org.apache.http.entity.mime.content.StringBody@30292ce', '2017-10-13 08:15:18'),
(50, 49, 55, 55, '5.0', 'org.apache.http.entity.mime.content.StringBody@1ef99630', '2017-10-13 08:16:10'),
(51, 49, 55, 55, '4.0', 'org.apache.http.entity.mime.content.StringBody@1a3b3b85', '2017-10-13 08:19:04'),
(52, 62, 55, 55, '3.5', 'org.apache.http.entity.mime.content.StringBody@39bd6da5', '2017-10-13 08:19:39'),
(53, 61, 41, 41, '3.5', 'org.apache.http.entity.mime.content.StringBody@202f4c56', '2017-10-13 08:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category`, `sub_category`, `create_at`) VALUES
(1, 'FRISÖR', 'Herrklippning', '2017-03-02 05:01:51'),
(2, 'FRISÖR ', 'Damklippning', '2017-03-02 05:02:37'),
(3, 'FRISÖR ', 'Barnklippning', '2017-03-02 05:02:37'),
(4, 'FRISÖR', 'Hårfön', '2017-03-02 05:03:04'),
(5, 'FRISÖR', 'Hårförlängning', '2017-03-02 05:03:04'),
(6, 'FRISÖR', 'Feststyling', '2017-03-02 05:03:36'),
(7, 'FRISÖR', 'Uppsättning', '2017-03-02 05:03:36'),
(8, 'FRISÖR ', 'Färgning/toning ', '2017-03-02 05:04:28'),
(9, 'SMINKNING', 'Dag sminkning', '2017-03-02 05:04:28'),
(10, 'SMINKNING', 'Kväll/fest sminkning', '2017-03-02 05:04:28'),
(11, 'SMINKNING', 'Brud sminkning', '2017-03-02 10:37:59'),
(12, 'SMINKNING', 'Tärna sminkning', '2017-03-02 10:37:59'),
(13, 'NAGLAR', 'Förlängning med akryl', '2017-03-02 10:38:27'),
(14, 'NAGLAR', 'Förlängning med gelé', '2017-03-02 10:38:27'),
(15, 'NAGLAR', 'Förstärkning med akryl', '2017-03-02 10:38:56'),
(16, 'NAGLAR', 'Förstärkning med gelé', '2017-03-02 10:38:56'),
(17, 'NAGLAR', 'Fyllning ', '2017-03-02 10:39:30'),
(18, 'NAGLAR', 'Manikyr ', '2017-03-02 10:39:30'),
(19, 'NAGLAR', 'Pedikyr', '2017-03-02 10:40:07'),
(20, 'FRANSAR', 'Singelfransar', '2017-03-02 10:40:07'),
(21, 'FRANSAR', 'Volymfransar', '2017-03-02 10:40:54'),
(22, 'FRANSAR', 'Färgning', '2017-03-02 10:40:54'),
(23, 'MASSAGE', 'Klassisk massage, 20 minuter', '2017-03-02 10:41:25'),
(24, 'MASSAGE', 'Klassisk massage, 50 minuter', '2017-03-02 10:41:25'),
(25, 'MASSAGE', 'Klassisk massage, 80 minuter', '2017-03-02 10:41:50'),
(26, 'MASSAGE', 'Lymfmassage, 80 minuter', '2017-03-02 10:41:50'),
(27, 'MASSAGE', 'Terapeutisk massage, 50 minuter', '2017-03-02 10:44:41'),
(28, 'MASSAGE', 'Terapeutisk massage, 80 minuter', '2017-03-02 10:44:41'),
(29, 'MASSAGE', 'Ansiktsmassage, 20 minuter', '2017-03-02 10:44:41'),
(30, 'MASSAGE', 'Ansiktsmassage, 50 minuter', '2017-03-02 10:44:41'),
(31, 'MASSAGE', 'Ansiktsmassage, 80 minuter', '2017-03-02 10:44:41'),
(32, 'VAXNING', 'Ben', '2017-03-02 10:44:41'),
(33, 'VAXNING', 'Bikinilinje', '2017-03-02 10:44:41'),
(34, 'VAXNING', 'Armhålor', '2017-03-02 10:44:41'),
(35, 'VAXNING', 'Haka/överläpp', '2017-03-02 10:44:41'),
(36, 'VAXNING', 'Brasiliansk vaxning', '2017-03-02 10:44:41'),
(37, 'VAXNING', 'Bröst (herr)', '2017-03-02 10:45:19'),
(38, 'VAXNING', 'Rygg (herr)', '2017-03-02 10:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `service_rate`
--

CREATE TABLE IF NOT EXISTS `service_rate` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `pricetype` varchar(255) NOT NULL COMMENT '0=perhour, 1=wholeday',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `service_rate`
--

INSERT INTO `service_rate` (`id`, `user_id`, `service_id`, `price`, `pricetype`, `created_at`, `update_at`) VALUES
(1, 4, 22, '20', '1', '2017-08-30 09:58:55', ''),
(2, 4, 21, '50', '1', '2017-08-30 09:58:55', ''),
(3, 7, 20, '12', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(4, 7, 22, '13', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(5, 7, 21, '15', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(6, 7, 1, '18', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(7, 7, 8, '20', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(8, 7, 7, '30', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(9, 7, 6, '21', '1', '2017-08-30 10:15:56', '2017-7-31 10:40'),
(10, 9, 20, '11', '1', '2017-08-30 10:39:38', ''),
(11, 9, 22, '14', '1', '2017-08-30 10:39:38', ''),
(12, 9, 21, '20', '1', '2017-08-30 10:39:38', ''),
(13, 9, 1, '21', '1', '2017-08-30 10:39:38', ''),
(14, 9, 8, '26', '1', '2017-08-30 10:39:38', ''),
(15, 9, 7, '30', '1', '2017-08-30 10:39:38', ''),
(16, 9, 6, '13', '1', '2017-08-30 10:39:38', ''),
(17, 9, 3, '9', '1', '2017-08-30 10:39:38', ''),
(18, 9, 2, '6', '1', '2017-08-30 10:39:38', ''),
(19, 9, 4, '17', '1', '2017-08-30 10:39:38', ''),
(20, 9, 5, '12', '1', '2017-08-30 10:39:38', ''),
(21, 9, 29, '15', '1', '2017-08-30 10:39:38', ''),
(22, 9, 31, '13', '1', '2017-08-30 10:39:38', ''),
(23, 9, 23, '30', '1', '2017-08-30 10:39:38', ''),
(24, 9, 24, '20', '1', '2017-08-30 10:39:38', ''),
(25, 9, 25, '25', '1', '2017-08-30 10:39:38', ''),
(26, 9, 30, '60', '1', '2017-08-30 10:39:38', ''),
(27, 12, 20, '10', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(28, 12, 22, '14', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(29, 12, 21, '25', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(30, 12, 1, '20', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(31, 12, 8, '24', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(32, 12, 7, '30', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(33, 12, 6, '21', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(34, 12, 3, '18', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(35, 12, 2, '10', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(36, 12, 4, '12', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(37, 12, 29, '17', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(38, 12, 31, '25', '1', '2017-08-30 11:08:01', '2017-08-30 19:07'),
(40, 14, 20, '12', '1', '2017-08-30 12:43:11', ''),
(41, 14, 22, '19', '1', '2017-08-30 12:43:11', ''),
(42, 14, 21, '23', '1', '2017-08-30 12:43:11', ''),
(43, 14, 1, '9', '1', '2017-08-30 12:43:11', ''),
(44, 14, 8, '8', '1', '2017-08-30 12:43:11', ''),
(45, 14, 7, '16', '1', '2017-08-30 12:43:11', ''),
(46, 14, 6, '14', '1', '2017-08-30 12:43:11', ''),
(47, 14, 3, '10', '1', '2017-08-30 12:43:11', ''),
(48, 14, 29, '25', '1', '2017-08-30 12:43:11', ''),
(49, 14, 31, '30', '1', '2017-08-30 12:43:11', ''),
(50, 14, 23, '20', '1', '2017-08-30 12:43:11', ''),
(51, 16, 20, '21', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(52, 16, 22, '21', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(53, 16, 21, '31', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(54, 16, 1, '1', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(55, 16, 7, '2', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(56, 16, 6, '3', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(57, 16, 4, '12', '1', '2017-08-30 13:21:40', '2017-7-31 19:0'),
(58, 7, 32, '45', '1', '2017-08-31 05:10:20', '2017-7-31 10:40'),
(59, 19, 20, '10', '1', '2017-08-31 09:00:54', ''),
(60, 18, 20, '10', '1', '2017-08-31 09:00:56', ''),
(61, 22, 1, '1', '1', '2017-09-02 19:15:14', '2017-09-02 21:23'),
(62, 24, 1, '1', '1', '2017-09-02 19:18:46', ''),
(63, 25, 29, '1', '1', '2017-09-02 19:19:58', ''),
(65, 28, 20, '12', '1', '2017-09-04 08:42:20', ''),
(66, 28, 22, '23', '1', '2017-09-04 08:42:20', ''),
(67, 29, 20, '12', '1', '2017-09-04 09:48:57', ''),
(68, 30, 20, '12', '1', '2017-09-05 05:23:13', ''),
(69, 30, 22, '13', '1', '2017-09-05 05:23:13', ''),
(71, 31, 20, '12', '1', '2017-09-05 06:01:01', ''),
(72, 32, 20, '10', '1', '2017-09-16 08:36:23', ''),
(73, 32, 22, '11', '1', '2017-09-16 08:36:23', ''),
(74, 32, 21, '12', '1', '2017-09-16 08:36:23', ''),
(75, 32, 1, '13', '1', '2017-09-16 08:36:23', ''),
(76, 32, 8, '14', '1', '2017-09-16 08:36:23', ''),
(77, 32, 7, '15', '1', '2017-09-16 08:36:23', ''),
(78, 32, 6, '16', '1', '2017-09-16 08:36:23', ''),
(79, 32, 3, '17', '1', '2017-09-16 08:36:23', ''),
(80, 32, 2, '18', '1', '2017-09-16 08:36:23', ''),
(81, 32, 29, '19', '1', '2017-09-16 08:36:23', ''),
(82, 32, 31, '20', '1', '2017-09-16 08:36:23', ''),
(83, 32, 23, '21', '1', '2017-09-16 08:36:23', ''),
(84, 35, 20, '12', '1', '2017-09-16 10:16:56', ''),
(85, 35, 22, '12', '1', '2017-09-16 10:16:56', ''),
(86, 35, 29, '13', '1', '2017-09-16 10:16:56', ''),
(88, 36, 20, '8', '1', '2017-09-16 10:18:49', ''),
(89, 36, 22, '8', '1', '2017-09-16 10:18:49', ''),
(90, 36, 21, '4', '1', '2017-09-16 10:18:49', ''),
(91, 36, 1, '5', '1', '2017-09-16 10:18:49', ''),
(92, 36, 8, '4', '1', '2017-09-16 10:18:49', ''),
(93, 36, 2, '8', '1', '2017-09-16 10:18:49', ''),
(94, 39, 20, '67', '1', '2017-09-16 11:34:47', ''),
(95, 39, 22, '8', '1', '2017-09-16 11:34:47', ''),
(96, 41, 20, '20', '1', '2017-09-18 06:52:57', '2017-9-10 14:25'),
(97, 41, 22, '30', '1', '2017-09-18 06:52:57', '2017-9-10 14:25'),
(98, 42, 1, '1', '1', '2017-09-22 11:15:53', ''),
(99, 43, 19, '3', '1', '2017-09-22 11:57:30', ''),
(100, 45, 1, '3', '1', '2017-09-22 12:03:03', ''),
(101, 45, 8, '3', '1', '2017-09-22 12:03:03', ''),
(102, 45, 7, '3', '1', '2017-09-22 12:03:03', ''),
(103, 45, 6, '3', '1', '2017-09-22 12:03:03', ''),
(104, 45, 3, '3', '1', '2017-09-22 12:03:03', ''),
(105, 45, 2, '3', '1', '2017-09-22 12:03:03', ''),
(106, 45, 4, '3', '1', '2017-09-22 12:03:03', ''),
(107, 45, 5, '3', '1', '2017-09-22 12:03:03', ''),
(108, 46, 32, '2', '1', '2017-09-23 14:26:55', ''),
(109, 48, 20, '2', '1', '2017-09-25 09:11:53', ''),
(110, 48, 22, '3', '1', '2017-09-25 09:11:53', ''),
(111, 48, 21, '4', '1', '2017-09-25 09:11:53', ''),
(112, 48, 1, '5', '1', '2017-09-25 09:11:53', ''),
(113, 48, 8, '6', '1', '2017-09-25 09:11:53', ''),
(114, 48, 7, '7', '1', '2017-09-25 09:11:53', ''),
(115, 48, 6, '8', '1', '2017-09-25 09:11:53', ''),
(116, 48, 3, '9', '1', '2017-09-25 09:11:53', ''),
(117, 48, 2, '10', '1', '2017-09-25 09:11:53', ''),
(118, 48, 4, '11', '1', '2017-09-25 09:11:53', ''),
(119, 48, 5, '12', '1', '2017-09-25 09:11:53', ''),
(120, 48, 29, '13', '1', '2017-09-25 09:11:53', ''),
(121, 48, 31, '14', '1', '2017-09-25 09:11:53', ''),
(122, 48, 19, '15', '1', '2017-09-25 09:11:53', ''),
(123, 48, 18, '16', '1', '2017-09-25 09:11:53', ''),
(124, 48, 17, '17', '1', '2017-09-25 09:11:53', ''),
(125, 54, 1, '10', '1', '2017-10-04 06:22:07', ''),
(126, 54, 7, '20', '1', '2017-10-04 06:22:07', ''),
(129, 56, 18, '10', '1', '2017-10-09 13:29:35', ''),
(130, 56, 17, '5', '1', '2017-10-09 13:29:35', ''),
(131, 56, 18, '10', '1', '2017-10-09 13:29:35', ''),
(132, 56, 17, '5', '1', '2017-10-09 13:29:35', ''),
(133, 41, 9, '10', '1', '2017-10-10 08:55:51', ''),
(134, 57, 32, '250', '1', '2017-10-10 09:50:30', ''),
(135, 57, 38, '360', '1', '2017-10-10 09:50:30', ''),
(136, 58, 32, '100', '1', '2017-10-10 09:55:18', ''),
(137, 58, 34, '120', '1', '2017-10-10 09:55:18', ''),
(138, 60, 20, '5', '1', '2017-10-10 10:24:33', ''),
(139, 60, 22, '5', '1', '2017-10-10 10:24:33', ''),
(140, 64, 1, '900', '1', '2017-10-14 20:42:31', ''),
(141, 66, 20, '10', '1', '2017-10-16 11:52:59', ''),
(142, 70, 20, '2', '1', '2017-10-16 13:14:54', ''),
(143, 72, 20, '10', '1', '2017-10-17 05:21:15', ''),
(144, 37, 20, '10', '1', '2017-10-17 08:50:12', ''),
(145, 37, 22, '25', '1', '2017-10-17 08:50:12', ''),
(146, 37, 21, '21', '1', '2017-10-17 08:50:12', ''),
(147, 12, 38, '2', '1', '2017-10-25 11:20:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `userdays`
--

CREATE TABLE IF NOT EXISTS `userdays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `day` int(20) NOT NULL COMMENT '0=Sun,1=Mon,2=Tue,3=Wed, 4=Thu,5=Fri,6=Sat',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `userdays`
--

INSERT INTO `userdays` (`id`, `user_id`, `day`, `timestamp`) VALUES
(3, 14, 0, '2017-08-30 13:14:57'),
(4, 4, 0, '2017-08-31 05:52:40'),
(20, 30, 0, '2017-09-05 05:52:53'),
(30, 32, 0, '2017-09-16 08:49:28'),
(33, 35, 0, '2017-09-16 11:41:11'),
(35, 16, 0, '2017-09-19 05:31:10'),
(39, 22, 0, '2017-09-22 11:23:16'),
(40, 45, 1, '2017-09-22 12:02:02'),
(41, 45, 2, '2017-09-22 12:02:02'),
(42, 45, 3, '2017-09-22 12:02:02'),
(43, 45, 4, '2017-09-22 12:02:02'),
(44, 45, 5, '2017-09-22 12:02:02'),
(47, 7, 0, '2017-09-29 07:30:32'),
(48, 57, 4, '2017-10-10 09:50:10'),
(49, 57, 3, '2017-10-10 09:50:10'),
(50, 57, 1, '2017-10-10 09:50:10'),
(51, 57, 2, '2017-10-10 09:50:10'),
(52, 58, 1, '2017-10-10 09:55:02'),
(53, 58, 2, '2017-10-10 09:55:02'),
(54, 58, 3, '2017-10-10 09:55:02'),
(55, 58, 4, '2017-10-10 09:55:02'),
(56, 58, 5, '2017-10-10 09:55:02'),
(57, 12, 0, '2017-10-25 11:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_discount`
--

CREATE TABLE IF NOT EXISTS `user_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `referaler_user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `type` int(10) NOT NULL COMMENT '0=% 1=currency',
  `discount_type` int(10) NOT NULL COMMENT '0=General,1=Referral,1=Sponsor',
  `status` int(11) NOT NULL COMMENT '0=not, 1=take',
  `referal_type` int(11) NOT NULL COMMENT '0=receiver, 1=sender',
  `taken_timestamp` varchar(50) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_discount`
--

INSERT INTO `user_discount` (`id`, `customer_id`, `referaler_user_id`, `order_id`, `code`, `discount`, `type`, `discount_type`, `status`, `referal_type`, `taken_timestamp`, `creat_at`) VALUES
(1, 23, 0, 12, 'start10', '10', 0, 0, 1, 0, '2017-09-02 21:44', '2017-09-02 19:43:48'),
(2, 55, 0, 0, 'START10', '10', 0, 0, 0, 0, '', '2017-10-10 05:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `workarea`
--

CREATE TABLE IF NOT EXISTS `workarea` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `address_status` int(10) NOT NULL COMMENT '0=fix, 1= moving',
  `user_id` int(20) NOT NULL,
  `area_address` varchar(255) NOT NULL,
  `area_lat` varchar(50) NOT NULL,
  `area_lng` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `workarea`
--

INSERT INTO `workarea` (`id`, `address_status`, `user_id`, `area_address`, `area_lat`, `area_lng`, `created_at`, `update_at`) VALUES
(1, 0, 4, '5%2F5%2C+Nath+Mandir+Road%0ASouth+Tukoganj%0AIndore%2C+Madhya+Pradesh+452001%0A', '22.71842361742713', '75.8749408274889', '2017-08-30 09:58:39', ''),
(2, 1, 4, 'Rajat Complex\nGF-14-18, Chhawni Road\nOpp. Shriram Lodge, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n', '22.7134614', '75.8747613', '2017-08-30 09:58:39', ''),
(107, 0, 41, 'Green Park Colony\nSouth Tukoganj\nIndore, Madhya Pradesh 452001\n', '22.71882318512739', '75.87469272315502', '2017-09-18 06:52:42', ''),
(3, 0, 5, '563, Mahatma Gandhi Rd, Agarwal Nagar, Shivaji Nagar, Indore, Madhya Pradesh 452003, Indien', '22.720253', '75.871066', '2017-08-30 09:59:45', ''),
(4, 1, 5, '87, Murai Mohalla, Indore, Madhya Pradesh 452001, Indien', '22.709139', '75.874870', '2017-08-30 09:59:45', ''),
(5, 0, 6, 'my hospital backside Rd, CRP Line, Indore, Madhya Pradesh 452001, Indien', '22.713919', '75.881706', '2017-08-30 10:06:24', ''),
(6, 1, 6, 'Kanchan Bag Main Rd, South Tukoganj, Indore, Madhya Pradesh 452001, Indien', '22.719584', '75.879463', '2017-08-30 10:06:24', ''),
(139, 0, 7, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, Indien', '22.713961', '75.874719', '2017-09-29 07:30:32', '2017-09-29 09:30:32'),
(9, 0, 8, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, Indien', '22.713869', '75.874762', '2017-08-30 10:24:33', ''),
(10, 1, 8, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, Indien', '22.713869', '75.874763', '2017-08-30 10:24:33', ''),
(11, 0, 9, '3, Agra Bombay Rd, Crp Line, South Tukoganj, Tukoganj, Indore, Madhya Pradesh 452001, Indien', '22.711727', '75.883055', '2017-08-30 10:38:30', ''),
(12, 1, 9, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71374054', '75.87483346', '2017-08-30 10:38:30', ''),
(13, 0, 11, 'Scheme No 94, Eastern Ring Rd, Shri Ram Nagar, Indore, Madhya Pradesh 452016, Indien', '22.720244', '75.906101', '2017-08-30 11:03:17', ''),
(14, 1, 11, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713577', '75.874901', '2017-08-30 11:03:17', ''),
(63, 1, 28, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713623', '75.874504', '2017-09-04 08:42:08', ''),
(160, 0, 12, 'org.apache.http.entity.mime.content.StringBody@2d647e1d', '22.751237', '75.895524', '2017-10-25 11:18:39', '2017-10-25 01:18:39'),
(148, 1, 64, '', '48.8498349', '2.3876739', '2017-10-14 20:42:14', ''),
(140, 1, 7, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375200', '75.87475700', '2017-09-29 07:30:32', '2017-09-29 09:30:32'),
(23, 0, 14, 'Devi Ahilya Marg, Indore GPO, Indore, Madhya Pradesh 452003, India', '22.728242', '75.862911', '2017-08-30 13:14:57', '2017-08-30 03:14:57'),
(24, 1, 14, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71375200', '75.87475700', '2017-08-30 13:14:57', '2017-08-30 03:14:57'),
(108, 1, 41, '', '22.7134406', '75.8747839', '2017-09-18 06:52:42', ''),
(29, 0, 20, '?irinyal? Mahallesi, 1537. Sk. No:14, 07160 Muratpa?a/Antalya, Turkiet', '36.851800', '30.746409', '2017-08-31 09:34:15', ''),
(30, 1, 20, '?irinyal? Mahallesi, 1537. Sk. No:14, 07160 Muratpa?a/Antalya, Turkiet', '36.851784', '30.746401', '2017-08-31 09:34:15', ''),
(62, 0, 28, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713713', '75.874780', '2017-09-04 08:42:08', ''),
(118, 1, 22, '', '', '', '2017-09-22 11:23:16', '2017-09-22 01:23:16'),
(119, 0, 45, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.343095', '18.063219', '2017-09-22 12:02:02', ''),
(33, 0, 24, 'Uggelviksgatan 3, 114 27 Stockholm, Sverige', '59.344285', '18.068939', '2017-09-02 19:18:42', ''),
(34, 1, 24, 'Karlavägen 14B, 114 31 Stockholm, Sverige', '59.343380', '18.066460', '2017-09-02 19:18:42', ''),
(35, 0, 25, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.342964', '18.063280', '2017-09-02 19:19:53', ''),
(36, 1, 25, 'Birger Jarlsgatan 68, 113 56 Stockholm, Sverige', '59.342983', '18.063396', '2017-09-02 19:19:53', ''),
(117, 0, 22, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.343060', '18.063178', '2017-09-22 11:23:16', '2017-09-22 01:23:16'),
(109, 0, 16, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713692', '75.874595', '2017-09-19 05:31:10', '2017-09-19 07:31:10'),
(95, 0, 36, '40/2, Kibe Compound, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.713877', '75.872985', '2017-09-16 10:18:27', ''),
(64, 0, 29, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713744', '75.874477', '2017-09-04 09:48:50', ''),
(65, 1, 29, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713745', '75.874474', '2017-09-04 09:48:50', ''),
(159, 0, 12, 'org.apache.http.entity.mime.content.StringBody@3dd706f4', '22.7135358', '75.8748293', '2017-10-25 11:18:39', '2017-10-25 01:18:39'),
(76, 1, 30, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.71373107', '75.87478635', '2017-09-05 05:52:53', '2017-09-05 07:52:53'),
(75, 0, 30, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713579', '75.874599', '2017-09-05 05:52:53', '2017-09-05 07:52:53'),
(84, 1, 31, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713676', '75.874802', '2017-09-05 06:00:51', ''),
(83, 0, 31, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, Indien', '22.713676', '75.874803', '2017-09-05 06:00:51', ''),
(106, 1, 35, 'Rajat Complex\nGF-14-18, Chhawni Road\nOpp. Shriram Lodge, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n', '22.7134406', '75.8747839', '2017-09-16 11:41:11', '2017-09-16 01:41:11'),
(96, 1, 36, 'Rajat Complex\nGF-14-18, Chhawni Road\nOpp. Shriram Lodge, Kibe Compound, Chhoti Gwaltoli\nIndore, Madhya Pradesh 452001\n', '22.7134057', '75.8746478', '2017-09-16 10:18:27', ''),
(157, 0, 75, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329323448902436', '18.06858066469431', '2017-10-17 13:36:42', ''),
(155, 0, 37, 'Silver Mall', '22.716796573126544', '75.87380524724722', '2017-10-17 08:49:30', ''),
(156, 1, 37, 'Silver Mall', '22.7165318', '75.8737455', '2017-10-17 08:49:30', ''),
(101, 0, 39, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713670', '75.874605', '2017-09-16 11:34:35', ''),
(102, 1, 39, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713671', '75.874702', '2017-09-16 11:34:35', ''),
(105, 0, 35, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713675', '75.874525', '2017-09-16 11:41:11', '2017-09-16 01:41:11'),
(110, 1, 16, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.71369237', '75.87472634', '2017-09-19 05:31:10', '2017-09-19 07:31:10'),
(111, 0, 42, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.343042', '18.063212', '2017-09-22 11:15:47', ''),
(112, 1, 42, 'Birger Jarlsgatan 65A, 113 56 Stockholm, Sverige', '59.343060', '18.063221', '2017-09-22 11:15:47', ''),
(120, 1, 45, '', '', '', '2017-09-22 12:02:02', ''),
(133, 0, 48, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.713901', '75.874739', '2017-09-25 09:07:06', ''),
(127, 0, 49, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713752', '75.874757', '2017-09-25 07:37:56', ''),
(128, 1, 49, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713753', '75.874756', '2017-09-25 07:37:56', ''),
(134, 1, 48, 'The Grace Building, NH 59, Murai Mohalla, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.71366460', '75.87466743', '2017-09-25 09:07:06', ''),
(131, 0, 50, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.713892', '75.874737', '2017-09-25 08:59:48', ''),
(132, 1, 50, 'Indore - Bhopal Rd, Murai Mohalla, Indore, Madhya Pradesh 452001, India', '22.713892', '75.874741', '2017-09-25 08:59:48', ''),
(141, 0, 54, '16, Madhumilan Square, Opp. Shri Ram Lodge, Kibe Compound, Indore, Madhya Pradesh 452001, India', '22.713952833019196', '75.8744553476572', '2017-10-04 06:21:44', ''),
(142, 1, 54, '', '22.713453', '75.8747953', '2017-10-04 06:21:44', ''),
(143, 0, 56, '164-165, Rabindranath Tagore Marg, Chhoti Gwaltoli, Indore, Madhya Pradesh 452001, India', '22.715132706260473', '75.87412677705288', '2017-10-09 13:29:06', ''),
(144, 1, 56, 'Devrashi Complex, M.G-6, 166, Rabindranath Tagore Marg, Opp. Maans Bhawan, South Tukoganj, Indore, Madhya Pradesh 452001, India', '22.7150777', '75.8736153', '2017-10-09 13:29:06', ''),
(147, 0, 64, 'Gustav Adolfs torg 24, 111 52 Stockholm, Sverige', '59.329323448902436', '18.06858066469431', '2017-10-14 20:42:14', ''),
(149, 0, 66, 'Yashwant Club Rd, Sanghi Colony, Race Course Road, Indore, Madhya Pradesh 452001, India', '22.724378354187024', '75.87542530149221', '2017-10-16 11:45:50', ''),
(150, 1, 66, '', '22.7134077', '75.8746705', '2017-10-16 11:45:50', ''),
(151, 0, 67, 'Unnamed Road, Nananwas, Rajasthan 322203, India', '26.313339241976845', '76.55811052769423', '2017-10-16 12:44:28', ''),
(152, 1, 67, 'Unnamed Road, Nananwas, Rajasthan 322203, India', '26.307242', '76.5661622', '2017-10-16 12:44:28', ''),
(153, 0, 72, 'Ankur aangan, S Tukoganj Street 1, South Tukoganj, Indore, Madhya Pradesh 452001, India', '22.71961334846813', '75.87571162730455', '2017-10-17 05:20:39', ''),
(154, 1, 72, '', '22.7134406', '75.8747839', '2017-10-17 05:20:39', ''),
(158, 1, 75, 'Stockholm, Sweden', '59.329595899999994', '18.0680841', '2017-10-17 13:36:42', ''),
(161, 1, 12, '', '22.7135337', '75.8748066', '2017-10-25 11:18:39', '2017-10-25 01:18:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
