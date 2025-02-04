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

-- Drop the database if it already exists
DROP DATABASE IF EXISTS task_management_db;
CREATE DATABASE task_management_db;
USE task_management_db;

-- 🔹 Users Table (Employees, Managers, Admins)
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       full_name VARCHAR(255) NOT NULL,
                       username VARCHAR(100) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       role ENUM('admin', 'manager', 'employee') NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 🔹 Kunden Table (Clients)
CREATE TABLE kunden (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(255) NOT NULL,
                        vorname VARCHAR(255) NOT NULL,
                        adresse VARCHAR(255) NOT NULL,
                        plz VARCHAR(10) NOT NULL,
                        ort VARCHAR(100) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 🔹 Objekte Table (Linked to Kunden)
CREATE TABLE objekte (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         kunde_id INT,
                         adresse VARCHAR(255) NOT NULL,
                         plz VARCHAR(10) NOT NULL,
                         ort VARCHAR(100) NOT NULL,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         FOREIGN KEY (kunde_id) REFERENCES kunden(id) ON DELETE CASCADE
);

-- 🔹 Tasks Table (Linked to Users, Kunden, and Objekte)
CREATE TABLE tasks (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       title VARCHAR(255) NOT NULL,
                       description TEXT NOT NULL,
                       assigned_to INT NOT NULL,
                       due_date DATE NULL,
                       kunde_id INT NULL,
                       objekt_id INT NULL,
                       status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
                       images JSON NULL,
                       document VARCHAR(255) NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE CASCADE,
                       FOREIGN KEY (kunde_id) REFERENCES kunden(id) ON DELETE SET NULL,
                       FOREIGN KEY (objekt_id) REFERENCES objekte(id) ON DELETE SET NULL
);

-- 🔹 Notifications Table (For Task Assignment)
CREATE TABLE notifications (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               user_id INT NOT NULL,
                               message TEXT NOT NULL,
                               type ENUM('task_assignment', 'invoice_generated', 'general') NOT NULL,
                               is_read BOOLEAN DEFAULT FALSE,
                               date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                               FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 🔹 Invoices Table (Linked to Kunden and Tasks)
CREATE TABLE invoices (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          kunde_id INT NOT NULL,
                          task_id INT NOT NULL,
                          total_cost DECIMAL(10,2) NOT NULL,
                          status ENUM('pending', 'paid', 'overdue') DEFAULT 'pending',
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (kunde_id) REFERENCES kunden(id) ON DELETE CASCADE,
                          FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
);

-- 🔹 Insert Sample Data (Optional)
INSERT INTO users (full_name, username, password, role) VALUES
                                                            ('Admin User', 'admin', '123', 'admin'),
                                                            ('Manager User', 'manager', '123', 'manager'),
                                                            ('Employee User', 'employee', '123', 'employee');

INSERT INTO kunden (name, vorname, adresse, plz, ort) VALUES
                                                          ('Müller', 'Hans', 'Hauptstr. 1', '10115', 'Berlin'),
                                                          ('Schmidt', 'Anna', 'Nebenstr. 10', '50667', 'Köln');

INSERT INTO objekte (kunde_id, adresse, plz, ort) VALUES
                                                      (1, 'Hauptstr. 1', '10115', 'Berlin'),
                                                      (2, 'Nebenstr. 10', '50667', 'Köln');

INSERT INTO tasks (title, description, assigned_to, due_date, kunde_id, objekt_id, status) VALUES
                                                                    ('Fix Plumbing', 'Repair sink leak', 3, '2024-02-10', 1, 1, 'pending'),
                                                                    ('Install Heater', 'Install new heating system', 3, '2024-02-15', 2, 2, 'in_progress');

INSERT INTO notifications (user_id, message, type) VALUES
                                                       (3, 'You have been assigned a new task: Fix Plumbing', 'task_assignment'),
                                                       (3, 'You have been assigned a new task: Install Heater', 'task_assignment');

INSERT INTO invoices (kunde_id, task_id, total_cost, status) VALUES
                                                                 (1, 1, 250.00, 'pending'),
                                                                 (2, 2, 600.00, 'paid');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
