<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
   exit(); // Ensure script execution stops after redirection
}

// Retrieve the filepath from the database for the logged-in user
$user_name = $_SESSION['user_name'];
$query = "SELECT qr_code_path FROM user_form WHERE name = '$user_name'";
$result = mysqli_query($conn, $query);

if (!$result) {
   // Handle database error
   die("Database query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$qr_code_path = $row['qr_code_path'];

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" sizes="32x32" href="/favicon/icons8-ereader-48.png">
   <title>User Page</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Hi, <span>Student</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>This is a user page</p>
      <a href="logout.php" class="btn">Logout</a>
   </div>

   <!-- Display the QR code image -->
   <div class="qr-code">
      <h2>Your QR Code:</h2>
      <?php
      if (!empty($qr_code_path)) {
         echo '<img src="images/' . $qr_code_path . '" alt="Your QR Code">';
      } else {
         echo '<p>No QR Code found for this user.</p>';
      }
      ?>
   </div>
</div>

</body>
</html>
