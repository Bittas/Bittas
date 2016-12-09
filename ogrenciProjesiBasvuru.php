

<span id="sonuc"></span>
 
<input type="text" class="hidden page" name="<?php echo sayfa(); ?>" />
<div class="container">
  <form class="form-inline" action="" method="post">
    <div class="form-group">
      <label for="oneren">Öneren Kişi:</label>
      <input type="text" class="form-control" name="oneren"  placeholder="İsim Giriniz...">
    </div>
    <div class="form-group">
      <label for="proje adi">Proje Adı:</label>
      <input type="text" class="form-control" name="adi" placeholder="Proje Adını Giriniz...">
    </div>
    <div class="form-group">
      <label for="danışman sayisi">Danışman Sayısı:</label>
      <input type="text" class="form-control" name="kisi" placeholder="Sayı Giriniz...">
    </div>
    <div class="form-group">
           <label class="control-label" for="projeler">Projer:</label>         
        <select class="form-control" name="projeler"  id="projeler" onChange="listeleme(this);">
            <option value="2">Tümü</option>
            <option value="1">Başvurulanlar</option>
            <option value="0">Başvurulmayanlar</option>
        </select>
    </div> 
    <input type="submit" class="btn  btn-success" name="listele" value="Listele"/>
  </form>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Projeyi Öneren</th>
                  <th>Proje Adı</th>
                  <th>Konu</th>
                  <th>Kişi Sayısı</th>
                  <th>Danışman Sayısı</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $sayfa=sayfa();
                    if(@$_POST["listele"] && $sayfa=="bireysel-projeler" ){
                        ogrenciProjeBasvuruListeleDetayli("=");
                    }
                    else if(@$_POST["listele"] && $sayfa=="grup-projeler"){
                        ogrenciProjeBasvuruListeleDetayli(">");
                    }
                    else if($sayfa=="bireysel-projeler")
                       ogrenciProjeBasvuruListeleHepsi("=");
                    else if($sayfa=="grup-projeler")
                       ogrenciProjeBasvuruListeleHepsi(">");
                   else if($sayfa=="basvurulan-projeleri"){
                       ogrenciTumProjeBasvurulariniListele();
                       echo '<script> $(".container").remove(); </script>';
                       }
                    ?>
                   <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->