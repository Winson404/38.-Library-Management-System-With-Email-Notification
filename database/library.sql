-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 08:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `actId` int(11) NOT NULL,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`actId`, `actName`, `actDate`, `date_added`) VALUES
(2, 'Activity 5', '2022-12-23', '0000-00-00 00:00:00'),
(3, 'Activity 3', '2022-12-10', '2022-12-11 00:00:00'),
(4, 'Activity 2', '2022-12-11', '2022-12-11 00:00:00'),
(5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '2022-12-11', '2022-12-11 00:00:00'),
(6, 'sample', '2022-12-27', '2022-12-27 00:00:00'),
(8, 'gfdgfd', '2023-01-06', '2022-12-27 00:00:00'),
(9, 'Announcement sample', '2023-01-09', '2023-01-16 00:00:00'),
(10, 'SAMple', '2023-01-24', '2023-01-16 00:00:00'),
(11, 'yhfng', '2023-02-13', '2023-02-05 00:00:00'),
(12, 'smaple', '2023-07-28', '2023-07-08 00:00:00'),
(13, 'sadsadsa', '2023-07-29', '2023-07-08 07:51:00'),
(14, 'samples', '2023-09-07', '2023-09-20 08:26:00'),
(16, 'dsadsadasdsa', '2023-11-16', '2023-10-24 15:58:49'),
(17, 'akoa kinis', '2023-12-09', '2023-10-24 15:59:24'),
(18, 'dfss', '2023-12-18', '2023-12-18 06:48:00'),
(19, 'Smaple', '2023-12-26', '2023-12-18 19:03:50'),
(20, 'dsa', '2023-12-28', '2023-12-18 19:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_ID` int(11) NOT NULL,
  `call_num` varchar(50) NOT NULL,
  `accession_num` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `sub_title_series` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publisher` varchar(100) NOT NULL,
  `place_published` varchar(255) NOT NULL,
  `date_published` int(11) DEFAULT NULL,
  `edition` varchar(100) NOT NULL,
  `volume` varchar(100) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_available` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_ID`, `call_num`, `accession_num`, `title`, `sub_title`, `sub_title_series`, `author`, `publisher`, `place_published`, `date_published`, `edition`, `volume`, `copyright`, `isbn`, `qty`, `qty_available`, `created_at`) VALUES
(1, '12345', '54321', 'Title ', 'Sample', 'Sample', 'Sample', 'Sample', 'Sample', 20240130, 'Sample', 'Sample', 'Sample', 'Sample', 200, 200, '2024-01-04 15:45:57'),
(2, 'A123', 'ACC123', 'Title 1', 'Subtitle 1', 'Series 1', 'Author 1', 'Publisher 1', 'Place 1', 20220101, '1st Edition', '1', '2022', '978-1234567890', 10, 5, '2024-01-05 01:18:09'),
(3, 'B456', 'ACC456', 'Title 2', 'Subtitle 2', 'Series 2', 'Author 2', 'Publisher 2', 'Place 2', 20220202, '2nd Edition', '2', '2022', '978-2345678901', 15, 10, '2024-01-05 01:18:09'),
(4, 'C789', 'ACC789', 'Title 3', 'Subtitle 3', 'Series 3', 'Author 3', 'Publisher 3', 'Place 3', 20220303, '3rd Edition', '3', '2022', '978-3456789012', 20, 15, '2024-01-05 01:18:09'),
(5, 'Y456', 'ACC456', 'Title 4', 'Subtitle 49', 'Series 49', 'Author 49', 'Publisher 49', 'Place 49', 20231130, '2nd Edition', '2', '2023', '978-8765432109', 25, 20, '2024-01-05 01:18:09'),
(6, 'Z789', 'ACC789', 'Title 5', 'Subtitle 50', 'Series 50', 'Author 50', 'Publisher 50', 'Place 50', 20231231, '3rd Edition', '3', '2023', '978-9876543210', 20, 18, '2024-01-05 01:18:09'),
(7, 'A123', 'ACC123', 'Title 6', 'Subtitle 1', 'Series 1', 'Author 1', 'Publisher 1', 'Place 1', 20220101, '1st Edition', '1', '2022', '978-1234567890', 10, 5, '2024-01-05 01:18:38'),
(8, 'B456', 'ACC456', 'Title 7', 'Subtitle 2', 'Series 2', 'Author 2', 'Publisher 2', 'Place 2', 20220202, '2nd Edition', '2', '2022', '978-2345678901', 15, 10, '2024-01-05 01:18:38'),
(9, 'C789', 'ACC789', 'Title 8', 'Subtitle 3', 'Series 3', 'Author 3', 'Publisher 3', 'Place 3', 20220303, '3rd Edition', '3', '2022', '978-3456789012', 20, 15, '2024-01-05 01:18:38'),
(10, 'V234', 'ACC234', 'Title 9', 'Subtitle 51', 'Series 51', 'Author 51', 'Publisher 51', 'Place 51', 20240105, '4th Edition', '4', '2024', '978-6543210987', 30, 25, '2024-01-05 01:18:38'),
(11, 'W567', 'ACC567', 'Title10', 'Subtitle 52', 'Series 52', 'Author 52', 'Publisher 52', 'Place 52', 20240210, '5th Edition', '5', '2024', '978-7654321098', 12, 8, '2024-01-05 01:18:38'),
(12, 'X890', 'ACC890', 'Title 11', 'Subtitle 53', 'Series 53', 'Author 53', 'Publisher 53', 'Place 53', 20240315, '6th Edition', '6', '2024', '978-8765432109', 18, 15, '2024-01-05 01:18:38'),
(13, 'Y123', 'ACC123', 'Title 12', 'Subtitle 54', 'Series 54', 'Author 54', 'Publisher 54', 'Place 54', 20240420, '7th Edition', '7', '2024', '978-9876543210', 22, 20, '2024-01-05 01:18:38'),
(14, 'Z456', 'ACC456', 'Title 13', 'Subtitle 55', 'Series 55', 'Author 55', 'Publisher 55', 'Place 55', 20240525, '8th Edition', '8', '2024', '978-1098765432', 28, 24, '2024-01-05 01:18:38'),
(15, 'A123', 'ACC123', 'Title 14', 'Subtitle 1', 'Series 1', 'Author 1', 'Publisher 1', 'Place 1', 20220101, '1st Edition', '1', '2022', '978-1234567890', 10, 5, '2024-01-05 01:19:09'),
(16, 'B456', 'ACC456', 'Title 15', 'Subtitle 2', 'Series 2', 'Author 2', 'Publisher 2', 'Place 2', 20220202, '2nd Edition', '2', '2022', '978-2345678901', 15, 10, '2024-01-05 01:19:09'),
(17, 'C789', 'ACC789', 'Title 16', 'Subtitle 3', 'Series 3', 'Author 3', 'Publisher 3', 'Place 3', 20220303, '3rd Edition', '3', '2022', '978-3456789012', 20, 15, '2024-01-05 01:19:09'),
(18, 'V234', 'ACC234', 'Title 17', 'Subtitle 51', 'Series 51', 'Author 51', 'Publisher 51', 'Place 51', 20240105, '4th Edition', '4', '2024', '978-6543210987', 30, 25, '2024-01-05 01:19:09'),
(19, 'W567', 'ACC567', 'Title 18', 'Subtitle 52', 'Series 52', 'Author 52', 'Publisher 52', 'Place 52', 20240210, '5th Edition', '5', '2024', '978-7654321098', 12, 8, '2024-01-05 01:19:09'),
(20, 'X890', 'ACC890', 'Title 19', 'Subtitle 53', 'Series 53', 'Author 53', 'Publisher 53', 'Place 53', 20240315, '6th Edition', '6', '2024', '978-8765432109', 18, 15, '2024-01-05 01:19:09'),
(21, 'Y123', 'ACC123', 'Title 20', 'Subtitle 54', 'Series 54', 'Author 54', 'Publisher 54', 'Place 54', 20240420, '7th Edition', '7', '2024', '978-9876543210', 22, 20, '2024-01-05 01:19:09'),
(22, 'Z456', 'ACC456', 'Title 21', 'Subtitle 55', 'Series 55', 'Author 55', 'Publisher 55', 'Place 55', 20240525, '8th Edition', '8', '2024', '978-1098765432', 28, 24, '2024-01-05 01:19:09'),
(23, 'A789', 'ACC789', 'Title 22', 'Subtitle 56', 'Series 56', 'Author 56', 'Publisher 56', 'Place 56', 20240630, '9th Edition', '9', '2024', '978-2109876543', 14, 10, '2024-01-05 01:19:09'),
(24, 'B123', 'ACC123', 'Title 23', 'Subtitle 57', 'Series 57', 'Author 57', 'Publisher 57', 'Place 57', 20240705, '10th Edition', '10', '2024', '978-3210987654', 26, 22, '2024-01-05 01:19:09'),
(25, 'C456', 'ACC456', 'Title 24', 'Subtitle 58', 'Series 58', 'Author 58', 'Publisher 58', 'Place 58', 20240810, '11th Edition', '11', '2024', '978-4321098765', 32, 30, '2024-01-05 01:19:09'),
(26, 'D789', 'ACC789', 'Title 59', 'Subtitle 59', 'Series 59', 'Author 59', 'Publisher 59', 'Place 59', 20240915, '12th Edition', '12', '2024', '978-5432109876', 19, 15, '2024-01-05 01:19:09'),
(27, 'E123', 'ACC123', 'Title 60', 'Subtitle 60', 'Series 60', 'Author 60', 'Publisher 60', 'Place 60', 20241020, '13th Edition', '13', '2024', '978-6543210987', 24, 20, '2024-01-05 01:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `borrow_ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `book_ID` int(11) DEFAULT NULL,
  `date_approve` date NOT NULL,
  `date_rejected` date NOT NULL,
  `date_released` date NOT NULL,
  `date_returned` date NOT NULL,
  `place_to_use` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `return_date` datetime NOT NULL,
  `symbols` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2, Released, 3= Rejected, 4=Returned, 5=Unreturned,\r\n6=Returned late',
  `reason_reject` text NOT NULL,
  `penalty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`borrow_ID`, `user_ID`, `book_ID`, `date_approve`, `date_rejected`, `date_released`, `date_returned`, `place_to_use`, `duration`, `return_date`, `symbols`, `status`, `reason_reject`, `penalty`, `created_at`) VALUES
(34, 88, 18, '2023-12-24', '0000-00-00', '2023-12-25', '2024-01-07', 'At home', '1 Week Maximum', '2023-12-31 17:00:00', 'R', 6, '', 70, '2023-12-24 07:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `logout_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_history`
--

INSERT INTO `log_history` (`log_Id`, `user_Id`, `login_time`, `logout_time`) VALUES
(72, 88, '2024-01-05 03:54 AM', '2024-01-05 03:56:12'),
(73, 88, '2024-01-05 03:56 AM', '2024-01-05 03:56:26'),
(74, 88, '2024-01-05 03:57 AM', '2024-01-05 04:11:57'),
(75, 88, '2024-01-05 04:12 AM', ''),
(76, 88, '2024-01-05 09:12 AM', '2024-01-05 09:13:20'),
(77, 88, '2024-01-05 11:42 AM', '2024-01-05 11:43:04'),
(78, 88, '2024-01-05 11:43 AM', '2024-01-05 11:49:06'),
(79, 88, '2024-01-05 11:49 AM', '2024-01-05 11:59:24'),
(80, 88, '2024-01-05 12:03 PM', '2024-01-05 01:03:34'),
(81, 66, '2024-01-05 01:03 PM', '2024-01-05 01:12:35'),
(82, 88, '2024-01-05 01:12 PM', '2024-01-05 06:43:38'),
(83, 89, '2024-01-05 04:14 PM', '2024-01-05 08:19:02'),
(84, 66, '2024-01-05 06:43 PM', ''),
(85, 88, '2024-01-05 08:19 PM', '2024-01-05 10:56:41'),
(86, 66, '2024-01-05 10:10 PM', '2024-01-06 12:42:34'),
(87, 89, '2024-01-05 11:21 PM', '2024-01-05 11:49:12'),
(88, 88, '2024-01-06 02:18 AM', '2024-01-06 03:29:54'),
(89, 88, '2024-01-06 03:31 AM', '2024-01-06 03:38:10'),
(90, 88, '2024-01-06 03:39 AM', ''),
(91, 66, '2024-01-06 06:11 PM', '2024-01-06 06:34:15'),
(92, 89, '2024-01-06 06:34 PM', '2024-01-06 08:43:52'),
(93, 88, '2024-01-06 07:09 PM', ''),
(94, 88, '2024-01-06 07:16 PM', '2024-01-06 07:22:16'),
(95, 88, '2024-01-06 07:24 PM', '2024-01-06 07:28:54'),
(96, 88, '2024-01-06 07:41 PM', ''),
(97, 66, '2024-01-07 02:38 AM', '2024-01-07 02:45:01'),
(98, 66, '2024-01-07 02:53 AM', '2024-01-07 02:56:09'),
(99, 88, '2024-01-07 02:56 AM', ''),
(100, 66, '2024-01-07 02:31 PM', '2024-01-07 02:35:52'),
(101, 66, '2024-01-07 02:37 PM', '2024-01-07 02:47:19'),
(102, 66, '2024-01-07 03:01 PM', ''),
(103, 88, '2024-01-07 03:17 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `yr_lvl` varchar(100) NOT NULL,
  `teacher_major` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'Staff',
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `email`, `contact`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `image`, `dept`, `yr_lvl`, `teacher_major`, `password`, `user_type`, `verification_code`, `date_registered`) VALUES
(66, 'Admin', 'Admin', 'Admin', 'Admin', '2023-10-11', '1 week old', 'admin@gmail.com', '9359428963', 'Female', 'Male', 'Single', 'Admin', 'United Church of Christ in the Philippines', 'dsas', 'Admin', 'Admin', 'dsa', 'Admin', 'Admin', '', 'Admin', 'antelope-canyon-lower-canyon-arizona.jpg', '', '', '', '0192023a7bbd73250516f069df18b500', 'Admin', 0, '2022-11-25 00:00:00'),
(72, 'Userdss', 'User', 'User', 'Jr', '2022-12-21', '5 days old', 'staff@gmail.com', '9359428963', 'gfdgfdg', 'Male', 'Married', 'gfdgfdgd', 'Buddhist', 'gfdg', 'fdg', 'gdfgdg', 'gfdg', 'dfgd', 'fdgdg', 'fdg', 'dfg', '2.jpg', '', '', '', '0192023a7bbd73250516f069df18b500', 'Staff', 295016, '2022-12-27 00:00:00'),
(86, 'SampleSample Sample', 'Sample Sample Sample', 'Sample Sample', 'Sample', '2008-02-27', '15 Years Old', 'adminfdsfsfs@gmail.com', '9123456789', 'Samplef Fsdfsd', 'Male', 'Single', 'Sampleff Fsdfds', 'Evangelical Christianity', 'Fdfds Fdsf', 'Fsfsdfsdds ', 'Sf Fsdff', 'Fsdfsdfsdfs Fdsf Sfs', 'Fdsfd Fsfs Fs', 'Fdsfds', 'Fsdffdsf', 'Sdfsd', 'pexels-photo-2379005.jpeg', '', '', '', '0192023a7bbd73250516f069df18b500', 'Staff', 0, '2023-12-18 19:19:29'),
(87, 'Leste', 'Leste', 'Leste', 'Leste', '1986-02-26', '37 Years Old', 'adminLeste@gmail.com', '9123456789', 'Leste', 'Female', 'Widow/ER', 'Leste', 'Iglesia Ni Cristo', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', 'Leste', '4.jpg', '', '', '', '83e7921e87b1df559db9c4d2ad9b2697', 'Staff', 0, '2023-12-18 19:22:55'),
(88, 'Students', 'Student', 'Student', 'Student', '1979-03-01', '44 Years Old', 'student@gmail.com', '9359428963', 'Student', 'Male', 'Widow/ER', 'Student', 'Hindu', 'Student', 'Student', 'Student', 'Student', 'Student', 'Student', '', 'Student', 'testimonials-4.jpg', 'Department 1', 'Student One', '', '0192023a7bbd73250516f069df18b500', 'Student', 0, '2024-01-05 01:07:29'),
(89, 'Teacherddd', 'STeachersd', 'TeacherTeachersd', 'Teachersd', '2016-07-06', '15 Years Old', 'teacher@gmail.com', '9359428963', 'Teacher', 'Male', 'Single', 'Teacher', 'Hindu', 'Teacher', 'TeacherTeacher', '', 'Teacher', 'Teacher', 'Teacher', 'Teacher', 'Teacher', '4.jpg', 'N/A', 'N/A', 'Teachers Major', '0192023a7bbd73250516f069df18b500', 'Teacher', 0, '2024-01-05 01:19:50'),
(90, 'Staff One', 'Staff One', 'Staff One', 'Staff One', '1984-03-01', '39 Years Old', 'staffone@gmail.com', '9359428963', 'Staff One', 'Male', 'Married', 'Staff One', 'Hindu', '', 'Staff One', 'Staff One', 'Staff One', 'Staff OneStaff One', 'Staff One', 'Staff One', 'Staff One', 'free-photo-of-young-smiling-woman-in-profile.jpeg', 'N/A', 'N/A', '', '0192023a7bbd73250516f069df18b500', 'Staff', 0, '2024-01-05 01:41:41'),
(91, 'Admin One', 'Admin One', 'Admin One', 'Admin One', '1994-01-31', '29 Years Old', 'adminone@gmail.com', '9359428963', 'Admin One', 'Female', 'Single', 'Admin One', 'Hindu', 'Admin One', 'Admin One', 'Admin One', 'Admin One', 'Admin One', 'Admin One', 'Admin One', 'Admin One', 'pexels-photo-1130626.jpeg', 'N/A', 'N/A', '', '0192023a7bbd73250516f069df18b500', 'Admin', 0, '2024-01-05 01:42:53'),
(92, 'Teacher On', 'Teacher On', 'Teacher On', 'Teacher On', '1986-03-26', '37 Years Old', 'teacherone@gmail.com', '9359428963', 'Teacher On', 'Male', 'Widow/ER', 'Teacher On', 'Methodist', 'Teacher On', 'Teacher On', 'Teacher On', 'Teacher On', 'Teacher On', 'Teacher On', 'Teacher On', 'Teacher On', 'pexels-photo-1181686.jpeg', 'N/A', 'N/A', 'Teachers Major', '0192023a7bbd73250516f069df18b500', 'Teacher', 0, '2024-01-05 01:44:25'),
(93, 'Student One', 'Student One', 'Student One', 'Student One', '2004-02-04', '19 Years Old', 'studentone@gmail.com', '9359428963', 'Student One', 'Male', 'Married', 'Student One', 'Hindu', 'Student One', 'Student One', 'Student One', 'Student One', 'Student One', 'Student One', 'Student One', 'Student One', 'pexels-photo-1516680.jpeg', 'Department 2', 'Student One213', '', '0192023a7bbd73250516f069df18b500', 'Student', 0, '2024-01-05 01:45:42'),
(94, 'Teachers Major', 'Teachers Major', 'Teachers Major', 'Teachers Major', '1995-02-01', '28 Years Old', 'teachermajor@gmail.com', '9359428963', 'Teachers Major', 'Male', 'Single', 'Teachers Major', 'Hindu', 'Teachers Major', 'Teachers Major', 'Teachers Major', 'Teachers Major', 'Teachers Major', 'Teachers Major', 'Teachers Major', 'Teachers Major', 'pexels-photo-769772.jpeg', 'N/A', 'N/A', 'Teachers Majord', '0192023a7bbd73250516f069df18b500', 'Teacher', 0, '2024-01-05 02:11:21'),
(95, 'Student Register', 'Student Register', 'Student Register', 'Student Register', '1999-03-03', '24 Years Old', 'studentregister@gmail.com', '9123456789', 'Student Register', 'Male', 'Single', 'Student Register', 'Methodist', 'Student Register', 'Student Register', 'Student Register', 'Student Register', 'Student Register', 'Student Register', 'Student Register', 'Student Register', 'pexels-photo-4946515.jpeg', 'Department 1', 'Student Register', 'N/A', '0192023a7bbd73250516f069df18b500', 'Student', 0, '2024-01-05 03:03:01'),
(96, 'Teacher Register', 'Teacher Register', 'Teacher Register', 'Teacher Register', '1987-03-05', '36 Years Old', 'teacherregister@gmail.com', '9123456789', 'Teacher Register', 'Male', 'Single', 'Teacher Register', 'Methodist', 'Teacher Register', 'Teacher Register', 'Teacher Register', 'Teacher Register', 'Teacher Register', 'Teacher Register', 'Teacher Register', 'Teacher Register', 'pexels-photo-1681010.jpeg', 'N/A', 'N/A', 'Teacher Register', '0192023a7bbd73250516f069df18b500', 'Teacher', 0, '2024-01-05 03:13:54'),
(97, 'Sample', 'Sample', 'SampleSample', 'Sample', '1990-01-31', '33 Years Old', 'sonerwSampleSampleSamplein8@gmail.com', '9359428963', 'Sample', 'Male', 'Single', 'Sample', 'Buddhist', 'SampleSample', 'Sample', 'SampleSample', 'Sample', 'Sample', 'Sample', 'Sample', 'SampleSample', '4.jpg', 'Student', 'Department 1', 'Sample', 'a2dc1592be8cd31d4395d016917d941c', 'N/A', 0, '2024-01-06 18:13:21'),
(98, 'Asda', 'Dada', 'Sample', 'Sample', '1996-02-28', '27 Years Old', 'sonerwinSaSamplemple8@gmail.com', '9359428963', 'Sample', 'Male', 'Single', 'Sample', 'Evangelical Christianity', 'Sample', 'SampleSample', 'Sample', 'Sample', 'SampleSample', 'Sample', 'Sample', 'Sample', '4.jpg', 'Department 1', 'Dasd', 'N/A', 'a2dc1592be8cd31d4395d016917d941c', 'Student', 0, '2024-01-06 18:17:19'),
(99, 'TeacherTeacher', 'TeacherTeacher', 'Teacher', 'Teacher', '2007-02-28', '16 Years Old', 'sonTeachererwin8@gmail.com', '9359428963', 'Teacher', 'Female', 'Married', 'Teacher', 'Buddhist', 'Teacher', 'TeacherTeacher', 'Teacher', 'Teacher', 'Teacher', 'Teacher', 'Teacher', 'Teacher', '4.jpg', 'N/A', 'N/A', 'Teacher', '80c33d4796ca8b735454d793b2884ef2', 'Teacher', 0, '2024-01-06 18:20:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`actId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_ID`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`borrow_ID`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `actId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `borrow_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
