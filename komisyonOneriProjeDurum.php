
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <?php
              if ($_GET["rol"]==1)
                echo "Öğrenci Proje Önerileri";
              else if ($_GET["rol"]==2) {
                echo "Danışman Proje Önerileri";
              }
               ?>
              </h3>

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
                  <th>Öneren</th>
                  <th>Proje</th>
                  <th>Proje Türü</th>
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
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script type="text/javascript">
      var durum;
        $( "select").change(function(){
          var durum=$(this).val();
          var data =$(this).closest("tr").data();
          var cost = data.cost;
          console.log('projeID: '+cost+'  projeDurum: '+durum);



            $.ajax({
              type:"POST",
              url:"projeDurumAjax.php",
              data:'&projeDurum='+durum+'&projeID='+cost,
              success:function(sonuc)
              {
                console.log(sonuc);
              }
            });
        });
      </script>