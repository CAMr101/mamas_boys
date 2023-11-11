<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-login.css">
    <title>Login</title>
</head>

<body>
    <!-- Page body/content -->
    <div class="main-container">

        <div class="container">

            <div class="text-container">
                <a href="../index.php">
                    <span class="heading" id="heading">
                        Mama's Boys
                    </span>
                    <p class="subtext">Because No Great Story </p>
                    <p class="subtext">Started With A Salad</p>
                </a>
            </div>


            <form action="../handlers/login.php?login=0" method="post">
                <h3>Admin Login</h3>

                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" id="password">
                <input type="hidden" name="page" id="page" value="<?php echo $_SERVER['PHP_SELF']; ?>">

                <button type="submit">Login</button>
                <div class="forgot-password">
                    <a href="forgot-password.php">
                        Forgot Password ?
                    </a>
                </div>
            </form>

        </div>
    </div>


</body>

</html>