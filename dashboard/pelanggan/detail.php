<?php
  $query=$conn->prepare("SELECT pelanggan.*, tarif.* FROM pelanggan, tarif WHERE pelanggan.idtarif=tarif.idtarif AND pelanggan.idpel=?");
  $query->bindParam(1, $_GET['idpel'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->execute();
  $data=$query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="#"><a href="?mod=pelanggan/data">Data Pelanggan</a></li>
        <li class="active">Detail Data</li>
      </ol>
    </section>

        <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="col-md-12">
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Id Pelanggan</b> <a class="pull-right"><?php echo $data['idpel']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Nama Pelanggan</b> <a class="pull-right"><?php echo $data['nm_pel']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Alamat Pelanggan</b> <a class="pull-right"><?php echo $data['almt_pel']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Daya</b> <a class="pull-right"><?php echo $data['daya']." Watt"; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Nomer Meteran</b> <a class="pull-right"><?php echo $data['nometer']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Tanggal Daftar</b> <a class="pull-right"><?php echo $data['tgldaftar']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="pull-right"><?php echo $data['status']; ?></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->