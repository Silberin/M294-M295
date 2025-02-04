<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: ../login.php?error=Unauthorized Access");
    exit();
}

include "../DB_connection.php";

if (isset($_POST['kunde_id'], $_POST['task_id'], $_POST['total_cost'], $_POST['description'])) {
    $kunde_id = $_POST['kunde_id'];
    $task_id = $_POST['task_id'];
    $total_cost = $_POST['total_cost'];
    $description = $_POST['description'];

    // Insert invoice into database
    $stmt = $conn->prepare("INSERT INTO invoices (kunde_id, task_id, total_cost, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$kunde_id, $task_id, $total_cost, $description]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../view-invoices.php?success=Invoice Created Successfully");
    } else {
        header("Location: ../create-invoice.php?error=Failed to create invoice");
    }
    exit();
}
?>
