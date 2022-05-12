$(document).ready(function() {
    var currentURL = window.location.href;
    var splitUrl = currentURL.split('/');
    var kelas = $("input:hidden[name=zyx]").val();
    $("div#container").hide();
    $("div#form2").hide();
    $("div#form4").hide();
    $("div.aspectRow").removeClass('row');
    $("div.aspectRow2").removeClass('row');
 
    if(kelas == 'KGA' || kelas == 'KGB' || kelas == 'PGB'){
        $("div#aspect21").hide();$("div#aspect31").hide();
        $("div#aspect22").hide();$("div#aspect32").hide();
        $("div#aspect41").hide();$("div#aspect61").hide();
        $("div#aspect42").hide();$("div#aspect62").hide();
    } 
    else if(kelas >= 1 && kelas <= 6){
        $("div#aspect21").hide();$("div#aspect61").hide();
        $("div#aspect22").hide();$("div#aspect62").hide();
    }else{
        $("div#container").show();
        $("div#form3").show();
    }

    var checked = Array(24);
    checked.fill(0);
    $('input[type="checkbox"]').click(function(){
        var id = $(this).attr('id');
        if($(this).is(":checked")){
            $("#input"+id).attr('disabled',false);
            checked[id-1] = 1;
            $('.nilai'+(id)).val(2);


        }
        else if($(this).is(":not(:checked)")){
            $("#input"+id).attr('disabled',true);
            checked[id-1] = 0;
            $('.nilai'+(id)).val('');
        }
    });

    $("input#addFormPerforming").click(function(){
        
        $("div.aspectRow").toggleClass('row');
        $("div.aspectForm").toggleClass("col-sm-6");
        $("[proyek='1']").val('');
        for(let i=7; i<=12; i++){
            $('#'+i).prop('checked',false);
            checked[i-1] = 0;
        }
        $("div#form2").toggle();
    });

    $("input#addFormContainer").click(function(){
        $("div.aspectRow2").toggleClass('row');
        $("div.aspectForm2").toggleClass("col-sm-6");
        $("[proyek='2']").val('');
        for(let i=19; i<=24; i++){
            $('#'+i).prop('checked',false);
            checked[i-1] = 0;
        }
        $("div#form4").toggle();
    });

    $('.btn-primary').each(function() {
        $(this).click(function(){
            var id = $(this).attr('value');
            var name = $(this).attr('name');
            $.ajax({
                method: 'GET',
                url: '/creativity/show/'+splitUrl[6]+'/'+id+'/'+splitUrl[5]+'?tipe='+name+
                '&id1='+checked[0]+'&id2='+checked[1]+'&id3='+checked[2]+'&id4='+checked[3]+
                '&id5='+checked[4]+'&id6='+checked[5]+'&id7='+checked[6]+'&id8='+checked[7]+
                '&id9='+checked[8]+'&id10='+checked[9]+'&id11='+checked[10]+'&id12='+checked[11]+
                '&id1='+checked[12]+'&id2='+checked[13]+'&id3='+checked[14]+'&id4='+checked[15]+
                '&id5='+checked[16]+'&id6='+checked[17]+'&id7='+checked[18]+'&id8='+checked[19]+
                '&id9='+checked[20]+'&id10='+checked[21]+'&id11='+checked[22]+'&id12='+checked[23],
                dataType: 'json',
                success: function(result) {
                    $('input[type="number"]').each(function() {
                        $(this).attr('disabled',true);
                    //    $(this).val(2);
                    });
                    var kodename = "";
                    if(name == "Performing Art") kodename = "pa"; else kodename = "c";
                    for(let i=1; i<=12; i++){
                        var idinput = "dmodal_"+i+"_"+kodename+"_"+id;
                        var val = $('#'+idinput).val();
                        $('#input'+i).val(val);
                    }
                    $('#tipe').val(kodename);


                    for (let index = 1; index <= 12; index++) {
                        $("#aspect"+index).hide();
                    }
                    if(name == "Performing Art"){
                        for (let index = 0; index < 12; index++) {
                            if(checked[index] == 1){
                                $("#aspect"+(index+1)).show();
                                $("#input"+(index+1)).attr('disabled',false);
                            }
                        }
                    }
                    else{
                        for (let index = 12; index < 24; index++) {
                            if(checked[index] == 1){
                                $("#aspect"+(index-11)).show();
                                $("#input"+(index-11)).attr('disabled',false);
                            }
                        }
                    }
                    $('#exampleModalLabel').html(name);
                    $("#id_user").val(result.murid.id);
                    $("#nama").val(result.murid.name);
                    $("#gender").val(result.murid.gender);
                    $("#kelas").val(result.grade.kode_kelas);
                    $("#grade").val(result.grade.grade);
                    $("#fit_time_id").val(splitUrl[5]);
                    
                    // if(result.old_data){
                    //     $('#old_data_1').val(result.old_data[0].id);
                    //     $('#namapro1').val(result.old_data[0].nama_project);
                    //     $('#input1').val(result.old_data[0].nilai_1);
                    //     $('#input2').val(result.old_data[0].nilai_2);
                    //     $('#input3').val(result.old_data[0].nilai_3);
                    //     $('#input4').val(result.old_data[0].nilai_4);
                    //     $('#input5').val(result.old_data[0].nilai_5);
                    //     $('#input6').val(result.old_data[0].nilai_6);

                    //     if(result.old_data[0].nilai_1 != null){
                    //             $('#input1').attr('disabled',false);
                    //             $('#1').prop('checked', true);
                    //     }
                    //     if(result.old_data[0].nilai_2 != null){
                    //             $('#input2').attr('disabled',false);
                    //             $('#2').prop('checked', true);
                    //     }
                    //     if(result.old_data[0].nilai_3 != null){
                    //             $('#input3').attr('disabled',false);
                    //             $('#3').prop('checked', true);
                    //     }
                    //     if(result.old_data[0].nilai_4 != null){
                    //             $('#input4').attr('disabled',false);
                    //             $('#4').prop('checked', true);
                    //     }
                    //     if(result.old_data[0].nilai_5 != null){
                    //             $('#input5').attr('disabled',false);
                    //             $('#5').prop('checked', true);
                    //     }
                    //     if(result.old_data[0].nilai_6 != null){
                    //             $('#input6').attr('disabled',false);
                    //             $('#6').prop('checked', true);
                    //     }


                    //    if(result.old_data.length >1){
                    //     $(".modal-dialog").toggleClass("modal-lg");
                    //     $(".aspectForm").toggleClass("col-sm-6");
                    //     $("#form2").toggle();
                    //         $('#old_data_2').val(result.old_data[1].id);
                    //         $('#namapro2').val(result.old_data[1].nama_project);
                    //     $('#input7').val(result.old_data[1].nilai_1);
                    //     $('#input8').val(result.old_data[1].nilai_2);
                    //     $('#input9').val(result.old_data[1].nilai_3);
                    //     $('#input10').val(result.old_data[1].nilai_4);
                    //     $('#input11').val(result.old_data[1].nilai_5);
                    //     $('#input12').val(result.old_data[1].nilai_6);

                    //     if(result.old_data[1].nilai_1 != null){
                    //             $('#input7').attr('disabled',false);
                    //             $('#7').prop('checked', true);
                    //     }
                    //     if(result.old_data[1].nilai_2 != null){
                    //             $('#input8').attr('disabled',false);
                    //             $('#8').prop('checked', true);
                    //     }
                    //     if(result.old_data[1].nilai_3 != null){
                    //             $('#input9').attr('disabled',false);
                    //             $('#9').prop('checked', true);
                    //     }
                    //     if(result.old_data[1].nilai_4 != null){
                    //             $('#input10').attr('disabled',false);
                    //             $('#10').prop('checked', true);
                    //     }
                    //     if(result.old_data[1].nilai_5 != null){
                    //             $('#input11').attr('disabled',false);
                    //             $('#10').prop('checked', true);
                    //     }
                    //     if(result.old_data[1].nilai_6 != null){
                    //         $('#input12').attr('disabled',false);
                    //         $('#12').prop('checked', true);
                    //     }
                    //    }
                     
                    // }
                }
            });
        });
    });

    // $('.btn-primary').each(function() {
    //     $(this).click(function(){
    //         var id = $(this).attr('value');
    //         var name = $(this).attr('name');
    //         $.ajax({
    //             method: 'GET',
    //             url: '/creativity/show/'+sizeUrl[6]+'/'+id+'?tipe='+name,
    //             dataType: 'json',
    //             success: function(result) {
    //                 if(result.grade.grade == 'KGA' || result.grade.grade == 'KGB' || result.grade.grade == 'PGB'){
    //                     $("#aspect21").hide();$("#aspect31").hide();
    //                     $("#aspect22").hide();$("#aspect32").hide();
    //                     $("#aspect41").hide();$("#aspect61").hide();
    //                     $("#aspect42").hide();$("#aspect62").hide();
    //                 } 
    //                 else if(result.grade.grade >= 1 && result.grade.grade <= 6){
    //                     $("#aspect21").hide();$("#aspect61").hide();
    //                     $("#aspect22").hide();$("#aspect62").hide();
    //                 }else{
    //                     if(result.grade.grade >= 13){
    //                         $("#subjects").hide();
    //                     }
    //                 }

    //                 $('#exampleModalLabel').html(name);
    //                 $('input[type="number"]').each(function() {
    //                     $(this).attr('disabled',true);
    //                     $(this).val(2);
    //                 });
    //                 $('input[type="checkbox"]').each(function() {
    //                     $(this).prop('checked',false);
    //                 });
    //                 $("#id").val(result.murid.id);
    //                 $("#nama").val(result.murid.name);
    //                 $("#gender").val(result.murid.gender);
    //                 $("#tipe").val(result.tipe[0].tipe);
    //                 $("#kelas").val(result.grade.kode_kelas);
    //                 $("#grade").val(result.grade.grade);
    //                 $("#fit_time_id").val(sizeUrl[5]);
    //                 $("#subjects").html("");
    //                 result.tipe.forEach(element => {
    //                     $('#subjects').append(
    //                         $('<option>', {value: element.id, text: element.nama}));
    //                 });
    //             }
    //         });
    //     });
    // });
    // $("#form2").hide();
    
    // $('#exampleModal').on('hidden.bs.modal', function () {
    //     $(".modal-dialog").removeClass("modal-lg");
    //     $(".aspectForm").removeClass("col-sm-6");
    //     $("#form2").hide();
    // });

    // $("#add").click(function(){
    //     $(".modal-dialog").toggleClass("modal-lg");
    //     $(".aspectForm").toggleClass("col-sm-6");
    //     $("#form2").toggle();
    // });

    

    // $('input[type="number"]').keyup(function() {
    //     if($('#txtNumber').val()<-10 || $('#txtNumber').val()>10 ){
    //         $('#errorMsg').show();
    //     }
    //     else{
    //       $('#errorMsg').hide();
    //     }
    // });



    $('#change_btn').on('click', function(){
        var tipe = $('#tipe').val();
        var id = $('#id_user').val();
        for(let i=0; i< 12; i++){
            let ctr = i+1;
          var idinput = "dmodal_"+ctr+"_"+tipe+"_"+id;
          $('#'+idinput ).val( $('#input'+ctr).val());
        }
      });
});

