<?php
// jumlah user
$user1 = $conn->prepare("SELECT count(*) FROM user");
$user1->execute();
$user2 = $user1->fetch(PDO::FETCH_NUM);
$user=$user2[0];

$pelanggan1 = $conn->prepare("SELECT count(*) FROM pelanggan");
$pelanggan1->execute();
$pelanggan2 = $pelanggan1->fetch(PDO::FETCH_NUM);
$pelanggan=$pelanggan2[0];

$tarif1 = $conn->prepare("SELECT count(*) FROM tarif");
$tarif1->execute();
$tarif2 = $tarif1->fetch(PDO::FETCH_NUM);
$tarif=$tarif2[0];

$tagihan1 = $conn->prepare("SELECT count(*) FROM tagihan");
$tagihan1->execute();
$tagihan2 = $tagihan1->fetch(PDO::FETCH_NUM);
$tagihan=$tagihan2[0];

$tgl=date("Y-m-d");
$pembayaran1 = $conn->prepare("SELECT count(*) FROM pembayaran WHERE pembayaran.tanggal=?");
$pembayaran1->bindParam(1, $tgl, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
$pembayaran1->execute();
$pembayaran2 = $pembayaran1->fetch(PDO::FETCH_NUM);
$pembayaran=$pembayaran2[0];
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span></button>
        <h4>Hai, <?php echo $_SESSION['nm_user'];?></h4> 
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body">
              <h2 align="center">Selamat Datang di PPOB<br/>
              Surya Mandiri</h2><hr>
              <div class="row">
                <?php if($_SESSION['level']=="Administrator"){ ?>
                <div class="col-lg-4 col-xs-6">
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3><?php echo $user; ?></h3>
                      <p>Pegawai</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-user"></i>
                    </div>
                    <a href="?mod=user/data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
             <div class="inner">
              <h3><?php echo $pelanggan; ?></h3>
              <p>Pelanggan</p>
             </div>
             <div class="icon">
              <i class="fa fa-users"></i>
             </div>
                <a href="?mod=pelanggan/data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
               <h3><?php echo $tarif; ?></h3>
               <p>Tarif</p>
              </div>
              <div class="icon">
               <i class="fa fa-dollar"></i>
              </div>
                <a href="?mod=tarif/data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
        <?php if($_SESSION['level']=="Petugas"){ ?>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
               <h3><?php echo $tagihan; ?></h3>
               <p>Tagihan</p>
              </div>
              <div class="icon">
               <i class="fa fa-bars"></i>
              </div>
                <a href="?mod=tagihan/data" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
               <h3><?php echo $pembayaran; ?></h3>
               <p>Pembayaran Hari Ini</p>
              </div>
              <div class="icon">
               <i class="fa fa-bars"></i>
              </div>
                <a href="?mod=transaksi/hari" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
              <div class="inner">
               <h3>-</h3>
               <p>Transaksi</p>
              </div>
              <div class="icon">
               <i class="fa fa-dollar"></i>
              </div>
                <a href="?mod=transaksi/cari" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>

    </section>
    <!-- /.content -->