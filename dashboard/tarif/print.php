<?php
session_start();
require_once("../../setting/koneksi.php");
require('../../FPDF/fpdf.php');
date_default_timezone_set('Asia/Jakarta');
$querydata = $conn->prepare("SELECT tarif.* FROM tarif");
$querydata->execute();
$data = $querydata->fetch(PDO::FETCH_ASSOC);
$harga="Rp ".number_format($data['tarifperkwh'], "2", ",", ".");
$denda="Rp ".number_format($data['denda'], "2", ",", ".");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->Image('../../images/logo.png',25,8,20);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(190,9,'Laporan Data Tarif',0,0,'C');
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
$pdf->Cell(37,8,'ID Tarif',1,0,'C',1);
$pdf->SetX(55);
$pdf->Cell(30,8,'Daya',1,0,'C',1);
$pdf->SetX(85);
$pdf->Cell(40,8,'Tarif/Kwh',1,0,'C',1);
$pdf->SetX(125);
$pdf->Cell(40,8,'Denda',1,0,'C',1);
$pdf->SetX(165);
$pdf->Cell(35,8,'Pengguna',1,0,'C',1);
$pdf->Ln(8);
$pdf->SetFont('Arial','',10);
$no=1;
do{
$harga="Rp ".number_format($data['tarifperkwh'], "2", ",", ".");
$denda="Rp ".number_format($data['denda'], "2", ",", ".");
$pdf->SetX(10);
$pdf->Cell(8,8,$no.".",1,0,'C',0);
$pdf->SetX(18);
$pdf->Cell(37,8,$data['idtarif'],1,0,'L',0);
$pdf->SetX(55);
$pdf->Cell(30,8,$data['daya']." VA",1,0,'L',0);
$pdf->SetX(85);
$pdf->Cell(40,8,$harga,1,0,'R',0);
$pdf->SetX(125);
$pdf->Cell(40,8,$denda,1,0,'R',0);
$pelanggan = $conn->prepare("SELECT count(*), tarif.daya FROM pelanggan, tarif WHERE pelanggan.idtarif=tarif.idtarif AND tarif.idtarif='$data[idtarif]'");
$pelanggan->execute();
$pel = $pelanggan->fetch(PDO::FETCH_NUM);
$pelanggan1=$pel[0];

$pdf->SetX(165);
$pdf->Cell(35,8,$pelanggan1." Pengguna",1,0,'L',0);
$pdf->Ln(8);
$no++;
}while($data = $querydata->fetch(PDO::FETCH_ASSOC));

$pdf->Output();
//"data_siswa".".pdf",'D'
?>