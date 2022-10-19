  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PPOB</b> Surya Mandiri</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if (($_SESSION['foto']==NULL)||($_SESSION['level']=='Administrator')){?>
                <img src="../images/user.png" class="user-image" alt="User Image">
              <?php } else{ ?>
                <img src="../images/<?php echo $_SESSION['foto'];?>" class="user-image" alt="User Image">
              <?php } ?>
              <span class="hidden-xs"><?php echo $_SESSION['nm_user'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if(($_SESSION['foto']==NULL)||($_SESSION['level']=='Administrator')){ ?>
                  <img src="../images/user.png" class="img-circle" alt="User Image">
                <?php } else{ ?>
                  <img src="../images/<?php echo $_SESSION['foto'];?>" class="img-circle" alt="User Image">
                <?php } ?>

                <p>
                  <?php echo $_SESSION['nm_user'];?>
                  <small><?php echo $_SESSION['level'];?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="#"><?php
                      if(isset($_SESSION['tlp_user'])==NULL){
                        echo "No number phone";
                      }
                      else{
                        echo $_SESSION['tlp_user'];
                      } ?>
                    </a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?mod=profil" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../login/logout.php" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>