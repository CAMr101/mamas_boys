<?php
include 'passwordHash.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['method'])) {
    $method = $_GET['method'];

    $name = $_POST['signup-name'];
    $surname = $_POST['signup-surname'];
    $address = $_POST['signup-address'];
    $email = $_POST['signup-email'];
    $phone = $_POST['signup-phone'];
    $password = $_POST['signup-password'];

    switch ($method) {
        case 1:
            if ($password == '')
                // header('location:../pages/register.php');

                $hashedPw = hashPassword($password);
            print_r($name);
            print_r($surname);
            print_r($address);
            print_r($email);
            print_r($phone);
            print_r($password);
            print_r($_POST['signin-email']);
            // signupCustomer($name, $surname, $address, $email, $phone, $hashedPw);
            break;
        default:
            header('location:../index.php');
            break;
    }
} else {
    header('location:../index.php');
}

function signupCustomer($name, $surname, $address, $email, $phone, $hashedPw)
{
    include "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO customer (name, surname, address, email, phone, password) 
        VALUES (?,?,?,?,?,?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $surname, $address, $email, $phone, $hashedPw]);

        $pdo = null;
        $stmt = null;

        header('location:../index.php?signup=success');

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}