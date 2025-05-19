-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 09:39 AM
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
-- Database: `online_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(20) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `credit_hour` decimal(3,1) NOT NULL,
  `course_year` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_title`, `credit_hour`, `course_year`, `semester`) VALUES
('Econ2009', 'Economics', 3.0, 2, '1'),
('EEng2004', 'Digital Logic Design', 3.0, 2, '2'),
('GLTr2011', 'Global Trend', 2.0, 2, '1'),
('Hists2002', 'History of Ethiopia and The Horn', 3.0, 2, '1'),
('IETP4115', 'Integrated Engineering Team Project', 3.0, 4, '1'),
('Stat2091', 'Probability and Statistics', 3.0, 2, '2'),
('SWEG2101', 'Introduction to Software Engineering and Computing', 4.0, 2, '1'),
('SWEG2102', 'Fundamentals of Programming II', 3.0, 2, '2'),
('SWEG2103', 'Fundamentals of Programming I', 3.0, 2, '1'),
('SWEG2105', 'Discrete Mathematics for Software Engineering', 3.0, 2, '1'),
('SWEG2106', 'Data Communication and Computer Networks', 4.0, 2, '2'),
('SWEG2108', 'Database Systems', 4.0, 2, '2'),
('SWEG3101', 'Object Oriented Programming', 3.0, 3, '1'),
('SWEG3102', 'Internet Programming II', 3.0, 3, '2'),
('SWEG3103', 'Data Structure and Algorithms', 4.0, 3, '1'),
('SWEG3104', 'Software Requirements Engineering', 3.0, 3, '2'),
('SWEG3105', 'Computer Organization and Architecture', 4.0, 3, '1'),
('SWEG3106', 'Operating Systems', 4.0, 3, '2'),
('SWEG3107', 'Internet Programming I', 3.0, 3, '1'),
('SWEG3108', 'Advanced Programming', 4.0, 3, '2'),
('SWEG3109', 'System Analysis and Modeling', 4.0, 3, '1'),
('SWEG3110', 'Formal Language and Automata Theory', 3.0, 3, '2'),
('SWEG4101', 'Principles of Compiler Design', 3.0, 4, '1'),
('SWEG4102', 'Embedded Systems', 3.0, 4, '2'),
('SWEG4103', 'Mobile Computing and Programming', 3.0, 4, '1'),
('SWEG4104', 'Software Project Management', 3.0, 4, '2'),
('SWEG4105', 'Software Design and Architecture', 3.0, 4, '1'),
('SWEG4106', 'Software Quality Assurance and Testing', 3.0, 4, '2'),
('SWEG4107', 'Introduction to Artificial Intelligence', 3.0, 4, '1'),
('SWEG4108', 'Research Methods in Software Engineering', 2.0, 4, '2'),
('SWEG4109', 'Computer Graphics', 3.0, 4, '1'),
('SWEG4110', 'Human Computer Interaction', 3.0, 4, '2'),
('SWEG4112', 'Introduction to Machine learning', 3.0, 4, '2'),
('SWEG4114', 'Industrial Internship', 6.0, 4, 'Summer'),
('SWEG5101', 'Senior Research Project Phase I', 0.0, 5, '1'),
('SWEG5102', 'Senior Research Project II', 6.0, 5, '2'),
('SWEG5103', 'Software Configuration Management', 3.0, 5, '1'),
('SWEG5105', 'Computer System Security', 3.0, 5, '1'),
('SWEG5106', 'Software Evolution And Maintenance', 3.0, 5, '2'),
('SWEG5107', 'Software Component Design', 3.0, 5, '1'),
('SWEG5108', 'Software Defined Systems', 3.0, 5, '2'),
('SWEG5109', 'Open Source Software Paradigms', 3.0, 5, '1'),
('SWEG5111', 'Distributed Systems', 4.0, 5, '1'),
('SWEG5201', 'Introduction to Big Data Analytics', 3.0, 5, '1'),
('SWEG5203', 'Data Mining and Data Warehousing', 3.0, 5, '1'),
('SWEG5205', 'Simulation and Modeling', 3.0, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `semester` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `first_name`, `middle_name`, `last_name`, `department`, `year`, `email`, `password`, `semester`) VALUES
(1, 'Nahom', 'Tesfay', 'Alemayehu', 'Software Engineering', 2, 'nates1992.aa@gmail.com', 'example', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
