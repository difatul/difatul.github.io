    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-4">
          <div align="center">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan ID Pelanggan/Nama Customer</h3>
              <div class="box-tools pull-right"></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="?mod=transaksi/aksi" method="POST">
                <input type="text" id="country_id" name="idpel" autofocus="autofocus" class="form-control" onkeyup="autocomplet()" required="required">
                <ul id="country_list_id"></ul>
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
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>