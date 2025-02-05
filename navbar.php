<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
?>
<link rel="stylesheet" href="navbar.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

<style>
    #logo {
        font-family: "Pacifico", serif;
        font-weight: 400;
        font-style: normal;
        font-size: 4vh;
    }
</style>

<header class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php" id="logo">Sweet Floral</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Account Icon -->
                <li class="nav-item">
                    <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo '<a href="login.php">
                                <button type="button" class="btn" style="color: #353535; background-color: #f2e9e4; margin: 1vh 1vw 0 0; border-radius: 20px; padding: 0.6vh 1vw;">
                                    Login
                                </button>
                              </a>';
                    } else {
                        if ($_SESSION['user_type'] == "customer") {
                            echo '<a href="myprofile.php">
                                    <button type="button" class="btn" style="color: #353535; background-color: #f2e9e4; margin: 1vh 1vw 0 0; border-radius: 20px; padding: 0.6vh 1vw;">
                                        My Profile
                                    </button>
                                  </a>';
                        } elseif ($_SESSION['user_type'] == "admin") {
                            echo '<a href="manage.php">
                                    <button type="button" class="btn" style="color: #353535; background-color: #f2e9e4; margin: 1vh 1vw 0 0; border-radius: 20px; padding: 0.6vh 1vw;">
                                        Manage
                                    </button>
                                  </a>';
                        }
                    }
                    ?>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item cart-icon">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#f2e9e4" class="bi bi-cart3" viewBox="0 0 16 16" style="padding-right: 0.2vw;">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        <span class="badge" id="cart-count">0</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Cart Offcanvas -->
<div class="offcanvas offcanvas-end" id="cartOffcanvas">
    <div class="offcanvas-header">
        <h5><b>Shopping Cart</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul id="cart-items" class="list-group"></ul>
        <button class="btn w-100 mt-2" style="background-color: #8bc34a;" onclick="proceedToCheckout()">Checkout</button>
        <button class="btn btn-danger w-100 mt-3" onclick="clearCart()">Clear Cart</button>
    </div>
</div>

<script src="cart.js"></script>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
