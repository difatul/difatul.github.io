<?php

require_once('../setting/koneksi.php');

date_default_timezone_set('Asia/Jakarta');

//tambah user
if(isset($_POST['tambah'])){
	$query2 = $conn->prepare("SELECT * FROM user WHERE username=?");
    $query2->bindParam(1, $_POST['username'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query2->execute();
    $data2 = $query2->fetch(PDO::FETCH_ASSOC);

    if($data2['username']!=""){
      ?><script language="javascript">
      window.alert("Maaf Username Sudah Dipakai");
            location.href="?mod=user/data";
        </script><?php
    }else{
    	$query4 = $conn->prepare("SELECT MAX(iduser) AS iduser FROM user");
  		$query4->execute();
  		$data4 = $query4->fetch(PDO::FETCH_ASSOC);
  
  		if($data4==NULL){
   			$iduser="PG001";
  		}else{
  			$id= substr($data4['iduser'], 2);
  			$id1=$id+1;
  			$id2= sprintf("%03d", $id1);
  			$iduser="PG".$id2;
  		}

		$query1=$conn->prepare("INSERT INTO user(username, password, level, status, nm_user, tlp_user, alamat, iduser) value (?, ?, ?, ?, ?, ?, ?, ?)");
		$query1->bindParam(1, $_POST['username'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(2, $_POST['password'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(3, $_POST['level'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(4, $_POST['status'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(5, $_POST['nm_user'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(6, $_POST['tlp_user'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(7, $_POST['alamat'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->bindParam(8, $iduser, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query1->execute();

		$newname=$iduser.".png";
    	$lokasi_file = $_FILES['foto']['tmp_name'];
    	$nama_file   = $_FILES['foto']['name'];
    	$direktori   = "../images/$nama_file";
  		if(strlen($nama_file)>0){
    		if(!empty($lokasi_file)){
      		move_uploaded_file($lokasi_file,$direktori);
      		rename("../images/$nama_file", "../images/$newname");
      
      		$query3 = $conn->prepare("UPDATE user SET foto=? WHERE iduser=?");
      		$query3->bindParam(1, $newname, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
      		$query3->bindParam(2, $iduser, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
      		$query3->execute();
    		}
    	}

		if($query1){ ?>
			<script type="text/javascript">
				location.href="?mod=user/detail&iduser=<?php echo $iduser?>";
			</script> <?php
		}
	}
}
//akhir input user

//edit foto
if(isset($_POST['edit_foto'])){
	$lokasi_file = $_FILES['picture']['tmp_name'];
	$tipe_file   = $_FILES['picture']['type'];
	$nama_file   = $_FILES['picture']['name'];
	$direktori   = "../images/$nama_file";
	if(!empty($lokasi_file)){
		move_uploaded_file($lokasi_file, $direktori);
	}

	$query=$conn->prepare("UPDATE user SET foto=? WHERE iduser=?");
	$query->bindParam(1, $nama_file, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->bindParam(2, $_POST['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->execute();

	if($query){ ?>
		<script type="text/javascript">
		  location.href="?mod=user/detail&iduser=<?php echo $_POST['iduser'];?>"
		</script> <?php
	}
}
//akhir edit foto

//edit data user
if(isset($_POST['edit_user'])){
	$iduser=$_POST['iduser'];
	$query2 = $conn->prepare("SELECT * FROM user WHERE username=? AND iduser!=?");
    $query2->bindParam(1, $_POST['username'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query2->bindParam(2, $iduser, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query2->execute();
    $data2 = $query2->fetch(PDO::FETCH_ASSOC);

    if($data2['username']!=""){ ?>
    	<script language="javascript">
      		window.alert("Maaf Username Sudah Dipakai");
            location.href="?mod=user/edit&iduser=<?php echo $iduser;?>";
        </script>	<?php
    } else{
    	$query=$conn->prepare("UPDATE user SET username=?, password=?, level=?, status=?, nm_user=?, tlp_user=?, alamat=?, iduser=? WHERE iduser=?");
		$query->bindParam(1, $_POST['username'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(2, $_POST['password'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(3, $_POST['level'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(4, $_POST['status'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(5, $_POST['nm_user'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(6, $_POST['tlp_user'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(7, $_POST['alamat'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(8, $_POST['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->bindParam(9, $_POST['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$query->execute();

		$newname=$iduser.".png";
    	$lokasi_file = $_FILES['foto']['tmp_name'];
    	$nama_file   = $_FILES['foto']['name'];
    	$direktori   = "../images/$nama_file";
  		if(strlen($nama_file)>0){
   			$cekfoto = $conn->prepare("SELECT foto FROM user WHERE iduser=?");
    		$cekfoto->bindParam(1, $iduser, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
        	$cekfoto->execute();
        	$rscekfoto=$cekfoto->fetch(PDO::FETCH_ASSOC);
    
    		$fotolama=$rscekfoto['foto'];
    		if(isset($rscekfoto['foto'])){
      			if (file_exists("../images/$fotolama")) {
        			unlink("../images/".$fotolama);
           		}
        	}
    		if(!empty($lokasi_file)){
      			move_uploaded_file($lokasi_file,$direktori);
      			rename("../images/$nama_file", "../images/$newname");
            
      			$query3 = $conn->prepare("UPDATE user SET foto=? WHERE iduser=?");
            	$query3->bindParam(1, $newname, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            	$query3->bindParam(2, $iduser, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            	$query3->execute();
    		}
    	}

		if($query){ ?>
			<script language="javascript">
				location.href="?mod=user/detail&iduser=<?php echo $iduser;?>"
			</script> <?php
		}
	}
}
//akhir edit data user


//hapus user
if(isset($_GET['del'])){
	$query=$conn->prepare("DELETE FROM user WHERE iduser=?");
	$query->bindParam(1, $_GET['iduser'], PDO::PARAM_INPUT_OUTPUT, 4000);
	$query->execute();

	if($query){?>
		<script language="javascript">
			window.alert("Data Telah Terhapus");
			location.href="?mod=user/data";
		</script> <?php
	}
}
//akhir hapus user

//aktif
if(isset($_GET['aktif'])) {
	
	if($_GET['aktif']=='n'){
		$aktif="Tidak Aktif";
	}else{
		$aktif="Aktif";
	}
	
	$query = $conn->prepare("UPDATE user SET status=? WHERE iduser=?");
    $query->bindParam(1, $aktif, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query->bindParam(2, $_GET['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query->execute();
	
	if($query){
		?><script language="javascript">
	        history.go(-1)
	    </script><?php
	}
}
//akhir aktif
?>