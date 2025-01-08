-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 05:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(9) NOT NULL,
  `id_order` int(9) NOT NULL,
  `id_pro` int(9) NOT NULL,
  `quantity` int(9) NOT NULL DEFAULT 0,
  `prices` double(10,2) NOT NULL DEFAULT 0.00,
  `size` varchar(5) NOT NULL,
  `name_pro` varchar(50) DEFAULT NULL,
  `img_pro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `id_order`, `id_pro`, `quantity`, `prices`, `size`, `name_pro`, `img_pro`) VALUES
(201, 141, 90, 2, 27000000.00, 'L', 'Grey Vest', 'suit (6).png'),
(202, 142, 90, 1, 27000000.00, 'L', 'Grey Vest', 'suit (6).png'),
(203, 142, 91, 1, 27500000.00, 'XL', 'Black Vest', 'suit (2).png'),
(204, 143, 95, 1, 20000000.00, 'L', 'Ken Vest', 'product-39.png'),
(206, 145, 90, 1, 27000000.00, 'L', 'Grey Vest', 'suit (6).png'),
(207, 146, 91, 1, 7900000.00, 'XL', 'Veston - VES220958', 'ves220958._34_jpg.webp'),
(208, 147, 90, 1, 6990000.00, 'L', 'Bộ Veston - VES231682', 'owen_phpc1153_3.webp'),
(209, 148, 92, 1, 20000000.00, 'XXL', 'Bộ Vest Ghi Sáng Biluxury', '20240127_OHVZdEew7B.jpeg'),
(210, 148, 90, 1, 6990000.00, 'L', 'Bộ Veston - VES231682', 'owen_phpc1153_3.webp'),
(211, 149, 92, 1, 20000000.00, 'XXL', 'Bộ Vest Ghi Sáng Biluxury', '20240127_OHVZdEew7B.jpeg'),
(212, 149, 90, 1, 6990000.00, 'L', 'Bộ Veston - VES231682', 'owen_phpc1153_3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catalog`
--

CREATE TABLE `tbl_catalog` (
  `id_catalog_k` int(4) NOT NULL,
  `catalog_name` varchar(50) NOT NULL,
  `prioritize` int(4) NOT NULL DEFAULT 0,
  `display_ctl` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_catalog`
--

INSERT INTO `tbl_catalog` (`id_catalog_k`, `catalog_name`, `prioritize`, `display_ctl`) VALUES
(94, 'Notch lapel', 1, 1),
(95, 'Peak lapel', 1, 1),
(96, 'Shawl lapel', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ban` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`id`, `fname`, `lname`, `sex`, `address`, `email`, `phone`, `user`, `password`, `ban`) VALUES
(32, 'Hieu', 'Dang321312', 1, 'Ấp chợ, hiệp mỹ tây, cầu ngang', '110122075@St.tvu.edu.vn', '0342888525', 'dminhhieu2408', '123123', 0),
(39, 'Hieu', 'Dann2222', 1, '1', '321321asdzx@gmail.com', '0876985305', 'HieuDang', '123123', 1),
(40, 'Dang1323', 'Hieu', 2, '1', '321xzcc@gmail.com', '09769853312', 'adminthuong42342', '123123', 1),
(45, 'Dang13213', 'Hieu', 1, '162 ấp chợ', 'dminhhieu24208@gmail.com', '0976985305', 'Hieudang123', '123123', 0),
(46, 'Dao', 'Duyy', 2, '162 ấp chợ', 'dminhhieu2431208@gmail.com', '0976985305', 'Duy', '123123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(9) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `total_prices` double(10,0) NOT NULL DEFAULT 0,
  `payment` tinyint(1) NOT NULL DEFAULT 1,
  `id_user` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL DEFAULT 'Not note',
  `due_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `employee_pr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `invoice_id`, `total_prices`, `payment`, `id_user`, `fname`, `lname`, `phone`, `email`, `address`, `notes`, `due_date`, `status`, `employee_pr`) VALUES
