<?php

 require_once("include/config.php");
 require_once("include/function.php");


echo ogrenciProjeBasvur();
function ogrenciProjeBasvur(){
global $conn;
global $ogrId;

$OD_id = ($_POST['OD_id']);
$check=($_POST['active']);

    if($check==1){      
        $query ="INSERT INTO `tbl_ogrenci_danisman`
		(`ogr_id`, `danisma_id`, `onay`,`projedurum_id`) VALUES ($ogrId,$OD_id,0,1)";
			if(mysqli_query($conn,$query))
			{
				return successMesaj("Danışman başvurusu yapıldı"); 
			
            }else{
				return errorMesaj("işlem hatalı");
			}
    }
     if($check==0){
    
        $query ="DELETE FROM `tbl_ogrenci_danisman` 
		WHERE ogr_id=$ogrId AND danisma_id=$OD_id and projedurum_id='1'";
		
            if(mysqli_query($conn,$query)==1)
			{
				return deleteMesaj("Danışman başvurusu Kaldırıldı..."); 
			
            }else{
				return errorMesaj("işlem hatalı");
			} 
    }
}







?>