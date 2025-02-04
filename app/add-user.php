<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (isset($_POST['user_name'], $_POST['password'], $_POST['full_name'], $_POST['role'])) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $user_name = validate_input($_POST['user_name']);
        $password = validate_input($_POST['password']);
        $full_name = validate_input($_POST['full_name']);
        $role = validate_input($_POST['role']); // Get the role input

        // Ensure role is valid to prevent SQL Injection
        $valid_roles = ['admin', 'manager', 'employee'];
        if (!in_array($role, $valid_roles)) {
            header("Location: ../add-user.php?error=Invalid role selected.");
            exit();
        }

        // Input validation
        if (empty($user_name)) {
            header("Location: ../add-user.php?error=User name is required");
            exit();
        }
        if (empty($password)) {
            header("Location: ../add-user.php?error=Password is required");
            exit();
        }
        if (empty($full_name)) {
            header("Location: ../add-user.php?error=Full name is required");
            exit();
        }

        // Secure password hashing
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database
        include "Model/User.php";
        $data = array($full_name, $user_name, $hashed_password, $role);
        insert_user($conn, $data);

        header("Location: ../add-user.php?success=User created successfully");
        exit();
    } else {
        header("Location: ../add-user.php?error=Missing input fields");
        exit();
    }
} else {
    header("Location: ../add-user.php?error=First login required");
    exit();
}
