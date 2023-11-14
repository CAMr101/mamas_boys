<?php
session_start();

include "../components/header.php";
include "../components/footer.php";

if (isset($_REQUEST['login'])) {
    $code = $_REQUEST['login'];

    switch ($code) {
        case "failed":
            $message = "Wrong Password. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        case "notFound":
            $message = "User does not exist. Please reate an account";
            echo "<script>alert('$message');</script>";
            break;
        case "denied":
            $message = "Access denied. Please login";
            echo "<script>alert('$message');</script>";
            break;
        case "error":
            $message = "Something went wrong. Please try again";
            echo "<script>alert('$message');</script>";
            break;
        default:
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website meta data -->
    <?php include "../components/customer-meta-data.php"; ?>
    <title>Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">
    <link rel="stylesheet" href="../assets/css/login-page.css">
    <link rel="stylesheet" href="../assets/css/root.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'>

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }

        .main-content {
            background-color: #AAAAAA !important;
        }
    </style>

</head>

<body>

    <?php
    echo createHeader();
    ?>

    <div class="user-modal-container">

        <form action="../handlers/login.php?login=1" method="post" class="form">
            <h1>Login</h1>

            <p class="fieldset">
                <label class="image-replace email" for="email">E-mail</label>
                <input class="full-width has-padding has-border" name="signin-email" id="signin-email" type="email"
                    placeholder="E-mail">
            </p>


            <p class="fieldset">
                <label class="image-replace password" for="signin-password">Password</label>
                <input class="full-width has-padding has-border" name="signin-password" id="signin-password"
                    type="password" placeholder="Password">
                <!-- <a href="#0" class="hide-password">Show</a> -->
                <!-- <span class="error-message">Wrong password! Try again.</span> -->
            </p>

            <!-- <p class="fieldset">
                <input type="checkbox" id="remember-me" checked>
                <label for="remember-me">Remember me</label>
            </p> -->

            <p class="fieldset">
                <input class="full-width" type="submit" value="Login">
            </p>

            <p>Don't have an account?
                <a href="signup.php" style="color:#0652dd;text-align:center;">Create An Account</a>
            </p>
        </form>

        <p class="form-bottom-message"><a href="forgot-password.php">Forgot your password?</a></p>
    </div>

    <?php
    echo createFooter();
    ?>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!-- <script src="../assets/js/login-register.js"></script> -->
    <script src="../assets/js/main.js"></script>

</body>

</html>