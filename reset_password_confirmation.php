<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Password Reset Confirmation</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/Stylee.css">

    <!-- Add JavaScript to redirect to reset_password_confirm.php after a delay -->
    <script type="text/javascript">
        setTimeout(function () {
            window.location.href = "reset_password_confirm.php";
        }, 5000); // Redirect after 5 seconds (you can adjust the delay as needed)
    </script>
</head>

<body>
    <p>An email with instructions on how to reset your password has been sent to your registered email address.</p>
</body>

</html>