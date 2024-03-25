<?php
session_start();

// error reporting fix
error_reporting(0);

// database
include("../db.php");

// if (isset($_SESSION['admin_id'])) {
    $admin_sql = "SELECT * FROM admin WHERE id = " . $_SESSION['admin_id'];
    $admin_result = $conn->query($admin_sql);

    if ($admin_result->num_rows > 0) {
        $admin_row = $admin_result->fetch_assoc();
        echo "Hello, " . $admin_row['username'] . "! <a href='logout.php'>Logout</a><br /><br /><br />";
    } else {
        header("Location: index.php");
        exit;
    }
// } else {
    // var_dump($conn);
    // echo "<br /><br />";
    // var_dump($_SESSION);
    // echo "<br /><br />";
// }

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any users
if ($result->num_rows > 0) {
    // Output data of each user
    while($row = $result->fetch_assoc()) {
        echo "User ID: " . $row["id"]. " - Name: " . $row["username"]. " - Email: " . $row["email"]. "<br>";
        // Add edit and delete links for each user
        if ($admin_row["access_level"] == 'full_access') {
            echo "<a href='delete_user.php?id=" . $row["id"] . "'>Delete</a><br><br>";
        }
    }
} else {
    echo "No users found";
}



?>
