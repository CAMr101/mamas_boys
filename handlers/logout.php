<?php

session_start();
session_unset();
session_destroy();

if (isset($_REQUEST['logout']) && $_GET['logout'] == 1) {
    header("location:../index.php?logout=true");
    die();
}

header("location:../admin/login.php");
die();