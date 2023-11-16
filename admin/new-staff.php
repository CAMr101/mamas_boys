<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case "type":
            $message = "Type does not exist. Please choose from the provided options.";
            echo "<script>alert('$message');</script>";
            break;
        case "mail":
            $message = "Verification mail could not be sent. Please try again";
            echo "<script>alert('$message');</script>";
            break;
        case "exist":
            $message = "User with the provided email already exists.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            $message = "Something went wrong. please try again";
            echo "<script>alert('$message');</script>";
            break;
    }
}
?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>New Staff Member</h1>
            <ul class="breadcrumb">
                <li><a href="staff.php">
                        Staff
                    </a></li>
                /
                <li><a href="new-category.html" class="active">New</a></li>
            </ul>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">

            <form action="../handlers/processNewStaff.php" method="post" enctype="multipart/form-data"
                id="new-category">

                <datalist id="employee-type">
                    <option value="Admin"></option>
                    <option value="Kitchen"></option>
                </datalist>

                <table>
                    <tbody>
                        <tr>
                            <td>
                                <label for="name">Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="name_input_field" required>
                                <span id="name_message" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="surname">Surname</label>
                            </td>
                            <td>
                                <input type="text" name="surname" id="surname_input_field" required>
                                <span id="surname_message" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" id="email_input_field" required>
                                <span id="email_message" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">Send verification email</label>
                            </td>
                            <td>
                                <input type="checkbox" name="send-verification" id="send_verification_input_field">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phone">Phone Number</label>
                            </td>
                            <td>
                                <input type="tel" name="phone" id="phone_input_field" required>
                                <span id="phone_message" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" id="password" required>
                                <span id="message" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Confirm Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" id="confirmPassword" required>
                                <span id="confirmMessage" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="type">Type</label>
                            </td>
                            <td>
                                <input list="employee-type" name="type" id="type_input_field" required>
                                <span id="type_message" style="color:red"> </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <button id="submitButton" name="create-staff">Add Staff</button>
            </form>


        </div>

    </div>

</main>

<script src="../assets/js/verifyNewStaff.js"></script>


</body>

</html>