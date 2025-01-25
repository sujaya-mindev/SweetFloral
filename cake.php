<?php
// Include database connection
include 'conn.php';

// Fetch products from the database
$query = "SELECT * FROM product";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <?php include 'navbar.html'; ?>

    <!-- Hero Section -->
    <div>
        <h1>Welcome to the Best Online Cake Delivery Service in Sri Lanka </h1>
        <p id="abc">Discover amazing products at great prices!</p>
    </div>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="images/banner-1696400116178.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images/banner-1731379663075.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images/Pastel Pink and Brown Modern Sale Food Banner.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <h5>
            Sri Lanka’s Best Fresh Online Cakes! At ((Lassana.com)), we offer a delectable range of handcrafted cakes,
             perfect for celebrating birthdays, anniversaries, graduations, or any other occasion.Experience the best online cake delivery service in Sri Lanka, bringing sweet moments right to your doorstep!
</h5>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Products Section -->
    <div class="container-fluid">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <p class="card-text">Rs:<?php echo number_format($row['product_price'], 2); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>