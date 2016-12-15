<?php ob_start(); ?>
<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bitirme & Tasarım Proje Yönetim Sistemi</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">    
  <link rel="stylesheet"  href=" plugins/datatables/dataTables.bootstrap.css">
  <script src="js/danismanonay.js"></script>  
  <script src="js/danismanbasvurulari.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <link rel="stylesheet" href="css/uploadfilecss/component.css" />

  <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php
   require_once("include/config.php");
   require_once("include/function.php");
   require_once("include/functionOgrenciBasvuru.php");
   require_once("header.php");    
   sessionKontrol();
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $_SESSION["staj"]["foto"];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["staj"]["adi"]." ".$_SESSION["staj"]["soyadi"]; ?></p>
		   <?php
          if($_SESSION["staj"]["rol"] == 1)
			  echo  '<p class="text-aqua">ÖĞRENCİ</p>';
          else if($_SESSION["staj"]["rol"] == 2)
			  echo  '<p class="text-aqua">DANIŞMAN</p>';
          else if($_SESSION["staj"]["rol"] == 3)
			  echo  '<p class="text-aqua">KOMİSYON</p>';
		  ?>
        </div>
      </div>
      <form  method="POST" action="index.php?sayfa=arama" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="arama" class="form-control" placeholder="Ara...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <?php
      // solmenü çağır rol e göre
          if($_SESSION["staj"]["rol"] == 1)
          {
            require_once("ogrenciSolMenu.php");
          }else if($_SESSION["staj"]["rol"] == 2)
          {
            require_once("danismanSolMenu.php");
          }else if($_SESSION["staj"]["rol"] == 3)
          {
             require_once("komisyonSolMenu.php");
          }
        
      ?>

    </section>

  </aside>

  <div class="content-wrapper">


      <!-- Small boxes (Stat box) -->
      
	  <section class="content">
     
      <div class="row">
          <?php			
            sayfa_getir();
          ?>
      </div>

      </section>
    <!-- /.content -->
  </div>

 <?php
  require_once("footer.php");
  ob_end_flush();
 ?>
