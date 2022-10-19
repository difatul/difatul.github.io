<?php
try {
$query = $conn->prepare("SELECT tarif.* FROM tarif WHERE tarif.idtarif=?");
$query->bindParam(1, $_GET['idtarif'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
$query->execute();
$data=$query->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  echo "ada kesalahan pada query : ".$e->getMessage();
}
?>
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="#"><a href="?mod=tarif/data">Data Tarif</a></li>
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
              <h3 class="box-title">Edit Tarif</h3>
            </div>
            <!-- /.box-header -->
            
              <form class="form-horizontal" method="POST" action="?mod=tarif/aksi" enctype="multipart/form-data">
                <div class="box-body">
                  <!-- text input -->
                <div class="form-group">
                  <label for="daya" class="col-sm-2 control-label">Daya</label>
                  <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon">Watt</span>
                    <input type="text" class="form-control" value="<?php echo $data['daya'];?>" name="daya" id="daya" maxlength="10"/>
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tarifperkwh" class="col-sm-2 control-label">Tarif/kwh</label>
                  <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" value="<?php echo $data['tarifperkwh'];?>" name="tarifperkwh" id="tarifperkwh" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" maxlength="6"/>
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="denda" class="col-sm-2 control-label">Denda</label>
                  <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" value="<?php echo $data['denda'];?>" name="denda" id="denda" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" maxlength="6"/>
                  </div>
                  </div>
                </div>

                <input type="hidden" class="form-control" value="<?php echo $data['idtarif'];?>" name="idtarif" id="idjenis" maxlength="30"/>

                <div class="box-footer" align="right">
                  <input type="submit" class="btn btn-success" name="edit" id="edit" value="Simpan" />
                  <a href="?mod=tarif/data" class="btn btn-default">Batal</a>
                </div>
                </div>
              </form>
            <!-- /.box-body -->
          

        </div>
    </section>