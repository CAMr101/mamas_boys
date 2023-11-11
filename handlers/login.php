<?php

if (isset($_REQUEST['login']) && ($_GET['login'] == 0 || $_GET['login'] == 1) && isset($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $code = $_GET['login'];

    authenticate($email, $password, $code);
}

function authenticate($email, $password, $code)
{
    include "../config/dbh.inc.php";
    include "./passwordHash.php";

    $hPw = hashPassword($password);

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        switch ($code) {
            case 0:
                $query = "SELECT * FROM `staff` WHERE email = ?;";
                break;
            case 1:
                $query = "SELECT * FROM `customer` WHERE email = ?;";
                break;
            default:
                header("location:../index.php");
                break;
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            if ($row["password"] == $hPw) {
                switch ($code) {
                    case 0:
                        header("location:../admin/admin.php?login=success");
                        break;
                    case 1:
                        header("location:../index.php?login=success");
                        break;
                }
            } else {
                switch ($code) {
                    case 0:
                        header("location:../admin/admin.php?login=failed");
                        break;
                    case 1:
                        header("location:../index.php?login=failed");
                        break;
                }
            }
        }


        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}
