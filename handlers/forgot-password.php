<?php

include "../config/dbh.inc.php";
include "../handlers/processCustomer.php";
include "../handlers/processStaff.php";
include "./email.php";
include "./helpers/deleteToken.php";
include "./helpers/create-selector.php";
include "./helpers/create-token.php";
include "./helpers/saveToken.php";
include "./passwordHash.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["admin-request-submit"])) {
    $email = $_POST["email"];

    $selector = createSelector();
    $token = createToken();
    $expiry = date("U") + 300;

    $url = "www.mamas-boys.co.za/admin/reset-password.php?selector=" . $selector . "&validator=" . $token;
    $user = getStaffByEmail($email);



    if (empty($user)) {
        header("location:../admin/forgot-password.php?error=notfound");
        exit();
    } else {
        $hashed_token = hashPassword($token);
        deleteExistingToken($email, 1);
        saveResetToken($email, $selector, $hashed_token, $expiry);

        $mailSent = sendAdminPasswordResetEmail($email, $selector, $url);
        if (!$mailSent) {
            header("location:../admin/forgot-password.php?error=notsent");
            exit();
        } else {
            header("location:../admin/mail-sent.php");
            exit();
        }
    }
} else {
    header("location:../admin/login.php?reset=error");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset-request-submit"])) {
    $email = $_POST["email"];

    $selector = createSelector();
    $token = createToken();
    $expiry = date("U") + 600;

    $url = "www.mamas-boys.co.za/pages/reset-password.php?selector=" . $selector . "&validator=" . $token;
    $user = getUserByEmail($email);

    include "../config/dbh.inc.php";

    if (empty($user)) {
        header("location:../pages/forgot-password.php?error=notfound");
        exit();
    } else {

        $hashed_token = hashPassword($token);
        deleteExistingToken($email, 1);
        saveResetToken($email, $selector, $hashed_token, $expiry);

        $mailSent = sendPasswordResetEmail($email, $selector, $token);
        if (!$mailSent) {
            header("location:../pages/forgot-password.php?error=notsent");
            exit();
        } else {
            header("location:../pages/mail-sent.php");
            exit();
        }
    }

} else {
    header("location:../pages/login.php?reset=error");
    exit();
}