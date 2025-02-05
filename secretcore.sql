-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 03:53 PM
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
-- Database: `secretcore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `phone`) VALUES
('admin123', 'admin', 'admin@test.com', '0711234567');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `email` varchar(200) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`email`, `first_name`, `last_name`, `phone_no`, `address`, `birthday`) VALUES
('customer@gmail.com', 'Emily', 'Perera', '0719876543', '34, 2nd Lane, Dehiwala, Sri Lanka', '2000-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` varchar(30) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`, `product_description`, `product_image`, `product_category`, `product_stock`, `product_price`) VALUES
('CAKESLCOM4', 'FLOWERY GARDEN RIBBON CAKE 1KG (2.2LBS)', 'Artfully decorated ribbon cake suitable for any occasion made with our signature ribbon cake recipe, this cake is a truly delightful gift to any recipient.\r\n', 'images\\cakes\\CAKESLCOM4.avif', 'cakes', 100, 5250),
('CAKESLCOM515', 'FOREVER YOURS RIBBON CAKE', 'Celebrate love and sophistication with our white \"FOREVER YOURS\", a stunning creation featuring a delicate ribbon cake.The cake is adorned with two stunning hearts , meticulously decorated with subtle gold touches that exude luxury and refinement and hand design topper adds a unique and modern artistic flair.', 'images\\cakes\\CAKESLCOM515.avif', 'cakes', 50, 6800),
('CAKESLCOM6', 'PASTEL TEAL RIBBON CAKE 750G (1.6LBS)', 'This pretty little pastel teal shade cake is a delicious ribbon cake, covered with fluffy buttercream and sprinkled with colored funfetties to make it extra special.', 'images\\cakes\\CAKESLCOM6.avif', 'cakes', 100, 4200),
('CAKESLCOM82', 'FUNFETTI RIBBON CAKE 1KG', 'Looks simple but incredibly delicious cake to gift your loved ones any day, made with our signature ribbon cake sandwiched with vanilla buttercream, for extra color and fun topped with edible colored sprinkles.', 'images\\cakes\\CAKESLCOM82.avif', 'cakes', 50, 4450),
('FLOWERLCOM21', 'PRETTIEST EVER', 'This beautiful flower bunch features lovely red lilies, a striking expression of nature\'s elegance. Their vibrant petals create an enchanting display of grace and charm. A heartfelt gift that exudes simplicity and timeless beauty, perfect for adding warmth and sophistication to any celebration.​​​​​​​', 'images\\flowers\\FLOWERLCOM21.avif', 'flowers', 100, 2900),
('FLOWERLCOM351', 'FLORIA', 'Elevate your Avurudu celebrations with our stunning flower bunche, symbolizing renewal and prosperity. Crafted with care, these vibrant bunch bring joy to any home, embodying the spirit of the New Year. Welcome abundance and happiness as you adorn your surroundings with our exquisite floral creations.\r\n', 'images\\flowers\\FLOWERLCOM351.avif', 'flowers', 100, 4850),
('FLOWERLCOM465', 'BLOOMING KNOWLEDGE', 'A beautiful assortment of fresh blooms, thoughtfully arranged to create an elegant and eye-catching bouquet. Perfect for celebrating special moments or brightening up any space, this floral bunch is designed to spread joy and bring a smile to the recipient’s face.', 'images\\flowers\\FLOWERLCOM465.avif', 'flowers', 100, 1800),
('FLOWERLCOM91', 'DREAMING ABOUT YOU', 'This stunning flower bunch boasts a medley of delightful pinkish hues, a captivating blend of soft, pink tones. It\'s like a gentle embrace from nature, a reminder of life\'s simple and exquisite joys. This bouquet whispers beauty and radiates love, making it the perfect gift to brighten anyone\'s day.', 'images\\flowers\\FLOWERLCOM91.avif', 'flowers', 100, 4200);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `userType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `userType`) VALUES
('admin123', '$2y$10$EqLz/Ric48NIJBZlTcHz9u3J2YVj6aQVLPih8ANUeCUTxcl3gRNWi', 'admin'),
('customer@gmail.com', '$2y$10$i58l5iCtKXMOBZnkIt3IZOoi1EsOcZKlHeiuXBU6tqVxxIN0jBLKS', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
