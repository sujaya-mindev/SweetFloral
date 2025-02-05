<?php
// Include database connection
include 'conn.php';

// Fetch product from the database
if (isset($_GET['product_code'])) {
    $product_code = $_GET['product_code'];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_code = ?");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Display product details here
    } else {
        echo "Product not found!";
    }
} else {
    echo "No product selected!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="viewproduct.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- Breadcrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb bg-light p-3 rounded" style="background-color: #fffcf2; font-weight: bold;">
            <li class="breadcrumb-item">
                <a href="index.php" class="text-decoration-none text-primary">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo htmlspecialchars($product['product_category']); ?>.php" class="text-decoration-none text-primary"><?php echo htmlspecialchars($product['product_category']); ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo htmlspecialchars($product['product_name']); ?>
            </li>
        </ol>
    </nav>

    <div class="container product-container" style="margin: 12vh 0;">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-5 text-center">
                <img 
                    src="<?php echo htmlspecialchars($product['product_image']); ?>" 
                    class="product-image" 
                    alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                >
            </div>

            <!-- Product Details -->
            <div class="col-lg-5" style="margin: 0 0 0 5vw;">
                <h1 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                <p class="text-muted">Product Code: <strong><?php echo htmlspecialchars($product['product_code']); ?></strong></p>
                <p class="product-price">Rs: <?php echo number_format($product['product_price'], 2); ?></p>
                <p class="text-secondary"><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>

                <!-- Quantity Selector -->
                <div class="quantity-selector">
                    <button onclick="decreaseQuantity()">-</button>
                    <span id="quantity">1</span>
                    <button onclick="increaseQuantity()">+</button>
                </div>

                <!-- Add to Cart and Buy Now Buttons -->
                <button class="btn-add-to-cart" onclick="addToCart(
                    '<?php echo $product['product_code']; ?>', 
                    '<?php echo $product['product_name']; ?>', 
                    '<?php echo $product['product_price']; ?>', 
                    '<?php echo str_replace('\\', '/', $product['product_image']); ?>', 
                    document.getElementById('quantity').textContent.trim() // Ensure correct quantity
                )">ADD TO CART</button>

                <button class="btn-buy-now mt-2" onclick="window.location.href='checkout.php?product_code=<?php echo htmlspecialchars($product['product_code']); ?>&product_name=<?php echo htmlspecialchars($product['product_name']); ?>&product_price=<?php echo htmlspecialchars($product['product_price']); ?>&quantity=' + document.getElementById('quantity').textContent.trim()">BUY IT NOW</button>

                <hr class="my-4">

                <div class="delivery-info">
                    <p><i class="fas fa-truck"></i> Free delivery within 5-7 business days</p>
                    <p><i class="fas fa-undo"></i> Easy returns within 30 days</p>
                    <p><i class="fas fa-shield-alt"></i> Secure payment options</p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <script src="cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
        let quantity = 1;

        function increaseQuantity() {
            quantity++;
            document.getElementById('quantity').innerText = quantity;
        }

        function decreaseQuantity() {
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantity').innerText = quantity;
            }
        }
    </script>
</body>
</html>
