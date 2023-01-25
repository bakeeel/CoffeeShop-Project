

<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("meta.php") ?>

    <title>Home</title>
</head>

<body>
    <!-- LOADING CIRCLE 
    <div class="loader-background">
        <div class="loader">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>-->

    <?php include_once("header.php"); ?>

    <!-- FULL SCREEN BANNER -->
    <div class="full-screen-image">
        <div class="hero-text-box">
            <h1 class="mb-3">Instant coffee is dead. <br /> Take the plunge.</h1>
            <a class="btn btn-primary mr-0 mr-sm-2 mb-3 mb-sm-0 width-250px" href="shop-buy.php">I want coffee</a>
        </div>
    </div>


    <!-- CONTACT US SECTION -->
    <section class="section-form">
        <div class="container">
            <h2 class="text-center line-under-text">We're happy to hear from you</h2>

            <form method="POST" action="https://formspree.io/fargherkeegan@gmail.com" class="contact-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input class="form-control" name="name" placeholder="Enter Full Name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>

                <div class="form-group">
                    <label for="findus">How Did You Find Us?</label>
                    <select class="form-control" id="findus">
                        <option value="Friends" selected>Friends</option>
                        <option value="Other">Other</option>
                        <option value="Ad">Advertisement</option>
                        <option value="Search-engine">Search engine</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="textarea">Drop us a Line</label>
                    <textarea class="form-control" id="textarea" rows="3" name="message"></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="Send">

            </form>
        </div>
        </div>

    </section>

    <?php include_once("footer.php"); ?>

    <!-- JAVASCRIPT REQUIRED -->
    <script src="js/loader.js"></script>
    <script src="js/main.js"></script>
</body>

</html>