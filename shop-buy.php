<?php

/*
Keegan Fargher
17920334
I confirm that this assignment is my own work and any work copied shall be referenced accordingly.
*/

session_start();
include_once("php/shoppingCart.php");

if (isset($_SESSION["cart"])) {
    $cart = unserialize($_SESSION["cart"]);
    $cart->loadItems();
    $cart->processUserInput();
} else {
    $cart = new ShoppingCart();
    $cart->loadItems();
    $cart->initializeCart();
    $cart->processUserInput();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("meta.php"); ?>
    <link rel="stylesheet" href="css/toast.min.css">
    <title>Shop Coffee</title>
</head>

<body>
<!-- LOADING CIRCLE 
<div class="loader-background">
    <div class="loader">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>-->

<?php require("header.php"); ?>

<!-- Light Roast Coffee -->
<div class="container-white container-fluid">
    <h1 class="text-center line-under-text">SHOP LIGHT ROAST</h1>

    <div class="cart-items-container">
        <?php
        $card_style = "text-white bg-primary";
        $button_style = "btn-outline-secondary button-card-white";
        $title_style = $description_style = "";
        $coffee_strength_id = 1;

        $cart->getProducts($card_style, $button_style, $title_style, $description_style, $coffee_strength_id);
        ?>
    </div>
</div>

<!-- Dark Roast Coffee -->
<div class="container-black container-fluid">
    <h1 class="text-center line-under-text">SHOP DARK ROAST</h1>

    <div class="cart-items-container">
        <?php
        $card_style = "border-primary";
        $button_style = "btn-primary button-card-black";
        $title_style = "text-dark";
        $description_style = "text-grey";
        $coffee_strength_id = 1;

        $cart->getProducts($card_style, $button_style, $title_style, $description_style, $coffee_strength_id);
        ?>
    </div>
</div>

<?php require("footer.php"); ?>

<!-- JAVASCRIPT REQUIRED -->
<script src="js/loader.js"></script>
<script src="js/shop-buy.js"></script>
<script src="js/toast.min.js"></script>
<script src="js/toastroptions.js"></script>
<script src="js/loader.js"></script>
<?php
$_SESSION["cart"] = serialize($cart);
echo $cart->getToastMessage();
?>
</body>

</html>