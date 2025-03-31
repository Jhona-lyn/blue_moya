<?php 
include("connect.php");

// Pagination Settings
$limit = 10;  // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : "";
$searchQuery = "";
if (!empty($search)) {
    $searchQuery = " WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR contact_No LIKE '%$search%' OR email LIKE '%$search%'";
}

// Get customers with pagination
$sql = "SELECT * FROM customers $searchQuery LIMIT $start, $limit";
$result = $conn->query($sql);

// Get total records for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM customers $searchQuery";
$totalResult = $conn->query($totalQuery);
$total = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List - Blue Moya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: url('images/jjj.jpg.jpg') center fixed;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            padding: 50px;
        }
        .table-container {
            max-width: 1100px;
            margin: 0 auto;
            background: url('images/kkk.jpg.jpg') center fixed;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        .btn-primary, .btn-danger {
            padding: 5px 12px;
            font-size: 14px;
        }
        .pagination a {
            color: #007bff;
            text-decoration: none;
            padding: 8px 16px;
            display: inline-block;
        }
        .pagination a:hover {
            background: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2><i class="fas fa-users"></i> Customer List</h2>

    <!-- Search Form -->
    <form method="get" action="customer_list.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name, contact, or email" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
        </div>
    </form>

    <!-- Customer Table -->
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['contact_No']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_customer.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="delete_customer.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No customers found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
<div class="text-center mt-3">
    <a href="Admin_Dashboard.php" class="btn btn-outline-secondary">Back To Dashboard</a>
    <a href="customers.php" class="btn btn-outline-secondary">Add New Customers</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
