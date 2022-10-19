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
                  <th class="text-center">Id Pembayaran</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Total Meter</th>
                  <th class="text-center">Total Bayar</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  try{
                    $tgl=date('Y-m-d');
                    $query=$conn->prepare("SELECT pembayaran.*, tagihan.* FROM pembayaran, tagihan WHERE pembayaran.idtagihan=tagihan.idtagihan AND pembayaran.tanggal=?");
                    $query->bindParam(1, $tgl, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
                    $query->execute();
                    while($data=$query->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                  <td><?php echo $data['idbayar'];?></td>
                  <td><?php echo $data['tanggal'];?></td>
                  <td><?php echo $data['jumlahmeter'];?></td>
                  <td><?php echo $data['totalbayar'];?></td>
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
<?php if (isset($_GET['kembali'])) {?>
<!-- modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Transaksi Berhasil</h4>
            </div><hr>
            <form class="form-horizontal" method="post" action="transaksi/print_transaksi.php" enctype="multipart/form-data" target="_blank">
                <div class="modal-body">
                    <h3 align="center">Kembali : <?php echo "Rp.".number_format($_GET['kembali'], "2", ",", ".");?></h3><hr>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="print" id="print"><i class="material-icons">print</i> Print Struk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- akhir modal -->
<script>
$(document).ready(function(){
    // Show the Modal on load
    $("#myModal1").modal("show");
});
</script>
<?php } ?>