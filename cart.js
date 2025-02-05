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
                <img src="${decodedImagePath}" width="50" height="50" class="rounded me-2"> 
                <div>
                    <span><strong>${item.productName}</strong> (x${item.quantity})</span>
                    <p class="text-muted mb-0">Rs: ${item.productPrice}</p>
                </div>
            </div>
            <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">
                <i class="fas fa-trash"></i>
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