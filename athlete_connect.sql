-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 10:09 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `athlete_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login_id` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `agency_name` varchar(100) DEFAULT NULL,
  `agency_address` varchar(200) DEFAULT NULL,
  `athlete_benefits` varchar(500) NOT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_id`, `first_name`, `last_name`, `email`, `login_id`, `password`, `city`, `country`, `agency_name`, `agency_address`, `athlete_benefits`, `profile_picture`, `created_at`) VALUES
(6, 'Hammad', 'Ahmad', 'hamad@gmail.com', 'hammad', '$2y$10$N5CRe9fPPIQa0rLuXJsQp.54Cmkd.7tj/Qey5zsVV7X0S4azMfJL.', 'Thana', 'Pakistan', 'Thana Sports', 'Thana Malakand', 'I can bring more benefits to the athlete', '1682933232_avatar5.png', '2023-05-01 09:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `athletes`
--

CREATE TABLE `athletes` (
  `athlete_id` int(11) NOT NULL,
  `login_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `primary_sport` varchar(50) NOT NULL,
  `secondary_sports` varchar(200) DEFAULT NULL,
  `awards` varchar(500) DEFAULT NULL,
  `education_level` varchar(100) NOT NULL,
  `athletic_achievements` varchar(500) DEFAULT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `sport_pictures` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `athletes`
--

INSERT INTO `athletes` (`athlete_id`, `login_id`, `email`, `password`, `first_name`, `last_name`, `date_of_birth`, `gender`, `nationality`, `address`, `city`, `country`, `height`, `weight`, `primary_sport`, `secondary_sports`, `awards`, `education_level`, `athletic_achievements`, `profile_picture`, `sport_pictures`, `created_at`) VALUES
(6, 'salmanlogin', 'salman@gmail.com', '$2y$10$S6Ro/Z4BVLCQXaMFmk5Pz.Tm8DBkQuyv.iI6MFsbEL.fMYoCOdtmi', 'Salman', 'Khan', '2016-05-01', 'Male', 'Pakistani', 'Village Jano,Serai Tehsil and P/O Khwaza Khela District Swat', 'Khwaza Khela', 'Pakistan', 60.2, 60, 'Foot Ball', 'crickte, volley ball', 'No Awards', 'Bachelor', 'Winning World Cup 2023', '1682933097_avatar.png', 'photo-1647242393155-1c1fa593ba1f.jpg|next|photo-1653031040957-24e43c440add.jpg|next|photo-1663419122687-5004be891ce1.jpg|next|', '2023-05-01 09:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `terms` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `agent_id`, `athlete_id`, `duration`, `amount`, `terms`, `status`, `created_at`) VALUES
(2, 6, 6, '6', '1200 USD', 'These are my terms and policies', 1, '2023-05-01 09:28:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `athletes`
--
ALTER TABLE `athletes`
  ADD PRIMARY KEY (`athlete_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `athletes`
--
ALTER TABLE `athletes`
  MODIFY `athlete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
