function  sonlandir(element){
// store the values from the form checkbox box, then send via ajax below
var pasifYap = $(element).is(':checked') ? 1 : 0;
var id = $(element).attr('id');
    
    $.ajax({
        type: "POST",
        url: "ajaxProjeSonlandir.php",
        data: {pasifYap: pasifYap,id:id},
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
    