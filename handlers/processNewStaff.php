<?php
include 'processImage.php';
include 'passwordHash.php';
include './enums/staff.php';
include './email.php';
include './helpers/deleteToken.php';
include './helpers/saveToken.php';
include './helpers/create-selector.php';
include './helpers/create-token.php';
include './processStaff.php';

ob_start();

$staffUrl = "../admin/staff.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    $sendVerificationEmail = $_POST['send-verification'];
    $validType = 0;

    foreach (StaffType::cases() as $enumType) {

        if ($enumType->name === $type) {
            $validType = 1;
        }
    }

    if ($validType != 1) {
        header("location:../admin/new-staff.php?error=type");
    }

    try {

        include "../config/dbh.inc.php";

        $user = getStaffByEmail($email);

        if (!empty($user)) {
            header("location:../admin/staff.php?error=exist");
        }

        $verified = 1;

        if ($sendVerificationEmail == "on") {

            $verified = 0;
            $selector = createSelector();
            $token = createToken();

            $url = "www.mamas-boys.co.za/handlers/verifyEmail.php?mid=0&selector=" . $selector . "&validator=" . $token;

            $hashed_token = hashPassword($token);

            deleteExistingToken($email, 0);
            saveActivationToken($email, $selector, $hashed_token);

            $mailSent = adminVerificationEmail($email, $name, $url);

            if ($mailSent !== true) {
                header("location:../admin/new-staff.php?error=mail");
            }
        }

        $hashed_password = hashPassword($password);


        $query = "INSERT INTO staff (name, surname, email, phone, password,verified, type) VALUES (?,?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $surname, $email, $phone, $hashed_password, $verified, $type]);

        $query = "SELECT id FROM staff WHERE password = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$hashed_password]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $staffId = $result[0]["id"];

        $pdo = null;
        $stmt = null;

        if ($sendVerificationEmail == "on") {
            header("location:../admin/staff.php?success=success&mail=sent");
        } else {
            header("location:../admin/staff.php?success=success");
        }
        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("location:$staffUrl");
}

// function checkUserExist($email)
// {
//     ob_start();
//     try {
//         include "../config/dbh.inc.php";

//         $query = "SELECT * FROM `staff`;";
//         $stmt = $pdo->prepare($query);
//         $stmt->execute();
//         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         $counter = count($result);

//         for ($i = 0; $i < $counter; $i++) {
//             if ($result[$i]["email"] == $email) {
//                 header("location:../admin/staff.php?error=exist");
//             }
//         }

//     } catch (PDOException $e) {
//         header("location:../admin/login.php?error=error");
//     }
// }

?>