<?php
session_start();
include("connect.php");


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('No customer ID provided.'); window.location='customer_list.php';</script>";
    exit();
}

$id = $_GET['id'];


$sql = "SELECT * FROM customers WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<script>alert('Customer not found.'); window.location='customer_list.php';</script>";
    exit();
}

$customer = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact_No = $_POST['contact_No'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $update_sql = "UPDATE customers SET 
                    fname = '$fname', 
                    lname = '$lname', 
                    contact_No = '$contact_No', 
                    email = '$email', 
                    address = '$address'
                   WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Customer updated successfully!'); window.location='customer_list.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer - Blue Moya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, rgb(50, 149, 207), #d9e4f5);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        .btn {
            width: 100%;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        a.back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a.back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Customer</h2>

    <form action="" method="POST">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="fname" class="form-control" value="<?= $customer['fname'] ?>" required>
        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="lname" class="form-control" value="<?= $customer['lname'] ?>" required>
        </div>

        <div class="form-group">
            <label>Contact No:</label>
            <input type="text" name="contact_No" class="form-control" value="<?= $customer['contact_No'] ?>" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $customer['email'] ?>" required>
        </div>

        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="address" class="form-control" value="<?= $customer['address'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
    </form>

    <a href="customer_list.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Customer List</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
