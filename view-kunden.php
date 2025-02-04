<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";

    // Fetch all Kunden and their Objekte
    $sql = "SELECT k.*, o.id AS objekt_id, o.adresse AS objekt_adresse, o.plz AS objekt_plz, o.ort AS objekt_ort 
            FROM Kunde k 
            LEFT JOIN Objekt o ON k.id = o.kunde_id
            ORDER BY k.name ASC";
    $kunden = $conn->query($sql)->fetchAll(PDO::FETCH_GROUP);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>View Kunden & Objekte</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <input type="checkbox" id="checkbox">
    <?php include "inc/header.php" ?>
    <div class="body">
        <?php include "inc/nav.php" ?>
        <section class="section-1">
            <h4 class="title-2">
                <a href="add-kunde-objekt.php" class="btn">Create Kunde & Objekt</a>
            </h4>
            <h4 class="title-2">All Kunden & Objekte</h4>

            <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
            <?php } ?>

            <?php if (!empty($kunden)) { ?>
                <table class="main-table">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Vorname</th>
                        <th>Adresse</th>
                        <th>PLZ</th>
                        <th>Ort</th>
                        <th>Objekte</th>
                        <th>View Tasks</th>
                    </tr>
                    <?php $i=0; foreach ($kunden as $kunde_id => $kunde_data) {
                        $first_kunde = $kunde_data[0]; ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= htmlspecialchars($first_kunde['name']) ?></td>
                            <td><?= htmlspecialchars($first_kunde['vorname']) ?></td>
                            <td><?= htmlspecialchars($first_kunde['adresse']) ?></td>
                            <td><?= htmlspecialchars($first_kunde['plz']) ?></td>
                            <td><?= htmlspecialchars($first_kunde['ort']) ?></td>
                            <td>
                                <ul>
                                    <?php foreach ($kunde_data as $objekt) {
                                        if (!empty($objekt['objekt_id'])) { ?>
                                            <li>
                                                <?= htmlspecialchars($objekt['objekt_adresse']) ?>, <?= htmlspecialchars($objekt['objekt_plz']) ?> <?= htmlspecialchars($objekt['objekt_ort']) ?>
                                                <form action="tasks.php" method="GET" style="display:inline;">
                                                    <input type="hidden" name="objekt_id" value="<?= $objekt['objekt_id'] ?>">
                                                    <button type="submit" class="btn btn-primary">View Objekt Tasks</button>
                                                </form>
                                            </li>
                                        <?php } else { ?>
                                            <p style="color: red;">No Objekte Assigned</p>
                                        <?php }
                                    } ?>
                                </ul>
                            </td>
                            <td>
                                <form action="tasks.php" method="GET">
                                    <input type="hidden" name="kunde_id" value="<?= $first_kunde['id'] ?>">
                                    <button type="submit" class="btn btn-primary">View Kunde Tasks</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <h3>No Kunden found</h3>
            <?php } ?>
        </section>
    </div>

    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(4)");
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
