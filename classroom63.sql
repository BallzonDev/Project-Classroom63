-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 10:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_number` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `grade_level` varchar(10) DEFAULT 'ม.6/3',
  `status` varchar(20) DEFAULT 'เรียนอยู่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_number`, `student_id`, `full_name`, `grade_level`, `status`) VALUES
(1, '18319', 'นาย ชลวีร์ เสือกงลาด', 'ม.6/3', 'เรียน'),
(2, '18323', 'นาย ณัฐวุฒิ ปัญจกุล', 'ม.6/3', 'เรียน'),
(3, '18325', 'นาย พีรพัฒ สําแดงไพร', 'ม.6/3', 'เรียน'),
(4, '18362', 'นาย ธนกฤต เนียมชาวนา', 'ม.6/3', 'เรียน'),
(5, '18363', 'นาย ธนกฤต ทวีศรี', 'ม.6/3', 'เรียน'),
(6, '18373', 'นาย ภัทรชัย แซ่ตั้ง', 'ม.6/3', 'เรียน'),
(7, '18399', 'นาย ดีพร้อม ผิวอ่อน', 'ม.6/3', 'เรียน'),
(8, '18401', 'นาย เตวิช ตรีเดชา', 'ม.6/3', 'เรียน'),
(9, '18405', 'นาย ธนาธิป เพ็งเกลา', 'ม.6/3', 'เรียน'),
(10, '18411', 'นาย พชรกร วัฒนกิจรุ่งโรจน์', 'ม.6/3', 'เรียน'),
(11, '18417', 'นาย อภิเดช ทองเต่าหมก', 'ม.6/3', 'เรียน'),
(12, '18419', 'นาย เอกสิทธิ์ รุ่งเรือง', 'ม.6/3', 'เรียน'),
(13, '18439', 'นาย ธนวัต กิจเคช', 'ม.6/3', 'เรียน'),
(14, '18440', 'นาย ธนวินท์ แก้วสุขแสง', 'ม.6/3', 'เรียน'),
(15, '18442', 'นาย ธรรศ เพ็ชรัตน์', 'ม.6/3', 'เรียน'),
(16, '18482', 'นาย สถาพร ชื่นกลิ่นธูป', 'ม.6/3', 'เรียน'),
(17, '18528', 'นาย วิทวัส เกตุแก้ว', 'ม.6/3', 'เรียน'),
(18, '18557', 'นาย ธเนศ มากลัด', 'ม.6/3', 'เรียน'),
(19, '18558', 'นาย ธีรศักดิ์ วงษ์สังข์', 'ม.6/3', 'เรียน'),
(20, '18600', 'นาย ชิษณุพงศ์ สังข์สวัสดิ', 'ม.6/3', 'เรียน'),
(21, '18647', 'นาย รวีโรจน์ อ้อมคํา', 'ม.6/3', 'เรียน'),
(22, '18653', 'นาย สุทัศน์ จิตนะริน', 'ม.6/3', 'เรียน'),
(23, '18683', 'นาย ธชาพัฒน์ ฐิติพรจิรโชติ', 'ม.6/3', 'เรียน'),
(24, '18687', 'นาย พัชฐวุฒิ แสนชัย', 'ม.6/3', 'เรียน'),
(25, '18691', 'นาย สิรภัทร ชินนาคา', 'ม.6/3', 'เรียน'),
(26, '18693', 'นาย อนุชิต อินทร์พงศ์', 'ม.6/3', 'เรียน'),
(27, '18730', 'นาย พีรพัฒน์ เมืองรามัญ', 'ม.6/3', 'เรียน'),
(28, '19304', 'นาย ปรเมศวร์ ตรานกแก้ว', 'ม.6/3', 'เรียน'),
(29, '19781', 'นาย ธนภัทร เทียนเล็ก', 'ม.6/3', 'เรียน'),
(30, '19782', 'นาย เวฬษฐ์ สังข์เสวก', 'ม.6/3', 'เรียน'),
(31, '18175', 'นางสาว สุทัตตา บุญมาก', 'ม.6/3', 'เรียน'),
(32, '18384', 'นางสาว ณัฐพร ไชโยยอดยิ่ง', 'ม.6/3', 'เรียน'),
(33, '18464', 'นางสาว เบญญาภา วงษ์ยาปาน', 'ม.6/3', 'เรียน'),
(34, '18468', 'นางสาว รุ่งทิวา สิมาเลาเต่า', 'ม.6/3', 'เรียน'),
(35, '18490', 'นางสาว ณัชชา มีทรัพย์', 'ม.6/3', 'เรียน'),
(36, '18576', 'นางสาว ชมพูนิกข์ ชนมาลัย', 'ม.6/3', 'เรียน'),
(37, '18707', 'นางสาว วรยา เซียงฉิน', 'ม.6/3', 'เรียน'),
(38, '19783', 'นางสาว ณัฐนันท์ ตะโก', 'ม.6/3', 'เรียน');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `attendance_count` int(11) DEFAULT 0,
  `attendance_percentage` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `student_id`, `full_name`, `attendance_count`, `attendance_percentage`) VALUES
