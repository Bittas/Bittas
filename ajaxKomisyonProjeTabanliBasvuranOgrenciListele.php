<?php

 require_once("include/config.php");
 require_once("include/function.php");

$sayfa = @$_POST["page"];
if($sayfa=="komisyon-proje-tabanli")
projectApprovalStatusStudentsList();

function projectApprovalStatusStudentsList()
    {
       
        global $conn;    
        echo tablo();
		$selectOnay = @$_POST["selectOnay"];
		$selectProjeTuru = @$_POST["selectProjeTuru"];
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
                      PT.id = ".$selectProjeTuru."
                    GROUP BY
                      K.id
                ";
               $satir=0;
               $sonuc2 =mysqli_query($conn,$query2);
                while($sutun=mysqli_fetch_array($sonuc2)){
                   $deger;
                    $ogrenciId=$_SESSION['staj']['id'];

                    $query =' 
                        SELECT
                        *
                        FROM
                        tbl_ogrenci_proje AS OP 
                        INNER JOIN
                          tbl_proje AS P ON P.id = OP.proje_id
                        INNER JOIN
				          tbl_projeturu AS PT ON P.turu = PT.id
                        WHERE OP.ogrenci_id='.$sutun["ogrenciId"].' AND onay=1 AND PT.id = '.$selectProjeTuru.' ' ;             		
                    $sonuc =mysqli_query($conn,$query);
                    if(@mysqli_num_rows($sonuc) ==1 && ($selectOnay=='' || $selectOnay==1) )
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
                    else if(@mysqli_num_rows($sonuc) ==0 && ($selectOnay=='' || $selectOnay==0) ){
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
               echo "</table>";
}

function tablo(){
    return '  <table id="databaseTablo" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sıra</th>
                  <th>Öğrenci Numarası</th>
                  <th>Öğrenci Adı</th>
                  <th>Öğrenci Soyadı</th>
                  <th>Başvuru Proje Türü</th>
                  <th>Onay</th>
                  <th>Detay</th>
                </tr>
                </thead>
                <tbody>
                ';
}

?>