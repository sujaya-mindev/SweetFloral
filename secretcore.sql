-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 06:20 AM
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
('CAKESLCOM6', 'PASTEL TEAL RIBBON CAKE 750G (1.6LBS)', 'This pretty little pastel teal shade cake is a delicious ribbon cake, covered with fluffy buttercream and sprinkled with colored funfetties to make it extra special.', 'images\\cakes\\CAKESLCOM6.avif', 'cakes', 100, 4200),
('FLOWERLCOM21', 'PRETTIEST EVER', 'This beautiful flower bunch features lovely red lilies, a striking expression of nature\'s elegance. Their vibrant petals create an enchanting display of grace and charm. A heartfelt gift that exudes simplicity and timeless beauty, perfect for adding warmth and sophistication to any celebration.​​​​​​​', 'images\\flowers\\FLOWERLCOM21.avif', 'flowers', 100, 2900),
('FLOWERLCOM351', 'FLORIA', 'Elevate your Avurudu celebrations with our stunning flower bunche, symbolizing renewal and prosperity. Crafted with care, these vibrant bunch bring joy to any home, embodying the spirit of the New Year. Welcome abundance and happiness as you adorn your surroundings with our exquisite floral creations.\r\n', 'images\\flowers\\FLOWERLCOM351.avif', 'flowers', 100, 4850),
('FLOWERLCOM465', 'BLOOMING KNOWLEDGE', 'A beautiful assortment of fresh blooms, thoughtfully arranged to create an elegant and eye-catching bouquet. Perfect for celebrating special moments or brightening up any space, this floral bunch is designed to spread joy and bring a smile to the recipient’s face.', 'images\\flowers\\FLOWERLCOM465.avif', 'flowers', 100, 1800),
('FLOWERLCOM91', 'DREAMING ABOUT YOU', 'This stunning flower bunch boasts a medley of delightful pinkish hues, a captivating blend of soft, pink tones. It\'s like a gentle embrace from nature, a reminder of life\'s simple and exquisite joys. This bouquet whispers beauty and radiates love, making it the perfect gift to brighten anyone\'s day.', 'images\\flowers\\FLOWERLCOM91.avif', 'flowers', 100, 4200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
