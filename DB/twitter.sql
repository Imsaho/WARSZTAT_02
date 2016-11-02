-- phpMyAdmin SQL Dump
-- version 4.6.4deb1+deb.cihar.com~xenial.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 02, 2016 at 08:06 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tweet_id` int(11) DEFAULT NULL,
  `text` tinytext NOT NULL,
  `creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `user_id`, `tweet_id`, `text`, `creation_date`) VALUES
(1, 22, 12, 'nowy komentarz od użytkownika nr 22 dla tweeta użytkownika Tomasz', '2016-10-31 00:00:00'),
(2, 10, NULL, 'pierwszy komentarz', '2016-11-02 14:14:36'),
(3, 10, 7, 'pierwszy komentarz', '2016-11-02 14:19:08'),
(4, 10, 7, 'fgdfgshsgh', '2016-11-02 14:19:18'),
(5, 10, 10, 'nowy komentarz', '2016-11-02 14:20:18'),
(6, 10, 10, 'jeszcze jeden komentarz', '2016-11-02 14:20:34'),
(7, 10, 11, 'jakiś komentarz', '2016-11-02 14:21:44'),
(8, 10, 8, 'kolejny komentarz', '2016-11-02 14:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`id`, `sender_id`, `receiver_id`, `text`, `creation_date`, `is_read`) VALUES
(1, 10, 22, 'Nowa wiadomość', '2016-10-15 16:32:30', 1),
(2, 10, 9, 'nowa wiadomość dla użytkownika Andrzej', '2016-11-02 16:49:17', NULL),
(3, 10, 1, 'całkiem nowa nowituka wiadomość !', '2016-11-02 16:55:17', NULL),
(4, 22, 10, 'Cześć, Tomasz! jak sie masz?', '2016-11-02 16:56:57', NULL),
(5, 22, 10, 'jeszcze jedna wiadomość dla użytkownika Tomasz od użytkownika Agnieszka', '2016-11-02 16:57:30', NULL),
(6, 10, 9, 'cześć siema!', '2016-11-02 19:01:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Tweets`
--

CREATE TABLE `Tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Tweets`
--

INSERT INTO `Tweets` (`id`, `user_id`, `text`, `creation_date`) VALUES
(1, 6, 'nowy tweet dla użytkownika nr 6', '2016-10-31 00:00:00'),
(2, 6, 'Drugi tweet dla użytkownika nr 6', '2016-10-31 01:00:00'),
(3, 6, 'Tweet nr 3 dla użytkownika nr 6', '2016-11-01 07:00:00'),
(4, 1, 'nowy tweet dla użytkownika nr 1', '2016-05-30 12:00:00'),
(5, 9, 'pierwszy tweet dla użytkownika nr 9', '2016-05-19 12:00:00'),
(6, 9, 'Kolejny tweet dla użytkownika nr 9', '2016-11-01 15:05:46'),
(7, 9, 'Kolejny tweet dla użytkownika nr 9', '2016-11-01 15:06:55'),
(8, 9, 'Kolejny tweet dla użytkownika nr 9', '2016-11-01 15:07:09'),
(9, 9, 'Kolejny tweet dla użytkownika nr 9', '2016-11-01 15:07:33'),
(10, 9, 'Kolejny tweet dla użytkownika nr 9', '2016-11-01 15:07:44'),
(11, 10, 'fdsffds', '2016-11-02 10:54:15'),
(12, 10, 'tweet dla użytkownika tomasz@gmail.com', '2016-11-02 10:54:52'),
(13, 22, 'mój pierwszy tweet', '2016-11-02 12:02:40'),
(14, 22, 'mój pierwszy tweet', '2016-11-02 12:02:58'),
(15, 10, 'kolejny tweet', '2016-11-02 12:10:56'),
(16, 10, 'nowy tweet', '2016-11-02 14:30:30'),
(17, 22, 'kolejny Tweet użytkownika Agnieszka', '2016-11-02 16:56:23'),
(18, 10, 'nowy tweet użytkownika tomaszzzzzzzzzzzzzzsddgdbgnrbmlkelk rknkjrn lkmn;km;klmlkmlkm l kmkmml;mlm njnouhouhijbkjb kjbkjnkjnjknknlknklknlknlk', '2016-11-02 18:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `hashed_password`, `email`) VALUES
(1, '$this->username', '$this->hashedPassword', 'adam.nowy@gmail.com'),
(6, 'Paweł', '$2y$10$y4JmNQ2dh/rygR/kYnmLROT8oCZXigt5H3JALc.i9fyQkdntcMgI.', 'pawel@gmail.com'),
(9, 'Andrzej', '$2y$10$4gaHmBK70dIitslrzgIYL.hsBNYavsbDnwKtNTjA6lx8yAMYPXc9e', 'andrzej@gmail.com'),
(10, 'Tomasz', '$2y$10$wR.V5eEJYp1Cpcm2NcejT..1Eu5uNPELEn4jUBfDolD3ftqvzqNra', 'tomasz@gmail.com'),
(11, 'nowyUser', '$2y$10$pkQN8oIB1mJTe9VmiSejtO/aLrT/7dIyzT.UMH1o81vl6E.hxmz8i', 'nowyuser@gmail.com'),
(14, 'jakies', '$2y$10$1WRrsX.wcYEKLpw2UbYxqOE6H.fniejvGXxP.O7jvaXJHXOo79Sv2', 'jakies'),
(15, 'ignacy', '$2y$10$QRgdw9LgnmgKnZgaAe38huVg10wxp2Shwx0e1mEV5iRHDp1.Vn11q', 'ignacy@gmail.com'),
(19, 'karolina', '$2y$10$yG.z/vpKDYLNGLpFeh.JA.7wWF9qmpNaMz6aPvziQ1W3cJRadBX/S', 'karolina@gmail.com'),
(20, 'patrycja', '$2y$10$4e.gjXdUYMcOBU9BIliXv.V46XtIQI1NKU05Zs0/PgmZi5unpvP46', 'patrycja@wp.pl'),
(21, 'magdalena', '$2y$10$wVRAeV/ODMcmWQTLYGXCZOCql65iex9lkoSs01xTc8AT3cQoZ5WxK', 'magda@gmail.com'),
(22, 'agnieszka', '$2y$10$w6331BRzOkH2kY9kW2EJUuy0kObe8IA3I36nRdbpeL8mOuypeKukO', 'aga@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tweet_id` (`tweet_id`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Tweets`
--
ALTER TABLE `Tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `Tweets` (`id`);

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
