
<span id="sonuc"></span> 
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Öğrenci Kaydı Onaylama</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Okul numarası</th>
                  <th>E-Posta</th>
                  <th>Onay</th>
                </tr>
                <?php danismanOgrenciKayitOnaylılar(); ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


      <script type="text/javascript">
      function  OgrKayitIptal(element){
// store the values from the form checkbox box, then send via ajax below
var pasifYap = $(element).is(':checked') ? 0 : 0;
var id = $(element).attr('id');
    
    $.ajax({
        type: "POST",
        url: "ajaxOgrenciKayitOnayla.php",
        data: {pasifYap: pasifYap,id:id},
        success: function(cevap){
            $("#sonuc").html(cevap);
            setTimeout(function() {
            $('.alert').remove();
            }, 1500);
        }
    });
    
return true;
}
      </script>