<?php
session_start();
require_once("../../setting/koneksi.php");
require('../../FPDF/code128.php');

date_default_timezone_set('Asia/Jakarta');

$query = $conn->prepare("SELECT pelanggan.*, tarif.* FROM pelanggan, tarif WHERE pelanggan.idtarif=tarif.idtarif AND pelanggan.idpel=?");
$query->bindParam(1, $_POST['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
$query->execute();
$data = $query->fetch(PDO::FETCH_ASSOC);

$pdf=new PDF_Code128('P','mm', 'A4');
$pdf->AddPage();
$pdf->Image('../../images/logo.png',25,8,20);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(190,9,'KARTU PELANGGAN',0,0,'C');
$pdf->Ln(6);
$pdf->Cell(190,9,'Payment Point Online Bank Surya Mandiri',0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(6);
$pdf->Cell(190,9,'Sekretariat : Jl. Gunung Anyar Lor Kencana III B/19 Surabaya',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(190,0.1,'',1,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(30, 8, 'Nama', 0, 0, 'L', 0);
$pdf->SetX(40);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(50);
$pdf->Cell(85, 8, $data['nm_pel'], 0, 0, 'L', 0);
$pdf->Ln(8);
$pdf->SetX(10);
$pdf->Cell(30, 8, 'Daya', 0, 0, 'L', 0);
$pdf->SetX(40);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(50);
$pdf->Cell(85, 8, $data['daya']." Watt", 0, 0, 'L', 0);
$pdf->Ln(8);
$pdf->SetX(10);
$pdf->Cell(30, 8, 'No Meter', 0, 0, 'L', 0);
$pdf->SetX(40);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(50);
$pdf->Cell(85, 8, $data['nometer'], 0, 0, 'L', 0);
$pdf->Ln(8);
$pdf->SetX(10);
$pdf->Cell(30, 8, 'Alamat', 0, 0, 'L', 0);
$pdf->SetX(40);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(50);
$pdf->Cell(85, 8, $data['almt_pel'], 0, 0, 'L', 0);
$pdf->Ln(8);

$buku =  array();
$buku[] = array("idpel" => $data['idpel']);

$y = 50;
foreach($buku as $a) {
    for ($i=1; $i <=1 ; $i++) { 
    $pdf->Code128(150,$y,$a["idpel"],35,10);
    $pdf->SetXY(153,$y+15);
    $pdf->Write(0,$a["idpel"]);
    $pdf->Ln(3);
    $y+=24;
	}
}

$pdf->Output();
?>