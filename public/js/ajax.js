$('#enviarTemas').click(agregarTemas);

function agregarTemas(){
    document.getElementById("tablaTemas").style.display = "table";
    $.ajax({
        url: '../admin/datosTemas',
        type:'post',
        dataType: 'json',
        data:{
            temas:$('#temas').val()
        }
    }).done(
        function(data){
            $('#salida').append(
                '<tr><td class="text-center"><input type="text" name="temas[]" value =" '+ data[0] +' " class="form-control tem" ></td>' + 
                '<td class="text-center"><button type="button" class="btn ml-2 btn-form">Borrar</button></td></tr>'
                );
            $('#temas').val('');
        }
    );
}

$('#enviarParticipantes').click(agregarParticipantes);

function handlerChange(e){
    console.log(e)
}

function agregarParticipantes(){
    document.getElementById("tablaParticipantes").style.display = "table";
    $.ajax({
        url: '../admin/datosParticipantes',
        type:'post',
        dataType: 'json',
        data:{
            id: $("#datalistOptions option[value='" + $('#exampleDataList').val() + "']").attr('data-id'),
            nombre: $('#exampleDataList').val()
        }
    }).done(
        function(data){
            console.log(data);
            $('#salidaP').append(
                '<tr><td class="text-center">'+data[0][0]+'<input type="hidden" name="participantes[]" value =" '+ data[0][0] +'"> </td><td class="text-center">'+ data[0][1] +'</td>' + 
                '<td class="text-center"><button type="button" class="btn ml-2 btn-form">Borrar</button></td></tr>'
                );
            $('#exampleDataList').val('');
        }
    );
}

$('#enviarCompromisos').click(agregarCompromisos);


function agregarCompromisos(){
    document.getElementById("tablaCompromisos").style.display = "table";
    $.ajax({
        url: '../admin/datosCompromisos',
        type:'post',
        dataType: 'json',
        data:{
            id: $("#listParticipantes option[value='" + $('#exampleDataList2').val() + "']").attr('data-id'),
            nombre: $('#exampleDataList2').val()
        }
    }).done(
        function(data){
            console.log(data);
            $('#salidaC').append(
                '<tr><td class="text-center">'+data[0][0]+'<input type="hidden" name="participantes[]" value =" '+ data[0][0] +'"> </td><td class="text-center">'+ data[0][1] +'</td>' + 
                '<td class="text-center"><input type="text" name="compromisos[]" class="form-control"></td><td class="text-center"> <input type="date" name="fecha[]" class="form-control" min="2014-01-01" max="2100-12-31"></td><td class="text-center"><button type="button" class="btn ml-2 btn-form">Borrar</button></td></tr>'
                );
            $('#exampleDataList2').val('');
        }
    );
}

$('#campos').on('click', '.remove', function() {
    //console.log(this);
    $(this).parent().remove();
  });