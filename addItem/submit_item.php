<?php
  require('../functions/dbconnect.php');

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO add_item (itemName, itemPrice, itemRemarks) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $itemName, $itemPrice, $itemRemarks);

// Set parameters from POST data
$itemName = $_POST['itemName'];
$itemPrice = $_POST['itemPrice'];
$itemRemarks = $_POST['itemRemarks'];

// Execute the statement
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}


// Close statement and connection
$stmt->close();
$conn->close();
?>
