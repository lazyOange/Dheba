<?php
require('../functions/dbconnect.php');

// Extract data from POST
if (isset($_POST['item'])) {
    $item = $_POST['item'];
} else {
    $item = null;
}
$unitPrice = $_POST['unitPrice'];
$quantity = $_POST['quantity'];
$totalPrice = $_POST['totalPrice'];  // Could also be calculated as ($unitPrice * $quantity)
$buyerName = $_POST['buyerName'];
$salesType = $_POST['transaction_type'];  // This is either 'Paid' or 'Unpaid'

// SQL to insert data
$sql = "INSERT INTO dailysale (transaction_type, buyer_name, item, unit_price, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdid", $salesType, $buyerName, $item, $unitPrice, $quantity, $totalPrice);


if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
