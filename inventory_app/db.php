<?php
$servername = "localhost";
$username = "root"; // Usually 'root' for XAMPP
$password = ""; // Default password is empty for XAMPP
$dbname = "inventory_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