(1, '18319', 'นาย ชลวีร์ เสือกงลาด', 0, 0.00),
(2, '18323', 'นาย ณัฐวุฒิ ปัญจกุล', 0, 0.00),
(3, '18325', 'นาย พีรพัฒ สําแดงไพร', 0, 0.00),
(4, '18362', 'นาย ธนกฤต เนียมชาวนา', 0, 0.00),
(5, '18363', 'นาย ธนกฤต ทวีศรี', 0, 0.00),
(6, '18373', 'นาย ภัทรชัย แซ่ตั้ง', 0, 0.00),
(7, '18399', 'นาย ดีพร้อม ผิวอ่อน', 0, 0.00),
(8, '18401', 'นาย เตวิช ตรีเดชา', 0, 0.00),
(9, '18405', 'นาย ธนาธิป เพ็งเกลา', 0, 0.00),
(10, '18411', 'นาย พชรกร วัฒนกิจรุ่งโรจน์', 0, 0.00),
(11, '18417', 'นาย อภิเดช ทองเต่าหมก', 0, 0.00),
(12, '18419', 'นาย เอกสิทธิ์ รุ่งเรือง', 0, 0.00),
(13, '18439', 'นาย ธนวัต กิจเคช', 0, 0.00),
(14, '18440', 'นาย ธนวินท์ แก้วสุขแสง', 0, 0.00),
(15, '18442', 'นาย ธรรศ เพ็ชรัตน์', 0, 0.00),
(16, '18482', 'นาย สถาพร ชื่นกลิ่นธูป', 0, 0.00),
(17, '18528', 'นาย วิทวัส เกตุแก้ว', 0, 0.00),
(18, '18557', 'นาย ธเนศ มากลัด', 0, 0.00),
(19, '18558', 'นาย ธีรศักดิ์ วงษ์สังข์', 0, 0.00),
(20, '18600', 'นาย ชิษณุพงศ์ สังข์สวัสดิ', 0, 0.00),
(21, '18647', 'นาย รวีโรจน์ อ้อมคํา', 0, 0.00),
(22, '18653', 'นาย สุทัศน์ จิตนะริน', 0, 0.00),
(23, '18683', 'นาย ธชาพัฒน์ ฐิติพรจิรโชติ', 0, 0.00),
(24, '18687', 'นาย พัชฐวุฒิ แสนชัย', 0, 0.00),
(25, '18691', 'นาย สิรภัทร ชินนาคา', 0, 0.00),
(26, '18693', 'นาย อนุชิต อินทร์พงศ์', 0, 0.00),
(27, '18730', 'นาย พีรพัฒน์ เมืองรามัญ', 0, 0.00),
(28, '19304', 'นาย ปรเมศวร์ ตรานกแก้ว', 0, 0.00),
(29, '19781', 'นาย ธนภัทร เทียนเล็ก', 0, 0.00),
(30, '19782', 'นาย เวฬษฐ์ สังข์เสวก', 0, 0.00),
(31, '18175', 'นางสาว สุทัตตา บุญมาก', 0, 0.00),
(32, '18384', 'นางสาว ณัฐพร ไชโยยอดยิ่ง', 0, 0.00),
(33, '18464', 'นางสาว เบญญาภา วงษ์ยาปาน', 0, 0.00),
(34, '18468', 'นางสาว รุ่งทิวา สิมาเลาเต่า', 0, 0.00),
(35, '18490', 'นางสาว ณัชชา มีทรัพย์', 0, 0.00),
(36, '18576', 'นางสาว ชมพูนิกข์ ชนมาลัย', 0, 0.00),
(37, '18707', 'นางสาว วรยา เซียงฉิน', 0, 0.00),
(38, '19783', 'นางสาว ณัฐนันท์ ตะโก', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `student_payment`
--

CREATE TABLE `student_payment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `amount_paid` decimal(10,2) DEFAULT 0.00,
  `amount_due` decimal(10,2) DEFAULT 0.00,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_payment`
--

INSERT INTO `student_payment` (`id`, `student_id`, `full_name`, `amount_paid`, `amount_due`, `payment_status`) VALUES
(1, '18319', 'นาย ชลวีร์ เสือกงลาด', 0.00, 0.00, 'ยังไม่จ่าย'),
(2, '18323', 'นาย ณัฐวุฒิ ปัญจกุล', 0.00, 0.00, 'ยังไม่จ่าย'),
(3, '18325', 'นาย พีรพัฒ สําแดงไพร', 0.00, 0.00, 'ยังไม่จ่าย'),
(4, '18362', 'นาย ธนกฤต เนียมชาวนา', 0.00, 0.00, 'ยังไม่จ่าย'),
(5, '18363', 'นาย ธนกฤต ทวีศรี', 0.00, 0.00, 'ยังไม่จ่าย'),
(6, '18373', 'นาย ภัทรชัย แซ่ตั้ง', 0.00, 0.00, 'ยังไม่จ่าย'),
(7, '18399', 'นาย ดีพร้อม ผิวอ่อน', 0.00, 0.00, 'ยังไม่จ่าย'),
(8, '18401', 'นาย เตวิช ตรีเดชา', 0.00, 0.00, 'ยังไม่จ่าย'),
(9, '18405', 'นาย ธนาธิป เพ็งเกลา', 0.00, 0.00, 'ยังไม่จ่าย'),
(10, '18411', 'นาย พชรกร วัฒนกิจรุ่งโรจน์', 0.00, 0.00, 'ยังไม่จ่าย'),
(11, '18417', 'นาย อภิเดช ทองเต่าหมก', 0.00, 0.00, 'ยังไม่จ่าย'),
(12, '18419', 'นาย เอกสิทธิ์ รุ่งเรือง', 0.00, 0.00, 'ยังไม่จ่าย'),
(13, '18439', 'นาย ธนวัต กิจเคช', 0.00, 0.00, 'ยังไม่จ่าย'),
(14, '18440', 'นาย ธนวินท์ แก้วสุขแสง', 0.00, 0.00, 'ยังไม่จ่าย'),
(15, '18442', 'นาย ธรรศ เพ็ชรัตน์', 0.00, 0.00, 'ยังไม่จ่าย'),
(16, '18482', 'นาย สถาพร ชื่นกลิ่นธูป', 0.00, 0.00, 'ยังไม่จ่าย'),
(17, '18528', 'นาย วิทวัส เกตุแก้ว', 0.00, 0.00, 'ยังไม่จ่าย'),
(18, '18557', 'นาย ธเนศ มากลัด', 0.00, 0.00, 'ยังไม่จ่าย'),
(19, '18558', 'นาย ธีรศักดิ์ วงษ์สังข์', 0.00, 0.00, 'ยังไม่จ่าย'),
(20, '18600', 'นาย ชิษณุพงศ์ สังข์สวัสดิ', 0.00, 0.00, 'ยังไม่จ่าย'),
(21, '18647', 'นาย รวีโรจน์ อ้อมคํา', 0.00, 0.00, 'ยังไม่จ่าย'),
(22, '18653', 'นาย สุทัศน์ จิตนะริน', 0.00, 0.00, 'ยังไม่จ่าย'),
(23, '18683', 'นาย ธชาพัฒน์ ฐิติพรจิรโชติ', 0.00, 0.00, 'ยังไม่จ่าย'),
(24, '18687', 'นาย พัชฐวุฒิ แสนชัย', 0.00, 0.00, 'ยังไม่จ่าย'),
(25, '18691', 'นาย สิรภัทร ชินนาคา', 0.00, 0.00, 'ยังไม่จ่าย'),
(26, '18693', 'นาย อนุชิต อินทร์พงศ์', 0.00, 0.00, 'ยังไม่จ่าย'),
(27, '18730', 'นาย พีรพัฒน์ เมืองรามัญ', 0.00, 0.00, 'ยังไม่จ่าย'),
(28, '19304', 'นาย ปรเมศวร์ ตรานกแก้ว', 0.00, 0.00, 'ยังไม่จ่าย'),
(29, '19781', 'นาย ธนภัทร เทียนเล็ก', 0.00, 0.00, 'ยังไม่จ่าย'),
(30, '19782', 'นาย เวฬษฐ์ สังข์เสวก', 0.00, 0.00, 'ยังไม่จ่าย'),
(31, '18175', 'นางสาว สุทัตตา บุญมาก', 0.00, 0.00, 'ยังไม่จ่าย'),
(32, '18384', 'นางสาว ณัฐพร ไชโยยอดยิ่ง', 0.00, 0.00, 'ยังไม่จ่าย'),
(33, '18464', 'นางสาว เบญญาภา วงษ์ยาปาน', 0.00, 0.00, 'ยังไม่จ่าย'),
(34, '18468', 'นางสาว รุ่งทิวา สิมาเลาเต่า', 0.00, 0.00, 'ยังไม่จ่าย'),
(35, '18490', 'นางสาว ณัชชา มีทรัพย์', 0.00, 0.00, 'ยังไม่จ่าย'),
(36, '18576', 'นางสาว ชมพูนิกข์ ชนมาลัย', 0.00, 0.00, 'ยังไม่จ่าย'),
(37, '18707', 'นางสาว วรยา เซียงฉิน', 0.00, 0.00, 'ยังไม่จ่าย'),
(38, '19783', 'นางสาว ณัฐนันท์ ตะโก', 0.00, 0.00, 'ยังไม่จ่าย');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` text NOT NULL DEFAULT 'เรียน',
  `profile_picture` varchar(255) DEFAULT 'default-profile.png',
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_number`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_payment`
--
ALTER TABLE `student_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student_payment`
--
ALTER TABLE `student_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;