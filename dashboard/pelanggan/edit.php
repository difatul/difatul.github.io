<?php
try {
$query = $conn->prepare("SELECT pelanggan.*, tarif.* FROM pelanggan, tarif WHERE tarif.idtarif=pelanggan.idtarif AND pelanggan.idpel=?");
$query->bindParam(1, $_GET['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
$query->execute();
$data=$query->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  echo "ada kesalahan pada query : ".$e->getMessage();
}

$query1=$conn->prepare("SELECT * FROM tarif");
$query1->execute();
$data1=$query1->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="#"><a href="?mod=pelanggan/data">Data Pelanggan</a></li>
        <li class="active">Edit Data</li>
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
              <h3 class="box-title">Edit Data Pelanggan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="POST" action="?mod=pelanggan/aksi" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nm_pel">Nama </label>
                    <input type="text" autofocus class="form-control" placeholder="Ex: Fannia Laily Fauziyah" name="nm_pel" value="<?php echo $data['nm_pel']; ?>" id="nm_pel" maxlength="30" required="required">
                    <input type="hidden" autofocus class="form-control"name="idpel" value="<?php echo $data['idpel']; ?>" id="idpel" maxlength="30" required="required">
                  </div>

                  <div class="form-group">
                    <label for="almt_pel">Alamat</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                      <input type="text" class="form-control" placeholder="Ex: Jl Sari Utomo 02/01 Petung Panceng Gresik" value="<?php echo $data['almt_pel']; ?>" name="almt_pel" id="almt_pel" maxlength="40" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Daya</label>
                    <select class="form-control" name="idtarif" id="idtarif">
                      <option value="<?php echo $data['idtarif'];?>" selected><?php echo $data['daya']." watt";?></option>
                      <option>-- Pilih --</option>
                      <?php do{ ?>
                      <option value="<?php echo $data1['idtarif'];?>"><?php echo $data1['daya']." Watt";?></option>
                      <?php }while($data1=$query1->fetch(PDO::FETCH_ASSOC)); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nometer">Nomor meteran </label>
                    <input type="text" class="form-control" value="<?php echo $data['nometer']; ?>" name="nometer" id="nometer">
                  </div>
                </div>
              
            </div>
            <div class="box-footer" align="right">
              <input type="submit" class="btn btn-success" name="edit" id="edit" value="Simpan" />
              <a href="?mod=pelanggan/data" class="btn btn-default">Batal</a>
            </div>
              </form>
            <!-- /.box-body -->
          </div>

        </div>
    </section>
    <!-- /.content -->