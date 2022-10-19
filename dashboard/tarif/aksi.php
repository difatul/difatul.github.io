<?php
//tambah tarif
if(isset($_POST['tambah'])){
  $query1 = $conn->prepare("SELECT MAX(idtarif) AS idtarif FROM tarif");
  $query1->execute();
  $data1 = $query1->fetch(PDO::FETCH_ASSOC);

  if($data1==NULL){
    $idtarif="001";
  }else{
    $id= substr($data1['idtarif'], 0);
    $id1=$id+1;
    $id2= sprintf("%03d", $id1);
    $idtarif=$id2;
  }

  $tarif= str_replace(".", "", $_POST['tarif']);
  $denda= str_replace(".", "", $_POST['denda']);

  $query2 = $conn->prepare("INSERT INTO tarif (idtarif, daya, tarifperkwh, denda) value (?, ?, ?, ?)");
  $query2->bindParam(1, $idtarif, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query2->bindParam(2, $_POST['daya'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query2->bindParam(3, $tarif, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query2->bindParam(4, $denda, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query2->execute();

  if($query2){?>
  <script language="javascript">
   location.href="?mod=tarif/data";
  </script>
  <?php
  }
}
//akhir tambah tarif
//hapus tarif
if(isset($_GET['del'])){
  $query=$conn->prepare("DELETE FROM tarif WHERE idtarif=?");
  $query->bindParam(1, $_GET['idtarif'], PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->execute();

  if($query){?>
    <script language="javascript">
      window.alert("Data Telah Terhapus");
      location.href="?mod=tarif/data";
    </script> <?php
  }
}
//akhir hapus tarif
//edit tarif
if(isset($_POST['edit'])){
  $harga=str_replace(".", "", $_POST['tarifperkwh']);
  $denda=str_replace(".", "", $_POST['denda']);
  $query=$conn->prepare("UPDATE tarif SET idtarif=?, daya=?, tarifperkwh=?, denda=? WHERE idtarif=?");
  $query->bindParam(1, $_POST['idtarif'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->bindParam(2, $_POST['daya'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->bindParam(3, $harga, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->bindParam(4, $denda, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->bindParam(5, $_POST['idtarif'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->execute();

  if($query){?>
    <script language="javascript">
      window.alert("Data Berhasil Diedit");
      location.href="?mod=tarif/data";
    </script> <?php
  }
}
//akhir edit tarif
?>