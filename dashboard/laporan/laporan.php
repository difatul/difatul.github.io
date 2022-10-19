    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div align="center">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title" align="center">Data Laporan Pembayaran</h3>
              <div class="box-tools pull-right"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="post" action="laporan/cetaklaporan.php" target="_blank">

              <div class="col-xs-5">
              <div class="form-group">
                <label>Mulai Tanggal:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker" placeholder="Tanggal Awal" name="tgl1" id="tgl1">
                </div>
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-xs-5">
              <div class="form-group">
                <label>Sampai Tanggal:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker" placeholder="Tanggal Akhir" name="tgl2" id="tgl2">
                </div>
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-xs-2"><br>
              <button type="submit" value="submit" name="print" id="print" class="btn btn-primary">Print</button>
              </div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>