<?php
        include('../functions/dbconnect.php');
// Fetch data from the items table
$sql = "SELECT date, item, description FROM removeitem";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table>";
    echo "<thead><tr>
    <th>Date</th>
    <th>Removed Item</th>
    <th>Description</th>
    </tr>
    </thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['date']}</td><td>{$row['item']}</td><td>{$row['description']}</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No items found";
}

// Close database connection
$conn->close();
?>