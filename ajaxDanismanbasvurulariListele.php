<?php

 require_once("include/config.php");
 require_once("include/function.php");


 echo tablo();
 echo ogrencidanismanBasvuru();

function tablo(){
    return '  <table id="databaseTablo2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Adı</th>
                  <th>Soyadı</th>
                  <th>İşlem</th>
                </tr>
                </thead>
                <tbody>';
}

?>