<?php

if (isset($_REQUEST['login']) && ($_GET['login'] == 0 || $_GET['login'] == 1) && isset($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $page = $_POST['page'];

    $code = $_GET['login'];

    switch ($code) {
        case 0:
            authenticate($email, $password);
            break;
        case 1:
            # code...
            break;

        default:
            // echo 'failed';
            // header("location:javascript://history.go(-1)");
            break;
    }
    // authenticate($email, $password, $code);
}

function authenticate($email, $password)
{
    include "../config/dbh.inc.php";
    include "./passwordHash.php";

    $hPw = hashPassword($password);

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
