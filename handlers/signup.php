<?php
include './processCustomer.php';
include 'passwordHash.php';
include './email.php';
include './helpers/create-selector.php';
include './helpers/create-token.php';
include './helpers/deleteToken.php';
include './helpers/saveToken.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['method']) && isset($_POST)) {
    $method = $_GET['method'];

    $name = $_POST['signup-name'];
    $surname = $_POST['signup-surname'];
    $address = $_POST['signup-address'];
    $email = $_POST['signup-email'];
    $phone = $_POST['signup-phone'];
    $password = $_POST['signup-password'];
    $confirm_password = $_POST['signup-password-confirm'];

    $user = getUserByEmail($email);

    if (!empty($user)) {
        header("location:../pages/signup.php?error=exist");
    }

    $hashedPw = hashPassword($password);
    $confirmHasedPw = hashPassword($confirm_password);
    $confirmed = matchPassword($hashedPw, $confirmHasedPw);

    if ($confirmed === false) {
        header('location:../pages/signup.php?error=1');
    }

    signupCustomer($name, $surname, $address, $email, $phone, $hashedPw);

    $selector = createSelector();
    $token = createToken();

    $url = "www.mamas-boys.co.za/handlers/verifyEmail.php?mid=1&selector=" . $selector . "&validator=" . $token;

    $hashed_token = hashPassword($token);

    deleteExistingToken($email, 0);
    saveActivationToken($email, $selector, $hashed_token);

    $mailSent = customerVerificationEmail($email, $name, $url);

    if (!$mailSent)
        header("location:../pages/signup.php?error=mail");
    else
        header('location:../pages/signup-success.php');

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