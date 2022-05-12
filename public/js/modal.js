$(document).ready(function() {
    var currentURL = window.location.href;
    var sizeUrl = currentURL.split('/');
    $('.btn-primary').each(function() {
        $(this).click(function(){
            var id = $(this).attr('value');
            var name = $(this).attr('name');
            $.ajax({
                method: 'GET',
                url: '/creativity/show/'+sizeUrl[6]+'/'+id+'/'+sizeUrl[5]+'?tipe='+name,
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
                    }else{
                        if(result.grade.grade >= 13){
                            $("#subjects").hide();
                        }
                    }

                    $('#exampleModalLabel').html(name);
                    $('input[type="number"]').each(function() {
                        $(this).attr('disabled',true);
                        $(this).val(2);
                    });
                    $('input[type="checkbox"]').each(function() {
                        $(this).prop('checked',false);
                    });
                    $("#id_user").val(result.murid.id);
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



                    if(result.old_data){
                        $('#old_data_1').val(result.old_data[0].id);
                        $('#namapro1').val(result.old_data[0].nama_project);
                       $('#input1').val(result.old_data[0].nilai_1);
                       $('#input2').val(result.old_data[0].nilai_2);
                       $('#input3').val(result.old_data[0].nilai_3);
                       $('#input4').val(result.old_data[0].nilai_4);
                       $('#input5').val(result.old_data[0].nilai_5);
                       $('#input6').val(result.old_data[0].nilai_6);

                       if(result.old_data[0].nilai_1 != null){
                            $('#input1').attr('disabled',false);
                            $('#1').prop('checked', true);
                       }
                       if(result.old_data[0].nilai_2 != null){
                            $('#input2').attr('disabled',false);
                            $('#2').prop('checked', true);
                       }
                       if(result.old_data[0].nilai_3 != null){
                            $('#input3').attr('disabled',false);
                            $('#3').prop('checked', true);
                       }
                       if(result.old_data[0].nilai_4 != null){
                            $('#input4').attr('disabled',false);
                            $('#4').prop('checked', true);
                       }
                       if(result.old_data[0].nilai_5 != null){
                            $('#input5').attr('disabled',false);
                            $('#5').prop('checked', true);
                       }
                       if(result.old_data[0].nilai_6 != null){
                            $('#input6').attr('disabled',false);
                            $('#6').prop('checked', true);
                       }


                       if(result.old_data.length >1){
                        $(".modal-dialog").toggleClass("modal-lg");
                        $(".aspectForm").toggleClass("col-sm-6");
                        $("#form2").toggle();
                            $('#old_data_2').val(result.old_data[1].id);
                            $('#namapro2').val(result.old_data[1].nama_project);
                        $('#input7').val(result.old_data[1].nilai_1);
                        $('#input8').val(result.old_data[1].nilai_2);
                        $('#input9').val(result.old_data[1].nilai_3);
                        $('#input10').val(result.old_data[1].nilai_4);
                        $('#input11').val(result.old_data[1].nilai_5);
                        $('#input12').val(result.old_data[1].nilai_6);

                        if(result.old_data[1].nilai_1 != null){
                                $('#input7').attr('disabled',false);
                                $('#7').prop('checked', true);
                        }
                        if(result.old_data[1].nilai_2 != null){
                                $('#input8').attr('disabled',false);
                                $('#8').prop('checked', true);
                        }
                        if(result.old_data[1].nilai_3 != null){
                                $('#input9').attr('disabled',false);
                                $('#9').prop('checked', true);
                        }
                        if(result.old_data[1].nilai_4 != null){
                                $('#input10').attr('disabled',false);
                                $('#10').prop('checked', true);
                        }
                        if(result.old_data[1].nilai_5 != null){
                                $('#input11').attr('disabled',false);
                                $('#10').prop('checked', true);
                        }
                        if(result.old_data[1].nilai_6 != null){
                            $('#input12').attr('disabled',false);
                            $('#12').prop('checked', true);
                        }
                       }
                     
                    }
                }
            });
        });
    });
    $("#form2").hide();
    
    $('#exampleModal').on('hidden.bs.modal', function () {
        $(".modal-dialog").removeClass("modal-lg");
        $(".aspectForm").removeClass("col-sm-6");
        $("#form2").hide();
    });

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

    $('input[type="number"]').keyup(function() {
        if($('#txtNumber').val()<-10 || $('#txtNumber').val()>10 ){
            $('#errorMsg').show();
        }
        else{
          $('#errorMsg').hide();
        }
      });
});

