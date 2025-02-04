<nav class="side-bar">
    <div class="user-p">
        <img src="img/user.png">
        <h4>@<?=$_SESSION['username']?></h4>
    </div>

    <ul id="navList">
        <li>
            <a href="index.php">
                <i class="fa fa-tachometer"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php if ($_SESSION['role'] == "employee") { ?>
            <!-- Employee Navigation -->
            <li>
                <a href="my_task.php">
                    <i class="fa fa-tasks"></i>
                    <span>My Tasks</span>
                </a>
            </li>
            <li>
                <a href="profile.php">
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="notifications.php">
                    <i class="fa fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </li>

        <?php } else if ($_SESSION['role'] == "admin") { ?>
            <!-- Admin Navigation -->
            <li>
                <a href="user.php">
                    <i class="fa fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li>
                <a href="create_task.php">
                    <i class="fa fa-plus"></i>
                    <span>Create Task</span>
                </a>
            </li>
            <li>
                <a href="tasks.php">
                    <i class="fa fa-tasks"></i>
                    <span>All Tasks</span>
                </a>
            </li>
            <li>
                <a href="add-kunde-objekt.php">
                    <i class="fa fa-user-plus"></i>
                    <span>Create Kunde & Objekt</span>
                </a>
            </li>
            <li>
                <a href="view-kunden.php">
                    <i class="fa fa-users"></i>
                    <span>View Kunden & Objekte</span>
                </a>
            </li>
            <li>
                <a href="create-invoice.php">
                    <i class="fa fa-file-invoice"></i>
                    <span>Create Invoice</span>
                </a>
            </li>
            <li>
                <a href="view-invoices.php">
                    <i class="fa fa-file-invoice-dollar"></i>
                    <span>View Invoices</span>
                </a>
            </li>

        <?php } else if ($_SESSION['role'] == "manager") { ?>
            <!-- Manager Navigation -->
            <li>
                <a href="my_task.php">
                    <i class="fa fa-tasks"></i>
                    <span>My Tasks</span>
                </a>
            </li>
            <li>
                <a href="create_task.php">
                    <i class="fa fa-plus"></i>
                    <span>Create Task</span>
                </a>
            </li>
            <li>
                <a href="tasks.php">
                    <i class="fa fa-tasks"></i>
                    <span>All Tasks</span>
                </a>
            </li>
        <?php } ?>

        <!-- Visible to All Users -->
        <li>
            <a href="view-kunden.php">
                <i class="fa fa-users"></i>
                <span>View Kunden & Objekte</span>
            </a>
        </li>

        <li>
            <a href="logout.php">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>

<!-- 🔹 JavaScript to Highlight the Correct Active Menu -->
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var currentLocation = window.location.pathname.split('/').pop(); // Get current file name
        var menuItems = document.querySelectorAll("#navList li a");

        menuItems.forEach(function(item) {
            var linkPage = item.getAttribute("href").split('/').pop(); // Get link's file name
            if (linkPage === currentLocation) {
                document.querySelectorAll("#navList li").forEach(li => li.classList.remove("active")); // Remove previous active class
                item.parentElement.classList.add("active"); // Add active class only to the correct item
            }
        });
    });
</script>
