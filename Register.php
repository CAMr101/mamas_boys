<?php
session_start();
include('Configuration.php');
include "./components/footer.component.php";
include "./components/header.component.php";

function sendRegistrationEmail($email)
{
    $subject = "Registration Confirmation";
    $message = "Thank you for registering on our website. Your registration was successful.";
    $headers = "From: gladbaloyi24@gmail.com"; // Replace with your Gmail email address

    // Configure the SMTP settings for Gmail
    ini_set("SMTP", "smtp.server.com");
    ini_set("smtp_port", "587"); // Use port 587 for TLS

    // Enable STARTTLS for a secure connection
    ini_set("sendmail_from", "gladbaloyi24@gmail.com"); // Replace with your Gmail email address
    ini_set("sendmail_path", "C:\wamp64\bin\SendMail-1.3.0"); // Replace with the correct path to sendmail.exe

    // Send the email
    mail($email, $subject, $message, $headers);
}

if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Add password strength validation
    if (strlen($password) < 8) {
        echo '<p class="error">Password must be at least 8 characters long.</p>';
    } elseif (!preg_match('/\d/', $password)) {
        echo '<p class="error">Password must contain at least one digit.</p>';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        echo '<p class="error">Password must contain at least one uppercase letter.</p>';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            echo '<p class="error">The email address is already registered!</p>';
        } else {
            $query = $connection->prepare("INSERT INTO users(first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password_hash)");
            $query->bindParam("first_name", $first_name, PDO::PARAM_STR);
            $query->bindParam("last_name", $last_name, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $result = $query->execute();

            if ($result) {
                header("Location: home.php");
                exit();

                // Send a registration confirmation email
                sendRegistrationEmail($email);
            } else {
                echo '<p class="error">Your registration was not successful!</p>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="Stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/style3.css">
    <script>
        function validateEmail() {
            var emailInput = document.forms["signup-form"]["email"].value;
            if (emailInput.indexOf('@') === -1 || emailInput.indexOf('.com') === -1) {
                alert("Please enter a valid email address (e.g., yourname@example.com).");
                return false;
            }
        }
    </script>
</head>

<body>



    <form method="post" action="" name="signup-form" onsubmit="return validateEmail()">
        <div class="form-element">
            <label>First Name</label>
            <input type="text" name="first_name" required />
        </div>
        <div class="form-element">
            <label>Last Name</label>
            <input type="text" name="last_name" required />
        </div>
        <div class="form-element">
            <label>Email</label>
            <input type="email" name="email" required />
        </div>
        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <div class="form-element">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required />
        </div>
        <button type="submit" name="register" value="register">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>


</body>

</html>