<?php  

$sName = "localhost";
$uName = "root";
$pass  = "";
$db_name = "task_management_db";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, "errors.log");
    die("Database connection error.");
}
