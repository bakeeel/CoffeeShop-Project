
<?php
session_start();

include_once("php/login-script.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    include_once("meta.php");

    $GET_email    = isset($_GET['email'])    ? $_GET['email']    : "";
    $GET_password = isset($_GET['password']) ? $_GET['password'] : "";
    $GET_error    = isset($_GET['error'])    ? $_GET['error']    : "";

    $redirect_url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : "";

    ?>

    <link href="css/login.css" rel="stylesheet" />

    <title>Login</title>
</head>

<body>
    <div class="login-html">
        <div class="signin-wrapper">
            <div class="signin-box">
                <h1 class="signin-title-primary text-center">Coffe Shop</h1>
                <h3 class="signin-title-secondary text-center">Sign in to continue.</h3>

                <!-- BEGIN FORM -->
                <form action="php/login-script.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $redirect_url ?>">

                        <!-- Email -->
                        <label for="email">Email</label>
                        <input type="email" class="input-text form-control mb-3" name="email"
                            value="<?php echo $GET_email ?>" />

                        <!-- Password -->
                        <label for="password">Password</label>
                        <input type="password" class="input-text form-control" name="password"
                            value="<?php echo $GET_password ?>" />

                        <div class="invalid-feedback">
                            <?php echo $GET_error ?>
                        </div>

                        <!-- Login Button -->
                        <div class="login-button">
                            <button onClick="showLoader()" type="submit" name="submit" id="submit"
                                class="btn btn-primary">LOGIN</button>
                        </div>
                </form>
                <div class="text-center">
                    <p>
                        Not Yet a Member? <a href="signup.php">Sign Up.</a><br /><br />

                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- JAVASCRIPT REQUIRED -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
<script src="js/login.js"></script>

</html>