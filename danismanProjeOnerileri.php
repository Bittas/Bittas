
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Önerilen Projeler</h3>

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
                  <th>ID</th>
                  <th>Proje</th>
                  <th>Türü</th>
                  <th>Grup</th>
                  <th>Danışman</th>
                  <th>Durum</th>
                </tr>
                <?php
                  onerilenProjeler();
                ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>