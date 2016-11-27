<?php
	session_start();

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
			if($_SESSION["staj"]["rol"] == 1){
				 require_once("ogrProfilDuzenle.php");
			}else if($_SESSION["staj"]["rol"] == 2){
				 require_once("danismanProfilDuzenle.php");
			}else if($_SESSION["staj"]["rol"] == 3){
				require_once("isyeriProfilDuzenle.php");
			}
		}
		else if($sayfa=="form-goster"){
			require_once("staj_form.php");
		}
		else if($sayfa=="profil-goster"){
			if($_SESSION["staj"]["rol"] == 1){
				 require_once("ogrenciProfilGor.php");
			}else if($_SESSION["staj"]["rol"] == 2){
				 require_once("danismanProfilGor.php");
			}else if($_SESSION["staj"]["rol"] == 3){
				require_once("isyeriProfilGor.php");
			}
		}
		else if($sayfa=="mesajlar"){
			require_once("brojem.php");
		}
		else if($sayfa=="projeler-goster"){
			require_once("projeGoster.php");
		}
		else if($sayfa=="projeler-ekle"){
			require_once("projeEkle.php");
		}
		else if($sayfa=="duyurular-goster"){
			require_once("duyuruGoster.php");
		}
		else if($sayfa=="duyurular-ekle"){
			require_once("duyuruEkle.php");
		}
		else if($sayfa=="iletisim"){
			require_once("iletisim.php");
		}
		else if($sayfa=="iletisim"){
			require_once("iletisim.php");
		}
		else if($sayfa=="basvurular-yap"){
			require_once("basvur.php");
		}
		else if($sayfa=="basvurular-goster"){
			if ($_SESSION["staj"]["rol"]==1)
				require_once("ogrenci_basvuru_goster.php");
			else
				require_once("basvurular.php");
		}
		else if($sayfa=="hakkinda"){
			require_once("hakkinda.php");
		}
		else if($sayfa=="basvurular-gecmis"){
			require_once("basvurugecmisi.php");
		}
		else if($sayfa=="staj_eslesmeleri"){
			require_once("danisman_staj_gor.php");
		}
		else if($sayfa=="staj_sonuclananlar"){
			require_once("danisman_staj_gor.php");
		}
		else if($sayfa=="staj_beklenenler"){
			require_once("danisman_staj_gor_beklenenler.php");
		}
		else if($sayfa=="profil-gor"){
			require_once("profilgor.php");
		}
		else if($sayfa=="ogrenci-goster"){
			require_once("danismanogrencionayla.php");
		}
		else if($sayfa=="ogrenci-listem"){
			require_once("danismanogrencilistesi.php");
		}else if($sayfa=="arama"){
			require_once("arama.php");
		}
		else if($_SESSION["staj"]["rol"] == 1){
			 require_once("ogrenciProfilGor.php");
		}else if($_SESSION["staj"]["rol"] == 2){
			 require_once("danismanProfilGor.php");
		}else if($_SESSION["staj"]["rol"] == 3){
			require_once("isyeriProfilGor.php");
		}else
        {
            require_once("index.php");
        }

	}

	function errorMesaj($txt)
	{
		return " <h4 class='alert_error'>$txt</h4>";
	}

	function successMesaj($txt)
	{
		return "<h4 class='alert_success'>$txt</h4>";
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
	 function islemler()
	{
		if(@$_POST["profilduzenle"])
		{
			return profilGuncelle();
		}
		else if(@$_POST["danismanProfilDuzenle"])
		{
			return danismanprofilGuncelle();
		}
		else if(@$_POST["komisyonGuncelle"])
		{
			return komisyonprofilGuncelle();
		}
	}
?>
