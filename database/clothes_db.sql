-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 01:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(3, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `discount_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `discount_amount`) VALUES
(1, 'SALE20', 20);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `season` varchar(50) NOT NULL,
  `product_detail` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `sale_percentage` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `category`, `gender`, `season`, `product_detail`, `price`, `sale_percentage`, `image`) VALUES
(13, 'Printed Cotton Jersey Regular Fit Men&#39;s T-Shirt', 'Modern Thread', 'T-Shirt', 'Men', 'Summer', 'The Gildan Ultra Cotton T-shirt is made from a substantial 6.0oz pre sq.yd.fabric constructed from 100% cotton. This classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package', 279, 35, 's-6013-triptee-original-imaghgvtvgrqgn5j.jpg'),
(14, 'Men Solid Polo Neck Cotton Blend (220 gsm) Green T-Shirt', 'Modern Thread', 'T-Shirt', 'Men', 'Summer', 'The Gildan Ultra Cotton T-shirt is made from a substantial 6.0oz pre sq.yd.fabric constructed from 100% cotton. This classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package.', 249, 22, 'm-db1024-15-3bros-original-imagz8zjfxthf7kn.jpg'),
(15, 'Men Checkered Hooded Neck Cotton Blend White T-Shirt', 'Modern Thread', 'T-Shirt', 'Men', 'Summer', 'The Gildan Ultra Cotton T-shirt is made from a substantial 6.0oz pre sq.yd.fabric constructed from 100% cotton. This classic fit preshrunk jersey knit provides unmatched comfort with each wear. Featuring a taped neck and shoulder, and a seamless double-needle collar, and available in a range of colors, it offers it all in the ultimate head-turning package', 100, 10, 'l-jc22-hd-fs-black-jmc-pckt-jump-cuts-original-imagg3yxfk48y7nt.jpg'),
(16, 'Hanes Men&#39;s Ecosmart Fleece Sweatshirt, Cotton-blend Pullover, Crewneck Sweatshirt for Men', 'Modern Thread', 'Sweatshirt', 'Men', 'Summer', 'FLEECE TO FEEL GOOD ABOUT - Hanes EcoSmart midweight sweatshirt is made with cotton sourced from American farms.\r\nCLASSIC SILHOUETTE - Basic crewneck sweatshirt shaping for that versatile look you love.\r\nMADE TO STAY SOFT- Thick, sturdy fleece stays warm and cozy.\r\nHOLDS ITS SHAPE - Thanks to a ribbed crewneck, cuffs and hem.\r\nMADE TO LAST - Double-needle stitching at the neck and armholes add extra quality and sturdiness.\r\nCONVENIENT TEARAWAY TAGS - Getting rid of unwanted tags is super easy. S', 1200, 25, '71syRjeD+SL._AC_SX679_.jpg'),
(18, 'Dokotoo Men Men&#39;s Crewneck Sweatshirts Soild Color Geometric Texture Long Sleeve Casual Pullover', 'Modern Thread', 'Shirt', 'Men', 'Summer', 'High Quality Fabric: Made of a blend of 95% polyester fiber and 5% elastic fiber, the high-quality and elastic fabric provides ultimate softness and comfort.\r\nUnique Design: This lightweight outdoor sweatshirts a solid color design and a unique geometric textured fabric, adding a touch of fashion. The round neck and long sleeves give it a classic appearance. The regular fit design provides a comfortable and slim silhouette.\r\nMatch: This plain crewneck sweatshirt can be easily paired with jeans, ', 2071, 0, '71DRFI1qYFL._AC_SY741_.jpg'),
(19, 'Elesuit Men&#39;s Full Zip Fleece Flannel Jackets Shirt Plaid Cotton Hoodies Soft Warm Coat for Men ', 'Modern Thread', 'Hoodie', 'Men', 'Summer', 'MATERIAL：This flannel hoodie shell crafted with 100% cotton, Sleeves lining incloud Cozy and thick fleece keeps you warm and comfortable in cold weather.\r\nFeatures: Jacket for men features full zip up design for easy on-and-off, hooded design with adjustable drawstring, sherpa lined hood for extra warmth.2 side pockets and a breast pocket, fashion plaid design.\r\nOccasion: Our men&#39;s zip hoodie sweatshirt, perfect in Spring, Fall, and Winter. Not only suitable for daily wear but also casual, o', 3894, 21, '816YzDkSQ9L._AC_SX679_.jpg'),
(20, 'Men&#39;s Fashion Loose Fit Crewneck Solid T-Shirt Athletic Lightweight Short Sleeve Gym Workout Top', 'Modern Thread', 'T-Shirt', 'Men', 'Summer', '【Material】- Pure cotton.High quality t-shirt. Light stretch. The fabric is soft. comfortable to wear, simple and fashionable.\r\n【Design】- The men&#39;s crew neck solid color T-shirt, simple and fashionable. Comfortable and classic short sleeves tshirts increase the sense of fashion while maintaining convenience.\r\n【Occasion】- These men t shirts are perfet for summer, the gym, running, parties, casual wear, and workouts.\r\n【Matching】 - Look your best in these mens undershirts.These pure t shirts men', 2071, 0, '51lrTls+1rL._AC_SX679_.jpg'),
(21, 'Men&#39;s Hooded Fleece Sweatshirt for Winter (Available in Big & Tall)', 'Modern Thread', 'Sweatshirt', 'Men', 'Winter', 'REGULAR FIT: Comfortable, easy fit through the shoulders, chest, and waist\r\nBRUSHED FLEECE: 8.3 oz soft brushed-back cotton-polyester blend fleece for staying cozy and keeping warm.\r\nHOODED SWEATSHIRT: A classic everyday essential, this hooded sweatshirt is casual and comfortable. Throw it on for running errands or layer it with a collared shirt for a more dressed up look.\r\nDETAILS: Jersey-lined hood has metal eyelets and an adjustable drawcord. Heavyweight rib trim at sleeve and bottom hems and', 2063, 35, '71g9qo3dI8S._AC_SX569_.jpg'),
(22, 'SCODI Hoodies for Men Heavyweight Fleece Sweatshirt - Full Zip Up Thick Sherpa Lined', 'Modern Thread', 'Sweatshirt', 'Men', 'Winter', 'Winter Hoodie: Surface: 55% cotton +45% polyester; Inside: 95% polyester wool.\r\nHeavyweight Hoodie: Men&#39;s hoodie, full zipper design, with 2 side pockets, and blended wool fabric to keep out the cold.\r\nHigh-quality Sweatshirt: Slim design, and the cuffs and bottom edges with lines and elastic band effect are close to the body to resist the cold wind in all directions. Suitable for daily use, office, jogging and other occasions.\r\n2022 New Upgrade: New upgrade of fabrics, zippers and styles. T', 2485, 0, '71lNIlrQvhL._AC_SX679_.jpg'),
(23, 'Dokotoo Men Men&#39;s Crewneck Sweatshirts Soild Color Geometric Texture Long Sleeve Casual Pullover', 'Modern Thread', 'Sweatshirt', 'Men', 'Summer', 'High Quality Fabric: Made of a blend of 95% polyester fiber and 5% elastic fiber, the high-quality and elastic fabric provides ultimate softness and comfort.\r\nUnique Design: This lightweight outdoor sweatshirts a solid color design and a unique geometric textured fabric, adding a touch of fashion. The round neck and long sleeves give it a classic appearance. The regular fit design provides a comfortable and slim silhouette.\r\nMatch: This plain crewneck sweatshirt can be easily paired with jeans, ', 2154, 0, '71LvuE+Bd1L._AC_SY879_.jpg'),
(24, 'Askdeer Men&#39;s Cable Knit Pullover Sweater Classic Crewneck Sweater Soft Casual Sweaters with Rib', 'Modern Thread', 'Sweatshirt', 'Men', 'Winter', 'QUALITY FABRIC - This crewneck sweater made of high-quality fabric. Soft, cozy, skin-friendly, durable and stretchy. Bring you a warm and comfortable wearing experience throughout the colder days.\r\nFEATURES - Threaded crew neck/Thick knit sweater/Classic design/Elastic ribbed hem. Solid color makes these men’s cable knit sweater classic and versatile, and the striped pattern adds extra texture.\r\nMATCH - Our soft sweater looks nice on its own, and is also a perfect layer under a blazer, jacket or', 2817, 0, '815MQPWT9GL._AC_SX679_.jpg'),
(25, 'CHEXPEL Men&#39;s Thick Winter Jackets with Hood Fleece Lining Cotton Military Jackets Work Jackets ', 'Modern Thread', 'Casual Jackets', 'Men', 'Summer', 'FRIENDLY Note:The zipper is located on the left.This is a Thicker fashion jacket with a Furry detachable hood.Effective protection against cold winds.\r\nMaterial:Outer Fabric:100% Cotton,Fleece Lining:100% Polyester,Soft and Thick Fleece Lining adds insulation to make us more comfortable,Front Buttons with leather Closure and Front full Zipper Closure,Elastic cuffs,effective wind protection,Let this winter jacket succeeded.\r\nStructure:This jacket has a lot of pockets,almost satisfying all your ne', 6298, 0, '71kdJNq7gNL._AC_SX679_.jpg'),
(26, 'JMIERR Men&#39;s Corduroy Button Down Shirts Casual Long Sleeve Shacket Jacket with Flap Pockets', 'Modern Thread', 'Casual Jackets', 'Men', 'Summer', 'Stay stylish and comfortable with JMIERR Men&#39;s Corduroy Button Down Shirt, crafted from high-quality and lightweight corduroy fabric. Its softness and comfort make it perfect for all-day wear.\r\nFeature: This casual jacket features a classic button down design with front button closures and a turn-down collar. It also includes two bust pockets and long sleeves with button cuffs, giving you the option to wear it as 3/4 sleeves or full sleeves.\r\nVersatile Pairings: This men&#39;s long sleeve bu', 402, 0, '71ZzCbpJZtL._AC_SY879_.jpg'),
(27, 'Gafeng Men&#39;s Casual Button Down Shirts Corduroy Long Sleeve Regular Fit Shacket Jacket with Flap', 'Modern Thread', 'Casual Jackets', 'Men', 'Summer', 'Corduroy Fabric： Men&#39;s Corduroy Button Down Shirt, crafted from high-quality and lightweight corduroy fabric. The fabric is soft and close to the skin. Ultra soft, stretch, comfortable, long lasting and not easy to shrink or fade and breathable fabric. Wearing casual button down shirt, you will feel very fresh, free and unrestrained. Give your skin the most comfortable feeling.\r\nCasual Shirts Stylish: Casual style, patch chest pockets, back darts, vintage washed for a soft, worn-in look with', 2734, 0, '61rPTpcYP4L._AC_SX679_.jpg'),
(30, 'Hanes mens Ecosmart Hoodie, Midweight Fleece Sweatshirt, Pullover Hooded Sweatshirt for Men', 'Modern Thread', 'Sweatshirt', 'Men', 'Summer', 'The dimension table has been updated in the product description.\r\nFabric: 95% cotton, 5% linen\r\nProduct Description has a Size Table\r\nUrban inspired T-Shirts instantly takes your style from bland to bold. With several styles and colors to match your closet for a modern and effortless fashion.', 1408, 0, '1_81TQnSYLadL._AC_SX679_.jpg'),
(31, 'KLIEGOU Mens Hipster Hip Hop Ripped Round Hemline Pattern Print T Shirt', 'Modern Thread', 'T-Shirt', 'Men', 'Summer', 'Fabric: 95% cotton, 5% linen\r\nThe fabric is soft and comfortable.\r\nProduct Description has a Size Table\r\nUrban inspired T-Shirts instantly takes your style from bland to bold. With several styles and colors to match your closet for a modern and effortless fashion.', 2236, 0, '61qCBcESReL._AC_SX679_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`) VALUES
(22, 30, '2_81D0-mdV1UL._AC_SX679_.jpg'),
(23, 30, '3_71LbwJtAo8L._AC_SX679_.jpg'),
(24, 30, '4_61xR6VhUojL._AC_SX679_.jpg'),
(25, 31, '71Ry2WhJ4dL._AC_SX679_.jpg'),
(26, 31, '614xQ9t3qlL._AC_SX679_.jpg'),
(27, 31, '619w1y1dGcL._AC_SX679_.jpg'),
(28, 16, '61iGvG3l5XL._AC_SX679_.jpg'),
(29, 16, '71L7mIbUDqL._AC_SX679_.jpg'),
(30, 16, '815OVPYr49L._AC_SX679_.jpg'),
(31, 32, '1d539c781d780b2cb41089131c5cf81b.jpeg'),
(32, 32, '38eb3545d2725f06efb0bcad180ef306.jpeg'),
(33, 32, 'winter-13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`, `city`, `state`, `pin_code`) VALUES
(6, 'admin', 'admin@gmail.com', '1234567890', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'flat no.1, bulding 1, area 1, tow, Baroda, Gujarat, India - 123456', 'Baroda', 'Gujarat', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
