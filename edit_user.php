<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/icons8-edit-30.png">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User Details</h1>
        <form action="update_user.php" method="post">
            <!-- Populate form fields with user details -->
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>">
            <label for="serial_no">Serial Number:</label>
            <input type="text" id="serial_no" name="serial_no" value="<?php echo $user['serial_no']; ?>">
            <label for="phone_no">Phone Number:</label>
            <input type="text" id="phone_no" name="phone_no" value="<?php echo $user['phone_no']; ?>">
            <label for="user_type">User Type:</label>
            <input type="text" id="user_type" name="user_type" value="<?php echo $user['user_type']; ?>">
            <label for="qr_code_path">QR Code Path:</label>
            <input type="text" id="qr_code_path" name="qr_code_path" value="<?php echo $user['qr_code_path']; ?>">
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
