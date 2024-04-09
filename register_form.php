<?php

@include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $serial_no = mysqli_real_escape_string($conn, $_POST['serial_no']); // New field for serial number
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']); // New field for phone number

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Password not matched!';
        } else {
            // QR code generation logic
            require_once 'phpqrcode/qrlib.php';

            $path = "images/";

            // If Folder not found, create it
            if (!is_dir($path)) {
                mkdir($path);
            }

            $filename = uniqid() . '.png';
            $file = $path . $filename;
            $text = "Name: $name\nEmail: $email\nSerial No: $serial_no\nPhone No: $phone_no";

            if (isset($_POST['submit'])) {

               // If Name has been submitted
               if (isset($_POST['name'])) {
                   $text = "Name: " . $_POST['name'] . "\n";
               }
               // If Email has been submitted
               if (isset($_POST['email'])) {
                   $text .= "Email: " . $_POST['email'] . "\n";
               }
               // If Serial Number has been submitted
               if (isset($_POST['serial_no'])) {
                   $text .= "Serial No: " . $_POST['serial_no'] . "\n";
               }
               // If Phone Number has been submitted
               if (isset($_POST['phone_no'])) {
                   $text .= "Phone No: " . $_POST['phone_no'] . "\n";
               }
            

            // Create the QR code
            QRcode::png($text, $file, 'H', 2, 1);
            }

            // Save the file path to the database
            $qr_code_path = mysqli_real_escape_string($conn, $filename);

            $insert = "INSERT INTO user_form(name, email, password, user_type, serial_no, phone_no, qr_code_path) VALUES('$name','$email','$pass','$user_type','$serial_no','$phone_no','$qr_code_path')";
            mysqli_query($conn, $insert);

            header('location:login_form.php');
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" sizes="32x32" href="/favicon/icons8-register-96.png">
   <title>Register to E-library</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Register To E-library</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <input type="text" name="serial_no" required placeholder="Enter serial number">
      <input type="text" name="phone_no" required placeholder="Enter phone number" maxlength="10" minlength="10">

      <select name="user_type">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>

      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login Now</a></p>
   </form>
 
</div>


</body>
</html>
