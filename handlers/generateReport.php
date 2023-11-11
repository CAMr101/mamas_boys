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
