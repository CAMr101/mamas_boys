<?php
require "../vendor/autoload.php";

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

            header("location:../pages/contact.php?sent=success");

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    } else {
        header("location:../pages/contact.php?error=null");
    }

}