<?php
include("../handlers/processOrder.php");
include("../handlers/processCustomer.php");
include("../handlers/processMessages.php");
include("../handlers/processStaff.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$user = getStaffById($_SESSION['user_id']);

if ($user['type'] != 'admin') {
    header('location:../admin/admin.php?error=view');
}

$messages = getMessages();

?>


<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>

<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                Messages
            </h1>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">
            <!-- <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Messages</h3>
            </div> -->

            <table>
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($messages !== null) {
                        foreach ($messages as $message) { ?>

                            <tr>
                                <td>
                                    <?php echo ($message['name'] . " " . $message['surname']); ?>
                                </td>
                                <td>
                                    <?php echo $message['email']; ?>
                                </td>
                                <td>
                                    <?php echo $message['phone']; ?>
                                </td>
                                <td>
                                    <?php echo $message['message']; ?>
                                </td>
                                <td>
                                    <?php echo $message['created_at']; ?>
                                </td>
                            </tr>

                        <?php }
                    } else {

                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</main>