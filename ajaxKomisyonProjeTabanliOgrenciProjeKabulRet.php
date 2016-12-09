<?php

 require_once("include/config.php");
 require_once("include/function.php");


echo ogrenciProjeBasvur();



function ogrenciProjeBasvur(){
    global $conn;
    $ogrId = $_POST['ogrId'];
    $basvuruId = $_POST['basvuruId'];
    $projeId = $_POST['projeId'];
    $check=$_POST['active'];
    $projeTuruId=$_POST['projeTuruId'];
    if($check==1){        
              $query2='SELECT *
                        FROM
                          tbl_proje AS P
                        WHERE
                        P.id='.$projeId .' AND P.kisi_sayisi <= (SELECT COUNT(*)  FROM  tbl_ogrenci_proje AS OP WHERE  OP.proje_id ='.$projeId .' AND OP.onay =1) ';
              $query3='UPDATE
                          tbl_ogrenci_proje AS OP
                          JOIN
                         tbl_proje AS P ON OP.proje_id=P.id
                        SET
                          OP.onay = 1,
                          P.accept_date="'.date("Y/m/d").'"
                        WHERE
                          OP.id ='.$basvuruId.'';
        
              $sonuc2 =mysqli_query($conn,$query2);
             if(1==ogrenciProjeAlmismi($ogrId,$projeTuruId))     
                 return warningMesaj("Bu Öğrenci Daha Önceden Proje Almış...");    
             if(@mysqli_num_rows($sonuc2) ==1)     
                 return warningMesaj("Seçilen proje dolu ..."); 
             if(mysqli_query($conn,$query3)==1)
             {  
                   return successMesaj("Öğrencinin Projesi Seçildi...");  

             }else{
                 return errorMesaj("Bir hata oluştu.".$basvuruId);
             } 
                 
              
        }
         if($check==0){ 
             //Eğer uyarılardan dolayı seçilmemiş ise boş tik için kaldırıldı mesajı verilmemisi için query1 i yazdım.
            $query1='SELECT *
                    FROM
                      tbl_ogrenci_proje AS OP
                    INNER JOIN
                      tbl_proje AS P ON P.id = OP.proje_id
                    INNER JOIN
                      tbl_projeturu AS PT ON P.turu = PT.id
                    WHERE
                      OP.ogrenci_id ='.$ogrId.' AND OP.onay = 1 AND  PT.id ='.$projeTuruId.' AND OP.id='.$basvuruId.'';
             $sonuc1 =mysqli_query($conn,$query1);
            $query2='UPDATE tbl_ogrenci_proje AS OP SET OP.onay = 0  WHERE OP.id='.$basvuruId .'';
           if(@mysqli_num_rows($sonuc1)==1)
                if(mysqli_query($conn,$query2)==1)
                { 
                   
                    return deleteMesaj("Proje Kaldırıldı..."); 

                }else{
                    return errorMesaj("Bir hata oluştu.");
                } 
        }
}


?>