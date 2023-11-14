<?php
session_start();

include "../components/header.php";
include "../components/footer.php";
include "../handlers/processCustomer.php";

if (isset($_SESSION["customer_id"])) {
    $userId = $_SESSION["customer_id"];
    $user = getCustomer($userId);

} else {
    header("location:login.php?login=denied");
}

if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case 'unknown':
            $message = "Unknown Error. Please try again.";
            echo "<script>alert('$message');</script>";
            break;

        default:
            # code...
            break;
    }
}

if (isset($_REQUEST['success'])) {
    $code = $_REQUEST['success'];

    switch ($code) {
        case 'true':
            $message = "Successfully updated.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            # code...
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Website meta data -->
    <?php include "../components/customer-meta-data.php"; ?>


    <title>My Account</title>

    <?php include "../components/customer-meta-data.php"; ?>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <link rel="stylesheet" href="../assets/css/addtocart.css">
    <link rel="stylesheet" href="../assets/css/account-page.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        /* Initially hide container2 */
        .container2 {
            display: none;
        }
    </style>

</head>

<body>

    <!------------------------------------------------------------------- Header Section --------------------------------------------------------------------------------->

    <?php
    echo createHeader();
    ?>

    <?php include "../components/customer-nav.php"; ?>

    <main class="main-content">


        <ul class="insights">
            <a href="#">
                <li>
                    <span class="info">
                        <h3>
                            Update
                        </h3>
                        <p></p>
                    </span>
                </li>
            </a>
        </ul>

        <div class="bottom-data">
            <div class="orders">
                <!-- <div class="header">
                    <i class='bx bx-receipt'></i>
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                    <h3>Update</h3>
                </div> -->

                <form action="../handlers/processCustomer.php?update=1" method="post" enctype="multipart/form-data"
                    id="new-category">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <label for="name">Name</label>
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <input type="text" name="name" value="<?php echo $user['name']; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="surname">Surname</label>
                                </td>
                                <td>
                                    <input type="text" name="surname" value="<?php echo $user['surname']; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="type">Address</label>
                                </td>
                                <td>
                                    <input list="employee-type" name="address" value="<?php echo $user['address']; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="email">Email</label>
                                </td>
                                <td>
                                    <input type="email" name="email" value="<?php echo $user['email']; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label for="phone">Phone Number</label>
                                </td>
                                <td>
                                    <input type="text" name="phone" value="<?php echo $user['phone']; ?>">
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
                                <td colspan="3">

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button id="submitButton" style="max-width:175px;">Update Account</button>
                </form>

            </div>
        </div>
    </main>

    <?php
    echo createFooter();
    ?>


    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/confirmDelete.js"></script>


</body>

</html>