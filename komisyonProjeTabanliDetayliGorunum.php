<span id="sonuc"></span>
 
<input type="text" class="hidden page" name="<?php echo sayfa(); ?>" />

<div class="box box-widget widget-user">
<div class="widget-user-header bg-aqua-active">
<h2 class="widget-user-desc"><?php echo  $_GET["projeTuru"]; ?></h2>
<h3 class="widget-user-username"><?php echo  $_GET["ogrenciAdi"]."  ".$_GET["ogrenciSoyadi"]  ; ?></h3>
<h5 class="widget-user-desc"><?php echo  $_GET["numara"]; ?></h5>
</div>
<div class="widget-user-image">
<img class="img-circle" src="<?php echo  $_GET["foto"]; ?>" alt="User Avatar">
</div>
<div class="box-footer">
<div class="row">
</div>
</div>
</div>



  <div class="box">
            <div class="box-header">
              <h1 class="box-title text-primary">
                <?php
                 echo tabloBaslik() ;
                ?>
                </h1>
                 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="databaseTablo" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sıra</th>
                  <th>Proje Adı</th>
                  <th>Konu</th>
                  <th>Kişi Sayısı</th>
                  <th>Danışman Sayısı</th>
                  <th>Projeyi Öneren</th>
                  <th>Onay</th> 
                </tr>
                </thead>
                <tbody>
                    <?php
                    $sayfa=sayfa();
                    if($sayfa=="komisyon-proje-tabanli-detayli-gorunum"){
                       commissionProjectBasedDetailedView();
                       }
                    ?>
                   <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->