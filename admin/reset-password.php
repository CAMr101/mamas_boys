<?php
session_start();

if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case "empty":
            $message = "Please enter a password.";
            echo "<script>alert('$message');</script>";
            break;
        case "mismatch":
            $message = "Password does not match. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        case "expired":
            $message = "Token has expired. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        case "con":
            $message = "Unable to process you request. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        case "coresubmitn":
            $message = "Please resubmit your password reset request.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            $message = "Something went wrong. please try again";
            echo "<script>alert('$message');</script>";
            break;
    }
}

$selector = null;
$validator = null;


if (!isset($_REQUEST["selector"]) && !isset($_REQUEST["validator"])) {
    // header("location:./login.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-login.css">
    <title>Reset Password</title>
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


            <form action="../handlers/reset-password.php?" method="post">
                <h3>Reset Password</h3>
                <?php
                if ($selector !== null && $validator !== null) {
                    echo $validator_html;
                    echo $selector_html;
                }
                ?>
                <input type="hidden" name="mib" value="0">
                <label for="new-password">New Password</label>
                <input type="password" name="new-password" placeholder="Password" id="New Password" required>

                <label for="confirm-new-password">Confirm New Password</label>
                <input type="password" name="confirm-new-password" placeholder="Password" id="confirm-new-password"
                    required>

                <button type="submit" name="reset-password">Reset</button>
            </form>

        </div>
    </div>


</body>

</html>