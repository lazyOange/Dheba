<?php
require('../functions/dbconnect.php');
require('fpdf186/fpdf.php'); // Include the FPDF library

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get start and end dates from form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Fetch data from dailySales table for the specified date range
    $sql = "SELECT * FROM dailysale WHERE transaction_date BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);

    // Initialize PDF with landscape orientation
    $pdf = new FPDF('L', 'mm', 'A4'); // Landscape orientation, millimeters, A3 size
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16); // Set font size for title

    // Title
    $pdf->Cell(0, 15, 'Sales Report', 0, 1, 'C'); // Cell spans the full width (0), height is 15, centered (C), no border (0)
    $pdf->Ln(10); // Add a line break after the title

    // Header with larger cell sizes
    $pdf->Cell(40, 12, 'Transaction ', 1, 0, 'C');
    $pdf->Cell(60, 12, 'Buyer Name', 1, 0, 'C');
    $pdf->Cell(40, 12, 'Item', 1, 0, 'C');
    $pdf->Cell(60, 12, 'Transaction Date', 1, 0, 'C');
    $pdf->Cell(30, 12, 'Unit Price', 1, 0, 'C');
    $pdf->Cell(25, 12, 'Quantity', 1, 0, 'C');
    $pdf->Cell(30, 12, 'Total Price', 1, 1, 'C');

    // Content
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(40, 10, $row['transaction_type'], 1, 0, 'C');
            $pdf->Cell(60, 10, $row['buyer_name'], 1, 0, 'C');
            $pdf->Cell(40, 10, $row['item'], 1, 0, 'C');
            $pdf->Cell(60, 10, $row['transaction_date'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['unit_price'], 1, 0, 'C');
            $pdf->Cell(25, 10, $row['quantity'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['total_price'], 1, 1, 'C');
        }
    }

    // Output PDF
    $pdf->Output();
    $conn->close();
} else {
    // Redirect to the form page if accessed directly
    header("Location: reports.php");
    exit();
}
?>
