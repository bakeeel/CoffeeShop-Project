<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
include_once("php/signup-script.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("meta.php");

    $GET_firstname      = isset($_GET['firstname'])      ? $_GET['firstname']      : "";
    $GET_firstnameError = isset($_GET['firstnameError']) ? $_GET['firstnameError'] : "";
    $GET_lastname       = isset($_GET['lastname'])       ? $_GET['lastname']       : "";
    $GET_lastnameError  = isset($_GET['lastnameError'])  ? $_GET['lastnameError']  : "";
    $GET_email          = isset($_GET['email'])          ? $_GET['email']          : "";
    $GET_emailError     = isset($_GET['emailError'])     ? $_GET['emailError']     : "";
    $GET_password       = isset($_GET['password'])       ? $_GET['password']       : "";
    $GET_passwordError  = isset($_GET['passwordError'])  ? $_GET['passwordError']  : "";

    ?>
    <link href="css/login.css" rel="stylesheet" />

    <title>Sign Up</title>
</head>

<body>
<!-- LOADING CIRCLE
<div class="loader-background">
    <div class="loader">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div> -->

<div class="login-html">
    <div class="signin-wrapper">
        <div class="signin-box" style="width: 700px">
            <h1 class="signin-title-primary text-center">GRINDER</h1>
            <h3 class="signin-title-secondary text-center">Sign Up</h3>

            <!-- BEGIN FORM -->
            <form action="php/signup-script.php" method="post" autocomplete="off">
                <div class="form-group has-danger">
                    <div class="row">

                        <!-- First Name -->
                        <div class="col-12 col-sm-6">
                            <label for="register-firstname">First Name</label>
                            <input type="text" class="input-text form-control" name="register-firstname"
                                   value="<?php echo $GET_firstname ?>" />

                            <div class="invalid-feedback mb-3">
                                <?php echo $GET_firstnameError ?>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-12 col-sm-6">
                            <label for="register-lastname">Last Name</label>
                            <input type="text" class="input-text form-control" name="register-lastname"
                                   value="<?php echo $GET_lastname ?>" />
                            <div class="invalid-feedback  mb-3">
                                <?php echo $GET_lastnameError ?>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-6">
                            <label for="register-email">Email</label>
                            <input type="text" class="input-text form-control" name="register-email"
                                   value="<?php echo $GET_email ?>" />
                            <div class="invalid-feedback  mb-3">
                                <?php echo $GET_emailError ?>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-12 col-sm-6">
                            <label for="register-password">Password</label>
                            <input autocomplete="new-password" type="password" class="input-text form-control"
                                   name="register-password" value="<?php echo $GET_password ?>" />
                            <div class="invalid-feedback">
                                <?php echo $GET_passwordError ?>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Login Button -->
                <div class="login-button">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">REGISTER</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- JAVASCRIPT REQUIRED -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/loader.js"></script>

</body>

</html>