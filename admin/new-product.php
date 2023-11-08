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
            <h1>New Category</h1>
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

            <form action="">

            </form>

            <table>

                <tbody>
                    <tr>
                        <td>
                            <label for="">Name</label>
                        </td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Description</label>
                        </td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Price</label>
                        </td>
                        <td>
                            <input type="number">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="">Image</label>
                        </td>
                        <td>
                            <input type="file">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">
                            <button>Create Category</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</main>



</body>

</html>