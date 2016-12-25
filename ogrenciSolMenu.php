      <?php
    $id=$_SESSION['staj']['id'];
    $diziMesajlarSayisi=gelenGidenMesajSayisi($id);
      ?>

  <ul class="sidebar-menu">
        <li class="header">ÖĞRENCİ  İŞLEMLERİ</li>
          
        <!--    TASARIM PROJESİ -->
		<li class="treeview"  >
		  <a href="index.php?sayfa=proje-basvuru">
            <i class="fa fa-text-height"></i><span>Tasarım Projesi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="index.php?sayfa=proje-danismant"><i class="fa fa-user"></i> <span>Danışman</span></a></li>    

	 <?php 
            if(ogrenciProjeAlmismi($ogrId,1)!=1) 
        echo '<li class="treeview  active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Proje Başvuru</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?sayfa=ogrenci-proje-onerme&tur=1"><i class="fa fa-circle-o"></i>Proje Önerme</a></li>
                <li><a href="index.php?sayfa=bireysel-projeler&tur=1"><i class="fa fa-circle-o"></i>Bireysel projeler</a></li>
                <li class="active treeview">
                    <a href="index.php?sayfa=grup-projeler&tur=1">
                        <i class="fa fa-circle-o"></i> Grup Projeler   </a>    </li>
                <li><a href="index.php?sayfa=basvurulan-projeleri&tur=1"><i class="fa fa-circle-o"></i>Başvurulan Projeleri Listele</a></li>
              </ul>
            </li>';
            else if(ogrenciProjeAlmismi($ogrId,1)==1) 
            echo '<li><a href="index.php?sayfa=rapor-islemleri&tur=1"><i class="fa  fa-files-o"></i> Rapor İşlemleri</a></li>';
              ?>
          </ul>
        </li>
     
        <!--    BİTİRME PROJESİ -->
		<li class="treeview"  >
		  <a href="index.php?sayfa=proje-basvuru">
            <i class="fa fa-btc" id="bitirme-proje-basvuru"></i><span>Bitirme Projesi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="index.php?sayfa=proje-danismanb"><i class="fa fa-user"></i> <span>Danışman</span></a></li>
          <?php 
          if(ogrenciProjeAlmismi($ogrId,2)!=1 && ogrenciProjeAlmismi($ogrId,3)!=1 && ogrenciProjeAlmismi($ogrId,1)==1)
         echo '<li class="treeview  active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Proje Başvuru</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?sayfa=ogrenci-proje-onerme&tur=2"><i class="fa fa-circle-o"></i>Proje Önerme</a></li>
                <li><a href="index.php?sayfa=bireysel-projeler&tur=2"><i class="fa fa-circle-o"></i>Bireysel projeler</a></li>
                <li class="active treeview">
                    <a href="index.php?sayfa=grup-projeler&tur=2">
                        <i class="fa fa-circle-o"></i> Grup Projeler   </a>    </li>
                <li><a href="index.php?sayfa=basvurulan-projeleri&tur=2"><i class="fa fa-circle-o"></i>Başvurulan Projeleri Listele</a></li>
              </ul>
            </li>';
            else if(ogrenciProjeAlmismi($ogrId,2)==1)
              echo '<li><a href="index.php?sayfa=rapor-islemleri&tur=2"><i class="fa  fa-files-o"></i> Rapor İşlemleri</a></li>';
              ?>
          </ul>
        </li>
        
          
		 <li>
          <a href="index.php?sayfa=mesajlar">
            <i class="fa fa-envelope"></i> <span>Mesajlar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow"><?php echo $diziMesajlarSayisi['giden'][0]; ?></small>
              <small class="label pull-right bg-blue"><?php echo $diziMesajlarSayisi['gelen'][0]; ?></small>
            </span>
          </a>
        </li>
       <li>
          <a href="index.php?sayfa=profil-duzenle">
            <i class="fa fa-newspaper-o"></i> <span>Profil</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        
      </ul>