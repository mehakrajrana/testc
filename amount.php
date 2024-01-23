<?php
session_start();

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not authenticated
    exit();
}

// Process the form data if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form with fields named "id," "deposit," and "withdraw"
    $id = $_POST["id"];
    $deposit = $_POST["deposit"];
    $withdraw = $_POST["withdraw"];

    // Now you can use $id, $deposit, and $withdraw as needed
    // For example, you can insert these values into the database or perform any other operations.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>User Details</h2>

        <!-- Deposit and Withdraw Form -->
        <form method="post" action="amount.php">
            <div class="mb-3">
                <label for="id" class="form-label">User ID:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="mb-3">
                <label for="deposit" class="form-label">Deposit Amount:</label>
                <input type="number" class="form-control" id="deposit" name="deposit" required>
            </div>
            <div class="mb-3">
                <label for="withdraw" class="form-label">Withdraw Amount:</label>
                <input type="number" class="form-control" id="withdraw" name="withdraw" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
