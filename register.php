<?php
require 'conn.php'; // Include database connection

$success = ""; // Variable to store success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email is already registered!";
    } else {
        // Insert the new user as a "customer"
        $stmt = $conn->prepare("INSERT INTO user (username, password, userType) VALUES (?, ?, 'customer')");
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            $success = "Registration successful! You can now <a href='login.php' class='text-decoration-none'>Login here</a>.";
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="vh-100 d-flex flex-column" style="background-color: #fefae0; overflow: hidden;">
    <!-- Include Navbar -->
    <div id="navbar"></div>
    <script>fetch('navbar.php').then(response => response.text()).then(data => document.getElementById('navbar').innerHTML = data);</script>
    
    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow-lg" style="width: 400px; background-color: #fff8df;">
            <h2 class="text-center text-dark">Register</h2>

            <!-- Display error message -->
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Display success message -->
            <?php if ($success) : ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form action="register.php" method="post">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-warning w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login.php" class="text-decoration-none">Login here</a></p>
            <button onclick="history.back()" class="btn btn-secondary w-100 mt-2">Go Back</button>
        </div>
    </div>
    
    <!-- Include Footer -->
    <div id="footer"></div>
    <script>fetch('footer.html').then(response => response.text()).then(data => document.getElementById('footer').innerHTML = data);</script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
