<?php
	function gelenGidenMesajSayisi($id){
		global $conn;
		$sorgu1 ="select count(tbl_mesaj.id) from tbl_mesaj LEFT JOIN tbl_kullanici on tbl_mesaj.gonderen_id=tbl_kullanici.id where alici_id=".$id." and durum=0";
		$sorgu2 ="select count(tbl_mesaj.id) from tbl_mesaj LEFT JOIN tbl_kullanici on tbl_mesaj.alici_id=tbl_kullanici.id where gonderen_id=".$id." and durum=0";
		$sonuc1=mysqli_query($conn,$sorgu1);
		$sonuc2=mysqli_query($conn,$sorgu2);
		if($sonuc1){
			$gelenMesajSayi=mysqli_fetch_row($sonuc1);
		}
		if($sonuc2){
			$gidenMesajSayi=mysqli_fetch_row($sonuc2);
		}
		$tut = array('gelen' => $gelenMesajSayi, 'giden' => $gidenMesajSayi);
		return $tut;
	}
?>