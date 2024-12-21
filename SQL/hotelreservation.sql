-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 06:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelreservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `SenderName` varchar(255) NOT NULL,
  `MessageText` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `ReceiverID` int(11) NOT NULL,
  `IsRead` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `SenderName`, `MessageText`, `CreatedAt`, `ReceiverID`, `IsRead`) VALUES
(1, 'Mechaela Abecia', 'Halloooo. I try lang sa ni nako as a comment example.', '2024-12-11 16:35:44', 1, 0),
(2, 'John Doe', 'Don\'t forget our meeting tomorrow at 3 PM.', '2024-12-11 16:35:44', 1, 0),
(3, 'Jane Smith', 'Happy Birthday! 🎉', '2024-12-11 16:35:44', 1, 1),
(4, 'Alice Johnson', 'Can you review the document I sent earlier?', '2024-12-11 16:35:44', 1, 0),
(5, 'Bob Lee', 'The package has been shipped.', '2024-12-11 16:35:44', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`NotificationID`, `UserID`, `Title`, `Message`, `CreatedAt`, `IsRead`) VALUES
(1, 1, 'New Message', 'You have received a new message from John.', '2024-12-11 16:53:52', 1),
(2, 1, 'Promotion Alert', 'Congratulations! You have been selected for a special promotion.', '2024-12-11 16:53:52', 1),
(3, 1, 'Password Changed', 'Your password was successfully changed.', '2024-12-11 16:53:52', 1),
(4, 1, 'Order Shipped', 'Your order #123456 has been shipped.', '2024-12-11 16:53:52', 1),
(5, 1, 'Account Update', 'Your profile has been updated.', '2024-12-11 16:53:52', 1),
(6, 1, 'Event Reminder', 'Don\'t forget about the event tomorrow at 7 PM.', '2024-12-11 16:53:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Role` enum('Admin','User') NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `Phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `PasswordHash`, `Role`, `CreatedAt`, `Phone`) VALUES
(1, 'Nazef', 'nasefaquiatan@gmail.com', '$2y$10$b1xWhHrmftyxLf2W3LJC5.Ob.T0y5AIgRmNXOVKbcksv8w1M2i.fO', 'User', '2024-12-11 13:17:39', ''),
(2, 'nazef', 'naz@yahoo.com', '$2y$10$oTtdBNGG6wGElUfiysXEx.3zqvL.S/BZSlOKtH0HUe4Yf/yhuu5de', 'User', '2024-12-11 13:26:19', '123132131231231'),
(3, 'nazef', 'nasz@gmail.com', '$2y$10$lZw0EwIBx0xfDoCkHeeQ4unSUkmUX7e7xO9PxF5ZCijdsBPcl6hYe', 'User', '2024-12-11 13:26:29', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `fk_receiver_user` (`ReceiverID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_receiver_user` FOREIGN KEY (`ReceiverID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
