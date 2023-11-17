<?php

include "../config/dbh.inc.php";
include "../handlers/processCustomer.php";
include "../handlers/processStaff.php";
include "./email.php";
include "./helpers/deleteExistingToken.php";
include "./helpers/create-selector.php";
include "./helpers/create-token.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["admin-request-submit"])) {
    $email = $_POST["email"];

    $selector = createSelector();
    $token = createToken();
    $expiry = date("U") + 600;

    $url = "www.mamas-boys.co.za/admin/reset-password.php?selector=" . $selector . "&validator=" . $token;
    $user = getStaffByEmail($email);

    if (empty($user)) {
        header("location:../admin/forgot-password.php?error=notfound");
    } else {
        $hashed_token = hashPassword($token);
        deleteExistingToken($email, 0);
        saveActivationToken($email, $selector, $hashed_token);
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

    $url = "www.mamas-boys.co.za/pages/reset-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $user = getUserByEmail($email);

    include "../config/dbh.inc.php";

    if (empty($user)) {
        header("location:../pages/forgot-password.php?error=notfound");
    } else {

        deleteExistingToken($email, 1);
        saveResetToken($email, $selector, $token, $expiry);
        sendPasswordResetEmail($email, $user["name"], $url);
    }

} else {
    header("location:../pages/login.php?reset=error");
    exit();
}