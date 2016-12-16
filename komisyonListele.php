
<span id="sonuc"></span>  
<div class="box">
            <div class="box-header">
              

              <h1 class="box-title text-primary">
                <?php
                   if($sayfa=="listele" && $_GET["kisi"]=="grup" && $_GET["tur"]==1){
                       echo  "Aktif Tasarım Projeleri - Grup ";
                    }
                    else if($sayfa=="listele" && $_GET["kisi"]=="bireysel" && $_GET["tur"]==1){
                       echo  "Aktif Tasarım Projeleri - Bireysel ";
                    }
                    else if($sayfa=="listele" && $_GET["kisi"]=="bireysel" && $_GET["tur"]==2)
                       echo  "Aktif Bitirme Projeleri - Bireysel ";
                    else if($sayfa=="listele" && $_GET["kisi"]=="grup" && $_GET["tur"]==2)
                       echo  "Aktif Bitirme Projeleri - Grup ";
                ?>
                </h1>
                 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Proje Adı</th>
                  <th>Konu</th>
                  <th>Kişi Sayısı</th>
                  <th>Danışman Sayısı</th>
                  <th>Başlama Tarihi</th>
                  <th>Sonlandır</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $sayfa=sayfa();
                    if($sayfa=="listele" && $_GET["kisi"]=="grup" && $_GET["tur"]==1){
                        projeListele(">",1);
                    }
                    else if($sayfa=="listele" && $_GET["kisi"]=="bireysel" && $_GET["tur"]==1){
                        projeListele("=",1);
                    }
                    else if($sayfa=="listele" && $_GET["kisi"]=="bireysel" && $_GET["tur"]==2)
                        projeListele("=",2);
                    else if($sayfa=="listele" && $_GET["kisi"]=="grup" && $_GET["tur"]==2)
                        projeListele(">",2);
                  
                    ?>
                   <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->