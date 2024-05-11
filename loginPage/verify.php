<?php
// Check if verification code is provided via POST
if(isset($_POST['verification_code'])) {
    // Retrieve verification code from the form submission
    $verification_code = trim($_POST['verification_code']); // Trim whitespace

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
    $stmt = $conn->prepare("SELECT * FROM users WHERE LOWER(verification_code) = LOWER(?)");
    $stmt->bind_param("s", $verification_code);

    // Execute the statement
    if($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redirect to login page
            header("Location: login.php");
            exit(); // Stop script execution after redirection
        } else {
            // Verification failed
            echo "Invalid verification code.";
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
    <title>Verification Code</title>
</head>
<body>
    <h2>Enter Verification Code</h2>
    <form action="verify.php" method="post">
        <label for="verification_code">Verification Code:</label><br>
        <input type="text" id="verification_code" name="verification_code" required><br><br>
        <input type="submit" value="Verify">
    </form>
</body>
</html>
