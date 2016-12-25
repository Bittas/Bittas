<?php

require_once("include/config.php");
require_once("include/function.php");

//echo ogrdanismanbasvurusu();

echo ogrdanismanbasvurusu();

function ogrdanismanbasvurusu()
{
	global $conn;
    $danismanid = $_POST['danismanid'];
    $durum = $_POST['durum'];
    $onay = $_POST['onay'];
	$proje_id =$_POST['numara'];
	$ogr_id = $_POST['ogrid'];
	$projedurum_id = "1";
/*	echo $ogr_id;
	echo $danismanid;
	echo $proje_id;*/
	
	
		if($durum == 1)
		{
		if(onay_siniri($ogr_id) > onaylanmisdanismansayisi($ogr_id,$danismanid,$proje_id) )
		{
			$query22="UPDATE tbl_ogrenci_danisman as OD SET `onay` = '$durum' 
		WHERE OD.danisma_id ='$danismanid' and OD.ogr_id='$ogr_id' and OD.proje_id='$proje_id'";
		
		if(@mysqli_query($conn,$query22))
		{
		$toplamonay=onaylanmisdanismansayisi($ogr_id,$danismanid,$proje_id);	
		return successMesaj("".$toplamonay." adet danışman başvurusu onaylandı.");
		}else{
		return errorMesaj("işlem başarısız..");
		}
		
		}else
		{
			return warningMesaj("Maksimum danışman sayısına ulaşıldı.".onay_siniri($ogr_id)."");
		}
		
		}else if($durum==0)
		{
		$query22="UPDATE tbl_ogrenci_danisman as OD SET `onay` = '$durum' 
		WHERE OD.danisma_id ='$danismanid' and OD.ogr_id='$ogr_id' 
		and OD.proje_id='$proje_id'";
		
		
		if(@mysqli_query($conn,$query22))
		{
		$toplamonay=onaylanmisdanismansayisi($ogr_id,$danismanid,$proje_id);	
		return successMesaj("danışman başvurusu iptal edildi, ".$toplamonay." adet kaldı.");
		}else{
		return errorMesaj("işlem başarısız..");
		}}			
	}
	
	
	
	
	
	
function onay_siniri($ogr_id)
{
	$query1="select P.danisman_sayisi as sayi from tbl_ogrenci as O 
	inner join tbl_ogrenci_proje as OP on OP.ogrenci_id = O.id 
	inner join tbl_proje as P on P.id = OP.proje_id
	where O.id='$ogr_id' and P.projedurum_id='1' and OP.onay='1'";
	
	global $conn;
	$sonuc=mysqli_query($conn,$query1);
	if($satir=mysqli_fetch_array($sonuc))
	$sonuc=$satir['sayi'];	

	return $sonuc;
}


function onaylanmisdanismansayisi($ogr_id,$danismanid,$proje_id)
{	
	/*$query11="select count(*) as sayi from tbl_ogrenci as O 
	inner join tbl_ogrenci_danisman as OD on O.id = OD.ogr_id 
	inner join tbl_ogrenci_proje as OP on OP.ogrenci_id = O.id 
	inner join tbl_proje as P on P.id = OP.proje_id 
	where numara='$numara' and OD.onay='1' and P.projedurum_id='1'";*/
	$query11="select count(*) as sayi from tbl_ogrenci_danisman 
	where ogr_id='$ogr_id' and onay='1' and proje_id='$proje_id'";
	global $conn;
	@$sonuc=mysqli_query($conn,$query11);
	if(@$satir=mysqli_fetch_array($sonuc))
	$toplamonay=$satir['sayi'];	

	return $toplamonay;
}
	
	
?>