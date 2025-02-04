<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "manager")) {
    header("Location: login.php?error=Unauthorized Access");
    exit();
}

include "DB_connection.php";

$invoices = $conn->query("SELECT invoices.*, Kunde.name AS kunde_name, Kunde.vorname AS kunde_vorname, tasks.title AS task_title 
                          FROM invoices 
                          JOIN Kunde ON invoices.kunde_id = Kunde.id
                          JOIN tasks ON invoices.task_id = tasks.id
                          ORDER BY invoices.date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Invoices</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function printInvoice(id) {
            var printContents = document.getElementById("invoice-" + id).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<body>
<input type="checkbox" id="checkbox">
<?php include "inc/header.php"; ?>
<div class="body">
    <?php include "inc/nav.php"; ?>
    <section class="section-1">
        <h4 class="title">Invoices</h4>

        <?php if (!empty($invoices)) { ?>
            <table class="main-table">
                <tr>
                    <th>#</th>
                    <th>Kunde</th>
                    <th>Task</th>
                    <th>Total Cost</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                <?php $i=0; foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td><?= ++$i ?></td>
                        <td><?= $invoice['kunde_name'] . ' ' . $invoice['kunde_vorname'] ?></td>
                        <td><?= $invoice['task_title'] ?></td>
                        <td>€<?= number_format($invoice['total_cost'], 2) ?></td>
                        <td><?= $invoice['date_created'] ?></td>
                        <td>
                            <button onclick="printInvoice(<?= $invoice['id'] ?>)" class="btn btn-primary">Print</button>
                        </td>
                    </tr>

                    <!-- Hidden Invoice for Printing -->
                    <div id="invoice-<?= $invoice['id'] ?>" style="display:none;">
                        <h2>Invoice</h2>
                        <p><strong>Kunde:</strong> <?= $invoice['kunde_name'] . ' ' . $invoice['kunde_vorname'] ?></p>
                        <p><strong>Task:</strong> <?= $invoice['task_title'] ?></p>
                        <p><strong>Total Cost:</strong> €<?= number_format($invoice['total_cost'], 2) ?></p>
                        <p><strong>Description:</strong> <?= $invoice['description'] ?></p>
                        <p><strong>Date Created:</strong> <?= $invoice['date_created'] ?></p>
                    </div>

                <?php } ?>
            </table>
        <?php } else { ?>
            <h3>No Invoices Available</h3>
        <?php } ?>
    </section>
</div>
</body>
</html>
