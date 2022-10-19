    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Tagihan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Tagihan</h3>
              <div class="box-tools pull-right"> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Id Tagihan</th>
                  <th class="text-center">Bulan, Tahun</th>
                  <th class="text-center">Pemakaian</th>
                  <th class="text-center">Total Penggunaan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $idpel=$_SESSION['idpel'];
                  $totalpenggunaan="0";
                  try{
                    $query=$conn->prepare("SELECT tagihan.*, pelanggan.*, tarif.* FROM Pelanggan, tagihan, tarif where pelanggan.idpel=tagihan.idpel AND pelanggan.idtarif=tarif.idtarif AND tagihan.status='Belum Terbayar' AND tagihan.idpel='$idpel'");
                    $query->execute();
                    while($data=$query->fetch(PDO::FETCH_ASSOC)){
                    $totalpenggunaan=$data['jumlahmeter']*$data['tarifperkwh'];
                    $total="Rp ".number_format($totalpenggunaan, "2", ",", "."); ?>
                <tr>
                  <td><?php echo $data['idtagihan'];?></td>
                  <td><?php echo $data['bulan'].", ".$data['tahun'];?></td>
                  <td><?php echo $data['jumlahmeter'];?></td>
                  <td class="text-right"><?php echo $total;?></td>
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