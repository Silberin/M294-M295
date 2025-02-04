<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php?error=Unauthorized Access");
    exit();
}

include "../DB_connection.php";

// 🔹 Add Kunde
if (isset($_POST['add_kunde'], $_POST['name'], $_POST['vorname'], $_POST['adresse'], $_POST['plz'], $_POST['ort'])) {
    $name = htmlspecialchars($_POST['name']);
    $vorname = htmlspecialchars($_POST['vorname']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $plz = htmlspecialchars($_POST['plz']);
    $ort = htmlspecialchars($_POST['ort']);

    $sql = "INSERT INTO Kunde (name, vorname, adresse, plz, ort) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $vorname, $adresse, $plz, $ort]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../add-kunde-objekt.php?success=Kunde created successfully.");
    } else {
        header("Location: ../add-kunde-objekt.php?error=Failed to create Kunde.");
    }
    exit();
}

// 🔹 Add Objekt
if (isset($_POST['add_objekt'], $_POST['objekt_adresse'], $_POST['objekt_plz'], $_POST['objekt_ort'], $_POST['kunde_id'])) {
    $adresse = htmlspecialchars($_POST['objekt_adresse']);
    $plz = htmlspecialchars($_POST['objekt_plz']);
    $ort = htmlspecialchars($_POST['objekt_ort']);
    $kunde_id = intval($_POST['kunde_id']); // Ensure it's an integer

    $sql = "INSERT INTO Objekt (adresse, plz, ort, kunde_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$adresse, $plz, $ort, $kunde_id]);

    if ($stmt->rowCount() > 0) {
        header("Location: ../add-kunde-objekt.php?success=Objekt created successfully.");
    } else {
        header("Location: ../add-kunde-objekt.php?error=Failed to create Objekt.");
    }
    exit();
}

header("Location: ../add-kunde-objekt.php?error=Invalid request.");
exit();
