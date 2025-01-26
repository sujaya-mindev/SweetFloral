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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                <img src="images/index/promo/promotion_section-1.avif" id="promo" class="img-fluid" alt="Promotion 1">
            </div>
            <div class="col">
                <img src="images/index/promo/promotion_section-2.avif" id="promo" class="img-fluid" alt="Promotion 2">
            </div>
            <div class="col">
                <img src="images/index/promo/promotion_section-3.avif" id="promo" class="img-fluid" alt="Promotion 3">
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="container-fluid" id="categories">
        <div class="row">
            <div class="card" id="category-card">
                <div class="row">
                    <div class="col" id="category-image">
                        <img src="images/index/flowers.png" class="img-fluid" alt="..." style="padding-left: 5px; width: 90%; margin: 10px;">
                    </div>
                    <div class="col" id="category-image">
                        <img src="images/index/1.png" class="img-fluid" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small>Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="category-card">
                <img src="images/index/cakes.png" class="img-fluid" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
        
    
    
    <!-- Featured Products 
    <div id="bestsellers">
        <h2>Best Sellers</h2>
    </div>

    <div class="container my-4" id="product-grid">
        <div id="productRow" class="d-flex overflow-auto">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card product-card" id="product-card">
                    <img src="<?php echo $row['product_image']; ?>" class="img-fluid" alt="<?php echo $row['product_name']; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title" id="product-title"><?php echo $row['product_name']; ?></h5>
                    </div>
                    <div class="card-footer" id="product-price">
                        <small class="text-body-secondary">Rs: <?php echo number_format($row['product_price'], 2); ?></small>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    -->

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>