<?php
include("../handlers/processStaff.php");

$pathParams = $_SERVER['QUERY_STRING'];
if ($pathParams == null) {
    header("location:shop.php");
}

$pathParams = explode('=', $pathParams);
$staffId = $pathParams[1];

$staffMember = getStaffById($staffId);

if ($staffMember == null) {
    header('location:staff.php');
}

?>

<?php include '../components/admin-header.php'; ?>

<!-- Top nav -->
<!-- <nav class="top-nav">
        <a href="#" class="notif">
            <i class='bx bx-bell'></i>
            <span class="count">0</span>
        </a>
        <a href="#" class="profile">
            <img src="./assets/images/logo.png">
        </a>
    </nav> -->


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>
                Staff Members
                <a href="edit-staff.php?id=<?php echo $staffMember['id']; ?>">
                    <span class="material-symbols-outlined">
                        edit
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
                                <a href="../handlers/processStaff.php?delete=<?php echo $staffMember['id']; ?>">
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

</main>



</body>

</html>