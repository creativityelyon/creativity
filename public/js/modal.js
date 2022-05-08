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
                        $("#aspect2").hide();$("#aspect3").hide();
                        $("#aspect4").hide();$("#aspect6").hide();
                    } 
                    else if(result.grade.grade >= 1 && result.grade.grade <= 6){
                        $("#aspect2").hide();$("#aspect6").hide();
                    } 

                    $('#exampleModalLabel').html(name);
                    $('input[type="number"]').each(function() {
                        $(this).attr('disabled',true);
                        $(this).val(2);
                    });
                    $('input[type="checkbox"]').each(function() {
                        $(this).prop('checked',false);
                    });

                    $("#subjects").html("");
                    result.tipe.forEach(element => {
                        $('#subjects').append(
                            $('<option>', {value: element.id, text: element.nama}));
                    });
                }
            });
        });
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

