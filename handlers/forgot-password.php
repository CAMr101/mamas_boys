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

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["admin-request-submit"]) || isset($_POST["reset-request-submit"])) && isset($_REQUEST["mid"])) {

    $code = $_REQUEST["mid"];

    switch ($code) {
        case 0:
            recoverAdminPw();
            break;
        case 1:
            recoverCustomerPw();
            break;
        default:
            header("location:../index.php?error=error");
            break;
    }
}

function recoverAdminPw()
{
    $email = $_POST["email"];

    $selector = createSelector();
    $token = createToken();
    $expiry = date("U") + 300;

    $user = getStaffByEmail($email);

    if (empty($user)) {
        header("location:../admin/forgot-password.php?error=notfound");
        exit();
    } else {
        $hashed_token = hashPassword($token);
        deleteExistingToken($email, 1);
        saveResetToken($email, $selector, $hashed_token, $expiry);

        $url = "www.mamas-boys.co.za/admin/reset-password.php?selector=" . $selector . "&validator=" . $token;
        $mailSent = sendAdminPasswordResetEmail($email, $selector, $url);

        if (!$mailSent) {
            header("location:../admin/forgot-password.php?error=notsent");
            exit();
        } else {
            header("location:../admin/mail-sent.php");
            exit();
        }
    }
}


function recoverCustomerPw()
{
    try {

        $email = $_POST["reset-email"];

        $user = getUserByEmail($email);

        if (empty($user)) {
            header("location:../pages/forgot-password.php?error=notfound");
            exit();
        } else {
            $selector = createSelector();
            $token = createToken();
            $expiry = date("U") + 600;

            $hashed_token = hashPassword($token);
            deleteExistingToken($email, 1);
            saveResetToken($email, $selector, $hashed_token, $expiry);

            $url = "www.mamas-boys.co.za/pages/reset-password.php?selector=" . $selector . "&validator=" . $token;


            $mailSent = sendPasswordResetEmail($email, $selector, $url);

            if (!$mailSent) {
                header("location:../pages/forgot-password.php?error=notsent");
                exit();
            } else {
                // header("location:../pages/mail-sent.php?success=true");

                echo "
                    <script>
                            window.location.assign('http://localhost/kota2/pages/mail-sent.php?success=true');
                    </script>
                ";
                exit();
            }
        }

    } catch (Exception $e) {
        header("location:../pages/forgot-password.php?error=notsent");
        exit();
    }
}