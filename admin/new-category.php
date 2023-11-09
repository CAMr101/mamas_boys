<?php
include '../components/admin-header.php';
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
            <h1>New Category</h1>
            <ul class="breadcrumb">
                <li><a href="shop.php">
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
                                <input type="text" name="name">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="description">Description</label>
                            </td>
                            <td>
                                <textarea name="description" id="description" cols="60" rows="5"
                                    form="new-category"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="image">Image</label>
                            </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">

                            </td>
                        </tr>
                    </tbody>
                </table>

                <button>Create Category</button>
            </form>


        </div>

    </div>

</main>



</body>

</html>