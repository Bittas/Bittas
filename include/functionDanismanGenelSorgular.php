<?php

	
	function mailkont($email)
	{
		$query="SELECT * FROM `tbl_kullanici` WHERE mail='$email'";
		global $conn;
		
		$sonuc =mysqli_query($conn,$query);		
		$durum=mysqli_num_rows($sonuc);
	return $durum;
	}
	
	function tckont($tc)
	{
		$query="SELECT * FROM `tbl_danisman` WHERE tc='$tc'";
		global $conn;
		
		$sonuc =mysqli_query($conn,$query);		
		$durum=mysqli_num_rows($sonuc);
	return $durum;
	}
	
	function danisman_ekle($email,$parola,$adi,$soyadi,$foto,$hakkimda,$rol,$uni,$unvan,$tc)
	{
		$sifre=MD5($parola);	
		global $conn;
		if(mailkont($email)==0 )
		{if( tckont($uni)==0){
		$query ="INSERT INTO `bittas`.`tbl_kullanici` (`id`, `adi`, `soyadi`, `mail`, `parola`, `rol`, `onay`, `foto`, `hakkimda`) VALUES ('', '$adi', '$soyadi', '$email', '$sifre', '$rol', '1', '$foto', '$hakkimda');";
		$sonuc =mysqli_query($conn,$query);
		$query1= "Select id from tbl_kullanici where mail='$email'";
		$sonuc1 =mysqli_query($conn,$query1);
		if($satir = mysqli_fetch_array($sonuc1))
		{
		$user_id= $satir["id"];
		$query2= "INSERT INTO `bittas`.`tbl_danisman` (`id`, `tc`, `unvan`, `user_id`, `uni_id`) 
		VALUES ('', '$tc', '$unvan', '$user_id', '$uni')";
		$sonuc2 =mysqli_query($conn,$query2);
		}
		return successMesaj("Danışman eklendi");
		
		}else
			return errorMesaj("Lütfen farklı bir tc kimlik numarası giriniz");
	
		}else
			return errorMesaj("Lütfen farklı bir mail adresi giriniz");
	}
	
	
