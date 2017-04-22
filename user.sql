-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 22, 2017 lúc 12:00 CH
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `user`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pm25`
--

CREATE TABLE `pm25` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8_vietnamese_ci NOT NULL,
  `bottom` int(11) NOT NULL,
  `top` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `pm25`
--

INSERT INTO `pm25` (`id`, `comment`, `bottom`, `top`) VALUES
(1, 'Chất lượng không khí trong lành, tốt cho sức khỏe', 0, 35),
(2, 'Chất lượng không khí bình thường, không xấu', 36, 75),
(3, 'Chất lượng không khí chưa sạch, ở mức độ cảnh báo', 76, 115),
(4, 'Chất lượng không khí ô nhiễm vừa phải, lời khuyên nên lọc không khí', 116, 150),
(5, 'Chất lượng không khí ô nhiễm nhiều, cần thiết phải lọc không khí', 151, 250),
(6, 'Chất lượng không khí ô nhiễm nghiêm trọng, nên có biện pháp bảo vệ đường hô hấp', 251, 350),
(7, 'Chất lượng không khí ô nhiễm vô cùng nghiêm trọng, không thích hợp cho hít thở và sự sống', 351, 10000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` text NOT NULL,
  `id_station` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `mail`, `id_station`, `level`, `duration`) VALUES
(3, 'chinhpv95@gmail.com', 35, 4, 334);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pm25`
--
ALTER TABLE `pm25`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
