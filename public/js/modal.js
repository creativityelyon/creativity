$(document).ready(function() {
    var currentURL = window.location.href;
    var sizeUrl = currentURL.split('/');
    $('.btn-primary').each(function() {
        $(this).click(function(){
            var id = $(this).attr('value');
            var name = $(this).attr('name');
            $.ajax({
                method: 'GET',
                url: '/creativity/show/'+sizeUrl[6]+'/'+id+'?tipe='+name,
                dataType: 'json',
                success: function(result) {
                    if(result.grade.grade == 'KGA' || result.grade.grade == 'KGB' || result.grade.grade == 'PGB'){
                        $("#aspect21").hide();$("#aspect31").hide();
                        $("#aspect22").hide();$("#aspect32").hide();
                        $("#aspect41").hide();$("#aspect61").hide();
                        $("#aspect42").hide();$("#aspect62").hide();
                    } 
                    else if(result.grade.grade >= 1 && result.grade.grade <= 6){
                        $("#aspect21").hide();$("#aspect61").hide();
                        $("#aspect22").hide();$("#aspect62").hide();
                    } 

                    $('#exampleModalLabel').html(name);
                    $('input[type="number"]').each(function() {
                        $(this).attr('disabled',true);
                        $(this).val(2);
                    });
                    $('input[type="checkbox"]').each(function() {
                        $(this).prop('checked',false);
                    });
                    $("#id").val(result.murid.id);
                    $("#nama").val(result.murid.name);
                    $("#gender").val(result.murid.gender);
                    $("#tipe").val(result.tipe[0].tipe);
                    $("#kelas").val(result.grade.kode_kelas);
                    $("#grade").val(result.grade.grade);
                    $("#fit_time_id").val(sizeUrl[5]);
                    $("#subjects").html("");
                    result.tipe.forEach(element => {
                        $('#subjects').append(
                            $('<option>', {value: element.id, text: element.nama}));
                    });
                }
            });
        });
    });
    $("#form2").hide();
    $("#add").click(function(){
        $(".modal-dialog").toggleClass("modal-lg");
        $(".aspectForm").toggleClass("col-sm-6");
        $("#form2").toggle();
    });

    $('input[type="checkbox"]').click(function(){
        var id = $(this).attr('id');
        if($(this).is(":checked")){
            $("#input"+id).attr('disabled',false);
        }
        else if($(this).is(":not(:checked)")){
            $("#input"+id).attr('disabled',true);
        }
    });
});

