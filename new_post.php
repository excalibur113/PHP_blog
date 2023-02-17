<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "blogdb_act");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];

    // Insert new blog post into the database
    $sql = "INSERT INTO blog (title, content, author, date_created) VALUES ('$title', '$content', '$author', NOW())";
    if (mysqli_query($conn, $sql)) {
        echo "New post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Post</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>New Post</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" required><br><br>
            <label for="content">Content:</label>
            <textarea name="content" rows="10" required></textarea><br><br>
            <label for="author">Author:</label>
            <input type="text" name="author" required><br><br>
            <input type="submit" value="Create Post">
        </form>
        <a href="index.php">Back to List</a>
    </div>
</body>
</html>
