<?php
	define("host","localhost");
	define("user","root");
	define("pass","");
	define("db","bittas");

	$conn = mysqli_connect(host,user,pass,db) or die("Veri tabanı bağlanti hatası");
	mysqli_set_charset($conn,"utf8");
	mysqli_query($conn,"SET NAMES 'utf8' COLLATE 'utf8_turkish_ci'");
	
?>
