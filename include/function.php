<?php
//require_once("include/functionOgrenciTasarimBasvuru.php");
require_once("include/functionKomisyonProjeTabanliBasvuru.php");
require_once("include/functionMesajlasma.php");
require_once("include/functionOnerilenProjeler.php");
require_once("include/functionProjeOner.php");
require_once("include/functionOgrenciProfilGuncelle.php");
require_once("include/functionRaporIslemleri.php");
	session_start();
    
    $userId=@$_SESSION['staj']['id'];
    $ogrId=ogrenciId($userId);
	function sessionKontrol()
	{
		// session atanmamş sa login.php ye yönlendir
		if(!isset($_SESSION["staj"])){
			session_destroy();
			header("Location:login.php");
		}
	}
    function sessionKontrolIndexPage()
	{
		// session açıksa loginden index sayfasına atlamak için
		if(isset($_SESSION["staj"])){
			header("Location:index.php");
		}
	}
	function sayfa_getir()
	{
		$sayfa =@$_GET["sayfa"];
    if($sayfa =="profil-duzenle")
    {
      if($_SESSION["staj"]["rol"] == 1){// profil düzenleme sayfaları buraya !!!
         require_once("ogrProfilDuzenle.php");
      }
    }
    else if ($sayfa=="proje-oner")
    {
      if($_SESSION["staj"]["rol"] == 2){// proje önerme sayfaları buraya !!!
        require_once("danismanProjeOner.php");
      }
    }
    else if ($sayfa=="proje-onerilen")
    {
      if($_SESSION["staj"]["rol"] == 2){// önerilen projeler sayfaları buraya !!!
        require_once("danismanProjeOnerileri.php");
      }
    }
	   else if($sayfa=="ogrenci-proje-onerme"){ 
           require_once("ogrenciProjeOnerme.php");
       }else if($sayfa=="bireysel-projeler"){
           require_once("ogrenciProjesiBasvuru.php");
       }
       else if($sayfa=="grup-projeler"){
           require_once("ogrenciProjesiBasvuru.php");
       }
       else if($sayfa=="basvurulan-projeleri"){
           require_once("ogrenciProjesiBasvuru.php");
       }
       else if($sayfa=="komisyon-proje-tabanli"){
           require_once("komisyonProjeTabanli.php");
       }
       else if($sayfa=="komisyon-proje-tabanli-detayli-gorunum"){
           require_once("komisyonProjeTabanliDetayliGorunum.php");
       }
      else if($sayfa=="tasarim-projesi"){
           require_once("tasarimProjesi.php");
       }
       else if($sayfa=="bitirme-projesi"){
           require_once("bitirmeProjesi.php");
       }
    else if($sayfa=="mesajlar"){
      require_once("mesajlar.php");
    }
    else if($sayfa=="komisyon-proje-onerileri"){
      require_once("komisyonOneriProjeDurum.php");
    }
    else if($sayfa=="rapor-islemleri"){
      require_once("ogrenciRapor.php");
    }//////////////////////////
	   else if($sayfa=="proje-danisman"){
           require_once("ogrenciDanismanBasvuru.php");
       }////////////////////////////
       
		else if($sayfa=="form-goster"){//////////////////////////////////////
			require_once("staj_form.php");
		}else if($sayfa=="danisman-islemleri"){//////////////////////////////
			require_once("danisman_islemleri.php");
		}///////
		else if ($sayfa == "ogrenci-danisman-basvurusu"){
			require_once("ogrenci_danisman_basvuru.php");
		}else if ($sayfa == "danisman-onaylama"){
			require_once("danisman_onayla.php");
		}/////////////////////////////////////////////////////////////////////
    

	}
	function errorMesaj($txt)
	{
		return " <h4 class='alert alert-danger'>$txt</h4>";
	}
    function warningMesaj($txt){
       
            return " <h4 class=' alert alert-warning alert-dismissible'>$txt</h4>";
    }
    function deleteMesaj($txt){
       
            return " <h4 class=' alert alert-danger'>$txt</h4>";
    }
	function successMesaj($txt)
	{
		return "<h4 class='alert alert-success alert-dismissible'>$txt</h4>";
	}

	function temizle($text)
	{
		$text =htmlspecialchars($text);
		return $text;
	}
	function girisYap($mail,$sifre)
	{

		$mail=temizle($mail);
		$sifre=MD5($sifre);
		global $conn;
		$query ="select * from tbl_kullanici where mail='$mail' and parola='$sifre' and onay=1"; //şifresi,mail doğru ve aktif olanlar
		$sonuc =mysqli_query($conn,$query);
		if(@mysqli_num_rows($sonuc) ==1)
		{
			$row=mysqli_fetch_array($sonuc);
			$rol=$row["rol"];
			$mail=$row["mail"];
			$id=$row["id"];
			$adi =$row["adi"];
			$soyadi =$row["soyadi"];
			$foto =$row["foto"];

			$query ="select id from tbl_mesaj where durum =0 and alici_id =$id";
			$b_sayi=0;
			if($sonuc=mysqli_query($conn,$query))
			{
				$b_sayi=mysqli_num_rows($sonuc);
			}
			$user=array("id"=>$id,"adi"=>$adi,"soyadi"=>$soyadi,"mail"=>$mail,"rol"=>$rol,"mesaj"=>$b_sayi,"foto"=>$foto);

			$_SESSION["staj"] =$user;
			header("Location: index.php");

		}else
		{
			return errorMesaj("Kullanıcı kayıtlı veya Onaylı değil.");
		}
	}
  function kaydol($email,$sifre,$no){
    $email=temizle($email);
    $sifre=md5($sifre);
    global $conn;
    $query="insert into tbl_kullanici(mail,parola,rol,onay,foto) value('$email','$sifre','1','0','profil/user.png')";
    if (@mysqli_query($conn,$query)) {
      $id = mysqli_insert_id($conn);
      $query ="";
      $query ="insert into tbl_ogrenci(numara,user_id) 
      value($no,$id)";

      if (@mysqli_query($conn,$query)) {
        return successMesaj("Kayıt işlemi başarılı");
      }
      else{
        return errorMesaj("Kayıt işlemi başarısız(öğrenci)");
      }
    }
    else{
      return errorMesaj("Kayıt işlemi başarısız(kullanici)");
    }
  }
    function ogrenciId($kullaniciId)
    {   
         global $conn;
             $query='SELECT
                      O.id AS ogrId
                    FROM
                      tbl_ogrenci AS O
                    WHERE
                     O.user_id='.$kullaniciId.'';
             $sonuc =@mysqli_query($conn,$query);
             $sutun=@mysqli_fetch_array($sonuc);
                 
             return $sutun["ogrId"];
                 
    }
    function danismanId($kullaniciId)
    {   
         global $conn;
             $query='SELECT
                      D.id AS danismanID
                    FROM
                      tbl_danisman AS D
                    WHERE
                     D.user_id='.$kullaniciId.'';
             $sonuc =@mysqli_query($conn,$query);
             $sutun=@mysqli_fetch_array($sonuc);
                 
             return $sutun["danismanID"];
                 
    }
	function ogrenciProjeOner($ogrenciId)
    {
        	global $conn;
			$padi=$_POST["adi"];
            $pkonu=$_POST["konu"];
            $ptur=$_POST["tur"];
            $kisiSayisi=$_POST["kisi"];
            $danismanSayisi=$_POST["danisman"];
            $query ="INSERT INTO tbl_proje (oneren_id, adi, konu, turu, accept_date, end_date, kisi_sayisi, danisman_sayisi, projedurum_id)	
             VALUES ('$ogrenciId','$padi','$pkonu','$ptur','0000-00-00', '0000-00-00', '$kisiSayisi', '$danismanSayisi', '0')";
			if(mysqli_query($conn,$query))
			{     
                $id=mysqli_insert_id($conn);
				  $query2='INSERT INTO `tbl_ogrenci_proje`(`ogrenci_id`, `proje_id`, `onay`)
                  VALUES ('.$ogrenciId.','.$id.',0)';
                  if(mysqli_query($conn,$query2))
					return successMesaj("Kayıt işlemi başarılı"); 
				  else
                      return errorMesaj("Sorgu hatası oluştu");
				 
            }else{
				return errorMesaj("Bir hata oluştu! Lütfen girilen karakterleri kontol ediniz...");
			}
       
				
    }
    function projeYapcakSayisi(){
        for($i=1;$i<=15;$i++){
           echo "<option value=".$i.">".$i."</option>";
           }
    }
 
    function tabloBaslik()
    { 
      $sayfa =@$_GET["sayfa"];
        if($sayfa=="tasarim-bireysel-projeler"){
                return "Bireysel Tasarim Projerleri Başvuru";
          }
         else if($sayfa=="tasarim-grup-projeler"){
             return "Grup Tasarim Projerleri Başvuru";
         }
        else if($sayfa=="basvurulan-tasarim-projeleri"){
             return "Başvurulan Tasarım Projeleri";
         } 
        else if($sayfa=="komisyon-proje-tabanli"){
             return "Öğrenci Proje Başvuruları";
         }
    }
    //Grup projeji yada Bireysel Proje Tasarım Projesi Yada Bitirme Projesi Ayarlama
    function sayfa(){
        $sayfa =@$_GET["sayfa"];
        return $sayfa;
    }
    function ogrenciProjeAlmismi($ogrId,$projeTuruId){
        global $conn;
         $query1='SELECT
                      *
                    FROM
                      tbl_ogrenci_proje AS OP
                    INNER JOIN
                      tbl_ogrenci AS O ON O.id=OP.ogrenci_id
                    INNER JOIN
                      tbl_kullanici AS K ON K.id=O.user_id
                    INNER JOIN
                      tbl_proje AS P ON P.id = OP.proje_id
                    INNER JOIN
                      tbl_projeturu AS PT ON P.turu = PT.id
                    WHERE
                      O.id ='.$ogrId.'  AND OP.onay = 1 AND PT.id ='.$projeTuruId.'';
         $sonuc1 =mysqli_query($conn,$query1);
             if(@mysqli_num_rows($sonuc1) ==1)
                 return 1;
        return 0;            
    }
