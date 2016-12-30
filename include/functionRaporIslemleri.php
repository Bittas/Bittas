<?php

function raporYukle($dosya){
   if ($dosya['name']!=""||$dosya['name']!=null) {
   $hata = $dosya['error'];
   if($hata != 0) {
      echo 'Yüklenirken bir hata gerçekleşmiş.';
   } else {
      $boyut = $dosya['size'];
      if($boyut > (1024*1024*3)){
         echo 'Dosya 3MB den büyük olamaz.';
      } else {
         $tip = $dosya['type'];
         $isim = $dosya['name'];
         $uzanti = explode('.', $isim);
         $uzanti = $uzanti[count($uzanti)-1];
         if($uzanti == 'rar' || $uzanti == 'zip') {
            $dosyaSon = $dosya['tmp_name'];
            copy($dosyaSon, 'raporlar/' . $dosya['name']);
            $link='raporlar/'.$dosya['name'];
            return raporYukleVeritabanı($link);
         }
         else {
            return warningMesaj('Yanlızca "rar" ve "zip" uzantılı dosya gönderebilirsiniz.');
         }
      }
   }
   }

}

function raporYukleVeritabanı($link){
   global $conn;

        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }
        
   $userId=@$_SESSION['staj']['id'];
   $ogrId=ogrenciId($userId);
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrId);
   $sorgu2="INSERT INTO tbl_rapor(proje_id, org_id, rapor_url, date) VALUES ($projeID, $ogrId, '$link', '".date("Y/m/d")."')";
   if(mysqli_query($conn,$sorgu2))
      return successMesaj("Dosyanız yüklendi");
   else
      return errorMesaj("Dosyanız yüklenemedi");
}
function raporGetirKisiyeGore(){
   global $conn;

        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }
        
   $userId=@$_SESSION['staj']['id'];
   $ogrId=ogrenciId($userId);
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrId);
   $sorgu="SELECT p.adi AS pAdi, r.rapor_url, r.date FROM tbl_rapor AS r
