<?php

require __DIR__ . "../vendor/autoload.php";

use Dompdf\Dompdf;


$dompdf = new Dompdf;

$dompdf->loadHtml("Hellow World");

$dompdf->render();