<?php
session_start();

include "../components/header.php";
include "../components/footer.php";

$selector = null;
$validator = null;


if (!isset($_REQUEST["selector"]) && !isset($_REQUEST["validator"])) {
    // header("location:../login.php");
} else {
    $selector = $_REQUEST["selector"];
    $validator = $_REQUEST["validator"];

    if (ctype_xdigit($selector) !== false && ctype_xdigit($selector) !== false) {
        $selector_html = '<input type="hidden" name="selector" id="selector" value="' . $selector . '">';
        $validator_html = '<input type="hidden" name="validator" id="validator" value="' . $validator . '">';
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
    <title>Forgot Password</title>

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

        <form action="../handlers/reset-password.php?mid=1" method="post" class="form">
            <h1>Reset Password</h1>
            <?php
            if ($selector !== null && $validator !== null) {
                echo $validator_html;
                echo $selector_html;
            }
            ?>

            <p class="fieldset">
                <label class="image-replace email" for="new-password">New Password</label>
                <input class="full-width has-padding has-border" name="new-password" id="new-password" type="email"
                    placeholder="New Password" required>
            </p>


            <p class="fieldset">
                <label class="image-replace password" for="confirm-new-password">Confirm new password</label>
                <input class="full-width has-padding has-border" name="confirm-new-password" id="confirm-new-password"
                    type="password" placeholder="Confrim New Password" required>
                <!-- <a href="#0" class="hide-password">Show</a> -->
                <!-- <span class="error-message">Wrong password! Try again.</span> -->
            </p>

            <p class="fieldset">
                <input class="full-width has-padding" type="submit" name="reset-password" value="Reset password">
            </p>
        </form>
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