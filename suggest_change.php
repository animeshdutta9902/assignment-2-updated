<?php
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "food_wrld"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_name = $_POST['name'];
    $recipe_number = $_POST['recipenumber'];
    $user_suggestion = $_POST['suggestion'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO changes (name, recipenumber, suggestion) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $user_name, $recipe_number, $user_suggestion);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Your suggestion has been submitted.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggest a Change - The Food World</title>
    <link rel="stylesheet" href="suggest_change.css">
</head>
<body>

<header>
    <h1>The Food World</h1>
    <p>Suggest a Change to a Recipe</p>
</header>

<nav>
    <a href="index.html">Home</a>
    <a href="login.html">Login</a>
    <a href="signup.html">Sign Up</a>
    <a href="contact.html">Contact Us</a>
    <a href="suggest_change.php">Suggest Change</a>
</nav>

<div class="suggest-change-container">
    <form action="suggest_change.php" method="post">
        <h2>Suggest a Change</h2>
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" required>
        <label for="recipenumber">Recipe Number (1-10)</label>
        <input type="number" id="recipenumber" name="recipenumber" min="1" max="10" required>
        <label for="suggestion">Your Suggestion</label>
        <textarea id="suggestion" name="suggestion" rows="4" required></textarea>
        <button type="submit">Submit Suggestion</button>
    </form>
</div>

</body>
</html>
