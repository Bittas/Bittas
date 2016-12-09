<span id="sonuc"></span>
 
<input type="text" class="hidden page" name="<?php echo sayfa(); ?>" />
<div class="container">
  <form class="form-inline" action="" method="post">
   <div class="form-group">
      <label for="ogrenci numara">Numara:</label>
      <input type="text" class="form-control" name="ogrenciNumara" placeholder="Numara Giriniz...">
   </div>
   <div class="form-group">
      <label for="ogrenci adi">Öğrenci Adı:</label>
      <input type="text" class="form-control" name="ogrenciAdi" placeholder="Ad Giriniz...">
    </div>
    <div class="form-group">
        <label class="control-label" for="projeTuru">Proje Türü:</label>         
        <select class="form-control" name="projeTuru"  id="projeTuru" onChange="applicantsStudentList(this);">
            <option value="1">Tasarım Projeleri</option>
            <option value="2">Bitirme Projeleri</option>
            <option value="3">Bitirme(Tasarım) Projeleri</option>
        </select>
    </div> 
    <div class="form-group">
        <label class="control-label" for="onay">Onay:</label>         
        <select class="form-control" name="onay"  id="onay" onChange="applicantsStudentList(this);">
            <option value="">Tümü</option>			
            <option value="0">Onaylanmayanlar</option>
            <option value="1">Onaylananlar</option>
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
              <table id="databaseTablo" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sıra</th>
                  <th>Öğrenci Numarası</th>
                  <th>Öğrenci Adı</th>
                  <th>Öğrenci Soyadı</th>
                  <th>Başvuru Proje Türü</th>
                  <th>Onay</th>
                  <th>Detay</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $sayfa=sayfa();
                     if(@$_POST["listele"] && $sayfa=="komisyon-proje-tabanli"){
                       commissionSearchApplicantStudentList();
                    }
                    else if($sayfa=="komisyon-proje-tabanli")
                       komisyonProjeBasvuruListeleHepsi();
                    ?>
                   <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->