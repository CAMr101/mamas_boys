<?php
function createHeader()
{
    return `
    <div class="side-nav">
    <a href="admin.html" class="logo">
        <img src="../assets/images/logo.png" alt="Mama's Boy's Logo">
    </a>
    <ul class="side-menu">
        <li class="side-menu-item">
            <a href="../admin.html">Dashboard</a>
        </li>
        <li class="side-menu-item">
            <a href="orders.html">Orders</a>
        </li>
        <li class="side-menu-item">
            <a href="shop.html">Shop</a>
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
    
    `;
}

?>