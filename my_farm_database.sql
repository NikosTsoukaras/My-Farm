-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 08:13 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_type_id` int(11) NOT NULL,
  `animal_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_type_id`, `animal_type`) VALUES
(1, 'Αγελάδα '),
(2, 'Πρόβατο'),
(3, 'Αίγα'),
(4, 'Χοίρος');

-- --------------------------------------------------------

--
-- Table structure for table `animals_group_ages`
--

CREATE TABLE `animals_group_ages` (
  `animal_age_id` int(10) NOT NULL,
  `animal_age_range` varchar(256) NOT NULL,
  `animal_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals_group_ages`
--

INSERT INTO `animals_group_ages` (`animal_age_id`, `animal_age_range`, `animal_type_id`) VALUES
(1, '0 έως 8-10 μηνών', 1),
(2, '10 μηνών έως 24 μηνών', 1),
(3, '> 24 μηνών', 1),
(4, '0 έως 4-6 μηνών', 2),
(5, '4-6 μηνών έως 12-18 μηνών', 2),
(6, '12-18 μηνών έως 24 μηνών', 2),
(8, '-', 4),
(9, '> 24 μηνών', 2),
(10, '0 έως 4-6 μηνών', 3),
(11, '4-6 μηνών έως 12-18 μηνών', 3),
(12, '12-18 μηνών έως 24 μηνών', 3),
(13, '24 μηνών έως 36 μηνών', 3),
(14, '> 36 μηνών', 3);

-- --------------------------------------------------------

--
-- Table structure for table `animal_species`
--

CREATE TABLE `animal_species` (
  `animal_species_id` int(11) NOT NULL,
  `animal_species_name` varchar(255) NOT NULL,
  `animal_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal_species`
--

INSERT INTO `animal_species` (`animal_species_id`, `animal_species_name`, `animal_type_id`) VALUES
(5, 'Ελληνική φυλή', 1),
(6, 'Holstein', 1),
(7, 'Jersey', 1),
(8, 'Friesian', 1),
(9, 'Holstein - Friesian', 1),
(10, 'Simmental', 1),
(11, 'Angus ', 1),
(12, 'Charolaise', 1),
(13, 'Limousine ', 1),
(14, 'Καραγκούνικο', 2),
(15, 'Φριζάρτα', 2),
(16, 'Χίου', 2),
(17, 'Λακών', 2),
(18, 'Awassi', 2),
(19, 'Assaf', 2),
(20, 'Εγχώρια ελληνική φυλή', 3),
(21, 'Alpine', 3),
(22, 'Δαμασκού', 3),
(23, 'Angora', 3),
(24, 'Saanen', 3),
(25, 'Duroc', 4),
(26, 'Large white', 4),
(27, 'Landrace', 4),
(28, 'Pietrain', 4);

-- --------------------------------------------------------

--
-- Table structure for table `economics`
--

CREATE TABLE `economics` (
  `economics_id` int(11) NOT NULL,
  `type` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `economics`
--

INSERT INTO `economics` (`economics_id`, `type`, `amount`, `description`, `date`, `user_id`) VALUES
(96, 'income', '224', 'Γαλακτοπαραγωγή', '2020-06-16', 32),
(97, 'income', '220', 'Γαλακτοπαραγωγή', '2020-06-17', 32),
(98, 'income', '171', 'Γαλακτοπαραγωγή', '2020-06-18', 32),
(99, 'income', '0.04000000000000001', 'Γαλακτοπαραγωγή', '2020-06-23', 32),
(100, 'income', '3.5', 'Γαλακτοπαραγωγή', '2020-06-23', 32),
(101, 'income', '770', 'Κρεατοπαραγωγή', '2020-06-23', 32),
(102, 'income', '80', 'Κρεατοπαραγωγή', '2020-06-23', 32),
(103, 'outgoings', '155.00', 'Δ.Ε.Η', '2020-06-23', 32),
(118, 'income', '5000', 'Γαλακτοπαραγωγή', '2020-06-27', 35),
(119, 'income', '53.5', 'Γαλακτοπαραγωγή', '2020-06-27', 35),
(120, 'outgoings', '50.00', 'Δ.Ε.Η', '2020-06-27', 35),
(121, 'income', '400', 'Κρεατοπαραγωγή', '2020-06-27', 35),
(122, 'income', '2', 'Γαλακτοπαραγωγή', '2020-07-16', 32);

-- --------------------------------------------------------

--
-- Table structure for table `meat_production`
--

CREATE TABLE `meat_production` (
  `slaughter_id` int(11) NOT NULL,
  `animal_id` varchar(256) NOT NULL,
  `total_weight` varchar(255) NOT NULL,
  `net_weight` varchar(255) NOT NULL,
  `price_kilo` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `inspection` varchar(255) NOT NULL,
  `slaughterhouse` varchar(255) NOT NULL,
  `slaughter_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meat_production`
--

INSERT INTO `meat_production` (`slaughter_id`, `animal_id`, `total_weight`, `net_weight`, `price_kilo`, `total_price`, `inspection`, `slaughterhouse`, `slaughter_date`, `user_id`) VALUES
(27, '1023470003', '310.00', '220.00', '3.50', '770', 'Ναι', 'ΣΦΑΓΕΙΑ ΚΑΡΔΙΤΣΑΣ Α.Ε.', '2020-06-23', 32),
(28, '1023450001', '15.00', '10.00', '8.00', '80', 'Ναι', 'ΣΦΑΓΕΙΑ ΚΑΡΔΙΤΣΑΣ Α.Ε.', '2020-06-23', 32),
(36, '2023450001', '500', '200', '2.00', '400', 'Ναι', 'ΣΦΑΓΕΙΑ ΚΑΡΔΙΤΣΑΣ Α.Ε.', '2020-06-27', 35);

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

CREATE TABLE `medical` (
  `medical_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `species` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `notes` varchar(256) NOT NULL,
  `vet_contact` varchar(50) NOT NULL,
  `assessment` varchar(50) NOT NULL,
  `inspection_details` varchar(50) NOT NULL,
  `animal_id` varchar(50) NOT NULL,
  `animals_number` varchar(50) NOT NULL,
  `vet_notes` varchar(256) NOT NULL,
  `age_group` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical`
--

INSERT INTO `medical` (`medical_id`, `title`, `type`, `species`, `date`, `notes`, `vet_contact`, `assessment`, `inspection_details`, `animal_id`, `animals_number`, `vet_notes`, `age_group`, `user_id`) VALUES
(9, 'Απώλεια βάρους', 'Χοίρος', 'Large white', '2020-06-17', 'Καχεκτικά ζώα, Μειωμένη ημερήσια αύξηση σωματικού βάρους', 'Ναι', 'Μέτρια', 'Ηλιακό Γρουπ (συγεκριμένος αριθμό ζώων)', '-', '5', 'Αντιπαρασιτική αγωγή', '-', 32),
(10, 'Απώλεια βάρους_2', 'Χοίρος', 'Large white', '2020-06-23', 'Σχόλια ', 'Όχι', 'Μέτρια', 'Ηλιακό Γρουπ (συγεκριμένος αριθμό ζώων)', '-', '5', '-', '-', 32),
(14, 'Διάρροια', 'Πρόβατο', 'Καραγκούνικο', '2020-06-27', 'Σχόλια ', 'Όχι', 'Μέτρια', 'Ολόκληρο Ηλιακό Γρουπ', '-', '-', '-', '-', 35),
(15, 'Διάρροια_2', 'Πρόβατο', 'Καραγκούνικο', '2020-06-27', 'New', 'Ναι', 'Μέτρια', 'Ολόκληρο Ηλιακό Γρουπ', '-', '-', 'Οδηγίες Κτηνιάτρου', '-', 35);

-- --------------------------------------------------------

--
-- Table structure for table `milk_production`
--

CREATE TABLE `milk_production` (
  `production_id` int(11) NOT NULL,
  `milk_date` date DEFAULT NULL,
  `milk_type` text NOT NULL,
  `milk_quantity` varchar(256) NOT NULL,
  `milk_cellulars` varchar(256) NOT NULL,
  `milk_protein` varchar(256) NOT NULL,
  `milk_fat` varchar(256) NOT NULL,
  `milk_price` varchar(256) NOT NULL,
  `milk_sum` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `milk_production`
--

INSERT INTO `milk_production` (`production_id`, `milk_date`, `milk_type`, `milk_quantity`, `milk_cellulars`, `milk_protein`, `milk_fat`, `milk_price`, `milk_sum`, `user_id`) VALUES
(30, '2020-06-16', 'Αγελάδα', '560.00', '1', '3.30', '4.90', '0.40', '224', 32),
(31, '2020-06-17', 'Αγελάδα', '550.00', '1', '3.40', '4.80', '0.40', '220', 32),
(32, '2020-06-18', 'Αγελάδα', '570.00', '2', '3.20', '5.00', '0.30', '171', 32),
(42, '2020-06-27', 'Πρόβατο', '100.00', '2', '12.50', '11.30', '50.00', '5000', 35),
(43, '2020-06-27', 'Αίγια', '5.00', '2', '0.70', '0.20', '10.70', '53.5', 35),
(44, '2020-07-16', 'Αγελάδα', '0.40', '2', '0.30', '11.30', '5.00', '2', 32);

-- --------------------------------------------------------

--
-- Table structure for table `reproduction`
--

CREATE TABLE `reproduction` (
  `reproduction_id` int(11) NOT NULL,
  `animal_id` varchar(256) NOT NULL,
  `birth_day` date NOT NULL,
  `infants_number` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reproduction`
