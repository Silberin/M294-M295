<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/User.php";

    if (!isset($_GET['id'])) {
        header("Location: user.php?error=User ID is missing.");
        exit();
    }

    $id = $_GET['id'];
    $user = get_user_by_id($conn, $id);

    if ($user == 0) {
        header("Location: user.php?error=User not found.");
        exit();
    }

    // 🔹 Check if the user being deleted is an admin
    if ($user['role'] == "admin") {
        header("Location: user.php?error=Admins cannot be deleted.");
        exit();
    }

    // 🔹 Proceed with deletion for non-admin users
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        header("Location: user.php?success=User deleted successfully.");
    } else {
        header("Location: user.php?error=Failed to delete user.");
    }
    exit();
} else {
    header("Location: login.php?error=Unauthorized Access.");
    exit();
}
?>
