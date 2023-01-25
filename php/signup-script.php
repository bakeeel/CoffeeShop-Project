<!--

    Keegan Fargher
    17920334
    I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

-->

<?php
    session_start();
    include_once("DBConn.php");

    // Define variables and set to empty values
    $firstname = $lastname = $email = $password = "";
    $firstnameError = $lastnameError = $emailError = $passwordError = "";
    $error = false;

    if (isset($_POST['submit'])) {

        //  Validate the input
        validate_first_name($firstname, $firstnameError, $error);
        validate_last_name($lastname, $lastnameError, $error);
        validate_email($email, $emailError, $error);
        validate_password($password, $passwordError, $error);

        // Checking if the email address already exists and
        // Using prepared statements to prevent SQL injection
        // https://youtu.be/LC9GaXkdxF8?t=3285
        if (!$error) {
            check_if_email_exists($con, $email, $emailError, $error);
        }

        //  If we have errors then go back
        if ($error) {
            header("location: ../signup.php?email=".$email."&password=".$password."&firstname=".$firstname."&lastname=".$lastname."&passwordError=".$passwordError."&firstnameError=".$firstnameError."&lastnameError=".$lastnameError."&emailError=".$emailError);
            return;
        } else {
            $userId = create_user($firstname, $lastname, $email, $password, $con);

            $_SESSION['userId'] = mysqli_stmt_insert_id($userId);
            $_SESSION['firstName'] = $firstname;
            $_SESSION['isSignedIn'] = true;
            $_SESSION['isAdmin'] = false;
            
            header("location: ../index.php");
        }
    }

    /*
    Removes any bad things from the data
    https://www.w3schools.com/php/php_form_validation.asp
    */
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace(",", "", $data);
        return $data;
    }

    function validate_first_name(&$firstname, &$firstnameError, &$error) {
        if (empty($_POST["register-firstname"])) {
            $firstnameError = "First Name is Required";
            $error = true;
        } else {
            $firstname = test_input($_POST["register-firstname"]);
        }
    }

    function validate_last_name(&$lastname, &$lastnameError, &$error) {
        if (empty($_POST["register-lastname"])) {
            $lastnameError = "Last Name is Required";
            $error = true;
        } else {
            $lastname = test_input($_POST["register-lastname"]);
        }
    }

    function validate_email(&$email, &$emailError, &$error) {
        if (empty($_POST["register-email"])) {
            $emailError = "Email is Required";
            $error = true;
        } else {
            $email = test_input($_POST["register-email"]);

            // Check if e-mail address is correct format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid Email Format";
                $error = true;
            }
        }
    }

    function validate_password(&$password, &$passwordError, &$error) {
        if (empty($_POST["register-password"])) {
            $passwordError = "Password is Required";
            $error = true;
        } else {
            $password = test_input($_POST["register-password"]);
        }
    }

    function check_if_email_exists($db, $email, &$emailError, &$error) {
        $sql = "SELECT * FROM tbl_customer WHERE Email=?";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
            $emailError = "Email Already Taken";
            $error = true;
        }
    }

    function create_user($firstname, $lastname, $email, $password, $db) {

        // Create a salt and add it to the end of the password
        $salt = sha1(microtime());
        $passwordSalt = $password . $salt;

        // SHA over MD5 because MD5 is not secure
        $passwordSaltHash = sha1($passwordSalt);

        //  Using prepared statements to prevent SQL injection
        $sql = "INSERT into tbl_customer (FName, LName, Email, Password, Salt) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($db);

        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $passwordSaltHash, $salt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        return mysqli_stmt_insert_id($stmt);
    }
?>