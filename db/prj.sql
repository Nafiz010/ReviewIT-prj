-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 04:19 PM
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
-- Database: `prj`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `expiration_date` date NOT NULL,
  `franchise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `description`, `discount_amount`, `expiration_date`, `franchise_id`) VALUES
(1, '100 BDT OFF on all Items', 'Dummy data dump', 100, '2025-11-28', 2),
(2, 'Discount 50 BDT', 'Dummy data dump', 50, '2025-11-28', 1),
(3, 'Dummy dta', 'Dummy data dump', 50, '2025-11-28', 7),
(4, 'Just Example', 'Just Example', 50, '2026-11-25', 5),
(5, 'Lorem Ipson', 'Just for show', 40, '2025-11-19', 2),
(7, 'BR100', '100 BDT discount', 100, '2025-06-24', 12);

-- --------------------------------------------------------

--
-- Table structure for table `franchise`
--

CREATE TABLE `franchise` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL,
  `logo` varchar(400) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `franchise`
--

INSERT INTO `franchise` (`id`, `name`, `description`, `address`, `phone`, `availability`, `logo`, `user_id`) VALUES
(1, 'Kentucky Fried Chicken (KFC)', 'Chicken & Burgers', 'Dhanmondi 7a', '12342134324', 'Dhanmondi, Banani, Uttara', 'kfc.jpg', 3),
(2, 'Dominos Pizza', 'Pizza & Drinks', 'Dhanmondi', '123421314231321', 'Dhanmondi, Banani', 'Dominos Pizza.jpg', 4),
(5, 'Pizza Hut', 'Pizza and Gourmet Fast Food', 'Dhanmondi 12', '1234123234', 'Dhanmondi, Banani, Uttara, Gulshan', 'Pizza Hut.jpg', 5),
(7, 'Pizzaburg', 'Pizza & Burgers', 'Mirpur', '21432341234', 'Mirpur, Uttara', 'pizzaburg.png', 4),
(9, 'Mad Chef', 'Crazy chef de partie', 'Gulshan', '161688', 'Gulshan, Banani, Uttara', 'Mad Chef.jpg', 6),
(11, 'Starbucks', 'Coffee House & smoothies', 'Dhanmondi', '1242134213241', 'Dhanmondi, Banani, Gulshan', 'starbucks.jpg', 3),
(12, 'Baskin Robins', 'Ice-cream parlor', 'dagdddsg', '289348273', 'Gulshan, Dhanmondi', 'br.jpeg', 33);

-- --------------------------------------------------------

--
-- Table structure for table `franchise_review`
--

CREATE TABLE `franchise_review` (
  `id` int(11) NOT NULL,
  `rating_number` tinyint(4) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `franchise_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `franchise_review`
--

INSERT INTO `franchise_review` (`id`, `rating_number`, `comments`, `franchise_id`, `user_id`) VALUES
(1, 2, 'Uncooked Chicken Yuck', 1, 9),
(2, 4, 'Average not top tier', 1, 11),
(3, 5, 'Very friendly and clean environment', 2, 12),
(4, 3, 'Over priced and not worth the money', 2, 8),
(5, 4, 'Average Place to eat out.', 7, 28),
(6, 5, 'Amazing', 7, 11),
(7, 4, 'Now ', 5, 9),
(8, 3, 'Does it still work ', 2, 9),
(9, 1, 'Very Poor Wings\n', 1, 12),
(10, 1, 'Why no items', 9, 12),
(12, 3, 'Testing', 1, 29),
(13, 5, 'Amazing Coffee House. Love It !!!', 11, 9),
(14, 0, 'Fake Review', 2, 32),
(15, 5, 'Genuine review', 2, 32);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(400) DEFAULT NULL,
  `franchise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `franchise_id`) VALUES
(1, 'Chicken Bowl', '2 Pieces of wings with Veggies and Rice', 340, 'asd.jpeg', 1),
(3, 'Loaded Cheese', '12 inch cheddar cheese with pepperoni  ', 1750, 'LCP.jpeg', 2),
(5, 'Oreo Shake', 'Mashed oreo with icy cold milkshake', 520, 'th.jpeg', 7),
(6, 'Chicken Dominator', 'A chicken lovers delight with 4 different toppings', 929, 'CD.jpeg', 2),
(8, 'Special Family Pack', '10 piece chicken bucket with fries', 1850, 'sfaf.jpeg', 1),
(9, 'Frappuccino', 'Blended Iced Coffee', 440, 'sti.jpeg', 11),
(10, 'Chocolate Ice-cream', 'chocolate chips', 250, 'br1.jpeg', 12),
(11, 'Mint chocolate', 'Minted chocolate chip', 750, 'br2.jpeg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `item_review`
--

CREATE TABLE `item_review` (
  `id` int(11) NOT NULL,
  `rating_number` tinyint(4) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_review`
