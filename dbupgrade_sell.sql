-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 10:04 AM
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
-- Database: `dbupgrade&sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(7, 'ADMIN1', 'admin1@gmail.com', '$2y$10$Ll1xst/wLereu5s1r0gPc.R7b.s9mhSPZKsfzShDTpJsZYIWmqTLq'),
(8, '', 'admin2@gmail.com', '$2y$10$pscNBhq6EgP.yaehPz.LkOcZF/A.7/UjPW77O1GHNsvdri/W3yXra'),
(9, '', 'admin3@gmail.com', '$2y$10$fdCWeQ5G4qVv0ioUErhXseHOvsNjYBdqtMre24GYC0WOZ69UmNoSG');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `create_at`) VALUES
(1, 1, '2024-06-01 20:14:48'),
(9, 13, '2024-06-06 22:51:48'),
(10, 14, '2024-06-07 00:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `create_at`) VALUES
(5, 'Motherboard\r\n', '2024-06-01 19:16:26'),
(6, 'Processor (CPU)\r\n', '2024-06-01 19:17:59'),
(7, 'Heatsink\r\n', '2024-06-01 19:18:11'),
(8, 'RAM', '2024-06-01 19:18:22'),
(9, 'Hard Disk', '2024-06-01 19:18:38'),
(10, 'VGA Card(GPU)', '2024-06-01 19:18:57'),
(11, 'Flashdisk', '2024-06-01 19:19:08'),
(12, 'Monitor', '2024-06-01 19:19:25'),
(13, 'Keyboard', '2024-06-01 19:19:37'),
(14, 'Mouse', '2024-06-01 19:19:46'),
(15, 'Optical Drive', '2024-06-01 19:20:00'),
(16, 'SSD', '2024-06-01 19:20:06'),
(17, 'Power Supply', '2024-06-01 19:20:16'),
(18, 'LAN Card', '2024-06-01 19:20:25'),
(19, 'WLAN Card', '2024-06-01 19:20:40'),
(20, 'Sound Card', '2024-06-01 19:20:51'),
(21, 'Printer', '2024-06-01 19:21:02'),
(22, 'Scanner', '2024-06-01 19:21:12'),
(23, 'Speaker', '2024-06-01 19:21:21'),
(24, 'Webcam', '2024-06-01 19:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '''paid''',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(27, 1, 1899000.00, 'Paid', '2024-06-06 22:42:13'),
(28, 13, 4794999.00, 'Paid', '2024-06-06 22:52:25'),
(29, 14, 4697998.00, 'Paid', '2024-06-07 00:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(31, 27, 39, 1, 1899000.00, '2024-06-06 22:42:13'),
(32, 28, 39, 2, 1899000.00, '2024-06-06 22:52:25'),
(33, 28, 22, 1, 99999.00, '2024-06-06 22:52:25'),
(34, 28, 32, 3, 299000.00, '2024-06-06 22:52:25'),
(35, 29, 36, 1, 1199000.00, '2024-06-07 00:53:31'),
(36, 29, 39, 1, 1899000.00, '2024-06-07 00:53:31'),
(37, 29, 22, 1, 99999.00, '2024-06-07 00:53:31'),
(38, 29, 23, 1, 1499999.00, '2024-06-07 00:53:31');

--
-- Triggers `order_details`
--
DELIMITER $$
CREATE TRIGGER `update_stock_after_purchase` AFTER INSERT ON `order_details` FOR EACH ROW BEGIN
    UPDATE products
    SET stock = stock - NEW.quantity
    WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created_at`, `user_id`, `image`, `stock`) VALUES
