<?php
session_start();

include('Configuration.php');

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    
    // Check if the email exists in your database
    $query = $connection->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      // Generate a unique token for password reset
$reset_token = bin2hex(random_bytes(32));

// Store the reset token and the current timestamp in the database
$query = $connection->prepare("UPDATE users SET reset_token = :reset_token, reset_token_expiration = NOW() + INTERVAL 1 HOUR WHERE email = :email");
$query->bindParam("reset_token", $reset_token, PDO::PARAM_STR);
$query->bindParam("email", $email, PDO::PARAM_STR);
$query->execute();

// Redirect to reset_password_confirm.php with the token parameter
header("location: reset_password_confirm.php?token=" . $reset_token);
exit;

    } else {
        echo '<p class="error">No user with that email address found.</p>';
    }
}
?>
