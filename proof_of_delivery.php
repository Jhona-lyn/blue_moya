<?php
include 'connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $delivery_date = $_POST['delivery_date'];

    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file = $_FILES['proof_file'];
    $file_name = basename($file['name']);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        // Insert into the database (MySQLi)
        $stmt = $conn->prepare("INSERT INTO proof_of_delivery (customer_name, delivery_date, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $customer_name, $delivery_date, $file_path);
        $stmt->execute();

        // Redirect to prevent duplicate submission
        header("Location: proof_of_delivery.php?success=1");
        exit;
    } else {
        header("Location: proof_of_delivery.php?error=1");
        exit;
    }
}

// Fetch existing proof of delivery records using MySQLi
$query = "SELECT * FROM proof_of_delivery ORDER BY uploaded_at DESC";
$result = $conn->query($query);

$deliveries = [];
while ($row = $result->fetch_assoc()) {
    $deliveries[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proof of Delivery</title>
    <link rel="stylesheet" href="public/style.css">
    <style>
        body{
            background:url('images/jjj.jpg.jpg')  center fixed;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background:url('images/kkk.jpg.jpg')  center fixed;
        }
        .success {
            color: black;
        }
        .error {
            color: red;
        }
        .upload-form {
            margin-bottom: 20px;
            background:url('images/kkk.jpg.jpg')  center fixed;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Proof of Delivery</h2>

    <!-- Display success or error message -->
    <?php if (isset($_GET['success'])): ?>
        <p class="success">Proof of delivery uploaded successfully!</p>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <p class="error">Failed to upload file.</p>
    <?php endif; ?>

    <form action="proof_of_delivery.php" method="POST" enctype="multipart/form-data" class="upload-form">
        <label>Customer Name:</label>
        <input type="text" name="customer_name" required>

        <label>Delivery Date:</label>
        <input type="date" name="delivery_date" required>

        <label>Upload Proof (JPG, PNG, PDF):</label>
        <input type="file" name="proof_file" accept=".jpg, .jpeg, .png, .pdf" required>

        <button type="submit">Upload Proof</button>
    </form>

    <h3>Delivery History</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Delivery Date</th>
                <th>File</th>
                <th>Uploaded At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deliveries as $delivery): ?>
                <tr>
                    <td><?= $delivery['id'] ?></td>
                    <td><?= htmlspecialchars($delivery['customer_name']) ?></td>
                    <td><?= $delivery['delivery_date'] ?></td>
                    <td>
                        <a href="<?= $delivery['file_path'] ?>" target="_blank">
                            <?= basename($delivery['file_path']) ?>
                        </a>
                    </td>
                    <td><?= $delivery['uploaded_at'] ?></td>
                    <td>
                        <a href="<?= $delivery['file_path'] ?>" download>Download</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<div class="text-center mt-3">
            <a href="Admin_Dashboard.php" class="btn btn-outline-secondary">Back To Dashboard</a>
        </div>    
</body>
</html>
