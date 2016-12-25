function  danismanbasvuru(element){
// store the values from the form checkbox box, then send via ajax below
var check_active = $(element).is(':checked') ? 1 : 0;
var OD_id = $(element).attr('name');
var page = $(".page").attr('name');
    $.ajax({
        type: "POST",
        url: "ajaxDanismanbasvurulariekle.php",
        data: {OD_id: OD_id, active:check_active, page:page},
        success: function(cevap){
            $("#sonuc").html(cevap);
            setTimeout(function() {
            $('.alert').remove();
            }, 1000);
            var selected_durum = $("#projeler").val();
            if(selected_durum=="basvurulmayanlar"||selected_durum=="basvurulanlar")
            listeleme(element);
           
        }
    });
    
return true;
}
    
	
	
function  listeleme(element)
{
$("table").remove("#databaseTablo");
var page = $(".page").attr('name');
var selected_durum = $("#databaseTablo2").val();
    
    $.ajax({
        type: "POST",
        url: "ajaxDanismanbasvurulariListele.php",
        data: {durum:selected_durum,page:page},
        success: function(cevap){
             $("#listeleme").html(cevap);
        }
    });
return true;
}   