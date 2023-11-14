<!-- Top nav -->

<!-- <nav class="top-nav">
    <a href="#" class="notif">
        <i class='bx bx-bell'></i>
        <span class="count">0</span>
    </a>
    <a href="#" class="profile">
        <?php
        // echo $_SESSION["user_name"];
        ?>
    </a>
</nav> -->

<nav class="top-nav">
    <span class="material-symbols-outlined">
        account_circle
    </span>
    <?php
    echo ucfirst($_SESSION["user_name"]);
    ?>
</nav>