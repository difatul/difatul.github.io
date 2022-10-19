    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pelanggan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pelanggan</h3>
              <div class="box-tools pull-right">
                <a data-toggle="modal" href="pelanggan/print.php" title="Print Data"><div class="btn btn-box-tool"><i class="glyphicon glyphicon-print"></i></div></a>
                <a data-toggle="modal" href="#myModal" title="Tambah Data"><div class="btn btn-box-tool"><i class="glyphicon glyphicon-plus"></i></div></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Id Pelanggan</th>
                  <th class="text-center">Nama Pelanggan</th>
                  <th class="text-center">Nomor Meteran</th>
                  <th class="text-center">Daya</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  try{
                    $query=$conn->prepare("SELECT pelanggan.*, tarif.* FROM Pelanggan, tarif where pelanggan.idtarif=tarif.idtarif");
                    $query->execute();
                    while($data=$query->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                  <td><?php echo $data['idpel'];?></td>
                  <td><?php echo $data['nm_pel'];?></td>
                  <td><?php echo $data['nometer'];?></td>
                  <td><?php echo $data['daya']." VA";?></td>
                  <td class="text-center">
                    <?php if($data['status']=='Aktif'){ ?>
                    <a title="Tidak Aktifkan" class="btn bg-green btn-flat btn-xs" href="?mod=pelanggan/aksi&idpel=<?php echo $data['idpel'];?>&aktif=n">Aktif</a> <?php
                    }
                    else{ ?>
                    <a title="Aktifkan" class="btn bg-red btn-flat btn-xs" href="?mod=pelanggan/aksi&idpel=<?php echo $data['idpel'];?>&aktif=y">Tidak Aktif</a> <?php
                    } ?>
                  </td>
                  <td>
                    <div align="center">
                      <a data-toggle="tooltip" data-placement="top" title="Detail" style="margin-right:5px" class="btn btn-success btn-sm" href="?mod=pelanggan/detail&idpel=<?php echo $data['idpel']; ?>">
                        <i class="glyphicon glyphicon-list-alt"></i>
                      </a>
                      <a data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px" class="btn btn-warning btn-sm" href="?mod=pelanggan/edit&idpel=<?php echo $data['idpel'];?>">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      <form class="form-horizontal" method="post" action="pelanggan/printkartu.php" enctype="multipart/form-data" target="_blank">
                        <input type="hidden" class="form-control" value="<?php echo $data['idpel']; ?>" name="idpel" id="idpel" readonly/>
                        <button type="submit" title="Print Kartu" class="btn btn-primary btn-sm waves-effect" name="print" id="print"><i class="fa fa-print"></i></button>
                      </form>
                      <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="?mod=pelanggan/aksi&idpel=<?php echo $data['idpel'];?>&del=del" onClick="return confirm('Apakah anda yakin menghapus data ini?')">
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
              <form class="form-horizontal" method="POST" action="?mod=pelanggan/aksi" enctype="multipart/form-data">
                <div class="modal-body">
                  <?php
                  $query=$conn->prepare("SELECT * FROM tarif");
                  $query->execute();
                  $data=$query->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="form-group">
                    <label for="nm_pel" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" autofocus class="form-control" placeholder="Ex: Fannia Laily Fauziyah" name="nm_pel" id="nm_pel" maxlength="30" required="required" autofocus/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="almt_pel" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Ex: Jl Sari Utomo 02/01 Petung Panceng Gresik" name="almt_pel" id="almt_pel" maxlength="50" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="idtarif" class="col-sm-2 control-label">Daya</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="idtarif" id="idtarif">
                      <option>-- Pilih --</option>
                      <?php do{ ?>
                      <option value="<?php echo $data['idtarif'];?>"><?php echo $data['daya']." Watt";?></option>
                      <?php }while($data=$query->fetch(PDO::FETCH_ASSOC)); ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nometer" class="col-sm-2 control-label">Nomor Meteran</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="928126175***" name="nometer" id="nometer" maxlength="50" required="required"/>
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