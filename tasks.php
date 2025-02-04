<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager")) {
    include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";

    $text = "All Task";
    if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
        $text = "Due Today";
        $tasks = get_all_tasks_due_today($conn);
        $num_task = count_tasks_due_today($conn);
    } else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
        $text = "Overdue";
        $tasks = get_all_tasks_overdue($conn);
        $num_task = count_tasks_overdue($conn);
    } else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
        $text = "No Deadline";
        $tasks = get_all_tasks_NoDeadline($conn);
        $num_task = count_tasks_NoDeadline($conn);
    } else {
        $tasks = get_all_tasks($conn);
        $num_task = count_tasks($conn);
    }
    $users = get_all_users($conn);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>All Tasks</title>
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
                <a href="create_task.php" class="btn">Create Task</a>
                <a href="tasks.php?due_date=Due Today">Due Today</a>
                <a href="tasks.php?due_date=Overdue">Overdue</a>
                <a href="tasks.php?due_date=No Deadline">No Deadline</a>
                <a href="tasks.php">All Tasks</a>
            </h4>
            <h4 class="title-2"><?=$text?> (<?=$num_task?>)</h4>

            <?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                    <?php echo stripcslashes($_GET['success']); ?>
                </div>
            <?php } ?>

            <?php if ($tasks != 0) { ?>
                <table class="main-table">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Assigned To</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Image</th> <!-- Image column first -->
                        <th>Document</th> <!-- Document column next -->
                        <th>Action</th> <!-- Actions at the right -->
                    </tr>
                    <?php $i=0; foreach ($tasks as $task) { ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td><?=$task['title']?></td>
                            <td><?=$task['description']?></td>
                            <td>
                                <?php
                                foreach ($users as $user) {
                                    if ($user['id'] == $task['assigned_to']) {
                                        echo $user['full_name'];
                                    }
                                }?>
                            </td>
                            <td><?php if($task['due_date'] == "") echo "No Deadline"; else echo $task['due_date']; ?></td>
                            <td><?=$task['status']?></td>

                            <!-- 🔹 Image Column -->
                            <td>
                                <?php if (!empty($task['images'])) {
                                    $image_paths = json_decode($task['images'], true);
                                    if (!empty($image_paths)) {
                                        foreach ($image_paths as $image) { ?>
                                            <img src="<?=$image?>" alt="Task Image" width="80" height="80" style="border-radius: 5px; margin: 5px;">
                                        <?php }
                                    }
                                } else { ?>
                                    <p style="color: red;">No Images</p>
                                <?php } ?>
                            </td>

                            <!-- 🔹 Document Column -->
                            <td>
                                <?php if (!empty($task['document']) && file_exists($task['document'])) { ?>
                                    <a href="<?=$task['document']?>" download class="btn">Download</a>
                                <?php } else { ?>
                                    <p style="color: red;">No Document</p>
                                <?php } ?>
                            </td>

                            <!-- 🔹 Action Buttons -->
                            <td style="text-align: right;">
                                <a href="edit-task.php?id=<?=$task['id']?>" class="edit-btn">Edit</a>
                                <a href="delete-task.php?id=<?=$task['id']?>" class="delete-btn">Delete</a>

                                <?php if ($_SESSION['role'] == "admin") { ?>
                                    <form action="create-invoice.php" method="GET" style="display: inline;">
                                        <input type="hidden" name="kunde_id" value="<?= $task['assigned_to'] ?>">
                                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                        <button type="submit" class="btn btn-warning">Invoice</button>
                                    </form>
                                <?php } ?>
                            </td>

                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <h3>Empty</h3>
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
