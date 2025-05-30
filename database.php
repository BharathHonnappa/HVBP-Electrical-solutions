<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hvbp_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save $hashedPassword in the database instead of the plain password.
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if (password_verify($user_input_password, $stored_hashed_password)) {
    // Password is correct
}

//prevents from SQL Injection.
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

//Prevent Cross-Site-Scripting.
$user_input = htmlspecialchars($_POST['user_input'], ENT_QUOTES, 'UTF-8');

//Start session at the top of each page:
session_start();

//Set session timeout to automatically log out users after a period of inactivity:
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 600) {
    session_unset();
    session_destroy();
}
$_SESSION['last_activity'] = time();  // Update last activity time

//Regenerate session ID after login to avoid session fixation:
session_regenerate_id(true); // Call this after the user logs in

?>