function ogrenciOnaylanmısProjeIdGetir($ogrenciId,$projeTuru){
   global $conn;
   $sorgu="SELECT proje_id FROM tbl_ogrenci_proje WHERE ogrenci_id=$ogrenciId AND onay=$projeTuru";
   $sonuc =mysqli_query($conn,$sorgu);
   $proje=mysqli_fetch_array($sonuc);
   return $proje["proje_id"];
}
function ogrenciOnaylanmısProjeDurumuGetir($ogrenciId,$projeTuru){
   global $conn;
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrenciId,$projeTuru);
   $sorgu="SELECT p.projedurum_id FROM tbl_proje AS p LEFT JOIN tbl_ogrenci_proje AS op ON p.id=op.proje_id WHERE op.ogrenci_id=$ogrenciId AND op.proje_id=$projeID AND p.turu=$projeTuru";
   $sonuc =mysqli_query($conn,$sorgu);
   $proje=mysqli_fetch_array($sonuc);
   return $proje["projedurum_id"];
}
	
/////////////////////////////////////////////////////////////////////////////////////////////////	
	

	
/////////////////////////////////////////////////////////////////////////////////////////////////	
	
	function mailkont($email)
	{
		$query="SELECT * FROM `tbl_kullanici` WHERE mail='$email'";
		global $conn;
		
		$sonuc =mysqli_query($conn,$query);		
		$durum=mysqli_num_rows($sonuc);
	return $durum;
	}
	
	function danisman_ekle($email,$parola,$adi,$soyadi,$foto,$hakkimda,$rol)
	{
		$sifre=MD5($parola);	
		global $conn;
		if(mailkont($email)==0)
		{
		$query ="INSERT INTO `bittas`.`tbl_kullanici` (`id`, `adi`, `soyadi`, `mail`, `parola`, `rol`, `onay`, `foto`, `hakkimda`) VALUES ('', '$adi', '$soyadi', '$email', '$sifre', '$rol', '1', '$foto', '$hakkimda');";
		$sonuc =mysqli_query($conn,$query);
		return successMesaj("İşlem başarılı");
		}else
			return errorMesaj("Lütfen farklı bir mail adresi giriniz");
	}

	function proje_durum($tbldurum)
	{
		if($tbldurum==0)
		{
		$durum="Pasif";	
		}else if($tbldurum==1)
		{
		$durum="Aktif";
		}else if($tbldurum==2)
		{
		$durum="revize";
		}
		else if($tbldurum==3)
		{
		$durum="ret";
		}
		else if($tbldurum==4)
		{
		$durum="bitir";
		}
		return $durum;
	}
	
	function ogrenci_proje_durumu($numarasi,$adi,$soyadi,$proje_durum)
	{
		$sayac=0;
		global $conn;
		if($proje_durum==2)
		{
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id,P.projedurum_id,P.adi as proje_adi 
		,P.id as p_id FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id  INNER JOIN tbl_ogrenci_proje AS OP 
		on O.id = OP.ogrenci_id INNER JOIN tbl_proje AS P on P.id = OP.proje_id
		where O.numara='$numarasi' and K.adi= '$adi' and K.soyadi= '$soyadi'
		order by projedurum_id ";
		}else
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id,P.projedurum_id,P.adi as proje_adi 
		,P.id as p_id FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id  INNER JOIN tbl_ogrenci_proje AS OP 
		on O.id = OP.ogrenci_id INNER JOIN tbl_proje AS P on P.id = OP.proje_id
		where O.numara='$numarasi' and K.adi= '$adi' and K.soyadi= '$soyadi' 
		order by projedurum_id ";
		
		
		if($sonuc=@mysqli_query($conn,$sorgu))
		{		
		while($satir = mysqli_fetch_array($sonuc))
		{
	    $sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['id'];
		$numara = $satir['numara'];
		$p_id = $satir['p_id'];
				if($durum == "Aktif")
		{		 
		       echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				<td>
				<a href="index.php?sayfa=danisman-onaylama&pid='.$p_id.'&id='.$id.'&numara='.$numara.'&proje='.$p_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td></td></tr>';
		}	
		}
	}
	}
	 
	
	function ogrenci_proje_getir()
	{$sayac=0;
		global $conn;
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id as ogrid,P.projedurum_id,P.adi as proje_adi,
		P.id as p_id FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id 
		INNER JOIN tbl_ogrenci_proje AS OP on O.id = OP.ogrenci_id 
		INNER JOIN tbl_proje AS P on P.id = OP.proje_id where 1 order by projedurum_id ";

	if($sonuc=@mysqli_query($conn,$sorgu))
	{	
		while($satir = mysqli_fetch_array($sonuc))
		{
			$sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['ogrid'];
		$numara = $satir['numara'];
		$p_adi = $satir['proje_adi'];
		$p_id = $satir['p_id'];
		if($durum == "Aktif")
		{		 
		    echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				<td>
				<a href="index.php?sayfa=danisman-onaylama&pid='.$p_id.'&id='.$id.'&numara='.$numara.'&proje='.$p_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td></td></tr>';
		}
		}
	}

}	




