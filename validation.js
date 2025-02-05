document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const productCode = document.querySelector("input[name='product_code']");
    const productName = document.querySelector("input[name='product_name']");
    const productDescription = document.querySelector("textarea[name='product_description']");
    const productCategory = document.querySelector("select[name='product_category']");
    const productStock = document.querySelector("input[name='product_stock']");
    const productPrice = document.querySelector("input[name='product_price']");
    const productImage = document.querySelector("input[name='product_image']");

    form.addEventListener("submit", function (event) {
        let errors = [];

        // Validate Product Code (Required, Alphanumeric)
        if (!productCode.value.trim()) {
            errors.push("Product Code is required.");
        } else if (!/^[a-zA-Z0-9_-]+$/.test(productCode.value.trim())) {
            errors.push("Product Code should be alphanumeric (letters, numbers, dashes, underscores).");
        }

        // Validate Product Name (Required)
        if (!productName.value.trim()) {
            errors.push("Product Name is required.");
        }

        // Validate Product Category (Required)
        if (!productCategory.value.trim()) {
            errors.push("Product Category is required.");
        }

        // Validate Product Stock (Required, Positive Number)
        if (!productStock.value.trim()) {
            errors.push("Stock quantity is required.");
        } else if (isNaN(productStock.value) || productStock.value <= 0) {
            errors.push("Stock must be a positive number.");
        }

        // Validate Product Price (Required, Positive Number)
        if (!productPrice.value.trim()) {
            errors.push("Product Price is required.");
        } else if (isNaN(productPrice.value) || productPrice.value <= 0) {
            errors.push("Price must be a positive number.");
        }

        // Validate Image Upload (Allow .jpg, .jpeg, .png, .gif, .avif)
        if (productImage.files.length > 0) {
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.avif)$/i;
            if (!allowedExtensions.test(productImage.files[0].name)) {
                errors.push("Invalid image format. Allowed formats: .jpg, .jpeg, .png, .gif, .avif");
            }
        }

        // Display errors and prevent form submission
        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }
    });
});
