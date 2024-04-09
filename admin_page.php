<?php
// Start the session
session_start();

// Include the database connection file
$conn = mysqli_connect('localhost', 'root', '', 'user_db');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the database
$sql = "SELECT * FROM user_form"; // Replace 'user_table' with your actual table name

$result = mysqli_query($conn, $sql);

// Initialize an empty array to store the fetched data
$userData = array();

// Check if there are any rows returned by the query
if (mysqli_num_rows($result) > 0) {
    // Fetch associative array
    while ($row = mysqli_fetch_assoc($result)) {
        // Store each row's data in the userData array
        $userData[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" sizes="32x32" href="/favicon/icons8-admin-96.png">
   <title>Admin Page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Hi, <span>Admin</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>This is the admin page</p>
      <a href="login_form.php" class="btn">Login</a>
      <a href="register_form.php" class="btn">Register</a>
      <a href="logout.php" class="btn">Logout</a>
   </div>

   <div class="user-details">
      <h2>User Details</h2>
      <table>
         <thead>
            <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Serial_no</th>
               <th>Phone_no</th>
               <th>User Type</th>
               <th>Qr code path</th>
               <th>Edit</th>
               <th>Delete</th>
            </tr>
         </thead>
         <tbody>
            <?php
            // Check if userData array is not empty
            if (!empty($userData)) {
                // Loop through each user data and display it in table rows
                foreach ($userData as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['serial_no'] . "</td>";
                    echo "<td>" . $user['phone_no'] . "</td>";
                    echo "<td>" . $user['user_type'] . "</td>";
                    echo "<td>" . $user['qr_code_path'] . "</td>";
                    echo "<td><a href='edit_user.php?id=" . $user['id'] . "'><button>Edit</button></a></td>";
    echo "<td><a href='delete_user.php?id=" . $user['id'] . "'><button>Delete</button></a></td>";
                    echo "</tr>";
                }
            } else {
                // If no data is found, display a message
                echo "<tr><td colspan='3'>No user data found</td></tr>";
            }
            ?>
         </tbody>
      </table>
   </div>
</div>

</body>
</html>
