<?php
 require_once("include/config.php");
 require_once("include/function.php");
$projeTuru=0;
global $ogrId;
//Öğrenci Id ve Turu ==1 ise almış 
 if(ogrenciProjeAlmismi($ogrId,1)!=1)//Almış ise
    $projeTuru=1;
 else if(ogrenciProjeAlmismi($ogrId,1)==1 && ogrenciProjeAlmismi($ogrId,2)!=1)
     $projeTuru=2;

function ogrenciTumProjeBasvurulariniListele()
    {
        global $projeTuru;
         global $conn;    
        global $ogrId;
       
         	$query2 ="SELECT
                      P.id AS projeID,
                      P.adi AS projeAdi,
                      P.konu,
                      P.kisi_sayisi,
                      P.danisman_sayisi,
                      K.adi AS onerenAdi,
                      K.soyadi AS onerenSoyadi,
                      P.projedurum_id AS projeDurumId
                    FROM
                      tbl_proje AS P
                    INNER JOIN
                      tbl_ogrenci AS O ON P.oneren_id = O.id
                    INNER JOIN
                      tbl_kullanici AS K ON K.id = O.user_id
                    INNER JOIN
                      tbl_projedurum AS PD ON P.projedurum_id = PD.id
                    WHERE
                      P.Turu = ".$projeTuru."
                    UNION
                     SELECT
                      P.id AS projeID,
                      P.adi AS projeAdi,
                      P.konu,
                      P.kisi_sayisi,
                      P.danisman_sayisi,
                      K.adi AS onerenAdi,
                      K.soyadi AS onerenSoyadi,
                      P.projedurum_id AS projeDurumId
                    FROM
                      tbl_proje AS P
                    INNER JOIN
                      tbl_danisman AS D ON P.oneren_id = D.id
                    INNER JOIN
                      tbl_kullanici AS K ON K.id = D.user_id
                    INNER JOIN
                      tbl_projedurum AS PD ON P.projedurum_id = PD.id
                    WHERE
                      P.Turu = ".$projeTuru."
                ";
          $sonuc2 =mysqli_query($conn,$query2);
	       while($sutun=mysqli_fetch_array($sonuc2)){
                $query ='SELECT
                          *
                        FROM
                          tbl_ogrenci_proje AS OP 
                          INNER JOIN
                          tbl_ogrenci AS O ON OP.ogrenci_id=O.id
                          INNER JOIN 
                          tbl_kullanici AS K ON O.user_id=K.id
                        WHERE
                          O.id ='.$ogrId.' AND OP.proje_id ='.$sutun["projeID"].'';  
                $sonuc =mysqli_query($conn,$query);
                if(@mysqli_num_rows($sonuc) ==1)
                { 
                  echo '<tr>
                  <td title="'.$sutun["onerenAdi"].' '.$sutun["onerenSoyadi"].'">'.$sutun["onerenAdi"].' '.$sutun["onerenSoyadi"].'</td>
                  <td title="'.$sutun["projeAdi"].'">'.$sutun["projeAdi"].'</td>
                  <td title="'.$sutun["konu"].'">'.$sutun["konu"].'</td>
                  <td title="'.$sutun["kisi_sayisi"].'">'.$sutun["kisi_sayisi"].'</td>
                  <td title="'.$sutun["danisman_sayisi"].'">'.$sutun["danisman_sayisi"].'</td>
                  <td>  <input type="checkbox" class="active" name="'.$sutun["projeID"].'" id="'.$sutun["projeID"].'"   onchange="handleClick(this);"  value="'.$ogrId.'" checked>  </td>
                </tr>  ';
                }
           }
}
function ogrenciProjeBasvuruListeleHepsi($isaret)
    {
        global $conn;
        global $projeTuru;
        global $ogrId;
		$query ="SELECT
                  P.id AS projeID,
                  P.adi AS projeAdi,
                  P.konu,
                  P.kisi_sayisi,
                  P.danisman_sayisi,
                  K.adi AS danismanAdi,
                  K.soyadi AS danimanSoyadi,
                  P.projedurum_id AS projeDurumId
                FROM
                  tbl_proje AS P
                INNER JOIN
                  tbl_danisman AS D ON P.oneren_id = D.id
                INNER JOIN
                  tbl_kullanici AS K ON D.user_id = K.id
                INNER JOIN
                  tbl_projedurum AS PD ON P.projedurum_id = PD.id
                WHERE
                  P.projedurum_id = 1  AND P.kisi_sayisi ".$isaret." 1  AND P.turu = ".$projeTuru."  
                ";
  
		$sonuc =mysqli_query($conn,$query);
	   if($sonuc){	
	       while($sutun=mysqli_fetch_array($sonuc)){                  
               $query2 ='SELECT
                          *
                        FROM
                          tbl_ogrenci_proje AS OP 
                          INNER JOIN
                          tbl_ogrenci AS O ON OP.ogrenci_id=O.id
                          INNER JOIN 
                          tbl_kullanici AS K ON O.user_id=K.id
                        WHERE
                          O.id ='.$ogrId.' AND OP.proje_id ='.$sutun["projeID"].'';  
               $sonuc2 =mysqli_query($conn,$query2);
		      
             echo '<tr>
                  <td title="'.$sutun["danimanSoyadi"].' '.$sutun["danimanSoyadi"].'">'.$sutun["danismanAdi"].' '.$sutun["danimanSoyadi"].'</td>
                  <td title="'.$sutun["projeAdi"].'">'.$sutun["projeAdi"].'</td>
                  <td title="'.$sutun["konu"].'">'.$sutun["konu"].'</td>
                  <td title="'.$sutun["kisi_sayisi"].'">'.$sutun["kisi_sayisi"].'</td>
                  <td title="'.$sutun["danisman_sayisi"].'">'.$sutun["danisman_sayisi"].'</td>
                  <td>  <input type="checkbox" class="active" name="'.$sutun["projeID"].'" id="'.$sutun["projeID"].'"';
                  if(@mysqli_num_rows($sonuc2) ==1) echo "checked";
                  echo '   onchange="handleClick(this);"  value="'.$ogrId.'" >  </td>
                </tr>
            ';
               

	       }
        }   
    }
     function ogrenciProjeBasvuruListeleDetayli($isaret)
    {
        global $conn;
          global $projeTuru;
         global $ogrId;
         	$adi=@$_POST["adi"];
            $oneren=@$_POST["oneren"];
            $kisiSayisi=@$_POST["kisi"];
         
		
       
		$query ="SELECT
                  P.id AS projeID,
                  P.adi AS projeAdi,
                  P.konu,
                  P.kisi_sayisi,
                  P.danisman_sayisi,
                  K.adi AS onerenAdi,
                  K.soyadi AS onerenSoyadi,
                  P.projedurum_id AS projeDurumId
                FROM
                  tbl_proje AS P
                INNER JOIN
                  tbl_danisman AS D ON P.oneren_id = D.id
                INNER JOIN
                  tbl_kullanici AS K ON D.user_id = K.id
                INNER JOIN
                  tbl_projedurum AS PD ON P.projedurum_id = PD.id
                WHERE
                  P.projedurum_id = 1 AND P.kisi_sayisi ".$isaret." 1  AND P.turu =".$projeTuru." AND P.adi LIKE'%".$adi."%' AND K.adi LIKE'%".$oneren."%' AND  P.danisman_sayisi LIKE'%".$kisiSayisi."%'
                "; 
		$sonuc =mysqli_query($conn,$query);
	   if($sonuc){	
	       while($sutun=mysqli_fetch_array($sonuc)){   
               $query2 ='SELECT
                          *
                        FROM
                          tbl_ogrenci_proje AS OP 
                          INNER JOIN
                          tbl_ogrenci AS O ON OP.ogrenci_id=O.id
                          INNER JOIN 
                          tbl_kullanici AS K ON O.user_id=K.id
                        WHERE
                          O.id ='.$ogrId.' AND OP.proje_id ='.$sutun["projeID"].'';                 
               $sonuc2 =mysqli_query($conn,$query2);
		      
             echo '<tr>
                  <td title="'.$sutun["onerenAdi"].' '.$sutun["onerenSoyadi"].'">'.$sutun["onerenAdi"].' '.$sutun["onerenSoyadi"].'</td>
                  <td title="'.$sutun["projeAdi"].'">'.$sutun["projeAdi"].'</td>
                  <td title="'.$sutun["konu"].'">'.$sutun["konu"].'</td>
                  <td title="'.$sutun["kisi_sayisi"].'">'.$sutun["kisi_sayisi"].'</td>
                  <td title="'.$sutun["danisman_sayisi"].'">'.$sutun["danisman_sayisi"].'</td>
                  <td>  <input type="checkbox" class="active" name="'.$sutun["projeID"].'" id="'.$sutun["projeID"].'"';
                  if(@mysqli_num_rows($sonuc2) ==1) echo "checked";
                  echo '   onchange="handleClick(this);"  value="'.$ogrId.'" >  </td>
                </tr>
            ';
               

	       }
        }   
    }