$('#enviarTemas').click(agregarTemas);

function agregarTemas(){
    document.getElementById("tablaTemas").style.display = "table";
    $.ajax({
        url: '../../adact/admin/datosTemas',
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

/*$('#enviarParticipantes').click(agregarParticipantes);

function agregarParticipantes(){
    //document.getElementById("tablaTemas").style.display = "table";

    $.ajax({
        url: '../../adact/admin/datosParticipantes',
        type:'post',
        dataType: 'json',
        data:{
            id: $('#id'),
            temas:$('#participantes').val()
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
}*/

$('#campos').on('click', '.remove', function() {
    //console.log(this);
    $(this).parent().remove();
  });