<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

// Check connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$mname = isset($_POST['mname']) ? $_POST['mname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

// Hash the password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Check if email or username already exists in the database
$sql = "SELECT * FROM users WHERE email='$email' OR username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Email or username already exists";
    exit; // Stop further execution
}

// Check if the email address is not empty and is in a valid format
if (!empty($email)) {
    echo "Email: " . $email . "<br>"; // Debugging line
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate verification code
        $verification_code = md5(uniqid(rand(), true));

        // Insert user data into the database
        $sql = "INSERT INTO users (fname, mname, lname, email, username, password, verification_code)
                VALUES ('$fname', '$mname', '$lname', '$email', '$username', '$password_hashed', '$verification_code')";

        if ($conn->query($sql) === TRUE) {
            // Send verification code via email
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'awadhnath13@gmail.com'; // Your SMTP username
            $mail->Password = 'apai uzyk qhmg onwf'; // Your SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            $mail->setFrom('awadhnath13@gmail.com', 'Awadhnath Teli Gupta');
            $mail->addAddress($email); // Recipient
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = 'Your verification code is: <strong>' . $verification_code . '</strong>';

            if ($mail->send()) {
                // Redirect user to verification page
                header("Location: verify.php");
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid email address";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>Registration Form</h1>
    <form action="register.php" method="post"> <!-- This action should be updated to your backend file handling the registration -->
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" placeholder="First Name" required>

        <label for="mname">Middle Name:</label>
        <input type="text" id="mname" name="mname" placeholder="Middle Name">

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" placeholder="Last Name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" minlength="5" placeholder="Username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" minlength="5" placeholder="Password" required>

        <label for="confirmpassword">Confirm Password:</label>
        <input type="password" id="confirmpassword" name="confirmpassword" minlength="5" placeholder="Confirm Password" required>

        <input type="submit" valu="Register">
    </form>
    <div class="login-back">
        <p>Already registered? <a href="login.html">Back to Login</a></p>
    </div>
</body>
</html>