/////////////////////////////////////////////////////////////////////////////////////////////	
	
	function proje_durum($tbldurum)
	{
		if($tbldurum==0)
		{
		$durum="Pasif";	
		}else if($tbldurum==1)
		{
		$durum="Aktif";
		}else if($tbldurum==2)
		{
		$durum="revize";
		}
		else if($tbldurum==3)
		{
		$durum="ret";
		}
		else if($tbldurum==4)
		{
		$durum="bitir";
		}
		return $durum;
	}
	
	
	function ogrenci_proje_durumu($numarasi,$adi,$soyadi,$proje_durum)
	{
		$sayac=0;
		global $conn;
		if($proje_durum==2)
		{
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id as ogrid,P.projedurum_id,P.adi as proje_adi 
		,P.id as p_id,P.turu as turu FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id  INNER JOIN tbl_ogrenci_proje AS OP 
		on O.id = OP.ogrenci_id INNER JOIN tbl_proje AS P on P.id = OP.proje_id
		where O.numara='$numarasi' and K.adi= '$adi' and K.soyadi= '$soyadi'
		order by projedurum_id ";
		}else
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id as ogrid,P.projedurum_id,P.adi as proje_adi 
		,P.id as p_id,P.turu as turu FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id  INNER JOIN tbl_ogrenci_proje AS OP 
		on O.id = OP.ogrenci_id INNER JOIN tbl_proje AS P on P.id = OP.proje_id
		where O.numara='$numarasi' and K.adi= '$adi' and K.soyadi= '$soyadi' 
		order by projedurum_id ";
		
		
		if($sonuc=@mysqli_query($conn,$sorgu))
		{		
		while($satir = mysqli_fetch_array($sonuc))
		{
		$sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['ogrid'];
		$numara = $satir['numara'];
		$p_adi = $satir['proje_adi'];
		$p_id = $satir['p_id'];
		$turu = turu($satir['turu']);
		if($durum == "Aktif")
		{		 
		       echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				  <td>'.$turu.'</td>
				<td>
				<a href="index.php?sayfa=danisman-onaylama&pid='.$p_id.'&id='.$id.'&numara='.$numara.'&proje='.$p_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td>'.$turu.'</td>
				  <td></td></tr>';
		}}}}
	
	function ogrenci_proje_durumudurum($proje_durum)
	{
		$sayac=0;
		global $conn;
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id,P.projedurum_id,P.adi as proje_adi 
		,P.id as p_id,P.turu as turu FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id  INNER JOIN tbl_ogrenci_proje AS OP 
		on O.id = OP.ogrenci_id INNER JOIN tbl_proje AS P on P.id = OP.proje_id
		where P.projedurum_id='$proje_durum'  order by projedurum_id ";
		
		if($sonuc=@mysqli_query($conn,$sorgu))
		{		
		while($satir = mysqli_fetch_array($sonuc))
		{
	    $sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['id'];
		$numara = $satir['numara'];
		$prjid = $satir['p_id'];
		$proje_adi=$satir['proje_adi'];
		$turu = turu($satir['turu']);
		if($durum == "Aktif")
		{		 
		       echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				  <td>'.$turu.'</td>
				<td>
				<a href="index.php?sayfa=danisman-onaylama&pid='.$prjid.'&id='.$id.'&numara='.$numara.'&proje='.$proje_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td>'.$turu.'</td>
				  <td></td></tr>';
		}	
		}}}	
	
	
	
	function ogrenci_proje_getir()
	{$sayac=0;
		global $conn;
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id as ogrid,P.projedurum_id,P.adi as proje_adi,
		P.id as p_id,P.turu as turu FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id 
		INNER JOIN tbl_ogrenci_proje AS OP on O.id = OP.ogrenci_id 
		INNER JOIN tbl_proje AS P on P.id = OP.proje_id where 1 order by projedurum_id ";

	if($sonuc=@mysqli_query($conn,$sorgu))
	{	
		while($satir = mysqli_fetch_array($sonuc))
		{
		$sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['ogrid'];
		$numara = $satir['numara'];
		$p_adi = $satir['proje_adi'];
		$p_id = $satir['p_id'];
		$turu = turu($satir['turu']);
		if($durum == "Aktif")
		{		 
		       echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				  <td>'.$turu.'</td>
				<td>
				<a href="index.php?sayfa=danisman-onaylama&pid='.$p_id.'&id='.$id.'&numara='.$numara.'&proje='.$p_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td>'.$turu.'</td>
				  <td></td></tr>';
		}	
		}}}


	function ogrenci_proje_durumunumara($numara)
	{$sayac=0;
		global $conn;
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id as ogrid,P.projedurum_id,P.adi as proje_adi,
		P.id as p_id,P.turu as turu FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id 
		INNER JOIN tbl_ogrenci_proje AS OP on O.id = OP.ogrenci_id 
		INNER JOIN tbl_proje AS P on P.id = OP.proje_id where O.numara='$numara' order by projedurum_id ";

	if($sonuc=@mysqli_query($conn,$sorgu))
	{	
		while($satir = mysqli_fetch_array($sonuc))
		{
			$sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['ogrid'];
		$numara = $satir['numara'];
		$p_adi = $satir['proje_adi'];
		$p_id = $satir['p_id'];
		$turu = turu($satir['turu']);
		if($durum == "Aktif")
		{		 
		       echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				  <td>'.$turu.'</td>
				<td>
				<a href="index.php?sayfa=danisman-onaylama&pid='.$p_id.'&id='.$id.'&numara='.$numara.'&proje='.$p_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td>'.$turu.'</td>
				  <td></td></tr>';
		}	
		}}}	

		
