
<span id="sonuc"></span>

<div class="container">
  <form class="form-inline" action="" method="post">
    <div class="form-group">
        <label class="control-label" for="projeTuru">Proje Türü:</label>         
        <select class="form-control" name="tur"  id="tur" >
            <option value="1">Tasarım Projeleri</option>
            <option value="2">Bitirme Projeleri</option>
            <option value="3">Bitirme(Tasarım) Projeleri</option>
        </select>
    </div> 
    <div class="form-group">
        <label class="control-label" for="onay">Durum:</label>         
        <select class="form-control" name="durum"  id="durum">
            <option value="1">Aktif Proje</option>
            <option value="4">Bitmiş Proje</option>
        </select>
    </div> 
    <input type="submit" class="btn  btn-success" name="listele" value="Listele"/>
  </form>
</div>

<div class="box">
            <div class="box-header">
              

              <h1 class="box-title text-primary">
                <?php
                   if($sayfa=="danismana-ogrenci-proje-listele" && $_GET["kisi"]=="grup" && @$_GET["tur"]==1){
                       echo  "Aktif Tasarım Projeleri - Grup ";
                    }
                    else if($sayfa=="danismana-ogrenci-proje-listele" && $_GET["kisi"]=="bireysel" && @$_GET["tur"]==1){
                       echo  "Aktif Tasarım Projeleri - Bireysel ";
                    }
                    else if($sayfa=="danismana-ogrenci-proje-listele" && $_GET["kisi"]=="bireysel" && @$_GET["tur"]==2)
                       echo  "Aktif Bitirme Projeleri - Bireysel ";
                    else if($sayfa=="danismana-ogrenci-proje-listele" && $_GET["kisi"]=="grup" && @$_GET["tur"]==2)
                       echo  "Aktif Bitirme Projeleri - Grup ";
                ?>
                </h1>
                 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Ö. Numara</th>
                  <th>Ö. Adı</th>
                  <th>Ö. Soyadı</th>
                  <th>P. Adı</th>
                  <th>P. Konu</th>
                  <th>Kişi Sayısı</th>
                  <th>Danışman Sayısı</th>
                  <th>Kabul T.</th>
                  <th>Sonlanma T.</th>
                </tr>
                </thead>
                    <?php
                    $sayfa=sayfa();
                    if($sayfa=="danismana-ogrenci-proje-listele" && $_GET["kisi"]=="grup"){
                  
                        danismanOgrenciProjeListeleme(">",@$_POST["tur"],@$_POST["durum"]);
                    }
                    else if($sayfa=="danismana-ogrenci-proje-listele" && $_GET["kisi"]=="bireysel"){
                        danismanOgrenciProjeListeleme("=",@$_POST["tur"],@$_POST["durum"]);
                    }                  
                    ?>
                   <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->