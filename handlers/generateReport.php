<?php

require "../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options;
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf([$options]);

$dompdf->setPaper("A4", "Portrait");
$dompdf->loadHtml("Hellow World");
$dompdf->render();
$dompdf->addInfo("Title", "New Title");
$dompdf->addInfo("Creator", "Mamas Boys Kota & Chips");
$dompdf->addInfo("Author", "Mamas Boys Kota & Chips");
$dompdf->addInfo("Subject", "This is the Subject    ");
$dompdf->stream("filename.pdf", ['Attachment' => 0]);