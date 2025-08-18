<?php
// update.php

// Connect to database
$conn = new mysqli("localhost", "root", "", "registration_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if sid and slot are provided
if (!isset($_GET['sid']) || !isset($_GET['slot'])) {
    echo "Invalid request. Required parameters not provided.";
    exit();
}

$sid  = $_GET['sid'];
$slot = $_GET['slot'];

// Update student slot
$conn->query("UPDATE students SET slot='$slot' WHERE sid='$sid'");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .box {
            border: 2px solid #900;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #900;
        }
        a {
            color: #900;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>Your registration slot has been updated successfully.</h2>
    <p><a href="register.php">Go back to Registration Page</a></p>
</div>
</body>
</html>
