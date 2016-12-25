<?php

	function profilGuncelleDanisman()
	{
		$id =$_SESSION["staj"]["id"];

		$mail=temizle(@$_POST["mail"]);
		$parola=temizle(@$_POST["parola"]);
		$adi=temizle(@$_POST["ad"]);
		$soyadi=temizle(@$_POST["soyad"]);
		$tc=temizle(@$_POST["tc"]);
		$unvan=temizle(@$_POST["unvan"]);
		$uni=temizle(@$_POST["uni"]);
		$hakkimda=temizle(@$_POST["hakkimda"]);

		global $conn;
		$msg ="";
		$query ="UPDATE tbl_kullanici SET adi='$adi' , soyadi ='$soyadi' ,mail ='$mail',hakkimda='$hakkimda' ";
		$yuklenecek_dosya = "profil/" . md5($_FILES['foto']['name']).substr($_FILES['foto']['name'], -4);
		if($_FILES["foto"]["name"] != "")
		{
			if (move_uploaded_file($_FILES['foto']['tmp_name'], $yuklenecek_dosya))
			{
			    $query .=",foto='$yuklenecek_dosya' ";
			    $_SESSION["staj"]["foto"]=$yuklenecek_dosya;
				$query3="insert into tbl_foto(foto,user_id) values('$yuklenecek_dosya',$id)";
				$sonuc4 =mysqli_query($conn,$query3);
			}else
			{
				$msg =errorMesaj("Foto yüklenemedi");
			}
		}
		if($parola !="")
		{
			$parola =md5($parola);
			$query .=" , parola='$parola'";
		}
		$query .=" where id =$id ; ";
		$query2="UPDATE tbl_danisman AS d SET tc='$tc', unvan='$unvan', uni_id=$uni WHERE user_id=$id";
		if(mysqli_query($conn,$query) && mysqli_query($conn,$query2))
		{
			return successMesaj("Kayıt işlemi başarılı");
		}else
		{
			return errorMesaj("Kayıt işlemi tamamlanamadı");
		}
	}
	
	?>