(141, 'KINGSMAN876833', 59400000, 2, 39, 'Thuong', 'Nguyen', '0342888525', '2002@gmail.com', '1', '', '2023-06-08', 'Cancel', 1),
(142, 'KINGSMAN80948', 59950000, 2, 39, 'Thuong', 'Nguyen', '0342888525', '2002@gmail.com', '1', 'hhi', '2023-06-08', 'Cancel', 9),
(143, 'KINGSMAN728281', 22000000, 2, 39, 'Thuong', 'Nguyen', '0342888525', '2002@gmail.com', '1', '', '2023-06-08', 'Cancel', NULL),
(144, 'KINGSMAN7506', 29700000, 2, 39, 'Thuong', 'Nguyen', '0342888525', '2002@gmail.com', '1', '', '2023-06-09', 'Delivered', NULL),
(145, 'KINGSMAN216815', 29700000, 2, 40, 'Thuong', 'Nguyen', '0342888525', '2002@gmail.com', '1', '', '2023-06-09', 'Cancel', NULL),
(146, 'KINGSMAN957547', 8690000, 2, 32, 'Hieu', 'Dang', '0342888525', '110122075@St.tvu.edu.vn', '162 ấp chợ', 'Not note', '2025-01-03', 'Delivered', 1),
(147, 'KINGSMAN953257', 7689000, 2, 45, 'Dang13213', 'Hieu', '0976985305', 'dminhhieu24208@gmail.com', '162 ấp chợ', '', '2025-01-06', 'Cancel', NULL),
(148, 'KINGSMAN198881', 29689000, 2, 32, 'Hieu', 'Dang321312', '0342888525', '110122075@St.tvu.edu.vn', '3123cxzc', 'Not note', '2025-01-07', 'Delivered', NULL),
(149, 'MH848204', 29689000, 2, 32, 'Hieu', 'Dang321312', '0342888525', '110122075@St.tvu.edu.vn', '3123cxzc', '', '2025-01-07', 'Delivered', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id_product` int(6) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `product_img` varchar(50) NOT NULL,
  `product_prices` int(10) NOT NULL DEFAULT 0,
  `catalog_id` int(4) NOT NULL,
  `employee_entry` int(11) NOT NULL,
  `entry_date` date NOT NULL DEFAULT current_timestamp(),
  `sup_id` int(11) NOT NULL,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `special` tinyint(4) NOT NULL DEFAULT 0,
  `old_prices` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL,
  `size` varchar(5) NOT NULL DEFAULT 'L'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id_product`, `product_name`, `quantity`, `product_img`, `product_prices`, `catalog_id`, `employee_entry`, `entry_date`, `sup_id`, `view`, `special`, `old_prices`, `description`, `size`) VALUES
