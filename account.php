<?php

include("Configuration.php");
include "./components/footer.component.php";
include "./components/header.component.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>My Account</title>
</head>

<body>
    <?php
    echo createHeader();
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #account-management {
            max-width: 600px;
            margin: 0 auto;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .tab-content {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
    </style>

    <nav>
        <a class="navbar-brand" href="#">BrandName</a>
        <button>
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul>
            <li class="nav-item active">
                <a href="#">Home</a>
            </li>
            <li class="nav-item">
                <a href="#">Orders</a>
            </li>
            <li class="nav-item">
                <a href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a href="#">Account</a>
            </li>
        </ul>
    </nav>


    <?php
    echo createFooter();
    ?>


    <script src=" ./assets/js/main.js"></script>
</body>

</html>