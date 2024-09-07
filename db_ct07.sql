-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th3 23, 2024 lúc 08:30 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ct07`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cagetory`
--

CREATE TABLE `cagetory` (
  `id` int NOT NULL,
  `name` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flowers`
--

CREATE TABLE `flowers` (
  `id` int NOT NULL,
  `name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagefile` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bought` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `flowers`
--

INSERT INTO `flowers` (`id`, `name`, `description`, `price`, `imagefile`, `bought`) VALUES
(46, 'Lan hồ điệp - Hồ điệp tím', 'Sản phẩm bao gồm: Hồ điệp tím: 5', '500000', 'chau-lan-ho-diep-10-canh-trang-1.jpg', 0),
(55, 'Sắc hương', 'Tình trạng: Đặt trước', '400000 ', 'Untitled-design-2022-07-21T002445_626-1.png', 0),
(57, 'Lan hồ điệp - Lan Hồ Điệp xuân', 'Sản phẩm bao gồm: Hồ điệp tím: 2 Hồ điệp vàng: 3', '1575000', '12707_lan-ho-diep-xuan-mau.jpg', 0),
(58, 'Lan hồ điệp - Hồ điệp vàng', 'Sản phẩm bao gồm: Hồ điệp vàng: 2', '550000', '14065_ho-diep-vang-chau-su.jpg', 0),
(59, 'Hoa sen đá 25', 'Sản phẩm bao gồm: Cây lan hạt dưa thường: 2 Sen đá chuỗi ngọc bi : 1 Sen đá lớn ngẫu nhiên: 1', '550000 ', '15151_hoa-sen-da.jpg', 0),
(60, 'Chậu lan trắng 1 cành', 'Sản phẩm bao gồm: Chậu sứ tròn trơn: 1 Hồ điệp trắng: 1', '350000', '11124_chau-lan-trang--canh.png', 0),
(61, 'Kệ hoa chia buồn 47', 'Tình trạng: Đặt trước', '1250000', 'z3158225210941_3bacc5ae6e2783280f01bd476cd9a97c-scaled.jpg', 0),
(63, 'Bó hoa 211', 'Tình trạng: Đặt trước', '250000', 'aa1daff04cb290ecc9a3.jpg', 4),
(64, ' Hoa Khai Trương - Phồn Vinh', 'Kệ Hoa Khai Trương Phồn Vinh được thiết kế từ  Hoa hồng kem: 50-60 cành Hoa đồng tiền hồng: 30 cành  Hoa đồng tiền đỏ: 30 cành  Hoa lan hồ điệp trắng: 2 cành (6-8 bông/cành) Hoa baby trắng: 100 gram Các loại hoa lá phụ: Lá mật cật', '2050000', '2508z2505567663345687dfd6b73a1415edc0d6f7c01d79ae9.jpg', 3),
(71, 'Bó Cẩm Chướng', 'Sản phẩm bao gồm: Cẩm chướng đơn hồng dâu : 30', '400000', 'bo-hoa-cam-chuong-dep-e1598947985341-12.jpg', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_create` date DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  `isPayed` tinyint(1) NOT NULL DEFAULT '0',
  `total` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='quantity';

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `date_create`, `Status`, `isPayed`, `total`) VALUES
(17, 3, '2024-03-22', 1, 1, 2450000.00),
(18, 1, '2024-03-22', 0, 0, 400000.00),
(20, 1, '2024-03-22', 0, 0, 0.00),
(21, 1, '2024-03-22', 0, 0, 4100000.00),
(22, 1, '2024-03-22', 0, 0, 400000.00),
(23, 1, '2024-03-22', 0, 0, 2800000.00),
(26, 1, '2024-03-22', 0, 0, 2050000.00),
(27, 1, '2024-03-22', 0, 0, 3000000.00),
(28, 3, '2024-03-22', 0, 0, 400000.00),
(29, 3, '2024-03-22', 0, 0, 0.00),
(30, 3, '2024-03-22', 0, 0, 250000.00),
(31, 3, '2024-03-22', 0, 0, 2050000.00),
(32, 3, '2024-03-22', 0, 0, 0.00),
(33, 3, '2024-03-22', 0, 0, 2050000.00),
(34, 3, '2024-03-22', 0, 0, 2050000.00),
(35, 3, '2024-03-22', 0, 0, 650000.00),
(36, 23, '2024-03-22', 0, 0, 250000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `recipient` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `total_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `user_id`, `order_id`, `product_id`, `product_name`, `quantity`, `recipient`, `phone_number`, `address`, `note`, `total_amount`) VALUES
(15, 3, 17, 71, 'Bó Cẩm Chướng', 0, 's', 's', 's', 's', 400000),
(16, 3, 17, 64, ' Hoa Khai Trương - Phồn Vinh', 0, 's', 's', 's', 's', 2050000),
(17, 1, 18, 71, 'Bó Cẩm Chướng', 0, 's', 's', 's', 's', 400000),
(18, 1, 21, 64, ' Hoa Khai Trương - Phồn Vinh', 0, 's', 's', 's', 's', 4100000),
(19, 1, 22, 71, 'Bó Cẩm Chướng', 0, 's', 's', 's', 's', 400000),
(20, 1, 23, 63, 'Bó hoa 211', 0, 'a', 'a', 'a', 'a', 250000),
(21, 1, 23, 64, ' Hoa Khai Trương - Phồn Vinh', 0, 'a', 'a', 'a', 'a', 2050000),
(22, 1, 23, 46, 'Lan hồ điệp - Hồ điệp tím', 0, 'a', 'a', 'a', 'a', 500000),
(23, 1, 26, 64, ' Hoa Khai Trương - Phồn Vinh', 1, 's', 's', 's', 's', 2050000),
(24, 1, 27, 63, 'Bó hoa 211', 12, 's', 's', 's', 's', 3000000),
(25, 3, 28, 71, 'Bó Cẩm Chướng', 1, 's', 's', 's', 's', 400000),
(26, 3, 30, 63, 'Bó hoa 211', 1, '', '', '', '', 250000),
(27, 3, 31, 64, ' Hoa Khai Trương - Phồn Vinh', 1, '', '', '', '', 2050000),
(28, 3, 33, 64, ' Hoa Khai Trương - Phồn Vinh', 1, '', '', '', '', 2050000),
(29, 3, 34, 64, ' Hoa Khai Trương - Phồn Vinh', 1, '', '', '', '', 2050000),
(30, 3, 35, 71, 'Bó Cẩm Chướng', 1, '', '', '', '', 400000),
(31, 3, 35, 63, 'Bó hoa 211', 1, '', '', '', '', 250000),
(32, 23, 36, 63, 'Bó hoa 211', 1, '', '', '', '', 250000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usertype` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usertype`, `active`) VALUES
(1, 'abcdef', '123456def654321', 1, 0),
(3, 'root', 'mysql', 1, 0),
(19, 'test', 'test', 0, 1),
(20, 'testt', '$2y$10$JXlUB5eZcqs6g9yU/6TrKu//pMu19J/LZDGoOrb2QuLci6mzNrq7.', 0, 0),
(21, 'rootasd', '$2y$10$MESDKJNIypGEFWpSEbuHcOjEfm5PoJfh8n4GmE.wbrXKABb.AzKEW', 0, 0),
(22, 'C', '$2y$10$sn5njp4QIbQ52p6FZDFsxOd3q8PJZaa4XGvhmW.LXnaDsoVPvikKu', 0, 1),
(23, 'qwewqewe', '$2y$10$xfWYO5DrE2GWD3ClVj1aFeEbOdue0yshCuyKxPXhzrWaZxVvLnG6K', 0, 0),
(24, 'aaaaaa', '$2y$10$AfHMkdhh3XxlSPI8WiY6F.wyGBgak.014nIXX2hg2jGNFe9uhLOvK', 0, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cagetory`
--
ALTER TABLE `cagetory`
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order_id` (`order_id`),
  ADD KEY `user_id` (`product_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usersname` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cagetory`
--
ALTER TABLE `cagetory`
  ADD CONSTRAINT `cagetory_ibfk_1` FOREIGN KEY (`id`) REFERENCES `flowers` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `flowers` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
