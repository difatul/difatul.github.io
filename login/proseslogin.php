<?php
session_start();
require_once('../setting/koneksi.php');
?>
<?php
date_default_timezone_set('Asia/Jakarta');
?>
<?php
$waktu=date("Y-m-d H:i:s");

if (isset($_POST['user'])){
  $user=$_POST['username'];
  $pass=$_POST['password'];
  try{
    $login = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?"); 
    $login->bindParam(1, $user, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $login->bindParam(2, $pass, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $login->execute();
    $datalogin = $login->fetch(PDO::FETCH_ASSOC);

    if(($datalogin['username']==$user) && ($datalogin['password']==$pass)){
      if($datalogin['status']=="Aktif"){

        $query = $conn->prepare("UPDATE user SET akses=? WHERE username=?");
        $query->bindParam(1, $waktu, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
        $query->bindParam(2, $datalogin['username'], PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
        $query->execute();

        $_SESSION['iduser'] = $datalogin['iduser'];
        $_SESSION['username'] = $datalogin['username'];
        $_SESSION['password'] = $datalogin['password'];
        $_SESSION['nm_user'] = $datalogin['nm_user'];
        $_SESSION['tlp_user'] = $datalogin['foto'];
        $_SESSION['alamat'] = $datalogin['alamat'];
        $_SESSION['level'] = $datalogin['level'];
        $_SESSION['status'] = $datalogin['status'];
        $_SESSION['akses'] = $datalogin['akses'];
        $_SESSION['foto'] = $datalogin['foto']; ?>
          
        <script language="javascript">
          location.href="../dashboard";
        </script> <?php
      }
      else{ ?>
        <script language="javascript">
          window.alert("Maaf, hak akses anda diblokir. Silahkan hubungi administrator untuk mengaktifkan kembali");
          location.href="../user";
        </script> <?php
      }
    }
    else{ ?>
      <script language="javascript">
        window.alert("Maaf, Username dan Password anda tidak terdaftar");
        location.href="../user";
      </script> <?php
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
}

if (isset($_POST['customer'])){
  $id=$_POST['idpel'];
  try{
    $login = $conn->prepare("SELECT * FROM pelanggan WHERE idpel=?"); 
    $login->bindParam(1, $_POST['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $login->execute();
    $datalogin = $login->fetch(PDO::FETCH_ASSOC);

    if($datalogin['idpel']==$id){

      $_SESSION['nm_pel'] = $datalogin['nm_pel'];
      $_SESSION['idpel'] = $datalogin['idpel'];

      if($datalogin['idpel']==$id){ ?>
        <script language="javascript">
          location.href="../PL";
        </script> <?php
      }
      else{ ?>
        <script language="javascript">
          window.alert("Maaf, Hak akses anda tidak diperbolehkan masuk area ini");
          location.href="../";
        </script> <?php
      }
    }
    else{ ?>
      <script language="javascript">
        window.alert("Maaf, Nama dan Password anda tidak terdaftar");
        location.href="../";
      </script> <?php
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
}

else{ ?>
  <script language="javascript">
    window.alert("Maaf, Coba ulangi beberapa saat lagi");
    location.href="../";
  </script> <?php
}
?>