<?php
	include("include/config.php");
	$value=$_POST["value"];
	global $conn;
		$sorgu = "SELECT * FROM tbl_kullanici WHERE adi LIKE '%$value%' LIMIT 4 ";  
	    $sonuc=mysqli_query($conn,$sorgu);
		 if($sonuc)
		 {
			 while($sutun=mysqli_fetch_array($sonuc))
			{	
				//echo "<a class='aliciarama_link' href='index.php?sayfa=mesajlar&aliciID=".$sutun["id"]."'>
				//<div class='aliciarama_icerik' id=".$sutun["id"].">".$sutun["adi"]."   ".$sutun["soyadi"]." </div></a><br>";
				echo "<div>";
				echo "<div class='aliciarama_icerik col-xs-12 form-control my_autocomplete' id='".$sutun["id"]."' style='
    top: 100%;
    z-index: 1000;'>".$sutun["adi"]." ".$sutun["soyadi"]." </div>";
				echo "</div>";
			}
		 }
		 else
		 {
			 echo "Aranan Kayýt Bulunamadý";
		 }
		 
?>