<span id="sonuc"></span> 
 
 <input type="text" class="hidden page" name="<?php echo sayfa(); ?>" />
<div class="container">
  <form class="form-inline" action="" method="post">
 <div class="form-group">
      <label for="dadi">Adı:</label>
      <input type="text" class="form-control" name="dadi"  placeholder="Danışm adı..">
    </div>
    <div class="form-group">
      <label for="dasoyadi">Soyadı:</label>
      <input type="text" class="form-control" name="dasoyadi" placeholder="Danışman soyadı..">
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
                <tr><th>Sıra</th>
                  <th>Adı</th>
                  <th>Soyadı</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                    <?php
						$sayfa=sayfa();	
				$turu =ogrenci_proje_bilgisi();		
				if($turu == 2 or $turu == 3 )
				{					
                    if(@$_POST["listele"] && $_POST['dadi']=="" && $_POST['dasoyadi']==""){
						ogrencidanismanBasvuru($turu);
                    }
                   else if(@$_POST["listele"] && $_POST['dadi']!="" && $_POST['dasoyadi']!="")
				   {
                       ogrencidanismanBasvurutumDanismanlar($_POST['dadi'],$_POST['dasoyadi'],$turu);
                      // echo '<script> $(".container").remove(); </script>';
                   }else if(@$_POST["listele"] && $_POST['dadi']!="" && $_POST['dasoyadi']=="" )
				   {
                       ogrencidanismanBasvurutumDanismanlar1($_POST['dadi'],$turu);
                   }
				   else if(@$_POST["listele"] && $_POST['dasoyadi']!="" && $_POST['dadi']=="" )
				   {
                       ogrencidanismanBasvurutumDanismanlar2($_POST['dasoyadi'],$turu);
                   }
				}else
					echo errorMesaj("Danışman başvurusu için aktif bitirme projeniz olması gerekir.  
				Lütfen önce bitirme projesi başvurusu yapınız...");
					?>
                   <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

		  