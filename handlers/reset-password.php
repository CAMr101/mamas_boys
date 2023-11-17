<?php

include './passwordHash.php';
include './helpers/deleteToken.php';



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_REQUEST['mid'])) {
    $code = $_REQUEST['mid'];
    $pw = $_POST["new-password"];
    $confirmPw = $_POST["confirm-new-password"];
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];

    if (empty($pw) || empty($confirmPw)) {
        header("location:../admin/reset-password.php?error=empty");
    } else {
        $hashedPw = hashPassword($pw);
        $confirmHasedPw = hashPassword($confirmPw);

        if ($hashedPw !== $confirmHasedPw) {
            header("location:../admin/reset-password.php?error=mismatch");
        }


        $currentDate = date("U");

        switch ($code) {
            case 0:
                $tokenEmail = validateAdminToken($selector, $currentDate, $validator, $hashedPw);
                deleteExistingToken($tokenEmail, 1);
                break;
            case 1:
                $tokenEmail = validateCustomerToken($selector, $currentDate, $validator, $hashedPw);
                deleteExistingToken($tokenEmail, 1);
                break;
            default:
                header("location:../index.php?error=error");
                break;
        }
    }
}

function validateAdminToken($selector, $currentDate, $validator, $hashedPw)
{
    include "../config/dbh.inc.php";

    try {
        $query = "SELECT * FROM `pwd_reset` WHERE pwd_selector=? AND pwd_expiry > ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector, $currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            header("location:../admin/reset-password.php?error=expired");
        } else {
            $hashedToken = hashPassword($token);

            if (password_verify($hashedToken, $result["pwd_token"])) {
                $tokenEmail = $result["pwd_email"];

                $query = "SELECT * FROM `staff` WHERE email = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$tokenEmail]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (empty($result)) {
                    header("location:../admin/reset-password.php?error=notfound");
                } else {
                    print_r("about to update password");
                    exit();
                    $query = "UPDATE `staff` SET `password`=? WHERE email = ?;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$hashedPw, $tokenEmail]);

                    return $tokenEmail;

                }
            } else {
                $query = "SELECT * FROM `pwd_reset` WHERE pwd_selector=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$selector]);

                if ($result["counter"] > 5) {
                    deleteExistingToken($result["pwd_email"], 0);
                    header("location:../admin/login.php?error=counter");
                } else {
                    $counter = $result["pwd_counter"] + 1;

                    try {
                        $query = "UPDATE `pwd_reset` SET `pwd_counter`= ? WHERE pwd_email=? ";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$counter, $result['email']]);

                    } catch (PDOException $e) {
                        header('location:../admin/login.php?error=error');
                    }

                }
                header("location:../admin/reset-password.php?error=resubmit");

                die();
            }
        }

    } catch (PDOException $e) {
        header("location:../admin/reset-password.php?error=error");
        exit();
    }
}

function validateCustomerToken($selector, $currentDate, $validator, $hashedPw)
{
    include "../config/dbh.inc.php";

    try {
        $query = "SELECT * FROM `pwd_reset` WHERE pwd_selector=? AND pwd_expiry > ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector, $currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            header("location:../admin/reset-password.php?error=expired");
        } else {
            $hashedToken = hashPassword($token);

            if (password_verify($hashedToken, $result["pwd_token"])) {
                $tokenEmail = $result["pwd_email"];

                $query = "SELECT * FROM `staff` WHERE email = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$tokenEmail]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (empty($result)) {
                    header("location:../admin/reset-password.php?error=notfound");
                } else {
                    $query = "UPDATE `staff` SET `password`=? WHERE email = ?;";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$hashedPw, $tokenEmail]);

                    return $tokenEmail;

                }
            } else {
                $query = "SELECT * FROM `pwd_reset` WHERE pwd_selector=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$selector]);

                if ($result["counter"] > 5) {
                    deleteExistingToken($result["pwd_email"], 0);
                    header("location:../admin/login.php?error=counter");
                } else {
                    $counter = $result["pwd_counter"] + 1;

                    try {
                        $query = "UPDATE `pwd_reset` SET `pwd_counter`= ? WHERE pwd_email=? ";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$counter, $result['email']]);

                    } catch (PDOException $e) {
                        header('location:../admin/login.php?error=error');
                    }

                }
                header("location:../admin/reset-password.php?error=resubmit");

                die();
            }
        }

    } catch (PDOException $e) {
        header("location:../admin/reset-password.php?error=error");
        exit();
    }
}