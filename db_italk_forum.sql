-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 10:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_italk_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(23) NOT NULL,
  `category_description` text NOT NULL,
  `category_date` datetime NOT NULL DEFAULT current_timestamp(),
  `category_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `category_date`, `category_img`) VALUES
(1, 'Python', 'Python is an interpreted, high-level and general-purpose programming language.', '2021-03-05 22:51:02', 'assets/images/cat-python.jpg'),
(2, 'Javascript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level language.', '2021-03-05 22:51:02', 'assets/images/cat-js.jpg'),
(3, 'PHP', ' PHP is a server scripting language that is especially suited to web development. It is a powerful tool for making dynamic and interactive Web pages.', '2021-04-10 09:52:59', 'assets/images/cat-php.jpg'),
(4, 'HTML', 'The HyperText Markup Language, or HTML is the standard markup language for documents designed to be displayed in a web browser.', '2021-04-10 09:59:34', 'assets/images/cat-html.jpg'),
(5, 'React.js', 'React is an open-source, front-end, JavaScript library for building user interfaces or UI components.', '2021-04-10 09:59:34', 'assets/images/cat-reactjs.jpg'),
(6, 'Bootstrap', 'Bootstrap is a free and open-source CSS framework directed at responsive, mobile-first front-end web development.', '2021-04-10 10:00:59', 'assets/images/cat-bootstrap.png'),
(7, 'CSS', 'Cascading Style Sheets is a style sheet language used for describing the presentation of a document written in a markup language such as HTML.', '2021-04-10 10:00:59', 'assets/images/cat-css.jpg'),
(8, 'jQuery', 'jQuery is a free and open-source JavaScript library designed to simplify HTML DOM tree traversal and manipulation, as well as event handling, CSS animation, and Ajax. ', '2021-04-10 10:02:14', 'assets/images/cat-jquery.jpg'),
(9, 'MySQL', 'MySQL is an open-source relational database management system. Its name is a combination of \"My\", the name of co-founder Michael Widenius\'s daughter, and \"SQL\", the abbreviation for Structured Query Language.', '2021-04-10 10:03:27', 'assets/images/cat-mysql.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_by` varchar(30) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(13, 'Try reconnect again', 9, '4', '2021-03-10 10:39:34'),
(20, 'Hello, Simple copy the whole code from the bootstrap website and go further by pushing your content within.', 2, '2', '2021-03-13 12:44:23'),
(21, 'Add an Api to your html file and then start with , &lt;div class=\"jumbotron\"&gt;&lt;/div&gt;\r\nand add your content into it', 2, '1', '2021-04-28 12:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(7) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(7) NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'I am unable to install PyAudio in Windows', 'Does anyone have the solution to install PyAudio in windows. ', 1, 1, '2021-03-06 01:12:58'),
(2, 'How to create Jumbotron in bootstrap 5 with python ', 'Please help me', 1, 2, '2021-03-06 01:23:13'),
(3, 'How it is possible to update a record by a where condition by PONYORM?', 'I want to update a record by a where condition by PonyOrm in Python 3.8. Based on PonyOrm official documentation It is possible by such following code.\r\n\r\n', 1, 3, '2021-03-06 01:26:45'),
(4, 'Max recursion depth regex python ', 'So I\'m using the re module and I have the regex -> r\"^\\[(\\d+)\\]\\[(.*\\,)*(.*)\\]$\" to match things such as [4][5, 5, 5].', 1, 4, '2021-03-06 01:26:45'),
(9, 'Problem in fetch api', 'I am in trouble. Facing problem in fetching Api in Javascript ', 2, 5, '2021-03-08 02:30:58'),
(11, 'How to read row by row  in text file using javascript', 'I wanna read this fill and get information. :61:read this row and under the :61: row have to read get row information. \r\n1:F01NDBSLKLXAXXX3887000001}{2:I940NDBSLKLXXXXXN}{3:{108:1936414827.04}}{4: :20:20210104-14 :25:101000167232 :28C:14/1 :60F:C210103LKR183711227,75 :61:2101040104CR16900,00NMSC918190937V//FT21004YM16B\r\nCEFTS Inward Transfer', 2, 3, '2021-03-15 12:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `users_23`
--

CREATE TABLE `users_23` (
  `user_id` int(7) NOT NULL,
  `username` varchar(23) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_description` text NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_23`
--

INSERT INTO `users_23` (`user_id`, `username`, `email`, `password`, `user_description`, `user_img`, `timestamp`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$TiFDZWQEB/zwP0PCEFz/yeFEGaUBQCFZdvO5eon3xlEgKVKS.aR4C', 'Admin account', 'assets/images/user.png', '2021-04-12 12:42:43'),
(2, 'user1', 'user1@gmail.com', '$2y$10$n6.8.xj2kZs6.iQ76TCLo.8woRHMRjwRtx7r2gXfHJ4pZm6yxoem.', '', '', '2021-04-12 12:43:26'),
(3, 'coder', 'coder@gmail.com', '$2y$10$.PSF..Ms96VhPiBv8DJ6u.470tXBMM2yE2Bk/bvA.bzsdpuJhyNqy', '', '', '2021-04-12 12:43:52'),
(4, 'learner', 'learner@gmail.com', '$2y$10$Mnyx/qndjVur8K34ZVrH.O2XcYqd22yBXq5JWjq5oRJPTBNgdFFoy', '', '', '2021-04-12 12:44:14'),
(5, 'programmer', 'programmer@gmail.com', '$2y$10$c7ZAt6/GdFwN1VtfdcmL/.biGfePCujlRBLF6wnx1G4ED/xDqBAze', 'I am a passionate programmer. want to learn more and more', '', '2021-04-12 12:44:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users_23`
--
ALTER TABLE `users_23`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_23`
--
ALTER TABLE `users_23`
  MODIFY `user_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
