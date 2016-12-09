<?php
//require_once("include/functionOgrenciTasarimBasvuru.php");
require_once("include/functionKomisyonProjeTabanliBasvuru.php");
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
	   if($sayfa=="ogrenci-proje-onerme"){ 
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
    {   $sayfa =@$_GET["sayfa"];
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
?>