(22, 'M.2 2280 SSD heatsink, High Performance SSD Cooler，PS5 Heat Sink', 'for PCIE NVME M.2 SSD or SATA M.2 SSD- Black\r\nPerfectly fit for Samsung 860 EVO, 960 EVO, 970 EVO, 970 Pro, etc. Compatible with Singel / Double sided M.2 2280 SSDs.\r\nwith 10°c - 20°C cooling effect (varies depending on the environments), cool your M.2 2280 SSD to a safetemp .\r\nThermal Pad, screws, & screwdriver included!\r\nTool-free and easy to install.', 99999.00, 7, '2024-06-04 03:06:40', 1, 0x75706c6f6164732f4865617473696e6b20312e6a7067, 3),
(23, 'Kingston FURY Beast 32GB (2x16GB) 5200MT/s DDR5 CL40 Kit of 2 Desktop Memory KF552C40BBK2-32', 'Improved stablility for overclocking\r\nIncreased efficiency\r\nIntel XMP 3.0-Ready and Certified\r\nPlug N Play at 5200MT/s\r\nLow-profile heat spreader design', 1499999.00, 8, '2024-06-04 03:09:10', 1, 0x75706c6f6164732f52414d204b696e6773746f6e2e6a7067, 11),
(24, 'Lexar 32GB (2x16GB) THOR OC DDR5 RAM 6000MT/s CL32 1.35V Desktop Memory with Heatsink, AMD Expo and ', 'Speed and Power: Built to live up to its name, embodying and delivering the speed and power of Thor’s hammer.\r\nSuperior Heatsink: With 1.6mm-thick heat spreader made with an aerospace-grade anodized aluminum, it provides a total heat dissipation area of up to 9000m.\r\nLow CAS Latencies: With carefully selected original factory-grade particles, it features timing CL32-38-38-76 at 6000MT/s.\r\nCompatible with the Latest Motherboards: Supports Intel XMP 3.0 and AMD EXPO dual-platform overclocking.\r\nOn-die ECC: With on-die Error Correction Code (ECC), it is able to correct errors within the DRAM chip and enhance data integrity.\r\nLifetime limited warranty', 1549999.00, 8, '2024-06-04 03:10:48', 1, 0x75706c6f6164732f52414d204c657861722e6a7067, 6),
(25, 'Seagate Skyhawk 6TB Video Internal Hard Drive HDD – 3.5 Inch SATA 6Gb/s 256MB Cache for DVR NVR Secu', 'Built faster for video DVR and NVR security camera systems, SkyHawk delivers video-optimized storage\r\nSupport workloads of up to 180TB/year—that\'s 64 simultaneously streaming HD cameras with little to zero dropped frames\r\nQuieter—with built-in RV sensors to allow drives to maintain performance in multi-bay systems, offering the flexibility to scale systems when more storage is needed\r\nEfficient power consumption reduces heat emissions and improves reliability—plus, drives can easily be monitored with SkyHawk Health Management\r\nEnjoy long-term peace of mind with 1M hours MTBF, an included three-year limited warranty, and three-year in-house Rescue Data Recovery Services', 1999999.00, 9, '2024-06-04 03:14:11', 1, 0x75706c6f6164732f48444420536b796861776b2e6a7067, 6),
(26, 'Seagate IronWolf 8TB NAS Internal Hard Drive HDD – 3.5 Inch SATA 6Gb/s 7200 RPM 256MB Cache for RAID', 'IronWolf internal hard drives are the ideal solution for up to 8-bay, multi-user NAS environments craving powerhouse performance.date transfer rate:6.0 gigabits_per_second\r\nStore more and work faster with a NAS-optimized hard drive providing 8TB and cache of up to 256MB\r\nPurpose built for NAS enclosures, IronWolf delivers less wear and tear, little to no noise/vibration, no lags or down time, increased file-sharing performance, and much more\r\nEasily monitor the health of drives using the integrated IronWolf Health Management system and enjoy long-term reliability with 1M hours MTBF\r\nFive-year limited product warranty protection plan and three year Rescue Data Recovery Services included', 2399999.00, 9, '2024-06-04 03:15:11', 1, 0x75706c6f6164732f4844442049726f6e776f6c662e6a7067, 6),
(28, 'EVGA GeForce GTX 1650 Super SC Ultra Gaming, 4GB GDDR6, Dual Fan, Metal Backplate, 04G-P4-1357-KR', 'Real Boost Clock: 1755 MHz; Memory Detail: 4096 MB GDDR6\r\nAll-new NVIDIA Turing architecture to give you incredible new levels of gaming realism, speed, power efficiency and immersion\r\nDual fans offer higher performance cooling and low acoustic noise\r\nBuilt for EVGA Precision x1 All-metal backplate, pre-installed.Avoid using unofficial software\r\n3 year & EVGA top notch technical support', 3499999.00, 10, '2024-06-04 03:25:19', 1, 0x75706c6f6164732f5647412047545820313635302e6a7067, 7),
(29, 'Sceptre 30-inch Curved Gaming Monitor 21:9 2560x1080 Ultra Wide/ Slim HDMI DisplayPort up to 200Hz B', '30\" Curved Gaming Monitor 2560 x 1080 Full HD Resolution. Response Time- 5ms GTG.Aspect Ratio: 21:9. Viewing Angle is 170° (H) / 170° (V). Brightness(typ) is 250. Without Stand (W x H x D)-27.82 x 12.64 x 3.69 inches\r\nDP Up to 200Hz Refresh Rate / HDMI 2. 0 Up to 120Hz Refresh Rate: More than double the standard refresh rate, 200Hz gives gamers an edge in visibility as frames transition instantly, leaving behind no blurred images', 3399000.00, 12, '2024-06-04 03:29:31', 1, 0x75706c6f6164732f4d6f6e69746f7220737065637472652e6a7067, 21),
(30, 'ASUS ROG Strix Scope II 96 Wireless Gaming Keyboard, Tri-Mode Connection, Dampening Foam & Switch-Da', '96% layout: Retains all function and number keys in a more compact and efficient layout that frees up desk space\r\nHot-swappable switches: Pre-lubed NX Snow linear switches and ROG NX Storm clicky switches with walled stem design to enhance keystroke stability and are tuned for great acoustics\r\nTri-mode connection: Connect using Bluetooth (up to three devices), 2.4 GHz with ROG SpeedNova wireless technology or wired USB', 1299000.00, 13, '2024-06-04 03:32:40', 1, 0x75706c6f6164732f4b6579626f61726420524f472e6a7067, 30),
(31, 'ASUS ROG Spatha X Wireless Gaming Mouse (Magnetic Charging Stand, 12 Programmable Buttons, 19,000 DP', 'Dual-mode Connectivity - ROG Spatha X Wireless Gaming Mouse allows you play wirelessly with 2.4 GHzRF, or with a wired USB-C cable connection\r\nUltimate Accuracy - 19,000 DPI optical sensor provides unmatched accuracy. The DPI On-The-Scroll feature lets you easily adjust the sensitivity of the wireless mouse without accessing software', 1499000.00, 14, '2024-06-04 03:34:26', 1, 0x75706c6f6164732f4d6f75736520524f472e6a7067, 11),
(32, 'Gotega External DVD Drive, USB 3.0 Portable +/-RW , DVD Player for CD ROM Burner Compatible with Lap', '📀【High Writing and Reading Speed】Max 8x DVDR Write Speed and Max 24x CD Write Speed provide high writing and reading speed.\r\n📀【Wide Compatible】This external dvd cd drive is compatible with Windows 98 / SE / ME / 2000 / XP / Vista / Windows 11/10/8/7, Mac OS (8.6 to 10.14). And perfect for PC, Laptop, Comprehensive Computer, Internal PC hard disk reader. NOT COMPATIBLE with Chrombook, Blue-ray.', 299000.00, 15, '2024-06-04 03:37:34', 1, 0x75706c6f6164732f4f70746963616c20447269766520476f746567612e6a7067, 31),
(33, 'Kingston NV2 4TB M.2 2280 NVMe Internal SSD | PCIe 4.0 Gen 4x4 | Up to 3500 MB/s | SNV2S/4000G', 'Ideal for laptops & small form factor PCs\r\nGen 4x4 NVMe PCle performance\r\nAvailable in a range of capacities up to 4TB to meet your data storage requirements.\r\nEasily integrate into designs with M.2 connectors. Perfect for thin laptops and small form factor PCs', 3899000.00, 16, '2024-06-04 03:53:46', 1, 0x75706c6f6164732f535344204b494e4753544f4e2e6a7067, 6),
(34, 'Sound BlasterX G6 Hi-Res 130dB 32bit/384kHz Gaming DAC, External USB Sound Card with Xamp Headphone ', 'UPGRADE YOUR GAMES ON PS4, XBOX ONE, NINTENDO SWITCH, AND PC | Get immediate increased enjoyment over basic motherboard and controller audio! Apart from incredible audio quality, the Sound BlasterX G6 boasts gaming-centric features such as Sidetone volume control and easy-to-reach profile buttons\r\nINDUSTRY-LEADING AUDIO PROCESSING TECHNOLOGY Enjoy full audio customization and enhanced audio realism with immersive 7.1 surround virtualization, accurate cues, bass boost and in-game voice communication enhancements. It also has Scout Mode than enhances in-game audio cues, letting you hear your enemies before they hear you', 1399000.00, 20, '2024-06-04 03:55:36', 1, 0x75706c6f6164732f536f756e64204361726420424c41535445522e6a7067, 4),
(35, 'Logitech C920x HD Pro Webcam, Full HD 1080p/30fps Video Calling, Clear Stereo Audio, HD Light Correc', 'Webcam comes with a 3-month XSplit VCam license and no privacy shutter. XSplit VCam lets you remove, replace and blur your background without a Green Screen.\r\nFull HD 1080p video calling and recording at 30 fps - You’ll make a strong impression when it counts with crisp, clearly detailed and vibrantly colored video. Cable length: 1.5 m\r\nStereo audio with dual mics - Capture natural sound on calls and recorded videos.', 999000.00, 24, '2024-06-04 04:01:38', 1, 0x75706c6f6164732f57656263616d204c6f6769746563682e6a7067, 5),
(36, 'ASUS Prime B450M-A II AMD AM4 (Ryzen 5000, 3rd/2nd/1st Gen Ryzen Micro ATX Motherboard (128GB DDR4, ', 'AMD AM4 Socket : Compatible to Ryzen 5000, 3rd/2nd/1st Gen AMD Ryzen CPUs.Operating System : Windows 10 64-bit. Windows 7 64-bit\r\nDesigned for Productivity: USB 3.2 Gen 2 with 10Gbps ultra-fast transfer speed, onboard M.2 support, 4xDIMMs support up to 128GB DDR4 with 4400 (O.C.) performance, HDMI 2.0b/DVI/D-Sub', 1199000.00, 5, '2024-06-04 04:23:40', 1, 0x75706c6f6164732f4d6f74686572626f6172642e6a7067, 1),
(39, 'AMD Ryzen 7 5800X 8-core, 16-Thread Unlocked Desktop Processor', 'AMD\'s fastest 8 core processor for mainstream desktop, with 16 procesing threads. OS Support-Windows 10 64-Bit Edition\r\nCan deliver elite 100-plus FPS performance in the world\'s most popular games\r\nCooler not included, high-performance cooler recommended\r\n4.7 GHz Max Boost, unlocked for overclocking, 36 MB of cache, DDR-3200 support\r\nFor the advanced Socket AM4 platform, can support PCIe 4.0 on X570 and B550 motherboards\r\nSystem Memory Specification: Up to 3200MHz', 1899000.00, 6, '2024-06-05 21:47:02', 1, 0x75706c6f6164732f50726f636573736f722052797a656e2e6a7067, 2),
(40, 'Intel Core i5-13600K Desktop Processor 14 (6 P-cores + 8 E-cores) with Integrated Graphics - Unlocke', '13th Gen Intel Core processors offer revolutionary design for beyond real-world performance. From extreme multitasking, immersive streaming, and faster creating, do what you do\r\n14 cores (6 P-cores + 8 E-cores) and 20 threads\r\nUp to 5.1 GHz unlocked. 24M Cache\r\nIntegrated Intel UHD Graphics 770 included\r\nCompatible with Intel 600 series (might need BIOS update) and 700 series chipset-based motherboards\r\nPerformance hybrid architecture integrates two core microarchitectures, prioritizing and distributing workloads to optimize performance\r\nTurbo Boost Max Technology 3.0, and PCIe 5.0 & 4.0 support. Intel Optane Memory support. No thermal solution included', 2199000.00, 6, '2024-06-05 21:47:38', 1, 0x75706c6f6164732f50726f636573736f7220496e74656c2e6a7067, 3),
(42, 'MSI B550 Gaming GEN3 Gaming Motherboard (AMD Ryzen 5000 Series, AM4, DDR4, PCIe 3.0, SATA 6Gb/s, M.2', 'Motherboard', 1199000.00, 5, '2024-06-07 00:54:18', 14, 0x75706c6f6164732f4d53495f4d6f74686572626f6172642e6a7067, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `balance` decimal(12,2) NOT NULL DEFAULT 0.00,
  `shipping_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `email`, `password`, `created_at`, `balance`, `shipping_address`) VALUES
(1, 'Naufal', 'gikhton1617@gmail.com', '$2y$10$WLmKc/ilfOzQdaq/6H2ye.8kuPK33PkvpmzFUl9KoXb958IYlcSym', '2024-06-01 15:03:58', 998103000.00, 'Jl.Prof.K.H.Zainal Abidin Fikri KM.3,5 Palembang Sumatera Selatan'),
(13, 'Coba-coba', 'coba@gmail.com', '$2y$10$FGPtLw/Kkm2RGnP/wIEz2OTqXi6uoBC0juTwyIcDBWUb1xiHCikN2', '2024-06-06 22:49:34', 85205001.00, 'Jakabaring'),
(14, 'Son', 'son@gmail.com', '$2y$10$gAr6SELt045Vek3AvbwLw...DUgRmcxwNTDrhtGIjbgj3kBw9nMLW', '2024-06-07 00:52:02', 5302002.00, 'Jakabaring');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email_index` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
