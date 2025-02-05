<?php
require 'conn.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle product insertion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $code = trim($_POST['product_code']);
    $name = trim($_POST['product_name']);
    $description = trim($_POST['product_description']);
    $category = trim($_POST['product_category']);
    $stock = intval($_POST['product_stock']);
    $price = floatval($_POST['product_price']);
    $target_file = "";

    // Check if product already exists
    $checkStmt = $conn->prepare("SELECT * FROM product WHERE product_code = ?");
    $checkStmt->bind_param("s", $code);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        die("Error: Product code already exists! Use a unique product code.");
    }

    // Handle image upload
    if (!empty($_FILES["product_image"]["name"])) {
        $image_extension = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'avif'];

        if (in_array($image_extension, $allowed_extensions)) {
            $target_dir = "images\\$category\\";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . $code . "." . $image_extension;

            if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                die("Error uploading image. Check folder permissions or path: " . $target_file);
            }
        } else {
            die("Invalid image format. Allowed formats: jpg, jpeg, png, gif, avif.");
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO product (product_code, product_name, product_description, product_image, product_category, product_stock, product_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssid", $code, $name, $description, $target_file, $category, $stock, $price);

    if ($stmt->execute()) {
        header("Location: manage.php?success=1");
        exit();
    } else {
        die("Error adding product: " . $stmt->error);
    }
}

// Handle product deletion
if (isset($_GET['delete'])) {
    $product_code = $_GET['delete'];

    // Fetch product image to delete it
    $stmt = $conn->prepare("SELECT product_image FROM product WHERE product_code = ?");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product && file_exists($product['product_image'])) {
        unlink($product['product_image']); // Delete the image file
    }

    // Delete product from database
    $stmt = $conn->prepare("DELETE FROM product WHERE product_code = ?");
    $stmt->bind_param("s", $product_code);
    $stmt->execute();

    header("Location: manage.php");
}

// Fetch all products
$query = "SELECT * FROM product";
$filter_query = $query;

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%";
    $query .= " WHERE product_code LIKE ?";
    $filter_query = $query;
} elseif (isset($_GET['category']) && in_array($_GET['category'], ['flowers', 'cakes'])) {
    $category = $_GET['category'];
    $query .= " WHERE product_category = ?";
    $filter_query = $query;
}

// Prepare and execute query
$stmt = $conn->prepare($filter_query);
if (isset($search)) {
    $stmt->bind_param("s", $search);
} elseif (isset($category)) {
    $stmt->bind_param("s", $category);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="manage.css">
    <script src="validation.js" defer></script>
</head>
<body>

    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <h2 style="margin: 0 0 0 1vw;">Manage Products</h2>
            </div>
            <div class="col-md-8" style="display: flex; flex-direction: row-reverse; padding-right: 3vw;">
                <a href="logout.php">
                    <button type="button" class="btn btn-secondary" style="margin-left: 10px; border-radius: 20px;">Logout</button>
                </a>
            </div>
        </div>
        <div class="row" style="margin: 6vh 3vw 0 3vw;">
            <div class="col-md-4">
                <div class="card p-4 mb-4">
                    <h4>Add New Product</h4>
                    
                    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="alert alert-success">✅ Product added successfully!</div>
                        <script>
                            // Redirect after 2 seconds to avoid the user seeing the success message too long
                            setTimeout(function() {
                                window.location.href = "manage.php";
                            }, 2000);
                        </script>
                    <?php endif; ?>
                    
                    <form id="productForm" action="manage.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="product_code" class="form-control mb-2" placeholder="Product Code" required>
                        <input type="text" name="product_name" class="form-control mb-2" placeholder="Product Name" required>
                        <textarea name="product_description" class="form-control mb-2" placeholder="Product Description"></textarea>
                        <input type="file" name="product_image" class="form-control mb-2">
                        <select name="product_category" class="form-control mb-2" required>
                            <option value="flowers">Flowers</option>
                            <option value="cakes">Cakes</option>
                        </select>
                        <input type="number" name="product_stock" class="form-control mb-2" placeholder="Stock Quantity" required>
                        <input type="text" name="product_price" class="form-control mb-2" placeholder="Price (Rs)" required>
                        <button type="submit" name="add_product" class="btn btn-success w-100">Add Product</button>
                    </form>
                </div>
            </div>
            


            <div class="col-md-8" style="padding-left: 3vw;">
                <div class="d-flex justify-content-between mb-3">
                    <form method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search by Product Code">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="manage.php" class="btn btn-secondary ms-2">Reset</a>
                    </form>
                    <form method="GET">
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">Filter by Category</option>
                            <option value="flowers">Flowers</option>
                            <option value="cakes">Cakes</option>
                        </select>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Price (Rs)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?php echo $row['product_image']; ?>" alt="Image" class="img-thumbnail" style="width: 80px;"></td>
                            <td><?php echo $row['product_code']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo ucfirst($row['product_category']); ?></td>
                            <td><?php echo $row['product_stock']; ?></td>
                            <td>Rs: <?php echo $row['product_price']; ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $row['product_code']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="manage.php?delete=<?php echo $row['product_code']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
