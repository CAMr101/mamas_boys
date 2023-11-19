<?php
include("../handlers/processOrder.php");
include("../handlers/processProducts.php");
include("../handlers/processStaff.php");
include("../handlers/processHighlights.php");

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}

$user = getStaffById($_SESSION['user_id']);

if ($user['type'] != 'admin') {
    header('location:../admin/admin.php?error=view');
}

$products = getAllProducts();
$highlights = getHighlights();
$count = count($highlights);

if (isset($_REQUEST['error'])) {
    $code = $_REQUEST['error'];

    switch ($code) {
        case "notauthorised":
            $message = "Not authorised to perform action.";
            echo "<script>alert('$message');</script>";
            break;
        case "view":
            $message = "Not allowed to view this page.";
            echo "<script>alert('$message');</script>";
            break;
        case "invalidProd":
            $message = "You've entered an invalid product";
            echo "<script>alert('$message');</script>";
            break;
        default:
            $message = "Something went wrong. please try again";
            echo "<script>alert('$message');</script>";
            break;
    }
}

if (isset($_REQUEST['success'])) {
    $code = $_REQUEST['success'];

    switch ($code) {
        case "true":
            $message = "Successfully added products to highlights.";
            echo "<script>alert('$message');</script>";
            break;
    }
}

?>

<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<form action="../handlers/processHighlights.php" method="post">
    <datalist id="products_list">
        <?php foreach ($products as $product) { ?>
            <option value="<?php echo $product['name'] ?>"></option>
        <?php } ?>
    </datalist>

    <main class="main-content">
        <div class="header">
            <div class="left">
                <h1>Highlighed Products</h1>
            </div>
        </div>

        <ul class="insights">
            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            star
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            if (!empty($highlights)) {
                                echo $highlights[$count - 1]['name'];
                            }
                            ?>
                        </h3>
                        <p>
                            <input list="products_list" name="products[0]" value="<?php
                            if (!empty($highlights)) {
                                echo $highlights[$count - 1]['name'];
                            }
                            ?>">
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            star
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            if (!empty($highlights)) {
                                echo $highlights[$count - 2]['name'];
                            }
                            ?>
                        </h3>
                        <p>
                            <input list="products_list" name="products[1]" value="<?php
                            if (!empty($highlights)) {
                                echo $highlights[$count - 2]['name'];
                            }
                            ?>">
                        </p>
                    </span>
                </li>
            </a>

            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            star
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <?php
                            if (!empty($highlights)) {
                                echo $highlights[$count - 3]['name'];
                            }
                            ?>
                        </h3>
                        <p>
                            <input list="products_list" name="products[2]" value="<?php
                            if (!empty($highlights)) {
                                echo $highlights[$count - 3]['name'];
                            }
                            ?>">
                        </p>
                    </span>
                </li>
            </a>

            <!-- Save button -->
            <a>
                <li>
                    <i class='bx bx-dollar-circle'>
                        <span class="material-symbols-outlined">
                            done_all
                        </span>
                    </i>
                    <span class="info">
                        <h3>
                            <button type="submit" name="submit_highlights" value="true">Save</button>
                        </h3>
                        <p>
                            <!-- Highlights -->
                        </p>
                    </span>
                </li>
            </a>
        </ul>
    </main>
</form>



</body>

</html>