<?php

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "blogdb_act");

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    
    // Insert new post into the database
    $query = "INSERT INTO blog (title, content, author, date_created) VALUES ('$title', '$content', '$author', NOW())";
    mysqli_query($conn, $query);
}

// Delete post if delete button is clicked
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM blog WHERE id = $id";
    mysqli_query($conn, $query);
}

// Retrieve all blog posts from the database
$result = mysqli_query($conn, "SELECT * FROM blog");

// Display the blog posts in a table
echo "<table>";
echo "<tr><th>Title</th><th>Author</th><th>Date</th><th>Actions</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td><a href=\"edit_post.php?id={$row['id']}\">{$row['title']}</a></td>";
    echo "<td>{$row['author']}</td>";
    echo "<td>{$row['date_created']}</td>";
    echo "<td><a href=\"delete_post.php?id={$row['id']}\">Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2>New Post</h2>
<form method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title"><br>
    <label for="content">Content:</label>
    <textarea name="content"></textarea><br>
    <label for="author">Author:</label>
    <input type="text" name="author"><br>
    <input type="submit" name="submit" value="Submit">
</form>
<body>
  <html>