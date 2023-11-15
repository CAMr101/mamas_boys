<?php
session_start();

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
            $message = "Something went wrong . please try again";
            echo "<script>alert('$message');</script>";
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


            <form action="../handlers/forgot-password.php" method="post">
                <h3>Reset Password</h3>

                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email" id="email">

                <p class="form-message"></br> You will receive a
                    link to create a new password.</p>

                <button type="submit" name="admin-request-submit">Reset Password</button>
                <div class="forgot-password">
                    <a href="login.php">
                        Login?
                    </a>
                </div>
            </form>

        </div>
    </div>


</body>

</html>