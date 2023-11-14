<?php
//update customer
if (isset($_REQUEST['update']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)) {
    include 'passwordHash.php';

    $code = $_REQUEST['update'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    $pw_hashed = hashPassword($password);
    $cPw_hashed = hashPassword($confirmPassword);

    switch ($code) {
        case 1:
            if (checkPasswordMatch($pw_hashed, $cPw_hashed) == true) {
                updateCustomer($name, $surname, $email, $phone, $pw_hashed, $password, $id);
                $user = getCustomer($id);
                $_SESSION["customer_name"] = $user["name"];
                header('location:../pages/edit.php?success=true');
            } else {
                header('location:../pages/edit.php?error=pw');
            }
            break;
        default:
            header('location:../pages/edit.php?error=unknown');
            break;
    }
}

//Delete customer
if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 'true') {
    $id = $_SESSION['customer_id'];

    $deleteComplete = deleteCustomer($id);
    if ($deleteComplete == true) {
        session_start();
        session_unset();
        session_destroy();
        header('location:../index.php?success=delete');
    } else
        header('location:../pages/account.php?error=delete');
}

function getCustomers()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT `id`, `name`, `surname`, `email`, `phone`, `created_at` FROM `customer` WHERE 1;";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function getCustomer($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM customer WHERE id=?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function updateCustomer($name, $surname, $email, $phone, $pw, $normalPw, $id)
{
    include "../config/dbh.inc.php";

    try {
        if ($normalPw == "") {
            $query = "UPDATE `customer` SET `name`=?, `surname`=?, `email`=?, `phone`=? WHERE id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $surname, $email, $phone, $id]);
        } else {
            $query = "UPDATE `customer` SET `name`=?, `surname`=?, `email`=?, `phone`=?, `password`=? WHERE id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $surname, $email, $phone, $pw, $id]);
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function deleteCustomer($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "DELETE FROM `customer` WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $pdo = null;
        $stmt = null;

        return true;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function checkPasswordMatch($pw, $cPw)
{

    if ($pw === $cPw)
        return true;
    else
        return false;
}