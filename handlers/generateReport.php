<?php
require "../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_REQUEST['id'])) {
    $methodId = $_GET['id'];
    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf([$options]);
    $dompdf->setPaper("A4", "Portrait");

    switch ($methodId) {
        case 0:
            salesReport();
            break;
        case 1:
            productReport();
            break;
        case 2:
            orderReport();
            break;

        default:
            header("location:../admin/order-report.php");
            break;
    }

    $dompdf->loadHtml("Hellow World");
    $dompdf->render();
    $dompdf->addInfo("Title", "New Title");
    $dompdf->addInfo("Creator", "Mamas Boys Kota & Chips");
    $dompdf->addInfo("Author", "Mamas Boys Kota & Chips");
    $dompdf->addInfo("Subject", "This is the Subject    ");
    $dompdf->stream("filename.pdf", ['Attachment' => 0]);

} else {
    header("location:../admin/reports.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];

    print_r($startDate);

    include "../config/dbh.inc.php";

    try {

        $query = "SELECT * FROM category";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $pdo = null;
        $stmt = null;

        return $result;

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
