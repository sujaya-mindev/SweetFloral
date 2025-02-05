<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Check if the entered password matches the stored password
        if (password_verify($password, $user['password'])) { 

            // Set session variables
            $_SESSION['user_id'] = $user['username'];
            $_SESSION['user_type'] = $user['userType'];

            if ($user['userType'] == 'customer') {
                $_SESSION['user_email'] = $username;
            }

            // Redirect with success flag in the query string
            header("Location: login.php?success=1");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="vh-100 d-flex flex-column" style="background-color: #fefae0; overflow: hidden;">
    <!-- Include Navbar -->
    <div id="navbar"></div>
    <script>fetch('navbar.php').then(response => response.text()).then(data => document.getElementById('navbar').innerHTML = data);</script>
    
    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow-lg" style="width: 450px; background-color: #fff8df;">
            <h2 class="text-center text-dark">Login</h2>
            
            <!-- Display Success Message -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div class="alert alert-success">✅ Login successful! Redirecting...</div>
                <script>
                    setTimeout(function() {
                        window.location.href = "index.php"; // Redirect after 2 seconds
                    }, 2000);
                </script>
            <?php endif; ?>
            
            <!-- Display Error Message -->
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="login.php" method="post">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Email/Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-warning w-100">Login</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a></p>
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
