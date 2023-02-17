<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "blogdb_act");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];

    // Update blog post in the database
    $sql = "UPDATE blog SET title='$title', content='$content', author='$author' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Post updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Retrieve blog post from the database
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM blog WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error: No post ID specified.";
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo  $row['title']; ?>">

<label for="content">Content</label>
<textarea name="content"><?php echo $row['content']; ?></textarea>

<label for="author">Author</label>
<input type="text" name="author" value="<?php echo $row['author']; ?>">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="submit" name="submit" value="Update">
</form>

</body>
</html>