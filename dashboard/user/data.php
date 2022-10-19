    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pegawai</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pegawai</h3>
              <div class="box-tools pull-right">
                <a data-toggle="modal" href="user/print.php" title="Print Data"><div class="btn btn-box-tool"><i class="glyphicon glyphicon-print"></i></div></a>
                <a data-toggle="modal" href="#myModal" title="Tambah Data"><div class="btn btn-box-tool"><i class="glyphicon glyphicon-plus"></i></div></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Level</th>
                  <th class="text-center">No. Hp</th>
                  <th class="text-center">Terakhir Akses</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  try{
                    $query=$conn->prepare("SELECT user.* FROM user where 1");
                    $query->execute();
                    while($data=$query->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                  <td><?php echo $data['nm_user'];?></td>
                  <td><?php echo $data['level'];?></td>
                  <td><?php echo $data['tlp_user'];?></td>
                  <td><?php echo $data['akses'];?></td>
                  <td class="text-center">
                    <?php if($data['username']!='Administrator'){
                      if($data['status']=='Tidak Aktif'){ ?>
                      <a title="Aktifkan" class="btn bg-red btn-flat btn-xs" href="?mod=user/aksi&iduser=<?php echo $data['iduser'];?>&aktif=y">Tidak Aktif</a> <?php
                    }
                    else{ ?>
                      <a title="Tidak Aktifkan" class="btn bg-green btn-flat btn-xs" href="?mod=user/aksi&iduser=<?php echo $data['iduser'];?>&aktif=n">Aktif</a> <?php
                    }
                      
                    }?>
                  </td>
                  <td>
                    <div align="center">
                      <a data-toggle="tooltip" data-placement="top" title="Detail" style="margin-right:5px" class="btn btn-success btn-sm" href="?mod=user/detail&iduser=<?php echo $data['iduser']; ?>">
                        <i class="glyphicon glyphicon-list-alt"></i>
                      </a>
                      <a data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px" class="btn btn-warning btn-sm" href="?mod=user/edit&iduser=<?php echo $data['iduser'];?>">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      <?php if($data['username']!='admin'){ ?>
                      <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="?mod=user/aksi&iduser=<?php echo $data['iduser'];?>&del=del" onClick="return confirm('Apakah anda yakin menghapus data ini?')">
                        <i class="glyphicon glyphicon-trash"></i>
                      </a>
                      <?php } ?>
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
                <h4 class="modal-title">Tambah Data Pegawai</h4>
              </div>
              <form class="form-horizontal" method="POST" action="?mod=user/aksi" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nm_user" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" autofocus class="form-control" placeholder="Ex: Fannia Laily Fauziyah" name="nm_user" id="nm_user" maxlength="30" required="required" autofocus/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Ex: Petung Panceng Gresik" name="alamat" id="alamat" maxlength="50" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="tlp_user" class="col-sm-2 control-label">Nomor HP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Ex: 085648140***" name="tlp_user" id="tlp_user" maxlength="15" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Ex: fannia" name="username" id="username" maxlength="10" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Ex: fannia" name="password" id="password" maxlength="10" required="required"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="level" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-10">
                      <input type="radio" name="level" id="level" value="Administrator" checked='checked'>&nbsp Administrator
                      &nbsp &nbsp &nbsp<input type="radio" name="level" id="level" value="Petugas">&nbsp Petugas
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                      <input type="radio" name="status" id="status" value="Aktif" checked='checked'>&nbsp Aktif
                      &nbsp &nbsp &nbsp<input type="radio" name="status" id="status" value="Tidak Aktif">&nbsp Tidak Aktif
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="foto" class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" name="foto" id="foto"/>
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