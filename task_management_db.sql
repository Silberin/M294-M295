--
-- Database: `task_management_db`
--
CREATE DATABASE IF NOT EXISTS `task_management_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `task_management_db`;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
                            `id` int(11) NOT NULL,
                            `kunde_id` int(11) NOT NULL,
                            `task_id` int(11) NOT NULL,
                            `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
                            `total_cost` decimal(10,2) NOT NULL,
                            `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `kunde_id`, `task_id`, `date_created`, `total_cost`, `description`) VALUES
                                                                                                      (1, 1, 29, '2025-02-04 12:12:00', 1.00, '1'),
                                                                                                      (2, 1, 29, '2025-02-04 12:17:06', 1.00, '1'),
                                                                                                      (3, 1, 29, '2025-02-04 12:37:00', 1.00, 'f');

-- --------------------------------------------------------

--
-- Table structure for table `kunde`
--

CREATE TABLE `kunde` (
                         `id` int(11) NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `vorname` varchar(255) NOT NULL,
                         `adresse` varchar(255) NOT NULL,
                         `plz` varchar(10) NOT NULL,
                         `ort` varchar(255) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kunde`
--

INSERT INTO `kunde` (`id`, `name`, `vorname`, `adresse`, `plz`, `ort`, `created_at`) VALUES
    (1, 'Shkeli', 'Kopferteli', 'eisenburgstrasse 1', '8854', 'Sibenen', '2025-02-04 11:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
                                 `id` int(11) NOT NULL,
                                 `user_id` int(11) NOT NULL,
                                 `message` text NOT NULL,
                                 `recipient` int(11) NOT NULL,
                                 `type` varchar(50) NOT NULL,
                                 `date` date NOT NULL DEFAULT current_timestamp(),
                                 `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `recipient`, `type`, `date`, `is_read`) VALUES
                                                                                                     (1, 0, '\'Leckage in der Küche reparieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-21', 1),
                                                                                                     (2, 0, '\'Wasserleitung im Badezimmer ersetzen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-22', 1),
                                                                                                     (3, 0, '\'Heizkessel warten\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-23', 1),
                                                                                                     (4, 0, '\'Toilette reparieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-24', 0),
                                                                                                     (5, 0, '\'Wasserenthärter installieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-25', 1),
                                                                                                     (6, 0, '\'Abflussrohr reinigen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-26', 1),
                                                                                                     (7, 0, '\'Warmwasserbereiter ersetzen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-27', 1),
                                                                                                     (8, 0, '\'Dusche installieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-28', 0),
                                                                                                     (9, 0, '\'Küchenspüle austauschen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-29', 0),
                                                                                                     (10, 0, '\'Wasserfilter warten\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-30', 0),
                                                                                                     (11, 0, '\'Außenwasserhahn reparieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-31', 0),
                                                                                                     (12, 0, '\'Badewanne installieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-02-01', 0),
                                                                                                     (13, 0, '\'Kellerpumpe überprüfen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-02-02', 0),
                                                                                                     (14, 0, '\'Gasleitung überprüfen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-02-03', 0),
                                                                                                     (17, 0, '\'Cyberpunk 2077 furry roleplay\' has been assigned to you. Please review and start working on it', 17, 'New Task Assigned', '2025-02-02', 1),
                                                                                                     (18, 0, '\'silver\' has been assigned to you. Please review and start working on it', 17, 'New Task Assigned', '2025-02-02', 1),
                                                                                                     (19, 19, 'A new task \'e\' has been assigned to you.', 0, 'task_assignment', '2025-02-04', 0),
                                                                                                     (20, 19, 'You have been assigned a new task: e', 0, 'task_assignment', '2025-02-04', 0),
                                                                                                     (21, 19, 'You have been assigned a new task: rr', 0, 'task_assignment', '2025-02-04', 0),
                                                                                                     (22, 19, 'You have been assigned a new task: g', 0, 'task_assignment', '2025-02-04', 0),
                                                                                                     (23, 17, 'You have been assigned a new task: g', 0, 'task_assignment', '2025-02-04', 0),
                                                                                                     (24, 19, 'You have been assigned a new task: hh', 0, 'task_assignment', '2025-02-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `objekt`
--

CREATE TABLE `objekt` (
                          `id` int(11) NOT NULL,
                          `adresse` varchar(255) NOT NULL,
                          `plz` varchar(10) NOT NULL,
                          `ort` varchar(255) NOT NULL,
                          `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                          `kunde_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `objekt`
--

INSERT INTO `objekt` (`id`, `adresse`, `plz`, `ort`, `created_at`, `kunde_id`) VALUES
    (1, 'eisenburgstrasse', '882', 'twin tower', '2025-02-04 11:18:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
                         `id` int(11) NOT NULL,
                         `title` varchar(100) NOT NULL,
                         `description` text DEFAULT NULL,
                         `assigned_to` int(11) DEFAULT NULL,
                         `due_date` date DEFAULT NULL,
                         `status` enum('pending','in_progress','completed') DEFAULT 'pending',
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                         `document` varchar(255) DEFAULT NULL,
                         `image` varchar(255) DEFAULT NULL,
                         `images` text DEFAULT NULL,
                         `kunde_id` int(11) DEFAULT NULL,
                         `objekt_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `due_date`, `status`, `created_at`, `document`, `image`, `images`, `kunde_id`, `objekt_id`) VALUES
                                                                                                                                                                  (28, 'Cyberpunk 2077 furry roleplay', 'cum', 17, '2025-02-03', 'completed', '2025-02-02 15:54:28', 'uploads/task_28_1738517493.docx', NULL, NULL, NULL, NULL),
                                                                                                                                                                  (29, 'silver', 'cock', 17, '2025-02-11', 'completed', '2025-02-02 17:37:47', 'uploads/task_29_1738517880.docx', NULL, NULL, NULL, NULL),
                                                                                                                                                                  (30, 'look', 'test', 17, '2025-02-04', 'completed', '2025-02-03 15:21:43', '', 'uploads/images/task_1738596103.jpg', NULL, NULL, NULL),
                                                                                                                                                                  (31, 'te', 'te', 17, '0000-00-00', 'pending', '2025-02-03 15:35:01', NULL, NULL, '[\"uploads\\/images\\/task_1738596901_0.jpg\",\"uploads\\/images\\/task_1738596901_1.jpg\"]', NULL, NULL),
                                                                                                                                                                  (32, 'test', 'test', 17, '2025-02-13', 'pending', '2025-02-04 19:52:03', '', NULL, '[]', 1, 1),
                                                                                                                                                                  (33, 'test66', 'z\r\ntest66', 17, '2025-02-14', 'pending', '2025-02-04 19:52:26', '', NULL, '[\"uploads\\/images\\/task_1738698746_0.jpg\"]', 1, 1),
                                                                                                                                                                  (34, 'asd', 'asd', 17, '0000-00-00', 'pending', '2025-02-04 20:02:23', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (35, 'test', 'test', 19, '0000-00-00', 'pending', '2025-02-04 20:03:16', '', NULL, '[\"uploads\\/images\\/task_1738699396_0.jpg\"]', NULL, NULL),
                                                                                                                                                                  (36, 'test3', 'test', 19, '0000-00-00', 'pending', '2025-02-04 20:06:39', '', NULL, '[\"uploads\\/images\\/task_1738699599_0.jpg\"]', NULL, NULL),
                                                                                                                                                                  (37, 'e', 'e', 19, '0000-00-00', 'pending', '2025-02-04 20:07:18', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (38, 't', 't', 19, '0000-00-00', 'pending', '2025-02-04 20:07:32', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (39, 'e', 'e', 19, '0000-00-00', 'pending', '2025-02-04 20:08:45', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (40, 'e', 'e', 19, '0000-00-00', 'pending', '2025-02-04 20:13:17', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (41, 'rr', 'rr', 19, '0000-00-00', 'pending', '2025-02-04 20:17:08', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (42, 'g', 'g', 19, '0000-00-00', 'pending', '2025-02-04 20:20:57', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (43, 'g', 'g', 17, '0000-00-00', 'pending', '2025-02-04 20:25:46', '', NULL, '[]', NULL, NULL),
                                                                                                                                                                  (44, 'hh', 'hh', 19, '0000-00-00', 'pending', '2025-02-04 20:26:49', '', NULL, '[]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `full_name` varchar(50) NOT NULL,
                         `username` varchar(50) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `role` enum('admin','manager','employee') NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`, `created_at`) VALUES
                                                                                          (15, 'shkeli', 'admin', '$2y$10$2p22KFkOlQLxAH2uotzBceJmjU4a0kCthp39oyABD3muvyEuu3L1C', 'admin', '2025-02-02 14:45:04'),
                                                                                          (16, 'aron', 'aron', '$2y$10$5a8jmkaFGDhm/AIGF67npevukMX28OjNsXddd7.UfkjW5dutEIlBO', 'manager', '2025-02-02 15:44:20'),
                                                                                          (17, 'Alessandro Silvercock', 'ale', '$2y$10$mGYpni86jctp59lQivYvhOD5Mda0gpElbbMXcXGA/YW.REVQa4lNG', 'employee', '2025-02-02 15:53:43'),
                                                                                          (19, 'kenan g', 'kenang', '$2y$10$uiylrIt0bdX.yJ7sptw/nOJ0Pe0bQ6237.TbPNhxob5yX0sqjC/K2', 'employee', '2025-02-04 20:03:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
    ADD PRIMARY KEY (`id`),
    ADD KEY `kunde_id` (`kunde_id`),
    ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `kunde`
--
ALTER TABLE `kunde`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objekt`
--
ALTER TABLE `objekt`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_kunde` (`kunde_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
    ADD PRIMARY KEY (`id`),
    ADD KEY `assigned_to` (`assigned_to`),
    ADD KEY `fk_task_kunde` (`kunde_id`),
    ADD KEY `fk_task_objekt` (`objekt_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kunde`
--
ALTER TABLE `kunde`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `objekt`
--
ALTER TABLE `objekt`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
    ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`kunde_id`) REFERENCES `kunde` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `objekt`
--
ALTER TABLE `objekt`
    ADD CONSTRAINT `fk_kunde` FOREIGN KEY (`kunde_id`) REFERENCES `kunde` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
    ADD CONSTRAINT `fk_task_kunde` FOREIGN KEY (`kunde_id`) REFERENCES `kunde` (`id`) ON DELETE SET NULL,
    ADD CONSTRAINT `fk_task_objekt` FOREIGN KEY (`objekt_id`) REFERENCES `objekt` (`id`) ON DELETE SET NULL,
    ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`);
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;