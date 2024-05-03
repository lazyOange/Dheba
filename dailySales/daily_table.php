<?php
    include('../functions/dbconnect.php');
    $today = date("Y-m-d");
    // Fetch data from the items table
    $sql = "SELECT transaction_date, transaction_type, buyer_name, item, unit_price, quantity, total_price 
    FROM dailysale
    WHERE DATE(transaction_date) = '$today' ";
    $result = mysqli_query($conn,$sql);
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        echo "<table>";
                        echo "<thead><tr>
                        <th>Date</th>
                        <th>Transaction Type</th>
                        <th>Buyer Name</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Unit</th>
                        <th>Amount</th>
                        </tr></thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['transaction_date']}</td>
                            <td>{$row['transaction_type']}</td>
                            <td>{$row['buyer_name']}</td>
                            <td>{$row['item']}</td>
                            <td>{$row['unit_price']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['total_price']}</td>
                            </tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "No items found";
                    }

                    // Close database connection
                    $conn->close();
                    ?>