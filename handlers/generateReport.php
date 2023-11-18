<?php

if (isset($_POST)) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    header("location:../admin/reports.php?start=$start_date&end=$end_date");
    exit();

} else {
    header("location:../admin/reports.php?error=error");
}