<?php
	include("include/config.php");
	$projeID=$_POST["projeID"];
	$projeDurum=$_POST["projeDurum"];
	global $conn;
	$query="update tbl_proje set projedurum_id='$projeDurum' where id='$projeID'";
	    $sonuc=mysqli_query($conn,$query);
		 if($sonuc)
		 {
		 	echo "başarılı";
		 }
		 else
		 {
		 	echo "başarısız";
		 }
		 
?>