<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager")) {
    include "DB_connection.php";

    // Fetch Kunden and Objekte for selection
    $kunden = $conn->query("SELECT * FROM Kunde ORDER BY name ASC")->fetchAll();
    $objekte = $conn->query("SELECT * FROM Objekt ORDER BY adresse ASC")->fetchAll();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Create Task</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <input type="checkbox" id="checkbox">
    <?php include "inc/header.php" ?>
    <div class="body">
        <?php include "inc/nav.php" ?>
        <section class="section-1">
            <h4 class="title">Create Task</h4>
            <form class="form-1" method="POST" action="app/add-task.php">
                <label>Title</label>
                <input type="text" name="title" class="input-1" placeholder="Task Title" required><br>

                <label>Description</label>
                <textarea name="description" class="input-1" placeholder="Task Description" required></textarea><br>

                <label>Due Date</label>
                <input type="date" name="due_date" class="input-1"><br>

                <label>Assign to Kunde</label>
                <select name="kunde_id" class="input-1">
                    <option value="">Select Kunde</option>
                    <?php foreach ($kunden as $kunde) { ?>
                        <option value="<?= $kunde['id'] ?>"><?= $kunde['name'] ?> <?= $kunde['vorname'] ?></option>
                    <?php } ?>
                </select><br>

                <label>Assign to Objekt</label>
                <select name="objekt_id" class="input-1">
                    <option value="">Select Objekt</option>
                    <?php foreach ($objekte as $objekt) { ?>
                        <option value="<?= $objekt['id'] ?>"><?= $objekt['adresse'] ?>, <?= $objekt['plz'] ?> <?= $objekt['ort'] ?></option>
                    <?php } ?>
                </select><br>

                <button class="edit-btn">Create Task</button>
            </form>
        </section>
    </div>
    </body>
    </html>
<?php } else {
    header("Location: login.php?error=Unauthorized Access");
    exit();
}
?>
