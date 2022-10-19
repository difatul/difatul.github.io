    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Penggunaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Penggunaan</h3>
              <div class="box-tools pull-right"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Id Penggunaan</th>
                  <th class="text-center">Nama Pelanggan</th>
                  <th class="text-center">Bulan, Tahun</th>
                  <th class="text-center">Meteran Awal</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  try{
                    $query=$conn->prepare("SELECT penggunaan.*, pelanggan.* FROM Pelanggan, penggunaan where pelanggan.idpel=penggunaan.idpel AND penggunaan.meterakhir=''");
                    $query->execute();
                    while($data=$query->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                  <td><?php echo $data['idpenggunaan'];?></td>
                  <td><?php echo $data['nm_pel'];?></td>
                  <td><?php echo $data['bulan'].", ".$data['tahun'];?></td>
                  <td><?php echo $data['meterawal'];?></td>
                  <td>
                    <div align="center">
                      <a data-toggle="tooltip" data-placement="top" title="Masukkan Meter Akhir" style="margin-right:5px" class="btn btn-success btn-sm" href="?mod=penggunaan/tambah&idpenggunaan=<?php echo $data['idpenggunaan'];?>">
                        <i class="glyphicon glyphicon-edit"></i>
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