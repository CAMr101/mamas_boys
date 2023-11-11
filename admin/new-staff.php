<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
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
                <li><a href="shop.php">
                        Satff
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
                    <option value="admin"></option>
                    <option value="kitchen"></option>
                </datalist>

                <!-- <input type="hidden" name="MAX_FILE_SIZE" value=""> -->
                <table>

                    <tbody>
                        <tr>
                            <td>
                                <label for="name">Name</label>
                            </td>
                            <td>
                                <input type="text" name="name">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="surname">Surname</label>
                            </td>
                            <td>
                                <input type="text" name="surname">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="email">Email</label>
                            </td>
                            <td>
                                <input type="email" name="email">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="phone">Phone Number</label>
                            </td>
                            <td>
                                <input type="text" name="phone">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="password">Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" id="password">
                                <span id="message" style="color:red"> </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="password">Confirm Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" id="confirmPassword">
                                <span id="confirmMessage" style="color:red"> </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="type">Type</label>
                            </td>
                            <td>
                                <input list="employee-type" name="type">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <button id="submitButton">Add Staff</button>
            </form>


        </div>

    </div>

</main>

<script src="../assets/js/verifyPassword.js"></script>


</body>

</html>