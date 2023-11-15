<?php
include 'passwordHash.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['method']) && isset($_POST)) {
    $method = $_GET['method'];

    $name = $_POST['signup-name'];
    $surname = $_POST['signup-surname'];
    $address = $_POST['signup-address'];
    $email = $_POST['signup-email'];
    $phone = $_POST['signup-phone'];
    $password = $_POST['signup-password'];
    $confirm_password = $_POST['signup-password-confirm'];

    switch ($method) {
        case 1:
            $hashedPw = hashPassword($password);
            $confirmHasedPw = hashPassword($confirm_password);
            $confirmed = matchPassword($hashedPw, $confirmHasedPw);

            if ($confirmed === false) {
                header('location:../pages/signup.php?error=1');
            }

            signupCustomer($name, $surname, $address, $email, $phone, $hashedPw);

            header('location:../pages/signup-success.php');
            break;
        default:
            header('location:../pages/signup.php?error=0');
            break;
    }
} else {
    header('location:../pages/signup.php?error=2');
}

function matchPassword($pw, $confirmPw)
{
    if ($pw === $confirmPw)
        return true;
    else
        return false;
}

function signupCustomer($name, $surname, $address, $email, $phone, $hashedPw)
{
    include "../config/dbh.inc.php";

    try {

        $query = "INSERT INTO customer (name, surname, address, email, phone, password) 
        VALUES (?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $surname, $address, $email, $phone, $hashedPw]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}