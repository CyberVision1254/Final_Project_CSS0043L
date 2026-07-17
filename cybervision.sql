-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2026 at 02:33 PM
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
-- Database: `cybervision`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `actor_name` varchar(150) NOT NULL,
  `actor_role` varchar(20) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id`, `user_id`, `actor_name`, `actor_role`, `action`, `description`, `date_created`) VALUES
(1, 1, 'System Administrator', 'admin', 'LOGIN', 'System Administrator logged in.', '2026-07-09 05:44:41'),
(2, 1, 'System Administrator', 'admin', 'LOGOUT', 'System Administrator logged out.', '2026-07-09 12:16:24'),
(3, 2, 'Joschka Atabelo', 'buyer', 'REGISTER', 'Joschka Atabelo registered a new buyer account.', '2026-07-10 05:08:42'),
(4, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-10 05:22:07'),
(5, 3, 'CyberVision Administrator', 'admin', 'LOGOUT', 'CyberVision Administrator logged out.', '2026-07-10 05:28:35'),
(6, 4, 'KAJSKJASK', 'buyer', 'REGISTER', 'KAJSKJASK registered a new buyer account.', '2026-07-10 05:29:09'),
(7, 5, 'AHSKAJSKAJ', 'buyer', 'REGISTER', 'AHSKAJSKAJ registered a new buyer account.', '2026-07-10 05:34:36'),
(8, 5, 'AHSKAJSKAJ', 'buyer', 'LOGIN', 'AHSKAJSKAJ logged in.', '2026-07-10 05:34:47'),
(9, 5, 'AHSKAJSKAJ', 'buyer', 'LOGOUT', 'AHSKAJSKAJ logged out.', '2026-07-10 05:34:56'),
(10, 5, 'AHSKAJSKAJ', 'buyer', 'LOGIN', 'AHSKAJSKAJ logged in.', '2026-07-10 05:36:41'),
(11, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-10 11:57:00'),
(12, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-11 10:05:44'),
(13, 3, 'CyberVision Administrator', 'admin', 'LOGOUT', 'CyberVision Administrator logged out.', '2026-07-11 10:09:32'),
(14, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-11 10:09:58'),
(15, 3, 'CyberVision Administrator', 'admin', 'EDIT_ADMIN', 'CyberVision Administrator updated admin: System Administrator (admin@chairhive.test).', '2026-07-11 10:18:29'),
(16, 3, 'CyberVision Administrator', 'admin', 'EDIT_ADMIN', 'CyberVision Administrator updated admin: System Administrator (admin@chairhive.test).', '2026-07-11 10:20:08'),
(17, 3, 'CyberVision Administrator', 'admin', 'EDIT_ADMIN', 'CyberVision Administrator updated admin: System Administrator (admin@chairhive.test).', '2026-07-11 10:24:44'),
(18, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-13 11:36:00'),
(19, 3, 'CyberVision Administrator', 'buyer', 'PLACE_ORDER', 'CyberVision Administrator placed order #1 for ₱11,990.00 (Cash on Delivery).', '2026-07-13 11:38:27'),
(20, 3, 'CyberVision Administrator', 'admin', 'LOGOUT', 'CyberVision Administrator logged out.', '2026-07-13 11:44:28'),
(21, 6, 'AKJSKAJSKAS', 'buyer', 'REGISTER', 'AKJSKAJSKAS registered a new buyer account.', '2026-07-15 00:22:02'),
(22, 7, 'asdsdaad', 'buyer', 'REGISTER', 'asdsdaad registered a new buyer account.', '2026-07-15 00:47:19'),
(23, 8, 'ASASSAS', 'buyer', 'REGISTER', 'ASASSAS registered a new buyer account.', '2026-07-15 01:11:24'),
(24, 9, 'asdadad', 'buyer', 'REGISTER', 'asdadad registered a new buyer account.', '2026-07-15 01:30:52'),
(25, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-15 01:33:14'),
(26, 3, 'CyberVision Administrator', 'admin', 'LOGOUT', 'CyberVision Administrator logged out.', '2026-07-15 06:06:17'),
(27, 10, 'ASASASASASSAS', 'buyer', 'REGISTER', 'ASASASASASSAS registered a new buyer account.', '2026-07-15 06:07:07'),
(28, 11, 'ASJLAKSLAKSL', 'buyer', 'REGISTER', 'ASJLAKSLAKSL registered a new buyer account.', '2026-07-16 08:24:01'),
(29, 11, 'ASJLAKSLAKSL', 'buyer', 'LOGIN', 'ASJLAKSLAKSL logged in.', '2026-07-16 08:24:33'),
(30, 11, 'ASJLAKSLAKSL', 'buyer', 'LOGOUT', 'ASJLAKSLAKSL logged out.', '2026-07-16 08:27:14'),
(31, 12, 'Gabriel Tenorio', 'buyer', 'REGISTER', 'Gabriel Tenorio registered a new buyer account.', '2026-07-16 08:31:40'),
(32, 12, 'Gabriel Tenorio', 'buyer', 'LOGIN', 'Gabriel Tenorio logged in.', '2026-07-16 08:32:04'),
(33, 12, 'Gabriel Tenorio', 'buyer', 'LOGOUT', 'Gabriel Tenorio logged out.', '2026-07-16 08:32:17'),
(34, 13, 'Joschka Tenorio', 'buyer', 'REGISTER', 'Joschka Tenorio registered a new buyer account.', '2026-07-16 09:05:16'),
(35, 13, 'Joschka Tenorio', 'buyer', 'LOGIN', 'Joschka Tenorio logged in.', '2026-07-16 09:05:40'),
(36, 13, 'Joschka Tenorio', 'buyer', 'LOGOUT', 'Joschka Tenorio logged out.', '2026-07-16 10:48:28'),
(37, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-16 10:48:53'),
(38, 3, 'CyberVision Administrator', 'admin', 'UPDATE_ORDER', 'CyberVision Administrator changed order #1 status: Pending → Completed.', '2026-07-16 11:51:14'),
(39, 3, 'CyberVision Administrator', 'admin', 'LOGOUT', 'CyberVision Administrator logged out.', '2026-07-16 12:09:01'),
(40, 14, 'Art Panulde', 'buyer', 'REGISTER', 'Art Panulde registered a new buyer account.', '2026-07-16 12:11:37'),
(41, 14, 'Art Panulde', 'buyer', 'LOGIN', 'Art Panulde logged in.', '2026-07-16 12:14:31'),
(42, 14, 'Art Panulde', 'buyer', 'LOGOUT', 'Art Panulde logged out.', '2026-07-16 12:14:34'),
(43, 15, 'Joschka Atabelo', 'buyer', 'REGISTER', 'Joschka Atabelo registered a new buyer account.', '2026-07-16 12:16:03'),
(44, 15, 'Joschka Atabelo', 'buyer', 'LOGIN', 'Joschka Atabelo logged in.', '2026-07-16 12:16:31'),
(45, 15, 'Joschka Atabelo', 'buyer', 'LOGOUT', 'Joschka Atabelo logged out.', '2026-07-16 12:16:40'),
(46, 16, 'Art Panulde', 'buyer', 'REGISTER', 'Art Panulde registered a new buyer account.', '2026-07-16 12:17:37'),
(47, 16, 'Art Panulde', 'buyer', 'LOGIN', 'Art Panulde logged in.', '2026-07-16 12:18:00'),
(48, 16, 'Art Panulde', 'buyer', 'LOGOUT', 'Art Panulde logged out.', '2026-07-16 12:18:03'),
(49, 17, 'Carl Vitalista', 'buyer', 'REGISTER', 'Carl Vitalista registered a new buyer account.', '2026-07-16 12:19:02'),
(50, 17, 'Carl Vitalista', 'buyer', 'LOGIN', 'Carl Vitalista logged in.', '2026-07-16 12:19:34'),
(51, 17, 'Carl Vitalista', 'buyer', 'LOGOUT', 'Carl Vitalista logged out.', '2026-07-16 12:19:57'),
(52, 18, 'Jose Gerard Joaquin S. Soriano', 'buyer', 'REGISTER', 'Jose Gerard Joaquin S. Soriano registered a new buyer account.', '2026-07-16 12:23:12'),
(53, 3, 'CyberVision Administrator', 'admin', 'LOGIN', 'CyberVision Administrator logged in.', '2026-07-17 01:41:51'),
(54, 3, 'CyberVision Administrator', 'admin', 'EDIT_ADMIN', 'CyberVision Administrator updated admin: CyberVision Administrator (cybervision@admin.com).', '2026-07-17 01:42:17'),
(55, 3, 'CyberVision Administrator', 'admin', 'LOGOUT', 'CyberVision Administrator logged out.', '2026-07-17 01:42:56'),
(56, 15, 'Joschka Atabelo', 'buyer', 'LOGIN', 'Joschka Atabelo logged in.', '2026-07-17 01:43:18'),
(57, 15, 'Joschka Atabelo', 'buyer', 'LOGOUT', 'Joschka Atabelo logged out.', '2026-07-17 01:46:26'),
(58, 16, 'Art Panulde', 'buyer', 'LOGIN', 'Art Panulde logged in.', '2026-07-17 01:46:33'),
(59, 16, 'Art Panulde', 'buyer', 'LOGOUT', 'Art Panulde logged out.', '2026-07-17 01:46:35'),
(60, 17, 'Carl Vitalista', 'buyer', 'LOGIN', 'Carl Vitalista logged in.', '2026-07-17 01:46:50'),
(61, 17, 'Carl Vitalista', 'buyer', 'LOGOUT', 'Carl Vitalista logged out.', '2026-07-17 01:47:09'),
(62, 19, 'Jose Gerard Joaquin S. Soriano', 'buyer', 'REGISTER', 'Jose Gerard Joaquin S. Soriano registered a new buyer account.', '2026-07-17 12:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Paid (Simulated)',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_address`, `contact_number`, `payment_method`, `total_amount`, `status`, `date_created`) VALUES
(1, 3, 'CyberVision Office', '09170000000', 'Cash on Delivery', 11990.00, 'Completed', '2026-07-13 11:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `unit_price`, `quantity`) VALUES
(1, 1, 11, 'Cradle Comfort Ergonomic Office Chair', 11990.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock_qty` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `long_description`, `price`, `stock_qty`, `is_active`, `date_created`, `image`) VALUES
(1, 'A34 Executive Chair', 'Executive Chairs', 'Premium executive office chair.', 'The A34 Executive Chair is designed for professionals who value comfort, elegance, and productivity. Featuring a high-back ergonomic design, plush cushioning, and premium upholstery, this chair provides excellent support for your neck, shoulders, and lower back during extended work hours. Its adjustable height, smooth swivel function, and reclining mechanism allow you to personalize your seating position for maximum comfort. Built with a heavy-duty chrome base and durable caster wheels, the A34 Executive Chair combines reliability with executive-level sophistication, making it the perfect centerpiece for modern offices, conference rooms, and home workspaces.', 16500.00, 15, 1, '2026-07-09 07:33:25', 'images/products/a34-executive-chair.jpg'),
(2, 'YS901A Executive Chair', 'Executive Chairs', 'Comfortable executive office chair.', 'The YS901A Executive Chair offers an exceptional balance of comfort, durability, and modern style. Designed with thick seat cushioning, ergonomic back support, and a breathable structure, it helps reduce fatigue while maintaining proper posture throughout the workday. Adjustable seat height, smooth rolling casters, and a 360-degree swivel base provide flexibility and convenience. Whether you are managing meetings, working from home, or handling everyday office tasks, the YS901A delivers dependable performance with a sleek professional appearance.', 7850.00, 20, 1, '2026-07-09 07:33:25', 'images/products/ys901a-executive-chair.jpg'),
(3, 'Clarion High-Back Executive Office Chair', 'Executive Chairs', 'High-back executive chair for professional offices.', 'Designed for executives and professionals, the Clarion High-Back Executive Office Chair delivers superior comfort throughout long working hours. Its tall ergonomic backrest supports the entire spine while the generously padded seat minimizes pressure on the hips and thighs. The sturdy frame, adjustable height, reclining function, and smooth mobility make every work session more comfortable. With its elegant design and premium construction, the Clarion Chair enhances both productivity and the overall appearance of your workspace.', 7500.00, 18, 1, '2026-07-09 07:33:25', 'images/products/clarion-high-back-executive-office-chair.jpg'),
(4, 'B75 Executive Chair', 'Executive Chairs', 'Executive chair with ergonomic support.', 'The B75 Executive Chair combines ergonomic support with a clean, professional design suitable for offices of any size. Featuring a supportive backrest, thick foam cushioning, padded armrests, and adjustable height, it encourages proper posture while keeping you comfortable throughout the day. Built with durable materials and a reinforced five-star base, this chair is designed to withstand everyday office use while maintaining its stylish appearance.', 5750.00, 25, 1, '2026-07-09 07:33:25', 'images/products/b75-executive-chair.jpg'),
(5, 'CX300H Executive Chair', 'Executive Chairs', 'Affordable executive office chair.', 'The CX300H Executive Chair is an affordable solution for professionals seeking comfort without sacrificing quality. Its ergonomic design provides reliable lumbar support while the padded seat offers lasting comfort during extended work sessions. Equipped with height adjustment, smooth swivel movement, and durable caster wheels, it adapts easily to different work environments. The sleek executive styling makes it an attractive addition to any office or home workspace.', 4199.00, 30, 1, '2026-07-09 07:33:25', 'images/products/cx300h-executive-chair.jpg'),
(6, 'Avius 746 Executive Chair', 'Executive Chairs', 'Luxury executive office chair.', 'Crafted with premium materials, the Avius 746 Executive Chair offers luxurious comfort for executives and business professionals. The thick seat padding, ergonomic lumbar support, reclining mechanism, and adjustable height work together to create an outstanding seating experience. Built on a durable metal base with smooth-rolling casters, it delivers excellent stability and mobility. Its refined design complements modern office interiors while providing dependable comfort every day.', 19000.00, 10, 1, '2026-07-09 07:33:25', 'images/products/avius-746-executive-chair.jpg'),
(7, 'Virello Executive Chair – Reclining Chair w/ Adjustable Headrest', 'Executive Chairs', 'Reclining executive chair with adjustable headrest.', 'The Virello Executive Chair with Adjustable Headrest is engineered for professionals who spend long hours at their desks. Featuring an ergonomic reclining backrest, adjustable headrest, lumbar support, and thick cushioning, this chair helps reduce fatigue while improving posture. The durable steel base and premium materials ensure years of dependable performance, making it an ideal choice for executive offices and high-performance workspaces.', 18950.00, 12, 1, '2026-07-09 07:33:25', 'images/products/virello-executive-chair.jpg'),
(8, 'Apollo Reclining Executive Chair', 'Executive Chairs', 'Executive reclining office chair.', 'The Apollo Reclining Executive Chair delivers executive-level comfort with its smooth reclining mechanism, ergonomic support, and premium upholstery. Designed for productivity and relaxation, it features adjustable height, padded armrests, a spacious seat, and a sturdy five-star base for maximum stability. Whether used in executive offices or home workstations, the Apollo Chair combines style, durability, and comfort into one premium seating solution.', 17000.00, 10, 1, '2026-07-09 07:33:25', 'images/products/apollo-reclining-executive-chair.jpg'),
(9, 'Orion Reclining Executive Office Chair with Footrest', 'Executive Chairs', 'Executive chair with reclining backrest and footrest.', 'Experience exceptional comfort with the Orion Reclining Executive Office Chair featuring an integrated footrest for complete relaxation. Its ergonomic backrest supports the natural curve of the spine while the reclining mechanism allows users to switch effortlessly between work and rest. Premium padding, adjustable height, durable armrests, and a reinforced frame ensure lasting comfort and stability. The Orion Chair is ideal for professionals seeking both productivity and luxury.', 16950.00, 8, 1, '2026-07-09 07:33:25', 'images/products/orion-reclining-executive-chair.jpg'),
(10, 'Titan Reclining Executive Chair', 'Executive Chairs', 'Heavy-duty reclining executive chair.', 'The Titan Reclining Executive Chair is built for demanding professionals who require maximum comfort throughout the day. Featuring a generously padded seat, ergonomic lumbar support, reclining backrest, adjustable height, and heavy-duty base, it offers excellent support for long hours of work. Its modern executive styling, premium finish, and reliable construction make it an outstanding investment for corporate offices, executive suites, and sophisticated home workspaces.', 13950.00, 12, 1, '2026-07-09 07:33:25', 'images/products/titan-reclining-executive-chair.jpg'),
(11, 'Cradle Comfort Ergonomic Office Chair', 'Ergonomic Chairs', 'Premium ergonomic office chair.', 'The Cradle Comfort Ergonomic Office Chair is designed to provide exceptional comfort and support for professionals, students, and remote workers who spend extended hours at their desks. Featuring a breathable mesh backrest, adjustable headrest, and built-in lumbar support, this chair promotes proper posture while reducing strain on your neck, shoulders, and lower back. The adjustable armrests, reclining backrest, and high-density molded foam seat ensure personalized comfort, while the durable aluminum base and smooth-rolling casters provide stability and effortless mobility. Whether for home offices or corporate workspaces, the Cradle Comfort delivers premium ergonomics, modern style, and long-lasting durability.', 11990.00, 19, 1, '2026-07-09 07:33:25', 'images/products/cradle-comfort-ergonomic-office-chair.jpg'),
(12, 'Cradle Comfort Lite Ergonomic Office Chair', 'Ergonomic Chairs', 'Lightweight ergonomic office chair.', 'The Cradle Comfort Lite Ergonomic Office Chair is a lightweight yet highly supportive seating solution designed for everyday productivity. Its breathable mesh backrest keeps you cool during long work sessions while the ergonomic lumbar support encourages healthy posture. Adjustable seat height, smooth swivel movement, and a sturdy nylon base provide flexibility and dependable performance. Perfect for students, remote workers, and office professionals, this chair offers exceptional value without compromising on comfort or quality.', 9490.00, 18, 1, '2026-07-09 07:33:25', 'images/products/cradle-comfort-lite.jpg'),
(13, 'Stance Aero Form Ergonomic Office Chair', 'Ergonomic Chairs', 'Breathable ergonomic office chair.', 'The Stance Aero Form Ergonomic Office Chair combines contemporary design with advanced ergonomic support to create a healthier working experience. Its ventilated mesh construction improves airflow while the adjustable headrest, lumbar support, and reclining mechanism reduce fatigue during extended sitting. Built with premium materials and a reinforced frame, the Aero Form provides lasting comfort, smooth mobility, and reliable durability for both home offices and professional workspaces.', 6990.00, 22, 1, '2026-07-09 07:33:25', 'images/products/stance-aero-form.jpg'),
(14, 'Cradle Flexi Prestige Edition', 'Ergonomic Chairs', 'Prestige ergonomic office chair.', 'The Cradle Flexi Prestige Edition is designed for professionals who demand premium comfort throughout the workday. Featuring a fully adjustable ergonomic system, breathable mesh backrest, supportive lumbar cushion, and high-density seat foam, it helps minimize muscle strain while maximizing productivity. The durable frame, elegant styling, and smooth reclining mechanism make it an excellent choice for executive offices, creative studios, and modern workspaces.', 10990.00, 15, 1, '2026-07-09 07:33:25', 'images/products/cradle-flexi-prestige-edition.jpg'),
(15, 'Cradle Flexi Ergonomic Office Chair', 'Ergonomic Chairs', 'Adjustable ergonomic office chair.', 'The Cradle Flexi Ergonomic Office Chair provides all-day support through its ergonomic backrest, adjustable seat height, and breathable mesh construction. Designed to promote proper posture and reduce back fatigue, it offers a comfortable seating experience for professionals, students, and remote workers alike. Its sturdy five-star base, silent caster wheels, and modern design ensure durability while complementing any contemporary office environment.', 7990.00, 20, 1, '2026-07-09 07:33:25', 'images/products/cradle-flexi.jpg'),
(16, 'Cradle Pro Ergonomic Office Chair', 'Ergonomic Chairs', 'Professional ergonomic office chair.', 'Built for demanding professionals, the Cradle Pro Ergonomic Office Chair delivers superior comfort with its advanced ergonomic features and premium construction. The adjustable headrest, dynamic lumbar support, reclining backrest, and molded foam seat work together to provide outstanding support during extended work sessions. Crafted with high-quality materials and a heavy-duty frame, this chair offers exceptional durability and long-term performance for modern offices.', 17490.00, 10, 1, '2026-07-09 07:33:25', 'images/products/cradle-pro.jpg'),
(17, 'Stance Halo Ergonomic Office Chair', 'Ergonomic Chairs', 'High-end ergonomic office chair.', 'The Stance Halo Ergonomic Office Chair represents the highest level of ergonomic seating. Designed with premium mesh materials, precision lumbar support, adjustable armrests, and a synchronized reclining mechanism, it delivers outstanding comfort throughout the day. Every adjustment is engineered to support natural body movement while reducing fatigue and improving posture. Its sleek appearance and durable construction make it an excellent investment for professionals seeking maximum productivity and comfort.', 22990.00, 8, 1, '2026-07-09 07:33:25', 'images/products/stance-halo.jpg'),
(18, 'Stance BetterWork Pro Ergonomic Office Chair', 'Ergonomic Chairs', 'Office chair for long working hours.', 'The Stance BetterWork Pro Ergonomic Office Chair is designed to make long hours at your desk more comfortable and productive. Featuring ergonomic lumbar support, breathable mesh fabric, adjustable seat height, and a reclining backrest, it encourages healthy posture while minimizing pressure on the spine. Built with durable components and smooth-rolling caster wheels, it provides dependable performance for both office and home work environments.', 8290.00, 18, 1, '2026-07-09 07:33:25', 'images/products/stance-betterwork-pro.jpg'),
(19, 'Stance Stylite Ergonomic Office Chair', 'Ergonomic Chairs', 'Stylish ergonomic office chair.', 'The Stance Stylite Ergonomic Office Chair combines stylish aesthetics with ergonomic functionality. Its breathable mesh back, supportive lumbar design, adjustable height, and soft cushioned seat deliver exceptional comfort throughout the workday. The sturdy frame and smooth swivel base ensure reliable performance, while the modern design enhances the appearance of any office, study area, or home workspace.', 7490.00, 20, 1, '2026-07-09 07:33:25', 'images/products/stance-stylite.jpg'),
(20, 'Novo Thorne Ergonomic Office Chair', 'Ergonomic Chairs', 'Modern ergonomic office chair.', 'The Novo Thorne Ergonomic Office Chair is thoughtfully engineered to support healthier sitting habits while maintaining a clean, contemporary appearance. Equipped with a breathable mesh backrest, ergonomic lumbar support, adjustable headrest, reclining mechanism, and comfortable seat cushion, it adapts to your preferred seating position with ease. Its durable construction and smooth mobility make it an excellent choice for professionals, students, and anyone seeking lasting comfort during extended work sessions.', 11990.00, 14, 1, '2026-07-09 07:33:25', 'images/products/novo-thorne.jpg'),
(21, 'TTRacing Maxx Pro Gaming Chair', 'Gaming Chairs', 'Professional gaming chair.', 'The TTRacing Maxx Pro Gaming Chair is built for gamers, streamers, and professionals who demand exceptional comfort during extended sessions. Featuring high-density cold-cured foam, an ergonomic racing-inspired design, adjustable lumbar and neck pillows, and a reclining backrest up to 155 degrees, it provides outstanding support throughout the day. The heavy-duty steel frame, Class 4 hydraulic piston, and smooth PU caster wheels ensure long-lasting durability and effortless mobility. Whether gaming, working, or studying, the Maxx Pro delivers premium comfort and performance.', 23999.00, 12, 1, '2026-07-09 07:33:25', 'images/products/ttracing-maxx-pro.jpg'),
(22, 'TTRacing Maxx Pro Air Threads Fabric Gaming Chair', 'Gaming Chairs', 'Fabric gaming chair with breathable material.', 'The TTRacing Maxx Pro Air Threads Fabric Gaming Chair combines breathable fabric upholstery with advanced ergonomic support for maximum comfort. Designed to keep users cool during long gaming and work sessions, it features adjustable lumbar and neck pillows, 4D armrests, a reclining backrest, and high-density foam cushioning. The reinforced steel frame and premium construction provide exceptional stability, making it an ideal choice for competitive gamers and professionals alike.', 24499.00, 10, 1, '2026-07-09 07:33:25', 'images/products/ttracing-maxx-pro-air-threads.jpg'),
(23, 'TTRacing Maxx Gaming Chair', 'Gaming Chairs', 'Comfortable racing-style gaming chair.', 'The TTRacing Maxx Gaming Chair offers the perfect balance of style, comfort, and durability. Inspired by professional racing seats, it features ergonomic lumbar support, thick foam padding, adjustable armrests, and a reclining backrest for personalized comfort. Built with premium materials and a sturdy steel frame, the chair provides dependable support for gaming, remote work, and everyday productivity while enhancing the look of any gaming setup.', 16599.00, 15, 1, '2026-07-09 07:33:25', 'images/products/ttracing-maxx.jpg'),
(24, 'TTRacing Maxx Air Threads Fabric Gaming Chair', 'Gaming Chairs', 'Fabric gaming chair with ergonomic support.', 'The TTRacing Maxx Air Threads Fabric Gaming Chair is designed to provide superior airflow and all-day comfort. Its breathable fabric upholstery minimizes heat buildup while the ergonomic design supports proper posture throughout long gaming or work sessions. Adjustable reclining, comfortable lumbar support, premium cushioning, and durable construction make this chair an excellent choice for users seeking lasting comfort and modern style.', 17099.00, 12, 1, '2026-07-09 07:33:25', 'images/products/ttracing-maxx-air-threads.jpg'),
(25, 'DXRACER DRIFTING Series', 'Gaming Chairs', 'DXRacer Drifting Series gaming chair.', 'The DXRACER DRIFTING Series Gaming Chair delivers professional-grade ergonomics with a sleek racing-inspired design. Featuring high-density foam padding, adjustable lumbar and headrest cushions, reclining functionality, and a durable steel frame, it offers exceptional comfort and stability during long gaming sessions. The premium upholstery and precision engineering make it a trusted seating solution for gamers, content creators, and professionals.', 18999.00, 10, 1, '2026-07-09 07:33:25', 'images/products/dxracer-drifting-series.jpg'),
(26, 'DXRACER CRAFT Series', 'Gaming Chairs', 'DXRacer Craft Series gaming chair.', 'The DXRACER CRAFT Series Gaming Chair combines luxury materials with advanced ergonomic engineering. Designed for users who demand premium comfort, it features memory foam cushions, adjustable 4D armrests, synchronized reclining, and an exceptionally durable steel frame. Every component is crafted to reduce fatigue while maximizing support, making it an excellent investment for gaming, streaming, and professional work environments.', 24999.00, 8, 1, '2026-07-09 07:33:25', 'images/products/dxracer-craft-series.jpg'),
(27, 'DXRACER MARTIAN Series', 'Gaming Chairs', 'Premium DXRacer Martian Series gaming chair.', 'The DXRACER MARTIAN Series represents the next generation of premium gaming chairs. Featuring integrated lumbar adjustment, magnetic memory foam headrest, advanced ergonomic engineering, premium upholstery, and a robust aluminum base, it provides unmatched comfort and support. Designed for serious gamers and professionals, the MARTIAN Series offers innovative features that enhance both performance and everyday seating comfort.', 31999.00, 5, 1, '2026-07-09 07:33:25', 'images/products/dxracer-martian-series.png\r\n'),
(28, 'DXRACER TANK Series', 'Gaming Chairs', 'Heavy-duty DXRacer Tank Series gaming chair.', 'Designed for larger users and maximum stability, the DXRACER TANK Series Gaming Chair offers an oversized seat, reinforced steel frame, high-density foam padding, and exceptional ergonomic support. Adjustable reclining, 4D armrests, and premium construction ensure superior comfort throughout extended gaming and work sessions. Its heavy-duty build makes it one of the most durable gaming chairs available.', 29999.00, 6, 1, '2026-07-09 07:33:25', 'images/products/dxracer-tank-series.jpg'),
(29, 'DXRACER BLADE Series', 'Gaming Chairs', 'DXRacer Blade Series gaming chair.', 'The DXRACER BLADE Series Gaming Chair is engineered to deliver premium ergonomics with a modern and sophisticated appearance. Featuring adjustable lumbar support, memory foam cushioning, reclining functionality, and precision-built components, it promotes healthy posture while maximizing comfort. Its durable construction and refined design make it suitable for gamers, office professionals, and content creators seeking premium seating performance.', 21999.00, 8, 1, '2026-07-09 07:33:25', 'images/products/dxracer-blade-series.jpg'),
(30, 'DXRACER FORMULA Series', 'Gaming Chairs', 'Classic DXRacer Formula Series gaming chair.', 'The DXRACER FORMULA Series Gaming Chair is a classic racing-inspired chair designed for everyday comfort and reliability. Equipped with ergonomic lumbar and neck cushions, adjustable reclining, smooth height adjustment, and durable caster wheels, it provides excellent support for long hours of gaming, studying, or working. Combining iconic styling with dependable construction, the FORMULA Series remains a favorite choice for gamers around the world.', 16999.00, 12, 1, '2026-07-09 07:33:25', 'images/products/dxracer-formula-series.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `role` enum('buyer','admin') NOT NULL DEFAULT 'buyer',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verify_token` varchar(64) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password_hash`, `address`, `contact_number`, `role`, `is_verified`, `verify_token`, `is_active`, `date_created`) VALUES
(3, 'CyberVision Administrator', 'cybervision@admin.com', '$2y$10$id12TtbYlwLqYa1/MTvmbuHqTWrmQBUHlCrwNbqTg9U5wUG6Siaai', 'CyberVision Office', '09170000000', 'admin', 1, NULL, 1, '2026-07-10 05:21:53'),
(15, 'Joschka Atabelo', 'calojos354@suahi.com', '$2y$10$qrRgihZQcggCs/EluArfjOEmBugLHpdI7wJLQeZDrYlHJRFvQLl2a', 'Caloocan City', '09170000000', 'buyer', 1, NULL, 1, '2026-07-16 12:16:03'),
(16, 'Art Panulde', 'mejeb66862@suahi.com', '$2y$10$jl5sn00Vw.aQGv4ZqjmrmOysJjOOllAa3Q54IEUtTTAjv9eg2dqeK', 'Makati City', '09170000001', 'buyer', 1, NULL, 1, '2026-07-16 12:17:37'),
(17, 'Carl Vitalista', 'jefixa3451@rapplo.com', '$2y$10$wh6qAhx.4AIZPADQcTgIU.BK0/KBB.CGbeoQObbZfNAzaMYdVIoLi', 'Manila City', '09170000002', 'buyer', 1, NULL, 1, '2026-07-16 12:19:02'),
(19, 'Jose Gerard Joaquin S. Soriano', 'xanowal653@rapplo.com', '$2y$10$7/ULDtssKvdhrlB5v2VKOuX7SI.IoWD1YtYoNvoy6GYaYz1VbvSbe', '57C Rivera St. Brgy 163 Baesa Caloocan City', '09169551858', 'buyer', 1, NULL, 1, '2026-07-17 12:32:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
