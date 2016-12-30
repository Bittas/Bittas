<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">TASARIM PROJESİ</h3>

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
                  <th>Proje adı</th>
                  <th>Proje konusu</th>
                  <th>Öğrenci sayısı</th>
                  <th>Danışman sayısı</th>
                  <th>Durum</th>
                </tr>
                <?php ogrenciOnaylanmısProjeGetir(); ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
              <small style="color: brown;font-weight: bold;"><p>*danışmanları görmek için imleci "danışman sayısı"" üzerine getiriniz</p>
              <p>*grubunuzdaki kişileri görmek için imleci "öğrenci sayısı"" üzerine getiriniz</p></small>
          <!-- /.box -->
</div>
          <script type="text/javascript">
            $("[data-toggle=popover]").popover();
          </script>