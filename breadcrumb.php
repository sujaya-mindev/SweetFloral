<html>
    <head>
    </head>
    <body>
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="my-4">
                <ol class="breadcrumb bg-light p-3 rounded">
                    <li class="breadcrumb-item">
                        <a href="index.php" class="text-decoration-none text-primary">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="category.php" class="text-decoration-none text-primary">Category</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo htmlspecialchars($product['product_name']); ?>
                    </li>
                </ol>
            </nav>
        </div>
    </body>
</html>