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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include 'navbar.html'; ?>

    <!-- Carousel Section -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="images/index/banner/banner-1.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images/index/banner/banner-2.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images/index/banner/banner-3.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images/index/banner/banner-4.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images/index/banner/banner-5.avif" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Promotions -->
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="images/index/promo/promotion_section-1.avif" id="promo" alt="Promotion 1">
            </div>
            <div class="col">
                <img src="images/index/promo/promotion_section-2.avif" id="promo" alt="Promotion 2">
            </div>
            <div class="col">
                <img src="images/index/promo/promotion_section-3.avif" id="promo" alt="Promotion 3">
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div id="bestsellers">
        <h2>Best Sellers</h2>
    </div>
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php 
            $rowCount = 0;
            $itemsPerRow = 6;
            $activeClass = "active";
            while ($row = $result->fetch_assoc()): 
                if ($rowCount % $itemsPerRow === 0): ?>
                    <div class="carousel-item <?php echo $activeClass; ?>">
                        <div class="row">
                <?php 
                $activeClass = "";
                endif; ?>

                <div class="col-md-4 col-lg-3 mb-4" id="col-lg-3">
                    <div id="bestsellers">
                        <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <p class="card-text">$<?php echo number_format($row['product_price'], 2); ?></p>
                        </div>
                    </div>
                </div>
            
                <?php 
                $rowCount++;
                if ($rowCount % $itemsPerRow === 0 || $rowCount === $result->num_rows):?>
                        </div>
                    </div>
                <?php endif; 
            endwhile; ?>
        </div>
    </div>





    <!-- Product Grid -->
    <div class="container my-5">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card product-card">
                        <img src="images/<?php echo $row['product_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                            <p class="card-text"><?php echo $row['product_description']; ?></p>
                            <p class="card-text">$<?php echo number_format($row['product_price'], 2); ?></p>
                            
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