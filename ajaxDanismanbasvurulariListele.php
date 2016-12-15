<?php

  ogrenciDanismanBasvuruListele();
  
function ogrenciDanismanBasvuruListele()
{ 
       
         global $conn;    
         global $OD_id;      
         global $ogrId; 

    $query="SELECT K.adi,K.soyadi,OD.onay,OD.danisma_id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K
			on D.user_id = K.id inner join
			tbl_ogrenci_danisman as OD on
			OD.danisma_id = D.id"; 
	   if(@$sonuc =mysqli_query($conn,$query))
	   {
		while($sutun=mysqli_fetch_array($sonuc)){   
			$query2 ="SELECT * FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']."";                 
               $sonuc2 =mysqli_query($conn,$query2);
			echo '<tr>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'"';
                  if(@mysqli_num_rows($sonuc2) ==1) echo "checked";
                  echo 'onchange="danismanbasvuru(this);"  value="'.$ogrId.'"></td></tr>';
               

	       }
        }   
    }

function tablo(){
    return '  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Adı</th>
                  <th>Soyadı</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>';
}

?>