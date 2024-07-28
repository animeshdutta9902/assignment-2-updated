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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $recipenumber = $_POST['recipenumber'];
    $suggestion = $_POST['suggestion'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE changes SET name=?, recipenumber=?, suggestion=? WHERE id=?");
    $stmt->bind_param("sisi", $name, $recipenumber, $suggestion, $id);

    if ($stmt->execute()) {
        header("Location: suggestions.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM changes WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Suggestion - The Food World</title>
    <link rel="stylesheet" href="update_suggestions.css">
</head>
<body>

<header>
    <h1>The Food World</h1>
    <p>Update Suggestion</p>
</header>

<nav>
    <a href="index.html">Home</a>
    <a href="login.html">Login</a>
    <a href="signup.html">Sign Up</a>
    <a href="contact.html">Contact Us</a>
    <a href="suggest_change.php">Suggest Change</a>
    <a href="suggestions.php">View Suggestions</a>
</nav>

<div class="update-container">
    <form action="update_suggestions.php?id=<?php echo $id; ?>" method="post">
        <h2>Update Suggestion</h2>
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        <label for="recipenumber">Recipe Number (1-10)</label>
        <input type="number" id="recipenumber" name="recipenumber" min="1" max="10" value="<?php echo $row['recipenumber']; ?>" required>
        <label for="suggestion">Your Suggestion</label>
        <textarea id="suggestion" name="suggestion" rows="4" required><?php echo htmlspecialchars($row['suggestion']); ?></textarea>
        <button type="submit">Update Suggestion</button>
    </form>
</div>

</body>
</html>
