
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

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
                  <th>Grup</th>
                  <th>Danışman</th>
                  <th>Durum</th>
                  <th>Onay</th>
                  <th>Dosya</th>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-12">
                <?php
                  	//if ($_SESSION["staj"]["rol"] == 1) {
                  	//	echo "<tr>";
	                 //   echo '<td><a href="#">'.$row["p_id"].'</a></td>';
	                //    echo '<td>'.$row["adi"].'</td>';
	                //    echo '<td>'.$row["kisi_sayisi"].'</td>';
	                //    echo '<td>'.$row["danisman_sayisi"].'</td>';
	                //    echo '<td>'.$row["durum"].'</td>';
	               //     echo '<td>'.$row["onay"].'</td>';
                  	//	echo "</tr>";
                  	//}
                  $sonuc=onerilenProjeler();
                ?>
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title"><?php echo $sonuc["adi"]; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h1>h1. Bootstrap heading</h1>

              <h2>h2. Bootstrap heading</h2>

              <h3><?php echo $sonuc["konu"]; ?></h3>
              <h4>h4. Bootstrap heading</h4>
              <h5>h5. Bootstrap heading</h5>
              <h6>h6. Bootstrap heading</h6>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>