<?php
include("../handlers/processStaff.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$staffId = $pathParams[1];

$staffMember = getStaffById($staffId);

if ($staffMember == null) {
    header('location:staff.php?error=notfound');
}


if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case "pw":
            $message = "Password does not match. Please try again";
            echo "<script>alert('$message');</script>";
            break;
        case "delete":
            $message = "Could not delete user. Please try again.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            $message = "Something went wrong. please try again";
            echo "<script>alert('$message');</script>";
            break;
    }
}

if (isset($_REQUEST["success"])) {
    $message = "Successfully updated account.";
    echo "<script>alert('$message');</script>";
}

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                <?php echo ucfirst($staffMember['name']) . " " . ucfirst($staffMember['surname']); ?>
            </h1>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Type</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if ($staffMember !== null) { ?>

                        <tr>
                            <td>
                                <?php echo $staffMember['id']; ?>
                            </td>
                            <td>
                                <?php echo $staffMember['name']; ?>
                            </td>
                            <td>
                                <?php echo $staffMember['surname']; ?>
                            </td>
                            <td>
                                <?php echo $staffMember['email']; ?>
                            </td>
                            <td>
                                <?php echo $staffMember['phone']; ?>
                            </td>
                            <td>
                                <?php echo $staffMember['type']; ?>
                            </td>
                            <td>
                                <a href="../handlers/processStaff.php?delete=<?php echo $staffMember['id']; ?>"
                                    id="confirmDeleteUser">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php
                    } else {
                        echo "No products found";
                    }
                    ?>

                    <!-- <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status pending">Pending</span></td>
                        </tr>

                        <tr>
                            <td>
                                <img src="images/profile-1.jpg">
                                <p>John Doe</p>
                            </td>
                            <td>14-08-2023</td>
                            <td><span class="status process">Processing</span></td>
                        </tr> -->
                </tbody>
            </table>
        </div>

    </div>

    <div class="bottom-data">
        <div class="orders">

            <div class="header">
                <i class='bx bx-receipt'></i>
                <span class="material-symbols-outlined">
                    edit
                </span>
                <h3>Update</h3>

            </div>

            <form action="../handlers/processStaff.php?update=1" method="post" enctype="multipart/form-data"
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
                                <input type="hidden" name="id" value="<?php echo $staffMember['id']; ?>">
                                <input type="text" name="name" value="<?php echo $staffMember['name']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="surname">Surname</label>
                            </td>
                            <td>
                                <input type="text" name="surname" value="<?php echo $staffMember['surname']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="email">Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $staffMember['email']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="phone">Phone Number</label>
                            </td>
                            <td>
                                <input type="text" name="phone" value="<?php echo $staffMember['phone']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="password">New Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" id="password">
                                <span id="message" style="color:red"> </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="password">Confirm New Password</label>
                            </td>
                            <td>
                                <input type="password" name="confirm-password" id="confirmPassword">
                                <span id="confirmMessage" style="color:red"> </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="type">Type</label>
                            </td>
                            <td>
                                <input list="employee-type" name="type" value="<?php echo $staffMember['type']; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <button id="submitButton">Update Staff</button>
            </form>


        </div>

    </div>

</main>

<script src="../assets/js/admin_confirmDelete.js"></script>

</body>

</html>