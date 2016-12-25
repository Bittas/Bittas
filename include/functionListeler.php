<?php

function projeListele($kisi,$tur){
     global $conn;  
     $query='SELECT
              *
            FROM
              tbl_proje AS P
            WHERE
              P.turu='.$tur.' AND P.kisi_sayisi'.$kisi.'1 AND P.projedurum_id=1
              ';
     $sonuc2 =mysqli_query($conn,$query);
            $satir=0;
	       while($sutun=mysqli_fetch_array($sonuc2)){     
               echo '<tr>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["konu"].'">'.$sutun["konu"].'</td>
                  <td title="'.$sutun["kisi_sayisi"].'">'.$sutun["kisi_sayisi"].'</td>                 
                  <td title="'.$sutun["danisman_sayisi"].'">'.$sutun["danisman_sayisi"].'</td> 
                   <td title="'.$sutun["accept_date"].'">'.$sutun["accept_date"].'</td>  
                  <td><input type="checkbox" class="pasif"  id="'.$sutun["id"].'"   onchange="sonlandir(this);"                
                   value="'.$sutun["id"].'"></td>
                  </tr>';
           }
}
function danismanOgrenciProjeListeleme($kisi,$tur,$durum){
   
     global $conn;  
     $query='SELECT
              P.id AS projeId,
              O.numara AS numara,
              K.adi AS ogrAdi,
              K.soyadi AS ogrSoyadi,
              P.adi AS projeAdi,
              P.konu AS projeKonu,
              P.kisi_sayisi AS kisiSayisi,
              P.danisman_sayisi AS danismanSayisi,
              P.accept_date AS acceptDate,
              p.end_date AS endDate
            FROM
              tbl_proje AS P
            INNER JOIN
              tbl_ogrenci_proje AS OP ON OP.proje_id = P.id
            INNER JOIN
              tbl_ogrenci AS O ON O.id = OP.ogrenci_id
            INNER JOIN
              tbl_kullanici AS K ON K.id = O.user_id
            WHERE
              OP.onay = 1 AND  P.turu='.$tur.' AND P.kisi_sayisi'.$kisi.'1 AND P.projedurum_id='.$durum.'
            ORDER BY OP.proje_id
           
              ';
    $currentId=0; $sayac=0;
     $sonuc =mysqli_query($conn,$query);
	       while(@$sutun=mysqli_fetch_array($sonuc)){
                 if($sayac==0){
                      $currentId=$sutun["projeId"];
                      $sayac=1;
                 }
               if($sutun["projeId"]!=$currentId){
                   echo "<tr><td colspan=9 style='background-color:#aaabad'></td></tr>";
                   $currentId=$sutun["projeId"];
               } 
                 echo '<tr>
                  <td title="'.$sutun["numara"].'">'.$sutun["numara"].'</td>
                  <td title="'.$sutun["ogrAdi"].'">'   .$sutun["ogrAdi"].'</td>
                  <td title="'.$sutun["ogrSoyadi"].'">'.$sutun["ogrSoyadi"].'</td>
                  <td title="'.$sutun["projeAdi"].'">'   .$sutun["projeAdi"].'</td>                 
                  <td title="'.$sutun["projeKonu"].'">'  .$sutun["projeKonu"].'</td>                 
                  <td title="'.$sutun["kisiSayisi"].'">'.$sutun["kisiSayisi"].'</td>                 
                  <td title="'.$sutun["danismanSayisi"].'">'.$sutun["danismanSayisi"].'</td> 
                  <td title="'.$sutun["acceptDate"].'">'.$sutun["acceptDate"].'</td>
                  <td title="'.$sutun["endDate"].'">'.$sutun["endDate"].'</td>
                  </tr>';
             
           }
    }
?> 