--

INSERT INTO `reproduction` (`reproduction_id`, `animal_id`, `birth_day`, `infants_number`, `user_id`) VALUES
(47, '2023450002', '2020-06-27', '4', 35),
(48, '1023450014', '2020-06-19', '3', 32),
(49, '1023450014', '2020-05-28', '10', 32);

-- --------------------------------------------------------

--
-- Table structure for table `reproduction_statics`
--

CREATE TABLE `reproduction_statics` (
  `reproduction_statics_id` int(11) NOT NULL,
  `animal_id` varchar(256) NOT NULL,
  `births_number` varchar(256) NOT NULL,
  `average_infants` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reproduction_statics`
--

INSERT INTO `reproduction_statics` (`reproduction_statics_id`, `animal_id`, `births_number`, `average_infants`, `user_id`) VALUES
(11, '2023450002', '1', '4', 35),
(12, '1023450014', '2', '6.50', 32);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_name`, `user_pwd`) VALUES
(32, 'lef@gmail.com', 'Λευτέρης Μελέτης', '$2y$10$wktXc.cUJhh1LAXQkw8bIuUuN98bq0nY2weukewW5Bzb3b3YcfNTq'),
(35, 'test@gmail.com', 'Τσουκάς Νίκος', '$2y$10$vgopyO7t5ADXUv7rvnn3cuwj1.edXT6A3B..IiGxaDKIMxEqDsjhe'),
(40, 'zapatodanado@gmail.com', 'ΤΣΟΥΚΑΡΑΣ ΦΙΛΙΠΠΟΣ', '$2y$10$/jc2yORMRvO6oRlMcp7pFedu2obIDI5l0DeT/Kub0AuvLWVVjmXK.');

