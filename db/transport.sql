-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 09:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transport`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `aId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area_user` int(11) NOT NULL,
  `updateAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `createAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`aId`, `name`, `area_user`, `updateAt`, `createAt`) VALUES
(24, 'Budhwara', 9, '2019-08-14 05:53:43', '2019-08-14 05:53:43'),
(25, 'Ganj', 9, '2019-08-14 05:53:52', '2019-08-14 05:53:52'),
(26, 'Bada Bazar', 9, '2019-08-14 05:54:04', '2019-08-14 05:54:04'),
(28, 'Kannod Road', 9, '2019-08-14 05:54:31', '2019-08-14 05:54:31'),
(29, 'Ali Pura', 9, '2019-08-14 05:54:43', '2019-08-14 05:54:43'),
(30, 'Gaon', 9, '2019-08-14 05:56:06', '2019-08-14 05:56:06'),
(34, 'Bus Stand', 9, '2019-08-14 10:39:55', '2019-08-14 10:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

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
(49, 'CG', 'Congo', 242),
(50, 'CD', 'Congo The Democratic Republic Of The', 242),
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
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `dId` int(11) NOT NULL,
  `dl_memono` varchar(255) NOT NULL,
  `dl_dlybasis` varchar(255) NOT NULL,
  `dl_mode` varchar(255) NOT NULL,
  `dl_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dl_area` int(11) NOT NULL,
  `dl_labour` varchar(255) NOT NULL,
  `dl_consignor` varchar(255) NOT NULL,
  `dl_consignee` varchar(255) NOT NULL,
  `dl_recivedby` varchar(255) NOT NULL,
  `dl_dueto` varchar(255) NOT NULL,
  `dl_biltyno` varchar(255) NOT NULL,
  `dl_biltydate` date NOT NULL DEFAULT '0000-00-00',
  `dl_arrivedate` date NOT NULL DEFAULT '0000-00-00',
  `dl_from` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dl_packages` varchar(255) NOT NULL,
  `dl_contains` varchar(255) NOT NULL,
  `dl_weight` decimal(15,2) NOT NULL,
  `dl_transport` varchar(255) NOT NULL,
  `dl_paymode` varchar(255) NOT NULL,
  `dl_taxable` tinyint(1) NOT NULL,
  `dl_lorryno` varchar(255) NOT NULL,
  `dl_frieght` decimal(15,2) NOT NULL,
  `dl_dc` decimal(15,2) NOT NULL,
  `dl_hammali` decimal(15,2) NOT NULL,
  `dl_demurrage` decimal(15,2) NOT NULL,
  `dl_other` decimal(15,2) NOT NULL,
  `dl_subtotal` decimal(15,2) NOT NULL,
  `dl_tax` decimal(15,2) NOT NULL,
  `dl_total` decimal(15,2) NOT NULL,
  `dl_refund` decimal(15,2) NOT NULL,
  `dl_nettotal` decimal(15,2) NOT NULL,
  `dl_remark` varchar(255) NOT NULL,
  `dl_userid` int(11) NOT NULL,
  `dl_delete` tinyint(1) NOT NULL DEFAULT 0,
  `dl_createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `dl_updateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`dId`, `dl_memono`, `dl_dlybasis`, `dl_mode`, `dl_date`, `dl_area`, `dl_labour`, `dl_consignor`, `dl_consignee`, `dl_recivedby`, `dl_dueto`, `dl_biltyno`, `dl_biltydate`, `dl_arrivedate`, `dl_from`, `dl_packages`, `dl_contains`, `dl_weight`, `dl_transport`, `dl_paymode`, `dl_taxable`, `dl_lorryno`, `dl_frieght`, `dl_dc`, `dl_hammali`, `dl_demurrage`, `dl_other`, `dl_subtotal`, `dl_tax`, `dl_total`, `dl_refund`, `dl_nettotal`, `dl_remark`, `dl_userid`, `dl_delete`, `dl_createAt`, `dl_updateAt`) VALUES
