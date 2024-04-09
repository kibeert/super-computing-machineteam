<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: login_form.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Here, you would typically fetch user data from the database using the $user_id,
    // but since you want to update data without accessing the database directly,
    // we'll assume you have the necessary data stored in an associative array.

    // For demonstration purposes, let's assume you have a sample user array.
    $user = [
        'id' => $user_id,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'serial_no' => '12345',
        'phone_no' => '555-123-4567',
        'user_type' => 'Admin',
        'qr_code_path' => '/path/to/qr_code.png'
    ];
} else {
    // Redirect back to the admin page if no user ID is provided
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User</title>
   <link rel="stylesheet" href="/css/style2.css">
</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Edit User Details</h3>
      <form action="update_user.php" method="post">
          <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
          <label for="name">Name:</label>
          <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
          <label for="email">Email:</label>
          <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
          <label for="serial_no">Serial No:</label>
          <input type="text" name="serial_no" value="<?php echo $user['serial_no']; ?>"><br>
          <label for="phone_no">Phone No:</label>
          <input type="text" name="phone_no" value="<?php echo $user['phone_no']; ?>"><br>
          <label for="user_type">User Type:</label>
          <input type="text" name="user_type" value="<?php echo $user['user_type']; ?>"><br>
          <input type="submit" name="submit" value="Update">
      </form>
   </div>
</div>

</body>
</html>
