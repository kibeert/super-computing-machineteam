<?php
session_start();

// Include the database connection file
$conn = mysqli_connect('localhost', 'root', '', 'user_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Fetch user details based on the provided user ID
    $sql = "SELECT * FROM user_form WHERE id=$userId";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
} else {
    // Redirect back if user ID is not provided
    header("Location: admin_page.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/icons8-ereader-48.png">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User Details</h1>
    <form action="update_user.php" method="post">
        <!-- Populate form fields with user details -->
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $user['email']; ?>"><br>
        Serial Number: <input type="text" name="serial_no" value="<?php echo $user['serial_no']; ?>"><br>
        Phone Number: <input type="text" name="phone_no" value="<?php echo $user['phone_no']; ?>"><br>
        User Type: <input type="text" name="user_type" value="<?php echo $user['user_type']; ?>"><br>
        QR Code Path: <input type="text" name="qr_code_path" value="<?php echo $user['qr_code_path']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
