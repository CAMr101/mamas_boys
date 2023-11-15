<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv as Dotenv;

require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

function sendAdminPasswordResetEmail($email, $name, $url)
{
    //enables exceptions
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = $_ENV["MAIL_HOSTNAME"];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV["MAIL_NO_REPLY_USERNAME"];
    $mail->Password = $_ENV["MAIL_NO_REPLY_PASSWORD"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    //Recipients
    $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], 'no-reply');
    $mail->addAddress($email, $name);
    $mail->isHTML(true); //Set email format to HTML

    $mail->Subject = 'Password Reset for Mamas Boys Admin Dashboard';

    ob_start();
    include '../templates/reset-password.html';
    $message = ob_get_contents();
    ob_end_clean();

    $message = str_replace("{{Reset-link}}", $url, $message);

    $mail->Body = $message;
    $mail->AltBody = 'Your password reset link: ' . $url;

    if (!$mail->send()) {
        echo "Mail could not be sent";
        echo "Maile error" . $mail->ErrorInfo;

        header("location:../admin/forgot-password.php?error=notsent");
        exit();
    } else {
        header("location:../admin/mail-sent.php?success=true");
        exit();
    }

}

function sendPasswordResetEmail($email, $name, $url)
{
    //enables exceptions
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = $_ENV["MAIL_HOSTNAME"];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV["MAIL_NO_REPLY_USERNAME"];
    $mail->Password = $_ENV["MAIL_NO_REPLY_PASSWORD"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    //Recipients
    $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], $_ENV[]);
    $mail->addAddress($email, $name);
    $mail->isHTML(true); //Set email format to HTML

    $mail->Subject = 'Password Reset for Mamas Boys Admin User Account';

    ob_start();
    include '../templates/reset-password.html';
    $message = ob_get_contents();
    ob_end_clean();

    $message = str_replace("{{Reset-link}}", $url, $message);

    $mail->Body = $message;
    $mail->AltBody = 'Your password reset link: ' . $url;

    if (!$mail->send()) {
        echo "Mail could not be sent";
        echo "Maile error" . $mail->ErrorInfo;

        header("location:../pages/forgot-password.php?error=notsent");
    } else {
        header("location:../pages/mail-sent.php?success=true");
    }

}


