<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/Stylee.css">
    <script>
        function validateEmail() {
            var emailInput = document.forms["reset-password-form"]["email"].value;
            if (emailInput.indexOf('@') === -1 || emailInput.indexOf('.com') === -1) {
                alert("Please enter a valid email address (e.g., yourname@example.com).");
                return false;
            }
        }
    </script>
</head>

<body>
    <form method="post" action="reset_password_process.php" name="reset-password-form"
        onsubmit="return validateEmail()">
        <div class="form-element">
            <label>Email</label>
            <input type="email" name="email" required />
        </div>
        <button type="submit" name="reset_password" value="Reset Password">Reset Password</button>
    </form>
</body>

</html>