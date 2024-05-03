
<?php
require('../functions/dbconnect.php');
// Fetch data from the items table
        $sql = "SELECT itemName, itemPrice, itemRemarks FROM add_item";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<table>";
            echo "<thead><tr>
            <th>Item</th>
            <th>Price</th>
            <th>Description</th>
            </tr>
            </thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['itemName']}</td><td>{$row['itemPrice']}</td><td>{$row['itemRemarks']}</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No items found";
        }

// Close database connection
$conn->close();
?>