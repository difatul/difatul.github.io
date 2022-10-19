<?php
try {
$query = $conn->prepare("SELECT penggunaan.*, pelanggan.* FROM pelanggan, penggunaan WHERE penggunaan.idpel=pelanggan.idpel AND penggunaan.idpenggunaan=?");
$query->bindParam(1, $_GET['idpenggunaan'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
$query->execute();
$data=$query->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  echo "ada kesalahan pada query : ".$e->getMessage();
}
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="#"><a href="?mod=penggunaan/data">Data Penggunaan</a></li>
        <li class="active">Tambah Meter Akhir</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Meter Akhir</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="POST" action="?mod=penggunaan/aksi" enctype="multipart/form-data">
                <div class="col-md-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label for="nm_pel">Nama Pelanggan</label>
                    <input type="text" class="form-control" value="<?php echo $data['nm_pel'];?>" name="nm_pel" id="nm_pel" maxlength="30" readonly>
                    <input type="hidden" class="form-control" value="<?php echo $data['idpel'];?>" name="idpel" id="idpel" maxlength="30">
                  </div>

                  <div class="form-group">
                    <label>Bulan, Tahun</label>
                    <input type="text" class="form-control" value="<?php echo $data['bulan'].", ".$data['tahun'];?>" readonly>
                    <input type="hidden" class="form-control" value="<?php echo $data['bulan'];?>" name="bulan" id="bulan">
                    <input type="hidden" class="form-control" value="<?php echo $data['tahun'];?>" name="tahun" id="tahun">
                  </div>

                  <div class="form-group">
                    <label for="meterawal">Meter Awal</label>
                    <input type="text" class="form-control" name="meterawal" id="meterawal" value="<?php echo $data['meterawal'];?>" maxlength="8" required="required" readonly>
                  </div>

                  <div class="form-group">
                    <label for="meterakhir">Meter Akhir</label>
                    <input type="text" class="form-control" name="meterakhir" id="meterakhir" maxlength="8" required="required" autofocus>
                    <input type="hidden" class="form-control" value="<?php echo $data['idpenggunaan'];?>" name="idpenggunaan" id="idpenggunaan" maxlength="8">
                  </div>
                </div>
            </div>
            <div class="box-footer" align="right">
              <input type="submit" class="btn btn-success" name="tambah" id="tambah" value="Simpan" />
              <a href="?mod=penggunaan/data" class="btn btn-default">Batal</a>
            </div>
              </form>
            <!-- /.box-body -->
          </div>

        </div>
    </section>
    <!-- /.content -->