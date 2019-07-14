-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2019 at 09:58 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oop-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Phone', 'phone'),
(2, 'Laptop', 'laptop'),
(3, 'Home Decor', 'home-decor'),
(4, 'Fitness Assc', 'fitness-assc'),
(5, 'Men Cloths', 'men-cloths'),
(6, 'Misc', 'misc');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `time_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_name`, `user_email`, `user_ip`, `comment`, `post_id`, `status`, `time_date`) VALUES
(1, 'sadan', 'sadan@mail.com', '127.0.0.1', 'this is first comment', 1, 'unapproved', '2019-07-09');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'deep@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Samsung On5 Specification', 'samsung-on5-specification', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'publish', 1, '2019-07-07', '2019-07-07'),
(2, 'Wall Paper', 'wall-paper', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'publish', 3, '0000-00-00', '0000-00-00'),
(3, 'Samsung Laptop specification', 'samsung-laptop-specification', 'Lorem Ipsume content dummy pupose', 'publish', 2, '2019-07-09', '2019-07-09'),
(4, 'What is Lorem Ipsum?', 'what-is-lorem-ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'publish', 6, '2019-07-09', '2019-07-09'),
(5, 'Where does Lorem Ipsum come from?', 'where-does-lorem-ipsum-come-from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'publish', 6, '2019-07-09', '2019-07-09'),
(6, 'Where can I get some?', 'where-can-i-get-some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'publish', 6, '2019-07-12', '2019-07-12'),
(7, 'Why do we use it?', 'why-do-we-use-it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'publish', 6, '2019-07-12', '2019-07-12'),
(8, 'Who Translate Lorem Ipsum', 'who-translate-lorem-ipsum', '1914 translation by H. Rackham\r\n\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"', 'publish', 6, '2019-07-12', '2019-07-12'),
(9, 'This is test post no 9', 'this-is-test-post-no-9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'publish', 2, '2019-07-12', '2019-07-12'),
(10, 'Lorem Ipsum Demo', 'lorem-ipsum-demo', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum sem ex, vitae posuere est eleifend finibus. Ut et massa sit amet nunc auctor sodales. Sed imperdiet metus non lacus lobortis, vitae mattis lacus commodo. Nullam vitae imperdiet mi. Aliquam consectetur, erat varius commodo finibus, enim massa bibendum ante, vel mattis sapien risus vitae erat. Maecenas facilisis, neque non bibendum interdum, risus neque aliquet erat, nec accumsan sapien massa ut orci. In hac habitasse platea dictumst. Sed et velit ut purus imperdiet rutrum vel ut quam. Donec semper dapibus felis. Praesent aliquet, est vitae commodo pellentesque, lorem nulla posuere neque, nec viverra sem ipsum vel neque. Vivamus lacinia auctor eros quis aliquet. Vestibulum vel sapien urna. ', 'publish', 1, '2019-07-12', '2019-07-12'),
(11, 'This is post no 10', 'this-is-post-no-10', 'MySQL provides a LIMIT clause that is used to specify the number of records to return.\r\n\r\nThe LIMIT clause makes it easy to code multi page results or pagination with SQL, and is very useful on large tables. Returning a large number of records can impact on performance.\r\n\r\nAssume we wish to select all records from 1 - 30 (inclusive) from a table called \"Orders\". The SQL query would then look like this:\r\n$sql = \"SELECT * FROM Orders LIMIT 30\"; ', 'publish', 4, '2019-07-12', '2019-07-12'),
(12, 'PHP 7 Limit Data Selections From MySQL', 'php-7-limit-data-selections-from-mysql', ' $sql = \"SELECT * FROM Orders LIMIT 30\";\r\n\r\nWhen the SQL query above is run, it will return the first 30 records.\r\n\r\nWhat if we want to select records 16 - 25 (inclusive)?\r\n\r\nMysql also provides a way to handle this: by using OFFSET.\r\n\r\nThe SQL query below says \"return only 10 records, start on record 16 (OFFSET 15)\":\r\n$sql = \"SELECT * FROM Orders LIMIT 10 OFFSET 15\";\r\n\r\nYou could also use a shorter syntax to achieve the same result:\r\n$sql = \"SELECT * FROM Orders LIMIT 15, 10\";\r\n\r\nNotice that the numbers are reversed when you use a comma.', 'publish', 6, '2019-07-12', '2019-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_subtitle` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `footer_copyright` longtext NOT NULL,
  `header_code` varchar(400) NOT NULL,
  `footer_code` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_subtitle`, `site_logo`, `footer_copyright`, `header_code`, `footer_code`) VALUES
(1, 'Exam Hindi', 'MCQ Hindi', 'assets/site-logo/smily.png', 'Copyright 2019 All rights reserved | Exam Hindi', '&lt;link rel=&quot;stylesheet&quot; href=&quot;https://cdnjs.cloudflare.com/ajax/libs/foundation-emails/2.2.1/foundation-emails.min.css&quot; integrity=&quot;sha256-eCv+ZgspLOV4CCn3RbJ0zvEyFi3BYlGManp0JAJGXlQ=&quot; crossorigin=&quot;anonymous&quot; /&gt;', '&lt;script src=&quot;https://cdnjs.cloudflare.com/ajax/libs/vuejs-paginate/2.1.0/index.js&quot; integrity=&quot;sha256-IWdCh9Pr6cR1KPqOPUu06+BZYQFSi7smSgWYPo87IAQ=&quot; crossorigin=&quot;anonymous&quot;&gt;&lt;/script&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`) VALUES
(1, 'nokia 3370 batttry power', 'nokia-3370-batttry-power'),
(2, 'nokia mobile price', 'nokia-mobile-price'),
(3, 'MI New Phone launched on 17 July', 'mi-new-phone-launched-on-17-july');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'https://nulm.gov.in/images/user.png',
  `login` int(11) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `photo`, `login`, `role`, `slug`, `created_at`) VALUES
(1, 'Sadan Verma Harikot', 'sadan', 'sadan@mail.com', '987654321', 'assets/avatar/Tallest-Statues-in-the-World.jpg', 0, 'admin', 'sadan-verma', '0000-00-00'),
(2, 'Deep Khicher', 'deep', 'deep@mail.com', '123456', 'https://nulm.gov.in/images/user.png', 0, 'admin', 'deep-khihcer', '0000-00-00'),
(3, 'Madan Harikoit', 'Madan verm', 'vrpanghalofficial@gmail.com', '123456789', 'assets/avatar/Tallest-Statues-in-the-World.jpg', 0, 'author', 'madan-harikoit', '2019-07-06'),
(5, 'Sandeep Hisar', 'sandeep', 'hisar@mail.com', '123456789', 'assets/avatar/Tallest-Statues-in-the-World.jpg', 0, 'editor', 'sandeep-hisar', '2019-07-06'),
(6, 'Sadan Verma', 'sadanverma', 'verma@sadan.com', '123456', 'assets/avatar/more power capsule ke fayde nuksaan.jpg', 0, 'editor', 'sadan-verma', '2019-07-06'),
(7, 'Rahul Haryana', 'rahul', 'rahul@indian.com', '123456', 'assets/avatar/new photo.jpg', 0, 'editor', 'rahul-haryana', '2019-07-06'),
(8, 'Sonam', 'Sonam', 'sonam@email.com', '123456789', 'assets/avatar/WhatsApp Image 2019-06-06 at 2.16.48 PM.jpeg', 0, 'editor', 'sonam', '2019-07-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
