<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
     <a href="index.php" class="logo">
      <span class="logo-mini"><b>BitTas</b></span>
      <span class="logo-lg"><b>Bitirme & Tasarım</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
             $kullaniciId=$_SESSION['staj']['id'];
            $id=ogrenciId($kullaniciId);
            //Tasarım projesi almış ise
            if(ogrenciProjeAlmismi($id,1)==1)
          echo'
                <li class="dropdown label-menu">
                 <a href="index.php?sayfa=tasarim-projesi">
                  <i class="fa fa-text-height"></i>
                  <span class="label label-danger">1</span>
                </a>
          </li>
            ';//Bitirm projesi almış ise
             if(ogrenciProjeAlmismi($id,2)==1 || (ogrenciProjeAlmismi($id,3)==1))
          echo'
                <li class="dropdown label-menu">
                 <a href="index.php?sayfa=bitirme-projesi">
                  <i class="fa fa-btc"></i>
                  <span class="label label-danger">1</span>
                </a>
          </li>
            ';
          ?>
          <li class="dropdown tasks-menu">
            <a href="index.php?sayfa=mesajlar">
              <i class="fa fa-envelope"></i>
              <span class="label label-danger"><?php  //if($_SESSION["staj"]["mesaj"]>0){echo $_SESSION["staj"]["mesaj"];} ?></span>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $_SESSION["staj"]["foto"];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php//echo $_SESSION["staj"]["adi"]." ".$_SESSION["staj"]["soyadi"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $_SESSION["staj"]["foto"];?>" class="img-circle" alt="User Image">

                <p>
                 <?php echo $_SESSION["staj"]["adi"]." ".$_SESSION["staj"]["soyadi"]; ?>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?sayfa=profil-goster" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="cikis.php" class="btn btn-default btn-flat">Çıkış</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
