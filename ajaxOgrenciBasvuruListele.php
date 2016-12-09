<?php

 require_once("include/config.php");
 require_once("include/function.php");
 require_once("include/functionOgrenciBasvuru.php");

$projeTuru=0;
//$kullaniciId = ($_POST['ogrId']); ///BİLEMEDİM
$userId=$_SESSION['staj']['id'];
$ogrId=ogrenciId($userId);
//Öğrenci Id ve Turu ==1 ise almış 
 if(ogrenciProjeAlmismi($ogrId,1)!=1)//Almış ise
   $projeTuru=1;
  if(ogrenciProjeAlmismi($ogrId,1)==1 && ogrenciProjeAlmismi($ogrId,2)!=1)
     $projeTuru=2;

  ogrenciProjeBasvuruListele();
function ogrenciProjeBasvuruListele()
    { 
       
         global $conn;    
         global $projeTuru;      
         global $ogrId; 
        
        $sayfa = @$_POST["page"];
        $isaret=">";
        if($sayfa=="bireysel-projeler")
          $isaret="=";
        else if($sayfa=="grup-projeler")    
          $isaret=">";
    
        echo tablo();
    if($_POST["durum"]==1 ||$_POST["durum"]==0){
      	$query2 ="SELECT
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
                  P.projedurum_id = 1 AND P.kisi_sayisi ".$isaret." 1  AND P.turu =".$projeTuru." 
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
                if(@mysqli_num_rows($sonuc) ==$_POST["durum"])
                { 
                  echo '<tr>
                  <td title="'.$sutun["danimanSoyadi"].' '.$sutun["danimanSoyadi"].'">'.$sutun["danismanAdi"].' '.$sutun["danimanSoyadi"].'</td>
                  <td title="'.$sutun["projeAdi"].'">'.$sutun["projeAdi"].'</td>
                  <td title="'.$sutun["konu"].'">'.$sutun["konu"].'</td>
                  <td title="'.$sutun["kisi_sayisi"].'">'.$sutun["kisi_sayisi"].'</td>
                  <td title="'.$sutun["danisman_sayisi"].'">'.$sutun["danisman_sayisi"].'</td>
                  <td>  <input type="checkbox" class="active" name="'.$sutun["projeID"].'" id="'.$sutun["projeID"].'"   onchange="handleClick(this);"';
                    if(@mysqli_num_rows($sonuc) ==1)echo 'checked';
                    echo '  value="'.$ogrId.'"></td>
                </tr>  ';
                }
           }
    }
    else 
         ogrenciProjeBasvuruListeleHepsi($isaret);
  echo "</table>";
}

function tablo(){
    return '  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Projeyi Öneren</th>
                  <th>Proje Adı</th>
                  <th>Konu</th>
                  <th>Kişi Sayısı</th>
                  <th>Danışman Sayısı</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                ';
}

?>