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
    
    <div class="search-bar-container">
    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search for anything..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="images\flowers\banner\banner1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images\flowers\banner\banner2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="images\flowers\banner\banner3.jpg" class="d-block w-100" alt="...">
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
    <p> Bring Joy to Any Event with Fresh Flowers! Our speciality at yeee.com is spreading happiness with our exquisite floral arrangements. Our fresh flowers are ideal for making every moment unique, whether it's a birthday, anniversary,or any other special occasion.</p>


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