LEFT JOIN tbl_proje AS p ON p.id=r.proje_id
WHERE proje_id=$projeID AND org_id=$ogrId ORDER BY date DESC";
   $sonuc=mysqli_query($conn,$sorgu);
   if ($sonuc) {
      $tarihTut=0000-00-00;
      while($proje=mysqli_fetch_array($sonuc)){
         $raporAdi=explode("/", $proje["rapor_url"]);
         $gunFarki=date("Y-m-d")-$proje["date"];
      $ilktarihstr=strtotime($proje["date"]);//ilk tarihi strtotime ile çeviriyom
      $sontarihstr=strtotime(date("Y-m-d"));//ilk tarihi strtotime ile çeviriyom
      $fark=($sontarihstr-$ilktarihstr)/86400;
      if (($sontarihstr-$ilktarihstr)/86400==0)//sondan ilki çıkarıp 86400 e bölüyoz bu bize günü verecek
         $farkMesaj="Bugün";
      else
         $farkMesaj=$fark." gün önce";
         if($tarihTut==$proje["date"]){
            //<!-- timeline item -->
            echo '<li>';
               echo '<i class="fa fa-file-zip-o bg-blue"></i>';
               echo '<div class="timeline-item">';
                  echo '<span class="time"><i class="fa fa-clock-o"></i> '.$farkMesaj.'</span>';
                  echo '<h3 class="timeline-header no-border">Proje adı: '.$proje["pAdi"].'</h3>';
                  echo '<div class="timeline-body"><label>'.end($raporAdi).'</label></div>';
                  echo '<div class="timeline-footer"><a class="btn btn-primary btn-xs" href="'.$proje["rapor_url"].'">İndir</a></div>';
               echo '</div>';
            echo '</li>';
            }
         else{
            echo '<li class="time-label">';
               echo '<span class="bg-green">';
                  echo $proje["date"];
               echo '</span>';
            echo '</li>';
               //<!-- /.timeline-label -->
               //<!-- timeline item -->
            echo '<li>';
               echo '<i class="fa fa-file-zip-o bg-blue"></i>';
               echo '<div class="timeline-item">';
                  echo '<span class="time"><i class="fa fa-clock-o"></i> '.$farkMesaj.'</span>';
                  echo '<h3 class="timeline-header no-border">Proje adı: '.$proje["pAdi"].'</h3>';
                  echo '<div class="timeline-body"><label>'.end($raporAdi).'</label></div>';
                  echo '<div class="timeline-footer"><a class="btn btn-primary btn-xs" href="'.$proje["rapor_url"].'">İndir</a></div>';
               echo '</div>';
            echo '</li>';
         }
         $tarihTut=$proje["date"];
      }
   }
}
function raporYukleyebilirMi(){
   global $conn;

        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }
        
   $userId=@$_SESSION['staj']['id'];
   $ogrId=ogrenciId($userId);
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrId);
   $sorgu1="SELECT op.ogrenci_id, op.proje_id, p.projedurum_id FROM tbl_ogrenci_proje as op LEFT JOIN tbl_proje as p ON op.proje_id=p.id WHERE op.proje_id=$projeID AND op.ogrenci_id=$ogrId";
   $sonuc1=mysqli_query($conn,$sorgu1);
   if ($sonuc1) {
      $durum=mysqli_fetch_array($sonuc1);
      if ($durum["projedurum_id"]==1) {
         echo '<form method="post" enctype="multipart/form-data">';
            echo '<div class="row">';
               echo '<div class="col-xs-2">';
                  echo '<input type="file" name="file-2" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
   <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Rapor seçin&hellip;</span></label>';
               echo '</div>';
               echo '<div class="col-xs-8"><input type="submit" name="kaydet" value="Yükle" class="btn btn-primary"></div>';
            echo '</div>';
         echo '</form>';
      }
      else{
         return warningMesaj("Bu proje Aktif değil, rapor yükleyemezsiniz");
    }
   }
   else
      echo "sorgu hatalı";
}
function danismanRaporOgrenciListeGetir(){
   global $conn;

        if (isset($_GET["tur"])) {
		   $tur=$_GET["tur"];
		   if ($tur=="bitirme")
		   	$tur=2;
		   else if($tur=="tasarim")
		   	$tur=1;
        }
        
   $sorgu="SELECT o.id AS ogID,p.id AS pId,op.id,k.adi,k.soyadi,p.adi AS pAdi,p.kisi_sayisi,p.danisman_sayisi,pd.durum FROM  tbl_ogrenci_proje AS op
LEFT JOIN tbl_ogrenci AS o ON o.id=op.ogrenci_id
LEFT JOIN tbl_kullanici AS k ON k.id=o.user_id
LEFT JOIN tbl_proje AS p ON p.id=op.proje_id
LEFT JOIN tbl_projedurum AS pd ON pd.id=p.projedurum_id
WHERE op.onay=1 AND p.turu=$tur";
   $sonuc=mysqli_query($conn,$sorgu);
   if ($sonuc) {
      while ($row=mysqli_fetch_array($sonuc)) {
$sorgu2="SELECT pr.date FROM tbl_rapor AS pr
WHERE pr.proje_id=".$row["pId"]." AND pr.org_id=".$row["ogID"]."
ORDER BY pr.id DESC";

   $sonuc2=mysqli_query($conn,$sorgu2);
   if ($sonuc2) {
      $row2_length=mysqli_num_rows($sonuc2);
      if ($row2_length>0) {
      $row2=mysqli_fetch_array($sonuc2);
         echo '
                <tr>
                  <td><a href="index.php?sayfa=danisman-raporlar-detay&projeID='.$row["pId"].'&ogrenciID='.$row["ogID"].'">'.$row["adi"].' '.$row["soyadi"].'</a></td>
                  <td>'.$row["pAdi"].'</td>
                  <td>'.$row2["date"].'</td>
                  <td><span class="label label-danger">'.$row["kisi_sayisi"].'</span></td>
                  <td><span class="label label-warning">'.$row["danisman_sayisi"].'</span></td>
                  <td><span class="label label-success">'.$row["durum"].'</span></td>
                </tr>
                ';
      }
   }
      else return "sorgu2 hatalı";
      }
   }
   else
      return "sorgu hatalı";
}
function danismanRaporProjeGetir($projeId,$ogrenciId){
   global $conn;
   $sorgu="SELECT p.adi AS pAdi, r.rapor_url, r.date FROM tbl_rapor AS r
LEFT JOIN tbl_proje AS p ON p.id=r.proje_id
WHERE proje_id=$projeId AND org_id=$ogrenciId ORDER BY date DESC";
   $sonuc=mysqli_query($conn,$sorgu);
   if ($sonuc) {
      $tarihTut=0000-00-00;
      while($proje=mysqli_fetch_array($sonuc)){
         $raporAdi=explode("/", $proje["rapor_url"]);
         $gunFarki=date("Y-m-d")-$proje["date"];
      $ilktarihstr=strtotime($proje["date"]);//ilk tarihi strtotime ile çeviriyom
      $sontarihstr=strtotime(date("Y-m-d"));//ilk tarihi strtotime ile çeviriyom
      $fark=($sontarihstr-$ilktarihstr)/86400;
      if (($sontarihstr-$ilktarihstr)/86400==0)//sondan ilki çıkarıp 86400 e bölüyoz bu bize günü verecek
         $farkMesaj="Bugün";
      else
         $farkMesaj=$fark." gün önce";


         if($tarihTut==$proje["date"]){
            //<!-- timeline item -->
            echo '<li>';
               echo '<i class="fa fa-file-zip-o bg-blue"></i>';
               echo '<div class="timeline-item">';
                  echo '<span class="time"><i class="fa fa-clock-o"></i> '.$farkMesaj.'</span>';
                  echo '<h3 class="timeline-header no-border">Proje adı: '.$proje["pAdi"].'</h3>';
                  echo '<div class="timeline-body"><label>'.end($raporAdi).'</label></div>';
                  echo '<div class="timeline-footer"><a class="btn btn-primary btn-xs" href="'.$proje["rapor_url"].'">İndir</a></div>';
               echo '</div>';
            echo '</li>';
            }
         else{
            echo '<li class="time-label">';
               echo '<span class="bg-green">';
                  echo $proje["date"];
               echo '</span>';
            echo '</li>';
               //<!-- /.timeline-label -->
               //<!-- timeline item -->
            echo '<li>';
               echo '<i class="fa fa-file-zip-o bg-blue"></i>';
               echo '<div class="timeline-item">';
                  echo '<span class="time"><i class="fa fa-clock-o"></i> '.$farkMesaj.'</span>';
                  echo '<h3 class="timeline-header no-border">Proje adı: '.$proje["pAdi"].'</h3>';
                  echo '<div class="timeline-body"><label>'.end($raporAdi).'</label></div>';
                  echo '<div class="timeline-footer"><a class="btn btn-primary btn-xs" href="'.$proje["rapor_url"].'">İndir</a></div>';
               echo '</div>';
            echo '</li>';
         }
         $tarihTut=$proje["date"];
      }
   }
}
?>