function ogrenci_proje_getir_turu($turu)
{
		$sayac=0;
		global $conn;
		$sorgu = "SELECT K.adi,K.soyadi,O.numara,O.id as ogrid,P.projedurum_id,P.adi as proje_adi,
		P.id as p_id,P.turu as turu FROM tbl_ogrenci AS O 
		INNER JOIN tbl_kullanici AS K on K.id = O.user_id 
		INNER JOIN tbl_ogrenci_proje AS OP on O.id = OP.ogrenci_id 
		INNER JOIN tbl_proje AS P on P.id = OP.proje_id where P.turu=".$turu." order by projedurum_id ";
	if($sonuc=@mysqli_query($conn,$sorgu))
	{	
		while($satir = mysqli_fetch_array($sonuc))
		{
			$sayac++;
		$durum = proje_durum($satir['projedurum_id']);
		$id = $satir['ogrid'];
		$numara = $satir['numara'];
		$p_adi = $satir['proje_adi'];
		$p_id = $satir['p_id'];
		$turu = turu($satir['turu']);
	if($durum == "Aktif")
		{		 
		       echo '<tr>
				  <td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td><strong>'.$durum.'</strong</td>
				  <td>'.$turu.'</td>
				<td>
		<a href="index.php?sayfa=danisman-onaylama&pid='.$p_id.'&id='.$id.'&numara='.$numara.'&proje='.$p_adi.'" 
				class="fa fa-search"/>
				  </a></td></tr>';
		}
		else
		{
			echo '<tr><td>'.$sayac.'</td>
                  <td>'.$satir["numara"].'</td>
                  <td>'.$satir["adi"].'</td>
                  <td>'.$satir["soyadi"].'</td>
                  <td>'.$satir["proje_adi"].'</td>
                  <td>'.$durum.'</td>
				  <td>'.$turu.'</td>
				  <td></td></tr>';
		}	}}}	
		

		
function turu($turu)
{$durum="";
	if($turu == 0)
		$durum="tasarım projesi";
	if($turu == 1)
		$durum="bitirme projesi";
	if($turu == 2)
		$durum="her ikiside";
return $durum;	
}		
//////////////////////////////////////////////////////////////////////////////////


function ogrenci_proje_bilgisi()
{
	global $conn;
	global $ogrId;

	$sql= "select P.turu from tbl_ogrenci_proje as OP
		inner join tbl_ogrenci as O on O.id=OP.ogrenci_id
		inner join tbl_proje as P on P.id= OP.proje_id
		where OP.ogrenci_id='$ogrId' and OP.onay='1'";
		$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$turu = $sutun['turu'];	
	}
	return $turu;
}


function ogrenciprojekontrol($turu)
{
	global $conn;
	global $ogrId;
	$sayi=0;
	if($turu == 1)
	{
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci as O
	inner join tbl_ogrenci_proje as OP on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where P.projedurum_id='1' and O.id='$ogrId' and OP.onay='1' and P.turu='$turu'";
	}else if ($turu == 2 or $turu == 3)
	{
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci as O
	inner join tbl_ogrenci_proje as OP on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where P.projedurum_id='1' and O.id='$ogrId' and OP.onay='1' and P.turu='$turu' ";
	}
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['sayi'];	
	}
	return $turu;
}

function danismankontrol($proje_id)
{
	global $conn;
	global $ogrId;
	$sayi=0;
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci_danisman as OD
where OD.ogr_id='$ogrId' and OD.onay='1' and .proje_id='$proje_id'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['sayi'];	
	}
	return $sayi;
}

function ogr_proje_id()
{
	global $conn;
	global $ogrId;
	$sayi=0;
	
	$sql= "SELECT P.id FROM tbl_ogrenci_proje as OP
	inner join tbl_ogrenci as O on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where OP.ogrenci_id='$ogrId' and OP.onay='1' and P.projedurum_id='1'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['id'];	
	}
	return $sayi;
}

function projedanismansayisi()
{ 
global $conn;
	global $ogrId;
	$sayi=0;
	
	$sql= "SELECT count(*) as sayi FROM tbl_ogrenci_proje as OP
	inner join tbl_ogrenci as O on O.id = OP.ogrenci_id
	inner join tbl_proje as P on P.id = OP.proje_id
	where OP.ogrenci_id='$ogrId' and P.projedurum_id='1'";
	$sonuc =@mysqli_query($conn,$sql);
	if(@$sutun=mysqli_fetch_array($sonuc))
	{$sayi = $sutun['sayi'];	
	}
	return $sayi;
}




