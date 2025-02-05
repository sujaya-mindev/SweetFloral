<?php
include 'conn.php'; // Ensure database connection

if (isset($_GET['id'])) {
    $product_code = $_GET['id']; // Get product_code from URL

    // Fetch product details
    $query = "SELECT * FROM product WHERE product_code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $product_code); // Changed to string "s"
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        header("Location: manage.php?error=2"); // Product not found
        exit();
    }
} else {
    header("Location: manage.php?error=3"); // No product ID provided
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['Stock'];
    $product_code = $_POST['product_code']; // Ensure it matches fetched product
    $image_path = $product['product_image']; // Default to existing image

    // Handle Image Upload
    if (!empty($_FILES["product_image"]["name"])) {
        $image_extension = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'avif'];

        if (in_array($image_extension, $allowed_extensions)) {
            $target_dir = "images/$category/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . $product_code . "." . $image_extension;

            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $image_path = $target_file; // Update image path
            } else {
                header("Location: update.php?id=$product_code&error=4");
                exit();
            }
        } else {
            header("Location: update.php?id=$product_code&error=5");
            exit();
        }
    }

    // Update query
    $update_query = "UPDATE product SET product_name = ?, product_price = ?, product_description = ?, product_stock = ?, product_image = ? WHERE product_code = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sdsiss", $name, $price, $description, $stock, $image_path, $product_code); // Changed "i" to "s"

    if ($stmt->execute()) {
        header("Location: update.php?id=$product_code&success=1");
        exit();
    } else {
        header("Location: update.php?id=$product_code&error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Product</h2>

        <!-- Success Message -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">✅ Product updated successfully!</div>
            <script>
                setTimeout(function() {
                    window.location.href = "manage.php";
                }, 2000);
            </script>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                ❌ 
                <?php
                    switch ($_GET['error']) {
                        case 1: echo "Error updating product."; break;
                        case 2: echo "Product not found."; break;
                        case 3: echo "No product ID provided."; break;
                        case 4: echo "Image upload failed."; break;
                        case 5: echo "Invalid image format. Only JPG, JPEG, PNG, and GIF allowed."; break;
                        default: echo "An unknown error occurred.";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <img src="<?= $product['product_image'] ?>" alt="Product Image" class="img-fluid mb-3" style="border-radius: 10px;">
            <div class="mb-3">
                <label class="form-label">Product Code</label>
                <input type="text" name="product_code" class="form-control" value="<?= htmlspecialchars($product['product_code']) ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($product['product_price']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required><?= htmlspecialchars($product['product_description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" step="1" name="Stock" class="form-control" value="<?= htmlspecialchars($product['product_stock']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload New Image</label>
                <input type="file" name="product_image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>
</html>
