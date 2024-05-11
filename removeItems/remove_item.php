<?php
// Include the database connection file
include("../functions/dbconnect.php");

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO removeitem (item, description) VALUES (?, ?)");
$stmt->bind_param("ss", $item, $des);

// Set parameters from POST data
if (isset($_POST['item'])) {
    $item = $_POST['item'];
}
$des = $_POST['des'];

// Execute the statement
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "New record created successfully <br>";
} else {
    echo "Error: " . $stmt->error;
}




// Check if the button is clicked
if (isset($_POST['remove'])) {
    // Get the item ID to be deleted (you should pass this from your front end)
    if (isset($_POST['item'])) {
        $item = $_POST['item'];
    } else {
        $item = null;
    }

    // Prepare the SQL query to delete the item
    $sql = "DELETE FROM `add_item` WHERE `add_item`.`itemName` = '$item'";


    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Item removed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>