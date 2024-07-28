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

// Fetch suggestions
$result = $conn->query("SELECT * FROM changes");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Suggestions - The Food World</title>
    <link rel="stylesheet" href="suggestions.css">
</head>
<body>

<header>
    <h1>The Food World</h1>
    <p>View and Manage Suggestions</p>
</header>

<nav>
    <a href="index.html">Home</a>
    <a href="login.html">Login</a>
    <a href="signup.html">Sign Up</a>
    <a href="contact.html">Contact Us</a>
    <a href="suggest_change.php">Suggest Change</a>
    <a href="suggestions.php">View Suggestions</a>
</nav>

<div class="suggestions-container">
    <h2>Suggestions</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Recipe Number</th>
                <th>Suggestion</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['recipenumber']; ?></td>
                    <td><?php echo htmlspecialchars($row['suggestion']); ?></td>
                    <td>
                        <a href="update_suggestions.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete_suggestions.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this suggestion?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No suggestions found.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
</div>

</body>
</html>