(1, '1900000', '', 'Due', '2019-08-14 10:22:36', 26, '0.00', 'Consignor1', 'rahul', '', '', '789654', '2019-08-22', '2019-08-15', '', '2', '', '0.00', '', '', 0, '', '500.00', '0.00', '0.00', '0.00', '0.00', '500.00', '0.00', '500.00', '0.00', '500.00', '', 9, 1, '2019-08-14 06:25:08', '2019-08-14 06:34:21'),
(2, '1900001', '', 'Paid', '2019-09-08 06:23:05', 26, '0.00', 'ddd', 'ee', 'Received', 'Due to', '455', '2019-08-15', '2019-08-16', 'From', '1', 's', '50.00', '', '', 0, '', '88.00', '50.00', '10.00', '0.00', '0.00', '148.00', '0.00', '148.00', '0.00', '148.00', '', 9, 0, '2019-08-14 07:18:49', '2019-09-08 02:53:05'),
(3, '1900002', '', 'Paid', '2019-09-08 06:23:18', 26, '0.00', 'Test', 'tester', 'Received', '', '789654', '2019-08-16', '2019-08-16', '', '3', '', '0.00', '', '', 0, '', '500.00', '10.00', '100.00', '0.00', '0.00', '610.00', '0.00', '610.00', '0.00', '610.00', '', 9, 0, '2019-08-14 19:03:12', '2019-09-08 02:53:18'),
(4, '1900003', '', 'Paid', '2019-08-14 19:24:30', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-08-14 15:54:30'),
(5, '1900004', '', 'Paid', '2019-08-14 19:24:09', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-08-14 15:54:09'),
(6, '1900005', '', 'Paid', '2019-08-13 18:30:00', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-08-14 22:39:16'),
(7, '1900006', '', 'Paid', '2019-08-14 19:14:19', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-08-14 15:44:19'),
(8, '1900007', '', 'Due', '2019-09-08 06:17:07', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-09-08 02:47:07'),
(9, '1900008', '', 'Due', '2019-09-08 06:15:38', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-09-08 02:45:38'),
(10, '1900009', '', 'Paid', '2019-09-01 14:00:53', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-09-01 10:30:53'),
(11, '1900010', '', 'Due', '2019-08-26 18:30:00', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-09-01 13:44:10'),
(12, '1900011', '', 'Paid', '2019-08-08 18:30:00', 24, '0.00', 'Consignor', 'Consignee1', 'Received', 'Due to', '852147', '2019-08-16', '2019-08-16', '', '1', '', '0.00', '', '', 0, '', '1000.00', '30.00', '66.00', '0.00', '0.00', '1096.00', '0.00', '1096.00', '0.00', '1096.00', '', 9, 0, '2019-08-14 19:04:28', '2019-08-14 22:39:50'),
(13, '1900012', '', 'Due', '2019-11-19 16:16:22', 29, '89', 'sadf', 'rrr', 'ds', 'sdf', '345', '2019-09-18', '2019-09-27', 'indore', '1', '', '0.00', '', '', 0, '', '900.00', '10.00', '50.00', '0.00', '0.00', '1049.00', '0.00', '1049.00', '0.00', '1049.00', '', 9, 0, '2019-09-01 13:50:03', '2019-11-19 11:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

CREATE TABLE `delivery_items` (
  `di_id` int(11) NOT NULL,
  `di_pid` int(11) NOT NULL,
  `di_pname` varchar(255) NOT NULL,
  `di_uid` int(11) NOT NULL,
  `di_uname` varchar(255) NOT NULL,
  `di_qty` int(5) NOT NULL,
  `di_did` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`di_id`, `di_pid`, `di_pname`, `di_uid`, `di_uname`, `di_qty`, `di_did`) VALUES
(10, 14, 'Bartan Dag', 22, 'Bandle', 55, 1),
(11, 21, 'Chana Box', 23, 'Bori', 66, 1),
(12, 9, 'Fitting Box', 23, 'Bori', 55, 2),
(13, 14, 'Bartan Dag', 23, 'Bori', 55, 3),
(14, 10, 'Khopra Bura Kai', 29, 'Bandle', 66, 3),
(15, 16, 'Kapda Gathan', 23, 'Bori', 88, 3),
(16, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 4),
(17, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 5),
(19, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 7),
(20, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 8),
(21, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 9),
(22, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 10),
(25, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 6),
(26, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 12),
(29, 14, 'Bartan Dag', 29, 'Bandle', 4, 13),
(30, 15, 'Kheti Dawai Box', 29, 'Bandle', 55, 11);

-- --------------------------------------------------------

--
-- Table structure for table `logaction`
--

CREATE TABLE `logaction` (
  `logid` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logaction`
--

INSERT INTO `logaction` (`logid`, `keyword`, `description`) VALUES
(1, 'Login', 'User Login'),
(2, 'Invalid_Login', 'Invalid user name and passoward'),
(3, 'Logout', 'User Logout from the system'),
(4, 'Change_Password', 'User Change Password');

-- --------------------------------------------------------

--
-- Table structure for table `packingunit`
--

CREATE TABLE `packingunit` (
  `pkuId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pku_user` int(11) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packingunit`
--

INSERT INTO `packingunit` (`pkuId`, `name`, `pku_user`, `createAt`, `updateAt`) VALUES
(21, 'Katta', 9, '2019-08-14 06:00:28', '2019-08-14 06:00:28'),
(23, 'Bori', 9, '2019-08-14 06:00:47', '2019-08-14 06:00:47'),
(24, 'Dag', 9, '2019-08-14 06:00:56', '2019-08-14 06:00:56'),
(25, 'Box', 9, '2019-08-14 06:01:06', '2019-08-14 06:01:06'),
(26, 'Gathan', 9, '2019-08-14 06:01:16', '2019-08-14 06:01:16'),
(29, 'Bandle', 9, '2019-08-14 11:47:20', '2019-08-14 11:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `pro_userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pro_created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `pro_updatedate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `pro_userid`, `name`, `pro_created_date`, `pro_updatedate`) VALUES
(8, 9, 'Dawai Box', '2019-08-14 05:57:01', '2019-08-14 05:57:01'),
(9, 9, 'Fitting Box', '2019-08-14 05:57:11', '2019-08-14 05:57:11'),
(10, 9, 'Khopra Bura Kai', '2019-08-14 06:01:36', '2019-08-14 06:01:36'),
(11, 9, 'Kata Tar Banda', '2019-08-14 06:01:49', '2019-08-14 06:01:49'),
(12, 9, 'Plastic Bardan', '2019-08-14 06:01:59', '2019-08-14 06:01:59'),
(13, 9, 'Popcorn Bora', '2019-08-14 06:02:11', '2019-08-14 06:02:11'),
(14, 9, 'Bartan Dag', '2019-08-14 06:02:25', '2019-08-14 06:02:25'),
(15, 9, 'Kheti Dawai Box', '2019-08-14 06:02:37', '2019-08-14 02:33:38'),
(16, 9, 'Kapda Gathan', '2019-08-14 06:02:48', '2019-08-14 06:02:48'),
(17, 9, 'U.Pvc Pipe Banc', '2019-08-14 06:02:57', '2019-08-14 06:02:57'),
(18, 9, 'S.W.R PIPE', '2019-08-14 06:03:07', '2019-08-14 06:03:07'),
(19, 9, 'Spre Pump Box', '2019-08-14 06:03:54', '2019-08-14 06:03:54'),
(20, 9, 'Nariyal Bori ii', '2019-08-14 06:04:07', '2019-08-14 06:04:07'),
(21, 9, 'Chana Box', '2019-08-14 06:04:23', '2019-08-14 06:04:23'),
(22, 9, 'ashish', '2020-01-19 09:29:34', '2020-01-19 09:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `pdid` int(255) NOT NULL,
  `pd_pid` int(11) NOT NULL,
  `pd_session` varchar(255) NOT NULL,
  `pd_userid` int(11) NOT NULL,
  `pd_productid` int(11) NOT NULL,
  `pd_deletestatus` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`pdid`, `pd_pid`, `pd_session`, `pd_userid`, `pd_productid`, `pd_deletestatus`) VALUES
(1, 1, '0', 6, 6, '1');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `statecodenumber` varchar(11) NOT NULL,
  `statecode` varchar(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `statecodenumber`, `statecode`, `country_id`) VALUES
(1, 'Andaman and Nicobar Islands', '35', 'AN', 101),
(2, 'Andhra Pradesh', '28', 'AP', 101),
(3, 'Arunachal Pradesh', '12', 'AR', 101),
(4, 'Assam', '18', 'AS', 101),
(5, 'Bihar', '10', 'BH', 101),
(6, 'Chandigarh', '04', 'CH', 101),
(7, 'Chhattisgarh', '22', 'CT', 101),
(8, 'Dadra and Nagar Haveli', '26', 'DN', 101),
(9, 'Daman and Diu', '25', 'DD', 101),
(10, 'Delhi', '07', 'DL', 101),
(11, 'Goa', '30', 'GA', 101),
(12, 'Gujarat', '24', 'GJ', 101),
(13, 'Haryana', '06', 'HR', 101),
(14, 'Himachal Pradesh', '02', 'HP', 101),
(15, 'Jammu and Kashmir', '01', 'JK', 101),
(16, 'Jharkhand', '20', 'JH', 101),
(17, 'Karnataka', '29', 'KA', 101),
(19, 'Kerala', '32', 'KL', 101),
(20, 'Lakshadweep Islands', '31', 'LD', 101),
(21, 'Madhya Pradesh', '23', 'MP', 101),
(22, 'Maharashtra', '27', 'MH', 101),
(23, 'Manipur', '14', 'MN', 101),
(24, 'Meghalaya', '17', 'ME', 101),
(25, 'Mizoram', '15', 'MI', 101),
(26, 'Nagaland', '13', 'NL', 101),
(29, 'Odisha', '21', 'OR', 101),
(31, 'Pondicherry', '34', 'PY', 101),
(32, 'Punjab', '03', 'PB', 101),
(33, 'Rajasthan', '08', 'RJ', 101),
(34, 'Sikkim', '11', 'SK', 101),
(35, 'Tamil Nadu', '33', 'TN', 101),
(36, 'Telangana', '36', 'TS', 101),
(37, 'Tripura', '16', 'TR', 101),
(38, 'Uttar Pradesh', '09', 'UP', 101),
(39, 'Uttarakhand', '05', 'UT', 101),
(41, 'West Bengal', '19', 'WB', 101),
(4121, 'Andhra Pradesh (New)', '37', 'AD', 101);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `use_fullname` varchar(255) NOT NULL,
  `use_email` varchar(255) NOT NULL,
  `use_password` varchar(255) NOT NULL,
  `use_phone` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `use_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `use_fullname`, `use_email`, `use_password`, `use_phone`, `created_date`, `update_date`, `use_last_login`) VALUES
(9, 'aamir khan', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9993671019', '2019-08-04 13:30:38', '0000-00-00 00:00:00', '2020-02-03 15:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `ulid` int(255) NOT NULL,
  `ul_userid` int(11) NOT NULL,
  `ul_action` varchar(255) NOT NULL,
  `ul_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`ulid`, `ul_userid`, `ul_action`, `ul_time`) VALUES
(1, 9, 'Login', '2019-08-04 10:01:39'),
(2, 9, 'Login', '2019-08-04 10:01:57'),
(3, 9, 'Invalid_Login', '2019-08-04 10:11:17'),
(4, 9, 'Invalid_Login', '2019-08-04 10:48:05'),
(5, 9, 'Login', '2019-08-04 10:49:45'),
(6, 9, 'Invalid_Login', '2019-08-04 10:49:53'),
(7, 9, 'Login', '2019-08-04 10:49:56'),
(8, 9, 'Logout', '2019-08-04 10:57:55'),
(9, 9, 'Login', '2019-08-04 11:00:40'),
(10, 9, 'Logout', '2019-08-04 12:25:47'),
(11, 9, 'Login', '2019-08-04 12:25:57'),
(12, 9, 'Change_Password', '2019-08-04 12:27:58'),
(13, 9, 'Invalid_Login', '2019-08-04 13:27:32'),
(14, 9, 'Invalid_Login', '2019-08-04 13:27:39'),
(15, 9, 'Login', '2019-08-04 13:27:45'),
(16, 9, 'Logout', '2019-08-05 01:17:32'),
(17, 9, 'Invalid_Login', '2019-08-05 01:17:48'),
(18, 9, 'Invalid_Login', '2019-08-05 01:17:53'),
(19, 9, 'Invalid_Login', '2019-08-05 01:17:57'),
(20, 9, 'Invalid_Login', '2019-08-05 01:18:06'),
(21, 9, 'Invalid_Login', '2019-08-05 01:18:14'),
(22, 9, 'Login', '2019-08-05 01:19:39'),
(23, 9, 'Login', '2019-08-05 06:26:17'),
(24, 9, 'Login', '2019-08-05 09:09:20'),
(25, 9, 'Login', '2019-08-10 06:20:09'),
(26, 9, 'Logout', '2019-08-10 06:44:08'),
(27, 9, 'Login', '2019-08-10 06:44:11'),
(28, 9, 'Logout', '2019-08-10 06:44:15'),
(29, 9, 'Login', '2019-08-10 06:44:19'),
(30, 9, 'Login', '2019-08-10 07:18:46'),
(31, 9, 'Login', '2019-08-10 12:38:50'),
(32, 9, 'Login', '2019-08-11 03:30:32'),
(33, 6, 'Logout', '2019-08-11 09:14:35'),
(34, 9, 'Login', '2019-08-11 09:14:37'),
(35, 9, 'Logout', '2019-08-11 09:16:23'),
(36, 9, 'Login', '2019-08-11 09:16:24'),
(37, 9, 'Login', '2019-08-11 12:34:22'),
(38, 9, 'Login', '2019-08-12 09:17:06'),
(39, 9, 'Login', '2019-08-13 10:33:19'),
(40, 9, 'Login', '2019-08-13 14:00:30'),
(41, 9, 'Login', '2019-08-13 14:05:25'),
(42, 9, 'Login', '2019-08-13 14:23:37'),
(43, 6, 'Logout', '2019-08-13 14:57:59'),
(44, 9, 'Login', '2019-08-13 14:58:00'),
(45, 9, 'Login', '2019-08-14 01:35:31'),
(46, 9, 'Login', '2019-08-14 10:54:47'),
(47, 9, 'Login', '2019-08-14 21:28:09'),
(48, 9, 'Login', '2019-08-14 22:49:38'),
(49, 9, 'Logout', '2019-08-14 22:50:32'),
(50, 9, 'Login', '2019-08-15 03:04:18'),
(51, 9, 'Login', '2019-08-29 13:01:03'),
(52, 9, 'Login', '2019-08-29 20:29:35'),
(53, 9, 'Login', '2019-09-01 08:03:44'),
(54, 9, 'Login', '2019-09-01 10:04:10'),
(55, 9, 'Login', '2019-09-01 13:16:58'),
(56, 9, 'Login', '2019-09-08 11:56:35'),
(57, 9, 'Login', '2019-09-08 01:45:41'),
(58, 9, 'Login', '2019-09-08 01:59:07'),
(59, 9, 'Login', '2019-11-02 22:19:55'),
(60, 9, 'Login', '2019-11-19 11:45:50'),
(61, 9, 'Login', '2020-01-19 04:27:02'),
(62, 9, 'Login', '2020-02-03 15:23:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`dId`);

--
-- Indexes for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD PRIMARY KEY (`di_id`);

--
-- Indexes for table `logaction`
--
ALTER TABLE `logaction`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `packingunit`
--
ALTER TABLE `packingunit`
  ADD PRIMARY KEY (`pkuId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD PRIMARY KEY (`pdid`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`ulid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `aId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `dId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `delivery_items`
--
ALTER TABLE `delivery_items`
  MODIFY `di_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `logaction`
--
ALTER TABLE `logaction`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packingunit`
--
ALTER TABLE `packingunit`
  MODIFY `pkuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  MODIFY `pdid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4122;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `ulid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
