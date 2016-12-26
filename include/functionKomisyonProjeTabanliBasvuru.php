<?php

    function komisyonProjeBasvuruListeleHepsi()
    {
       
         global $conn;     

         	$query2 ="SELECT
                      K.id,
                      K.adi AS ogrenciAdi,
                      K.soyadi AS ogrenciSoyadi,
                      K.foto AS foto,
                      K.rol AS rol,
                      O.numara AS numara,
                      O.id AS ogrenciId,
                      P.id AS projeId,
                      PT.id AS projeTuruId,
                      PT.tur AS projeTuru
                    FROM
                      tbl_ogrenci AS O
                    INNER JOIN
                      tbl_kullanici AS K ON O.user_id = K.id
                    INNER JOIN
                      tbl_ogrenci_proje AS OP ON OP.ogrenci_id = O.id
                    INNER JOIN
                      tbl_proje AS P ON P.id = OP.proje_id
                    INNER JOIN
                      tbl_projeturu AS PT ON P.turu = PT.id
                    WHERE
                      PT.id = 1
                    GROUP BY
                      K.id
                ";
          $sonuc2 =mysqli_query($conn,$query2);
            $satir=0;
	       while($sutun=mysqli_fetch_array($sonuc2)){               
                  $query =' 
                        SELECT
                        *
                        FROM
                        tbl_ogrenci_proje AS OP 
                        INNER JOIN
                          tbl_proje AS P ON P.id = OP.proje_id
                        INNER JOIN
				          tbl_projeturu AS PT ON P.turu = PT.id
                        WHERE OP.ogrenci_id='.$sutun["ogrenciId"].' AND onay=1 AND PT.id =1 ' ;           		
                $sonuc =mysqli_query($conn,$query);
                    if(@mysqli_num_rows($sonuc) ==1 )
                    {
                         $satir++;
                          echo '<tr>
                          <td title="'.$satir.'">'.$satir.'</td>
                          <td title="'.$sutun["numara"].'">'.$sutun["numara"].'</td>
                          <td title="'.$sutun["ogrenciAdi"].'">'.$sutun["ogrenciAdi"].'</td>
                          <td title="'.$sutun["ogrenciSoyadi"].'">'.$sutun["ogrenciSoyadi"].'</td>
                          <td title="'.$sutun["projeTuru"].'">'.$sutun["projeTuru"].'</td>
                          <td><span class="label label-success ">Onaylanmış</span></td>
                          <td><a href="index.php?sayfa=komisyon-proje-tabanli-detayli-gorunum&id='.$sutun["ogrenciId"].'&ogrenciAdi='.$sutun["ogrenciAdi"].'&foto='.$sutun["foto"].'&ogrenciSoyadi='.$sutun["ogrenciSoyadi"].'&numara='.$sutun["numara"].'&projeTuru='.$sutun["projeTuru"].'&projeTuruId='.$sutun["projeTuruId"].'&rol='.$sutun["rol"].'" class="fa fa-search"/></td>
                          </tr>  ';
                    }
                    else if(@mysqli_num_rows($sonuc) ==0){
                        $satir++;
                          echo '<tr>
                          <td title="'.$satir.'">'.$satir.'</td>
                          <td title="'.$sutun["numara"].'">'.$sutun["numara"].'</td>
                          <td title="'.$sutun["ogrenciAdi"].'">'.$sutun["ogrenciAdi"].'</td>
                          <td title="'.$sutun["ogrenciSoyadi"].'">'.$sutun["ogrenciSoyadi"].'</td>
                          <td title="'.$sutun["projeTuru"].'">'.$sutun["projeTuru"].'</td>
                          <td><span class="label label-warning">Onaylanmamış</span></td>
                          <td><a href="index.php?sayfa=komisyon-proje-tabanli-detayli-gorunum&id='.$sutun["ogrenciId"].'&ogrenciAdi='.$sutun["ogrenciAdi"].'&foto='.$sutun["foto"].'&ogrenciSoyadi='.$sutun["ogrenciSoyadi"].'&numara='.$sutun["numara"].'&projeTuru='.$sutun["projeTuru"].'&projeTuruId='.$sutun["projeTuruId"].'&rol='.$sutun["rol"].'" class="fa fa-search"/></td>
                          </tr>  ';
                    }
                
           }
        }

   function commissionProjectBasedDetailedView()
   {
      $ogrId=$_GET["id"];
      $rol=$_GET["rol"];
      $projeTuru=$_GET["projeTuru"];
      $projeTuruId=$_GET["projeTuruId"];
         global $conn;
       $query="SELECT
              OP.id AS basvuruId,
              P.id AS projeId,              
              P.adi AS projeAdi,                          
              P.konu AS projeKonu,
              P.turu AS projeTuru,
              P.kisi_sayisi AS kisiSayisi,
              P.danisman_sayisi AS danismanSayisi,
              P.oneren_id AS onerenId,
              (SELECT adi FROM tbl_kullanici AS TK  INNER JOIN tbl_ogrenci AS O ON O.user_id=TK.id WHERE O.id= P.oneren_id
              UNION
               SELECT adi FROM tbl_kullanici AS TK  INNER JOIN tbl_danisman AS D ON D.user_id=TK.id WHERE D.id= P.oneren_id 
              ) AS onerenAdi,
              (SELECT soyadi FROM tbl_kullanici AS TK  INNER JOIN tbl_ogrenci AS O ON O.user_id=TK.id WHERE O.id= P.oneren_id 
              UNION
               SELECT adi FROM tbl_kullanici AS TK  INNER JOIN tbl_danisman AS D ON D.user_id=TK.id WHERE D.id= P.oneren_id
              ) AS onerenSoyadi,
              OP.onay AS onay
            FROM
              tbl_ogrenci AS O
            INNER JOIN
              tbl_kullanici AS K ON O.user_id = K.id
            INNER JOIN
              tbl_ogrenci_proje AS OP ON OP.ogrenci_id = O.id
            INNER JOIN
              tbl_proje AS P ON P.id = OP.proje_id
            INNER JOIN
              tbl_projeturu AS PT ON P.turu = PT.id
            WHERE
              PT.id =".$projeTuruId." AND O.id=".$ogrId."    ";
          $sonuc =mysqli_query($conn,$query);
            $satir=0;
	       while($sutun=mysqli_fetch_array($sonuc)){
                        $satir++;
                           $query2 =' SELECT * FROM `tbl_ogrenci_proje` WHERE proje_id='.$sutun["projeId"].' AND ogrenci_id='.$ogrId.' AND onay=1';               
                           $sonuc2 =mysqli_query($conn,$query2);
                        
                          echo '<tr>
                          <td title="'.$satir.'">'.$satir.'</td>
                          <td title="'.$sutun["projeAdi"].'">'.$sutun["projeAdi"].'</td>
                          <td title="'.$sutun["projeKonu"].'">'.$sutun["projeKonu"].'</td>
                          <td title="'.$sutun["kisiSayisi"].'">'.$sutun["kisiSayisi"].'</td>
                          <td title="'.$sutun["danismanSayisi"].'">'.$sutun["danismanSayisi"].'</td>
                          <td title="'.$sutun["onerenAdi"].' '.$sutun["onerenSoyadi"].'">'.$sutun["onerenAdi"].' '.$sutun["onerenSoyadi"].'</td>
                          <td>  <input type="checkbox" class="active"  basvuruid="'.$sutun["basvuruId"].'" projeid="'.$sutun["projeId"].'"  projeTuruId="'.$projeTuruId.'"  onchange="acceptingApplications(this);"  value="'.$ogrId.'"';
                          if(@mysqli_num_rows($sonuc2) ==1) echo "checked";  echo'/></td>
                          </tr>  ';
                
           }
   }
  function commissionSearchApplicantStudentList(){
      global $conn;
       
			$ogrenciNumara=@$_POST["ogrenciNumara"];
            $ogrenciAdi=@$_POST["ogrenciAdi"];
            $projeTuru=@$_POST["projeTuru"];
            $onay=@$_POST["onay"];
       	$query2 ="SELECT
                      K.id,
                      K.adi AS ogrenciAdi,
                      K.soyadi AS ogrenciSoyadi,
                      K.foto AS foto,
                      O.numara AS numara,
                      K.id AS ogrenciId,
                      P.id AS projeId,
                      PT.id AS projeTuruId,
                      PT.tur AS projeTuru
                    FROM
                      tbl_ogrenci AS O
                    INNER JOIN
                      tbl_kullanici AS K ON O.user_id = K.id
                    INNER JOIN
                      tbl_ogrenci_proje AS OP ON OP.ogrenci_id = O.id
                    INNER JOIN
                      tbl_proje AS P ON P.id = OP.proje_id
                    INNER JOIN
                      tbl_projeturu AS PT ON P.turu = PT.id
                    WHERE
                      PT.id = ".$projeTuru." AND O.numara LIKE'%".$ogrenciNumara."%' AND  K.adi LIKE'%".$ogrenciAdi."%'
                    GROUP BY
                      K.id
                ";
          $sonuc2 =mysqli_query($conn,$query2);
            $satir=0;
	       while($sutun=mysqli_fetch_array($sonuc2)){               
                  $query =' 
                        SELECT
                        *
                        FROM
                        tbl_ogrenci_proje AS OP 
                        INNER JOIN
                          tbl_proje AS P ON P.id = OP.proje_id
                        INNER JOIN
				          tbl_projeturu AS PT ON P.turu = PT.id
                        WHERE OP.ogrenci_id='.$sutun["ogrenciId"].' AND onay=1 AND PT.id =1 ' ;           		
                $sonuc =mysqli_query($conn,$query);
                    if(@mysqli_num_rows($sonuc) ==1 )
                    {
                         $satir++;
                          echo '<tr>
                          <td title="'.$satir.'">'.$satir.'</td>
                          <td title="'.$sutun["numara"].'">'.$sutun["numara"].'</td>
                          <td title="'.$sutun["ogrenciAdi"].'">'.$sutun["ogrenciAdi"].'</td>
                          <td title="'.$sutun["ogrenciSoyadi"].'">'.$sutun["ogrenciSoyadi"].'</td>
                          <td title="'.$sutun["projeTuru"].'">'.$sutun["projeTuru"].'</td>
                          <td><span class="label label-success ">Onaylanmış</span></td>
                          <td><a href="index.php?sayfa=komisyon-proje-tabanli-detayli-gorunum&id='.$sutun["ogrenciId"].'&ogrenciAdi='.$sutun["ogrenciAdi"].'&foto='.$sutun["foto"].'&ogrenciSoyadi='.$sutun["ogrenciSoyadi"].'&numara='.$sutun["numara"].'&projeTuru='.$sutun["projeTuru"].'&projeTuruId='.$sutun["projeTuruId"].'" class="fa fa-search"/></td>
                          </tr>  ';
                    }
                    else if(@mysqli_num_rows($sonuc) ==0){
                        $satir++;
                          echo '<tr>
                          <td title="'.$satir.'">'.$satir.'</td>
                          <td title="'.$sutun["numara"].'">'.$sutun["numara"].'</td>
                          <td title="'.$sutun["ogrenciAdi"].'">'.$sutun["ogrenciAdi"].'</td>
                          <td title="'.$sutun["ogrenciSoyadi"].'">'.$sutun["ogrenciSoyadi"].'</td>
                          <td title="'.$sutun["projeTuru"].'">'.$sutun["projeTuru"].'</td>
                          <td><span class="label label-warning">Onaylanmamış</span></td>
                          <td><a href="index.php?sayfa=komisyon-proje-tabanli-detayli-gorunum&id='.$sutun["ogrenciId"].'&ogrenciAdi='.$sutun["ogrenciAdi"].'&foto='.$sutun["foto"].'&ogrenciSoyadi='.$sutun["ogrenciSoyadi"].'&numara='.$sutun["numara"].'&projeTuru='.$sutun["projeTuru"].'&projeTuruId='.$sutun["projeTuruId"].'" class="fa fa-search"/></td>
                          </tr>  ';
                    }
                
           }
  }


?>