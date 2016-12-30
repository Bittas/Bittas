          <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php
              if ($_GET["tur"]=="tasarim")
                echo "Tasarım Projesi Raporları";
              else if ($_GET["tur"]=="bitirme")
                echo "Bitirme Projesi Raporları";
              ?></h3>

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
                  <th>Öğrenci</th>
                  <th>Proje</th>
                  <th>Son rapor tarihi</th>
                  <th>Kişi Sayısı</th>
                  <th>Danısman</th>
                  <th>Durum</th>
                </tr>
                <?php
                echo danismanRaporOgrenciListeGetir();
                ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
              <small style="color: brown;font-weight: bold;"><p>*raporları görüntülemek için 'öğrenci ismi'ne tıklayınız</p></small>
          <!-- /.box -->
          </div>