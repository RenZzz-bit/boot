<?php
$servername = "localhost";
$username = "root";    // Update with your MySQL username
$password = "";        // Update with your MySQL password
$dbname = "kaagapay";  // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
