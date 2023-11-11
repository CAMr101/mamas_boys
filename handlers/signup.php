<?php
include 'passwordHash.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['method'])) {
    $method = $_GET['method'];

    $name = $_POST['firstName'];
    $surname = $_POST['lastName'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNumber'];
    $password = $_POST['password'];

    switch ($method) {
        case 0:
            if ($password == '')
                header('location:../index.php');
            header('location:../index.php');
            break;
        case 1:
            if ($password == '')
                header('location:../register.php');

            $hashedPw = hashPassword($password);

            signupCustomer($name, $surname, $address, $email, $phone, $hashedPw);
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