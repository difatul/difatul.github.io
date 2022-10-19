    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Tarif</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Tarif</h3>
              <div class="box-tools pull-right">
                <a data-toggle="modal" href="tarif/print.php" title="Print Data"><div class="btn btn-box-tool"><i class="glyphicon glyphicon-print"></i></div></a>
                <a data-toggle="modal" href="#myModal" title="Tambah Data"><div class="btn btn-box-tool"><i class="glyphicon glyphicon-plus"></i></div></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Id Tarif</th>
                  <th class="text-center">Daya</th>
                  <th class="text-center">Tarif/kwh</th>
                  <th class="text-center">Denda</th>
                  <th class="text-center">Pengguna</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  try{
                    $query=$conn->prepare("SELECT * FROM tarif");
                    $query->execute();
                    while($data=$query->fetch(PDO::FETCH_ASSOC)){
                    $harga="Rp ".number_format($data['tarifperkwh'], "2", ",", ".");
                    $denda="Rp ".number_format($data['denda'], "2", ",", "."); ?>
                <tr>
                  <td><?php echo $data['idtarif'];?></td>
                  <td><?php echo $data['daya']." VA";?></td>
                  <td><?php echo $harga;?></td>
                  <td><?php echo $denda;?></td>
                  <td> <?php
                    // jumlah pengguna daya
                    $pelanggan = $conn->prepare("SELECT count(*), tarif.daya FROM pelanggan, tarif WHERE pelanggan.idtarif=tarif.idtarif AND tarif.idtarif='$data[idtarif]'");
                    $pelanggan->execute();
                    $pel = $pelanggan->fetch(PDO::FETCH_NUM);
                    $pelanggan1=$pel[0]; 
                    echo $pelanggan1." Pengguna"; ?>
                  </td>
                  <td>
                    <div align="center">
                      <a data-toggle="tooltip" href="?mod=tarif/edit&idtarif=<?php echo $data['idtarif'];?>" data-placement="top" title="Edit" style="margin-right:5px" class="btn btn-warning btn-sm"> 
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>

                      <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="?mod=tarif/aksi&idtarif=<?php echo $data['idtarif'];?>&del=del" onClick="return confirm('Apakah anda yakin menghapus data ini?')">
                        <i class="glyphicon glyphicon-trash"></i>
                      </a>
                  </td>
                  <?php
                  }
                  $pdo=null;
                }
                  catch(PDOException $e){
                    echo "ada kesalahan dalam query : ".$e->getMessage();
                    }
                    ?>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Pelanggan</h4>
              </div>
              <form class="form-horizontal" method="POST" action="?mod=tarif/aksi" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="daya" class="col-sm-2 control-label">Daya</label>
                    <div class="col-sm-10">
                      <input type="text" autofocus class="form-control" placeholder="Ex: 450" name="daya" id="daya" maxlength="10" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="tarif" class="col-sm-2 control-label">Tarif/kwh</label>
                    <div class="col-sm-10">
                      <input type="text" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" class="form-control" placeholder="Ex: 1.000" name="tarif" id="tarif" maxlength="10" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="denda" class="col-sm-2 control-label">Denda</label>
                    <div class="col-sm-10">
                      <input type="text" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" class="form-control" placeholder="Ex: 1.000" name="denda" id="denda" maxlength="10" required="required"/>
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary" name="tambah" id="tambah" value="submit">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>