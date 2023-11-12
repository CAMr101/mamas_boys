<?php
session_start();

include "../components/header.php";
include "../components/footer.php";

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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }

        .bg-light,
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
        <!-- Register Section -->
        <section id="register" class="bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h2>Register</h2>
                        <form id="registerForm" action="../handlers/signup.php?method=1" method="post">
                            <label for="firstName">First Name:</label>
                            <input type="text" name="firstName" class="form-control" id="firstName"
                                placeholder="Enter first name" required>

                            <label for="lastName">Last Name:</label>
                            <input type="text" name="lastName" class="form-control" id="lastName"
                                placeholder="Enter last name" required>

                            <label for="address">Home Address:</label>
                            <input type="text" name="address" class="form-control" id="address"
                                placeholder="Enter home address" required>

                            <label for="phoneNumber">Phone Number:</label>
                            <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber"
                                placeholder="Enter phone number" required>

                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
                                required>

                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter password" required>

                            <label for="confirmPassword">Confirm Password:</label>
                            <input type="password" name="confrimPassword" class="form-control" id="confirmPassword"
                                placeholder="Confirm password" required>

                            <button class="btn btn-primary w-100">Register</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    echo createFooter();
    ?>

    <!-- add confirm password script -->

</body>

</html>