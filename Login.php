<?php
session_start();

include "./components/footer.component.php";
include "./components/header.component.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/style3.css">
    <link rel="stylesheet" href="./assets/css/addtocart.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }

        .main-content {
            background-color: #AAAAAA !important;
        }
    </style>

</head>

<body>

    <?php
    echo createHeader();
    ?>


    <main class="main-content">
        <!-- Login Section -->
        <section id="login" class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2>Login</h2>
                    <form id="loginForm">

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <div>
                        <p class="text-center mt-3">Don't have an account? <a href="register.php">Signup</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    echo createFooter();
    ?>