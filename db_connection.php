<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "mathi9345";
$dbname = "ECommercePlatform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
