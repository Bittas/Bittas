
    
//Chechbox click olayu
function  acceptingApplications(element){
// store the values from the form checkbox box, then send via ajax below
var check_active = $(element).is(':checked') ? 1 : 0;
var basvuruId = $(element).attr('basvuruid');
var projeId = $(element).attr('projeId');
var page = $(".page").attr('name');
var ogrId=$(element).attr('value');
var projeTuruId=$(element).attr('projeTuruId');
    
    $.ajax({
        type: "POST",
        url: "ajaxKomisyonProjeTabanliOgrenciProjeKabulRet.php",
        data: {basvuruId: basvuruId,projeId:projeId,projeTuruId:projeTuruId,ogrId: ogrId,active:check_active,page:page},
        success: function(cevap){
            $("#sonuc").html(cevap);
            setTimeout(function() {
            $('.alert').remove();
            }, 1500);
            /*var selected_durum = $("#projeler").val();
            if(selected_durum=="basvurulmayanlar"||selected_durum=="basvurulanlar")
            listeleme(element);
           */
        }
    });
    
return true;
}
    

function  applicantsStudentList(element){ 
$("table").remove("#databaseTablo");
var page = $(".page").attr('name');
var select_onay = $("#onay").val();	
var select_projeTuru = $("#projeTuru").val();

    
    $.ajax({
        type: "POST",
        url: "ajaxKomisyonProjeTabanliBasvuranOgrenciListele.php",
        data: {selectOnay:select_onay,selectProjeTuru:select_projeTuru,page:page},
        success: function(cevap){
             $("#listeleme").html(cevap);
        }
    });
return true;
}   