<?php
// Include database connection
include 'conn.php';
session_start();

// Assuming the user's email is stored in the session
$user_email = $_SESSION['user_email'];

// Fetch user details from `user` table
$user_query = "SELECT * FROM user WHERE username = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("s", $user_email);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
} else {
    die("User not found!");
}

// Fetch customer details from `customer` table
$customer_query = "SELECT * FROM customer WHERE email = ?";
$customer_stmt = $conn->prepare($customer_query);
$customer_stmt->bind_param("s", $user_email);
$customer_stmt->execute();
$customer_result = $customer_stmt->get_result();

if ($customer_result->num_rows > 0) {
    $customer = $customer_result->fetch_assoc();
} else {
    die("Customer details not found!");
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['phone'], $_POST['address'], $_POST['birthday'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];

        // Update customer details
        $update_customer_query = "UPDATE customer SET first_name = ?, last_name = ?, phone_no = ?, address = ?, birthday = ? WHERE email = ?";
        $update_customer_stmt = $conn->prepare($update_customer_query);
        $update_customer_stmt->bind_param("ssssss", $first_name, $last_name, $phone, $address, $birthday, $user_email);

        if ($update_customer_stmt->execute()) {
            $_SESSION['message'] = "Profile updated successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating profile.";
            $_SESSION['message_type'] = "error";
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Handle password change
    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Verify current password from the `user` table
        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                // Hash the new password
                $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

                // Update password in `user` table
                $update_password_query = "UPDATE user SET password = ? WHERE username = ?";
                $update_password_stmt = $conn->prepare($update_password_query);
                $update_password_stmt->bind_param("ss", $hashedPassword, $user_email);

                if ($update_password_stmt->execute()) {
                    $_SESSION['message'] = "Password updated successfully!";
                    $_SESSION['message_type'] = "success";
                } else {
                    $_SESSION['message'] = "Error updating password.";
                    $_SESSION['message_type'] = "error";
                }
            } else {
                $_SESSION['message'] = "New password and confirm password do not match.";
                $_SESSION['message_type'] = "error";
            }
        } else {
            $_SESSION['message'] = "Current password is incorrect.";
            $_SESSION['message_type'] = "error";
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="myprofile.css">
</head>
<body>
    <?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $message_type = $_SESSION['message_type'];
        echo "<script>alert('$message');</script>";
        // Clear the session message after displaying it
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <?php include 'navbar.php'; ?>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" style="margin-top: 2.3vh;">
        <ol class="breadcrumb p-3 rounded" style="background-color: #fffcf2; font-weight: bold;">
            <li class="breadcrumb-item" style="padding: 0 0 0 2.5vw;">
                <a href="index.php" class="text-decoration-none text-primary">
                    <i class="fas fa-home"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16" style="vertical-align: bottom;">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                    </svg>
                    Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                My Profile
            </li>
        </ol>
    </nav>

            <div class="container mt-5" style="padding:0 20vw; margin:30vh 0 10vh 0;">
                <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center" style="padding: 2vh 1vw 0 1vw;">
            <div class="d-flex align-items-center">
                <div id="myname" class="me-3">
                    <?php echo htmlspecialchars($customer['first_name']) . " " . htmlspecialchars($customer['last_name']); ?>
                </div>
                <div id="myemail" class="me-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                    </svg>
                    <?php echo htmlspecialchars($customer['email']); ?>
                </div>
                <div id="myphone">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>    
                    <?php echo htmlspecialchars($customer['phone_no']); ?>
                </div>
            </div>

            <!-- Logout Button -->
            <a href="logout.php" style="display: inline-block;">
                <button type="button" class="btn btn-secondary" style="border-radius: 20px;">Logout</button>
            </a>
        </div>

            <div class="card-body">
                <h4 class="mb-3">Account Details</h4>
                <!-- Form Fields to update profile -->
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label">Mobile Number (+94xxxxxxxxx)</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($customer['phone_no']); ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required><?php echo htmlspecialchars($customer['address']); ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="dob" name="birthday" style="width: 10vw;" value="<?php echo htmlspecialchars($customer['birthday']); ?>" required>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
                <hr>
                <!-- Form Fields for password change -->
                <h4 class="mb-3">Change Password</h4>
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        </div>
                        <div class="col-md-12">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="col-md-12">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-warning mt-3">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