function ogrenciprojekontrol()
{
	global $conn;
	global $ogrId;
	$sayi=0;
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci as O
	inner join tbl_ogrenci_proje as OP on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where P.projedurum_id='1' and O.id='$ogrId' and OP.onay='1'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['sayi'];	
	}
	return $sayi;
}

function danismankontrol()
{
	global $conn;
	global $ogrId;
	$sayi=0;
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci_danisman as OD
where OD.ogr_id='$ogrId' and OD.onay='1' and OD.projedurum_id='1'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['sayi'];	
	}
	return $sayi;
}

function projedanismansayisi()
{
global $conn;
	global $ogrId;
	$sayi=0;
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci_proje as OP
	inner join tbl_ogrenci as O on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where OP.ogr_id='$ogrId' and OP.onay='1' and P.projedurum_id='1'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['sayi'];	
	}
	return $sayi;
}



function ogrencidanismanBasvuru()
{
	global $conn;
	global $ogrId;
	$sayi=0;
	if(ogrenciprojekontrol() > 0)
	{
	if( danismankontrol() < projedanismansayisi() )
	{		
	$query="SELECT K.adi,K.soyadi,D.id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K on D.user_id = K.id";
		
	   if(@$sonuc =mysqli_query($conn,$query))
	   {	
	       while($sutun=mysqli_fetch_array($sonuc))
		   {   
			$query2 ="SELECT count(*) as sayi FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']." and projedurum_id='1'";
			  
        $sonuc2 =mysqli_query($conn,$query2);
		if($sutun2=mysqli_fetch_array($sonuc2))
		{$sayi=$sutun2["sayi"];
		}
		if($sayi>0){
			echo '<tr>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   checked></td></tr>';
        }else{
		echo '<tr>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   ></td></tr>';
			}	}  } 
	}else
	{
		echo errorMesaj("Danışman başvuru işleminiz komisyon tarafından onaylandı.
		Tekrar başvuru yapamazsınız..");
	}			
	}else 
	{
				echo errorMesaj("Danışman başvurusu için aktif projeniz olması gerekir.  
				Lütfen önce proje başvurusu yapınız...");
	}
}

function ogrencidanismanBasvurutumDanismanlar($adi,$soyadi)
{
	global $conn;
	global $ogrId;
	
	if(ogrenciprojekontrol() > 0)
	{
	if( danismankontrol() < projedanismansayisi() )
	{
	$query="SELECT K.adi,K.soyadi,OD.onay,OD.danisma_id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K
			on D.user_id = K.id inner join
			tbl_ogrenci_danisman as OD on
			OD.danisma_id = D.id 
			where K.adi='$adi' and K.soyadi='$soyadi'";
		
	   if(@$sonuc =mysqli_query($conn,$query))
	   {	
	       while($sutun=mysqli_fetch_array($sonuc)){   
			$query2 ="SELECT * FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']."";
			  
        $sonuc2 =mysqli_query($conn,$query2);
		if(@mysqli_num_rows($sonuc2) ==1) echo "checked";
			echo '<tr>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'"';
                  if(@mysqli_num_rows($sonuc2) ==1) echo "checked";
                  echo 'onchange="danismanbasvuru(this);"  value="'.$ogrId.'"></td></tr>';
	       }
        }
	}else{
		echo errorMesaj("Danışman başvuru işleminiz komisyon tarafından onaylandı.
		Tekrar başvuru yapamazsınız..");
	}
	}else{
				echo errorMesaj("Danışman başvurusu için aktif projeniz olması gerekir.  
				Lütfen önce proje başvurusu yapınız...");
	}
	}
?>
