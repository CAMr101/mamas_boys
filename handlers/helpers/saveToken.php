<?php

function saveActivationToken($email, $selector, $token)
{
    include "../config/dbh.inc.php";

    $hasedToken = password_hash($token, PASSWORD_DEFAULT);

    try {
        $query = "INSERT INTO `customer_staff_activation`(`email`, `selector`, `token`) VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $selector, $hasedToken]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "failed to save existing token";
        header("location:../pages/forgot-password.php?error=error");
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}

function saveResetToken($email, $selector, $token, $expiry)
{
    include "../config/dbh.inc.php";

    $hasedToken = password_hash($token, PASSWORD_DEFAULT);

    try {
        $query = "INSERT INTO `pwd_reset`(`pwd_email`, `pwd_selector`, `pwd_token`, `pwd_expiry`) VALUES (?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $selector, $hasedToken, $expiry]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "failed to save existing token";
        header("location:../pages/forgot-password.php?error=error");
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}

?>