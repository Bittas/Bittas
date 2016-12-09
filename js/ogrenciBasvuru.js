 
    
//Chechbox click olayu
function  handleClick(element){
// store the values from the form checkbox box, then send via ajax below
var check_active = $(element).is(':checked') ? 1 : 0;
var projeId = $(element).attr('name');
var page = $(".page").attr('name');
var ogrId=$(element).attr('value');
    $.ajax({
        type: "POST",
        url: "ajaxOgrenciBasvuruEkleme.php",
        data: {projeId: projeId, ogrId: ogrId,active:check_active,page:page},
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
    

function  listeleme(element){
$("table").remove("#example1");
var page = $(".page").attr('name');
var selected_durum = $("#projeler").val();
    
    $.ajax({
        type: "POST",
        url: "ajaxOgrenciBasvuruListele.php",
        data: {durum:selected_durum,page:page},
        success: function(cevap){
             $("#listeleme").html(cevap);
        }
    });
return true;
}   