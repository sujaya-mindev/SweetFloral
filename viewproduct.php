<?php
// Include database connection
include 'conn.php';

// Fetch product from the database
$query = "SELECT * FROM product WHERE product_code = 'FLOWERLCOM21'";
$result = $conn->query($query);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.html'; ?>

    <!-- Breadcrumb -->
    <?php include 'breadcrumb.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <img src="<?php echo $product['product_image']; ?>" class="card-img-top" alt="<?php echo $product['product_name']; ?>">
            </div>
            <div class="col">
                <h1><?php echo $product['product_name']; ?></h1>
                <p>Product Code: <?php echo $product['product_code']; ?></p>
                <p>Rs:<?php echo number_format($product['product_price'], 2); ?></p>
                <p><?php echo $product['product_description']; ?></p>
                
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>