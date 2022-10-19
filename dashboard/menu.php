  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if(($_SESSION['foto']==NULL)||($_SESSION['level']=='Administrator')){ ?>
            <img src="../images/user.png" class="img-circle" alt="User Image">
          <?php } else{ ?>
            <img src="../images/<?php echo $_SESSION['foto'];?>" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['level'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <?php if($_SESSION['level']=="Administrator"){ ?>
        <li>
          <a href="?mod=user/data">
            <i class="fa fa-user"></i> <span>Data Pegawai</span>
          </a>
        </li>
        <li>
          <a href="?mod=pelanggan/data">
            <i class="fa fa-users"></i> <span>Data Pelanggan</span>
          </a>
        </li>
        <li>
          <a href="?mod=tarif/data">
            <i class="fa fa-dollar"></i> <span>Tarif</span>
          </a>
        </li>
        <li>
          <a href="?mod=laporan/laporan">
            <i class="fa fa-print"></i> <span>Laporan Pembayaran</span>
          </a>
        </li>
        <?php } ?>
        <?php if($_SESSION['level']=="Petugas"){ ?>
        <li>
          <a href="?mod=transaksi/cari">
            <i class="fa fa-dollar"></i> <span>Pembayaran</span>
          </a>
        </li>
        <li>
          <a href="?mod=tagihan/data">
            <i class="fa fa-bars"></i> <span>Tagihan</span>
          </a>
        </li>
        <li>
          <a href="?mod=penggunaan/data">
            <i class="fa fa-list"></i> <span>Penggunaan</span>
          </a>
        </li>
        <li>
          <a href="?mod=laporan/laporan">
            <i class="fa fa-print"></i> <span>Laporan Pembayaran</span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>