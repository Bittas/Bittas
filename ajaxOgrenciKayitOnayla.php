<?php

 require_once("include/config.php");
 require_once("include/function.php");
 echo danismanOgrenciKayitOnayla();

	function danismanOgrenciKayitOnayla(){
    global $conn;
    $kullaniciID = $_POST['id'];
    $pasifYap = $_POST['pasifYap'];
         if($pasifYap==1){ 
            $query2="UPDATE tbl_kullanici AS k SET k.onay=1 WHERE k.id=$kullaniciID";
                if(mysqli_query($conn,$query2)==1)
                { 
                    return successMesaj("Kayıt onaylanmıştır."); 

                }else{
                    return errorMesaj("Bir hata oluştu.");
                } 
        }
	}
?>