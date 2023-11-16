<?php
function deleteExistingToken($email, $code)
{
    include "../config/dbh.inc.php";

    try {
        $table;
        $column;

        switch ($code) {
            case 0:
                $table = "customer_staff_activation";
                $column = "email";
                break;
            case 1:
                $table = "pwd_reset";
                $column = "pwd_email";
                break;

        }

        $query = "DELETE FROM `$table` WHERE $column = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        header("location:../pages/forgot-password.php?error=error");
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}