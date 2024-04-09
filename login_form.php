<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   // Check if the array keys are set before accessing them
   $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
   $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
   $pass = isset($_POST['password']) ? md5($_POST['password']) : '';
   $cpass = isset($_POST['cpassword']) ? md5($_POST['cpassword']) : '';
   $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';

   // Check if required fields are empty
   if(empty($email)){
      $error[] = 'Email is required!';
   }
   if(empty($pass)){
      $error[] = 'Password is required!';
   }

      // Proceed only if there are no errors
      if(empty($error)){

         $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
   
         $result = mysqli_query($conn, $select);
   
         if(mysqli_num_rows($result) > 0){
   
            $row = mysqli_fetch_array($result);
   
            if($row['user_type'] == 'admin'){
   
               $_SESSION['admin_name'] = $row['name'];
               header('location:admin_page.php');
   
            }elseif($row['user_type'] == 'user'){
   
               $_SESSION['user_name'] = $row['name'];
               header('location:user_page.php');
   
            }
           
         }else{
            $error[] = 'Incorrect email or password!';
         }
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" sizes="32x32" href="/favicon/icons8-ereader-48.png">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>