<?php
require_once('../setting/koneksi.php');
date_default_timezone_set('Asia/Jakarta');
//input pelanggan
if(isset($_POST['tambah'])){
	$huruf="PLG";
	$nol="00";
	$idpel=$huruf.$nol.date('his');
	$tgldaftar=date("d-M-Y");
	$hrf="PNG";
	$nol="00";
	$idpenggunaan=$hrf.$nol.date('his');
	$bulan=date("M");
	$tahun=date("Y");
	$meterawal="0";

	$query1=$conn->prepare("INSERT INTO pelanggan(idpel, nometer, nm_pel, almt_pel, idtarif, tgldaftar) value (?, ?, ?, ?, ?, ?)");
	$query1->bindParam(1, $idpel, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query1->bindParam(2, $_POST['nometer'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query1->bindParam(3, $_POST['nm_pel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query1->bindParam(4, $_POST['almt_pel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query1->bindParam(5, $_POST['idtarif'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query1->bindParam(6, $tgldaftar, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query1->execute();

	$query3=$conn->prepare("INSERT INTO penggunaan(idpenggunaan, idpel, bulan, tahun, meterawal) value (?, ?, ?, ?, ?)");
	$query3->bindParam(1, $idpenggunaan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(2, $idpel, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(3, $bulan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(4, $tahun, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->bindParam(5, $meterawal, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query3->execute();

	if($query3){ ?>
		<script type="text/javascript">
			location.href="?mod=pelanggan/detail&idpel=<?php echo $idpel; ?>";
		</script> <?php
	}
}
//akhir input pelanggan
//hapus pelanggan
if(isset($_GET['del'])){
	$query=$conn->prepare("DELETE FROM pelanggan WHERE idpel=?");
	$query->bindParam(1, $_GET['idpel'], PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->execute();

	if($query){?>
		<script language="javascript">
			window.alert("Data Telah Terhapus");
			location.href="?mod=pelanggan/data";
		</script> <?php
	}
}
//akhir hapus pelanggan
//edit data pelanggan
if(isset($_POST['edit'])){
    $query=$conn->prepare("UPDATE pelanggan SET idpel=?, nometer=?, nm_pel=?, almt_pel=?, idtarif=? WHERE idpel=?");
	$query->bindParam(1, $_POST['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(2, $_POST['nometer'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(3, $_POST['nm_pel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(4, $_POST['almt_pel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(5, $_POST['idtarif'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(6, $_POST['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->execute();

	if($query){ ?>
		<script language="javascript">
			location.href="?mod=pelanggan/detail&idpel=<?php echo $_POST['idpel'];?>"
		</script> <?php
	}
}
//akhir edit data pelanggan
//aktif
if(isset($_GET['aktif'])) {
	
	if($_GET['aktif']=='n'){
		$aktif="Tidak Aktif";
	}else{
		$aktif="Aktif";
	}
	
	$query = $conn->prepare("UPDATE pelanggan SET status=? WHERE idpel=?");
    $query->bindParam(1, $aktif, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query->bindParam(2, $_GET['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query->execute();
	
	if($query){
		?><script language="javascript">
	        history.go(-1)
	    </script><?php
	}
}
//akhir aktif
?>