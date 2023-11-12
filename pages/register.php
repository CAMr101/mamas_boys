<?php
session_start();

include "../components/header.php";
include "../components/footer.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">
    <link rel="stylesheet" href="../assets/css/login-page.css">
    <link rel="stylesheet" href="../assets/css/root.css" <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="./style.css">

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }

        .bg-light,
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

        <form action="../handlers/signup.php?method=1" method="post" class="form" id="register-form">
            <p class="fieldset">
                <label class="image-replace email" for="signin-email">E-mail</label>
                <input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail"
                    form="register-form">
                <!-- <span class="error-message">An account with this email address does not exist!</span> -->
            </p>
            <p class="fieldset">
                <label class="image-replace email" for="signup-email">E-mail</label>
                <input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
                <!-- <span class="error-message">Enter a valid email address!</span> -->
            </p>

            <p class="fieldset">
                <label class="image-replace username" for="signup-name">Name</label>
                <input class="full-width has-padding has-border" id="signup-name" type="text" placeholder="Name">
            </p>

            <p class="fieldset">
                <label class="image-replace username" for="signup-surname">Surname</label>
                <input class="full-width has-padding has-border" id="signup-surname" type="text" placeholder="Surname">
            </p>

            <p class="fieldset">
                <label class="image-replace address" for="signup-address">Addres</label>
                <input class="full-width has-padding has-border" id="signup-address" type="text" placeholder="Address">
            </p>

            <p class="fieldset">
                <label class="image-replace phone-number" for="signup-phone">Phone Number</label>
                <input class="full-width has-padding has-border" id="signup-phone" type="tel"
                    placeholder="Phone Number">
            </p>

            <p class="fieldset">
                <label class="image-replace password" for="signup-password">Password</label>
                <input class="full-width has-padding has-border" id="signup-password" type="password"
                    placeholder="Password">
                <!-- <a href="#0" class="hide-password">Show</a> -->
            </p>

            <input type="text" id="random" value="random">

            <!-- <p class="fieldset">
                <input type="checkbox" id="accept-terms">
                <label for="accept-terms">I agree to the <a class="accept-terms" href="#0">Terms</a></label>
            </p> -->

            <p class="fieldset">
                <input class="full-width has-padding" type="submit" value="Create account">
            </p>
            <button type="submit">Submit</button>

            <p>Alreadr have an account?
                <a href="login.php" style="color:#0652dd;text-align:center;">Login</a>
            </p>
        </form>

        <!-- <div id="reset-password">
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
        </div> -->

        <a href="#0" class="close-form">Close</a>
    </div>

    <?php
    echo createFooter();
    ?>


    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../assets/js/login-register.js"></script>
    <script src="../assets/js/main.js"></script>
    <!-- add confirm password script -->

</body>

</html>