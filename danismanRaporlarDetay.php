    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">
          <!-- timeline time label -->
          <?php
          if (isset($_GET["projeID"])&&isset($_GET["ogrenciID"])) {
          danismanRaporProjeGetir($_GET["projeID"],$_GET["ogrenciID"]);
          }
          ?>
          <!-- END timeline item -->
        </ul>
      </div>
      <!-- /.col -->
    </section>
    <!-- /.content -->