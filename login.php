<?php
session_start();

// Assuming your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223_mehak"; // Replace with your actual database name

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = strtolower($_POST["email"]);  // Convert email to lowercase
    $password = $_POST["password"];

    // Perform a SQL injection-safe query
    $stmt = $conn->prepare("SELECT id, name, password FROM tbl_user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the query
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Valid user, set session and redirect
        $_SESSION["name"] = $email;
        header("Location: view.php");
        exit();
    } else {
        // Invalid login, redirect back to login.php with an error message
        header("Location: login.php?error=1");
        exit();
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
        }

        .container {
            margin-top: 100px;
        }

        .card {
            background-color: #fff; /* White background for the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for a subtle lift */
        }

        .card-header {
            background-color: #007bff; /* Blue header background color */
            color: #fff; /* White text color */
            font-size: 24px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff; /* Blue button background color */
            color: #fff; /* White text color */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Please login to proceed
                    </div>
                    <div class="card-body">
                        <?php
                        // Display error message if set in the URL
                        if (isset($_GET['error']) && $_GET['error'] == 1) {
                            echo '<div class="alert alert-danger" role="alert">Invalid email or password!</div>';
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>