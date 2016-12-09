<?php

 require_once("include/config.php");
 require_once("include/function.php");


echo ogrenciProjeBasvur();
function ogrenciProjeBasvur(){
global $conn;
global $ogrId;
    
$projeId = ($_POST['projeId']);
$check=($_POST['active']);

    if($check==1){
       echo '<script>  alert("Eklendi"); </script>';       
        $query ="INSERT INTO `tbl_ogrenci_proje`(`ogrenci_id`, `proje_id`, `onay`) VALUES ($ogrId,$projeId,0)";
			if(mysqli_query($conn,$query))
			{
				return successMesaj("Kayıt işlemi başarılı"); 
			
            }else{
				return errorMesaj("Bir hata oluştu.");
			}
    }
     if($check==0){
       echo '<script>  alert("Silindi"); </script>';
        $query ="DELETE FROM `tbl_ogrenci_proje` WHERE ogrenci_id=$ogrId AND proje_id=$projeId";
		
            if(mysqli_query($conn,$query)==1)
			{
				return deleteMesaj("Proje Kaldırıldı..."); 
			
            }else{
				return errorMesaj("Bir hata oluştu.");
			} 
    }
}


?>