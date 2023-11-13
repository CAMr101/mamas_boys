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

        <!-- <p class="form-bottom-message"><a href="#0">Forgot your password?</a></p> -->
        <!-- <a href="#0" class="close-form">Close</a> -->

        <div id="reset-password">
            <p class="form-message">Lost your password? Please enter your email address.</br> You will receive a
                link to create a new password.</p>

            <form class="form">
                <p class="fieldset">
                    <label class="image-replace email" for="reset-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
                    <span class="error-message">An account with this email does not exist!</span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit" value="Reset password">
                </p>
            </form>

            <p class="form-bottom-message"><a href="#0">Back to log-in</a></p>
        </div>
        <a href="#0" class="close-form">Close</a>
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