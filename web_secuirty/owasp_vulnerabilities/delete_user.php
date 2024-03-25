<?php
session_start();

// database
include("../db.php");

if (isset($_SESSION['admin_id'])) {
    // broken access control fix
    // 
    $admin_sql = "SELECT * FROM admin WHERE id = " . $_SESSION['admin_id']. " AND access_level = 'full_access'";
    $admin_result = $conn->query($admin_sql);

    if ($admin_result->num_rows > 0) {
        $admin_sql = "DELETE FROM users WHERE id = " . $_GET['id'];
        if ($conn->query($admin_sql)) {
            echo "User deleted!";
        }
    } else {
        echo "Unauthorized operation!";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}