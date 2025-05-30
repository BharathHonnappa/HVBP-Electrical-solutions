<?php
ob_start();
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, phone, country, address, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['country'] = $row['country'];
            $_SESSION['address'] = $row['address'];

            session_regenerate_id(true);
            $_SESSION['last_activity'] = time();

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: login.html");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.html");
        exit();
    }
}
$conn->close();
ob_end_flush();
