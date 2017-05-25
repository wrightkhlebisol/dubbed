-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 02:09 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `modub`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `topic` varchar(256) NOT NULL,
  `category` varchar(16) NOT NULL,
  `time_frame` int(4) DEFAULT NULL,
  `solutions` int(4) DEFAULT '0',
  `more_info` text NOT NULL,
  `deadline` date NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_name` varchar(128) DEFAULT NULL,
  `file_type` varchar(64) DEFAULT NULL,
  `file_size` varchar(11) DEFAULT NULL,
  `tags` varchar(256) DEFAULT NULL,
  `img_name` varchar(16) DEFAULT NULL,
  `upload_time` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `uploader_id`, `topic`, `category`, `time_frame`, `solutions`, `more_info`, `deadline`, `upload_date`, `file_name`, `file_type`, `file_size`, `tags`, `img_name`, `upload_time`) VALUES
(1, 1, 'Machine Learning', 'An assignment ab', 0, 0, 'The lecturer taking this course is a very intelligent person.', '2017-05-17', '2015-05-17 13:19:48', 'Mid Semester Examination2016_2017.pdf.pdf', '', NULL, '', '', ''),
(2, 2, 'c# assignment', 'classwork on GUI', 0, 0, 'This is supposed to be about c# classwork but the user has decided to upload an irrelevant content because the user is dumb', '2017-05-17', '2016-09-23 13:19:48', '7 Known Success Secrets Of The Rich And Famous.pdf', '', NULL, '', '', ''),
(3, 1, 'Basic Electrical Component Design II', 'Electrical Elect', 0, 0, 'This course intrtoduces the concept of electrical component design and its application in everyday use.', '2017-05-17', '2016-04-17 13:19:48', 'web_designer_CV_template.pdf', '', NULL, '', '', ''),
(4, 2, 'Numerical Methods', 'Math Modelling f', 0, 0, 'This is part of the numerical methods lecture delivered by Dr T.T Akano of the University of Lagos, Nigeria. It requires iterating over a series of Gaussian Eliminations and finding the closest values to the given variables, I ave tried my hand on the problem but the solution is quiet elusive, hopefully, someone from here will be able to solve it. Thanks.', '2017-05-17', '2017-02-27 13:19:48', 'web_developer_resume_template.pdf', '', NULL, '', '', ''),
(23, 1, 'the contents topic', 'the classificati', 0, 0, 'more info about the content goes here of course', '2017-05-17', '2017-02-17 13:19:48', '10_Minute_Guide_To_Investing_In_Stocks.pdf', '', NULL, '', '', ''),
(24, 1, 'jsdjdjjdj', 'jjdjd', NULL, NULL, 'mjzjmxmj', '2017-04-13', '2017-02-01 13:19:48', 'Dr_Ogboi_F_L_Circuit_and_systems_2_use.pdf', NULL, NULL, NULL, NULL, NULL),
(25, 1, 'urwdjdj', 'ckdk', NULL, 0, 'jksjsj', '2017-05-17', '2016-04-13 13:19:48', 'Dr_Ogboi_F_L_Circuit_and_systems_3_use.pdf', NULL, NULL, NULL, NULL, NULL),
(26, 2, 'ididii', 'ikdidi', NULL, 0, 'mmssm', '2017-05-17', '2016-11-02 13:19:48', 'Dr_Ogboi_F_L_Circuit_and_systems_1_use.pdf', NULL, NULL, NULL, NULL, NULL),
(27, 1, 'sddd', 'jjddj', NULL, 0, 'mdmdd', '2017-05-17', '2014-06-23 13:19:48', 'Dr_Ogboi_F_L_Circuit_and_systems_7_updated_use.pdf', NULL, NULL, NULL, NULL, NULL),
(28, 2, 'the topic', 'kdkdk', NULL, 0, 'mmcmcm', '2017-05-17', '2017-05-01 13:19:48', 'EEG_301_Assignment.pdf', NULL, NULL, NULL, NULL, NULL),
(29, 6, 'mmmkm', 'ggg', NULL, 0, 'k,mmk', '2017-05-17', '2017-03-19 13:19:48', 'IMG-20170331-WA0008.jpg', NULL, NULL, NULL, NULL, NULL),
(30, 6, 'rt76yh', 'ftg65', NULL, 0, 'yuuiiui', '2017-05-17', '2016-07-26 13:19:48', '05_-_Views_-_Solution.mp4', NULL, NULL, NULL, NULL, NULL),
(31, 2, 'topic', 'classify', NULL, 0, 'more', '2017-05-17', '2017-05-17 13:19:48', 'Tomato.pdf', 'application/pdf', '79869', NULL, NULL, NULL),
(32, 2, 'topic', 'classify', NULL, 0, 'more info', '2017-05-17', '2016-09-07 13:19:48', 'Tomato.pdf', 'application/pdf', '79869', NULL, NULL, NULL),
(33, 1, 'hhdh', 'dhdh', NULL, 0, 'morer info', '2017-05-17', '2015-12-21 13:19:48', 'chrome.dll.sig', 'application/octet-stream', '1407', NULL, NULL, NULL),
(34, 1, 'jddjj', 'jxjxj', NULL, 0, 'mksuduu', '2017-05-17', '2017-03-13 13:19:48', 'chrome.dll.sig', 'application/octet-stream', '1407', NULL, NULL, NULL),
(35, 1, 'ccj', 'ckck', NULL, 0, 'nsnss', '2017-05-17', '2016-07-13 13:19:48', 'index.html', 'text/html', '10592', NULL, NULL, NULL),
(36, 1, 'jjj', 'xc ', NULL, 0, 'CXKXKC', '2017-05-17', '2017-05-07 13:19:48', 'jquery-2.1.4.min.js', 'application/javascript', '84345', NULL, NULL, NULL),
(38, 7, 'MathLab', '', NULL, 0, 'More info about the content', '2017-05-17', '2017-05-17 13:39:58', 'vlcsnap-2017-04-19-00h56m22s544.png', 'image/png', '181769', NULL, NULL, NULL),
(39, 7, 'testing category', 'assignment', NULL, 0, 'Testing the category selection form', '2017-05-17', '2017-05-17 14:27:15', 'vlcsnap-2017-05-13-16h34m44s529.png', 'image/png', '2352967', NULL, NULL, NULL),
(40, 7, 'Yaaaayyyy', 'test', NULL, 0, 'it work, the category worked', '2017-05-17', '2017-05-17 14:28:10', 'vlcsnap-2017-05-13-16h35m46s496.png', 'image/png', '99293', NULL, NULL, NULL),
(41, 7, 'RTUU', 'Test', NULL, 0, 'SDFGHJ', '2017-05-17', '2017-05-17 14:39:50', 'vlcsnap-2017-05-13-16h35m04s309.png', 'image/png', '1182196', NULL, NULL, NULL),
(42, 7, 'RTUU', 'Test', NULL, 0, 'SDFGHJ', '2017-05-17', '2017-05-17 14:40:40', 'vlcsnap-2017-05-13-16h35m04s309.png', 'image/png', '1182196', NULL, NULL, NULL),
(43, 1, 'substring', 'Test', NULL, 0, 'jxcdjcsjc', '2017-05-17', '2017-05-17 14:58:20', 'view.css', 'text/css', '1189', NULL, NULL, NULL),
(44, 1, 'substring', 'Test', NULL, 0, 'jxcdjcsjc', '2017-05-17', '2017-05-17 14:59:39', 'view.css', 'text/css', '1189', NULL, NULL, NULL),
(45, 1, 'substring', 'Test', NULL, 0, 'jxcdjcsjc', '2017-05-17', '2017-05-17 15:00:02', 'view.css', 'text/css', '1189', NULL, NULL, NULL),
(46, 1, 'substring', 'Material', NULL, 0, 'jxcdjcsjc', '2017-05-17', '2017-05-17 15:00:20', 'font-awesome.min.css', 'text/css', '29063', NULL, NULL, NULL),
(47, 1, 'substring', 'Material', NULL, 0, 'jxcdjcsjc', '2017-05-17', '2017-05-17 15:03:43', 'font-awesome.min.css', 'text/css', '29063', NULL, NULL, NULL),
(48, 1, 'substring', 'Test', NULL, 0, 'jxcdjcsjc', '2017-05-17', '2017-05-17 15:09:30', 'Test_substring.css', 'text/css', '1189', NULL, NULL, NULL),
(49, 1, 'diddj', 'Assignment', NULL, 0, 'jddjdj', '2017-05-17', '2017-05-17 15:10:59', 'Assignment_diddj.pdf', 'application/pdf', '148726', NULL, NULL, NULL),
(50, 1, 'sckmlasdjks', 'Test', NULL, 0, 'ajxcjsd', '2017-05-17', '2017-05-17 15:16:08', 'Test_sckmlasdjks.pdf', 'application/pdf', '464492', NULL, NULL, NULL),
(51, 7, 'RTUU', 'Test', NULL, 0, 'SDFGHJ', '2017-05-17', '2017-05-17 15:41:16', 'Test_RTUU.png', 'image/png', '1182196', NULL, NULL, NULL),
(52, 6, 'topic', 'Note', NULL, 0, 'sdfghjuiuyfgi', '2017-05-17', '2017-05-17 23:52:59', 'Note_topic.pdf', 'application/pdf', '79869', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `hashedpassword` varchar(64) NOT NULL,
  `school` varchar(128) NOT NULL,
  `mobile` bigint(40) DEFAULT NULL,
  `area` varchar(16) DEFAULT NULL,
  `points` bigint(20) DEFAULT NULL,
  `course` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `hashedpassword`, `school`, `mobile`, `area`, `points`, `course`) VALUES
(1, 'Ogundiya Caleb', 'wrightkhlebisol@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'University of Lagos', 8037294929, 'Yaba', 12, 'Computer Science'),
(2, 'Lawal Abdulazeez', 'lawalharby@outlook.com', '423b4f85c763171a3490147febdc0f68551bc38b', 'University of Ibadan', 8030293087, 'Bodija', 32, 'Systems Engineering'),
(4, 'Wright khleb', 'w@y.c', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Uniosun', 8056786787, NULL, NULL, NULL),
(5, 'email guy', 'email@company.com', 'd015cc465bdb4e51987df7fb870472d3fb9a3505', 'company uni', 8045688972, NULL, NULL, NULL),
(6, 'new guy', 'newguy@newmail.com', '04b29c09cff78938736264c6d8a76c3aad2c0e90', 'newguysschool', NULL, NULL, NULL, NULL),
(7, 'Khleb Wright', 'ogundiyacaleb@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'University of Lagos', NULL, NULL, NULL, NULL),
(8, 'Geek', 'vip@erupt.online', 'b5fef1e5b8206fea448b8efa35957710ae1981f6', 'Universirty of Lagos', NULL, NULL, NULL, NULL),
(9, 'Geek', 'vip@erupt.online', 'b5fef1e5b8206fea448b8efa35957710ae1981f6', 'Universirty of Lagos', NULL, NULL, NULL, NULL),
(10, 'Adegunloye Adegoke A', 'jkvzju@kjbdfsj.com', 'f1b699cc9af3eeb98e5de244ca7802ae38e77bae', 'jjdjdjj', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
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
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
