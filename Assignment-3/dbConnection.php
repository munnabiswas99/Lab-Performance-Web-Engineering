<?php
// Database credentials
$host     = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
