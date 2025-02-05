<?php
// Initialize session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fetch cart data from the query string
$cartItems = [];
for ($i = 0; isset($_GET['product_code' . $i]); $i++) {
    $cartItems[] = [
        'product_code' => $_GET['product_code' . $i],
        'product_name' => $_GET['product_name' . $i],
        'product_price' => $_GET['product_price' . $i],
        'quantity' => $_GET['quantity' . $i],
        'product_image' => $_GET['product_image' . $i],
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="checkout.css">
    <style>
        .product-item {
            border-bottom: 1px solid #ddd; /* Add a separator between items */
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .product-item img {
            max-width: 100px; /* Set max width for product images */
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Include Navbar -->
    <div id="navbar"></div>
    <script>fetch('navbar.php').then(response => response.text()).then(data => document.getElementById('navbar').innerHTML = data);</script>

    <!-- Breadcrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb bg-light p-3 rounded" style="background-color: #fffcf2; font-weight: bold;">
            <li class="breadcrumb-item">
                <a href="index.php" class="text-decoration-none text-primary">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo htmlspecialchars($product['product_name']); ?>
            </li>
        </ol>
    </nav>

    <div class="container mt-4" style="padding: 0 10vw;">
        <!-- Full Width Header Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h2>Checkout</h2>
            </div>
        </div>

        <div class="row">
            <!-- Recipient and Sender Information Card (Left Side) -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="process_checkout.php" method="POST">
                            <h4>Recipient Information</h4>
                            <div class="mb-3">
                                <label for="recipientName" class="form-label">Recipient Name</label>
                                <input type="text" class="form-control" id="recipientName" name="recipientName" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipientAddress" class="form-label">Recipient Address</label>
                                <textarea class="form-control" id="recipientAddress" name="recipientAddress" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="">Select City</option>
                                    <option value="Colombo">Colombo</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="primaryContact" class="form-label">Primary Contact Number</label>
                                <input type="tel" class="form-control" id="primaryContact" name="primaryContact" required>
                            </div>
                            <div class="mb-3">
                                <label for="secondaryContact" class="form-label">Secondary Contact Number</label>
                                <input type="tel" class="form-control" id="secondaryContact" name="secondaryContact">
                            </div>

                            <h4>Sender Information</h4>
                            <div class="mb-3">
                                <label for="senderName" class="form-label">Sender Name</label>
                                <input type="text" class="form-control" id="senderName" name="senderName" required>
                            </div>
                            <div class="mb-3">
                                <label for="senderEmail" class="form-label">Sender Email</label>
                                <input type="email" class="form-control" id="senderEmail" name="senderEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="senderPhone" class="form-label">Sender Phone</label>
                                <input type="tel" class="form-control" id="senderPhone" name="senderPhone" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-5">
                <!-- Ordered Products Card (Above Payment Summary) -->
                <div class="card">
                    <div class="card-body">
                        <h4>Ordered Products</h4>
                        <?php
                        $totalAmount = 0;
                        foreach ($cartItems as $item) {
                            $subtotal = $item['product_price'] * $item['quantity'];
                            $totalAmount += $subtotal;
                            echo "<div class='product-item row'>
                                <div class='col-4'>
                                    <img src='" . htmlspecialchars($item['product_image']) . "' class='img-fluid' alt='Product Image' style='max-width: inherit;'>
                                </div>
                                <div class='col-8'>
                                    <strong>" . htmlspecialchars($item['product_name']) . "</strong>
                                    <p>Product Code: " . htmlspecialchars($item['product_code']) . "</p>
                                    <p>Price: Rs. " . number_format($item['product_price'], 2) . "</p>
                                    <p>Quantity: " . htmlspecialchars($item['quantity']) . "</p>
                                </div>
                            </div>";
                        }
                        $flatDiscount = $totalAmount * 0.05;
                        $deliveryFee = 499.00;
                        $finalTotal = $totalAmount - $flatDiscount + $deliveryFee;
                        ?>
                    </div>
                </div>

                <!-- Payment Summary and Proceed to Payment Button Card (Below Ordered Products) -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h4>Payment Summary</h4>
                        <div class="summary">
                            <p>Sub Total: <span id="subtotal">Rs. <?php echo number_format($totalAmount, 2); ?></span></p>
                            <p>Flat Discount (5%): <span id="flatDiscount">Rs. <?php echo number_format($flatDiscount, 2); ?></span></p>
                            <p>Delivery Fee: <span id="deliveryFee">Rs. <?php echo number_format($deliveryFee, 2); ?></span></p>
                            <h4>Total: <strong id="totalAmount">Rs. <?php echo number_format($finalTotal, 2); ?></strong></h4>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Proceed to Payment</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <div id="footer"></div>
    <script>fetch('footer.html').then(response => response.text()).then(data => document.getElementById('footer').innerHTML = data);</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
