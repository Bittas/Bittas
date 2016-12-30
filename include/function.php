<?php
//require_once("include/functionOgrenciTasarimBasvuru.php");
require_once("include/functionKomisyonProjeTabanliBasvuru.php");
require_once("include/functionMesajlasma.php");
require_once("include/functionOnerilenProjeler.php");
require_once("include/functionProjeOner.php");
require_once("include/functionDanismanProfilGuncelle.php");
require_once("include/functionOgrenciProfilGuncelle.php");
require_once("include/functionRaporIslemleri.php");
require_once("include/functionListeler.php");
require_once("include/functionDanismanGenelSorgular.php");
	session_start();
    
    $userId=@$_SESSION['staj']['id'];
    $ogrId=ogrenciId($userId);
	function sessionKontrol()
	{
		// session atanmamş sa login.php ye yönlendir
		if(!isset($_SESSION["staj"]))
		{
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
	   else if($sayfa=="proje-danismanb"){
           require_once("ogrenciDanismanBasvurubitirme.php");
       }///////////////////////////////////////////////////////////////////
	   else if($sayfa=="proje-danismant"){
           require_once("ogrenciDanismanBasvurutasarim.php");
       }///////////////////////////////////////////////////////////////////
       
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
        else if ($sayfa == "listele"){
			require_once("komisyonListele.php");
		}
		////////////////////////////
		
		else if ($sayfa=="danisman-raporlar") {
			require_once("danismanRaporlar.php");
		}
		else if ($sayfa=="danisman-raporlar-detay") {
			require_once("danismanRaporlarDetay.php");
		}
		else if ($sayfa=="eslesme") {
			require_once("komisyonEslesme.php");
		}
		else if ($sayfa=="ogrenci-kayit-onay") {
			require_once("danismanOgrenciKayitOnay.php");
		}
		else if ($sayfa=="ogrenci-kayit-iptal") {
			require_once("danismanOgrenciKayitIptal.php");
		}
		else if ($sayfa=="danisman-profil-duzenle") {
			require_once("danismanProfilDuzenle.php");
		}
		else if ($sayfa=="danismana-ogrenci-proje-listele") {
			require_once("danismanOgrenciProjeListeleme.php");
		}

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
        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }
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
	function ogrenciOnaylanmısProjeIdGetir($ogrenciId){
   global $conn;

        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }

   $sorgu="SELECT proje_id FROM tbl_ogrenci_proje WHERE ogrenci_id=$ogrenciId AND onay=$tur";
   $sorgu="SELECT * FROM tbl_proje AS p
LEFT JOIN tbl_ogrenci_proje AS op ON p.id=op.proje_id
WHERE p.turu=$tur AND op.onay=1 AND op.ogrenci_id=$ogrenciId";
   $sonuc =mysqli_query($conn,$sorgu);
   $proje=mysqli_fetch_array($sonuc);
   return $proje["proje_id"];
}
	function ogrenciOnaylanmısProjeDurumuGetir($ogrenciId){
   global $conn;

        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }

   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrenciId,$projeTuru);
   $sorgu="SELECT p.projedurum_id FROM tbl_proje AS p LEFT JOIN tbl_ogrenci_proje AS op ON p.id=op.proje_id WHERE op.ogrenci_id=$ogrenciId AND op.proje_id=$projeID AND p.turu=$tur";
   $sonuc =mysqli_query($conn,$sorgu);
   $proje=mysqli_fetch_array($sonuc);
   return $proje["projedurum_id"];
}



	function komisyonEslesmeGor(){
        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }
		global $conn;
		$sorgu="SELECT
