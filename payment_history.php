<?php
include("connect.php");

// Fetch payment records
$sql = "SELECT * FROM payments ORDER BY payment_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment History</title>
    <style>
        body {
    background:url('images/jjj.jpg.jpg')  center fixed;
    font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background:rgb(4, 101, 238); color: white; }
        tr:hover { background:rgb(42, 140, 239); }
        a { text-decoration: none; color: white; background:rgb(4, 101, 238); padding: 9px 15px; border-radius: 10px; }
        a:hover { background:rgb(4, 101, 238); }
    </style>
</head>
<!-- Back Button -->
<a href="Admin_dashboard.php" class="back-btn">
    <i class="fas fa-arrow-left"></i> Back
</a>
<body>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Amount (₱)</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['customer']}</td>
                        <td>₱{$row['amount']}</td>
                        <td>{$row['payment_date']}</td>
                        <td>" . ucfirst(str_replace('_', ' ', $row['payment_method'])) . "</td>
                        <td>{$row['quantity']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No payments found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>
