	<?php
	$sonuc="";
	if(@$_POST["ekle"])
	{
		$email =@$_POST["email"];
		$parola =@$_POST["parola"];
        $rol="2";
		$adi =@$_POST["adi"];
		$soyadi =@$_POST["soyadi"];
		$foto ="profil/".$_POST['file-2']."";
		$hakkimda =@$_POST["hakkimda"];
		$uni=@$_POST["uni"];
		$unvan=@$_POST["unvan"];
		$tc=@$_POST["tc"];
		
		if ($email !="" and $parola !="" and $adi !="" and $soyadi !="" and $foto !="" and 
		$hakkimda !="" and $uni !="" and $unvan !="" and $tc !="" )
		{
		$sonuc=danisman_ekle($email,$parola,$adi,$soyadi,$foto,$hakkimda,$rol,$uni,$unvan,$tc);
		echo $sonuc;
		}else
		echo errorMesaj("Lütfen boşlukları doldurunuz");
					
	}
?>
</script>
		<h2> Danışman Ekle</h2>
	<form class="form-inline" action="" method="post"><br/>
	<table >
	<tr><td><div class="form-group">
      <label for="adi">Adı:</label></td><td>
      <input type="text" class="form-control" name="adi" placeholder="Adı" size="40">
    </div></td></tr>
	
	<tr><td><br/><div class="form-group">
      <label for="soyadi">Soyadı:</label></td><td><br/>
      <input type="text" class="form-control" name="soyadi" placeholder="Soyadı" size="40">
    </div><br/></td></tr>
	
	<tr><td><br/><div class="form-group has-feedback">
      <label for="email">Email:</label></td><td><br/>
      <div class="form-group has-feedback">
    <input type="email" class="form-control" name="email" placeholder="E-mail" size="35" required/>
	  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div></div><br/></td></tr>
	
	<tr><td><br/><div class="form-group has-feedback">
      <label for="parola">Şifre:</label></td><td><br/>
      <div class="form-group has-feedback">	
		<input type="password" class="form-control" name="parola" placeholder="parola" size="35" required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div></div><br/></td></tr>
		
	<tr><td><br/><div class="form-group">
      <label for="tc">Tc Kimlik No:</label></td><td><br/>
      <input type="text" class="form-control" name="tc" placeholder="kimlik numarası" size="40">
    </div><br/></td></tr>		

	<tr><td><br/><div class="form-group ">
<label for="uni">Üniversite Seç:</label></td><td><br/>
      <div class="form-group ">	
		<select name="uni" class="form-control">
  <option value="" disabled selected>Üniversite Seçiniz</option>
  <option value="1">Karadeniz Teknik Üniversitesi</option>
  <option value="2">Sakarya Üniversitesi</option>
</select>
</div></div><br/></td></tr>			
	
	<tr><td><br/>
	<div class="form-group ">
      <label for="unvan">Ünvan:</label></td><td><br/>
      <div class="form-group ">	
		<select name="unvan" class="form-control">
  <option value="" disabled selected>Ünvan seçiniz</option>
  <option value="Öğretim Görevlisi">Öğretim Görevlisi</option>
  <option value="Yardımcı Doçent Doktor">Yardımcı Doçent Doktor</option>
  <option value="Doçent Doktor">Doçent Doktor</option>
  <option value="Araştırma Görevlisi">Araştırma Görevlisi</option>
</select>
</div></div><br/></td></tr>	
	
	<tr><td><br/><div class="form-group has-feedback">
    <label for="file-2">Fotoğraf:</label></td><td><br/>
	<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
	<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Fotograf Seçin&hellip;</span></label>
	</div><br/></td></tr>
	
	<tr><td><br/><div class="form-group">
    <label for="hakkimda">Hakkında:</label></td><td><br/>
	<textarea name="hakkimda" class="form-control" cols="45" rows="7" placeholder="danışman hakkında bilgileri yazınız"></textarea>
    </div><br/></td></tr>
	
	<tr><br/><div class="form-group"><td></td><td><br/>
	<input type="submit" class="btn  btn-success" name="ekle" value="Ekle" />
	</div><br/></td></tr></table></form>
    <script src="js/uploadfilejs/custom-file-input.js"></script>
