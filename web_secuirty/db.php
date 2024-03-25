<?php
// MySQL database credentials
$servername = "localhost"; // or your server IP address
$username = "root"; // your MySQL username

// $username = "root_2"; // for MySQL username error

$password = ""; // your MySQL password
$database = "focs_course"; // your MySQL database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
