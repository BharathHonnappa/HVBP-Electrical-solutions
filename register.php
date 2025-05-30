<?php
ob_start();
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $country = trim($_POST['country']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $_SESSION['error_message'] = "Username already exists. Please choose a different one.";
        header("Location: register.html");
        exit();
    }
    $stmt_check->close();

    $stmt = $conn->prepare("INSERT INTO users (name, phone, country, address, username, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $phone, $country, $address, $username, $password);

    if ($stmt->execute()) {
        header("Location: login.html");
        exit();
    } else {
        error_log("Error inserting data: " . $stmt->error);
        $_SESSION['error_message'] = "Registration failed. Please try again later.";
        header("Location: register.html");
        exit();
    }

    $stmt->close();
}

$conn->close();
ob_end_flush();
