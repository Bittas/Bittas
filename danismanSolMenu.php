                  <?php
    $id=$_SESSION['staj']['id'];
    $diziMesajlarSayisi=gelenGidenMesajSayisi($id);
      ?>
      <ul class="sidebar-menu">
        <li class="header">DANIŞMAN  İŞLEMLERİ</li>
        <li class="treeview">
      <a href="#">
            <i class="fa fa-files-o"></i><span>Proje İşlemleri</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?sayfa=proje-oner"><i class="fa  fa-text-height"></i>Proje Öner</a></li>
            <li><a href="index.php?sayfa=proje-onerilen"><i class="fa  fa-btc"></i>Önerilen Projeler</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Danışman </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active treeview">
				<a href="index.php?sayfa=ogrenci-kabul-ret">
					<i class="fa fa-circle-o"></i> <span>Öğrenci Kabul/Ret</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
			</a>
				<ul class="treeview-menu">
					<li><a href="index.php?sayfa=kabul-edilenler"><i class="fa  fa-check-circle"></i>Kabul Edilenler</a></li>
					<li class="active"><a href="index.php?sayfa=kabul-edilmeyenler"><i class="fa  fa-times-circle">
                        </i>Kabul Edilmeyenler</a>
                    </li>
				</ul>
			</li>
          </ul>
        </li>
		<li class="treeview">
		  <a href="#">
            <i class="fa fa-files-o"></i><span>Rapor Görüntüle</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?sayfa=danisman-raporlar&tur=tasarim"><i class="fa  fa-text-height"></i>Tasarım Projesi</a></li>
            <li><a href="index.php?sayfa=danisman-raporlar&tur=bitirme"><i class="fa  fa-btc"></i>Bitirme Projesi</a></li>
          </ul>
        </li>
         <li class="treeview">
		  <a href="#"> 
              <i class="fa  fa-list-ul"></i>
              <span>Listeler</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
             </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?sayfa=danismana-ogrenci-proje-listele&kisi=grup"><i class="fa  fa-group"></i>Grup</a></li>
            <li><a href="index.php?sayfa=danismana-ogrenci-proje-listele&kisi=bireysel"><i class="fa   fa-user"></i>Bireysel</a></li>
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
          <a href="index.php?sayfa=danisman-profil-duzenle">
            <i class="fa fa-newspaper-o"></i> <span>Profil</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
    <li class="treeview">
      <a href="#">
            <i class="fa fa-cogs"></i><span>Öğrenci Kayıt İşlemleri</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?sayfa=ogrenci-kayit-onay"><i class="fa fa-plus"></i>Öğrenci Kaydı Onay</a></li>
            <li><a href="index.php?sayfa=ogrenci-kayit-iptal"><i class="fa fa-times"></i>Öğrenci Kaydı İptal</a></li>
          </ul>
        </li>