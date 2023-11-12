<?php

if (isset($_REQUEST['login']) && ($_GET['login'] == 0 || $_GET['login'] == 1) && isset($_POST)) {

    $code = $_GET['login'];

    //code 0 = admin and code 1 = customer
    switch ($code) {
        case 0:
            $page = $_POST['page'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            authenticate($email, $password);
            break;
        case 1:
            print_r($_POST);
            $email = $_POST['signin-email'];
            $password = $_POST['signin-password'];
            authenticateCustomer($email, $password);
            break;

        default:
            header("location:javascript://history.go(-1)");
            break;
    }
}

function authenticate($email, $password)
{
    include "../config/dbh.inc.php";
    include "./passwordHash.php";

    $hPw = hashPassword($password);

    try {

        $query = "SELECT * FROM `staff` WHERE email = ? AND password=?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $hPw]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            require_once "../config/config_session.inc.php";

            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];

            session_destroy();
            session_id($sessionId);
            session_start();

            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_name"] = $result["name"];
            $_SESSION['last_regeneration'] = time();

            header("location:../admin/admin.php?login=success");

        } else {
            $_SESSION["error_login"] = "Authenticatin Failed";
            header("location:../admin/login.php?login=failed");
        }

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}

function authenticateCustomer($email, $password)
{
    include "../config/dbh.inc.php";
    include "./passwordHash.php";

    $hPw = hashPassword($password);

    try {
        $query = "SELECT * FROM `customer` WHERE email = ? AND password=?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$email, $hPw]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            require_once "../config/config_session.inc.php";

            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];

            session_destroy();
            session_id($sessionId);
            session_start();

            $_SESSION["customer_id"] = $result["id"];
            $_SESSION["customer_name"] = $result["name"];
            $_SESSION['last_regeneration'] = time();

            header("location:javascript://history.go(-1)");

        } else {
            $_SESSION["error_login"] = "Authenticatin Failed";
            // header("location:../pages/login.php?login=failed");
        }

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}
