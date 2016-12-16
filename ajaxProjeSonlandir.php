<?php

 require_once("include/config.php");
 require_once("include/function.php");


 echo ogrenciProjesiniSonlandir();



function ogrenciProjesiniSonlandir(){
    global $conn;
    $projeId = $_POST['id'];
    $pasifYap = $_POST['pasifYap'];
         if($pasifYap==1){ 
            $query2='UPDATE tbl_proje AS P SET P.projedurum_id = 4  WHERE P.id='.$projeId .'';
                if(mysqli_query($conn,$query2)==1)
                { 
                    return successMesaj("Proje Bitti..."); 

                }else{
                    return errorMesaj("Bir hata oluştu.");
                } 
        }
}


?>