<?php

include './passwordHash.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["reset-password"] === "reset-password") {

    $code = $_REQUEST['mid'];
    $pw = $_POST["new-password"];
    $confirmPw = $_POST["confirm-new-password"];
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    print_r($_POST);

    if (empty($pw) || empty($confirmPw)) {
        header("location:../admin/reset-password.php?error=empty");
    } else {
        echo "in";
        $hashedPw = hashPassword($pw);
        $confirmHasedPw = hashPassword($confirmPw);

        if ($hashedPw !== $confirmHasedPw) {
            header("location:../admin/reset-password.php?error=mismatch");
        }

        $currentDate = date("U");
        $tokenTodelete = validateToken($selector, $currentDate, $validator, $code, $hashedPw);
        deleteToken($tokenTodelete, $code);
    }
}

function validateToken($selector, $currentDate, $validator, $code, $hashedPw)
{
    include "../config/dbh.inc.php";

    try {
        $query = "SELECT * FROM `pwd_reset` WHERE pwd_selector=? AND pwd_expiry > ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector, $currentDate]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            switch ($code) {
                case 0:
                    header("location:../admin/reset-password.php?error=expired");
                    break;
                case 1:
                    header("location:../pages/reset-password.php?error=expired");
                    break;
            }
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $result["pwd_token"]);

            if ($tokenCheck === false) {
                switch ($code) {
                    case 0:
                        header("location:../admin/reset-password.php?error=resubmit");
                        break;
                    case 1:
                        header("location:../pages/reset-password.php?error=resubmit");
                        break;
                }
            } else if ($tokenCheck === true) {
                $tokenEmail = $result["pwd_email"];

                switch ($code) {
                    case 0:
                        $query = "SELECT * FROM `staff` WHERE email = ?";
                        break;
                    case 1:
                        $query = "SELECT * FROM `customer` WHERE email = ?";
                        break;
                }

                $stmt = $pdo->prepare($query);
                $stmt->execute([$tokenEmail]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (empty($result)) {
                    switch ($code) {
                        case 0:
                            header("location:../admin/reset-password.php?error=notfound");
                            break;
                        case 1:
                            header("location:../pages/reset-password.php?error=notfound");
                            break;
                    }
                } else {
                    switch ($code) {
                        case 0:
                            $query = "UPDATE `staff` SET `password`=? WHERE email = ?;";
                            break;
                        case 1:
                            $query = "UPDATE `staff` SET `password`=? WHERE email = ?;";
                            break;
                    }

                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$hashedPw, $tokenEmail]);

                    return $tokenEmail;

                }

            }
        }

    } catch (PDOException $e) {
        header("location:../admin/reset-password.php?error=error");
        exit();
    }
}


function deleteToken($tokenEmail, $code)
{
    include "../config/dbh.inc.php";

    try {
        $query = "DELETE FROM pwd_reset WHERE pwd_email =?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$tokenEmail]);

        $pdo = null;
        $stmt = null;
        switch ($code) {
            case 0:
                header("location:../admin/login.php?reset=success");
                break;
            case 1:
                header("location:../pages/login.php?reset=success");
                break;
        }

    } catch (PDOException $e) {
        switch ($code) {
            case 0:
                header("location:../admin/forgot-password.php?error=error");
                break;
            case 1:
                header("location:../pages/forgot-password.php?error=error");
                break;
        }
    }
}