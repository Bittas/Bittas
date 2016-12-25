<?php

 require_once("include/config.php");
 require_once("include/function.php");


function ogrproje_id(){
	global $conn;
	global $ogrId;

	$sayi=0;
	$sql= "SELECT P.id FROM tbl_ogrenci_proje as OP
	inner join tbl_ogrenci as O on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where OP.ogrenci_id='$ogrId' and OP.onay='1' and P.projedurum_id='1'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['id'];	
	}
	return $sayi;
}

 

echo ogrenciDanismanBasvur();
function ogrenciDanismanBasvur(){
global $conn;
global $ogrId;

$OD_id = ($_POST['OD_id']);
$check=($_POST['active']);
$proje_id=ogrproje_id();

    if($check==1){
        $query ="INSERT INTO `tbl_ogrenci_danisman`
		(`ogr_id`, `danisma_id`, `onay`,`proje_id`) VALUES ($ogrId,$OD_id,0,$proje_id)";
		
		$query2="select * from tbl_ogrenci_danisman where 
				ogr_id='$ogrId' and danisma_id='$OD_id' and $proje_id and onay='1'";			
		$sonuc=@mysqli_query($conn,$query2);
		if(mysqli_num_rows($sonuc))
		{
			return warningMesaj("Danışman başvurunuz komisyon tarafından daha önce onaylandı.."); 
		
		}else{			
		
		if(mysqli_query($conn,$query)){
			return successMesaj("Danışman başvurusu yapıldı.."); 
		
		}else{
			return errorMesaj("Danışman başvurusu yapılamadı..");
		}
	}
	}
		
     if($check==0){
    
        $query ="DELETE FROM `tbl_ogrenci_danisman` 
		WHERE ogr_id=$ogrId AND danisma_id=$OD_id and proje_id='$proje_id' and onay='0'";
		
		$query1="select * from tbl_ogrenci_danisman where 
		ogr_id='$ogrId' and danisma_id='$OD_id' and $proje_id and onay='1'";
		$sonuc=@mysqli_query($conn,$query1);
		if(mysqli_num_rows($sonuc))
		{
			return warningMesaj("Danışman başvurunuz komisyon tarafından daha önce onaylandığı için silinemedi.."); 
		
		}
		else{
            if(mysqli_query($conn,$query)==1)
			{
				return deleteMesaj("Danışman Başvurusu iptal edildi.."); 
			
            }
            else{
				return errorMesaj("Danışman Başvurusu iptal edilemedi..");
			}
		}
	}
}

?>