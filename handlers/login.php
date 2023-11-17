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

        $query = "SELECT * FROM `staff` WHERE email = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            switch ($$result["verified"]) {
                case 0:
                    header('location:../admin/login.php?error=active');
                    break;
                case 1:
                    if ($result['password'] === $hPw) {
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
                        header("location:../admin/login.php?login=incorrect");
                    }
                    break;
            }


        } else {
            $_SESSION["error_login"] = "Authenticatin Failed";
            header("location:../admin/login.php?login=failed");
        }

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        header("location:../admin/login.php?login=error");
        echo "Connection failed: " . $e->getMessage();
    }

}

function authenticateCustomer($email, $password)
{
    include "../config/dbh.inc.php";
    include "./passwordHash.php";

    $hPw = hashPassword($password);

    try {
        $query = "SELECT * FROM `customer` WHERE email = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            switch ($$result["verified"]) {
                case 0:
                    header('location:../pages/login.php?error=active');
                    break;
                case 1:
                    if ($result["password"] === $hPw) {
                        require_once "../config/config_session.inc.php";

                        $newSessionId = session_create_id();
                        $sessionId = $newSessionId . "_" . $result["id"];

                        session_destroy();
                        session_id($sessionId);
                        session_start();

                        $_SESSION["customer_id"] = $result["id"];
                        $_SESSION["customer_name"] = $result["name"];
                        $_SESSION['last_regeneration'] = time();

                        header("location:../index.php?login=success");
                    } else {
                        header("location:../pages/login.php?login=failed");
                    }
                    break;
            }


        } else {
            $_SESSION["error_login"] = "Authenticatin Failed";
            header("location:../admin/login.php?login=failed");
        }

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        header("location:../pages/login.php?login=error");
    }

}
