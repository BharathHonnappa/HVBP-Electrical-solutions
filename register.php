<?php
// Start output buffering and session
ob_start();
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "hvbp_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input and sanitize
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $country = trim($_POST['country']);
    $address = trim($_POST['address']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Use Prepared Statements for security
    $stmt = $conn->prepare("INSERT INTO users (name, phone, country, address, username, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $phone, $country, $address, $username, $password);

    if ($stmt->execute()) {
        // Redirect to login.html after successful registration
        header("Location: login.html");
        exit();
    } else {
        echo "Error inserting data: " . $stmt->error; // Show error message
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

// End output buffering
ob_end_flush();
?>