p.adi AS proje_adi,
CONCAT_WS(' ',ko.adi, ko.soyadi) AS ogrenci_adi,
CONCAT_WS(' ',kd.adi, kd.soyadi) AS danisman_adi,
pd.durum
FROM tbl_ogrenci_danisman AS og
INNER JOIN tbl_proje AS p ON p.id=og.proje_id
INNER JOIN tbl_ogrenci_proje AS op ON op.proje_id=p.id
INNER JOIN tbl_ogrenci AS o ON o.id=og.ogr_id
INNER JOIN tbl_kullanici AS ko ON ko.id=o.user_id
INNER JOIN tbl_danisman AS d ON d.id=og.danisma_id
INNER JOIN tbl_kullanici AS kd ON kd.id=d.user_id
INNER JOIN tbl_projedurum AS pd ON pd.id=p.projedurum_id
WHERE og.onay=1 AND op.onay=1 AND p.turu=$tur";
		$sonuc=mysqli_query($conn,$sorgu);
		if ($sonuc) {
			while($satir=mysqli_fetch_array($sonuc)){

				echo '
                <tr>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$satir["ogrenci_adi"].'</td>
                  <td>'.$satir["danisman_adi"].'</td>
                  <td><span class="label label-success">'.$satir["durum"].'</span></td>
                </tr>
				';
			}
		}
		else
			echo "sorgu hatalı";

	}
	function danismanOgrenciKayitOnayBekleyen(){
		global $conn;
		$sorgu="SELECT k.id AS kID, o.numara AS oNo, k.mail AS oEmail FROM tbl_kullanici AS k
INNER JOIN tbl_ogrenci AS o ON o.user_id=k.id
WHERE k.rol=1 AND k.onay=0";
		$sonuc=mysqli_query($conn,$sorgu);
		if ($sonuc) {
			while($satir=mysqli_fetch_array($sonuc)){
				echo '
                <tr data-cost='.$satir["kID"].'>
                  <td>'.$satir["oNo"].'</td>
                  <td>'.$satir["oEmail"].'</td>
                  <td><input type="checkbox" class="pasif" id="'.$satir["kID"].'" onchange="OgrKayitOnay(this);"                
                   value="'.$satir["kID"].'"></td>
                </tr>
				';
			}
		}
		else
			echo "sorgu hatalı";
	}
	function danismanOgrenciKayitOnaylılar(){
		global $conn;
		$sorgu="SELECT k.id AS kID, o.numara AS oNo, k.mail AS oEmail FROM tbl_kullanici AS k
INNER JOIN tbl_ogrenci AS o ON o.user_id=k.id
WHERE k.rol=1 AND k.onay=1";
		$sonuc=mysqli_query($conn,$sorgu);
		if ($sonuc) {
			while($satir=mysqli_fetch_array($sonuc)){
				echo '
                <tr data-cost='.$satir["kID"].'>
                  <td>'.$satir["oNo"].'</td>
                  <td>'.$satir["oEmail"].'</td>
                  <td><input type="checkbox" class="pasif" checked id="'.$satir["kID"].'" onchange="OgrKayitIptal(this);"                
                   value="'.$satir["kID"].'"></td>
                </tr>
				';
			}
		}
		else
			echo "sorgu hatalı";
	}
	function optionListele($sonuc,$id,$value,$text)
	{
		if($sonuc)
		{
			while($row=mysqli_fetch_array($sonuc))
			{
				if($row["$value"]== $id)
				{
					echo "<option selected='selected' value='".$row["$value"]."'>".$row["$text"]."</option>";
				}
				else
				{
					echo "<option value='".$row["$value"]."'>".$row["$text"]."</option>";
				}
			}
		}
	}
	function ogrenciOnaylanmısProjeGetir(){
		global $ogrId;
		global $conn;
		$sorgu="SELECT p.id,p.adi,p.konu,p.kisi_sayisi,p.danisman_sayisi,pd.durum FROM tbl_ogrenci_proje AS op 
			INNER JOIN tbl_proje AS p ON p.id=op.proje_id
			INNER JOIN tbl_projedurum AS pd ON pd.id=p.projedurum_id
			WHERE op.onay=1 AND op.ogrenci_id=$ogrId AND p.turu=1";

		$sonuc=mysqli_query($conn,$sorgu);
		if ($sonuc) {
			while($satir=mysqli_fetch_array($sonuc)){
				$isimler_o = array();
				$isimler_d = array();
				$sorgu2="SELECT CONCAT_WS(' ',k.adi, k.soyadi) AS ogrenci_adi FROM tbl_ogrenci_proje AS op
					INNER JOIN tbl_ogrenci AS o ON o.id=op.ogrenci_id
					INNER JOIN tbl_kullanici AS k ON k.id=o.user_id
					WHERE op.proje_id=".$satir["id"]." AND op.onay=1";
				$sorgu3="SELECT CONCAT_WS(' ',k.adi, k.soyadi) AS d_adsoyad FROM tbl_ogrenci_danisman AS od
					INNER JOIN tbl_danisman AS d ON d.id=od.danisma_id
					INNER JOIN tbl_kullanici AS k ON k.id=d.user_id
					WHERE od.proje_id=".$satir["id"]." AND od.onay=1";
				$sonuc2=mysqli_query($conn,$sorgu2);
				$sonuc3=mysqli_query($conn,$sorgu3);
				if ($sonuc2) {
                  while($satir2=mysqli_fetch_array($sonuc2))
                  	array_push($isimler_o, $satir2["ogrenci_adi"]);
                  $isimler_o_str = implode(", ", $isimler_o);
	            }
				else
					echo "sorgu2 hatalı";
				if ($sonuc3) {
                  while($satir3=mysqli_fetch_array($sonuc3))
                  	array_push($isimler_d, $satir3["d_adsoyad"]);
                  $isimler_d_str = implode(", ", $isimler_d);
	            }
				else
					echo "sorgu3 hatalı";

				echo '
                <tr>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["konu"].'</td>';
                  echo '
                  <td><span class="label label-success" data-toggle="tooltip" data-placement="top" title="'.$isimler_o_str.'">'.$satir["kisi_sayisi"].'</span></td>
                  <td><span class="label label-success" data-toggle="tooltip" data-placement="top" title="'.$isimler_d_str.'">'.$satir["danisman_sayisi"].'</span></td>';
                  if ($satir["durum"]=="Aktif")
                  	echo '<td><span class="label label-success">'.$satir["durum"].'</span></td></tr>';
                  else
                  	echo '<td><span class="label label-danger">'.$satir["durum"].'</span></td></tr>';

                  //<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>
			
			}
		}
		else
			echo "sorgu1 hatalı";
	}
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////	
	

	
/////////////////////////////////////////////////////////////////////////////////////////////////	

	?>
