<?php
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST)) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $message = $_POST["message"];

        // sendMail($firstName, $lastName, $email, $phoneNumber, $message);

        print_r($_POST);

        include "../config/dbh.inc.php";

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO messages (name, surname, email, phone, message) VALUES (?,?,?,?,?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $message]);

            $pdo = null;
            $stmt = null;

            header("location:../Contact.php?sent=success");

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    } else {
        header("location:../Contact.php?error=null");
    }

}

function sendMail($firstName, $lastName, $email, $phoneNumber, $message)
{


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com.";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = '';
    $mail->Password = '';

    $mail->setFrom($email, $firstName);
    $mail->addAddress("neocamtom@gmail.com", "Neo");

    $mail->Subject = "Contact Us";
    $mail->Body = $message;

    $mail->send();
}