--

INSERT INTO `item_review` (`id`, `rating_number`, `comments`, `user_id`, `item_id`, `order_id`) VALUES
(1, 1, 'Very disgusting experience want refund please', 9, 1, 1),
(2, 5, 'Thanks for such an amazing meal.', 12, 6, 4),
(3, 4, 'The food was okay', 28, 5, 2),
(8, 5, 'Successful !!', 28, 5, 2),
(10, 5, 'Review Working and fetching check', 28, 5, 2),
(11, 1, 'Pocha', 12, 6, 132),
(13, 3, 'Moderate', 32, 3, 141),
(14, 1, '1 defected product', 32, 11, 142),
(15, 5, 'Excellent', 32, 10, 143);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `quantity`, `price`, `item_id`, `user_id`, `coupon_id`) VALUES
(1, 1, 340, 1, 9, 0),
(2, 1, 520, 5, 28, 0),
(4, 1, 929, 6, 12, 0),
(26, 1, 1650, 3, 12, 0),
(37, 1, 1800, 8, 12, 0),
(111, 2, 990, 5, 28, 0),
(121, 2, 3400, 3, 12, 0),
(124, 3, 5250, 3, 12, 0),
(125, 4, 6900, 3, 12, 0),
(126, 2, 630, 1, 12, 2),
(127, 2, 680, 1, 12, NULL),
(128, 2, 680, 1, 12, NULL),
(129, 2, 630, 1, 12, 2),
(130, 4, 3616, 6, 12, 1),
(131, 10, 9190, 6, 12, 1),
(132, 4, 3716, 6, 12, NULL),
(133, 2, 1040, 5, 12, NULL),
(134, 1, 520, 5, 12, NULL),
(135, 2, 1040, 5, 9, NULL),
(137, 2, 680, 1, 30, NULL),
(138, 1, 1750, 3, 9, NULL),
(139, 4, 2030, 5, 28, 3),
(141, 1, 1750, 3, 32, NULL),
(142, 2, 1500, 11, 32, NULL),
(143, 1, 150, 10, 32, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pending_review`
--

CREATE TABLE `pending_review` (
  `id` int(11) NOT NULL,
  `approval` enum('Pending','Approved','Declined','') NOT NULL,
  `franchise_review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_review`
--

INSERT INTO `pending_review` (`id`, `approval`, `franchise_review`) VALUES
(1, 'Approved', 1),
(2, 'Pending', 2),
(3, 'Pending', 6),
(4, 'Approved', 4),
(5, 'Approved', 3),
(6, 'Approved', 5),
(7, 'Approved', 7),
(8, 'Pending', 8),
(9, 'Approved', 9),
(10, 'Pending', 10),
(12, 'Approved', 12),
(13, 'Approved', 13),
(14, 'Pending', 14),
(15, 'Approved', 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `avatar` varchar(400) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `address`, `phone`, `avatar`, `user_role`) VALUES
(1, 'Admin', '202cb962ac59075b964b07152d234b70', 'admin@mail.com', 'East Avenue', '123456789', 'OIP.jpg', 1),
(2, 'Nafiz', '202cb962ac59075b964b07152d234b70', 'nafiz@mail.com', 'Fake Address', '143241234123156', 'Fiver DP.jpg', 1),
(3, 'Kentucky Fried Chicken (KFC) Owner', '900150983cd24fb0d6963f7d28e17f72', 'kfc@mail.com', 'Just for show', '911194944', 'kfc.jpg', 3),
(4, 'Dominos Pizza Owner', '900150983cd24fb0d6963f7d28e17f72', 'dpo@mail.com', 'For Example', '14324134', '', 3),
(5, 'Pizza Hut Owner', '900150983cd24fb0d6963f7d28e17f72', 'PHO@mail.com', 'Dhanmondi 12', '234134123421', '', 3),
(6, 'Mad Chef Owner', '900150983cd24fb0d6963f7d28e17f72', 'MCO@mail.com', 'Dummy address', '231423432', '', 3),
(7, 'Adam', '827ccb0eea8a706c4c34a16891f84e7b', 'adm@mail.com', 'Pass is one to five', '12345', 'user5.jpg', 2),
(8, 'Eric', '827ccb0eea8a706c4c34a16891f84e7b', 'eric@mail.com', 'Pass is 1 to 5', '12345', 'user3.jpg', 2),
(9, 'Sid', '827ccb0eea8a706c4c34a16891f84e7b', 'Sid@mail.com', 'Surprise', '234234134', 'user4.jpg', 2),
(10, 'Cristine', '827ccb0eea8a706c4c34a16891f84e7b', 'cristine@mail.com', 'All customer pass is 1 to 5', '12341234', 'user2.jpg', 2),
(11, 'Jill', '827ccb0eea8a706c4c34a16891f84e7b', 'jill@mail.com', 'some data', '12312312', 'user1.jpg', 2),
(12, 'Rahee', '202cb962ac59075b964b07152d234b70', 'das@sdf.sdf', 'fqwef', '1324213', '', 2),
(13, 'acas', '202cb962ac59075b964b07152d234b70', 'asd@s.j', 'wdcwd', '213421', '', 2),
(14, 'qypotapeta', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'jyzyl@mailinator.com', 'Similique pariatur ', '18594519501', '', 2),
(15, 'dinifadim', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'saralote@mailinator.com', 'Magnam dolore quasi ', '15852497567', '', 2),
(17, 'lohotimur', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'fywic@mailinator.com', 'Eveniet veniam et ', '1928', '', 2),
(19, 'nyzolyrob', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'guvuli@mailinator.com', 'Ad alias vero simili', '6194', '', 2),
(21, 'segakofor', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'xenolob@mailinator.com', 'Dolor et quibusdam d', '9129', '', 2),
(23, 'vyxopagob', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'micybenicy@mailinator.com', 'Eu sed amet in ipsa', '2225', '', 2),
(24, 'nybid', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'xejabome@mailinator.com', 'Voluptas qui et sunt', '2668', '', 2),
(26, 'pysoziwu', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'zakulep@mailinator.com', 'Aliquip cillum est ', '8973', '', 2),
(28, 'Durjoy', '827ccb0eea8a706c4c34a16891f84e7b', 'd@m.c', 'adafsdsdf', '12312', '', 2),
(29, 'Raisa', '202cb962ac59075b964b07152d234b70', 'r@m.c', 'fsdfsdf', '2341234', '', 2),
(30, 'Alvi', '827ccb0eea8a706c4c34a16891f84e7b', 'a@mai.com', 'asdnkDummy', '1324234', '', 2),
(31, 'avsadv', '202cb962ac59075b964b07152d234b70', 's@da.asd', 'asfdsa', '1232314', '', 2),
(32, 'Thomas', '202cb962ac59075b964b07152d234b70', 't@m.c', 'afd', '14341421', '', 2),
(33, 'shawn', '202cb962ac59075b964b07152d234b70', 'shawn@m.c', 'jksfbasjkb', '132412', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` int(11) NOT NULL,
  `date_used` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_coupons`
--

INSERT INTO `user_coupons` (`id`, `date_used`, `user_id`, `coupon_id`) VALUES
(1, NULL, 12, 2),
(3, NULL, 28, 3),
(6, NULL, 28, 5),
(9, NULL, 12, 1),
(10, NULL, 8, 5),
(11, NULL, 32, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Authorized Personal'),
(2, 'Customer', 'Users of the system'),
(3, 'Outlet Owner', 'Partnered Franchise');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `franch` (`franchise_id`);

--
-- Indexes for table `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `franchise_review`
--
ALTER TABLE `franchise_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `franchise_id` (`franchise_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `franchise` (`franchise_id`);

--
-- Indexes for table `item_review`
--
ALTER TABLE `item_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UsersId` (`user_id`),
  ADD KEY `items` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id` (`item_id`),
  ADD KEY `users` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `pending_review`
--
ALTER TABLE `pending_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `franchise_review` (`franchise_review`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_role` (`user_role`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `franchise`
--
ALTER TABLE `franchise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `franchise_review`
--
ALTER TABLE `franchise_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item_review`
--
ALTER TABLE `item_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `pending_review`
--
ALTER TABLE `pending_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `franch` FOREIGN KEY (`franchise_id`) REFERENCES `franchise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `franchise`
--
ALTER TABLE `franchise`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `franchise_review`
--
ALTER TABLE `franchise_review`
  ADD CONSTRAINT `franchise_id` FOREIGN KEY (`franchise_id`) REFERENCES `franchise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `franchise` FOREIGN KEY (`franchise_id`) REFERENCES `franchise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_review`
--
ALTER TABLE `item_review`
  ADD CONSTRAINT `UsersId` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `items_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pending_review`
--
ALTER TABLE `pending_review`
  ADD CONSTRAINT `franchise_review` FOREIGN KEY (`franchise_review`) REFERENCES `franchise_review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`user_role`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD CONSTRAINT `coupon_id` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
