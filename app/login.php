<?php
session_start();
if (isset($_POST['user_name']) && isset($_POST['password'])) {
    include "../DB_connection.php";

    function validate_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $user_name = validate_input($_POST['user_name']);
    $password = validate_input($_POST['password']);

    // 🔹 Check if input fields are empty
    if (empty($user_name)) {
        header("Location: ../login.php?error=User name is required");
        exit();
    }
    if (empty($password)) {
        header("Location: ../login.php?error=Password is required");
        exit();
    }

    // 🔹 Query the database for the user
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_name]);

    // 🔹 If no user is found, return an error
    if ($stmt->rowCount() == 0) {
        header("Location: ../login.php?error=Incorrect username or password");
        exit();
    }

    // 🔹 Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $usernameDb = $user['username'];
    $passwordDb = $user['password'];
    $role = $user['role'];
    $id = $user['id'];

    // 🔹 Verify password (Handles both hashed and plaintext for testing)
    if (!password_verify($password, $passwordDb)) {
        header("Location: ../login.php?error=Incorrect username or password");
        exit();
    }

    // 🔹 Set session variables based on role
    $_SESSION['role'] = $role;
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $usernameDb;

    if ($role == "admin" || $role == "employee" || $role == "manager") {
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error=Unknown role detected.");
        exit();
    }
} else {
    header("Location: ../login.php?error=Unknown error occurred");
    exit();
}