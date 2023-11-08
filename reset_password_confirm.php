<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/Stylee.css">
</head>

<body>
    <?php
    if (isset($_GET['token'])) {
        $token = $_GET['token']; // Retrieve the token from the URL
        ?>
        <form method="post" action="reset_password_reset.php" name="reset-password-form">
            <div class="form-element">
                <label>New Password</label>
                <input type="password" name="new_password" required />
            </div>
            <div class="form-element">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required />
            </div>
            <input type="hidden" name="token" value="<?php echo $token; ?>" /> <!-- Include the token in the form -->
            <button type="submit" name="reset_password" value="Reset Password">Reset Password</button>
        </form>
        <?php
    } else {
        echo '<p class="error">Invalid or missing reset token.</p>';
    }
    ?>
</body>

</html>