-- --------------------------------------------------------

--
-- Table structure for table `users_animals`
--

CREATE TABLE `users_animals` (
  `animal_id` int(11) NOT NULL,
  `animal_un_number` varchar(256) NOT NULL,
  `animal_sex` varchar(100) NOT NULL,
  `animal_type` varchar(100) NOT NULL,
  `animal_species` varchar(100) NOT NULL,
  `animal_age_group` varchar(100) NOT NULL,
  `animal_birth` date DEFAULT NULL,
  `animal_vaccination` varchar(256) NOT NULL,
  `animal_register_date` date NOT NULL,
  `animal_deleted` tinyint(1) NOT NULL,
  `animal_updated` tinyint(2) NOT NULL,
  `animal_mother` varchar(256) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_animals`
--

INSERT INTO `users_animals` (`animal_id`, `animal_un_number`, `animal_sex`, `animal_type`, `animal_species`, `animal_age_group`, `animal_birth`, `animal_vaccination`, `animal_register_date`, `animal_deleted`, `animal_updated`, `animal_mother`, `user`) VALUES
(100, '1023450001', 'Αρσενικό', 'Πρόβατο', 'Καραγκούνικο', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 1, 0, '', 32),
(101, '1023450002', 'Αρσενικό', 'Πρόβατο', 'Καραγκούνικο', '0 έως 4-6 μηνών', '2020-06-01', 'Όχι', '2020-06-23', 0, 0, '', 32),
(102, '1023450003', 'Αρσενικό', 'Πρόβατο', 'Καραγκούνικο', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(103, '1023450004', 'Αρσενικό', 'Πρόβατο', 'Καραγκούνικο', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(104, '1023450005', 'Αρσενικό', 'Πρόβατο', 'Καραγκούνικο', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(105, '1023450006', 'Αρσενικό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(106, '1023450007', 'Αρσενικό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(107, '1023450008', 'Αρσενικό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(108, '1023450009', 'Αρσενικό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(109, '1023450010', 'Αρσενικό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(110, '1023450011', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(111, '1023450012', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(112, '1023450013', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(113, '1023450014', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(114, '1023450015', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(115, '1023450016', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(116, '1023450017', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(117, '1023450018', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(118, '1023450019', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(119, '1023450020', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(120, '1023450021', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(121, '1023450022', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(122, '1023450023', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(123, '1023450024', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(124, '1023450025', 'Θηλυκό', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(125, '1023450026', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(126, '1023450027', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(127, '1023450028', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(128, '1023450029', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(129, '1023450030', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(130, '1023450031', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(131, '1023450032', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(132, '1023450033', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(133, '1023450034', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(134, '1023450035', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(135, '1023450036', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(136, '1023450037', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(137, '1023450038', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(138, '1023450039', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(139, '1023450040', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(140, '1023450041', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(141, '1023450042', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(142, '1023450043', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(143, '1023450044', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(144, '1023450045', 'Θηλυκό', 'Πρόβατο', 'Awassi', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(145, '1023450046', 'Θηλυκό', 'Πρόβατο', 'Λακών', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(146, '1023450047', 'Θηλυκό', 'Πρόβατο', 'Λακών', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(147, '1023450048', 'Θηλυκό', 'Πρόβατο', 'Λακών', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(148, '1023450049', 'Θηλυκό', 'Πρόβατο', 'Λακών', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(149, '1023450050', 'Θηλυκό', 'Πρόβατο', 'Λακών', '12-18 μηνών έως 24 μηνών', '2019-11-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(150, '1023460001', 'Αρσενικό', 'Αγελάδα', 'Holstein', '0 έως 8-10 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(151, '1023460002', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(152, '1023460003', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(153, '1023460004', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(154, '1023460005', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(155, '1023460006', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(156, '1023460007', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(157, '1023460008', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(158, '1023460009', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(159, '1023460010', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(160, '1023460011', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(161, '1023460012', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(162, '1023460013', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(163, '1023460014', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(164, '1023460015', 'Θηλυκό', 'Αγελάδα', 'Holstein', '> 24 μηνών', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(165, '1023470001', 'Θηλυκό', 'Χοίρος', 'Large white', '-', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(166, '1023470002', 'Θηλυκό', 'Χοίρος', 'Large white', '-', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(167, '1023470003', 'Θηλυκό', 'Χοίρος', 'Large white', '-', '2018-01-01', 'Ναι', '2020-06-23', 1, 0, '', 32),
(168, '1023470004', 'Θηλυκό', 'Χοίρος', 'Large white', '-', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(169, '1023470005', 'Αρσενικό', 'Χοίρος', 'Duroc', '-', '2018-01-01', 'Ναι', '2020-06-23', 0, 0, '', 32),
(171, '1023450051', 'Αρσενικό', 'Αίγα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-02', 'Ναι', '2020-06-26', 0, 0, '', 32),
(172, '1023450052', 'Θηλυκό', 'Αίγα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-02', 'Ναι', '2020-06-26', 0, 0, '', 32),
(173, '1023450053', 'Θηλυκό', 'Αίγα', 'Δαμασκού', '12-18 μηνών έως 24 μηνών', '2020-06-02', 'Ναι', '2020-06-26', 0, 0, '', 32),
(174, '1023450055', 'Αρσενικό', 'Αίγα', 'Δαμασκού', '12-18 μηνών έως 24 μηνών', '2020-06-02', 'Ναι', '2020-06-26', 0, 0, '', 32),
(211, '2023450001', 'Αρσενικό', 'Αγελάδα', 'Ελληνική φυλή', '0 έως 8-10 μηνών', '2020-06-03', 'Ναι', '2020-06-27', 1, 0, '', 35),
(212, '2023450002', 'Θηλυκό', 'Αίγα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-03', 'Ναι', '2020-06-27', 0, 0, '', 35),
(213, '2023450003', 'Θηλυκό', 'Αγελάδα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-27', 'Ναι', '2020-06-27', 0, 0, '2023450002', 35),
(214, '2023450004', '', 'Αίγα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-27', 'Εκκρεμεί', '2020-06-27', 0, 0, '2023450002', 35),
(215, '2023450005', '', 'Αίγα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-27', 'Εκκρεμεί', '2020-06-27', 0, 0, '2023450002', 35),
(216, '2023450006', '', 'Αίγα', 'Εγχώρια ελληνική φυλή', '0 έως 4-6 μηνών', '2020-06-27', 'Εκκρεμεί', '2020-06-27', 0, 0, '2023450002', 35),
(217, '1023470006', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-19', 'Εκκρεμεί', '2020-06-19', 0, 0, '1023450014', 32),
(218, '1023470007', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-19', 'Εκκρεμεί', '2020-06-19', 0, 0, '1023450014', 32),
(219, '1023470008', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-06-19', 'Εκκρεμεί', '2020-06-19', 0, 0, '1023450014', 32),
(220, '1023470009', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(221, '1023470010', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(222, '1023470011', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(223, '1023470012', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(224, '1023470013', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(225, '1023470014', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(226, '1023470015', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(227, '1023470016', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(228, '1023470017', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(229, '1023470018', '', 'Πρόβατο', 'Assaf', '0 έως 4-6 μηνών', '2020-05-28', 'Εκκρεμεί', '2020-05-28', 0, 0, '1023450014', 32),
(230, '1023460080', 'Αρσενικό', 'Αγελάδα', 'Ελληνική φυλή', '0 έως 8-10 μηνών', '2020-07-15', 'Ναι', '2020-07-15', 0, 0, '', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_type_id`);

