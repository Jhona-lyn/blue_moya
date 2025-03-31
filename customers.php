<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $contact_No = $_POST['contact_No'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customers (fname, lname, address, contact_No, email) 
            VALUES ('$fname', '$lname', '$address', '$contact_No', '$email')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ New record created successfully!";
        $alert_class = "alert-success";
    } else {
        $message = "❌ Error: " . $conn->error;
        $alert_class = "alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Moya - Add Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background:url('images/jjj.jpg.jpg')  center fixed;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            padding: 50px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: url('images/kkk.jpg.jpg')  center fixed;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(12, 96, 213, 0.93);
            border-radius: 12px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color:rgb(23, 115, 206);
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fas fa-user-plus"></i> Add New Customer</h2>

    <!-- Display success or error message -->
    <?php if (!empty($message)): ?>
        <div class="alert <?php echo $alert_class; ?>" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter first name" required>
        </div>

        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter last name" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" required>
        </div>

        <div class="mb-3">
            <label for="contact_No" class="form-label">Contact Number</label>
            <input type="text" name="contact_No" id="contact_No" class="form-control" placeholder="Enter contact number" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
    </form>
</div>
<div class="text-center mt-3">
            <a href="Admin_Dashboard.php" class="btn btn-outline-secondary">Back To Dashboard</a>
            <a href="customer_list.php" class="btn btn-outline-secondary">Customer List</a>
        </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
