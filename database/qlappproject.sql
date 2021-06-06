-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 28, 2021 lúc 06:22 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlappproject`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Pro_GetData_StaticForPrioritize` (IN `$StartYear` INT(11), IN `$EndYear` INT(11))  SELECT accountdetail.IsPrioritize as Prioritize, YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) as Number FROM accountdetail WHERE YEAR(accountdetail.AccountDate) BETWEEN $StartYear and $EndYear GROUP BY accountdetail.IsPrioritize, YEAR(accountdetail.AccountDate) ORDER by YEAR(accountdetail.AccountDate)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pro_GetData_StatisticalForArea` (IN `$StartYear` INT(11), IN `$EndYear` INT(11))  SELECT accountdetail.Area, YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) as Number FROM accountdetail WHERE YEAR(accountdetail.AccountDate) BETWEEN $StartYear and $EndYear GROUP bY accountdetail.Area, YEAR(accountdetail.AccountDate) ORDER BY YEAR(accountdetail.AccountDate)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pro_GetData_StatisticalForGraduatingYear` (IN `$StartYear` INT(11), IN `$EndYear` INT(11))  select YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) AS Number, 1 as 'IsGraduate' from accountdetail WHERE accountdetail.GraduatingYear != 0 and accountdetail.GraduatingYear <= YEAR(now()) and (YEAR(accountdetail.AccountDate) BETWEEN $StartYear and $EndYear) GROUP BY year(accountdetail.AccountDate) ORDER by YEAR(accountdetail.AccountDate) DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pro_GetData_StatisticalForNotGraduatingYear` (IN `$StartYear` INT(11), IN `$EndYear` INT(11))  select YEAR(accountdetail.AccountDate) as 'Year', COUNT(accountdetail.AccountID) AS Number, 0 as 'IsGraduate' from accountdetail WHERE (accountdetail.GraduatingYear = 0 OR accountdetail.GraduatingYear > YEAR(now())) and (YEAR(accountdetail.AccountDate) BETWEEN $StartYear and $EndYear) GROUP BY year(accountdetail.AccountDate) ORDER by YEAR(accountdetail.AccountDate) DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pro_GetData_StatisticalForProvince` (IN `$StartYear` INT(11), IN `$EndYear` INT(11))  SELECT accountdetail.ProvinceName, YEAR(accountdetail.AccountDate) as 'Year' , COUNT(accountdetail.AccountID) as Number from accountdetail WHERE YEAR(accountdetail.AccountDate) BETWEEN $StartYear and $EndYear GROUP BY accountdetail.ProvinceName, YEAR(accountdetail.AccountDate) ORDER BY YEAR(accountdetail.AccountDate)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Pro_Get_ListProvinceName` ()  SELECT * from province$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `AccountID` varchar(36) NOT NULL COMMENT 'khóa chính',
  `Username` varchar(100) DEFAULT NULL COMMENT 'tên đăng nhập',
  `Password` varchar(100) DEFAULT NULL COMMENT 'mật khẩu',
  `AccountType` int(11) DEFAULT NULL COMMENT 'Loại người dùng đăng nhập 1- trung tâm khảo thí, 2- thí sinh',
  `AccountDate` datetime NOT NULL,
  `GroupDate` varchar(50) NOT NULL COMMENT 'group tháng/ năm đăng ký'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`AccountID`, `Username`, `Password`, `AccountType`, `AccountDate`, `GroupDate`) VALUES
('08129169-b260-11eb-ac0d-9840bb0282e0', 'admin2', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2021-05-11 15:51:31', ''),
('13577bbd-b260-11eb-ac0d-9840bb0282e0', 'admin3', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2021-05-11 15:51:50', ''),
('1eabbb613ae745a505acb01baeb5277a', 'ptthuy123', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2021-05-11 15:24:57', '05/2021'),
('43e6ad61cb670bf1104966a97862eaca', 'trungthuy99xx', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2021-05-01 04:35:57', '05/2021'),
('4f0791b886bf1c5217ce00cf7b874c4d', 'thuydeptrai', '25d55ad283aa400af464c76d713c07ad', 2, '2021-05-03 15:38:44', '05/2021'),
('63cdaaabdde8cc10383783072795074b', 'ptthuy2', '202cb962ac59075b964b07152d234b70', 2, '2021-04-26 16:25:20', '04/2021'),
('6a1ea72d66d3531dbb879edba1660eaa', 'trinhxinhgai', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2021-04-23 17:05:22', '05/2021'),
('7034490c975d7a63e33e8c27544963a8', 'pttthuy1999@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2021-04-26 17:36:01', '04/2021'),
('7f84b77d61769a5df735cd0dc1b422fb', 'phamtrungthuy', '25d55ad283aa400af464c76d713c07ad', 2, '2021-05-02 16:23:25', '05/2021'),
('85530651ceb912c20a392214789aca82', 'nguyenvanduc', '25d55ad283aa400af464c76d713c07ad', 2, '2021-05-11 15:12:47', '05/2021'),
('89c6b4f140af933c7a2ffaa2175a9282', 'nguyennghianam', '25d55ad283aa400af464c76d713c07ad', 2, '2021-05-11 15:14:21', '05/2021'),
('acf2b190d317338aec0a61e61d1b0f51', 'ptthuy2021', '25d55ad283aa400af464c76d713c07ad', 2, '2021-05-02 16:32:23', '05/2021'),
('c071e870-b25e-11eb-ac0d-9840bb0282e0', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2021-05-11 15:41:44', ''),
('f18547f1-b25f-11eb-ac0d-9840bb0282e0', 'admin1', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2021-05-11 15:49:37', ''),
('f3db119b44b7f23e1aa72d7a0346939c', '123', '202cb962ac59075b964b07152d234b70', 2, '2021-04-26 16:25:09', '04/2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accountdetail`
--

