<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";
    include "app/Model/Notification.php";

    $notifications = get_all_my_notifications($conn, $_SESSION['id']);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Notifications</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <input type="checkbox" id="checkbox">
    <?php include "inc/header.php" ?>
    <div class="body">
        <?php include "inc/nav.php" ?>
        <section class="section-1">
            <h4 class="title">All Notifications</h4>
            <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
            <?php } ?>

            <!-- 🔹 Corrected Notification Display -->
            <?php if (!empty($notifications)) { ?>
                <table class="main-table">
                    <tr>
                        <th>#</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                    <?php $i=0; foreach ($notifications as $notification) { ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= htmlspecialchars($notification['message']) ?></td>
                            <td><?= htmlspecialchars($notification['type']) ?></td>
                            <td><?= $notification['date'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <h3>No notifications available</h3>
            <?php } ?>
        </section>
    </div>

    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(4)");
        active.classList.add("active");
    </script>
    </body>
    </html>
    <?php
} else {
    header("Location: login.php?error=Unauthorized Access.");
    exit();
}
?>
