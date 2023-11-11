<?php
include("../handlers/processStaff.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$staffMember = getStaff();

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
                                        <?php echo $staff['name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="staff-member.php?id=<?php echo $staff['id']; ?>">
                                        <?php echo $staff['surname']; ?>
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