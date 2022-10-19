<?php
require_once('../setting/koneksi.php');
date_default_timezone_set('Asia/Jakarta');
//input transaksi
if(isset($_POST['tambah'])){
	$idtagihan=$_POST['idtagihan'];
	//id bayar
	$hrf="TR";
	$nol="00";
	$idbayar=$hrf.$nol.date('his');
	//tanggal
	$tanggal=date('Y-m-d');
	$bulan=date("M");
	//kalkulasi pembayaran
	$bayar= str_replace(".", "", $_POST['bayar']);
	//kembali
	$kembali=$bayar-$_POST['totalbayar'];

	//input pembayaran
	$query=$conn->prepare("INSERT INTO pembayaran(idbayar, idpel, idtagihan, tanggal, biayaadmin, totalpenggunaan, bayar, kembali, iduser, totalbayar, bulanbayar) value (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$query->bindParam(1, $idbayar, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(2, $_POST['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(3, $idtagihan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(4, $tanggal, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(5, $_POST['biayaadmin'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(6, $_POST['totalpenggunaan'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(7, $bayar, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(8, $kembali, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(9, $_SESSION['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(10, $_POST['totalbayar'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(11, $bulan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->execute();

	//update status tagihan
	$status="Terbayar";
	$query2=$conn->prepare("UPDATE tagihan SET status=? WHERE idtagihan=?");
	$query2->bindParam(1, $status, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->bindParam(2, $idtagihan, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query2->execute();

	if($query2){ ?>
		<script language="javascript">
			location.href="?mod=tagihan/detail&idpel=<?php echo $_POST['idpel'];?>&kembali=<?php echo $kembali;?>&idbayar=<?php echo $idbayar;?>"
		</script> <?php
	}
}
//akhir tambah meter awal

//cari idpel
if(isset($_POST['idpel'])){
  $idpel=$_POST['idpel'];

  try{
    $login=$conn->prepare("SELECT * FROM pelanggan WHERE idpel=?");
    $login->bindParam(1, $idpel, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $login->execute();
    $datalogin=$login->fetch(PDO::FETCH_ASSOC);
    
    if($datalogin['idpel']==$idpel){
      ?>

      <script language="javascript">
        location.href="?mod=tagihan/detail&idpel=<?php echo $datalogin['idpel']; ?>";
      </script>
      <?php
    }
    else{  ?>
      <script language="javascript">
        window.alert("Maaf, Id yang anda masukkan tidak terdaftar");
        location.href="?mod=transaksi/cari";
      </script><?php
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
}
//akhir cari id cs
?>