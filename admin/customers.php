<?php
include("../handlers/processCustomer.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$customers = getCustomers();

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>

<main class="main-content">
    <div class="header">
        <div class="left">
            <h1> Customers </h1>
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
                        <th>Date Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($customers !== null) {
                        foreach ($customers as $customer) { ?>

                            <tr>
                                <td>
                                    <a href="customer.php?id=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['id']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="customer.php?id=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="customer.php?id=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['surname']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="customer.php?id=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['email']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="customer.php?id=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['phone']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="customer.php?id=<?php echo $customer['id']; ?>">
                                        <?php echo $customer['created_at']; ?>
                                    </a>
                                </td>
                            </tr>

                        <?php }
                    } else {
                        echo "No Empolyees Found";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</main>