function ogrencidanismanBasvuru($turu)
{
	global $conn;
	global $ogrId;
	$sayi=0;
	$sayac=0;
	$proje_id= ogr_proje_id();
	if(ogrenciprojekontrol($turu) > "0")
	{
	if( danismankontrol($proje_id) < projedanismansayisi() )
	{
	$query="SELECT K.adi,K.soyadi,D.id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K on D.user_id = K.id";
		
	   if(@$sonuc =mysqli_query($conn,$query))
	   {
		if(@mysqli_num_rows($sonuc)){
	       while($sutun=mysqli_fetch_array($sonuc))
		   {   
			$query2 ="SELECT count(*) as sayi FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']." and proje_id='$proje_id'"; 
        $sonuc2 =mysqli_query($conn,$query2);
		if($sutun2=mysqli_fetch_array($sonuc2))
		{
			$sayi=$sutun2["sayi"];
		}
		if($sayi>0){
			$sayac++;
			echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun['ODid'].'"
				  onchange="danismanbasvuru(this)" checked></td></tr>';
        }else{
			$sayac++;
		echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun['ODid'].'"
				  onchange="danismanbasvuru(this)" ></td></tr>';
			}
			} }else{
			   echo errorMesaj("Danışman bulunamadı");
		   }
			}else echo "girmedi"; 
	}else
	{
		echo errorMesaj("Danışman başvuru işleminiz komisyon tarafından onaylandı.
		Tekrar başvuru yapamazsınız..");
	}			
	}else 
	{
			if($turu==1){
				echo errorMesaj("Danışman başvurusu için aktif tasarım projeniz olması gerekir.  
				Lütfen önce tasarım projesi başvurusu yapınız...");
		}
		if($turu==2){
				echo errorMesaj("Danışman başvurusu için aktif bitirme projeniz olması gerekir.  
				Lütfen önce bitirme projesi başvurusu yapınız...");
		}
	}
}	

function ogrencidanismanBasvurutumDanismanlar($adi,$soyadi,$turu)
{
	
	global $conn;
	global $ogrId;
	$sayi=0;
	$sayac=0;
	$proje_id=ogrproje_id();
	if(ogrenciprojekontrol($turu) > 0)
	{
	if( danismankontrol($proje_id) < projedanismansayisi() )
	{
	$query="SELECT K.adi,K.soyadi,D.id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K on D.user_id = K.id
			where K.adi='$adi' and K.soyadi='$soyadi'";
		
	   if(@$sonuc =mysqli_query($conn,$query))
	   {	if(@mysqli_num_rows($sonuc))
		   {
	       while($sutun=mysqli_fetch_array($sonuc)){   
			$query2 ="SELECT count(*) as sayi FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']." and proje_id='$proje_id'";
			  
        $sonuc2 =mysqli_query($conn,$query2);
		if($sutun2=mysqli_fetch_array($sonuc2))
		{$sayi=$sutun2["sayi"];
		}
		if($sayi>0){
			$sayac++;
			echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" proje_id="'.$proje_id.'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   checked></td></tr>';
        }else{
			$sayac++;
		echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" proje_id="'.$proje_id.'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   ></td></tr>';
			}	
			}
		   }else{
			   echo errorMesaj("Danışman bulunamadı");
		   }
			   
        }
	}else{
		echo errorMesaj("Danışman başvuru işleminiz komisyon tarafından onaylandı.
		Tekrar başvuru yapamazsınız..");
	}
	}else{		
	
			if($turu==1){
				echo errorMesaj("Danışman başvurusu için aktif tasarım projeniz olması gerekir.  
				Lütfen önce tasarım projesi başvurusu yapınız...");
		}
		if($turu==2){
				echo errorMesaj("Danışman başvurusu için aktif bitirme projeniz olması gerekir.  
				Lütfen önce bitirme projesi başvurusu yapınız...");
		}
	}
}	
	
function ogrencidanismanBasvurutumDanismanlar1($adi,$turu)
{
	global $conn;
	global $ogrId;
	$sayi=0;
	$sayac=0;
	$proje_id=ogr_proje_id();
	if(ogrenciprojekontrol($turu) > 0)
	{
	if( danismankontrol($proje_id) < projedanismansayisi() )
	{

	$query="SELECT K.adi,K.soyadi,D.id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K on D.user_id = K.id
			where K.adi='$adi'";
		
	   if(@$sonuc =mysqli_query($conn,$query))
	   {if(@mysqli_num_rows($sonuc))
		   {
	       while(@$sutun=mysqli_fetch_array($sonuc)){   
			$query2 ="SELECT count(*) as sayi FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']." and proje_id='$proje_id'";
			  
        $sonuc2 =mysqli_query($conn,$query2);
		if($sutun2=mysqli_fetch_array($sonuc2))
		{$sayi=$sutun2["sayi"];
		}
		if($sayi>0){
			$sayac++;
			echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" proje_id="'.$proje_id.'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   checked></td></tr>';
        }else{
			$sayac++;
		echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" proje_id="'.$proje_id.'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   ></td></tr>';
			}	
			}
		   }else{
			   echo errorMesaj("Danışman bulunamadı");
		   }
			   
        }
	}else{
		echo errorMesaj("Danışman başvuru işleminiz komisyon tarafından onaylandı.
		Tekrar başvuru yapamazsınız..");
	}
	}else{
			if($turu==1){
				echo errorMesaj("Danışman başvurusu için aktif tasarım projeniz olması gerekir.  
				Lütfen önce tasarım projesi başvurusu yapınız...");
		}
		if($turu==2){
				echo errorMesaj("Danışman başvurusu için aktif bitirme projeniz olması gerekir.  
				Lütfen önce bitirme projesi başvurusu yapınız...");
		}
	}
}	

function ogrencidanismanBasvurutumDanismanlar2($soyadi,$turu)
{
	global $conn;
	global $ogrId;
	$sayi=0;
	$sayac=0;
	$proje_id=ogr_proje_id();
	if(ogrenciprojekontrol($turu) > 0)
	{
	if( danismankontrol($proje_id) < projedanismansayisi() )
	{
	$query="SELECT K.adi,K.soyadi,D.id as ODid FROM tbl_danisman as D 
			inner join tbl_kullanici as K on D.user_id = K.id
			where K.soyadi='$soyadi'";
		
	   if(@$sonuc =mysqli_query($conn,$query))
	   {	if(@mysqli_num_rows($sonuc))
		   {
	       while($sutun=mysqli_fetch_array($sonuc)){   
			$query2 ="SELECT count(*) as sayi FROM tbl_ogrenci_danisman AS OD INNER JOIN
              tbl_ogrenci AS O ON OD.ogr_id=O.id
              INNER JOIN tbl_kullanici AS K ON O.user_id=K.id
              WHERE O.id ='$ogrId' AND OD.danisma_id =".$sutun['ODid']." and proje_id='$proje_id'";
			  
        $sonuc2 =mysqli_query($conn,$query2);
		if($sutun2=mysqli_fetch_array($sonuc2))
		{$sayi=$sutun2["sayi"];
		}
		if($sayi>0){
			$sayac++;
			echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" proje_id="'.$proje_id.'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   checked></td></tr>';
        }else{
			$sayac++;
		echo '<tr><td>'.$sayac.'</td>
                  <td title="'.$sutun["adi"].'">'.$sutun["adi"].'</td>
                  <td title="'.$sutun["soyadi"].'">'.$sutun["soyadi"].'</td>
                  <td><input type="checkbox" class="active" name="'.$sutun["ODid"].'" 
				  id="'.$sutun["ODid"].'" proje_id="'.$proje_id.'" onchange="danismanbasvuru(this)" value="'.$ogrId.'"
				   ></td></tr>';
			}	
			}
		   }else{
			   echo errorMesaj("Danışman bulunamadı");
		   }
			   
        }
	}else{
		echo errorMesaj("Danışman başvuru işleminiz komisyon tarafından onaylandı.
		Tekrar başvuru yapamazsınız..");
	}
	}else{
			if($turu==1){
				echo errorMesaj("Danışman başvurusu için aktif tasarım projeniz olması gerekir.  
				Lütfen önce tasarım projesi başvurusu yapınız...");
		}
		if($turu==2){
				echo errorMesaj("Danışman başvurusu için aktif bitirme projeniz olması gerekir.  
				Lütfen önce bitirme projesi başvurusu yapınız...");
		}
	}
}	
?>