CREATE TABLE `accountdetail` (
  `AccountDetailID` int(11) NOT NULL COMMENT 'khoa chính',
  `AccountID` varchar(36) NOT NULL COMMENT 'id bảng account',
  `Email` varchar(100) NOT NULL COMMENT 'địa chỉ email',
  `DateOfBirth` date NOT NULL COMMENT 'ngày sinh',
  `Gender` varchar(20) NOT NULL COMMENT 'Gioi tinh',
  `FullName` varchar(500) NOT NULL COMMENT 'ho va ten',
  `Identification` varchar(50) NOT NULL COMMENT 'cmnd',
  `PhoneNumber` varchar(11) NOT NULL COMMENT 'sđt',
  `PermanentResidence` varchar(500) NOT NULL COMMENT 'Ho khau thuong tru',
  `Address` varchar(255) NOT NULL COMMENT 'địa chỉ',
  `ProvinceName` varchar(100) NOT NULL COMMENT 'nơi sinh',
  `IsPrioritize` int(3) NOT NULL COMMENT 'co phai doi tuong uu tien hay khong',
  `Area` int(11) NOT NULL COMMENT 'khu vực',
  `GraduatingYear` int(11) NOT NULL COMMENT 'nam tot nghiep',
  `HKIGrade10` double NOT NULL,
  `HKIIGrade10` double NOT NULL,
  `TBGrade10` double NOT NULL,
  `HKIGrade11` double NOT NULL,
  `HKIIGrade11` double NOT NULL,
  `TBGrade11` double NOT NULL,
  `HKIGrade12` double NOT NULL,
  `HKIIGrade12` double NOT NULL,
  `TBGrade12` double NOT NULL,
  `Math` double NOT NULL,
  `Literature` double NOT NULL,
  `English` double NOT NULL,
  `Physics` double NOT NULL,
  `Chemistry` double NOT NULL,
  `Biology` double NOT NULL,
  `History` double NOT NULL,
  `Geography` double NOT NULL,
  `GDCD` double NOT NULL,
  `Nation` varchar(100) NOT NULL COMMENT 'dan toc',
  `AccountDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `accountdetail`
--

INSERT INTO `accountdetail` (`AccountDetailID`, `AccountID`, `Email`, `DateOfBirth`, `Gender`, `FullName`, `Identification`, `PhoneNumber`, `PermanentResidence`, `Address`, `ProvinceName`, `IsPrioritize`, `Area`, `GraduatingYear`, `HKIGrade10`, `HKIIGrade10`, `TBGrade10`, `HKIGrade11`, `HKIIGrade11`, `TBGrade11`, `HKIGrade12`, `HKIIGrade12`, `TBGrade12`, `Math`, `Literature`, `English`, `Physics`, `Chemistry`, `Biology`, `History`, `Geography`, `GDCD`, `Nation`, `AccountDate`) VALUES
(8, '6a1ea72d66d3531dbb879edba1660eaa', 'trungthuy99xx@gmail.com', '1970-01-01', 'Nam', 'Phạm Trung Thủy', '1', '0378734454', '1', 'Binh giang-hd', 'Hải Dương', 1, 4, 2015, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1.07, 1, 'Kinh', '2021-04-08 21:33:35'),
(9, 'f3db119b44b7f23e1aa72d7a0346939c', '', '2005-01-01', 'Nam', '123', '', '', '', '', 'Hải Dương', 1, 2, 2020, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2020-11-17 21:33:44'),
(10, '63cdaaabdde8cc10383783072795074b', '', '2005-01-01', 'Nam', '123', '', '', '', '', 'Hải Dương', 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-03-08 21:33:57'),
(11, '7034490c975d7a63e33e8c27544963a8', '', '2005-01-01', 'Nam', 'Phạm Trung Thủy', '', '', '', '', 'Hà Nội', 2, 2, 2021, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-03-02 21:33:50'),
(12, '43e6ad61cb670bf1104966a97862eaca', '', '1970-01-01', 'Nam', 'phamtrungthuy', '', '', '', '', '', 0, 0, 2024, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2019-05-16 04:35:57'),
(13, '7f84b77d61769a5df735cd0dc1b422fb', '', '1970-01-01', 'Nam', 'pham thuy', '', '123', '', '', '', 0, 0, 2023, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-05-02 16:23:25'),
(14, 'acf2b190d317338aec0a61e61d1b0f51', '', '1970-01-01', 'Nam', 'thuy', '', '', '', '', '', 0, 0, 2016, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2014-05-22 16:32:23'),
(15, '4f0791b886bf1c5217ce00cf7b874c4d', 'trungthuy99xx@gmail.com', '1988-08-20', 'Nam', 'Pham Trung Thủy', '142779716', '0378734454', 'Binh Giang  - Hải Dương', 'Hải Dương', 'Hải Dương', 1, 3, 2014, 7, 8, 8, 8, 8, 8, 9, 10, 9, 9, 6, 9, 9, 9, 7, 9, 7, 7, 'KInh', '2021-05-03 15:38:44'),
(16, '85530651ceb912c20a392214789aca82', 'Noojivanduc@gmail.com', '1978-10-09', 'Nam', 'Nguyễn Văn Đức', '142779716', '0378734454', '', 'Hà Nội', 'Điện Biên', 1, 2, 2018, 6, 7, 8, 9, 8.5, 9, 7.8, 8.2, 8.6, 9, 6.25, 7.26, 8.25, 9.25, 4.5, 4, 7.5, 8.5, 'Kinh', '2018-05-15 15:12:47'),
(17, '89c6b4f140af933c7a2ffaa2175a9282', 'nghianam@gmail.com', '1998-09-24', 'Nam', 'Nguyễn Nghĩa Nam', '143556745', '0912263511', '', 'Ha Tay', 'Hà Tĩnh', 2, 1, 2015, 9, 8, 8, 9, 9, 9, 7, 9, 8, 9, 7, 8, 9.5, 8.5, 10, 7, 6, 9, 'Kinh', '2021-05-11 15:14:21'),
(18, '1eabbb613ae745a505acb01baeb5277a', 'trungthuy@gmail.com', '1973-09-12', 'Nam', 'Phạm Trung Thủy', '142779716', '0378734454', '', 'Hải Dương', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-05-11 15:24:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newfeed`
--

CREATE TABLE `newfeed` (
  `NewFeedID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL COMMENT 'tieu de',
  `Content` longtext NOT NULL COMMENT 'nội dung',
  `CreatedDate` date NOT NULL COMMENT 'Ngay tao'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `newfeed`
--

INSERT INTO `newfeed` (`NewFeedID`, `Title`, `Content`, `CreatedDate`) VALUES
(9, 'thủy', 'PHA+UGjhuqFtIFRydW5nIFRo4buneSDEkeG6uXAgdHJhaSB0JmFncmF2ZTtpIGdp4buPaTwvcD4K', '2021-05-21'),
(10, 'thủy', 'PHA+UGjhuqFtIFRydW5nIFRo4buneSDEkeG6uXAgdHJhaSB0JmFncmF2ZTtpIGdp4buPaTwvcD4K', '2021-05-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `province`
--

CREATE TABLE `province` (
  `ProvinceID` int(11) NOT NULL,
  `ProvinceName` varchar(50) NOT NULL COMMENT 'ten tinh thanh',
  `ProvinceCode` varchar(11) NOT NULL COMMENT 'ma tinh thanh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `province`
--

INSERT INTO `province` (`ProvinceID`, `ProvinceName`, `ProvinceCode`) VALUES
(1, 'An Giang', '880000'),
(2, 'Bà Rịa Vũng Tàu', '790000'),
(3, 'Bạc Liêu', '260000'),
(4, 'Bắc Kạn', '960000'),
(5, 'Bắc Giang', '230000'),
(6, 'Bắc Ninh', '220000'),
(7, 'Bình Dương', '590000'),
(8, 'Bình Định', '820000'),
(9, 'Bình Phước', '830000'),
(10, 'Bình Thuận', '800000'),
(11, 'Bến Tre', '930000'),
(12, 'Cà Mau', '970000'),
(13, 'Cao Bằng', '270000'),
(14, 'Cần Thơ', '900000'),
(15, 'Đà Nẵng', '550000'),
(16, 'Điện Biên', '380000'),
(17, 'Đắk Lắk', '630000'),
(18, 'Đắk Nông', '640000'),
(19, 'Đồng Nai', '810000'),
(20, 'Đồng Tháp', '870000'),
(21, 'Gia Lai', '600000'),
(22, 'Hà Giang', '310000'),
(23, 'Hà Nam', '400000'),
(24, 'Hà Nội', '100000'),
(25, 'Hà Tĩnh', '480000'),
(26, 'Hải Dương', '170000'),
(27, 'Hải Phòng', '180000'),
(28, 'Hậu Giang', '910000'),
(29, 'Hòa Bình', '350000'),
(30, 'TP. Hồ Chí Minh', '700000'),
(31, 'Hưng Yên', '160000'),
(32, 'Khánh Hoà', '650000'),
(33, 'Kiên Giang', '920000'),
(34, 'Kon Tum', '580000'),
(35, 'Lai Châu', '390000'),
(36, 'Lạng Sơn', '240000'),
(37, 'Lào Cai', '330000'),
(38, 'Lâm Đồng', '670000'),
(39, 'Long An', '850000'),
(40, 'Nam Định', '420000'),
(41, 'Nghệ An', '460000'),
(42, 'Ninh Bình', '430000'),
(43, 'Ninh Thuận', '660000'),
(44, 'Phú Thọ', '290000'),
(45, 'Phú Yên', '620000'),
(46, 'Quảng Bình', '510000'),
(47, 'Quảng Nam', '560000'),
(48, 'Quảng Ngãi', '570000'),
(49, 'Quảng Ninh', '200000'),
(50, 'Quảng Trị', '520000'),
(51, 'Sóc Trăng', '950000'),
(52, 'Sơn La', '360000'),
(53, 'Tây Ninh', '840000'),
(54, 'Thái Bình', '410000'),
(55, 'Thái Nguyên', '250000'),
(56, 'Thanh Hoá', '440000'),
(57, 'Thừa Thiên Huế', '530000'),
(58, 'Tiền Giang', '860000'),
(59, 'Trà Vinh', '940000'),
(60, 'Tuyên Quang', '300000'),
(61, 'Vĩnh Long', '890000'),
(62, 'Vĩnh Phúc', '280000'),
(63, 'Yên Bái', '320000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registexam`
--

CREATE TABLE `registexam` (
  `RegistExamID` varchar(36) NOT NULL COMMENT 'primarykey',
  `IsRegistAll` bit(1) NOT NULL COMMENT 'có lấy cả ca thi không,hoặc là đóng ca thi',
  `StartedDate` datetime NOT NULL,
  `FinishDate` datetime NOT NULL,
  `CreateYear` int(11) NOT NULL COMMENT 'Nam tao',
  `UnitRegist` int(11) NOT NULL COMMENT 'so ca thi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `registexam`
--

INSERT INTO `registexam` (`RegistExamID`, `IsRegistAll`, `StartedDate`, `FinishDate`, `CreateYear`, `UnitRegist`) VALUES
('5b81c54439c6fa62a4add4abdb9fa573', b'1', '2021-05-28 00:00:00', '2021-05-30 00:00:00', 2021, 2),
('de22d6d746003555ee933281e1759206', b'1', '2021-06-06 00:00:00', '2021-06-06 00:00:00', 2021, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registexamdetail`
--

CREATE TABLE `registexamdetail` (
  `RegistExamDetailID` varchar(36) NOT NULL COMMENT 'khoas chinh',
  `RegistExamID` varchar(36) NOT NULL COMMENT 'id bảng  registexam',
  `StartedDate` datetime NOT NULL COMMENT 'Ngay mo dang ky',
  `FinishDate` datetime NOT NULL COMMENT 'ngay dong dang ky',
  `ExamDate` date NOT NULL COMMENT 'ngày thi',
  `Examee` int(11) NOT NULL COMMENT 'số lượng thí sinh đã đăng ký',
  `ExameeMax` int(11) NOT NULL COMMENT 'số lượng thí sinh tối da',
  `Location` varchar(500) NOT NULL COMMENT 'địa điểm thi',
  `IsRegist` bit(1) NOT NULL COMMENT 'mở đóng đăng ký',
  `UnitExam` int(11) NOT NULL COMMENT 'ca thi số mấy',
  `ExamTime` varchar(30) NOT NULL COMMENT 'thoi gian'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `registexamdetail`
--

INSERT INTO `registexamdetail` (`RegistExamDetailID`, `RegistExamID`, `StartedDate`, `FinishDate`, `ExamDate`, `Examee`, `ExameeMax`, `Location`, `IsRegist`, `UnitExam`, `ExamTime`) VALUES
('8840876ffbf9a2d58cf6aad6710209dd', '5b81c54439c6fa62a4add4abdb9fa573', '2021-05-28 00:00:00', '2021-05-30 00:00:00', '2021-06-05', 0, 20, 'G4', b'1', 4, '13h'),
('dbdb01834223ece80e2ff1434f15a161', 'de22d6d746003555ee933281e1759206', '2021-06-06 00:00:00', '2021-06-06 00:00:00', '2021-05-29', 0, 3, 'GD3', b'1', 1, '7h');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registexaminfor`
--

CREATE TABLE `registexaminfor` (
  `RegistExamInforID` int(11) NOT NULL COMMENT 'khóa chính',
  `AccountID` varchar(36) NOT NULL COMMENT 'id bảng account',
  `RegistExamDetailID` varchar(36) NOT NULL COMMENT 'id bảng examdetail',
  `IdentificationNumber` int(11) NOT NULL COMMENT 'sbd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`);

--
-- Chỉ mục cho bảng `accountdetail`
--
ALTER TABLE `accountdetail`
  ADD PRIMARY KEY (`AccountDetailID`),
  ADD KEY `Fk_Account_AccountDetail` (`AccountID`);

--
-- Chỉ mục cho bảng `newfeed`
--
ALTER TABLE `newfeed`
  ADD PRIMARY KEY (`NewFeedID`);

--
-- Chỉ mục cho bảng `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`ProvinceID`);

--
-- Chỉ mục cho bảng `registexam`
--
ALTER TABLE `registexam`
  ADD PRIMARY KEY (`RegistExamID`);

--
-- Chỉ mục cho bảng `registexamdetail`
--
ALTER TABLE `registexamdetail`
  ADD PRIMARY KEY (`RegistExamDetailID`),
  ADD KEY `Fk_registexamdetail_registexam` (`RegistExamID`);

--
-- Chỉ mục cho bảng `registexaminfor`
--
ALTER TABLE `registexaminfor`
  ADD PRIMARY KEY (`RegistExamInforID`),
  ADD KEY `FK_Registexaminfo_registexamdetail` (`RegistExamDetailID`),
  ADD KEY `Fk_RegistExamInfo_accountid` (`AccountID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accountdetail`
--
ALTER TABLE `accountdetail`
  MODIFY `AccountDetailID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khoa chính', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `newfeed`
--
ALTER TABLE `newfeed`
  MODIFY `NewFeedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `province`
--
ALTER TABLE `province`
  MODIFY `ProvinceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `registexaminfor`
--
ALTER TABLE `registexaminfor`
  MODIFY `RegistExamInforID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'khóa chính', AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accountdetail`
--
ALTER TABLE `accountdetail`
  ADD CONSTRAINT `Fk_Account_AccountDetail` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `registexamdetail`
--
ALTER TABLE `registexamdetail`
  ADD CONSTRAINT `Fk_registexamdetail_registexam` FOREIGN KEY (`RegistExamID`) REFERENCES `registexam` (`RegistExamID`);

--
-- Các ràng buộc cho bảng `registexaminfor`
--
ALTER TABLE `registexaminfor`
  ADD CONSTRAINT `FK_Registexaminfo_registexamdetail` FOREIGN KEY (`RegistExamDetailID`) REFERENCES `registexamdetail` (`RegistExamDetailID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Fk_RegistExamInfo_accountid` FOREIGN KEY (`AccountID`) REFERENCES `account` (`AccountID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
