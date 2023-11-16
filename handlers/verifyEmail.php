<?php

include './helpers/deleteToken.php';
include './helpers/create-token.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_REQUEST['mid']) && isset($_REQUEST['selector']) && isset($_REQUEST['validator'])) {
    $code = $_REQUEST['mid'];
    $selector = $_REQUEST['selector'];
    $token = hex2bin($_REQUEST['validator']);

    switch ($code) {
        case 0:
            verifyAdmin($selector, $token);
            break;
        case 1:
            verifyCustomer($selector, $token);
            break;
        default:
            header("location:../index.php?error=error");
            break;
    }
}

function verifyAdmin($selector, $token)
{
    try {
        include "../config/dbh.inc.php";

        $query = "SELECT * FROM `customer_staff_activation` WHERE selector=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $t1 = createToken();
        $t1 = bin2hex($t1);

        $t2 = hex2bin($t1);


        $hasedToken = password_hash($token, PASSWORD_DEFAULT);

        print_r($t1);
        print_r("....................................");
        print_r($t2);
        print_r("....................................");
        // echo 'hashed';
        exit();
        if ($result['token'] === $hasedToken) {
            echo 'tokens match';
            exit();
            $query = "UPDATE `staff` SET `verified`= 1 WHERE email=? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$result['email']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            header('location:../admin/email-verified.php');
        } else {
            header('location:../admin/login.php?error=token');
        }
    } catch (PDOException $e) {

        $query = "SELECT * FROM `customer_staff_activation` WHERE selector=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result["counter"] > 5) {
            deleteExistingToken($result["email"], 0);
            header("location:../admin/login.php?error=counter");
        } else {
            $counter = $result["counter"] + 1;

            try {
                $query = "UPDATE `customer_staff_activation` SET `counter`= ? WHERE email=? ";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$counter, $result['email']]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                header('location:../admin/login.php?error=error');
            }

        }

        header('location:../admin/login.php?error=verify');
    }
}

function verifyCustomer($selector, $token)
{
    try {
        include "../config/dbh.inc.php";

        $query = "SELECT * FROM `customer_staff_activation` WHERE selector=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $hasedToken = password_hash($token, PASSWORD_DEFAULT);

        if ($result['token'] === $token) {
            $query = "UPDATE `customer` SET `verified`= 1 WHERE email=? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$result['email']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            header('location:../pages/active.php');
        } else {
            header('location:../pages/login.php?error=token');
        }
    } catch (PDOException $e) {

        $query = "SELECT * FROM `customer_staff_activation` WHERE selector=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$selector]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result["counter"] > 5) {
            deleteExistingToken($result["email"], 0);
            header("location:../pages/login.php?error=counter");
        } else {
            $counter = $result["counter"] + 1;

            try {
                $query = "UPDATE `customer_staff_activation` SET `counter`= ? WHERE email=? ";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$counter, $result['email']]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                header('location:../admin/login.php?error=error');
            }

        }

        header('location:../pages/login.php?error=verify');
    }
}