<div class="container">
  <form class="form-inline" action="" method="post">
   <div class="form-group">
      <label for="numarasi">Numara:</label>
      <input type="text" class="form-control" name="numarasi" placeholder="Numara">
    </div>
    <div class="form-group">
      <label for="adi">Adı:</label>
      <input type="text" class="form-control" name="adi" placeholder="Adı">
    </div>
    <div class="form-group">
      <label for="soyadi">Soyadı:</label>
      <input type="text" class="form-control" name="soyadi" placeholder="Soyadı">
    </div>
	<div class="form-group">
        <label class="control-label" for="projeTuru">Proje Türü:</label>         
       <select name="proje_durum" class="form-control" >
	<option value="3" disabled selected>Durum Seçiniz</option>
	<option value="2">Hepsi</option>
	<option value="1">Onaylanmış</option>
	<option value="0">Onaylanmamış</option>
	</select>
    </div> 
	 <input type="submit" class="btn  btn-success" name="gonder" value="Listele"/>
	</form>
	<div>
	<style style="text/css">
    .hoverTable tr:hover {
        background-color: #3c8dbc;
    }
	</style>
  <div class="box">
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Sıra</th>
                  <th>Numarası</th>
                  <th>Adı</th>
                  <th>Soyadı</th>
                  <th>Proje Adı</th>
                  <th>Proje Durumu</th>
				  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
<?php
	function basvuru_listele()
	{
	if(@$_POST["gonder"])
	{
		$numarasi =@$_POST["numarasi"];
		$adi =@$_POST["adi"];
		$soyadi =@$_POST["soyadi"];
		$proje_durum =@$_POST["proje_durum"];
		
		if($numarasi !="" and $adi !="" and $soyadi !="" and $proje_durum !="" and $proje_durum !="3")
		{
		$sonuc = ogrenci_proje_durumu($numarasi,$adi,$soyadi,$proje_durum);
		}
		else if($numarasi =="" and $adi =="" and $soyadi =="" and $proje_durum =="" and $proje_durum =="")
		{		
		$sonuc = ogrenci_proje_getir();
		//echo "2";
		}else
		{
			return errorMesaj("Lütfen bilgilerinizi kontrol ediniz..");	
		}	
		return $sonuc;
	}
	}
	$sonuc=basvuru_listele();
	echo $sonuc;
?>
                  <span id="listeleme"></span>
              </table>
            </div>
            <!-- /.box-body -->
          </div>