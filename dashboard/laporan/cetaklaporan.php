<?php
session_start();
require_once("../../setting/koneksi.php");
require('../../FPDF/fpdf.php');
date_default_timezone_set('Asia/Jakarta');

$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];

$querydata = $conn->prepare("SELECT pembayaran.*, tagihan.* FROM pembayaran, tagihan WHERE pembayaran.idtagihan=tagihan.idtagihan AND pembayaran.tanggal>='$tgl1' AND pembayaran.tanggal<='$tgl2'");
$querydata->execute();
$data = $querydata->fetch(PDO::FETCH_ASSOC);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->Image('../../images/logo.png',25,8,20);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(190,9,'Laporan Data Pegawai',0,0,'C');
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

$pdf->SetX(10);
$pdf->Cell(30, 8, 'Dari Tanggal', 0, 0, 'L', 0);
$pdf->SetX(40);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(50);
$pdf->Cell(85, 8, $tgl1, 0, 0, 'L', 0);
$pdf->SetX(125);
$pdf->Cell(30, 8, 'Sampai Tanggal', 0, 0, 'L', 0);
$pdf->SetX(155);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(165);
$pdf->Cell(85, 8, $tgl2, 0, 0, 'L', 0);
$pdf->Ln(5);
$pdf->SetX(10);
$pdf->Cell(30, 8, 'Nama Pegawai', 0, 0, 'L', 0);
$pdf->SetX(40);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(50);
$pdf->Cell(85, 8, $_SESSION['nm_user'], 0, 0, 'L', 0);
$pdf->SetX(125);
$pdf->Cell(30, 8, 'Waktu Print', 0, 0, 'L', 0);
$pdf->SetX(155);
$pdf->Cell(30, 8, ':', 0, 0, 'L', 0);
$pdf->SetX(165);
$pdf->Cell(85, 8, $waktu, 0, 0, 'L', 0);
$pdf->Ln(10);

$pdf->SetX(10);
$pdf->Cell(8,8,'No',1,0,'C',1);
$pdf->SetX(18);
$pdf->Cell(50,8,'ID Pembayaran',1,0,'C',1);
$pdf->SetX(68);
$pdf->Cell(35,8,'Tanggal',1,0,'C',1);
$pdf->SetX(103);
$pdf->Cell(35,8,'Total Meter',1,0,'C',1);
$pdf->SetX(138);
$pdf->Cell(35,8,'Total Bayar',1,0,'C',1);
$pdf->SetX(173);
$pdf->Cell(27,8,'Biaya Admin',1,0,'C',1);
$pdf->Ln(8);
$pdf->SetFont('Arial','',10);
$no=1;
$total="0";
$admin="0";
do{
$totalbayar="Rp ".number_format($data['totalbayar'], "2", ",", ".");
$biayaadmin="Rp ".number_format($data['biayaadmin'], "2", ",", ".");
$total=$total+$data['totalbayar'];
$total1="Rp ".number_format($total, "2", ",", ".");
$admin=$admin+$data['biayaadmin'];
$admin1="Rp ".number_format($admin, "2", ",", ".");

$totalsetor=$total+$admin;
$totalsetor1="Rp ".number_format($totalsetor, "2", ",", ".");


$tanggal=$data['tanggal'];
$tgl=substr($tanggal,8,2);
$bln=substr($tanggal,5,2);
$thn=substr($tanggal,0,4);
if  ($bln=="01"){
	$fixtgl=$tgl." Januari ".$thn;
}elseif ($bln=="02") {
	$fixtgl=$tgl." Februari ".$thn;
}elseif ($bln=="03") {
	$fixtgl=$tgl." Maret ".$thn;
}elseif ($bln=="04") {
	$fixtgl=$tgl." April ".$thn;
}elseif ($bln=="05") {
	$fixtgl=$tgl." Mei ".$thn;
}elseif ($bln=="06") {
	$fixtgl=$tgl." Juni ".$thn;
}elseif ($bln=="07") {
	$fixtgl=$tgl." Juli ".$thn;
}elseif ($bln=="08") {
	$fixtgl=$tgl." Agustus ".$thn;
}elseif ($bln=="09") {
	$fixtgl=$tgl." September ".$thn;
}elseif ($bln=="10") {
	$fixtgl=$tgl." Oktober ".$thn;
}elseif ($bln=="11") {
	$fixtgl=$tgl." Nopember ".$thn;
}elseif ($bln=="12") {
	$fixtgl=$tgl." Desember ".$thn;
}else{
	$fixtgl=$tgl." ".$bln." ".$thn;
}

$pdf->SetX(10);
$pdf->Cell(8,8,$no.".",1,0,'C',0);
$pdf->SetX(18);
$pdf->Cell(50,8,$data['idbayar'],1,0,'L',0);
$pdf->SetX(68);
$pdf->Cell(35,8,$fixtgl,1,0,'L',0);
$pdf->SetX(103);
$pdf->Cell(35,8,$data['jumlahmeter'],1,0,'L',0);
$pdf->SetX(138);
$pdf->Cell(35,8,$totalbayar,1,0,'R',0);
$pdf->SetX(173);
$pdf->Cell(27,8,$biayaadmin,1,0,'R',0);
$pdf->Ln(8);
$no++;
}while($data = $querydata->fetch(PDO::FETCH_ASSOC));

$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(128,8,'Total',1,0,'R',0);
$pdf->SetX(138);
$pdf->Cell(35,8,$total1,1,0,'R',0);
$pdf->SetX(173);
$pdf->Cell(27,8,$admin1,1,0,'R',0);
$pdf->Ln(8);
$pdf->SetX(10);
$pdf->Cell(128,8,'Total Setor',1,0,'R',0);
$pdf->SetX(138);
$pdf->Cell(62,8,$totalsetor1,1,0,'C',0);


$pdf->Output();
//"data_siswa".".pdf",'D'
?>