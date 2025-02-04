<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager")) {
    include "../DB_connection.php";

    if (isset($_POST['title'], $_POST['description'], $_POST['assigned_to'], $_POST['due_date'])) {
        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $title = validate_input($_POST['title']);
        $description = validate_input($_POST['description']);
        $assigned_to = validate_input($_POST['assigned_to']);
        $due_date = validate_input($_POST['due_date']);
        $image_paths = [];
        $document_path = "";

        // 🔹 Handle Multiple Image Uploads
        if (!empty($_FILES['task_images']['name'][0])) {
            $target_dir = "../uploads/images/";

            foreach ($_FILES["task_images"]["tmp_name"] as $key => $tmp_name) {
                $file_name = basename($_FILES["task_images"]["name"][$key]);
                $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                // Allowed image types
                $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
                if (!in_array($file_extension, $allowed_extensions)) {
                    header("Location: ../create_task.php?error=Invalid image format. Only JPG, PNG, GIF allowed.");
                    exit();
                }

                // Create unique file name
                $new_file_name = "task_" . time() . "_$key." . $file_extension;
                $target_file = $target_dir . $new_file_name;

                // Ensure the uploads folder exists
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Move the uploaded file
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $image_paths[] = "uploads/images/" . $new_file_name;
                }
            }
        }

        // Convert image paths to JSON format
        $image_paths_json = json_encode($image_paths);

        // 🔹 Insert Task into Database
        $sql = "INSERT INTO tasks (title, description, assigned_to, due_date, images) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $description, $assigned_to, $due_date, $image_paths_json]);

        if ($stmt->rowCount() > 0) {
            header("Location: ../tasks.php?success=Task created successfully.");
        } else {
            header("Location: ../create_task.php?error=Failed to create task.");
        }
        exit();
    }
}