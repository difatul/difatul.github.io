<?php
session_start();
require_once("../../setting/koneksi.php");
require('../../FPDF/fpdf.php');
date_default_timezone_set('Asia/Jakarta');
$querydata = $conn->prepare("SELECT pelanggan.*, tarif.* FROM pelanggan, tarif WHERE pelanggan.idtarif=tarif.idtarif ORDER BY pelanggan.nm_pel ASC");
$querydata->execute();
$data = $querydata->fetch(PDO::FETCH_ASSOC);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->Image('../../images/logo.png',25,8,20);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(190,9,'Laporan Data Pelanggan',0,0,'C');
$pdf->Ln(6);
$pdf->Cell(190,9,'Payment Point Online Bank Surya Mandiri',0,0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(6);
$pdf->Cell(190,9,'Sekretariat : Jl. Gunung Anyar Lor Kencana III B/19 Surabaya',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(190,0.1,'',1,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Ln(20);
$Y_Fields_Name_position = 27;

$pdf->SetFillColor(210,221,242);

$pdf->SetY($Y_Fields_Name_position);
$pdf->Ln(10);
$waktu=date("d-m-Y H:i:s");
$tgl=date("d-m-Y");
$pdf->SetX(10);
$pdf->Cell(100,8,'Nama Administrator : '.$_SESSION['nm_user'],0,0,'L',0);
$pdf->Cell(90,8,'Waktu Print : '.$waktu,0,0,'R',0);
$pdf->Ln(10);

$pdf->SetX(10);
$pdf->Cell(8,8,'No',1,0,'C',1);
$pdf->SetX(18);
$pdf->Cell(65,8,'Nama Pelanggan',1,0,'C',1);
$pdf->SetX(83);
$pdf->Cell(32,8,'ID Pelanggan',1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(30,8,'Nomor Meter',1,0,'C',1);
$pdf->SetX(145);
$pdf->Cell(30,8,'Daya',1,0,'C',1);
$pdf->SetX(175);
$pdf->Cell(25,8,'Status',1,0,'C',1);
$pdf->Ln(8);
$pdf->SetFont('Arial','',10);
$no=1;
do{
$pdf->SetX(10);
$pdf->Cell(8,8,$no.".",1,0,'C',0);
$pdf->SetX(18);
$pdf->Cell(65,8,$data['nm_pel'],1,0,'L',0);
$pdf->SetX(83);
$pdf->Cell(32,8,$data['idpel'],1,0,'L',0);
$pdf->SetX(115);
$pdf->Cell(30,8,$data['nometer'],1,0,'L',0);
$pdf->SetX(145);
$pdf->Cell(30,8,$data['daya']." VA",1,0,'L',0);
$pdf->SetX(175);
$pdf->Cell(25,8,$data['status'],1,0,'L',0);
$pdf->Ln(8);
$no++;
}while($data = $querydata->fetch(PDO::FETCH_ASSOC));

$pdf->Output();
?>