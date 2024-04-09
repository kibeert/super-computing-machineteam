<?php
session_start();

// Include the database connection file
$conn = mysqli_connect('localhost', 'root', '', 'user_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Delete user based on the provided user ID
    $sql = "DELETE FROM user_form WHERE id=$userId";
    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    // Redirect back if user ID is not provided
    header("Location: admin_page.php");
    exit();
}

mysqli_close($conn);
?>
