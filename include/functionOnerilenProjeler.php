<?php


	function onerilenProjeler(){
		global $conn;
		$kullaniciID=$_SESSION["staj"]["id"];
		$danismanID=danismanId($kullaniciID);
		if (isset($_GET["rol"])) {
			$rol=$_GET["rol"];
		}

		if ($_SESSION["staj"]["rol"] == 1) {
			$sorgu="select op.proje_id as op_proje_id, op.onay, p.id as p_id, p.oneren_id, p.adi, p.konu, p.accept_date, p.end_date, p.kisi_sayisi, p.danisman_sayisi, d.id as d_id, d.durum from tbl_ogrenci_proje as op left join tbl_proje as p on op.proje_id=p.id left join tbl_projedurum as d on p.projedurum_id=d.id left join tbl_onay as o on o.id= where op.ogrenci_id='$kullaniciID'";
		}
		else if($_SESSION["staj"]["rol"] == 2){
		$sorgu="select p.id, p.adi, p.konu, p.kisi_sayisi, p.danisman_sayisi, d.durum from tbl_proje as p left join tbl_projedurum as d on p.projedurum_id=d.id where p.oneren_id='$danismanID'";
		$sorgu="SELECT
				p.id,
				p.adi, 
				p.konu, 
				p.turu,
				pt.tur AS pTur, 
				p.kisi_sayisi, 
				p.danisman_sayisi, 
				d.durum 
				FROM tbl_proje AS p 
				LEFT JOIN tbl_projedurum AS d ON p.projedurum_id=d.id 
				LEFT JOIN tbl_projeturu AS pt ON pt.id=p.turu
				WHERE p.oneren_id='$danismanID'";
		}
		else if($_SESSION["staj"]["rol"] == 3){
			if ($rol==1) {
				$sorgu="SELECT 
				o.id AS ogId, 
				k.adi AS ogAdi, 
				k.soyadi AS ogSoyadi, 
				k.rol, 
				p.id AS pId, 
				p.adi AS pAdi, 
				p.konu AS pKonu, 
				p.turu, 
				pt.tur AS pTur, 
				p.kisi_sayisi, 
				p.danisman_sayisi, 
				pd.id AS pdId, 
				pd.durum 
				FROM tbl_kullanici AS k 
				LEFT JOIN tbl_ogrenci AS o ON o.user_id=k.id 
				LEFT JOIN tbl_proje AS p ON p.oneren_id=o.id 
				LEFT JOIN tbl_projeturu AS pt ON pt.id=p.turu 
				LEFT JOIN tbl_projedurum AS pd ON pd.id=p.projedurum_id 
				WHERE k.rol=1";
			}
			else if ($rol==2) {
				$sorgu="SELECT 
						d.id AS dId,
						k.adi as dAdi,
						k.soyadi AS dSoyadi,
						k.rol,
						p.id as pId,
						p.adi AS pAdi,
						p.konu AS pKonu,
						p.turu,
						pt.tur AS pTur, 
						p.kisi_sayisi,
						p.danisman_sayisi,
						pd.id as pdId,
						pd.durum
						FROM tbl_kullanici AS k
						LEFT JOIN tbl_danisman AS d ON d.user_id=k.id
						LEFT JOIN tbl_proje AS p ON p.oneren_id=d.id
						LEFT JOIN tbl_projeturu AS pt ON pt.id=p.turu 
						LEFT JOIN tbl_projedurum AS pd ON pd.id=p.projedurum_id
						WHERE k.rol=2";
			}
		}
	//	$sorgu="select p.id, p.oneren_id, p.adi, p.konu, p.kisi_sayisi, p.danisman_sayisi, d.id as d_id, d.durum from tbl_proje as p left join tbl_projedurum as d on p.projedurum_id=d.id";
		//$sorgu1 = "SELECT COUNT(`tbl_mesaj`.`id`) FROM `tbl_mesaj` LEFT JOIN `tbl_kullanici` ON tbl_mesaj.gonderen_id = tbl_kullanici.id WHERE `alici_id`='".$id."'";
		//$query_uni ="Select id, uni_adi from tbl_proje";
		$sonuc =mysqli_query($conn,$sorgu);


		if($sonuc)
		{
			if ($_SESSION["staj"]["rol"] == 1) {
				return $sonuc;
			}
			else{

                  while($row=mysqli_fetch_array($sonuc))
                  {
					if($_SESSION["staj"]["rol"] == 2){
	                    echo '<tr>';
	                    echo '<td>'.$row["id"].'</td>';
	                    echo '<td>'.$row["adi"].'</td>';
	                    echo '<td>'.$row["pTur"].'</td>';
	                    echo '<td>'.$row["kisi_sayisi"].'</td>';
	                    echo '<td>'.$row["danisman_sayisi"].'</td>';
	                    echo '<td>'.$row["durum"].'</td>';
	                    echo '</tr>';
                  	}
					else if($_SESSION["staj"]["rol"] == 3){
	                    echo '<tr data-cost='.$row["pId"].'>';
	                    echo '<td>'.$row["pId"].'</td>';
	                    if ($rol==1)
	                    	echo '<td>'.$row["ogAdi"].' '.$row["ogSoyadi"].'</td>';
	                    else if($rol==2)
	                    	echo '<td>'.$row["dAdi"].' '.$row["dSoyadi"].'</td>';
	                    echo '<td>'.$row["pAdi"].'</td>';
	                    echo '<td>'.$row["pTur"].'</td>';
	                    echo '<td>'.$row["kisi_sayisi"].'</td>';
	                    echo '<td>'.$row["danisman_sayisi"].'</td>';
	                    echo '<td>';
	                    echo '<div class="form-group">';
	                    echo '<select class="form-control">';
	                    $sonuc2=projeDurumList();
						$i=0;
	                    while ($row2=mysqli_fetch_array($sonuc2)) {
	                    	if($row["pdId"]==$i)
	                      echo '<option value="'.$i.'" selected>'.$row2["durum"].'</option>';
	                  		else
	                      echo '<option value="'.$i.'">'.$row2["durum"].'</option>';
	                      $i++;
	                    }
	                    echo '</select>';
	                    echo '</div>';
	                    echo '</td>';
	                    echo '</tr>';
	                }
                  }
			}
		}
		else{
			echo "sorgu yanlış";
		}
	}
	function projeDurumList(){
		global $conn;
		$sorgu="select durum from tbl_projedurum";
		$sonuc =mysqli_query($conn,$sorgu);
		if ($sonuc) {
			return $sonuc;
		}
	}

?>