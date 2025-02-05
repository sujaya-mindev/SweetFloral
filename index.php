<?php
// Include database connection
include 'conn.php';

// Fetch products from the database
$query = "SELECT * FROM product ORDER BY RAND() LIMIT 6";
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
    
    <div style="padding-top: 2.4vh;"></div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
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
        </ol>
    </nav>

    <div style="padding: 0 5vw;">
        <!-- Carousel Section -->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/index/banner/banner-1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/index/banner/banner-2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/index/banner/banner-3.png" class="d-block w-100" alt="...">
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
            <div class="row promo">
                <div class="col">
                    <img src="images/index/promo/promo-1.png" id="promo" class="img-fluid" alt="Promotion 1">
                </div>
                <div class="col">
                    <img src="images/index/promo/promo-2.png" id="promo" class="img-fluid" alt="Promotion 2">
                </div>
                <div class="col">
                    <img src="images/index/promo/promo-3.png" id="promo" class="img-fluid" alt="Promotion 3">
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="container-fluid" id="categories">
            <div class="row">
                <div class="card" id="category-card" onclick="window.location.href='flowers.php'" style="cursor: pointer;">
                    <div class="row">
                        <div class="col" id="category-image1">
                            <img src="images/index/bg.png" class="img-fluid" alt="...">
                        </div>
                        <div class="col" id="category-image1">
                            <img src="images/index/purple-bg.png" class="img-fluid" alt="...">
                            <div class="card-img-overlay">
                                <h4 class="card-title cat">Flowers</h4>
                                <p class="card-text">Brighten Any Occasion with Fresh Flowers! Whether it's a birthday, anniversary, or any other special occasion, our fresh flowers are perfect for making every moment memorable.</p>
                                <h5 class="shop-now">Shop Now
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                    </svg>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="category-card" onclick="window.location.href='cakes.php'" style="cursor: pointer;">
                    <div class="row">
                        <div class="col" id="category-image2">
                            <img src="images/index/bg.png" class="img-fluid" alt="...">
                        </div>
                        <div class="col" id="category-image2">
                            <img src="images/index/blue-bg.png" class="img-fluid" alt="...">
                            <div class="card-img-overlay">
                                <h4 class="card-title cat">Cakes</h4>
                                <p class="card-text">Best Fresh Online Cakes! We offer a delectable range of handcrafted cakes, perfect for celebrating birthdays, anniversaries, graduations, or any other occasion.</p>
                                <h5 class="shop-now">Shop Now 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                    </svg>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        
        
        <!-- Featured Products -->
        <div id="bestsellers">
            <h2>Best Sellers</h2>
        </div>

        <div class="container my-4" id="product-grid">
            <div id="productRow" class="d-flex overflow-auto">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <a href="viewproduct.php?product_code=<?php echo $row['product_code']; ?>" style="text-decoration:none" class="card product-card" id="product-card">
                        <img src="<?php echo $row['product_image']; ?>" class="img-fluid" alt="<?php echo $row['product_name']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title product-title"><?php echo $row['product_name']; ?></h5>
                        </div>
                        <div class="card-footer product-price">
                            <small class="text-body-secondary">Rs: <?php echo number_format($row['product_price'], 2); ?></small>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    
    

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>