<?php


//update staff
if (isset($_REQUEST['update']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)) {
    include 'passwordHash.php';

    $code = $_GET['update'];
    $staffId = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $type = $_POST['type'];

    $pw_hashed = hashPassword($password);
    $cPw_hashed = hashPassword($confirmPassword);

    switch ($code) {
        case '1':
            if (checkPasswordMatch($pw_hashed, $cPw_hashed) == true) {
                updateStaff($name, $surname, $email, $phone, $pw_hashed, $password, $type, $staffId);
                header('location:../admin/staff-member.php?success=true');
            } else {
                header('location:../admin/staff-member.php?error=pw');
            }
            break;
        default:
            header('location:../admin/staff-member.php?error=null');
            break;
    }
}

//delete staff
if (isset($_REQUEST['delete'])) {
    $id = $_REQUEST['delete'];
    session_start();
    $user = getStaffById($_SESSION['user_id']);

    if ($user['type'] != 'admin') {
        header('location:../admin/admin.php?error=notauthorised');
    } else {
        $deleteComplete = deleteStaffById($id);
        if ($deleteComplete == true)
            header('location:../admin/staff.php?success=delete');
        else
            header('location:../admin/staff-member.php?error=delete');
    }
}

function getStaff()
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM staff";
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


function getStaffById($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM staff Where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $staff = $result[0];


        $pdo = null;
        $stmt = null;

        return $staff;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function updateStaff($name, $surname, $email, $phone, $pw, $normalPw, $type, $id)
{
    include "../config/dbh.inc.php";

    try {
        if ($normalPw == "") {
            $query = "UPDATE `staff` SET `name`=?, `surname`=?, `email`=?, `phone`=?, `type`=? WHERE id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $surname, $email, $phone, $type, $id]);
        } else {
            $query = "UPDATE `staff` SET `name`=?, `surname`=?, `email`=?, `phone`=?, `password`=?, `type`=? WHERE id = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $surname, $email, $phone, $pw, $type, $id]);
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $staff = $result[0];


        $pdo = null;
        $stmt = null;

        return $staff;

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

function deleteStaffById($id)
{
    include "../config/dbh.inc.php";

    try {

        $query = "DELETE FROM `staff` WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);

        $pdo = null;
        $stmt = null;

        return true;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}