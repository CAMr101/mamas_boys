<?php

include "../config/dbh.inc.php";
include "../handlers/processCustomer.php";
include "../handlers/processStaff.php";
include "./email.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["admin-request-submit"])) {
    $email = $_POST["email"];

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $expiry = date("U") + 600;

    $url = "www.mamas-boys.co.za/admin/reset-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $user = getStaffByEmail($email);

    include "../config/dbh.inc.php";

    if (empty($user)) {
        header("location:../admin/forgot-password.php?error=notfound");
    } else {
        deleteExistingToken($email);
        saveTokenIntoDb($email, $selector, $token, $expiry);
        sendAdminPasswordResetEmail($email, $user["name"], $url);
    }
} else {
    header("location:../admin/login.php?reset=error");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset-request-submit"])) {
    $email = $_POST["email"];

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $expiry = date("U") + 600;

    $url = "www.mamas-boys.co.za/reset-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $user = getUserByEmail($email);

    include "../config/dbh.inc.php";

    if (empty($user)) {
        header("location:../pages/forgot-password.php?error=notfound");
    } else {
        deleteExistingToken($email);
        saveTokenIntoDb($email, $selector, $token, $expiry);
        sendPasswordResetEmail($email, $user["name"], $url);
    }

} else {
    header("location:../pages/login.php?reset=error");
    exit();
}

function deleteExistingToken($email)
{
    include "../config/dbh.inc.php";

    try {

        $query = "DELETE FROM `pwd_reset` WHERE pwd_email = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        header("location:../pages/forgot-password.php?error=error");
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}

function saveTokenIntoDb($email, $selector, $token, $expiry)
{
    include "../config/dbh.inc.php";
    include "./passwordHash.php";

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