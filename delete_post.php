<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "blogdb_act");

// Delete post if delete button is clicked
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM blog WHERE id = $id";
    mysqli_query($conn, $query);
}

// Redirect back to index.php
header("Location: index.php");
exit();
mysqli_close($conn);
?>
