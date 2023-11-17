<?php
include("../handlers/processStaff.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$user = getStaffById($_SESSION['user_id']);

if ($user['type'] != 'admin') {
    header('location:../admin/admin.php?error=view');
}

$staffMember = getStaff();

if (isset($_REQUEST["success"])) {
    $code = $_REQUEST['success'];

    switch ($code) {
        case 'success':
            $mailMessage = "";
            if (isset($_REQUEST["mail"])) {
                $mailCode = $_REQUEST['mail'];

                switch ($mailCode) {
                    case 'sent':
                        $mailMessage = "Verification email sent. ";
                        break;
                    case 'failed':
                        $mailMessage = 'Verification email not sent. ';
                        break;
                    default:
                        break;
                }
            }
            $message = $mailMessage . "Successfully added staff member.";
            echo "<script>alert('$message');</script>";
            break;
        case 'delete':
            $message = "Successfully deleted user.";
            echo "<script>alert('$message');</script>";
            break;
        default:
            break;
    }
}

if (isset($_REQUEST["error"])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case 'exist':
            $message = "Staff member registered to this email already exists.";
            echo "<script>alert('$message');</script>";
            break;
        default:
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
            <h1>
                Staff Members
                <a href="new-staff.php">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                </a>
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
                        <th>Verified</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if ($staffMember !== null) {
                        foreach ($staffMember as $staff) { ?>

                            <tr>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo $staff['id']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo ucfirst($staff['name']); ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo ucfirst($staff['surname']); ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo $staff['email']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo $staff['phone']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo $staff['type']; ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="status <?php
                                    switch ($staff['verified']) {
                                        case 0:
                                            echo 'notStarted';
                                            break;
                                        case 1:
                                            echo 'completed';
                                            break;
                                    }
                                    ?>">
                                        <?php
                                        switch ($staff['verified']) {
                                            case 0:
                                                echo 'Pending';
                                                break;
                                            case 1:
                                                echo 'Verified';
                                                break;
                                                ;
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>

                        <?php }
                    } else {
                        echo "No Empolyees Found";
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

</main>



</body>

</html>