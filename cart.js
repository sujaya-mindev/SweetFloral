function addToCart(productCode, productName, productPrice, productImage, quantity) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    quantity = parseInt(quantity); // Convert to integer

    // Check if the product already exists in cart
    let existingProduct = cart.find(item => item.code === productCode);

    if (existingProduct) {
        existingProduct.quantity += quantity; // Increase quantity if product exists
    } else {
        cart.push({
            productCode,
            productName,
            productPrice,
            productImage: encodeURI(productImage),
            quantity: quantity // Store the selected quantity
        });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert(quantity +" x "+ productName + " added to cart!");
    loadCart(); // Refresh the cart display
}



function updateCartBadge() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    document.querySelector(".cart-icon .badge").textContent = totalItems;
}

document.addEventListener("DOMContentLoaded", updateCartBadge);


function loadCart() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let cartItemsContainer = document.getElementById("cart-items");

    cartItemsContainer.innerHTML = cart.length ? "" : "<p>Your cart is empty.</p>";

    cart.forEach((item, index) => {
        let decodedImagePath = decodeURIComponent(item.productImage); // Decode URL
        
        let li = document.createElement("li");
        li.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");
        li.innerHTML = `
            <div class="d-flex align-items-center">
                <img src="${decodedImagePath}" width="30%" class="rounded me-2"> 
                <div>
                    <span style='font-size: 15px;'>${item.productName}</span>
                    <p class="text-muted mb-0">Quantity: <strong>${item.quantity}</strong></p>
                    <p class="text-muted mb-0">Price: Rs. ${item.productPrice}</p>
                </div>
            </div>
            <button class="btn btn-danger" onclick="removeFromCart(${index})">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                </svg>
            </button>
        `;
        cartItemsContainer.appendChild(li);
    });

    updateCartBadge();
}



function removeFromCart(index) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.splice(index, 1);  // Remove the item at the given index
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCart();  // Reload the cart
}

function updateCartBadge() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    document.querySelector(".cart-icon .badge").textContent = totalItems;
}

document.getElementById("cartOffcanvas").addEventListener("show.bs.offcanvas", loadCart);

document.getElementById("cartOffcanvas").addEventListener("show.bs.offcanvas", function () {
    // Remove existing backdrops before adding a new one
    document.querySelectorAll(".offcanvas-backdrop").forEach(backdrop => backdrop.remove());
});


// Clear the cart
function clearCart() {
        localStorage.removeItem("cart");
        loadCart();
}

// This function will be triggered when the user clicks on the Checkout button
function proceedToCheckout() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
    // Create a query string to pass to the checkout page
    let queryString = '';
    
    cart.forEach((item, index) => {
        queryString += `&product_code${index}=${item.productCode}&product_name${index}=${item.productName}&product_price${index}=${item.productPrice}&quantity${index}=${item.quantity}&product_image${index}=${item.productImage}`;
    });
    
    // Redirect to checkout page with cart data in the URL
    window.location.href = 'checkout.php?' + queryString;
}
