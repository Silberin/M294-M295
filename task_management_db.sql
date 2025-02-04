SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `recipient` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `recipient`, `type`, `date`, `is_read`) VALUES
(1, '\'Leckage in der Küche reparieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-21', 1),
(2, '\'Wasserleitung im Badezimmer ersetzen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-22', 1),
(3, '\'Heizkessel warten\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-23', 1),
(4, '\'Toilette reparieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-24', 0),
(5, '\'Wasserenthärter installieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-25', 1),
(6, '\'Abflussrohr reinigen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-26', 1),
(7, '\'Warmwasserbereiter ersetzen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-27', 1),
(8, '\'Dusche installieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-28', 0),
(9, '\'Küchenspüle austauschen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-29', 0),
(10, '\'Wasserfilter warten\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-01-30', 0),
(11, '\'Außenwasserhahn reparieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-01-31', 0),
(12, '\'Badewanne installieren\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-02-01', 0),
(13, '\'Kellerpumpe überprüfen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 7, 'Neue Aufgabe zugewiesen', '2025-02-02', 0),
(14, '\'Gasleitung überprüfen\' wurde Ihnen zugewiesen. Bitte überprüfen und beginnen Sie damit.', 2, 'Neue Aufgabe zugewiesen', '2025-02-03', 0);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `due_date`, `status`, `created_at`) VALUES
(1, 'Leckage in der Küche reparieren', 'Überprüfen und reparieren Sie das Leck unter der Küchenspüle.', 7, '2025-01-21', 'completed', '2024-08-29 16:47:37'),
(4, 'Wasserleitung im Badezimmer ersetzen', 'Ersetzen Sie die alte Wasserleitung im Badezimmer durch eine neue.', 7, '2025-01-22', 'completed', '2024-08-31 10:50:20'),
(5, 'Heizkessel warten', 'Führen Sie eine jährliche Wartung des Heizkessels durch, um sicherzustellen, dass er effizient arbeitet.', 7, '2025-01-23', 'in_progress', '2024-08-31 10:50:47'),
(6, 'Toilette reparieren', 'Beheben Sie das Problem mit der undichten Toilette im Erdgeschoss.', 7, '2025-01-24', 'pending', '2024-08-31 10:51:12'),
(7, 'Wasserenthärter installieren', 'Installieren Sie einen neuen Wasserenthärter im Keller.', 2, '2025-01-25', 'completed', '2024-08-31 10:51:45'),
(8, 'Abflussrohr reinigen', 'Reinigen Sie das verstopfte Abflussrohr in der Waschküche.', 2, '2025-01-26', 'pending', '2024-08-31 10:52:11'),
(17, 'Warmwasserbereiter ersetzen', 'Ersetzen Sie den defekten Warmwasserbereiter durch ein neues Modell.', 7, '2025-01-27', 'pending', '2024-09-06 08:01:48'),
(18, 'Dusche installieren', 'Installieren Sie eine neue Dusche im Hauptbadezimmer.', 7, '2025-01-28', 'pending', '2024-09-06 08:02:27'),
(19, 'Küchenspüle austauschen', 'Tauschen Sie die alte Küchenspüle gegen eine neue aus.', 2, '2025-01-29', 'pending', '2024-09-06 08:02:59'),
(20, 'Wasserfilter warten', 'Warten Sie den Wasserfilter im Hauswirtschaftsraum.', 2, '2025-01-30', 'pending', '2024-09-06 08:03:21'),
(21, 'Außenwasserhahn reparieren', 'Reparieren Sie den undichten Außenwasserhahn im Garten.', 7, '2025-01-31', 'pending', '2024-09-06 08:03:44'),
(22, 'Badewanne installieren', 'Installieren Sie eine neue Badewanne im Gästezimmer.', 2, '2025-02-01', 'pending', '2024-09-06 08:04:20'),
(23, 'Kellerpumpe überprüfen', 'Überprüfen und warten Sie die Kellerpumpe, um Überschwemmungen zu verhindern.', 7, '2025-02-02', 'pending', '2024-09-06 08:04:39'),
(24, 'Gasleitung überprüfen', 'Überprüfen Sie die Gasleitung auf Lecks und stellen Sie sicher, dass sie sicher ist.', 2, '2025-02-03', 'pending', '2024-09-06 08:04:57');

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
(1, 'Shkelqim', 'admin', '$2y$10$TnyR1Y43m1EIWpb0MiwE8Ocm6rj0F2KojE3PobVfQDo9HYlAHY/7O', 'admin', '2024-08-28 07:10:04'),
(2, 'Resul', 'resul', '$2y$10$8xpI.hVCVd/GKUzcYTxLUO7ICSqlxX5GstSv7WoOYfXuYOO/SZAZ2', 'manager', '2024-08-28 07:10:40'),
(3, 'Ivaldo', 'ivaldo', '$2y$10$7QJ8k1Z5v1E8k1Z5v1E8k1Z5v1E8k1Z5v1E8k1Z5v1E8k1Z5v1E8k1', 'employee', '2024-08-28 07:11:00'),
(7, 'Aron', 'aron', '$2y$10$CiV/f.jO5vIsSi0Fp1Xe7ubWG9v8uKfC.VfzQr/sjb5/gypWNdlBW', 'employee', '2024-08-29 17:11:21'),
(8, 'Eleni', 'eleni', '$2y$10$E9Xx8UCsFcw44lfXxiq/5OJtloW381YJnu5lkn6q6uzIPdL5yH3PO', 'employee', '2024-08-29 17:11:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
