<?php
session_start();

$timeout_duration = 600;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.html");
    exit();
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <p>This is your personalized dashboard.</p>
        <a href="chatbot.html">Go to Chatbot</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
