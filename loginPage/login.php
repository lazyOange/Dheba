<?php
// Check if username and password are provided via POST
if(isset($_POST['username']) && isset($_POST['password'])) {
    // Retrieve username and password from the form submission
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Database connection
    $servername = "localhost";
    $db_username = "root"; 
    $db_password = ""; 
    $dbname = "shop_db"; 

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind statement with parameters to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    if($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])) {
                // Password verified, login successful
                // Redirect to dashboard
                header("Location: ../dashboard/index.php");
                echo "Login successful."; // Message displayed upon successful login
                exit(); // Ensure that script execution stops after redirection
            } else {
                // Password incorrect
                echo "Incorrect password.";
            }
        } else {
            // User not found
            echo "User not found.";
        }
    } else {
        // Error handling for query execution
        echo "Error executing query: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
    <h1>Login Page</h1>
<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" minlength="5" placeholder="Username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" minlength="5" placeholder="Password" required>
    <input type="submit" value="Submit">
</form>

<div class="about-us">
 <a href="register.html">Sign Up</a>
</div>

</body>
</html>
