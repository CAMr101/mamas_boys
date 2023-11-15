<?php
session_start();

if (isset($_REQUEST['success'])) {
    $code = $_REQUEST['success'];

    switch ($code) {
        case "true":
            break;
        default:
            header("location:./login.php");
            break;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-login.css">
    <title>Forgot Password</title>
</head>

<body>
    <!-- Page body/content -->
    <div class="main-container">

        <div class="container">

            <div class="text-container">
                <a href="../index.php">
                    <span class="heading" id="heading">
                        Mama's Boys
                    </span>
                    <p class="subtext">Because No Great Story </p>
                    <p class="subtext">Started With A Salad</p>
                </a>
            </div>


            <form action="">
                <h3>Email Sent</h3>

                <p class="form-message"></br> Please check you email for the reset</p>

                <a href="./login.php">
                    <button type="button" name="admin-request-submit">OK</button>
                </a>
            </form>

        </div>
    </div>


</body>

</html>