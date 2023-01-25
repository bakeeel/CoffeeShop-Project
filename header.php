
<?php

$cartCount = isset($_SESSION['cartCount']) ? $_SESSION['cartCount'] : 0;

function logout() {
    unset($_SESSION['userId']);
    unset($_SESSION['firstName']);
    unset($_SESSION['isSignedIn']);
    unset($_SESSION['isAdmin']);

    header("Location: index.php");
}

if (isset($_GET['logout'])) {
    logout();
}

?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarExpansion"
                aria-controls="navbarExpansion" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarExpansion">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="shop-buy.php">Shop Now</a>
                </li>
                <li class="nav-item text-center text-lg-right">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class='text-center cart-container mr-0 mr-lg-4' onmouseover="cartHover()">
                    <a href='cart.php'>
                        <i class="fas fa-shopping-cart"></i>
                        <p id="cart-counter" class="cart-counter"><?php echo $cartCount ?></p>
                    </a>
                </li>

                <?php if (isset($_SESSION['isSignedIn']) && $_SESSION['isSignedIn'] === true) { ?>
                    <!-- Display this if you are logged in -->
                    <li class="nav-item dropdown text-center text-lg-right">
                        <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome <?php echo $_SESSION["firstName"] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-dark" style='padding: 0.25rem 1.5rem;'
                               href="order-history.php">Order History</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-dark" style='padding: 0.25rem 1.5rem;'
                               href="<?php $_SERVER['SCRIPT_NAME']?>?logout=TRUE">Logout</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <!-- Display this if you are NOT logged in -->
                    <li class='text-center text-lg-right'>
                        <a href='login.php?redirect_url=<?php echo $_SERVER['SCRIPT_NAME']; ?>'
                           class='mr-0 mr-lg-4'>Login</a>
                    </li>
                    <li class='text-center text-lg-right'>
                        <a href='signup.php' class='mr-0 mr-lg-4'>Sign Up</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>