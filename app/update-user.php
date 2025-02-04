<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

    if (isset($_POST['user_name'], $_POST['full_name'], $_POST['role'], $_POST['id'])) {
        include "../DB_connection.php";

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $user_name = validate_input($_POST['user_name']);
        $full_name = validate_input($_POST['full_name']);
        $role = validate_input($_POST['role']); // ✅ Get role from form input
        $id = validate_input($_POST['id']);
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // ✅ Ensure role is valid to prevent SQL Injection
        $valid_roles = ['admin', 'manager', 'employee'];
        if (!in_array($role, $valid_roles)) {
            header("Location: ../edit-user.php?id=$id&error=Invalid role selected.");
            exit();
        }

        // ✅ Validate required fields
        if (empty($user_name)) {
            header("Location: ../edit-user.php?id=$id&error=Username is required.");
            exit();
        }
        if (empty($full_name)) {
            header("Location: ../edit-user.php?id=$id&error=Full name is required.");
            exit();
        }

        // ✅ Check if password needs to be updated
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET full_name=?, username=?, password=?, role=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$full_name, $user_name, $hashed_password, $role, $id]);
        } else {
            $sql = "UPDATE users SET full_name=?, username=?, role=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$full_name, $user_name, $role, $id]);
        }

        if ($stmt->rowCount() > 0) {
            header("Location: ../user.php?success=User updated successfully.");
            exit();
        } else {
            header("Location: ../edit-user.php?id=$id&error=No changes made or update failed.");
            exit();
        }
    } else {
        header("Location: ../edit-user.php?id=$id&error=Missing required fields.");
        exit();
    }
} else {
    header("Location: ../login.php?error=First login required.");
    exit();
}