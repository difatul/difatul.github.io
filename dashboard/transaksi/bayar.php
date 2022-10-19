<?php 
try{
  $query = $conn->prepare("SELECT tagihan.*, pelanggan.*, penggunaan.*, tarif.* FROM tagihan LEFT JOIN pelanggan ON tagihan.idpel=pelanggan.idpel LEFT JOIN penggunaan ON tagihan.idpenggunaan=penggunaan.idpenggunaan LEFT JOIN tarif ON pelanggan.idtarif=tarif.idtarif WHERE tagihan.idtagihan=?");
    $query->bindParam(1, $_GET['idtagihan'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  echo $e->getMessage();
}

$jumlahmeter=$data['jumlahmeter'];
$tarif=$data['tarifperkwh'];
$totalpenggunaan=$jumlahmeter*$tarif;
$biayaadmin="3000";
$totalbayar=$totalpenggunaan+$biayaadmin;

$rpnominal="Rp ".number_format($totalpenggunaan, "2", ",", ".");
$ttbyr="Rp ".number_format($totalbayar, "2", ",", ".");
$adminbank="Rp ".number_format($biayaadmin, "2", ",", ".");
?>
<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="#"><a href="?mod=transaksi/data">Data Tagihan</a></li>
    <li class="active">Pembayaran</li>
  </ol>
</section>
<section class="content">
      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <form class="form-horizontal" method="POST" action="?mod=transaksi/aksi" enctype="multipart/form-data">
              <div class="col-md-6">
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>NOMOR METER</b> <a class="pull-right"><?php echo $data['nometer']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>ID PELANGGAN</b> <a class="pull-right"><?php echo $data['idpel']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>NAMA</b> <a class="pull-right"><?php echo $data['nm_pel']; ?></a>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>DAYA</b> <a class="pull-right"><?php echo $data['daya']." Watt"; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>JUMLAH KWH</b> <a class="pull-right"><?php echo $jumlahmeter; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b> RP NOMINAL</b> <a class="pull-right"><?php echo $rpnominal; ?></a>
                  </li>
                </ul>
              </div>
              <th></th>
              <div class="col-md-12">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>ADMIN BANK</b> <a class="pull-right"><?php echo $adminbank; ?></a>
                </li>
                <li class="list-group-item">
                  <b>TOTAL BIAYA</b> <a class="pull-right"><?php echo $ttbyr; ?></a>
                </li>
              </ul>
              </div>
              <div class="col-md-6">
              
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label for="bayar" class="col-sm-2 control-label">Bayar</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="bayar" id="bayar" maxlength="100" autofocus required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"/>
                  <input type="hidden" class="form-control" name="idpel" id="idpel" value="<?php echo $data['idpel']; ?>"/>
                  <input type="hidden" class="form-control" name="idtagihan" id="idtagihan" value="<?php echo $data['idtagihan']; ?>"/>
                  <input type="hidden" class="form-control" name="biayaadmin" id="biayaadmin" value="<?php echo $biayaadmin; ?>"/>
                  <input type="hidden" class="form-control" name="totalbayar" id="totalbayar" value="<?php echo $totalbayar; ?>"/>
                  <input type="hidden" class="form-control" name="totalpenggunaan" id="totalpenggunaan" value="<?php echo $totalpenggunaan; ?>"/>
                </div>
              </div>
              </div>
              <div class="col-md-1">
              <button type="submit" class="btn btn-primary" name="tambah" id="tambah" value="submit">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
</section>