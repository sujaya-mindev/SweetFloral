<html>
    <head>
    </head>
    <body>
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $product['product_category']; ?>.php"><?php echo ucfirst($product['product_category']); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $product['product_code']; ?></li>
                </ol>
            </nav>
        </div>
    </body>
</html>