

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .card {
        margin-top: 100px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f5f5f5;
    }

    .card-body {
        padding: 20px;
    }
</style>

<body>
    <!-- Login Box -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="form-group">
                                <label for "email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for "password">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting by default.

            // Get the values entered by the user.
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Check if the entered email and password match the desired values.
            if (email === "mamaboy@gmail.com" && password === "kota24") {
                // Redirect to admin.php upon successful login.
                window.location.href = "admin.php";
            } else {
                alert("Login failed. Please check your email and password."); // Show an error message for failed login.
            }
        });
    </script>
</body>

</html>