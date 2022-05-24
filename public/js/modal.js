$(document).ready(function() {
    var old_data ="";
    var old_data2 = "";
    console.log($('#old_data').val())
    old_data= JSON.parse($('#old_data').val());
    old_data2= JSON.parse($('#old_data2').val());

    var nilai_tmp = Array(24);
    nilai_tmp.fill(null);
    var bool_dual = false;

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
   
    if(old_data.length > 0){
          $("#namapro1").val(  old_data[0].nama_project);
          $('.namapropa1').val( old_data[0].nama_project);
          for (let i = 1; i <= old_data.length; i++) {              
              $('#kategori'+i).val(old_data[0].master_project_tipe);
          }
            nilai_tmp[0] = old_data[0].nilai_1;
            nilai_tmp[1] = old_data[0].nilai_2;
            nilai_tmp[2] = old_data[0].nilai_3;
            nilai_tmp[3] = old_data[0].nilai_4;
            nilai_tmp[4] = old_data[0].nilai_5;
            nilai_tmp[5] = old_data[0].nilai_6;
    }

    if(old_data2.length > 0){
        $("#namapro2").val(  old_data2[0].nama_project);
        $('.namapropa2').val( old_data2[0].nama_project);
        for (let i = 1; i <= old_data2.length; i++) {              
            $('#kategori'+i).val(old_data2[0].master_project_tipe);
        }
          nilai_tmp[6] = old_data2[0].nilai_1;
          nilai_tmp[7] = old_data2[0].nilai_2;
          nilai_tmp[8] = old_data2[0].nilai_3;
          nilai_tmp[9] = old_data2[0].nilai_4;
          nilai_tmp[10] = old_data2[0].nilai_5;
          nilai_tmp[11] = old_data2[0].nilai_6;
          bool_dual = true;
  }

   
    for(let i=0; i<12; i++){
        if(nilai_tmp[i] != null){
            $("#"+(i+1)).prop('checked', true);
            checked[i] = 1;
        }
    }

   
    if(bool_dual){
        $("div.aspectRow").addClass('row');
        $("div.aspectForm").addClass("col-sm-6");
        $("div#form2").show();
        $('input#addForm').prop('checked', true);
        $('.double_project').val("1");
    }

 
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
        console.log(id);
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

    $("input#addForm").click(function(){
       
          
        $("div.aspectRow").toggleClass('row');
            $("div.aspectForm").toggleClass("col-sm-6");
            $("[proyek='1']").val('');
            $("div#form2").toggle();
        for(let i=7; i<=12; i++){
            if(!bool_dual){
                $('#'+i).prop('checked',false);
                checked[i-1] = 0;
            }
        }
      
        if($('.double_project').val() == "1"){
            $('.double_project').val("");
        } else{
            $('.double_project').val("1");
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

    $('input[type="number"]').change(function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
           $(this).val(max);
        }
        else if ($(this).val() < min)
        {
           $(this).val(min);
        }       
      }); 

    $('.btn-primary').each(function() {
        $(this).click(function(){
            var id = $(this).attr('value');
            console.log(id);
            var kelas = $(this).attr('data-kelas');
            $.ajax({
                method: 'GET',
                url: '/creativity/show/'+kelas+'/'+id+'/'+splitUrl[5]+'?tipe='+$('#tipeTmp1').val()+
                '&id1='+checked[0]+'&id2='+checked[1]+'&id3='+checked[2]+'&id4='+checked[3]+
                '&id5='+checked[4]+'&id6='+checked[5]+'&id7='+checked[6]+'&id8='+checked[7]+
                '&id9='+checked[8]+'&id10='+checked[9]+'&id11='+checked[10]+'&id12='+checked[11],
                dataType: 'json',
                success: function(result) {
                    console.log(checked);
                    $("#msg").html("Belum memilih aspek penilaian pada proyek ini");
                    $("#msg2").html("Belum memilih aspek penilaian pada proyek ini");
                    $('input[type="number"]').each(function() {
                        $(this).attr('disabled',true);
                    //    $(this).val(2);
                    });

                   
                    for(let i=1; i<=12; i++){
                        var idinput = "dmodal_"+i+"_"+id;
                        console.log(idinput);
                        var val = $('#'+idinput).val();
                        $('#input'+i).val(val);
                    }
                    $('#tipe').val($('#tipeTmp1').val());


                    for (let index = 1; index <= 12; index++) {
                        $("#aspect"+index).hide();
                    }

                    console.log(checked);
                    for (let index = 0; index < 6; index++) {
                        if(checked[index] == 1){
                            $("#aspect"+(index+1)).show();
                            $("#input"+(index+1)).attr('disabled',false);
                            $("#msg").html("");
                        }
                        if(checked[index+6] == 1){
                            $("#aspect"+(index+7)).show();
                            $("#input"+(index+7)).attr('disabled',false);
                            $("#msg2").html("");
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
          var idinput = "dmodal_"+ctr+"_"+id;
          console.log(idinput);
          $('#'+idinput ).val( $('#input'+ctr).val());
        }

        $('#row'+id).css('background-color', 'yellow');
      });
});

