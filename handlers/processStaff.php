<?php

function getStaff()
{
    require_once "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM staff";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


function getStaffById($id)
{
    require_once "../config/dbh.inc.php";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM staff Where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $staff = $result[0];


        $pdo = null;
        $stmt = null;

        return $staff;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}