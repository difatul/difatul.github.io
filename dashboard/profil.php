<?php
  $query=$conn->prepare("SELECT user.* FROM user WHERE user.iduser=?");
  $query->bindParam(1, $_SESSION['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
  $query->execute();
  $data=$query->fetch(PDO::FETCH_ASSOC);
?>
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>

        <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php if($data['foto']==NULL){?>
              <img class="profile-user-img img-responsive img-circle" src="../images/user.png" alt="User profile picture">
              <?php }else{?>
              <img class="profile-user-img img-responsive img-circle" src="../images/<?php echo $data['foto'];?>" alt="User profile picture">
              <?php } ?>

              <h3 class="profile-username text-center"><?php echo $data['nm_user'];?></h3>
              <p class="text-muted text-center"><?php echo $data['level'];?></p>

              <div class="col-md-6">

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Nama</b> <a class="pull-right"><?php echo $data['iduser']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Kode Karyawan</b> <a class="pull-right"><?php echo $data['iduser']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Nomor HP</b> <a class="pull-right"><?php echo $data['tlp_user']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Alamat</b> <a class="pull-right"><?php echo $data['alamat']; ?></a>
                  </li>
                </ul>
              </div>

              <div class="col-md-6">

                <ul class="list-group list-group-unbordered">
                
                  <li class="list-group-item">
                    <b>Username</b> <a class="pull-right"><?php echo $data['username']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Password</b> <a class="pull-right"><?php echo $data['password']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="pull-right"><?php echo $data['status']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Terakhir Akses</b> <a class="pull-right"><?php echo $data['akses']; ?></a>
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
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Foto Administrator</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="post" action="?mod=user/aksi" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="nm_user" class="col-sm-2 control-label">Nama</label>
                      <div class="col-sm-10"><?php echo $data['nm_user']; ?></div>
                    </div>
                    
                    <div class="form-group">
                      <label for="gambar" class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-10">
                          <input type="file" name="picture" required>
                      </div>
                    </div>
                     
                    <input type="hidden" class="form-control" value="<?php echo $data['iduser']; ?>" name="iduser" id="username" readonly/>
             
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success" name="edit_foto" id="edit_foto" value="Submit">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>