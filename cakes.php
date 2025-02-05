<?php
// Include database connection
include 'conn.php';

// Fetch products from the database
$query = "SELECT * FROM product WHERE product_category='cakes'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cakes.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div style="padding-top: 2vh;"></div>

    <!-- Breadcrumb -->
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
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
                Cakes
            </li>
        </ol>
    </nav>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="images\cakes\banner\banner1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images\cakes\banner\banner2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images\cakes\banner\banner3.jpg" class="d-block w-100" alt="...">
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
    <p>
    Sri Lanka’s Best Fresh Online Cakes!, we offer a delectable range of handcrafted cakes, perfect for celebrating birthdays, anniversaries, graduations, or any other occasion. Experience the best online cake delivery service in Sri Lanka, bringing sweet moments right to your doorstep!</p>


    <!-- Products Section -->
    <div class="container-fluid">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <a href="viewproduct.php?product_code=<?php echo $row['product_code']; ?>" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                <p class="card-text">Rs:<?php echo number_format($row['product_price'], 2); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>