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
?> 