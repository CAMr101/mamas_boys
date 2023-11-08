<?php
session_start();

include('Configuration.php');

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $reset_token = $_POST['token'];
    
    if ($new_password == $confirm_password) {
        // Verify the reset token and check its expiration
        $query = $connection->prepare("SELECT * FROM users WHERE reset_token = :reset_token AND reset_token_expiration > NOW()");
        $query->bindParam("reset_token", $reset_token, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Update the password and clear the reset token
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $query = $connection->prepare("UPDATE users SET password = :password, reset_token = NULL, reset_token_expiration = NULL WHERE reset_token = :reset_token");
            $query->bindParam("password", $hashed_password, PDO::PARAM_STR);
            $query->bindParam("reset_token", $reset_token, PDO::PARAM_STR);
            $query->execute();

            // Redirect the user to a password reset success page
            header("location: reset_password_success.php");
            exit;
        } else {
            echo '<p class="error">Invalid or expired reset token.</p>';
        }
    } else {
        echo '<p class="error">Passwords do not match.</p>';
    }
}
?>
