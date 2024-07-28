<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_wrld";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM changes WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: suggestions.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
