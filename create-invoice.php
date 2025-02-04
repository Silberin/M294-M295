<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: login.php?error=Unauthorized Access");
    exit();
}

include "DB_connection.php";

// Fetch all Kunden
$kunden = $conn->query("SELECT * FROM Kunde")->fetchAll(PDO::FETCH_ASSOC);

// Fetch all Tasks
$tasks = $conn->query("SELECT * FROM tasks")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Invoice</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<input type="checkbox" id="checkbox">
<?php include "inc/header.php"; ?>
<div class="body">
    <?php include "inc/nav.php"; ?>
    <section class="section-1">
        <h4 class="title">Create Invoice</h4>
        <form class="form-1" method="POST" action="app/generate-invoice.php">

            <div class="input-holder">
                <label>Select Kunde</label>
                <select name="kunde_id" class="input-1" required>
                    <option value="">Select Kunde</option>
                    <?php foreach ($kunden as $kunde) { ?>
                        <option value="<?= $kunde['id'] ?>"><?= $kunde['name'] . ' ' . $kunde['vorname'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-holder">
                <label>Select Task</label>
                <select name="task_id" class="input-1" required>
                    <option value="">Select Task</option>
                    <?php foreach ($tasks as $task) { ?>
                        <option value="<?= $task['id'] ?>"><?= $task['title'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-holder">
                <label>Total Cost (€)</label>
                <input type="number" name="total_cost" class="input-1" step="0.01" placeholder="Total Cost" required>
            </div>

            <div class="input-holder">
                <label>Description</label>
                <textarea name="description" class="input-1" placeholder="Invoice Description" required></textarea>
            </div>

            <button class="edit-btn" type="submit">Generate Invoice</button>
        </form>
    </section>
</div>
</body>
</html>
