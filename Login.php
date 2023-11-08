<?php
session_start();
include('Configuration.php');
include "./components/footer.component.php";
include "./components/header.component.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo '<p class="error">User not found!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['email'] = $result['email'];
            header("location: home.php");
            exit;
        } else {
            echo '<p class="error">Incorrect password!</p>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/Stylee.css">
</head>

<body>


    <form method="post" action="" name="signin-form">
        <div class="form-element">
            <label>Email</label>
            <input type="text" name="email" required />
        </div>

        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit" name="login" value="login">Log In</button>
        <p>Do not have an account? <a href="register.php">Register here</a></p>
        <p>Forgot Password? <a href="reset_password.php">Reset Password</a></p>
    </form>


</body>

</html>