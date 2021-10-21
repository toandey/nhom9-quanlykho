-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2021 lúc 08:30 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlykho`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(5) NOT NULL,
  `masanpham` varchar(30) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `gianhap` int(10) NOT NULL,
  `giaban` int(10) NOT NULL,
  `tonkho` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `masanpham`, `tensanpham`, `gianhap`, `giaban`, `tonkho`) VALUES
(1, 'DT-OPPO-RN5', 'Điện thoại OPPO Reno5 Marvel 1', 8590000, 9190000, 2),
(2, 'DT-SAMSUNG-ZF3256', 'Điện thoại Samsung Galaxy Z Fold3 5G 256GB', 37990000, 41990000, 2),
(3, 'DT-SAMSUNG-ZF3512', 'Điện thoại Samsung Galaxy Z Fold3 5G 512GB ', 38990000, 43990000, 10),
(4, 'DT-XIAOMI-11LNE', 'Điện thoại Xiaomi 11 Lite 5G NE', 9000000, 9490000, 5),
(7, 'TN-AIRPODKD', 'Tai nghe Bluetooth AirPods Pro Wireless Charge Apple MWP22', 4590000, 6870000, 20),
(8, 'TN-BEATSST3KD', 'Tai nghe chụp tai Beats Studio3 Wireless MX422/ MX432', 5900000, 7100000, 5),
(9, 'TNH-SANDISK200', 'Thẻ nhớ MicroSD 200 GB SanDisk Class 10 ', 889000, 1110000, 100),
(10, 'DT-SAMSUNGZF3256', 'Điện thoại Samsung Galaxy Z Flip3 5G 256GB', 19800000, 22000000, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(0, 'admin', '$2y$10$LNt2sgi6YDEu3oSszSwYwewZtDsZt.U5HvdUDOkCoXPK5r1XhVmp2', '2021-10-21 11:26:54');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
