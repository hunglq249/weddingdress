-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 01, 2018 lúc 07:35 PM
-- Phiên bản máy phục vụ: 10.1.22-MariaDB
-- Phiên bản PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `weddingdress_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `facebook` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_at` datetime NOT NULL,
  `modified_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `about`
--

INSERT INTO `about` (`id`, `image`, `is_deleted`, `facebook`, `instagram`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(28, 'team-1.jpg', 0, '', '', '2018-02-10 04:28:14', 'administrator', '2018-02-10 04:28:14', 'administrator'),
(29, 'team-2.jpg', 0, '', '', '2018-02-10 04:29:37', 'administrator', '2018-02-10 04:29:37', 'administrator'),
(30, 'team-3.jpg', 0, '', '', '2018-02-10 04:30:54', 'administrator', '2018-02-10 04:30:54', 'administrator');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `about_lang`
--

CREATE TABLE `about_lang` (
  `id` int(11) NOT NULL,
  `about_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `about_lang`
--

INSERT INTO `about_lang` (`id`, `about_id`, `name`, `slug`, `position`, `description`, `language`) VALUES
(33, 28, 'THOMAS ANDERSON', 'thomas-anderson', 'Executif Chef', '\"Every day brings more pleasure and sense of marvel. When New York city waking up and going to sleep is simply magical.\"', 'en'),
(34, 28, 'THOMAS ANDERSON', 'thomas-anderson', 'Executif Chef', '\"1111111Every day brings more pleasure and sense of marvel. When New York city waking up and going to sleep is simply magical.\"', 'hu'),
(35, 29, 'ROBERTO CONTADOR', 'roberto-contador', 'Chef', '\"Every day brings more pleasure and sense of marvel. When New York city waking up and going to sleep is simply magical.\"', 'en'),
(36, 29, 'ROBERTO CONTADOR', 'roberto-contador', 'Séf', '\"Minden nap nagyobb örömöt és csodálkozást hoznak, amikor New York-i város ébred és alszik, egyszerűen varázslatos.\"', 'hu'),
(37, 30, 'ANTUAN BUCHON', 'antuan-buchon', 'Pastry Chef', '\"Every day brings more pleasure and sense of marvel. When New York city waking up and going to sleep is simply magical.\"', 'en'),
(38, 30, 'ANTUAN BUCHON', 'antuan-buchon', 'Cukrász', '\"Minden nap nagyobb örömöt és csodálkozást hoznak, amikor New York-i város ébred és alszik, egyszerűen varázslatos.\"', 'hu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` text,
  `category_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `is_activated` tinyint(1) DEFAULT '1',
  `text` varchar(255) DEFAULT NULL,
  `url` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `image`, `category_id`, `type`, `is_activated`, `text`, `url`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(10, 'photo-1519741497674-611481863552.jpg', 27, 1, 0, NULL, NULL, '2018-11-27 14:29:57', 'administrator', '2018-11-27 14:29:57', 'administrator', 0),
(11, '2222.jpg', 22, 0, 0, NULL, NULL, '2018-12-02 00:12:26', 'administrator', '2018-12-02 00:12:26', 'administrator', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner_lang`
--

CREATE TABLE `banner_lang` (
  `id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner_lang`
--

INSERT INTO `banner_lang` (`id`, `banner_id`, `title`, `description`, `content`, `language`) VALUES
(1, 1, 'It was popularised in the 1960s with the release', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'vi'),
(2, 1, 'It was popularised in the 1960s with the release', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'en'),
(3, 2, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'vi'),
(4, 2, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'en'),
(5, 3, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'vi'),
(6, 3, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'en'),
(7, 4, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'vi'),
(8, 4, 'Contrary to popular belief, Lorem Ipsum is not simply random text', 'Contrary to popular belief, Lorem Ipsum is not simply random text', '', 'en'),
(9, 5, 'test 11', '', '', 'vi'),
(10, 5, 'test2222222', '', '', 'en'),
(11, 6, 'Du xuaan', '', '', 'vi'),
(12, 6, 'Du xuaan EN', '', '', 'en'),
(13, 7, 'aaaaaaaaaaaa', '', '', 'vi'),
(14, 7, 'aaaaaaaaaaaa', '', '', 'en'),
(15, 8, 'sssssssssssss', '', '', 'vi'),
(16, 8, 'dddddddddd', '', '', 'en'),
(17, 9, 'dddddd', '', '', 'vi'),
(18, 9, 'ssssssssssssssss', '', '', 'en'),
(19, 10, '', '', '', 'vi'),
(20, 10, '', '', '', 'en'),
(21, 11, '', '', '', 'vi'),
(22, 11, '', '', '', 'en');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1d6d2ef5cbe48491b53b5c2ae95d1d4f14c98f82', '::1', 1516590779, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363539303735363b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353134333939313533223b);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_left` text COLLATE utf8mb4_unicode_ci,
  `image_right` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activated` tinyint(4) DEFAULT '0' COMMENT '0: active; 1: deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `collection`
--

INSERT INTO `collection` (`id`, `slug`, `parent_id`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `image_left`, `image_right`, `is_activated`) VALUES
(0, 'khong-1', 0, 0, '2018-11-29 11:02:53', 'administrator', '2018-11-29 11:02:53', 'administrator', 'photo-1519741497674-611481863552.jpg', '2222.jpg', 0),
(27, 'bo-suu-tap-2018', 0, 0, '2018-11-28 10:26:14', 'administrator', '2018-11-28 10:26:14', 'administrator', '2222.jpg', 'photo-1519741497674-611481863552.jpg', 0),
(30, 'bo-suu-tap-hot', 0, 0, '2018-11-29 13:53:57', 'administrator', '2018-11-29 13:53:57', 'administrator', '2222.jpg', 'photo-1519741497674-611481863552.jpg', 0),
(31, 'bo-suu-tap-noi-bat', 0, 0, '2018-11-29 13:55:16', 'administrator', '2018-11-29 13:55:16', 'administrator', 'photo-1519741497674-611481863552.jpg', '2222.jpg', 0),
(32, 'bo-suu-tap-2019', 0, 0, '2018-11-29 13:55:47', 'administrator', '2018-11-29 13:55:47', 'administrator', '2222.jpg', 'photo-1519741497674-611481863552.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `collection_lang`
--

CREATE TABLE `collection_lang` (
  `id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakeywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `collection_lang`
--

INSERT INTO `collection_lang` (`id`, `collection_id`, `title`, `description`, `content`, `metadescription`, `metakeywords`, `language`) VALUES
(97, 27, '      Bộ sưu tập 2018', '      Bộ sưu tập 2018', '', '      Bộ sưu tập 2018', '      Bộ sưu tập 2018', 'vi'),
(98, 27, 'Collection 2018      ', 'Collection 2018      ', '', 'Collection 2018      ', 'Collection 2018      ', 'en'),
(99, 0, 'Không', '', '', '', '', 'vi'),
(100, 0, 'No', '', '', '', '', 'en'),
(101, 30, 'Bộ sưu tập hot', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 cửa hàng ở Mỹ Luv hiểu những gì nó cần để biến giấc mơ của bạn thành hiện thực.Ciel đã trở thành một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '', '', '', 'vi'),
(102, 30, ' Hot collection', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 cửa hàng ở Mỹ Luv hiểu những gì nó cần để biến giấc mơ của bạn thành hiện thực.Ciel đã trở thành một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '', '', '', 'en'),
(103, 31, 'Bộ sưu tập nổi bật', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 cửa hàng ở Mỹ Luv hiểu những gì nó cần để biến giấc mơ của bạn thành hiện thực.Ciel đã trở thành một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '', '', '', 'vi'),
(104, 31, 'Highlights collection', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 cửa hàng ở Mỹ Luv hiểu những gì nó cần để biến giấc mơ của bạn thành hiện thực.Ciel đã trở thành một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '', '', '', 'en'),
(105, 32, 'Bộ sưu tập 2019', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 cửa hàng ở Mỹ Luv hiểu những gì nó cần để biến giấc mơ của bạn thành hiện thực.Ciel đã trở thành một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '', '', '', 'vi'),
(106, 32, 'Collection 2019', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 cửa hàng ở Mỹ Luv hiểu những gì nó cần để biến giấc mơ của bạn thành hiện thực.Ciel đã trở thành một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '', '', '', 'en');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `vi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `code_color` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `color`
--

INSERT INTO `color` (`id`, `vi`, `en`, `is_deleted`, `code_color`) VALUES
(1, 'Màu Xanh', 'Green', 0, '#137134'),
(2, 'Màu Vàng', 'Yellow', 0, '#ffff00'),
(3, 'Màu Xanh Nước Biển', 'Blue', 0, '#3c3cdb');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `product_id`, `user_id`, `content`, `ip_address`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `is_activated`) VALUES
(1, 56, 1, 'ANH THẾ GIỚI VÀ EM - HƯƠNG TRÀM SINGER ( OFFICIAL Lyric Video )', '::1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 0),
(2, 56, 1, 'ANH THẾ GIỚI VÀ EM - HƯƠNG TRÀM SINGER ( OFFICIAL Lyric Video )', '::1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 1, 0),
(3, 56, 1, 'ANH THẾ GIỚI VÀ EM - HƯƠNG TRÀM SINGER ( OFFICIAL Lyric Video )', '::1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 0),
(4, 56, 1, 'ANH THẾ GIỚI VÀ EM - HƯƠNG TRÀM SINGER ( OFFICIAL Lyric Video )', '::1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 1, 0),
(5, 56, 1, 'ANH THẾ GIỚI VÀ EM - HƯƠNG TRÀM SINGER ( OFFICIAL Lyric Video )', '::1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 1, 0),
(6, 56, 1, 'ANH THẾ GIỚI VÀ EM - HƯƠNG TRÀM SINGER ( OFFICIAL Lyric Video )', '::1', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config_contact`
--

CREATE TABLE `config_contact` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_send_mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `address`, `tel`, `email`, `title`, `is_deleted`) VALUES
(3, 'Shop D 102 Charters Towers Road, Hermit Park QLD 4810, Australia1', '84 1234 5678', 'contact@ciel.vn', 'Shop D', 0),
(4, 'Shop D 102 Charters Towers Road, Hermit Park QLD 4810, Australia2', '84 1234 5678', 'contact@ciel.vn', 'Shop D', 0),
(5, 'Shop D 102 Charters Towers Road, Hermit Park QLD 4810, Australia3', '84 1234 5678', 'contact@ciel.vn', 'Shop D', 0),
(6, 'Shop D 102 Charters Towers Road, Hermit Park QLD 4810, Australia4', '84 1234 5678', 'contact@ciel.vn', 'Shop D', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'members_client', 'General User Client');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_activated` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `check_menu_children` int(11) NOT NULL DEFAULT '0' COMMENT '0 : nochildrenmenu; 1 : childrenmenue',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_post` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_lang`
--

CREATE TABLE `menu_lang` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `templates_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_activated` tinyint(4) DEFAULT '0' COMMENT '0 : active; 1 : deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `post_category_id`, `templates_id`, `slug`, `avatar`, `image`, `data`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `is_activated`) VALUES
(1, 3, 24, 'post-new1', '', '2222.jpg', '[]', '2018-11-27 15:01:20', 'administrator', '2018-11-27 15:01:20', 'administrator', 0, 0),
(2, 1, 24, 'kinh-nghiem-1', '', '2222.jpg', '[]', '2018-11-29 11:52:40', 'administrator', '2018-11-29 11:52:40', 'administrator', 0, 0),
(3, 1, 24, 'kinh-nghiem', '', '2222.jpg', '[]', '2018-11-29 11:51:28', 'administrator', '2018-11-29 11:51:28', 'administrator', 0, 0),
(4, 4, 24, 'tin-khuyen-mai', '', 'photo-1519741497674-611481863552.jpg', '[]', '2018-11-30 12:15:11', 'administrator', '2018-11-30 12:15:11', 'administrator', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_category`
--

CREATE TABLE `post_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `project` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `sort` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '0 : list; 1 : detail',
  `is_activated` tinyint(4) DEFAULT '0' COMMENT '0 : active; 1 : deactive',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_category`
--

INSERT INTO `post_category` (`id`, `slug`, `parent_id`, `project`, `image`, `sort`, `type`, `is_activated`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 've-chung-toi', 0, '', '2222.jpg', NULL, NULL, 0, 0, '2018-12-02 00:01:39', 'administrator', '2018-12-02 00:01:39', 'administrator'),
(2, 'noi-den', 0, '', 'photo-1519741497674-611481863552.jpg', NULL, NULL, 0, 1, '2018-11-26 12:56:33', 'administrator', '2018-11-26 12:56:33', 'administrator'),
(3, 'blogs-tin-tuc', 0, '', '22221.jpg', NULL, NULL, 0, 0, '2018-11-26 13:00:37', 'administrator', '2018-11-26 13:00:37', 'administrator'),
(4, 'khuyen-mai', 0, '', '22222.jpg', NULL, NULL, 0, 0, '2018-11-29 13:40:13', 'administrator', '2018-11-29 13:40:13', 'administrator');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_category_lang`
--

CREATE TABLE `post_category_lang` (
  `id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakeywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `metadescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_category_lang`
--

INSERT INTO `post_category_lang` (`id`, `post_category_id`, `title`, `description`, `content`, `language`, `metakeywords`, `metadescription`) VALUES
(1, 1, '   Về Chúng Tôi', '  Xin chúc mừng bạn đã tham gia', '<p class=\"paragraph\">ou&rsquo;ve got the man&hellip; you&rsquo;ve got the ring&hellip; you&rsquo;re now a bride-to- be!</p>\r\n<p class=\"paragraph\">Planning a wedding can be overwhelming and sometimes a little stressful &ndash; so many choices&hellip; so many decisions. Amongst the chaos, you should expect your bridal gown shopping experience to be a treasured highlight. Seeing yourself in that gown that perfectly fits your wedding vision, should be an unforgettable once-in- a-lifetime moment. It should be exciting, special, fun, full of emotion and experienced with those you love most. Most of all&hellip;it should be all about you.You are a bride. You are beautiful, determined and deserving of a perfect beginning to your happily after. Most of all, you are unique. Your perfect bridal gown will reflect your inner individuality and exclusively designed fairytale.</p>\r\n<p class=\"paragraph\">Your bridal gown shopping experience should be as unique and unforgettable as you are. Creating that unforgettable experience for you is what drives us. You&rsquo;re what we do&hellip; You&rsquo;re who we are&hellip; You&rsquo;re the star of our show. When you visit one of our nine showrooms, you can expect to be embraced with 40 years of bridal experience. We house bridal gowns by the best designers the world has to offer, catering for lovers of timelessly elegant designs to embracers of modern cutting-edge fashion. Our Bridal Stylists are chosen for their experience, knowledge and most of all, their ability to give you a bridal gown shopping experience that will become a cherished memory.</p>', 'vi', '   ', '   '),
(2, 1, 'About   ', ' Congratulations You\'re engaged  ', '<p class=\"paragraph\">ou&rsquo;ve got the man&hellip; you&rsquo;ve got the ring&hellip; you&rsquo;re now a bride-to- be!</p>\r\n<p class=\"paragraph\">Planning a wedding can be overwhelming and sometimes a little stressful &ndash; so many choices&hellip; so many decisions. Amongst the chaos, you should expect your bridal gown shopping experience to be a treasured highlight. Seeing yourself in that gown that perfectly fits your wedding vision, should be an unforgettable once-in- a-lifetime moment. It should be exciting, special, fun, full of emotion and experienced with those you love most. Most of all&hellip;it should be all about you.You are a bride. You are beautiful, determined and deserving of a perfect beginning to your happily after. Most of all, you are unique. Your perfect bridal gown will reflect your inner individuality and exclusively designed fairytale.</p>\r\n<p class=\"paragraph\">Your bridal gown shopping experience should be as unique and unforgettable as you are. Creating that unforgettable experience for you is what drives us. You&rsquo;re what we do&hellip; You&rsquo;re who we are&hellip; You&rsquo;re the star of our show. When you visit one of our nine showrooms, you can expect to be embraced with 40 years of bridal experience. We house bridal gowns by the best designers the world has to offer, catering for lovers of timelessly elegant designs to embracers of modern cutting-edge fashion. Our Bridal Stylists are chosen for their experience, knowledge and most of all, their ability to give you a bridal gown shopping experience that will become a cherished memory.</p>', 'en', '   ', '   '),
(3, 2, 'Nơi Đến', '', '', 'vi', '', ''),
(4, 2, 'ARRIVALS', '', '', 'en', '', ''),
(5, 3, 'Blogs & Tin Tức', '', '', 'vi', '', ''),
(6, 3, 'Blogs & News', '', '', 'en', '', ''),
(7, 4, 'Khuyến Mãi', '', '', 'vi', '', ''),
(8, 4, 'Promotion', '', '', 'en', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_lang`
--

CREATE TABLE `post_lang` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_lang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakeywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `metadescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_lang`
--

INSERT INTO `post_lang` (`id`, `post_id`, `title`, `description`, `content`, `data_lang`, `language`, `metakeywords`, `metadescription`) VALUES
(1, 1, 'Bài viết mới1', 'Bài viết mới2', '<p>B&agrave;i viết mới3</p>', '{\"tu_khoa_meta\":\"B\\u00e0i vi\\u1ebft m\\u1edbi4\",\"mo_ta_meta\":\"B\\u00e0i vi\\u1ebft m\\u1edbi5\"}', 'vi', '', ''),
(2, 1, 'Post new1', 'Post new2', '<p>Post new3</p>', '{\"tu_khoa_meta\":\"Post new4\",\"mo_ta_meta\":\"Post new5\"}', 'en', '', ''),
(3, 2, 'Kinh nghiệm', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '<p>Ciel l&agrave; một phần của phong cảnh c&ocirc; d&acirc;u &Uacute;c từ năm 2009 v&agrave; mang đến cho ng&agrave;nh c&ocirc;ng nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa h&agrave;ng tr&ecirc;n to&agrave;n quốc v&agrave; 3 cửa h&agrave;ng ở Mỹ Luv hiểu những g&igrave; n&oacute; cần để biến giấc mơ của bạn th&agrave;nh hiện thực.Ciel đ&atilde; trở th&agrave;nh một phần của phong cảnh c&ocirc; d&acirc;u &Uacute;c từ năm 2009 v&agrave; mang đến cho ng&agrave;nh c&ocirc;ng nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa h&agrave;ng tr&ecirc;n to&agrave;n quốc v&agrave; 3 ở Mỹ Luv hiểu những g&igrave; n&oacute; cần để l&agrave;m cho ng&agrave;y của những giấc mơ của bạn trở th&agrave;nh sự thật.</p>', '{\"tu_khoa_meta\":\"Kinh nghi\\u1ec7m\",\"mo_ta_meta\":\"Kinh nghi\\u1ec7m\"}', 'vi', '', ''),
(4, 2, 'Experience', 'Ciel has been part of the Australian bridal landscape since 2009 and brings to the industry over 40 years of experience. With 9 stores nationwide and 3 in the USA Luv understands what it takes to make the day of your dreams come true.', '<p>Ciel has been part of the Australian bridal landscape since 2009 and brings to the industry over 40 years of experience. With 9 stores nationwide and 3 in the USA Luv understands what it takes to make the day of your dreams come true.Ciel has been part of the Australian bridal landscape since 2009 and brings to the industry over 40 years of experience. With 9 stores nationwide and 3 in the USA Luv understands what it takes to make the day of your dreams come true.</p>', '{\"tu_khoa_meta\":\"Experience\",\"mo_ta_meta\":\"Experience\"}', 'en', '', ''),
(5, 3, 'Kinh nghiệm', 'Ciel là một phần của phong cảnh cô dâu Úc từ năm 2009 và mang đến cho ngành công nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa hàng trên toàn quốc và 3 ở Mỹ Luv hiểu những gì nó cần để làm cho ngày của những giấc mơ của bạn trở thành sự thật.', '<p>Ciel l&agrave; một phần của phong cảnh c&ocirc; d&acirc;u &Uacute;c từ năm 2009 v&agrave; mang đến cho ng&agrave;nh c&ocirc;ng nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa h&agrave;ng tr&ecirc;n to&agrave;n quốc v&agrave; 3 cửa h&agrave;ng ở Mỹ Luv hiểu những g&igrave; n&oacute; cần để biến giấc mơ của bạn th&agrave;nh hiện thực.Ciel đ&atilde; trở th&agrave;nh một phần của phong cảnh c&ocirc; d&acirc;u &Uacute;c từ năm 2009 v&agrave; mang đến cho ng&agrave;nh c&ocirc;ng nghiệp hơn 40 năm kinh nghiệm. Với 9 cửa h&agrave;ng tr&ecirc;n to&agrave;n quốc v&agrave; 3 ở Mỹ Luv hiểu những g&igrave; n&oacute; cần để l&agrave;m cho ng&agrave;y của những giấc mơ của bạn trở th&agrave;nh sự thật.</p>', '{\"tu_khoa_meta\":\"Kinh nghi\\u1ec7m\",\"mo_ta_meta\":\"Kinh nghi\\u1ec7m\"}', 'vi', '', ''),
(6, 3, 'Experience', 'Ciel has been part of the Australian bridal landscape since 2009 and brings to the industry over 40 years of experience. With 9 stores nationwide and 3 in the USA Luv understands what it takes to make the day of your dreams come true.', '<p>Ciel has been part of the Australian bridal landscape since 2009 and brings to the industry over 40 years of experience. With 9 stores nationwide and 3 in the USA Luv understands what it takes to make the day of your dreams come true.Ciel has been part of the Australian bridal landscape since 2009 and brings to the industry over 40 years of experience. With 9 stores nationwide and 3 in the USA Luv understands what it takes to make the day of your dreams come true.</p>', '{\"tu_khoa_meta\":\"Experience\",\"mo_ta_meta\":\"Experience\"}', 'en', '', ''),
(7, 4, 'Tin Khuyến mãi', 'Planning a wedding can be overwhelming and sometimes a little stressful – so many choices… so many decisions. Amongst the chaos, you should expect your bridal gown shopping experience to be a treasured highlight.', '<p>Planning a wedding can be overwhelming and sometimes a little stressful &ndash; so many choices&hellip; so many decisions. Amongst the chaos, you should expect your bridal gown shopping experience to be a treasured highlight. Seeing yourself in that gown that perfectly fits your wedding vision, should be an unforgettable once-in- a-lifetime moment. It should be exciting, special, fun, full of emotion and experienced with those you love most. Most of all&hellip;it should be all about you.You are a bride. You are beautiful, determined and deserving of a perfect beginning to your happily after. Most of all, you are unique. Your perfect bridal gown will reflect your inner individuality and exclusively designed fairytale.</p>', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\"}', 'vi', '', ''),
(8, 4, 'New sale', 'Planning a wedding can be overwhelming and sometimes a little stressful – so many choices… so many decisions. Amongst the chaos, you should expect your bridal gown shopping experience to be a treasured highlight.', '<p>Planning a wedding can be overwhelming and sometimes a little stressful &ndash; so many choices&hellip; so many decisions. Amongst the chaos, you should expect your bridal gown shopping experience to be a treasured highlight. Seeing yourself in that gown that perfectly fits your wedding vision, should be an unforgettable once-in- a-lifetime moment. It should be exciting, special, fun, full of emotion and experienced with those you love most. Most of all&hellip;it should be all about you.You are a bride. You are beautiful, determined and deserving of a perfect beginning to your happily after. Most of all, you are unique. Your perfect bridal gown will reflect your inner individuality and exclusively designed fairytale.</p>', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\"}', 'en', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `templates_id` int(11) NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection_id` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pricepromotion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_rent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pricepromotion_rent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `common` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_activated` tinyint(4) DEFAULT '0' COMMENT '0: active; 1:deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_category_id`, `templates_id`, `data`, `slug`, `avatar`, `image`, `collection`, `collection_id`, `price`, `pricepromotion`, `price_rent`, `pricepromotion_rent`, `date`, `type`, `common`, `hot`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `is_activated`) VALUES
(6, 22, 23, '{\"ma_san_pham\":\"1\",\"kich_thuoc_cho_san_pham\":\"X, M, L\"}', 'vay-cuoi-40', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\",\"2222.jpg\"]', 27, '7000000', '6700000', '1000000', '700000', '16/10/2018,18/10/2018,20/10/2018', 0, '{\"sale\":\"true\",\"rent\":\"true\",\"rent_sale\":\"true\",\"showpromotion\":\"true\",\"showpromotion_rent\":\"false\"}', 0, '2018-11-26 19:15:17', 'administrator', '2018-11-26 19:15:17', 'administrator', 0, 0),
(7, 22, 23, '{\"ma_san_pham\":\"\",\"kich_thuoc_cho_san_pham\":\"\"}', 'que', '', '', '[]', 27, '', '', '', '', '', 0, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 0, '2018-10-17 17:12:47', 'administrator', '2018-10-17 17:12:47', 'administrator', 1, 1),
(8, 22, 23, '{\"ma_san_pham\":\"CD1000\",\"kich_thuoc_cho_san_pham\":\"X, M, L\"}', 'vay-cuoi-52', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 0, '999999999', '', '', '', '', 0, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 1, '2018-11-29 11:04:33', 'administrator', '2018-11-29 11:04:33', 'administrator', 0, 0),
(9, 22, 23, '{\"ma_san_pham\":\"CD10054\",\"kich_thuoc_cho_san_pham\":\"X\"}', 'vay-cuoi-55', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 27, '999999999', '', '', '', '', 0, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 1, '2018-11-26 21:55:57', 'administrator', '2018-11-26 21:55:57', 'administrator', 0, 0),
(10, 22, 23, '{\"ma_san_pham\":\"CD10054\",\"kich_thuoc_cho_san_pham\":\"X, M\"}', 'vay-cuoi-57', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 27, '999999999', '', '', '', '', 0, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 1, '2018-11-26 21:56:28', 'administrator', '2018-11-26 21:56:28', 'administrator', 0, 0),
(11, 22, 23, '{\"ma_san_pham\":\"CD10054\",\"kich_thuoc_cho_san_pham\":\"X, M\"}', 'vay-cuoi-7', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 27, '999999999', '', '', '', '', 0, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 1, '2018-11-26 21:56:51', 'administrator', '2018-11-26 21:56:51', 'administrator', 0, 0),
(12, 23, 23, '{\"ma_san_pham\":\"CD10052\",\"kich_thuoc_cho_san_pham\":\"\"}', 'phu-kien-1', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 0, '999999999', '', '', '', '', 1, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 0, '2018-11-26 23:08:49', 'administrator', '2018-11-26 23:08:49', 'administrator', 0, 0),
(13, 23, 23, '{\"ma_san_pham\":\"CD10052\",\"kich_thuoc_cho_san_pham\":\"\"}', 'phu-kien-2', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 0, '999999999', '', '', '', '', 1, '{\"sale\":\"false\",\"rent\":\"false\",\"rent_sale\":\"false\",\"showpromotion\":\"false\",\"showpromotion_rent\":\"false\"}', 0, '2018-11-26 23:09:06', 'administrator', '2018-11-26 23:09:06', 'administrator', 0, 0),
(14, 23, 23, '{\"ma_san_pham\":\"CD10052\",\"kich_thuoc_cho_san_pham\":\"\"}', 'phu-kien-3', '', 'photo-1519741497674-611481863552.jpg', '[\"photo-1519741497674-6114818635521.jpg\"]', 0, '12333333', '12333330', '222222', '222211', '', 1, '{\"sale\":\"true\",\"rent\":\"true\",\"rent_sale\":\"true\",\"showpromotion\":\"true\",\"showpromotion_rent\":\"true\"}', 0, '2018-11-28 15:30:44', 'administrator', '2018-11-28 15:30:44', 'administrator', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `sort` tinyint(4) DEFAULT NULL,
  `is_activated` tinyint(4) DEFAULT '0' COMMENT '0: active; 1: deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_category`
--

INSERT INTO `product_category` (`id`, `slug`, `parent_id`, `type`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `project`, `image`, `sort`, `is_activated`) VALUES
(22, 'vay-cuoi', 0, 0, 0, '2018-12-01 23:56:33', 'administrator', '2018-12-01 23:56:33', 'administrator', '', '2222.jpg', NULL, 0),
(23, 'phu-kien', 0, 1, 0, '2018-11-27 14:50:33', 'administrator', '2018-11-27 14:50:33', 'administrator', '', 'photo-1519741497674-611481863552.jpg', NULL, 0),
(24, 'phu-dau-dip-le-hoi', 0, 0, 0, '2018-11-29 14:26:02', 'administrator', '2018-11-29 14:26:02', 'administrator', '', 'photo-1519741497674-611481863552.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category_lang`
--

CREATE TABLE `product_category_lang` (
  `id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metakeywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_category_lang`
--

INSERT INTO `product_category_lang` (`id`, `product_category_id`, `title`, `description`, `content`, `metadescription`, `metakeywords`, `language`) VALUES
(87, 22, '   Váy Cưới', '  Beautifully Crafted, Amazingly Priced', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam finibus sem ut vestibulum dapibus. Nunc euismod tincidunt magna ac dapibus. Pellentesque eget interdum ipsum. Nam ultricies nec nibh ut imperdiet.</p>', '   Váy Cưới', '   Váy Cưới', 'vi'),
(88, 22, ' Wedding dress         ', 'Beautifully Crafted, Amazingly Priced1  ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam finibus sem ut vestibulum dapibus. Nunc euismod tincidunt magna ac dapibus. Pellentesque eget interdum ipsum. Nam ultricies nec nibh ut imperdiet.1</p>', '  Wedding dress         ', ' Wedding dress          ', 'en'),
(89, 23, ' Phụ kiện', 'Beautifully Crafted, Amazingly Priced', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam finibus sem ut vestibulum dapibus. Nunc euismod tincidunt magna ac dapibus. Pellentesque eget interdum ipsum. Nam ultricies nec nibh ut imperdiet.</p>', '   ', '   ', 'vi'),
(90, 23, 'Phụ kiện   ', 'Beautifully Crafted, Amazingly Priced1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam finibus sem ut vestibulum dapibus. Nunc euismod tincidunt magna ac dapibus. Pellentesque eget interdum ipsum. Nam ultricies nec nibh ut imperdiet.1</p>', '   ', '   ', 'en'),
(91, 24, ' Phù Dâu & Dịp Lễ Hội', ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', ' ', ' ', 'vi'),
(92, 24, 'Strawberry & Festival ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', ' ', ' ', 'en');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_lang`
--

CREATE TABLE `product_lang` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_lang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_lang`
--

INSERT INTO `product_lang` (`id`, `product_id`, `title`, `description`, `content`, `data_lang`, `language`) VALUES
(11, 6, 'Váy cưới 4.0', 'Người ta thường nói rằng phụ nữ trông đẹp nhất khi họ khoác lên mình chiếc váy cưới cô dâu? Ngày các nàng bước lên xe hoa như một kỷ niệm mà bất cứ ai cũng sẽ không bao giờ quên được. Và kể từ đây, cuộc đời mỗi người - Tất cả sẽ được định đoạt từ cột mốc các nàng \"đắm mình\" trong chiếc váy cưới đẹp - \"chiếc váy\" cuộc đời.', '<p>Nổi tiếng với những đường cắt may tinh tế tr&ecirc;n nền chất liệu cao cấp, những mẫu v&aacute;y cưới hiện đại kh&ocirc;ng chỉ t&ocirc;n l&ecirc;n n&eacute;t đẹp nữ t&iacute;nh m&agrave; c&ograve;n mang đến sự thoải m&aacute;i m&agrave; kh&ocirc;ng k&eacute;m phần lộng lẫy, sang trọng cho t&acirc;n nương. Sở hữu nhiều tầng v&aacute;y bay bổng mang lại vẻ sang trọng nhưng vẫn kh&ocirc;ng k&eacute;m phần mỏng nhẹ, những chất liệu như voan, satin thường được sử dụng khi may v&aacute;y cưới, được điểm xuyết bằng phần lưng v&aacute;y lạ mắt &ocirc;m d&aacute;ng gi&uacute;p chiếc v&aacute;y trở n&ecirc;n v&ocirc; c&ugrave;ng ấn tượng. Phần h&ocirc;ng v&aacute;y cũng được chăm ch&uacute;t từng chi tiết, thắt eo nhiều hơn&nbsp;tạo điểm nhấn&nbsp;khiến chiếc v&aacute;y cưới&nbsp;th&ecirc;m phần quyến rũ kh&oacute; cưỡng.</p>', '{\"tu_khoa_meta\":\"V\\u00e1y c\\u01b0\\u1edbi 4.0\",\"mo_ta_meta\":\"V\\u00e1y c\\u01b0\\u1edbi 4.0\",\"mau_san_pham\":\"\"}', 'vi'),
(12, 6, 'Wedding dresses 4.0', 'It is often said that women look the best when they wear a bridal gown. On the ladies step on the flower car as a memory that anyone will never forget. And from here on, the life of each person - All will be determined from the milestone of her \"immersed\" in the beautiful wedding dress - \"dress\" life.', '<p>Famous for its fine cut lines on high quality materials, modern wedding dresses not only show off the feminine beauty, but also bring the comfort that is no less glamorous and luxurious for the bride. Owning a lot of layers of flying skirts brings elegance but still no less thin, materials such as chiffon, satin are often used in wedding dresses, are highlighted by the back of fancy skirts to help shape the skirt. became very impressed. The hips are also carefully dressed in detail, tightening waist more emphasis to make the wedding dress more attractive charm.</p>', '{\"tu_khoa_meta\":\"Wedding dresses 4.0\",\"mo_ta_meta\":\"Wedding dresses 4.0\",\"mau_san_pham\":\"\"}', 'en'),
(13, 7, 'qưe', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"\"}', 'vi'),
(14, 7, 'qew', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"\"}', 'en'),
(15, 8, 'Váy Cưới 5.2', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"\\u0110o\\u0309\"}', 'vi'),
(16, 8, 'Váy Cưới 5.2', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Red\"}', 'en'),
(17, 9, 'Váy cưới 5.5', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Xanh\"}', 'vi'),
(18, 9, 'Váy cưới 5.5', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Green\"}', 'en'),
(19, 10, 'Váy cưới 5.7', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Xanh\"}', 'vi'),
(20, 10, 'Váy cưới 5.7', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Green\"}', 'en'),
(21, 11, 'Váy cưới 7', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Xanh\"}', 'vi'),
(22, 11, 'Váy cưới 7', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Green\"}', 'en'),
(23, 12, 'Phụ kiện 1', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Xanh\"}', 'vi'),
(24, 12, 'Phụ kiện 1', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Green\"}', 'en'),
(25, 13, 'Phụ kiện 2', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Xanh\"}', 'vi'),
(26, 13, 'Phụ kiện 2', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Green\"}', 'en'),
(27, 14, 'Phụ kiện 3', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Xanh\"}', 'vi'),
(28, 14, 'Phụ kiện 3', '', '', '{\"tu_khoa_meta\":\"\",\"mo_ta_meta\":\"\",\"mau_san_pham\":\"Green\"}', 'en');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `site_sessions`
--

CREATE TABLE `site_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `site_sessions`
--

INSERT INTO `site_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('01lu68au2quk6nl435967v7sadoc0ibg', '::1', 1543671293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637313239333b6c616e67416262726576696174696f6e7c733a323a227669223b),
('0hss2k02v1h43mpu1l6f0vv6vhjnerut', '::1', 1543685038, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638353033383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b),
('0ivradbs078kvkjj176jip3g86gooht1', '::1', 1543673579, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637333537393b6c616e67416262726576696174696f6e7c733a323a227669223b),
('0rchg7mod8turvg2jj73rdad4245ojkc', '::1', 1543686911, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638363931313b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('16ahnn3puuan2b099ggp6ddd94rkvagn', '::1', 1543670518, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637303531383b6c616e67416262726576696174696f6e7c733a323a227669223b),
('285chg18d84aguqcdpdfjk9gceoutiv4', '::1', 1543687560, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638373536303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b6d6573736167655f737563636573737c733a32353a225468c3aa6d206de1bb9b69207468c3a06e682063c3b46e6721223b5f5f63695f766172737c613a313a7b733a31353a226d6573736167655f73756363657373223b733a333a226f6c64223b7d),
('2i7pk2jkq9lpanphhh015tbsr4m7klo6', '::1', 1543689230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638393136303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('2kvtq6ca10k0ec8737s3ev87khp265lt', '::1', 1543666497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333636363439373b6c616e67416262726576696174696f6e7c733a323a227669223b),
('2tl719t4bbvs8kd79ub9t0s933766rld', '::1', 1543683905, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638333930353b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('39bus5tc6q087tmi3oq6jb09hqf190kr', '::1', 1543670161, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637303136313b6c616e67416262726576696174696f6e7c733a323a227669223b),
('3lbmhuo3rguqpm8qk2ejvo80qbhlq2cq', '::1', 1543687256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638373235363b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('4uaq6tpmdqhq5ke3e0560e1u14aaeca4', '::1', 1543667319, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333636373331393b6c616e67416262726576696174696f6e7c733a323a22656e223b),
('59k9bevht9o4sternpjfk3pg9g2mbtfd', '::1', 1543684226, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638343232363b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('5lc81q38psrslqisht7ahghobqh9lfg7', '::1', 1543685571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638353537313b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('682i6evc7j1ru54h3q01d34hcbudapsg', '::1', 1543688526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638383532363b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('7uj3o7ccvimteeuiv7v9v12htm7kcdmg', '::1', 1543684543, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638343534333b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('8iguauq0hfi8mmao3qmiigljd0hl6n4j', '::1', 1543688170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638383137303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('aa1tt5r9h5qh8bu8cjqnjsostjj934ge', '::1', 1543672640, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637323634303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('buojh3loeqn8hgssqmtnq7p7ceu9n7k5', '::1', 1543679237, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637393233373b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('ci8abie5au6jccp6jsm8bkv6md11rv61', '::1', 1543685990, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638353939303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('d1qpeubke13l104k7sqf6muuadjbqvqj', '::1', 1543673230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637333233303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('dh5ao283sviv648ahpfkkcoklh50pb4a', '::1', 1543669688, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333636393638383b6c616e67416262726576696174696f6e7c733a323a22656e223b),
('gh15rolf331k5bhqb77q24qkov7q0l4d', '::1', 1543672310, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637323331303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('gjj13heudtefo4pciqkla78kvqeoh49s', '::1', 1543678612, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637383631323b6c616e67416262726576696174696f6e7c733a323a227669223b),
('h24snspcnmcdpaj9p6mtoo7b3m5nvlom', '::1', 1543670955, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637303935353b6c616e67416262726576696174696f6e7c733a323a227669223b),
('hndo2s47grhp63omvk5pmgodqggds7e7', '::1', 1543683601, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638333630313b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('imo7m5rosuvl8go2sam9sc9506v3jsm7', '::1', 1543678913, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637383931333b6c616e67416262726576696174696f6e7c733a323a227669223b),
('js2v4og62hu6mj896bal6c0018v67q65', '::1', 1543669367, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333636393336373b6c616e67416262726576696174696f6e7c733a323a227669223b),
('jt54442vloqkn370nkmbhlb01a13lu32', '::1', 1543688848, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638383834383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('kashni7mv0ubie7uc1ghi8outldr70lu', '::1', 1543666829, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333636363832393b6c616e67416262726576696174696f6e7c733a323a22656e223b),
('kkrhj6gc9di5d6kot37fg2eq4smr1iho', '::1', 1543679548, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637393534383b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('oo59hbklip779bi3fonfcbv204gs1ggi', '::1', 1543687869, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638373836393b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('ooe2chp3o304pcbvti9b2h55ot4s48tf', '::1', 1543671972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637313937323b6c616e67416262726576696174696f6e7c733a323a227669223b),
('pr0rttv0mrhjh4u1mg2rme9ro36o9als', '::1', 1543686292, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638363239323b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('ql56cua9qss9l2db0j7ls6cfo7br1e9p', '::1', 1543683284, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638333238343b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433353534363137223b6c6173745f636865636b7c693a313534333637383931393b),
('rrv6l8in31p87imr14ocesg9ieqr0slp', '::1', 1543673920, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637333932303b6c616e67416262726576696174696f6e7c733a323a227669223b),
('s5809tvjv1riqdlcl6q8c4c79ub8i8d4', '::1', 1543669013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333636393031333b6c616e67416262726576696174696f6e7c733a323a227669223b),
('vpu0sm7l2tg4mlomq4b2c6sn03lq4l6d', '::1', 1543671665, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333637313636353b6c616e67416262726576696174696f6e7c733a323a227669223b),
('vsq68tn13t8epfqkrc3qtjd50cureprd', '::1', 1543689160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534333638393136303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353433363738393139223b6c6173745f636865636b7c693a313534333638343732303b6c616e67416262726576696174696f6e7c733a323a227669223b);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `templates`
--

INSERT INTO `templates` (`id`, `type`, `title`, `data`, `is_activated`, `is_deleted`) VALUES
(23, 2, 'Cấu hình sản phẩm', '{\"image_shared\":{\"description\":\"\",\"type\":\"file\",\"check_language\":\"true\",\"title\":{\"vi\":\"H\\u00ecnh \\u1ea3nh\",\"en\":\"Image\"}},\"slug_shared\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"true\",\"title\":{\"vi\":\"Slug\",\"en\":\"Slug\"},\"required\":\"Vui l\\u00f2ng nh\\u1eadp ti\\u00eau \\u0111\\u1ec1 cho s\\u1ea3n ph\\u1ea9m \\u0111\\u1ec3 c\\u00f3 Slug\"},\"parent_id_shared\":{\"description\":\"\",\"type\":\"select\",\"check_language\":\"true\",\"title\":{\"vi\":\"Danh m\\u1ee5c\",\"en\":\"Category\"},\"choice\":{\"vi\":[\"\"],\"en\":[\"\"]},\"required\":\"Vui l\\u00f2ng ch\\u1ecdn danh m\\u1ee5c\"},\"title\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"Ti\\u00eau \\u0111\\u1ec1\",\"en\":\"Title\"},\"required\":\"Vui l\\u00f2ng nh\\u1eadp ti\\u00eau \\u0111\\u1ec1 cho s\\u1ea3n ph\\u1ea9m\"},\"description\":{\"description\":\"\",\"type\":\"textarea\",\"check_language\":\"false\",\"title\":{\"vi\":\"M\\u00f4 t\\u1ea3\",\"en\":\"Description\"}},\"content\":{\"description\":\"\",\"type\":\"textarea\",\"check_language\":\"false\",\"title\":{\"vi\":\"N\\u1ed9i dung\",\"en\":\"Content\"},\"check_multiple\":\"true\"},\"tu_khoa_meta\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"T\\u1eeb kh\\u00f3a meta\",\"en\":\"Metakeywords\"}},\"mo_ta_meta\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"M\\u00f4 t\\u1ea3 meta\",\"en\":\"Metadescription\"}},\"ma_san_pham\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"true\",\"title\":{\"vi\":\"Ma\\u0303 sa\\u0309n ph\\u00e2\\u0309m\",\"en\":\"Code product\"}},\"kich_thuoc_cho_san_pham\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"true\",\"title\":{\"vi\":\"Ki\\u0301ch Th\\u01b0\\u01a1\\u0301c cho sa\\u0309n ph\\u00e2\\u0309m\",\"en\":\"Size product\"}},\"mau_san_pham\":{\"description\":\"Nh\\u00e2\\u0323p ma\\u0300u cho sa\\u0309n ph\\u00e2\\u0309m\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"Ma\\u0300u sa\\u0309n ph\\u00e2\\u0309m\",\"en\":\"Color product\"}}}', 0, 0),
(24, 1, 'Cấu hình bài viết', '{\"image_shared\":{\"description\":\"\",\"type\":\"file\",\"check_language\":\"true\",\"title\":{\"vi\":\"H\\u00ecnh \\u1ea3nh\",\"en\":\"Image\"}},\"slug_shared\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"true\",\"title\":{\"vi\":\"Slug\",\"en\":\"Slug\"},\"required\":\"Vui l\\u00f2ng nh\\u1eadp ti\\u00eau \\u0111\\u1ec1 b\\u00e0i vi\\u1ebft \\u0111\\u1ec3 c\\u00f3 Slug\"},\"parent_id_shared\":{\"description\":\"\",\"type\":\"select\",\"check_language\":\"true\",\"title\":{\"vi\":\"Danh m\\u1ee5c\",\"en\":\"Category\"},\"choice\":{\"vi\":[\"\"],\"en\":[\"\"]},\"required\":\"Vui l\\u00f2ng ch\\u1ecdn danh m\\u1ee5c cho b\\u00e0i vi\\u1ebft\"},\"title\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"Ti\\u00eau \\u0111\\u1ec1\",\"en\":\"Title\"},\"required\":\"Vui l\\u00f2ng nh\\u1eadp ti\\u00eau \\u0111\\u1ec1 cho b\\u00e0i vi\\u1ebft\"},\"description\":{\"description\":\"\",\"type\":\"textarea\",\"check_language\":\"false\",\"title\":{\"vi\":\"M\\u00f4 t\\u1ea3\",\"en\":\"Description\"}},\"content\":{\"description\":\"\",\"type\":\"textarea\",\"check_language\":\"false\",\"title\":{\"vi\":\"N\\u1ed9i dung\",\"en\":\"Content\"},\"check_multiple\":\"true\"},\"tu_khoa_meta\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"T\\u1eeb kh\\u00f3a meta\",\"en\":\"Metakeywords\"}},\"mo_ta_meta\":{\"description\":\"\",\"type\":\"text\",\"check_language\":\"false\",\"title\":{\"vi\":\"M\\u00f4 t\\u1ea3 meta\",\"en\":\"Metadescription\"}}}', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1543684720, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'Nguyễn', '$2y$08$8zsmQuzmUTBopCDSkcpq5u8zHNASZaQStA9bCXvnPCA/NHZzwMtSy', NULL, '12quyen12@gmail.com', NULL, NULL, 1538390589, NULL, 1538361383, 1538982951, 1, 'Nguyễn', 'Quyền', NULL, NULL),
(3, '::1', 'Trần', '$2y$08$GrUvnK18yHj7FAt8Xn59EugD9FvW6uAKEhCAsm5DrgdP9niSQ5xJ6', NULL, '12hung12@gmail.com', NULL, NULL, NULL, NULL, 1538362269, 1538367158, 1, 'Trần22', 'Hùng22', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 3),
(5, 3, 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `about_lang`
--
ALTER TABLE `about_lang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `banner_lang`
--
ALTER TABLE `banner_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Chỉ mục cho bảng `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `collection_lang`
--
ALTER TABLE `collection_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `config_contact`
--
ALTER TABLE `config_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu_lang`
--
ALTER TABLE `menu_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_id` (`post_category_id`);

--
-- Chỉ mục cho bảng `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_category_lang`
--
ALTER TABLE `post_category_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_id` (`post_category_id`);

--
-- Chỉ mục cho bảng `post_lang`
--
ALTER TABLE `post_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_id` (`product_category_id`);

--
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_category_lang`
--
ALTER TABLE `product_category_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_id` (`product_category_id`);

--
-- Chỉ mục cho bảng `product_lang`
--
ALTER TABLE `product_lang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`product_id`);

--
-- Chỉ mục cho bảng `site_sessions`
--
ALTER TABLE `site_sessions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Chỉ mục cho bảng `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`) USING BTREE,
  ADD KEY `fk_users_groups_users1_idx` (`user_id`) USING BTREE,
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT cho bảng `about_lang`
--
ALTER TABLE `about_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT cho bảng `banner_lang`
--
ALTER TABLE `banner_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT cho bảng `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT cho bảng `collection_lang`
--
ALTER TABLE `collection_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT cho bảng `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `config_contact`
--
ALTER TABLE `config_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `menu_lang`
--
ALTER TABLE `menu_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `post_category_lang`
--
ALTER TABLE `post_category_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `post_lang`
--
ALTER TABLE `post_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT cho bảng `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `product_category_lang`
--
ALTER TABLE `product_category_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT cho bảng `product_lang`
--
ALTER TABLE `product_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT cho bảng `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `menu_lang`
--
ALTER TABLE `menu_lang`
  ADD CONSTRAINT `menu_lang_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`post_category_id`) REFERENCES `post_category` (`id`);

--
-- Các ràng buộc cho bảng `post_category_lang`
--
ALTER TABLE `post_category_lang`
  ADD CONSTRAINT `post_category_lang_ibfk_1` FOREIGN KEY (`post_category_id`) REFERENCES `post_category` (`id`);

--
-- Các ràng buộc cho bảng `post_lang`
--
ALTER TABLE `post_lang`
  ADD CONSTRAINT `post_lang_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`);

--
-- Các ràng buộc cho bảng `product_category_lang`
--
ALTER TABLE `product_category_lang`
  ADD CONSTRAINT `product_category_lang_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`);

--
-- Các ràng buộc cho bảng `product_lang`
--
ALTER TABLE `product_lang`
  ADD CONSTRAINT `product_lang_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
