<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";

    // Fetch existing Kunden for selection
    $kunden = $conn->query("SELECT * FROM Kunde ORDER BY name ASC")->fetchAll();
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Add Kunde & Objekt</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <input type="checkbox" id="checkbox">
    <?php include "inc/header.php" ?>
    <div class="body">
        <?php include "inc/nav.php" ?>
        <section class="section-1">
            <h4 class="title">Add Kunde & Objekt</h4>

            <!-- 🔹 Add Kunde Form -->
            <form class="form-1" method="POST" action="app/add-kunde-objekt.php">
                <h4 class="title">Create Kunde</h4>
                <?php if (isset($_GET['error'])) {?>
                    <div class="danger" role="alert">
                        <?php echo stripcslashes($_GET['error']); ?>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['success'])) {?>
                    <div class="success" role="alert">
                        <?php echo stripcslashes($_GET['success']); ?>
                    </div>
                <?php } ?>

                <div class="input-holder">
                    <label>Name</label>
                    <input type="text" name="name" class="input-1" placeholder="Name" required><br>
                </div>
                <div class="input-holder">
                    <label>Vorname</label>
                    <input type="text" name="vorname" class="input-1" placeholder="Vorname" required><br>
                </div>
                <div class="input-holder">
                    <label>Adresse</label>
                    <input type="text" name="adresse" class="input-1" placeholder="Adresse" required><br>
                </div>
                <div class="input-holder">
                    <label>PLZ</label>
                    <input type="text" name="plz" class="input-1" placeholder="PLZ" required><br>
                </div>
                <div class="input-holder">
                    <label>Ort</label>
                    <input type="text" name="ort" class="input-1" placeholder="Ort" required><br>
                </div>

                <button class="edit-btn" name="add_kunde">Add Kunde</button>
                <br>
                <br>
            </form>

            <!-- 🔹 Add Objekt Form -->
            <form class="form-1" method="POST" action="app/add-kunde-objekt.php">
                <h4 class="title">Create Objekt</h4>

                <div class="input-holder">
                    <label>Adresse</label>
                    <input type="text" name="objekt_adresse" class="input-1" placeholder="Adresse" required><br>
                </div>
                <div class="input-holder">
                    <label>PLZ</label>
                    <input type="text" name="objekt_plz" class="input-1" placeholder="PLZ" required><br>
                </div>
                <div class="input-holder">
                    <label>Ort</label>
                    <input type="text" name="objekt_ort" class="input-1" placeholder="Ort" required><br>
                </div>

                <div class="input-holder">
                    <label>Assign to Kunde</label>
                    <select name="kunde_id" class="input-1" required>
                        <option value="">Select Kunde</option>
                        <?php foreach ($kunden as $kunde) { ?>
                            <option value="<?= $kunde['id'] ?>"><?= $kunde['name'] ?> <?= $kunde['vorname'] ?></option>
                        <?php } ?>
                    </select>
                    <br>
                </div>

                <button class="edit-btn" name="add_objekt">Add Objekt</button>
            </form>

        </section>
    </div>

    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(2)");
        active.classList.add("active");
    </script>
    </body>
    </html>
<?php } else {
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>
