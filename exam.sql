-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 02:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminUser` varchar(50) NOT NULL,
  `adminPass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminUser`, `adminPass`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ans`
--

CREATE TABLE `tbl_ans` (
  `id` int(11) NOT NULL,
  `examID` int(11) NOT NULL,
  `quesNo` int(11) NOT NULL,
  `rightAns` int(11) NOT NULL DEFAULT 0,
  `ans` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ans`
--

INSERT INTO `tbl_ans` (`id`, `examID`, `quesNo`, `rightAns`, `ans`) VALUES
(1, 1, 1, 1, 'Member functions which can only be used within the class'),
(2, 1, 1, 0, 'Member functions which can used outside the class'),
(3, 1, 1, 0, 'Member functions which are accessible in derived class'),
(4, 1, 1, 0, 'Member functions which can’t be accessed inside the class'),
(9, 1, 2, 0, 'The private members can’t be accessed by public members of the class'),
(10, 1, 2, 1, 'The private members can be accessed by public members of the class'),
(11, 1, 2, 0, ' The private members can be accessed only by the private members of the class'),
(12, 1, 2, 0, 'The private members can’t be accessed by the protected members of the class'),
(13, 1, 3, 1, 'Private member function'),
(14, 1, 3, 0, 'Public member function'),
(15, 1, 3, 0, 'Protected member function'),
(16, 1, 3, 0, 'All can be accessed'),
(17, 1, 4, 0, 'private: functionName(parameters)'),
(18, 1, 4, 0, 'private(functionName(parameters))'),
(19, 1, 4, 1, 'private functionName(parameters)'),
(20, 1, 4, 0, 'private functionName(parameters)'),
(21, 1, 5, 1, 'private: &lt; all private members &gt;'),
(22, 1, 5, 0, 'private &lt; member name &gt;'),
(23, 1, 5, 0, 'private(private member list)'),
(24, 1, 5, 0, 'private :- &lt; private members &gt;'),
(25, 1, 6, 0, 'Keyword private preceding list of private member’s'),
(26, 1, 6, 0, ' Keyword private with a colon before list of private member’s'),
(27, 1, 6, 0, 'Keyword private with arrow before each private member'),
(28, 1, 6, 1, 'Keyword private preceding each private member'),
(29, 1, 7, 0, ' Only 1'),
(30, 1, 7, 0, 'Only 7'),
(31, 1, 7, 0, 'Only 255'),
(32, 1, 7, 1, 'As many as required'),
(33, 1, 8, 0, 'Using object of class'),
(34, 1, 8, 0, 'Using object pointer'),
(35, 1, 8, 1, 'Using address of member function'),
(36, 1, 8, 0, 'Using class address'),
(37, 1, 9, 1, 'Can’t be called from enclosing class'),
(38, 1, 9, 0, 'Can be accessed from enclosing class'),
(39, 1, 9, 0, 'Can be accessed only if nested class is private'),
(40, 1, 9, 0, 'Can be accessed only if nested class is public'),
(41, 1, 10, 1, 'Call a public member function which calls private function'),
(42, 1, 10, 0, 'Call a private member function which calls private function'),
(43, 1, 10, 0, 'Call a protected member function which calls private function'),
(44, 1, 10, 0, 'Not possible');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comp_exam`
--

CREATE TABLE `tbl_comp_exam` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `examID` int(11) NOT NULL,
  `noQuesDone` int(11) NOT NULL,
  `givenAns` int(11) NOT NULL,
  `isMailed` int(1) NOT NULL DEFAULT 0,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comp_exam`
--

INSERT INTO `tbl_comp_exam` (`id`, `userID`, `examID`, `noQuesDone`, `givenAns`, `isMailed`, `dateAdded`) VALUES
(1, 1, 1, 10, 0, 0, '2021-05-16'),
(2, 5, 1, 10, 4, 0, '2021-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `id` int(11) NOT NULL,
  `examType` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `examName` varchar(100) NOT NULL,
  `moOfQue` int(11) NOT NULL,
  `examTime` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`id`, `examType`, `department`, `examName`, `moOfQue`, `examTime`, `status`, `dateAdded`) VALUES
(1, 'Unit Test I', 'IT', 'OPP', 10, '15', 1, '2021-03-11'),
(2, 'Unit Test I', 'Computer', 'Java MCQ', 10, '15', 0, '2021-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ques`
--

CREATE TABLE `tbl_ques` (
  `id` int(11) NOT NULL,
  `examID` int(11) DEFAULT NULL,
  `quesNo` int(11) NOT NULL,
  `ques` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ques`
--

INSERT INTO `tbl_ques` (`id`, `examID`, `quesNo`, `ques`) VALUES
(1, 1, 1, 'Which is private member functions access scope?'),
(5, 1, 2, 'Which among the following is true ?'),
(6, 1, 3, 'Which member can never be accessed by inherited classes?'),
(7, 1, 4, 'Which syntax among the following shows that a member is private in a class?'),
(8, 1, 5, ' If private member functions are to be declared in C++ then _____________'),
(9, 1, 6, ' In java, which rule must be followed?'),
(10, 1, 7, 'How many private member functions are allowed in a class?'),
(11, 1, 8, 'How to access a private member function of a class?'),
(12, 1, 9, 'Private member functions ____________'),
(13, 1, 10, 'If private members are to be called outside the class, which is a good alternative?');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `branch` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `name`, `branch`, `username`, `password`, `email`, `status`) VALUES
(1, 'ravi seth', 'IT', 'raviR', '123456', 'ravi@mail.com', 0),
(2, 'Rakesh ', 'Computer', 'Rajesh', '123456', 'rakesh@mail.com', 0),
(5, 'Rahul', 'IT', '5151', '123456', 'rahul@mail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_ans`
--
ALTER TABLE `tbl_ans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comp_exam`
--
ALTER TABLE `tbl_comp_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ques`
--
ALTER TABLE `tbl_ques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_ans`
--
ALTER TABLE `tbl_ans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_comp_exam`
--
ALTER TABLE `tbl_comp_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ques`
--
ALTER TABLE `tbl_ques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
