
function  komisyononayla(element)
{
var durum = $(element).is(':checked') ? 1 : 0;
var onay = $(element).attr('onay');
var page = $(".page").attr('name');
var numara = $(element).attr('numara');
var danismanid = $(element).attr('danisid');
var proje_id = $(element).attr('danisid');
var projedurum_id = $(element).attr('projedurum_id');
var ogr_id = $(element).attr('ogr_id');
    $.ajax({
        type: "POST",
        url: "ajaxKomisyonDanismanTabanliDurumu.php",
        data: {onay:onay,ogrid:ogr_id,projeid:proje_id,projedurumid:projedurum_id,danismanid:danismanid,durum:durum,page:page,numara:numara},
        success: function(cevap){
            $("#sonuc").html(cevap);
            setTimeout(function() {
            $('.alert').remove();
            }, 1500);
            /*var selected_durum = $("#projeler").val();
            if(selected_durum=="basvurulmayanlar"||selected_durum=="basvurulanlar")
            listeleme(element);
           */    }});
return true;
}