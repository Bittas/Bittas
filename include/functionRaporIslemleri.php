<?php

function raporYukle($dosya,$projeTur){
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
            return raporYukleVeritabanı($link,$projeTur);
         }
         else {
            return warningMesaj('Yanlızca "rar" ve "zip" uzantılı dosya gönderebilirsiniz.');
         }
      }
   }
   }

}

function raporYukleVeritabanı($link,$projeTur){
   global $conn;
   $userId=@$_SESSION['staj']['id'];
   $ogrId=ogrenciId($userId);
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrId,$projeTur);
   $sorgu2="INSERT INTO tbl_rapor(proje_id, org_id, gereksinim_analizleri, date) VALUES ($projeID, $ogrId, '$link', '".date("Y/m/d")."')";
   if(mysqli_query($conn,$sorgu2))
      return successMesaj("Dosyanız yüklendi");
   else
      return errorMesaj("Dosyanız yüklenemedi");
}
function raporGetirKisiyeGore($projeTur){
   global $conn;
   $userId=@$_SESSION['staj']['id'];
   $ogrId=ogrenciId($userId);
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrId,$projeTur);
   $sorgu="SELECT gereksinim_analizleri, date FROM tbl_rapor WHERE proje_id=$projeID AND org_id=$ogrId ORDER BY date DESC";
   $sonuc=mysqli_query($conn,$sorgu);
   if ($sonuc) {
      $tarihTut=0000-00-00;
      while($proje=mysqli_fetch_array($sonuc)){
         $raporAdi=explode("/", $proje["gereksinim_analizleri"]);
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
                  echo '<h3 class="timeline-header no-border"><a href="'.$proje["gereksinim_analizleri"].'">'.end($raporAdi).'</a> indirmek için tıklayınız</h3>';
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
                  echo '<h3 class="timeline-header no-border"><a href="'.$proje["gereksinim_analizleri"].'">'.end($raporAdi).'</a> indirmek için tıklayınız</h3>';
               echo '</div>';
            echo '</li>';
         }
         $tarihTut=$proje["date"];
      }
   }
}
function raporYukleyebilirMi($projeTur){
   global $conn;
   $userId=@$_SESSION['staj']['id'];
   $ogrId=ogrenciId($userId);
   $projeID=ogrenciOnaylanmısProjeIdGetir($ogrId,$projeTur);
   $sorgu1="SELECT op.ogrenci_id, op.proje_id, p.projedurum_id FROM tbl_ogrenci_proje as op LEFT JOIN tbl_proje as p ON op.proje_id=p.id WHERE op.proje_id=$projeID AND op.ogrenci_id=$ogrId";
   $sonuc1=mysqli_query($conn,$sorgu1);
   if ($sonuc1) {
      $durum=mysqli_fetch_array($sonuc1);
      if ($durum["projedurum_id"]==1) {
         echo '<form method="post" enctype="multipart/form-data">';
            echo '<div class="col-xs-4">';
               echo '<div class="form-group">';
                  echo '<label>Gereksinim Analizi</label>';
                  echo '<input type="file" name="rapor" class="form-control">';
                  echo '<p class="help-block">Example block-level help text here.</p>';
                  echo '<input type="submit" name="kaydet" value="Kaydet" class="btn btn-primary">';
               echo '</div>';
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
?>