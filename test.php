<?php

$zpl = "^xa^cfa,50^fo100,100^fdHello World^fs^xz";

$curl = curl_init();
// adjust print density (8dpmm), label width (4 inches), label height (6 inches), and label index (0) as necessary
curl_setopt($curl, CURLOPT_URL, "http://api.labelary.com/v1/printers/8dpmm/labels/4x6/0/");
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $zpl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/pdf")); // omit this line to get PNG images back
$result = curl_exec($curl);

//echo $result;

if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {

    echo $result;

    // require("fpdf/fpdf.php");

    // $pdf = new FPDF();
    // $pdf->AddPage();
    // $pdf->SetFont('Arial','B',16);
    // $pdf->Cell(40,10,$result);
    // $pdf->Output();

    $file = fopen("label.pdf", "w"); // change file name for PNG images
    fwrite($file, $result);
    fclose($file);
} else {
    print_r("Error: $result");
}

curl_close($curl);

?>