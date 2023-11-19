<?php
require_once "../handlers/processImage.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv as Dotenv;

require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

function adminVerificationEmail($email, $name, $url)
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
  $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "Mama's Boy's");
  $mail->addAddress($email, $name);
  $mail->isHTML(true); //Set email format to HTML

  $mail->Subject = 'Account Verification';

  ob_start();
  include '../templates/admin_email-verification.html';
  $message = ob_get_contents();
  ob_end_clean();

  $message = str_replace("{{link}}", $url, $message);
  $message = str_replace("{{name}}", ucfirst($name), $message);

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
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = $_ENV["MAIL_HOSTNAME"];
  $mail->SMTPAuth = true;
  $mail->Username = $_ENV["MAIL_NO_REPLY_USERNAME"];
  $mail->Password = $_ENV["MAIL_NO_REPLY_PASSWORD"];
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 465;

  //Recipients
  $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "Mama's Boy's");
  $mail->addAddress($email, $name);
  $mail->isHTML(true); //Set email format to HTML

  $mail->Subject = 'Account Verification';

  ob_start();
  include '../templates/email-verification.html';
  $message = ob_get_contents();
  ob_end_clean();

  $message = str_replace("{{link}}", $url, $message);
  $message = str_replace("{{name}}", ucfirst($name), $message);

  $mail->Body = $message;
  $mail->AltBody = 'Your have registered with Mamas Boys, Here is your account verification link: ' . $url;

  if (!$mail->send()) {
    return false;
  } else {
    return true;
  }

}

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
  $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "Mama's Boy's");
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
    return false;
  } else {
    return true;
  }

}

function sendPasswordResetEmail($email, $name, $url)
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
  $mail->setFrom($_ENV["MAIL_NO_REPLY_USERNAME"], "Mama's Boy's");
  $mail->addAddress($email, $name);
  $mail->isHTML(true); //Set email format to HTML

  $mail->Subject = 'Password Reset for Mamas Boys Account';

  ob_start();
  include '../templates/reset-password.html';
  $message = ob_get_contents();
  ob_end_clean();

  $message = str_replace("{{Reset-link}}", $url, $message);

  $mail->Body = $message;
  $mail->AltBody = 'Your password reset link: ' . $url;

  if (!$mail->send()) {
    return false;
  } else {
    return true;
  }
}

function sendOrderConfirmationEmail($order)
{
  //enables exceptions
  $mail = new PHPMailer(true);
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = $_ENV["MAIL_HOSTNAME"];
  $mail->SMTPAuth = true;
  $mail->Username = $_ENV["MAIL_ORDER_USERNAME"];
  $mail->Password = $_ENV["MAIL_ORDER_PASSWORD"];
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 465;

  //Recipients
  $mail->setFrom($_ENV["MAIL_ORDER_USERNAME"], "Mama's Boy's Orders");
  $mail->addAddress($order["email"], $order["name"]);
  $mail->isHTML(true); //Set email format to HTML

  $mail->Subject = 'Order Confirmation';

  ob_start();
  include '../templates/order-confirmation_2.html';
  $message = ob_get_contents();
  ob_end_clean();

  $text = "Your order has been received. And we've place our top chef on it. Hang on tight. <p>Once your order is complete, you will recieve a phone call to notify you of collection and reminder of payment due.</p> <p>Thank you for shopping with us. See you soon.</p>";

  $message = str_replace("{{orderNum}}", $order["id"], $message);
  $message = str_replace("{{date}}", $order["created_at"], $message);
  $message = str_replace("{{name}}", ucfirst($order["name"]), $message);
  $message = str_replace("{{message}}", $text, $message);

  $orderItems = json_decode($order['order_items'], true);
  $productList = createProductSection($orderItems);

  $message = str_replace("{{PRODUCTS}}", $productList, $message);
  // $message = str_replace("{{PRODUCTS}}", "", $message);
  $message = str_replace("{{orderTotal}}", $order["order_total"], $message);

  $mail->Body = $message;
  $mail->AltBody = 'Hi, ' . ucfirst($order["name"]) . '! We have recieved your order(#' . $order["id"] . '). And we\'ve placed our top chef on it. Order total: R ' . $order["order_total"] . '. Thank you for shopping with us.';

  if (!$mail->send()) {
    // echo "Mail could not be sent";
    // echo "Mail error" . $mail->ErrorInfo;

    return false;

  } else {

    // header("location:../pages/mail-sent.php?success=true");
    // echo "mail sent";

    return true;
  }

}


