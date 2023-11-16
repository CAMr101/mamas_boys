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
    $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "Reset Password on Mama's Boy's");
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
        // header("location:../admin/mail-sent.php?success=true");
        echo "mail sent";
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
    $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "Reset Password on Mama's Boy's");
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

function sendOrderConfirmationEmail($email, $name, $orderNum, $orderTotal)
{
    //enables exceptions
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = $_ENV["MAIL_HOSTNAME"];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV["MAIL_ORDER_USERNAME"];
    $mail->Password = $_ENV["MAIL_ORDER_PASSWORD"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    //Recipients
    $mail->setFrom($_ENV["MAIL_ORDER_USERNAME"], "Mama's Boy's Orders");
    $mail->addAddress($email, $name);
    $mail->isHTML(true); //Set email format to HTML

    $mail->Subject = 'Order Confirmation';

    ob_start();
    include '../templates/order-report.html';
    $message = ob_get_contents();
    ob_end_clean();

    $text = "Your order has been received. An we've place our top chef on it. Hang on tight. <p>Once your order is complete, you will recieve a phone call to notify you of collection and reminder of payment due.</p> <p>Thank you for shopping with us. See you soon.</p>";

    $message = str_replace("{{orderNumber}}", $orderNum, $message);
    $message = str_replace("{{name}}", ucfirst($name), $message);
    $message = str_replace("{{message}}", $text, $message);
    $message = str_replace("{{totalOrder}}", $orderTotal, $message);

    $mail->Body = $message;
    $mail->AltBody = 'Hi, ' . ucfirst($name) . '! We have recieved your order(#' . $orderNum . '). And we\'ve placed our top chef on it. Order total: R ' . $orderTotal . '. Thank you for shopping with us.';

    if (!$mail->send()) {
        echo "Mail could not be sent";
        echo "Mail error" . $mail->ErrorInfo;


    } else {

        // header("location:../pages/mail-sent.php?success=true");
        echo "mail sent";
    }

}

function adminVerificationEmail($email, $name, $url)
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
    $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "VERIFY EMAIL on Mama's Boy's");
    $mail->addAddress($email, $name);
    $mail->isHTML(true); //Set email format to HTML

    $mail->Subject = 'Account Verification';

    ob_start();
    include '../templates/admin_email-verification.html';
    $message = ob_get_contents();
    ob_end_clean();

    $message = str_replace("{{link}}", $url, $message);
    $message = str_replace("{{name}}", $name, $message);

    $mail->Body = $message;
    $mail->AltBody = 'Your have registered with Mamas Boys, Here is your account verification link: ' . $url;

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }

}


function customerVerificationEmail($email, $name, $url)
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
    $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "VERIFY EMAIL on Mama's Boy's");
    $mail->addAddress($email, $name);
    $mail->isHTML(true); //Set email format to HTML

    $mail->Subject = 'Account Verification';

    ob_start();
    include '../templates/email-verification.html';
    $message = ob_get_contents();
    ob_end_clean();

    $message = str_replace("{{link}}", $url, $message);
    $message = str_replace("{{name}}", $name, $message);

    $mail->Body = $message;
    $mail->AltBody = 'Your have registered with Mamas Boys, Here is your account verification link: ' . $url;

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }

}