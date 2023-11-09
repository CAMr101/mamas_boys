<?php
include("../handlers/processCategory.php");
include("../handlers/processProducts.php");

?>


<?php include '../components/admin-header.php'; ?>

<?php
if (isset($_POST)) {
    $data = file_get_contents("php://input");
    $customerOrder = json_decode($data, true);

    $cName = $customerOrder["cName"];
    $cEmail = $customerOrder["cEmail"];
    $cPhone = $customerOrder["cPhone"];
    $orderTotal = $customerOrder["orderTotal"];
    $orderItems = json_encode($customerOrder["orderItems"]);
    $paymentMethod = $customerOrder["paymentMethod"];
    $paid = 0;


    try {
        require_once "../config/dbh.inc.php";

        $query = "INSERT INTO category (name, description, image_id) 
        VALUES (?,?,?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$name, $description, $imageId]);

        $pdo = null;
        $stmt = null;

        echo (1);

        die();

    } catch (PDOException $e) {
        echo (0);
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("location:../home.php");
}
?>

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
            <h1>Category Name</h1>
            <ul class="breadcrumb">
                <li><a href="shop.html">
                        Category
                    </a></li>
                /
                <li><a href="new-category.html" class="active">New</a></li>
            </ul>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Products</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                            <td>001</td>
                            <td>Mustang</td>
                            <td>Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese</td>
                            <td>R 120</td>
                            <td>Kota</td>
                        </tr> -->

                    <?php
                    $products = getProductsByCategoryId();

                    if ($products !== null) {
                        foreach ($products as $product) { ?>

                            <tr>
                                <td>
                                    <?php echo $product['id']; ?>
                                </td>
                                <td>
                                    <?php echo $product['name']; ?>
                                </td>
                                <td>
                                    <?php echo $product['description']; ?>
                                </td>
                                <td>R
                                    <?php echo $product['price']; ?>
                                </td>
                            </tr>

                        <?php }
                    } else {

                    }
                    ?>

                    <!-- <tr>
                            <td>005</td>
                            <td>Porche</td>
                            <td>Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese</td>
                            <td>R 100</td>
                            <td>Kota</td>
                        </tr> -->
                </tbody>
            </table>
        </div>

    </div>

</main>



</body>

</html>