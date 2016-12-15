

<?php
	$projeTur =@$_GET["tur"];
if(isset($_FILES['rapor'])){
  echo raporYukle($_FILES['rapor'],$projeTur);
}
?>



    <!-- Main content -->
    <section class="content">
    <?php echo raporYukleyebilirMi($projeTur) ?>
      <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">
          <!-- timeline time label -->
          <?php raporGetirKisiyeGore($projeTur); ?>
          <!-- END timeline item -->
        </ul>
      </div>
      <!-- /.col -->
    </section>
    <!-- /.content -->