<?php

include './helpers/deleteToken.php';
include './helpers/create-token.php';
include 'passwordHash.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_REQUEST['mid']) && isset($_REQUEST['selector']) && isset($_REQUEST['validator'])) {
    $code = $_REQUEST['mid'];
    $selector = $_REQUEST['selector'];
    $token = $_REQUEST['validator'];

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

        $hashedToken = hashPassword($token);

        if (password_verify($hashedToken, $result['token'])) {
            echo 'tokens match';
            $query = "UPDATE `staff` SET `verified`= 1 WHERE email=? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$result['email']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            deleteToken($selector, 0);

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

                $query = "DELETE FROM `customer_staff_activation` WHERE selector=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$selector]);
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

        $hashedToken = hashPassword($token);

        if (password_verify($hashedToken, $result['token'])) {
            echo 'tokens match';
            $query = "UPDATE `customer` SET `verified`= 1 WHERE email=? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$result['email']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            deleteToken($selector, 1);

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
                header('location:../pages/login.php?error=error');
            }

        }

        header('location:../pages/login.php?error=verify');
    }
}

function deleteToken($selector, $code)
{
    include "../config/dbh.inc.php";

    try {
        $query = "DELETE FROM customer_staff_activation WHERE selector =?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$tokenEmail]);

        $pdo = null;
        $stmt = null;

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