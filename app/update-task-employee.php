<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
    include "../DB_connection.php";

    if (isset($_POST['id'], $_POST['status'])) {

        function validate_input($data) {
            return htmlspecialchars(stripslashes(trim($data)));
        }

        $id = validate_input($_POST['id']);
        $status = validate_input($_POST['status']);
        $document_path = "";

        // 🔹 Handle File Upload (Word Documents Only)
        if (!empty($_FILES['document']['name'])) {
            $target_dir = "../uploads/"; // Folder to store files
            $file_name = basename($_FILES["document"]["name"]);
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Allowed file types
            $allowed_extensions = ["doc", "docx"];
            if (!in_array($file_extension, $allowed_extensions)) {
                header("Location: ../edit-task-employee.php?id=$id&error=Invalid file format. Only .doc & .docx allowed.");
                exit();
            }

            // Create unique file name
            $new_file_name = "task_" . $id . "_" . time() . "." . $file_extension;
            $target_file = $target_dir . $new_file_name;

            // 🔹 Debugging file upload errors
            if ($_FILES['document']['error'] > 0) {
                header("Location: ../edit-task-employee.php?id=$id&error=Upload error code: " . $_FILES['document']['error']);
                exit();
            }

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); // 🔹 Create folder if it doesn’t exist
            }

            if (!is_writable($target_dir)) {
                header("Location: ../edit-task-employee.php?id=$id&error=Upload folder is not writable.");
                exit();
            }

            // 🔹 Move uploaded file
            if (!move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
                header("Location: ../edit-task-employee.php?id=$id&error=Failed to move uploaded file.");
                exit();
            }

            $document_path = "uploads/" . $new_file_name;
        }

        // 🔹 Update the Task in the Database
        if (!empty($document_path)) {
            $sql = "UPDATE tasks SET status=?, document=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$status, $document_path, $id]);
        } else {
            $sql = "UPDATE tasks SET status=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$status, $id]);
        }

        if ($stmt->rowCount() > 0) {
            header("Location: ../my_task.php?success=Task updated successfully.");
        } else {
            header("Location: ../edit-task-employee.php?id=$id&error=No changes made.");
        }
        exit();
    }
} else {
    header("Location: ../login.php?error=Unauthorized Access.");
    exit();
}
