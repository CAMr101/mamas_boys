<?php
session_start();

include "../components/header.php";
include "../components/footer.php";

if (!isset($_REQUEST['success'])) {
    header('location:./login.php');
}

if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case "notfound":
            $message = "User does not exist. Please enter a registered email.";
            echo "<script>alert('$message');</script>";
            break;
        case "notsent":
            $message = "Mail not sent. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        case "con":
            $message = "Unable to process you request. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            $message = "Something went wrong. Please try again.";
            echo "<script>alert('$message');</script>";
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
    <title>Email sent || Forgot Password</title>

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

        <p class="form-message">Email was successfully sent</br> Please check your email</p>

        <form action="./login.php" method="post" class="form">
            <p class="fieldset">
                <input class="full-width has-padding" type="submit" value="OK">
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