--
-- Indexes for table `animals_group_ages`
--
ALTER TABLE `animals_group_ages`
  ADD PRIMARY KEY (`animal_age_id`),
  ADD KEY `fk` (`animal_type_id`);

--
-- Indexes for table `animal_species`
--
ALTER TABLE `animal_species`
  ADD PRIMARY KEY (`animal_species_id`),
  ADD KEY `animal_type_id` (`animal_type_id`);

--
-- Indexes for table `economics`
--
ALTER TABLE `economics`
  ADD PRIMARY KEY (`economics_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meat_production`
--
ALTER TABLE `meat_production`
  ADD PRIMARY KEY (`slaughter_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`medical_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `milk_production`
--
ALTER TABLE `milk_production`
  ADD PRIMARY KEY (`production_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reproduction`
--
ALTER TABLE `reproduction`
  ADD PRIMARY KEY (`reproduction_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reproduction_statics`
--
ALTER TABLE `reproduction_statics`
  ADD PRIMARY KEY (`reproduction_statics_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_animals`
--
ALTER TABLE `users_animals`
  ADD PRIMARY KEY (`animal_id`),
  ADD UNIQUE KEY `animal_un_number` (`animal_un_number`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `animals_group_ages`
--
ALTER TABLE `animals_group_ages`
  MODIFY `animal_age_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `animal_species`
--
ALTER TABLE `animal_species`
  MODIFY `animal_species_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `economics`
--
ALTER TABLE `economics`
  MODIFY `economics_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `meat_production`
--
ALTER TABLE `meat_production`
  MODIFY `slaughter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `medical`
--
ALTER TABLE `medical`
  MODIFY `medical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `milk_production`
--
ALTER TABLE `milk_production`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reproduction`
--
ALTER TABLE `reproduction`
  MODIFY `reproduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `reproduction_statics`
--
ALTER TABLE `reproduction_statics`
  MODIFY `reproduction_statics_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users_animals`
--
ALTER TABLE `users_animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals_group_ages`
--
ALTER TABLE `animals_group_ages`
  ADD CONSTRAINT `fk` FOREIGN KEY (`animal_type_id`) REFERENCES `animals` (`animal_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `animal_species`
--
ALTER TABLE `animal_species`
  ADD CONSTRAINT `animal_type_id` FOREIGN KEY (`animal_type_id`) REFERENCES `animals` (`animal_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `economics`
--
ALTER TABLE `economics`
  ADD CONSTRAINT `economics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meat_production`
--
ALTER TABLE `meat_production`
  ADD CONSTRAINT `meat_production_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `users_animals` (`animal_un_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meat_production_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical`
--
ALTER TABLE `medical`
  ADD CONSTRAINT `medical_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `milk_production`
--
ALTER TABLE `milk_production`
  ADD CONSTRAINT `milk_production_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reproduction`
--
ALTER TABLE `reproduction`
  ADD CONSTRAINT `reproduction_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `users_animals` (`animal_un_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reproduction_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reproduction_statics`
--
ALTER TABLE `reproduction_statics`
  ADD CONSTRAINT `reproduction_statics_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `users_animals` (`animal_un_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reproduction_statics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_animals`
--
ALTER TABLE `users_animals`
  ADD CONSTRAINT `users_animals_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
