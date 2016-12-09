<?php
    $userId=@$_SESSION['staj']['id'];
    $ogrenciId=ogrenciId($userId);
if(@$_POST["projeOner"]){
    global $conn;
	echo ogrenciProjeOner($ogrenciId);
   
}
?>

<h2>Horizontal form</h2>
  <form class="form-horizontal" method="post" action="" >
    <div class="form-group">
      <label class="control-label col-sm-2" for="proje adi">Proje Adı:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name="adi" id="adi" placeholder="Proje Adı Giriniz...">
      </div>
    </div>
    <div class="form-group">
       <label class="control-label col-sm-2" for="proje konu">Proje Konu:</label>
        <div class="col-sm-6">
        <textarea class="form-control"   id="konu" name="konu" placeholder="Proje Konusunu Giriniz..." rows="3"></textarea>
        </div>
        </div> 
      <div class="form-group">
           <label class="control-label col-sm-2" for="proje turu">Proje Türü:</label>
          <div class="col-sm-6">
        <select class="form-control" name="tur" id="tur">
        <?php     
           
            
            if(ogrenciProjeAlmismi($ogrenciId,1)!=1)
                echo '<option value="1" selected>  Tasarım Projesi</option>';
             if(ogrenciProjeAlmismi($ogrenciId,1)==1 && ogrenciProjeAlmismi($ogrenciId,2)!=1)
                  echo '
                  <option value="2" >  Bitirme Projesi</option>
                  <option value="3" >  Bitirme(Tasarım) Projesi</option>
                  ';
        ?>
        </select>
          </div>
    </div>
    <div class="form-group">
           <label class="control-label col-sm-2" for="proje turu">Yapacak Kişi Sayısı:</label>
          <div class="col-sm-6">
        <select class="form-control" name="kisi">
       <?php
           projeYapcakSayisi();
       ?>
        </select>
    </div>
    </div>
    <div class="form-group">
           <label class="control-label col-sm-2" for="danişman sayısı">Danışman sayısı:</label>
          <div class="col-sm-6">
        <select class="form-control" name="danisman">
       <?php
           projeYapcakSayisi(); //danışman sayısıda olur.
       ?>
        </select>
    </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-6">
         <input type="submit" name="projeOner" class="btn btn-info pull-right" value="Projeyi Öner"/>
      </div>
    </div>
     

  </form>
