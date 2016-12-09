

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
              <li><a href="index.php?sayfa=proje-danisman"><i class="fa fa-user"></i> <span>Danışman</span></a></li>
       <?php 
            if(ogrenciProjeAlmismi($ogrId,1)!=1) 
        echo'<li class="treeview  active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Proje Başvuru</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?sayfa=ogrenci-proje-onerme"><i class="fa fa-circle-o"></i>Proje Önerme</a></li>
                <li><a href="index.php?sayfa=bireysel-projeler"><i class="fa fa-circle-o"></i>Bireysel projeler</a></li>
                <li class="active treeview">
                    <a href="index.php?sayfa=grup-projeler">
                        <i class="fa fa-circle-o"></i> Grup Projeler   </a>    </li>
                <li><a href="index.php?sayfa=basvurulan-projeleri"><i class="fa fa-circle-o"></i>Başvurulan Projeleri Listele</a></li>
              </ul>
            </li>';
              ?>
            <li><a href="index.php?sayfa=rapor-islemleri"><i class="fa  fa-files-o"></i> Rapor İşlemleri</a></li>
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
              <li><a href="index.php?sayfa=proje-danisman"><i class="fa fa-user"></i> <span>Danışman</span></a></li>
          <?php 
          if(ogrenciProjeAlmismi($ogrId,2)!=1 && ogrenciProjeAlmismi($ogrId,3)!=1 )
         echo'<li class="treeview  active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Proje Başvuru</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php?sayfa=ogrenci-proje-onerme"><i class="fa fa-circle-o"></i>Proje Önerme</a></li>
                <li><a href="index.php?sayfa=bireysel-projeler"><i class="fa fa-circle-o"></i>Bireysel projeler</a></li>
                <li class="active treeview">
                    <a href="index.php?sayfa=grup-projeler">
                        <i class="fa fa-circle-o"></i> Grup Projeler   </a>    </li>
                <li><a href="index.php?sayfa=basvurulan-projeleri"><i class="fa fa-circle-o"></i>Başvurulan Projeleri Listele</a></li>
              </ul>
            </li>';
              ?>
            <li><a href="index.php?sayfa=rapor-islemleri"><i class="fa  fa-files-o"></i> Rapor İşlemleri</a></li>
          </ul>
        </li>
        
          
		 <li>
          <a href="index.php?sayfa=mesajlar">
            <i class="fa fa-envelope"></i> <span>Mesajlar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
       <li>
          <a href="index.php?sayfa=mesajlar">
            <i class="fa fa-newspaper-o"></i> <span>Profil</span>
            <span class="pull-right-container"></span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Boş Alan</a></li>
             
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li> 
          </ul>
        </li>
        <li><a href="#"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>