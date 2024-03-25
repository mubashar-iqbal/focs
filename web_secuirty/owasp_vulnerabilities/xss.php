<?php
include("../db.php");

// Get user input from the URL parameter
$user_input = isset($_GET['input']) ? $_GET['input'] : '';

// Sanitize the user input
$user_input = htmlspecialchars($user_input);

echo "User input: " . $user_input;


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = htmlspecialchars($_POST["data"]);

    $data = $_POST["data"];

    // Prepare SQL query to insert data into xss_table
    $sql = "INSERT INTO xss (data) VALUES (?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("s", $data);
        if ($stmt->execute()) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Prepare SQL query to select data field from xss_table
$sql = "SELECT data FROM xss";

// Execute the query and get result
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br><br><br>Data: " . htmlspecialchars($row["data"]). "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Data</title>
</head>
<body>
    <h2>Save Data Form</h2>
    <form action="" method="post">
        <label for="data">Data:</label><br>
        <textarea id="data" name="data" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Save Data">
    </form>
</body>
</html>
