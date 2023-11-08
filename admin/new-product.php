<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.new.css">
</head>

<body>

    <!-- Side Nav -->
    <div class="side-nav">
        <a href="admin.html" class="logo">
            <img src="../assets/images/logo.png" alt="Mama's Boy's Logo">
        </a>
        <ul class="side-menu">
            <li class="side-menu-item">
                <a href="../admin.php">Dashboard</a>
            </li>
            <li class="side-menu-item">
                <a href="orders.php">Orders</a>
            </li>
            <li class="side-menu-item">
                <a href="shop.php">Shop</a>
            </li>
            <!-- <li class="side-menu-item">
                <a href="/admin/staff.html">Staff</a>
            </li> -->
        </ul>
        <ul class="side-menu">
            <li class="side-menu-item">
                <a href="">Logout</a>
            </li>
        </ul>
    </div>


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