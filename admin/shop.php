<?php
include("../handlers/processCategory.php");
include("../handlers/processProducts.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

?>


<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>Categories</h1>
        </div>
    </div>

    <ul class="insights">
        <!-- <li><img class='bx bx-dollar-circle' alt="kota"></img>
                <span class="info">
                    <h3>
                        Kota
                    </h3>
                </span>
            </li> -->

        <?php
        $categories = getAllCategories();

        if ($categories !== null) {
            foreach ($categories as $category) { ?>
                <a href="category.php?id=<?php echo $category['id']; ?>">
                    <li><img class='bx bx-dollar-circle' alt="kota"></img>
                        <span class="info">
                            <h3>
                                <?php echo $category['name']; ?>
                            </h3>
                        </span>
                    </li>
                </a>
            <?php }
        } else {
            echo "No products found";
        }
        ?>
        <a href="new-category.php">
            <li><i class='bx bx-dollar-circle'>
                    <span class="material-symbols-outlined">
                        add
                    </span>
                </i>
                <span class="info">
                    <h3>
                        New
                    </h3>
                    <p>Category</p>
                </span>
            </li>
        </a>
    </ul>

    <div class="header">
        <div class="left">
            <h1>
                Products
                <a href="new-product.php">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                </a>
            </h1>
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
                        <th>Category</th>
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
                    $products = getAllProducts();

                    if ($products !== null) {
                        foreach ($products as $product) {
                            $categoryName = getCategoryName($product['category_id']);
                            ?>
                            <tr>
                                <td>
                                    <a href="product.php?id=<?php echo $product['id']; ?>">
                                        <?php echo $product['id']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="product.php?id=<?php echo $product['id']; ?>">
                                        <?php echo $product['name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="product.php?id=<?php echo $product['id']; ?>">
                                        <?php echo $product['description']; ?>
                                    </a>
                                </td>
                                <td>R
                                    <a href="product.php?id=<?php echo $product['id']; ?>">
                                        <?php echo $product['price']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="product.php?id=<?php echo $product['id']; ?>">
                                        <?php echo $categoryName['name']; ?>
                                    </a>
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