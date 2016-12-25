<?php
if(@$_POST["sil"]){
			global $conn;
			$id=$_POST["anid"];
			$query5 = "delete from tbl_foto where id=$id";
			$sonuc5 = mysqli_query($conn,$query5);
	
	
}
if (@$_POST["profilduzenle"]) {
  echo profilGuncelleDanisman();
}
	$id =$_SESSION["staj"]["id"];
	global $conn;
  $query_profil="SELECT * from tbl_kullanici as k inner join tbl_danisman as d on k.id=d.user_id where k.id='$id'";
			
	$kisi_sonuc=mysqli_query($conn,$query_profil);
	$kisi =mysqli_fetch_array($kisi_sonuc);
?>
<center>
        <div class="col-md-6" >
        
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
			<div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo $kisi["foto"];?>" alt="User profile picture">
              <input type="file" name="foto" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
   <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Profil resmi seçin&hellip;</span></label>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">E-Posta</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="mail" id="inputEmail3" placeholder="Email" value="<?php echo $kisi["mail"]; ?>"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Şifre</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="parola" id="inputPassword3" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ad</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ad" id="inputEmail3" placeholder="Ad" value="<?php echo $kisi["adi"]; ?>"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Soyad</label>

                  <div class="col-sm-10">
                    <input type="text" name="soyad" class="form-control" id="inputPassword3" placeholder="Soyad" value="<?php echo $kisi["soyadi"]; ?>"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">TC</label>

                  <div class="col-sm-10">
                    <input type="text" name="tc" class="form-control" id="inputPassword3" placeholder="Tc" value="<?php echo $kisi["tc"]; ?>"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Unvan</label>

                  <div class="col-sm-10">
                    <input type="text" name="unvan" class="form-control" id="inputPassword3" placeholder="Unvan" value="<?php echo $kisi["unvan"]; ?>"/>
                  </div>
                </div>
        <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Üniversite</label>

                  <div class="col-sm-10">
                    <select name="uni" id="uni" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                   <option value="-1">Üniversite Seç</option>
             <?php
                $query_uni ="Select id, uni_adi from tbl_uni";
                $uni_sonuc =mysqli_query($conn,$query_uni);
                optionListele($uni_sonuc ,$kisi["uni_id"],"id","uni_adi");
              ?>
          </select>
                  </div>
                </div>
           <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Hakkımda</label>

                  <div class="col-sm-10">
                    <textarea name="hakkimda"  class="form-control" rows="4"><?php echo $kisi["hakkimda"]; ?></textarea>
                  </div>
                </div>
              
                
                <input type="submit" name="profilduzenle" class="btn btn-info pull-right" value="Güncelle"/>
           
              <!-- /.box-footer -->
            </form>
			<div style="width:100%;">
			<?php
			
					global $conn;
					$query4 = "SELECT * from tbl_foto where user_id=".$_SESSION["staj"]["id"];
					$sonuc4 = mysqli_query($conn,$query4);
					if($sonuc4)
					{	
						$k=0;
						while ($row4 = mysqli_fetch_array($sonuc4)) {
							?>
							<form action="" method="POST" style="width:160px; float:left;"><br/>
							<div style="width:150px;">
							<img class="profile-user-img img-responsive " src="<?php echo $row4["foto"];?>" alt="User profile picture">
							<input type="submit" name="sil" class="btn btn-info pull-right" value="Sil"/>
							 <input type="hidden" name="anid" value="<?php echo $row4["id"]; ?>" />
							 </div>
							</form>
							<?php
		
					}
					
					}
			?>
			
				</div>
			
			
		</div>
	</center>