$(document).ready(function() {
    // var pa =JSON.parse( $('#performing_art').val());
    // var co =JSON.parse( $('#container').val());
    // var pa2 =JSON.parse( $('#performing_art2').val());
    // var co2 =JSON.parse( $('#container2').val());

    var pa ="";
    var co ="";
    var pa2 ="";
    var co2 ="";

    var nilai_tmp = Array(24);
    nilai_tmp.fill(null);
    var bool_dual_pa = false;
    var bool_dual_co = false;

    var checked = Array(24);
    checked.fill(0);
    var currentURL = window.location.href;
    var splitUrl = currentURL.split('/');
    var kelas = JSON.parse($("input:hidden[name=zyx]").val());
    
    $("div#container").hide();
    $("div#form2").hide();
    $("div#form4").hide();
    $("div.aspectRow").removeClass('row');
    $("div.aspectRow2").removeClass('row');
   
    if(pa.length > 0){
      $("#namapro1").val(  pa[0].nama_project);
      $('.namapropa1').val( pa[0].nama_project);
       $('#subjects1').val( pa[0].master_project_tipe);
        nilai_tmp[0] = pa[0].nilai_1;
        nilai_tmp[1] = pa[0].nilai_2;
        nilai_tmp[2] = pa[0].nilai_3;
        nilai_tmp[3] = pa[0].nilai_4;
        nilai_tmp[4] = pa[0].nilai_5;
        nilai_tmp[5] = pa[0].nilai_6;

        if(pa2.length > 0 ){
            $("#namapro2").val(  pa2[0].nama_project);
            $('.namapropa2').val( pa2[0].nama_project);
            nilai_tmp[6] = pa2[0].nilai_1;
            nilai_tmp[7] = pa2[0].nilai_2;
            nilai_tmp[8] = pa2[0].nilai_3;
            nilai_tmp[9] = pa2[0].nilai_4;
            nilai_tmp[10] = pa2[0].nilai_5;
            nilai_tmp[11] = pa2[0].nilai_6;
            bool_dual_pa = true;
        }
    }
    console.log(nilai_tmp)
    if(co.length > 0){
        $('#subjects2').val( co[0].master_project_tipe);
        $("#namapro3").val( co[0].nama_project);
        $('.namaproc1').val( co[0].nama_project);
        nilai_tmp[12] = co[0].nilai_1;
        nilai_tmp[13] = co[0].nilai_2;
        nilai_tmp[14] = co[0].nilai_3;
        nilai_tmp[15] = co[0].nilai_4;
        nilai_tmp[16] = co[0].nilai_5;
        nilai_tmp[17] = co[0].nilai_6;

        if(co.length > 0){
            $("#namapro4").val(co2[0].nama_project);
            $('.namaproc2').val( co2[0].nama_project);
            nilai_tmp[18] = co2[0].nilai_1;
            nilai_tmp[19] = co2[0].nilai_2;
            nilai_tmp[20] = co2[0].nilai_3;
            nilai_tmp[21] = co2[0].nilai_4;
            nilai_tmp[22] = co2[0].nilai_5;
            nilai_tmp[23] = co2[0].nilai_6;
            bool_dual_co = true;
        }
    }
   
    console.log(pa)
    console.log(co)
    console.log(pa2)
    console.log(co2)
   
    for(let i=0; i<24; i++){
        if(nilai_tmp[i] != null){
            $("#"+(i+1)).prop('checked', true);
            checked[i] = 1;
        }
    }

   
    if(bool_dual_pa){
        $("div.aspectRow").addClass('row');
        $("div.aspectForm").addClass("col-sm-6");
        $("div#form2").show();
        $('input#addFormPerforming').prop('checked', true);
        $('input#addFormPerforming').hide();
        $('.double_proyek_pa').val("1");
    }

    if(bool_dual_co){
        $("div.aspectRow2").addClass('row');
        $("div.aspectForm2").addClass("col-sm-6");
        $("div#form4").show();
        $('input#addFormContainer').prop('checked', true);
        $('input#addFormContainer').hide();
        $('.double_proyek_c').val("1");
    }

    $('.kategori_pa').val($('#subjects1').val());
    $('.kategori_c').val($('#subjects2').val());

 
    if(kelas[0] == 'pgkg'){
        $("div#aspect21").hide();$("div#aspect31").hide();
        $("div#aspect22").hide();$("div#aspect32").hide();
        $("div#aspect41").hide();$("div#aspect61").hide();
        $("div#aspect42").hide();$("div#aspect62").hide();
    } 
    else if(kelas[0] == 'primary'){
        $("div#aspect21").hide();$("div#aspect61").hide();
        $("div#aspect22").hide();$("div#aspect62").hide();
    }else{
        $("div#container").show();
        $("div#form3").show();
    }

    
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
            $("div#form2").toggle();
        for(let i=7; i<=12; i++){
            if(!bool_dual_pa){
                $('#'+i).prop('checked',false);
                checked[i-1] = 0;
            }
        }
      
        if($('.double_proyek_pa').val() == "1"){
            $('.double_proyek_pa').val("");
        } else{
            $('.double_proyek_pa').val("1");
        }
    });

    $('#namapro1').on('change', function(){
        var temp = $(this).val();
        $('.namapropa1').val(temp);
    });
    $('#namapro2').on('change', function(){
        var temp = $(this).val();
        $('.namapropa2').val(temp);
    });
    $('#namapro3').on('change', function(){
        var temp = $(this).val();
        $('.namaproc1').val(temp);
    });
    $('#namapro4').on('change', function(){
        var temp = $(this).val();
        $('.namaproc2').val(temp);
    });

    $('#subjects1').on('change', function(){
        var temp = $(this).val();
        $('.kategori_pa').val(temp);
    })
    $('#subjects2').on('change', function(){
        var temp = $(this).val();
        $('.kategori_c').val(temp);
    })

    $("input#addFormContainer").click(function(){
        $("div.aspectRow2").toggleClass('row');
        $("div.aspectForm2").toggleClass("col-sm-6");
        $("[proyek='2']").val('');
        for(let i=19; i<=24; i++){
            if(!bool_dual_co){
                $('#'+i).prop('checked',false);
                checked[i-1] = 0;
            }
        }
        $("div#form4").toggle();
        if($('.double_proyek_c').val() == "1"){
            $('.double_proyek_c').val("");
        } else{
            $('.double_proyek_c').val("1");
        }
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
                    $("#msg").html("Belum memilih aspek penilaian pada proyek ini");
                    $("#msg2").html("Belum memilih aspek penilaian pada proyek ini");
                    $('input[type="number"]').each(function() {
                        $(this).attr('disabled',true);
                    //    $(this).val(2);
                    });
                    var kodename = "";
                    if(name == "Performing Art") {
                        kodename = "pa"; }else{ kodename = "c"; }
                    for(let i=1; i<=12; i++){
                        var idinput = "dmodal_"+i+"_"+kodename+"_"+id;
                        console.log(idinput);
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
                                $("#msg").html("");
                            }
                        }
                    }
                    else if(name == "Container"){
                        for (let index = 12; index < 24; index++) {
                            if(checked[index] == 1){
                                $("#aspect"+(index-11)).show();
                                $("#input"+(index-11)).attr('disabled',false);
                                $("#msg2").html("");
                            }
                        }
                    }
                    $("#id_user").val(result.murid.id);
                
                }
            });
        });
    });

    $('#change_btn').on('click', function(){
        var tipe = $('#tipe').val();
        var id = $('#id_user').val();
        for(let i=0; i< 12; i++){
            let ctr = i+1;
          var idinput = "dmodal_"+ctr+"_"+tipe+"_"+id;
          console.log(idinput);
          $('#'+idinput ).val( $('#input'+ctr).val());
        }
      });
});

