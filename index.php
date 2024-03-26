<?php
/*
*   QRCode Generator by
*   Saidul Mursalin
*   Using PHPQRCODE Library
*   facebook.com/itzmonir
*/

require_once 'phpqrcode/qrlib.php';

// Path & Filename for saving QRCode
$path = "images/";
// If Folder not found
if (!is_dir($path)) {
    // Then MakeTheFolder
    mkdir($path);
}
$file = $path.uniqid().'.png';
$text = "";
// User inputs
if (isset($_POST['submit'])) {
    
    // If Name has been submitted
    if (isset($_POST['name'])) {
        $text = "Name: ".$_POST['name']."\n";
    }
    // If Email has been submitted
    if (isset($_POST['email'])) {
        $text .= "Email: ".$_POST['email']."\n";
    }
    // If Facebook has been submitted
    if (isset($_POST['facebook'])) {
        $text .= "Facebook: https://facebook.com/".$_POST['facebook']."\n";
    }
    // If Phone has been submitted
    if (isset($_POST['phone'])) {
        $text .= "Phone: ".$_POST['phone']."\n";
    }

    // Create the QRCode
    QRcode::png($text, $file, 'H', 2, 1);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode Generator</title>
    <link rel="shortcut icon" href="qr-code.png" tfype="image/x-icon">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Remove the number input's arrow */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        input[type=number] {
        -moz-appearance: textfield;
        }

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 class="text-center text-success my-3">- QRCode Generator -</h1>
        </header>
        <main class="col-sm-8 offset-sm-2">
            <div class="card border-success">
                <div class="card-header"><span class="fw-bold text-success">Enter Information</span></div>
                <div class="card-body mt-3">
                    <form class="row g-3" method="post" action="">
                        <div class="col-sm-6 mb-2">
                            <input type="text" name="name" class="form-control border-success" placeholder="Full Name" required>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <input type="email" name="email" class="form-control border-success" placeholder="Email Address" required>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <input type="text" name="facebook" class="form-control border-success" placeholder="Facebook UserName [ex: itzmonir]" required>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <input type="number" name="phone" class="form-control border-success" placeholder="Phone Number" required>
                        </div>
                        <div class="col-sm-6 offset-sm-5">
                            <button type="submit" class="btn btn-success" name="submit">Create QRCode</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Show the QRCode -->
            <div class="card mt-2 border-success">
                <div class="card-header"><span class="fw-bold text-success">QRCode</span></div>
                <div class="card-body">
                    <!-- Print the QRCode -->
                    <?php if (isset($_POST['submit'])) {
                        echo '<img class="img-thumbnail border-success" src="'.$file.'" alt="">';
                    } else {
                        $i=0;
                        if (count(glob("$path/*")) > 0) {
                            if (is_dir($path)){
                                if ($dh = opendir($path)){
                                    while (($file = readdir($dh)) !== false){
                                        if ($file != "." && $file != ".." && $file != 'index.php') {
                                            echo '<img class="img-thumbnail border-success mx-1" src="'.$path.$file.'" alt="">';

                                            // Limit = 6
                                            if ($i>=5) break;
                                            $i++;
                                        }
                                        
                                    }
                                    closedir($dh);
                                }
                            }
                        }
                        
                    } ?>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <h6 class="text-center text-success mt-5">&copy; Saidul Mursalin</h6>
    </footer>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>