function createProductSection($orderItems)
{
  $message = "";

  $counter = 0;
  foreach ($orderItems as $item) {
    $img = getImageByProductId($item['id']);
    $product = getProduct($item['id']);

    $text = `<div class="u-row-container" style="padding: 0px;background-color: transparent">
        <div class="u-row" style="margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
          <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
            
      <!--[if (mso)|(IE)]><td align="center" width="300" style="background-color: #eeeeee;width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
      <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
        <div style="background-color: #eeeeee;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
        <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
      <!-- IMAGE -->
      <table style="font-family:'Rubik',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
        <tbody>
          <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px;font-family:'Rubik',sans-serif;" align="left">
              <!-- IMAGE -->
      <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td class="v-text-align" style="padding-right: 0px;padding-left: 0px;" align="center">
            
            <img align="center" border="0" src="{{productImage}}" alt="Model" title="Model" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 201px;" width="201" class="v-src-width v-src-max-width"/>
            
          </td>
        </tr>
      </table>
      
            </td>
          </tr>
        </tbody>
      </table>
      
        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
        </div>
      </div>
      <!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]><td align="center" width="300" style="background-color: #eeeeee;width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
      <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
        <div style="background-color: #eeeeee;height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
        <!--[if (!mso)&(!IE)]><!--><div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
        <!-- PRODUCT NAME -->
      <table id="u_content_heading_5" style="font-family:'Rubik',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
        <tbody>
          <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:33px 10px 0px;font-family:'Rubik',sans-serif;" align="left">
              
        <!--[if mso]><table width="100%"><tr><td><![endif]-->
          <h1 class="v-text-align v-font-size" style="margin: 0px; line-height: 140%; text-align: left; word-wrap: break-word; font-family: 'Rubik',sans-serif; font-size: 18px; font-weight: 400;"><span><span><strong>{{productName}}</strong></span></span></h1>
        <!--[if mso]></td></tr></table><![endif]-->
      
            </td>
          </tr>
        </tbody>
      </table>
      <!--  DESCRIPTION -->
      <table id="u_content_text_9" style="font-family:'Rubik',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
        <tbody>
          <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 10px;font-family:'Rubik',sans-serif;" align="left">
              
        <div class="v-text-align v-font-size" style="font-size: 14px; line-height: 170%; text-align: left; word-wrap: break-word;">
          <p style="font-size: 14px; line-height: 170%;">Quantity: {{quantity}}</p>
        </div>
      
            </td>
          </tr>
        </tbody>
      </table>
      <!-- PRODUCT PRICE -->
      <table id="u_content_heading_6" style="font-family:'Rubik',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
        <tbody>
          <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 32px;font-family:'Rubik',sans-serif;" align="left">
              
        <!--[if mso]><table width="100%"><tr><td><![endif]-->
          <h1 class="v-text-align v-font-size" style="margin: 0px; color: #e67e23; line-height: 140%; text-align: left; word-wrap: break-word; font-family: 'Rubik',sans-serif; font-size: 18px; font-weight: 400;"><span><span><span><span>Price:<strong>R {{productPrice}}</strong></span></span></span></span></h1>
        <!--[if mso]></td></tr></table><![endif]-->
      
            </td>
          </tr>
        </tbody>
      </table>
      
        <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
        </div>
      </div>
      <!--[if (mso)|(IE)]></td><![endif]-->
            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
          </div>
        </div>
        </div>`;

    if (is_null(getImageByProductId($item['id']))) {
      $text = str_replace("{{productImage}}", "", $text);
    } else {
      $text = str_replace("{{productImage}}", $img['location'], $text);
    }
    $text = str_replace("{{productName}}", $product["name"], $text);
    $text = str_replace("{{quantity}}", $item['quantity'], $text);
    $text = str_replace("{{productPrice}}", $product["price"], $text);

    $message = $message . $text;
    $counter++;
  }

  return $message;
}

?>