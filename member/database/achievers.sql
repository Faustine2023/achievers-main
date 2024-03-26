SET time_zone = "+00:00";;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
--
-- Database: `achievers_db`
--

-- --------------------------------------------------------
--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `shortName` text NOT NULL,
  `logoURL` text DEFAULT 'uploads/avatars/Image_not_available.png',
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `systemEmail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `name`, `shortName`,`logoURL`, `phone`,`address`,`systemEmail`) VALUES
(1, 'Achievers', 'Achievers','uploads/logo.png','+254-795-323-141','Nairobi, Kenya','info@achivers.org');


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT 'uploads/avatars/Image_not_available.png',
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`,  `lastname`, `email`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Administrator','Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/admin.png', NULL, 1, '2024-01-01 14:02:37', '2024-01-01 14:17:49'),
(2, 'Flevian', 'Ochoka', 'flevianochoka19@gmail.com', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/flevian.png', NULL, 2, '2024-01-01 13:17:24', '2024-01-01 13:17:25');
--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(30) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` text NOT NULL DEFAULT 0,
  `phone` text NOT NULL DEFAULT 0,
  `password` text NOT NULL,
  `avatar` text DEFAULT 'uploads/avatars/Image_not_available.png',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `avatar`, `date_added`, `date_updated`) VALUES
(1, 'Administrator', 'Admin', 'admin@gmail.com','+254-795-323-141', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/admin.png', '2024-01-01 14:02:37', '2024-01-01 14:17:49'),
(2, 'Flevian',  'Ochoka', 'flevianochoka19@gmail.com','+254-795-323-141', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/flevian.png',  '2024-01-01 13:17:24', '2024-01-01 13:17:25'),
(3, 'Faustine',  'Mudambi', 'faustinemudambi@gmail.com','+254-746-293-842', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/faustine.png',  '2024-01-01 13:17:24', '2024-01-01 13:17:25');


--
-- Create savings table
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `verify_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=Verified | 0=Not Verified',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Create savings table
--

CREATE TABLE `savings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(255),
    `saveAmmount` INT,
    `date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `email`, `saveAmmount` ) VALUES
(1, 'admin@gmail.com', 32113 ),
(2, 'flevianochoka19@gmail.com', 3211),
(3, 'flevianochoka19@gmail.com', 3211),
(4, 'flevianochoka19@gmail.com', 3211),
(5, 'faustinemudambi@gmail.com', 32113 );

-- Create Loans table
CREATE TABLE `loans` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `defaulter_email` varchar(255),
    `loanAmmount` BIGINT,
    `dueAmmount` BIGINT,
    `status` VARCHAR(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `defaulter_email`, `loanAmmount`, `dueAmmount`, `status`) VALUES
(1, 'admin@gmail.com', 3211, 2343, 'Pending'),
(2, 'flevianochoka19@gmail.com', 3211, 2343, 'Paid'),
(3, 'faustinemudambi@gmail.com', 3211, 2343, 'Pending');



-- Create Notifications table
CREATE TABLE `notifications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(255) NOT NULL,
    `message` TEXT,
    `status` INT DEFAULT 1,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `message`, `status`, `date` ) VALUES
(1, 'admin@gmail.com',  'You have succesfully openned an account with the achievers. Save and Grow with Us.', 0,'2024-01-01 14:17:49'),
(2, 'flevianochoka19@gmail.com', 'You have succesfully openned an account with the achievers. Save and Grow with Us.', 0,'2024-01-01 14:17:49'),
(3, 'faustinemudambi@gmail.com', 'You have succesfully openned an account with the achievers. Save and Grow with Us.', 0,'2024-01-01 14:17:49');



-- Create Contributions table
CREATE TABLE `contributions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255), -- Specify the length for varchar
    `status` VARCHAR(20) DEFAULT 'Pending',
    `Ammount` INT DEFAULT 3000 -- Remove quotes around the default value
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `contributions`
INSERT INTO `contributions` (`id`, `email`, `Ammount` ,`status`) VALUES
(1, 'admin@gmail.com', 3000, 'Done'),
(2, 'flevianochoka19@gmail.com', 3000, 'Done'),
(3, 'faustinemudambi@gmail.com', 3000, 'Pending');



-- Create AdminActions table
CREATE TABLE `AdminActions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `AdminName` VARCHAR(255) NOT NULL,
    `AdminEmail` VARCHAR(255) NOT NULL,
    `action` TEXT,
    `date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
    -- Add other fields as needed
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `AdminActions`
--

INSERT INTO `AdminActions` (`id`, `AdminName`, `AdminEmail`, `action` ) VALUES
(1, 'Admin', 'admin@gmail.com', 'Received Payments of 2000 from Faustine Mudambi'),
(2, 'Admin', 'admin@gmail.com', 'Received Payments of 2000 from Faustine Mudambi'),
(3, 'Admin', 'admin@gmail.com', 'Approved a loan of 4300 to terry');



-- Create memberActions table
CREATE TABLE `memberActions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `memberName` VARCHAR(255) NOT NULL,
    `memberEmail` VARCHAR(255) NOT NULL,
    `action` TEXT,
    `date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
    -- Add other fields as needed
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberActions`
--

INSERT INTO `memberActions` (`id`, `memberName`, `memberEmail`, `action` ) VALUES
(1, 'Flevian Ochoka', 'flevianochoka19@gmail.com', 'Loan of 4322 disbursed'),
(2, 'Flevian Ochoka', 'flevianochoka19@gmail.com', 'Paid for a loan of 3400'),
(3, 'Flevian Ochoka', 'flevianochoka19@gmail.com', 'Applied for a loan of 3400');





-- Create Payments table
CREATE TABLE `payments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `receivedFrom` varchar(255) NOT NULL,
    `receivedAmount` int,
    `PaymentDate` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- Create Contact table
CREATE TABLE `contact` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create reports table
CREATE TABLE `reports` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(255) NOT NULL,
    `message` TEXT,
    `status` INT DEFAULT 1,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `email`, `message`, `status`, `date` ) VALUES
(1, 'admin@gmail.com',  'You have succesfully openned an account with the achievers. Save and Grow with Us.', 0,'2024-01-01 14:17:49'),
(2, 'flevianochoka19@gmail.com', 'Contribution towards Kangethe will be upcoming.', 0,'2024-01-01 14:17:49'),
(3, 'flevianochoka19@gmail.com', 'Loan application of 3422 received wait for disbursement by the admin team.', 0,'2024-01-01 14:17:49'),
(4, 'flevianochoka19@gmail.com', 'Contribution towards Faustine completed .', 0,'2024-01-01 14:17:49'),
(5, 'flevianochoka19@gmail.com', 'Pending contribution to Faustine pending you have to pay a total of 3433.', 0,'2024-01-01 14:17:49'),
(6, 'flevianochoka19@gmail.com', 'Contribution towards Kangethe will be upcoming.', 0,'2024-01-01 14:17:49'),
(7, 'faustinemudambi@gmail.com', 'Payments of 2100 received.', 0,'2024-01-01 14:17:49');


-- Create Adverts table
CREATE TABLE `adverts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `AdText` TEXT,
    `email` TEXT,
    `date` DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Indexes for dumped tables
--


--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--


--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT;

COMMIT;