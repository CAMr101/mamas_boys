<?php

// $host = "127.0.0.1";
// $port = 3306;
// $dbname = "mamasboy_db";
// $dbusername = "mamasboy_user";
// $dbpassword = "zOK95pYbCQ6m";

// $mysqli = new mysqli($host, $dbusername, $dbpassword, $dbname);
// echo $mysqli->host_info . "\n";

$host = "localhost";
$dbname = "mamasboys_db";
$dbusername = "root";
$dbpassword = "";

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}




