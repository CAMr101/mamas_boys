<?php
session_start();

include("../handlers/processStaff.php");

if (!isset($_SESSION["user_id"])) {
    header("location:login.php?login=login");
}
$user = getStaffById($_SESSION['user_id']);

if ($user['type'] != 'admin') {
    header('location:../admin/admin.php?error=view');
}
?>


<!-- Linking the static Header Components to Page -->
<?php include '../components/admin-header.php'; ?>
<?php include '../components/admin-navigation.php'; ?>


<!-- main content of the page -->
<main class="main-content">
    <div class="header">
        <div class="left">
            <h1>New Category</h1>
            <ul class="breadcrumb">
                <li><a href="categories.php">
                        Category
                    </a></li>
                /
                <li><a href="new-category.html" class="active">New</a></li>
            </ul>
        </div>
    </div>

    <div class="bottom-data">
        <div class="orders">

            <form action="../handlers/processNewCategory.php" method="post" enctype="multipart/form-data"
                id="new-category">
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value=""> -->
                <table>

                    <tbody>
                        <tr>
                            <td>
                                <label for="name">Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" class="form-control" placeholder="Category">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="description">Description</label>
                            </td>
                            <td>
                                <textarea name="description" class="form-control" id="description" cols="60" rows="5"
                                    form="new-category"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="image">Image</label>
                            </td>
                            <td>
                                <input type="file" class="form-label" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <button class="btn btn-primary" >Create Category</button>
            </form>


        </div>

    </div>

</main>



</body>

</html>