<?php
require_once('../setting/koneksi.php');
date_default_timezone_set('Asia/Jakarta');
//tambah meter awal
if(isset($_POST['tambah'])){
  if($_POST['meterakhir']<=$_POST['meterawal']){ ?>
  	<script language="javascript">
    	window.alert("Maaf, meterakhir kurang dari meterawal");
    	location.href="?mod=penggunaan/tambah&idpenggunaan=<?php echo $_POST['idpenggunaan'];?>";
  	</script><?php
  }else{
  	$idpenggunaan=$_POST['idpenggunaan'];
	//idplg
	$idpel=$_POST['idpel'];
	//id penggunaan
	$hrf="PNG";
	$nol="00";
	$idpenggunaan=$hrf.$nol.date('his');
	//bulan di penggunaan
	$bulan=$_POST['bulan'];
	$tahun=$_POST['tahun'];
	$tanggal=$tahun."-".$bulan."-28";
	$tambahtanggal= date('Y-M-d', strtotime('+1 month', strtotime($tanggal)));
	$bulanbaru=substr($tambahtanggal, 5, 3);
	$tahunbaru=substr($tambahtanggal, 0, 4);
	//idtagihan
	$a="TGH";
	$nol="00";
	$idtagihan=$a.$nol.date('his');
	//hitung jumlah meter
	$meterawal=$_POST['meterawal'];
	$meterakhir=$_POST['meterakhir'];
	$jumlahmeter=$meterakhir-$meterawal;
	//status
	$status="Belum Terbayar";

	//mengisi meterakhir di penggunaan
    $query=$conn->prepare("UPDATE penggunaan SET meterakhir=? WHERE idpenggunaan=?");
	$query->bindParam(1, $_POST['meterakhir'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(2, $_POST['idpenggunaan'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->execute();

	//tambah tagihan dan transaksi
	$query2=$conn->prepare("INSERT INTO tagihan(idtagihan, idpel, bulan, tahun, jumlahmeter, status, idpenggunaan) value (?, ?, ?, ?, ?, ?, ?)");
	$query2->bindParam(1, $idtagihan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(2, $idpel, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(3, $_POST['bulan'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(4, $_POST['tahun'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(5, $jumlahmeter, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(6, $status, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(7, $idpenggunaan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->execute();

	//tambah penggunaan baru untuk bulan berikutnya
	$query3=$conn->prepare("INSERT INTO penggunaan(idpenggunaan, idpel, bulan, tahun, meterawal) value (?, ?, ?, ?, ?)");
	$query3->bindParam(1, $idpenggunaan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(2, $idpel, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(3, $bulanbaru, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(4, $tahunbaru, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(5, $_POST['meterakhir'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->execute();

	if($query3){ ?>
		<script language="javascript">
			location.href="?mod=penggunaan/data"
		</script> <?php
	}
  }
}
//akhir tambah meter awal
?>