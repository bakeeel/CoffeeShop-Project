
<?php
@session_start();
include_once("DBConn.php");

// Define variables and set to empty values
$email = $password = $error = $redirect_url = "";
$incorrectDetails = false;

if (isset($_POST['submit'])) {

    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : "";

    echo $redirect_url;

    // Getting email and password
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    //  Select statement to validate if email actually exists
    $sql = "SELECT * FROM tbl_customer INNER JOIN tbl_Role r on r.Id = tbl_Customer.Role_Id WHERE email = '$email'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $count = mysqli_num_rows($result);

    // If result == 1 then the email exists
    if ($count === 1) {

        //  Salt and hash the user entered password
        $salt = $row['Salt'];
        $passwordSalt = $password . $salt;
        $passwordHash = sha1($passwordSalt);

        //  If passwords match
        if ($row['Password'] !== $passwordHash) {
            $incorrectDetails = true;
        } 
    } else {
        $incorrectDetails = true;
    }

    if ($incorrectDetails) {
        redirect_to_login($email, $password);
    } else {
        $_SESSION['userId'] = $row['ID'];
        $_SESSION['firstName'] = $row['FName'];
        $_SESSION['isSignedIn'] = true;
        $_SESSION['isAdmin'] = $row['Role'] === 'Admin' ? true : false;


        if ($redirect_url === "") {
            header("Location: ../index.php");
        } else {
            header("Location: ".$redirect_url);
            die();
        }
    }
}

function redirect_to_login($email, $password) {
    $error = "Incorrect Email and/or Password";
    global $redirect_url;
    header("location: ../login.php?email=".$email."&password=".$password."&error=".$error."&redirect_url=".$redirect_url);
}
?>