(90, 'Bộ Veston - VES231682', 145, 'owen_phpc1153_3.webp', 6990000, 94, 1, '2024-01-03', 16, 1, 1, 6990000, 'Bộ Vest Nam được thiết kế và đảm bảo chất lượng theo tiêu chuẩn Nhật Bản. Form áo cứng cáp với lớp đệm giúp tôn lên vóc dáng mạnh mẽ, lịch lãm của nam giới.', 'L'),
(91, 'Veston - VES220958', 148, 'ves220958._34_jpg.webp', 7900000, 95, 1, '2024-01-03', 16, 1, 1, 7900000, 'A waistcoat has a full vertical opening in the front, which fastens with buttons or snaps. Both single-breasted and double-breasted waistcoats exist, regardless of the formality of dress, but single-breasted ones are more common. In a three piece suit, th', 'XL'),
(92, 'Bộ Vest Ghi Sáng Biluxury', 271, '20240127_OHVZdEew7B.jpeg', 20000000, 96, 1, '2024-01-03', 16, 1, 1, 20000000, 'A waistcoat has a full vertical opening in the front, which fastens with buttons or snaps. Both single-breasted and double-breasted waistcoats exist, regardless of the formality of dress, but single-breasted ones are more common. In a three piece suit, th', 'XXL'),
(93, 'Bộ Veston - VES231684', 10, 'ves231684._2.webp', 4300000, 96, 1, '2024-01-03', 14, 1, 1, 4300000, 'A waistcoat has a full vertical opening in the front, which fastens with buttons or snaps. Both single-breasted and double-breasted waistcoats exist, regardless of the formality of dress, but single-breasted ones are more common. In a three piece suit, th', 'M'),
(94, 'Supper Vest', 150, 'suit (5).png', 23000000, 95, 1, '2024-01-03', 14, 1, 1, 27500000, 'A waistcoat has a full vertical opening in the front, which fastens with buttons or snaps. Both single-breasted and double-breasted waistcoats exist, regardless of the formality of dress, but single-breasted ones are more common. In a three piece suit, th', 'L'),
(95, 'Vest Đen Biluxury Tặng Quần Âu 7QAVC301DEN', 122, '46_4e8537755e0e4bb3a48c124fa4064e45_master.webp', 8990000, 94, 1, '2024-01-03', 14, 1, 1, 8990000, 'Mua áo Vest Đen Biluxury 7AVBC301DEN tặng Quần Âu 7QAVC301DEN', 'L'),
(96, 'Max Vest', 123, '677a1cc706b40.jpg', 7700000, 94, 1, '2024-01-03', 14, 1, 1, 7700000, 'Thiết kệ tinh tế gọn gàn giúp tạo nên sự nam tính', 'XXL'),
(107, 'Bộ Veston - VES231495', 124, '20240919_smbPQhdlfq.jpeg', 5800000, 96, 1, '2025-01-06', 14, 1, 0, 5800000, 'Bộ Vest Nam được thiết kế và đảm bảo chất lượng theo tiêu chuẩn Nhật Bản. Form áo cứng cáp với lớp đệm giúp tôn lên vóc dáng mạnh mẽ, lịch lãm của nam giới.', 'XL'),
(108, 'Áo Vest Biluxury', 32, 'suit (4).png', 7900000, 96, 1, '2025-01-06', 16, 1, 0, 7900000, 'Bộ Vest Nam được thiết kế và đảm bảo chất lượng theo tiêu chuẩn Nhật Bản. Form áo cứng cáp với lớp đệm giúp tôn lên vóc dáng mạnh mẽ, lịch lãm của nam giới.', 'XL'),
(109, 'Áo Vest CARO Nâu Biluxury', 32, 'product-40.png', 7900000, 96, 1, '2025-01-08', 16, 1, 0, 7900000, 'Bộ Vest Nam được thiết kế và đảm bảo chất lượng theo tiêu chuẩn Nhật Bản. Form áo cứng cáp với lớp đệm giúp tôn lên vóc dáng mạnh mẽ, lịch lãm của nam giới.', 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(255) NOT NULL,
  `sup_address` varchar(255) NOT NULL,
  `sup_bank` int(11) NOT NULL,
  `sup_tax_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`sup_id`, `sup_name`, `sup_address`, `sup_bank`, `sup_tax_code`) VALUES
(14, 'Viettienn', 'VN', 1231231, 123123),
(16, 'Homes', 'US', 1231231, 123123);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name_us` varchar(50) DEFAULT NULL,
  `address_us` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password_us` varchar(20) NOT NULL,
  `role_us` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name_us`, `address_us`, `email`, `user`, `password_us`, `role_us`) VALUES
(1, 'Hiếu', 'KTXkhuA', '110122075@St.tvu.edu.vn', 'adminHieu', '123123', 1),
(9, 'Hieu', '', '20521331@gmail.com', 'adminHieu2', '123123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order` (`id_order`),
  ADD KEY `FK_product` (`id_pro`);

--
-- Indexes for table `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  ADD PRIMARY KEY (`id_catalog_k`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_employee` (`employee_pr`),
  ADD KEY `FK_client_check` (`id_user`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `fk_product_catalog` (`catalog_id`),
  ADD KEY `fk_employee_entry` (`employee_entry`),
  ADD KEY `fk_supplier` (`sup_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  MODIFY `id_catalog_k` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id_product` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `FK_order` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id`),
  ADD CONSTRAINT `FK_product` FOREIGN KEY (`id_pro`) REFERENCES `tbl_product` (`id_product`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `FK_client_check` FOREIGN KEY (`id_user`) REFERENCES `tbl_client` (`id`),
  ADD CONSTRAINT `FK_employee` FOREIGN KEY (`employee_pr`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk_employee_entry` FOREIGN KEY (`employee_entry`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `fk_product_catalog` FOREIGN KEY (`catalog_id`) REFERENCES `tbl_catalog` (`id_catalog_k`),
  ADD CONSTRAINT `fk_supplier` FOREIGN KEY (`sup_id`) REFERENCES `tbl_supplier` (`sup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
