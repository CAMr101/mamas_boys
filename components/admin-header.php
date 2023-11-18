<?php
// session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="keywords" content="Mams Boys Kota & Chips">
    <meta name="description"
        content="Founded by Nhlanhla Theobold Mabasa, a culinary enthusiast with a passion for creating simple yet exceptional South African street cuisine. 
                                                The food truck has gained a loyal following of food enthusiasts and has become a go-to spot for foodies seeking trusted and flavourful experiences.
                                                With a background in the vibrant culture of street food, Nhlanhla decided to venture out and create his own brand. His aspiration is for his brand to center around the customer's complete immersion in the diverse array of flavors presented by the distinctive taste of the country. The client exclusively offers street food, specializing in kota’s and chips.">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/favicon.png">
    <meta name="apple-mobile-web-app-title" content="Mams Boys Kota & Chips">
    <meta name="application-name" content="Mams Boys Kota & Chips">
    <meta name="theme-color" content="#ffffff">
    <!-- Style Sheets -->
    <link rel="stylesheet" href="../assets/css/admin.new.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">  -->

</head>

<body>

    <!-- Side Nav -->
    <div class="side-nav">
        <a href="admin.php" class="logo">
            <img src="../assets/images/logo.png" alt="Mama's Boy's Logo">
        </a>
        <ul class="side-menu">
            <li class="side-menu-item">
                <a href="admin.php">
                    <span class="material-symbols-outlined">
                        space_dashboard
                    </span>
                    Dashboard
                </a>
            </li>
            <li class="side-menu-item">
                <a href="orders.php">
                    <span class="material-symbols-outlined">
                        orders
                    </span>
                    Orders
                </a>
            </li>
            <!-- <li class="side-menu-item">
                <a href="shop.php">
                    <span class="material-symbols-outlined">
                        store
                    </span>
                    Shop
                </a>
            </li> -->
            <!-- Adding an independent Category Tab -->
            <li class="side-menu-item">
                <a href="categories.php">
                    <span class="material-symbols-outlined">
                        folder
                    </span>
                    Categories
                </a>
            </li>
            <!-- Adding an independent Products Tab -->
            <li class="side-menu-item">
                <a href="products.php">
                    <span class="material-symbols-outlined">
                        shop
                    </span>
                    Products
                </a>
            </li>
            <li class="side-menu-item">
                <a href="reports.php">
                    <span class="material-symbols-outlined">
                        description
                    </span>
                    Reports
                </a>
            </li>
            <li class="side-menu-item">
                <a href="staff.php">
                    <span class="material-symbols-outlined">
                        badge
                    </span>
                    Staff
                </a>
            </li>
            <li class="side-menu-item">
                <a href="customers.php">
                    <span class="material-symbols-outlined">
                        groups
                    </span>
                    Customers
                </a>
            </li>
            <li class="side-menu-item">
                <a href="messages.php">
                    <span class="material-symbols-outlined">
                        mail
                    </span>
                    Messages
                </a>
            </li>
            <!-- <li class="side-menu-item">
                <a href="/admin/staff.html">Staff</a>
            </li> -->
        </ul>
        <ul class="side-menu">
            <li class="side-menu-item">
                <a href="../handlers/logout.php" class="logout">
                    <span class="material-symbols-outlined">
                        logout
                    </span>
                    Logout
                </a>
            </li>
        </ul>
    </div>