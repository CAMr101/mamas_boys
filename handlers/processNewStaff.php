<?php
include 'processImage.php';
include 'passwordHash.php';

$staffUrl = "../admin/staff.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST)) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $hashed_password = hashPassword($password);

        try {
            require_once "../config/dbh.inc.php";

            $query = "INSERT INTO staff (name, surname, email, phone, password, type) 
        VALUES (?,?,?,?,?,?);";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$name, $surname, $email, $phone, $hashed_password, $type]);

            $query = "SELECT id FROM staff WHERE password = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$hashed_password]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $staffId = $result[0]["id"];

            $pdo = null;
            $stmt = null;

            header("location:$staffUrl?id=$staffId");

            die();

        } catch (PDOException $e) {
            echo (0);
            die("Query Failed: " . $e->getMessage());
        }
    } else {
        header("location:$staffUrl");
    }
} else {
    header("location:$staffUrl");
}