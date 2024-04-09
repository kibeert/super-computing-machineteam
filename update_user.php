<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: login_form.php");
    exit();
}

if (isset($_POST['submit'])) {
    // Include the database connection file
    $conn = mysqli_connect('localhost', 'root', '', 'user_db');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $serial_no = $_POST['serial_no'];
    $phone_no = $_POST['phone_no'];
    $user_type = $_POST['user_type'];

    // Update user data in the database
    $sql = "UPDATE user_form SET name='$name', email='$email', serial_no='$serial_no', phone_no='$phone_no', user_type='$user_type' WHERE id=$user_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to the admin page after updating the database
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect back to the edit page if the form was not submitted
    header("Location: edit_user.php?id=" . $_POST['user_id']);
    exit();
}
?>
