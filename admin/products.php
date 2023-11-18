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
            <h1>Products
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
                <h3>List of Products</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody class=" ">
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

                                <td>


                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="edit-product.php?id=<?php echo $product['id']; ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </a>
                                        <form action="../handlers/deleteProduct.php" method="post"
                                            enctype="multipart/form-data">
                                            <input name="id" value="<?php echo $product['id']; ?>" type="hidden">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="showDeleteMessage()">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>


                            <!-- ... Your existing PHP and HTML code ... -->

                            <script>
                                function showDeleteMessage() {
                                    alert("You have deleted the product");
                                }

                            </script>



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