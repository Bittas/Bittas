<?php
if (@$_POST["projeOner"]) {
  projeOner();
}
?>
<div class="col-xs-12">
<form method="POST">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Proje Önerme</h3>
            </div>
	 	
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                  <label>Proje Adı</label>
                  <input name="projeAdi" type="text" class="form-control" placeholder="proje adını giriniz...">
                </div>

                <div class="form-group">
                  <label>Proje Açıklama</label>
                  <textarea name="projeAciklama" class="form-control" rows="3" placeholder="proje açıklamasını giriniz..."></textarea>
                </div>

                <div class="form-group">
                  <label>Proje Türü</label>
                  <select name="projeTuru" class="form-control">
                  <?php
                    //projeTuruHepsiniGetir();
                  $sonuc=projeTuruHepsiniGetir();
                  while($row=mysqli_fetch_array($sonuc)){
                  echo '<option value="'.$row["id"].'">'.$row["tur"].'</option>';
                  }
                  ?>
                  </select>
                </div>
				
                <!-- radio -->
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Bireysel Proje
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Grup proje
                    </label>
                  </div>
					<div id="grupRadioDiv" >
                  <label for="grupSayisi">Grup sayısı</label>
                  <input name="grupSayisi" type="text" class="form-control" placeholder="kişi sayısını giriniz...">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios3" value="option1" checked>
                      Tek Danışmanlı
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios4" value="option2">
                      Çok Danışmanlı
                    </label>
                  </div>
					</div>
				<div id="danısmanRadioDiv" class="form-group" >
                  <label for="danismanSayisi">Danışman sayısı</label>
                  <input name="danismanSayisi" type="text" class="form-control" placeholder="danışman sayısını giriniz...">
				</div>
                </div>
			  <div class="box-footer">
				  <input type="submit" name="projeOner" class="btn btn-primary">
			  </div>
        </div>
              </form>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(document).ready(function()
{
  $("#grupRadioDiv").hide();
  $("#danısmanRadioDiv").hide();

  $( "#optionsRadios2" ).on( "click", function() {
  $( "#grupRadioDiv" ).show();
});
  $( "#optionsRadios1" ).on( "click", function() {
  $( "#grupRadioDiv" ).hide();
});

  $( "#optionsRadios4" ).on( "click", function() {
  $( "#danısmanRadioDiv" ).show();
});
  $( "#optionsRadios3" ).on( "click", function() {
  $( "#danısmanRadioDiv" ).hide();
});
});
</script>