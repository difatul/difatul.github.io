<?php
try {
$query = $conn->prepare("SELECT user.* FROM user WHERE user.iduser=?");
$query->bindParam(1, $_GET['iduser'], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
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
        <li class="#"><a href="?mod=user/data">Data Pegawai</a></li>
        <li class="active">Edit</li>
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
              <h3 class="box-title">Edit Data Pegawai</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" method="POST" action="?mod=user/aksi" enctype="multipart/form-data">
                <div class="col-md-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label for="nm_user">Nama</label>
                    <input type="text" class="form-control" value="<?php echo $data['nm_user'];?>" name="nm_user" id="nm_user" maxlength="30" required="required" autofocus>
                    <input type="hidden" class="form-control" value="<?php echo $data['iduser'];?>" name="iduser" id="iduser">
                  </div>

                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" value="<?php echo $data['alamat'];?>" name="alamat" id="alamat" maxlength="50" required="required">
                  </div>

                  <div class="form-group">
                    <label for="tlp_user">No. HP</label>
                    <input type="text" class="form-control" value="<?php echo $data['tlp_user'];?>" name="tlp_user" id="tlp_user" maxlength="15">
                  </div>

                  <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" maxlength="15">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" value="<?php echo $data['username'];?>" name="username" id="username" maxlength="20" required="required">
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" value="<?php echo $data['password'];?>" name="password" id="password" maxlength="20" required="required">
                  </div>

                  <div class="form-group">
                    <label for="level">Level</label><br>
                    <input type="radio" name="level" id="level" value="Administrator" <?php if ($data['level']=="Administrator"){
                      echo"checked='checked';";}?>>&nbsp Administrator
                    &nbsp &nbsp &nbsp<input type="radio" name="level" id="level" value="Petugas" <?php if ($data['level']=="Petugas"){
                      echo"checked='checked';";}?>>&nbsp Petugas
                  </div>

                  <div class="form-group">
                    <label for="status">Status</label><br>
                    <input type="radio" name="status" id="status" value="Aktif" <?php if ($data['status']=="Aktif"){
                      echo"checked='checked';";}?>>&nbsp Aktif
                    &nbsp &nbsp &nbsp<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if ($data['status']=="Tidak Aktif"){
                      echo"checked='checked';";}?>>&nbsp Tidak Aktif
                  </div>
                </div>
              
            </div>
            <div class="box-footer" align="right">
              <input type="submit" class="btn btn-success" name="edit_user" id="edit_user" value="Simpan" />
              <a href="?mod=user/data" class="btn btn-default">Batal</a>
            </div>
              </form>
            <!-- /.box-body -->
          </div>

        </div>
    </section>